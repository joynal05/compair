<?php
/*
 * Plugin Name: FairPixels Lastest Tweets
 * Plugin URI: http://fairpixels.com/
 * Description: A widget to display lastest tweets in the sidebar or footer of the theme.
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com/
 */

/**
 * Include required files
 */
if ( !class_exists('tmhOAuth') ) {
	require 'lib/tmhOAuth.php';
	require 'lib/tmhUtilities.php';
}

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'fp_lastest_tweets_widget_init' );

function fp_lastest_tweets_widget_init() {
	register_widget( 'fp_lastest_tweets_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class fp_lastest_tweets_widget extends WP_widget_xxx {
	
	/**
	 * Widget setup.
	 */
	function fp_lastest_tweets_widget() {
		/* Widget settings */
		$widget_ops = array( 'classname' => 'widget_twitter', 'description' => __('A widget to display lastest tweets in the sidebar.', 'fairpixels') );

		/* Create the widget */
		$this->WP_Widget( 'fp_lastest_tweets_widget', __('Fairpixels: Lastest Tweets', 'fairpixels'), $widget_ops );
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$widget_id = $args['widget_id'];
		/* Our variables from the widget settings. */
		
		$username = $instance['username'];
		$post_count = $instance['post_count'];
		if( empty($post_count) ){ $post_count = 5; }
		
		$fp_consumer_key = $instance['fp_consumer_key'];
		$fp_consumer_secret = $instance['fp_consumer_secret'];
		$fp_access_token = $instance['fp_access_token'];
		$fp_access_secret = $instance['fp_access_secret'];
		
						
		echo $before_widget;
		
		
		if( (empty($fp_consumer_key)) OR (empty($fp_consumer_secret)) OR (empty($fp_access_token)) OR (empty($fp_access_secret)) ){
			echo '<strong>Please enter API data in widget. </strong>' . $after_widget;
			return;
		}					
						
		if ( $username ){						
				$user_tweets = get_option('fp_recent_tweets');			
								
				if ((empty($user_tweets)) OR ($_SERVER['REQUEST_TIME'] > get_option('fp_ltweet_cache_time'))){
					$new_tweets = $this -> fetch_tweets($username, $post_count, $fp_consumer_key, $fp_consumer_secret, $fp_access_token, $fp_access_secret);				
				}				

				if (!empty($new_tweets)){
					$user_tweets = $new_tweets;
				}
				
				if ($user_tweets){ ?>	
					
					<script>
						jQuery(document).ready(function($) {				
							$(".tweet-list").show();
							$('#<?php echo esc_attr( $widget_id ); ?> .tweet-list').flexslider({
								animation: "slide",	
								controlNav: true,
								slideshow: true,
								directionNav: false,
								slideshowSpeed: 6000,
								smoothHeight: true,
								controlsContainer: "#<?php echo esc_attr( $widget_id ); ?> .tweet-nav",
								keyboard: true,
								mousewheel: false,
							});	
						});
					</script>
					
					<div class="title">
						<h4>@<?php echo esc_attr( $username ); ?></h4>
						<span class="link"><a href="http://twitter.com/<?php echo esc_attr($username); ?>"><?php _e('Follow us', 'fairpixels'); ?></a></span>
					</div>
					
					<div class="outer-wrap">
						<div class="icon"><i class="fa fa-twitter"></i></div>											
						<div class="tweet-list">
							<ul class="slides">
								<?php foreach ($user_tweets as $tweet) { ?>
									<li>
										<?php 
											$filter_tweet =  $this->filter_tweet( $tweet->tweet_text ); 											
											$created_time = $tweet->tweet_time;
											$time_ago = sprintf(__('%s ago', 'fairpixels'), human_time_diff(strtotime($created_time)));				
										?>
										
										<div class="tweet">											
											<p>
												<?php 
													$allowed_html = fp_get_allowed_html_tags(); 
													echo wp_kses($filter_tweet, $allowed_html);											
												?>
											</p>											
											<div class="time"><i class="fa fa-clock-o"></i><?php echo esc_html( $time_ago ); ?></div>
										</div>									
									</li>
								<?php } ?>
							</ul>
						</div>						
						<div class="tweet-nav"></div>	
					</div>					
				<?php								
				} //user_tweets
			}	//username
			?>
	           
    <?php
		echo $after_widget;
	}
	
	/**
	 * function to fetch posts
	 */	
	function fetch_tweets($username, $post_count, $fp_consumer_key, $fp_consumer_secret, $fp_access_token, $fp_access_secret){
		$interval = 600;
		
		$tmhOAuth = new tmhOAuth(
					array(
						'consumer_key' => $fp_consumer_key,
						'consumer_secret' => $fp_consumer_secret,
						'user_token' => $fp_access_token,
						'user_secret' => $fp_access_secret,
						'curl_ssl_verifypeer' => false 
					)
				);
		
		$request_array = array();
		$request_array['screen_name'] = $username;
		$request_array['count'] = $post_count;
		$request_array['include_rts'] = false;
		
		$code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), $request_array);
		
		if ($code != 200) {
			return false;			
		}
		
		$response = $tmhOAuth->response['response'];	
		$tweets_content = json_decode($response);	
		
		$tweets = array();			
		foreach($tweets_content as $tweet) {
			$data = new StdClass();
			$data->tweet_text = $tweet->text;
			$data->tweet_time = $tweet->created_at;
			$tweets[] = $data;
		}
		
		if (!empty($data->tweet_text)){
			update_option('fp_ltweet_cache_time', $_SERVER['REQUEST_TIME'] + $interval);
			update_option('fp_recent_tweets', $tweets);
			return $tweets;
		}			
		
	}
	
	 private function filter_tweet($tweet){
        $tweet = preg_replace('/(http[^\s]+)/im', '<a href="$1">$1</a>', $tweet);		//url links
        $tweet = preg_replace('/@([^\s]+)/i', '<a href="http://twitter.com/$1">@$1</a>', $tweet);	//user links   
        return $tweet;
    }	
		
	
	/**
	 * update widget settings
	 */	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['username'] = $new_instance['username'];
		$instance['post_count'] = $new_instance['post_count'];	
		$instance['fp_consumer_key'] = $new_instance['fp_consumer_key'];	
		$instance['fp_consumer_secret'] = $new_instance['fp_consumer_secret'];	
		$instance['fp_access_token'] = $new_instance['fp_access_token'];	
		$instance['fp_access_secret'] = $new_instance['fp_access_secret'];			
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	 function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
			'username' => '',	
			'post_count' => 5,	
			'fp_consumer_key' => '',	
			'fp_consumer_secret' => '',	
			'fp_access_token' => '',	
			'fp_access_secret' => '',	
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
			
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php _e('Username:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('username') ); ?>" name="<?php echo esc_attr( $this->get_field_name('username') ); ?>" value="<?php echo esc_attr( $instance['username'] ); ?>" />
			<p class="desc"><?php _e('Enter twitter username', 'fairpixels'); ?></p>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>"><?php _e('Number:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('post_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_count') ); ?>" value="<?php echo esc_attr( $instance['post_count'] ); ?>" />
			<p class="desc"><?php _e('Enter number of tweets to display', 'fairpixels'); ?></p>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'fp_consumer_key' ) ); ?>"><?php _e('API key:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('fp_consumer_key') ); ?>" name="<?php echo esc_attr( $this->get_field_name('fp_consumer_key') ); ?>" value="<?php echo esc_attr( $instance['fp_consumer_key'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'fp_consumer_secret' ) ); ?>"><?php _e('API secret:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('fp_consumer_secret') ); ?>" name="<?php echo esc_attr( $this->get_field_name('fp_consumer_secret') ); ?>" value="<?php echo esc_attr( $instance['fp_consumer_secret'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'fp_access_token' ) ); ?>"><?php _e('Access token:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('fp_access_token') ); ?>" name="<?php echo esc_attr( $this->get_field_name('fp_access_token') ); ?>" value="<?php echo esc_attr( $instance['fp_access_token'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'fp_access_secret' ) ); ?>"><?php _e('Access secret:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('fp_access_secret') ); ?>" name="<?php echo esc_attr( $this->get_field_name('fp_access_secret') ); ?>" value="<?php echo esc_attr( $instance['fp_access_secret'] ); ?>" />
		</div>
				
	<?php
	}
}

?>