<?php
/**
 * Plugin Name: FairPixels: Popular Categories
 * Plugin URI: http://fairpixels.com/
 * Description: This widhet displays the popular categories.
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'fp_popular_categories_widget_init' );

function fp_popular_categories_widget_init() {
	register_widget( 'fp_popular_categories_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class fp_popular_categories_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function fp_popular_categories_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_popular_categories', 'description' => __('Displays the most popular categories. Suitable for the narrow sidebar', 'fairpixels') );

		/* Create the widget. */
		$this->WP_Widget( 'fp_popular_categories_widget', __('FairPixels: Popular Categories', 'fairpixels'), $widget_ops);
	}

	/**
	 * display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$cat_ids = isset($instance['cat_ids']) ? $instance['cat_ids'] : '';		
		$count = isset($instance['count']) ? $instance['count'] : '';

		
		if( empty( $count ) ){ 
			$count = 5; 
		}
		
		echo $before_widget;
		
		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}

        $args = array(
				'orderby'      => 'count',
				'order'        => 'DESC',
				'hide_empty'   => 1,
				'hierarchical' => 0,
				'exclude'      => '',
				'include'      => $cat_ids,
				'number'       => $count,
				'taxonomy'     => 'category',
				'pad_counts'   => false 
			);
		
		$categories = get_categories( $args );
		?>
		<ul class="list">
			<?php
			foreach ( $categories as $category ) {
				
				$cat_id = $category->term_id;			
				$fp_category_meta = get_option( "fp_category_meta_color_$cat_id" );
							
				echo '<li>';
				echo '<h6 class="alt"><i class="fa fa-folder"></i><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></h6>';
				echo '<span class="post-count">';
				echo esc_attr( $category -> count );				
				echo '</span>';
				echo '</li>';
			}		
			?>
		</ul>
		
	   <?php		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;	
		
		$instance['title'] = $new_instance['title'];
		$instance['count'] = $new_instance['count'];		
		$instance['cat_ids'] = $new_instance['cat_ids'];

		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		$defaults = array('title' => 'Popular Categories', 'count' => 10, 'cat_ids' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
	?>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php _e('Number:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count') ); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>" />
			<p class="desc"><?php _e('Number of categories to display', 'fairpixels'); ?></p>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'cat_ids' ) ); ?>"><?php _e('Category IDs:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('cat_ids') ); ?>" name="<?php echo esc_attr( $this->get_field_name('cat_ids') ); ?>" value="<?php echo esc_attr( $instance['cat_ids'] ); ?>" />
			<p class="desc"><?php _e('If you want to display specific categories. Enter category ids separated with a comma (e.g. - 1, 3, 8)', 'fairpixels'); ?></p>
		</div>
		
	<?php
	}
}
?>