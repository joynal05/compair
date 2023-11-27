<?php
/**
 * Plugin Name: FairPixels: Pinterest Widget
 * Plugin URI: http://fairpixels.com/
 * Description: A widget to display the pinterest feeds
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */

add_action( 'widgets_init', 'fp_pinterest_widget_init' );

function fp_pinterest_widget_init() {
	register_widget( 'fp_pinterest_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class fp_pinterest_widget extends WP_widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_pinterest', 'description' => __('Displays the recent pins from pinterest.', 'fairpixels') );

		/* Create the widget */
		parent::__construct( 'fp_pinterest_widget', __('FairPixels: Pinterest', 'fairpixels'), $widget_ops );
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){
	 
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );		
		echo $before_widget;		
		$title = ( $title ) ? $title : 'Recent Pins';		
		
		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}
		
		if( !empty( $instance['username'] ) ) {		
		if ( !empty( $instance['number_of_pins'] )  && is_int( $instance['number_of_pins'] ) ) {
			$number_of_pins = esc_html ( $instance['number_of_pins'] );
		} else {
			$number_of_pins = 6;
		}
		if( !empty( $instance['specific_board'] ) ) {	
			$feed_url = 'http://pinterest.com/'.$instance['username'].'/'.$instance['specific_board'].'/rss';
		} else {
			$feed_url = 'http://pinterest.com/'.$instance['username'].'/feed.rss';	
		}
		
		//get rss feed
		$latest_pins = $this->get_rss_feed( $instance['username'], $instance['number_of_pins'], $feed_url );
		
		?>
	
		<ul class="recent-pins-widget">			
			<?php 
				if(!empty( $latest_pins ) ){
					foreach ( $latest_pins as $item ):
						$rss_pin_description = $item->get_description();			
						preg_match('/<img[^>]+>/i', $rss_pin_description, $pin_image); 
						?>
					<li class="recent-pin">
						<div class="pinterest-image overlay">
							<a href="<?php echo esc_url( $item->get_permalink() ); ?>" title="<?php echo 'Posted '.esc_attr( $item->get_date('j F Y | g:i a') ); ?>">
								<?php								
									$allowed_html = fp_get_allowed_html_tags(); 
									echo wp_kses($pin_image[0], $allowed_html);
								?>
							</a>			
						</div>
					</li>
					<?php endforeach; 
				}			
			?>		
		</ul>
			<?php if( $instance['show_follow_button'] ){ ?>
				<li class="pinterest-follow-me"><a href="http://pinterest.com/<?php echo esc_attr( $instance['username'] );?>/" target="_blank"><img src="http://passets-lt.pinterest.com/images/about/buttons/follow-me-on-pinterest-button.png" width="156" height="26" alt="<?php _e('Follow Me on Pinterest', 'fairpixels'); ?>" /></a></li>
			<?php
			}		
					
		}		
		echo $after_widget;
	}
	
	function get_rss_feed( $username, $number_of_pins, $feed_url ){				
	
		$rss = fetch_feed( $feed_url );
		$rss_items = '';
		if (!is_wp_error( $rss ) ) : 			
			$maxitems = $rss->get_item_quantity( $number_of_pins ); 
			$rss_items = $rss->get_items( 0, $maxitems ); 
		endif;		
		return $rss_items;
	}
	
	function trim_text( $text, $length ) {
	
		$text = strip_tags( $text );	  

		if (strlen($text) <= $length) {
			return $text;
		}		
		$last_space = strrpos( mb_substr( $text, 0, $length ), ' ');
		$trimmed_text = mb_substr( $text, 0, $last_space );		
		$trimmed_text .= '...';	  
		return $trimmed_text;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = wp_parse_args( $old_instance, $new_instance );
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number_of_pins'] = strip_tags($new_instance['number_of_pins']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['specific_board'] = strip_tags($new_instance['specific_board']);
		$instance['show_follow_button'] = strip_tags($new_instance['show_follow_button']);
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Recent Pins', 'username' => '', 'number_of_pins' => 8, 'show_follow_button' => 0, 'specific_board' => '') );				
		?>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php _e('Username:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('username') ); ?>" name="<?php echo esc_attr( $this->get_field_name('username') ); ?>" value="<?php echo esc_attr( $instance['username'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'specific_board' ) ); ?>"><?php _e('Board ID:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('specific_board') ); ?>" name="<?php echo esc_attr( $this->get_field_name('specific_board') ); ?>" value="<?php echo esc_attr( $instance['specific_board'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_pins' ) ); ?>"><?php _e('Number of Pins:', 'fairpixels'); ?></label>			
			<select name="<?php echo esc_attr( $this->get_field_name( 'number_of_pins' ) );?>">			
				<?php for ( $i = 1; $i <= 25; ++$i ){ ?>
					<option value="<?php echo esc_attr( $i );?>" <?php selected( $instance['number_of_pins'], $i );?>><?php echo esc_attr( $i );?></option>
				<?php }	?>		
			</select>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_follow_button' ) ); ?>"><?php _e('Show Follow Me:', 'fairpixels'); ?></label>
			<input type="checkbox" name="<?php echo esc_attr( $this->get_field_name('show_follow_button') ); ?>" value="1" <?php checked( $instance['show_follow_button'], 1 ); ?> />	
		</div>
				
		<?php
	}		
}

?>