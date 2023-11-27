<?php
/**
 * Plugin Name: FairPixels: Featured Video
 * Plugin URI: http://fairpixels.com
 * Description: A widget that allows you embed videos into the sidebar.
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'fp_video_widget_init' );

function fp_video_widget_init() {
	register_widget( 'fp_video_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class fp_video_widget extends WP_widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_video', 'description' => __('Embed a video in the sidebar.', 'fairpixels') );

		/* Create the widget. */
		parent::__construct( 'fp_video_widget', __('FairPixels: Featured Video', 'fairpixels'), $widget_ops);
	}

	/**
	 * display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
	    $title = apply_filters('widget_title', $instance['title'] );
		echo $before_widget;

		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}
		
	   $video_embed = $instance['video_embed'];

       ?>
	   <div class="embed">
		<?php printf( __('%1$s', 'fairpixels'), $video_embed ); ?>
	   </div>
	   <?php
		
		echo $after_widget;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		$defaults = array('title' => 'Featured Video', 'video_embed' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
		?>

		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'video_embed' ) ); ?>"><?php _e('Video Code:', 'fairpixels'); ?></label>
			<textarea class="widefat" rows="10" cols="20" id="<?php echo esc_attr( $this->get_field_id('video_embed') ); ?>" name="<?php echo esc_attr ( $this->get_field_name('video_embed') ); ?>"><?php echo esc_html( $instance['video_embed'] ); ?></textarea>
			<p class="desc"><?php _e('Enter video embedding code', 'fairpixels'); ?></p>
		</div>		
		
	<?php
	}
}

?>