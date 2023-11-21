<?php
/**
 * Plugin Name: FairPixels: About us
 * Plugin URI: http://fairpixels.com/
 * Description: This widhet displays the logo, information and the social links.
 * Version: 1.0
 * Author: FairPixels Team
 * Author URI: http://fairpixels.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'fp_aboutus_widget_init' );

function fp_aboutus_widget_init() {
	register_widget( 'fp_aboutus_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class fp_aboutus_widget extends WP_widget_xxx {

	/**
	 * Widget setup.
	 */
	function fp_aboutus_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_social', 'description' => __('Displays the the social links with the text and logo', 'fairpixels') );

		/* Create the widget. */
		$this->WP_Widget( 'fp_aboutus_widget', __('FairPixels: About us', 'fairpixels'), $widget_ops);
	}

	/**
	 * display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		
		extract( $args );
		
		/* Our variables from the widget settings. */
		$title = $instance['title'];
		$text = $instance['text'];
		$twitter_url = $instance['twitter_url'];
		$facebook_url = $instance['facebook_url'];
		$gplus_url = $instance['gplus_url'];
		$pinterest_url = $instance['pinterest_url'];
		$dribbble_url = $instance['dribbble_url'];
		$linkedin_url = $instance['linkedin_url'];
		$instagram_url = $instance['instagram_url'];
		$youtube_url = $instance['youtube_url'];
		$rss_url = $instance['rss_url'];
		
		echo $before_widget;
      
		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}
				
		if ( $text ){ ?>
		   <div class="info-text">
				<?php 
					$allowed_html = fp_get_allowed_html_tags(); 
					echo wp_kses($text, $allowed_html);
				?>
		   </div>
	   <?php } ?>
	   
	   <div class="social-links">
		   <ul class="list">
			   <?php if(!empty($twitter_url)){	?>
					<li><a class="twitter" href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<?php
				} 
				
				if(!empty($facebook_url)){	?>
					<li><a class="fb" href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<?php }
				
				if(!empty($gplus_url)){	?>
					<li><a class="gplus" href="<?php echo esc_url( $gplus_url ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
				<?php }
				
				if(!empty($pinterest_url)){	?>
					<li><a class="pinterest" href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
				<?php }
				
				if(!empty($dribbble_url)){	?>
					<li><a class="dribbble" href="<?php echo esc_url( $dribbble_url ); ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
				<?php }
										
				if(!empty($linkedin_url)){	?>
					<li><a class="linkedin" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
				<?php }
				
				if(!empty($instagram_url)){	?>
					<li><a class="instagram" href="<?php echo esc_url( $instagram_url ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
				<?php }
				
				if(!empty($youtube_url)){	?>
					<li><a class="youtube" href="<?php echo esc_url( $youtube_url ); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
				<?php }
				
				if(!empty($rss_url)){	?>
					<li><a class="rss" href="<?php echo esc_url( $rss_url ); ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
				<?php }	 ?>				
			</ul>
		</div>		
	   <?php
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		/* Set up some default widget settings. */		
		$defaults = array(
			'title' => '',	
			'text' => '',	
			'twitter_url' => '',
			'facebook_url' => '',
			'gplus_url' => '',
			'pinterest_url' => '',
			'dribbble_url' => '',
			'linkedin_url' => '',
			'instagram_url' => '',
			'youtube_url' => '',
			'rss_url' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e('Text:', 'fairpixels'); ?></label>
			<textarea class="widefat" rows="10" cols="20" id="<?php echo esc_attr( $this->get_field_id('text') ); ?>" name="<?php echo esc_attr ( $this->get_field_name('text') ); ?>"><?php echo esc_html( $instance['text'] ); ?></textarea>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter_url' ) ); ?>"><?php _e('Twitter URL:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('twitter_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter_url') ); ?>" value="<?php echo esc_url( $instance['twitter_url'] ); ?>" />
		</div>	

		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_url' ) ); ?>"><?php _e('Facebook URL:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('facebook_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('facebook_url') ); ?>" value="<?php echo esc_url( $instance['facebook_url'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'gplus_url' ) ); ?>"><?php _e('Google+ URL:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('gplus_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('gplus_url') ); ?>" value="<?php echo esc_url( $instance['gplus_url'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest_url' ) ); ?>"><?php _e('Pinterest URL:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('pinterest_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pinterest_url') ); ?>" value="<?php echo esc_url( $instance['pinterest_url'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'dribbble_url' ) ); ?>"><?php _e('Dribbble URL:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('dribbble_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('dribbble_url') ); ?>" value="<?php echo esc_url( $instance['dribbble_url'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin_url' ) ); ?>"><?php _e('Linkedin URL:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('linkedin_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('linkedin_url') ); ?>" value="<?php echo esc_url( $instance['linkedin_url'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram_url' ) ); ?>"><?php _e('Instagram URL:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('instagram_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('instagram_url') ); ?>" value="<?php echo esc_url( $instance['instagram_url'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube_url' ) ); ?>"><?php _e('Youtube URL:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('youtube_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('youtube_url') ); ?>" value="<?php echo esc_url( $instance['youtube_url'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'rss_url' ) ); ?>"><?php _e('RSS URL:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('rss_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('rss_url') ); ?>" value="<?php echo esc_url( $instance['rss_url'] ); ?>" />
		</div>
		
	<?php
	}
}
?>