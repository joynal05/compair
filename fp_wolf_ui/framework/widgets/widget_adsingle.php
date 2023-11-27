<?php
/**
 * Plugin Name: FairPixels: Single Ad Widget
 * Plugin URI: http://fairpixels.com
 * Description: Widget to display ads in the sidebar of the theme.
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com
 *
 */
 
 /**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init','fp_adsingle_widget_init');

function fp_adsingle_widget_init(){
	register_widget( 'fp_adsingle_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class fp_adsingle_widget extends WP_widget{
	
	/**
	 * Widget setup.
	 */
	function __construct(){
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget_adsingle', 'description' => 'Displays Single full size ad in the sidebar.');
		
		/* Create the widget. */
		parent::__construct('fp_adsingle_widget', 'FairPixels: Sidebar Ad', $widget_ops);		
	}
	
	/**
	 *display the widget on the screen.
	 */
	function widget($args,$instance){
		extract($args);
			$title = apply_filters('widget_title', $instance['title'] );
			$link = $instance['link'];
			$image = $instance['image'];
			
			echo $before_widget;
			
			if ( $title ) {
				echo $before_title . esc_html( $title ) . $after_title;
			}
			
			if($image) { ?>	
				<div class="outer-wrap">
					<div class="in-wrap">
						<a href="<?php echo esc_url( $link ); ?>"><img src="<?php echo esc_url( $image ); ?>" alt="" /></a>
					</div>
				</div>
	  <?php }
			echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['link'] = $new_instance['link'];
		$instance['image'] = $new_instance['image'];
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance){
		$defaults = array('title' => 'Sponsor', 'link' => '#', 'image' => get_template_directory_uri().'/images/ad.jpg');
		$instance = wp_parse_args((array) $instance, $defaults);
		?>	
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php _e('Link URL:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link') ); ?>" value="<?php echo esc_url( $instance['link'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php _e('Image URL:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('image') ); ?>" value="<?php echo esc_url( $instance['image'] ); ?>" />
		</div>
				
		<?php
	}
}
?>