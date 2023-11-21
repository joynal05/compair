<?php
/**
 * Plugin Name: FairPixels: Flickr Widget
 * Plugin URI: http://fairpixels.com
 * Description: This widget allows to display flickr images.
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'fp_flickr_widget_init' );

function fp_flickr_widget_init() {
	register_widget( 'fp_flickr_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class fp_flickr_widget extends WP_widget_xxx {
	
	/**
	 * Widget setup.
	 */
	function fp_flickr_widget() {
		/* Widget settings. */		
		$widget_ops = array('classname' => 'widget_flickr', 'description' => 'Displays Flickr images.' );
		
		/* Create the widget. */
		$this->WP_Widget('fp_flickr_widget', 'FairPixels: Flickr Widget ', $widget_ops);
	}

	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $flickr_id = empty($instance['flickr_id']) ? ' ' : apply_filters('widget_user', $instance['flickr_id']);
        $flickr_counter = empty($instance['flickr_counter']) ? ' ' : apply_filters('widget_counter', $instance['flickr_counter']);
		
		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}
		
        ?>
		<script type="text/javascript">
				<!--
				jQuery(document).ready(function() {                
					jQuery('.flickr_thumbs').jflickrfeed({
						limit: <?php echo esc_attr( $flickr_counter ); ?>,
						qstrings: {
							id: '<?php echo esc_attr( $flickr_id ); ?>'
						},
						itemTemplate: '<li><div class="overlay">'+
										'<a rel="lightbox[flickr-gallery]" href="{{image}}" title="{{title}}">' +
											'<img src="{{image_s}}" alt="{{title}}" width="75" height="75" />' +
										'</a>' +
									  '</div></li>'
					});
				});
				// -->
			</script>
			<div class="flickr_stream">                 
                <ul id="flickr_thumbs" class="list flickr_thumbs"></ul>
            </div>
			
		<?php
		
        echo  $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
        $instance['flickr_counter'] = strip_tags($new_instance['flickr_counter']);
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	 
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'flickr_id' => '', 'flickr_counter' => 8 ) );
	?>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_id' ) ); ?>"><?php _e('Flickr User ID:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('flickr_id') ); ?>" name="<?php echo esc_attr( $this->get_field_name('flickr_id') ); ?>" value="<?php echo esc_attr( $instance['flickr_id'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_counter' ) ); ?>"><?php _e('Number of images:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('flickr_counter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('flickr_counter') ); ?>" value="<?php echo esc_attr( $instance['flickr_counter'] ); ?>" />
		</div>
		
<?php
	}
}