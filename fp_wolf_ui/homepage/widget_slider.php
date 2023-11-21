<?php
/**
 * Plugin Name: FairPixels Home Slider
 * Description: This widget displays the category section on the homepage 2 layout.
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'fp_home_slider_widget_init');
function fp_home_slider_widget_init(){
	register_widget('fp_home_slider_widget');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class fp_home_slider_widget extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function fp_home_slider_widget(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'feat-slider', 'description' => 'Displays the slider section within the content area on homepage.');
		
		/* Create the widget. */
		$this->WP_Widget('fp_home_slider_widget', 'FairPixels: Homepage Slider', $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){	
		 
		
		extract($args);
		$widget_id = $args['widget_id'];
		
		echo $before_widget;
		$cat_id = isset($instance['cat_id']) ? $instance['cat_id'] : '';		
		$post_ids = isset($instance['post_ids']) ? $instance['post_ids'] : '';
		$post_count = isset($instance['post_count']) ? $instance['post_count'] : '';
		
		$ids_array = '';
		$orderby = 'date';
	
		if ($post_ids) {
			$ids_array = array_map( 'trim', explode( ',', $post_ids ) );
			$orderby = 'post__in';									
		}
	
		$args = array(
			'cat' => $cat_id,
			'post__in' => $ids_array,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 5,
			'orderby' => $orderby
		);
		
	?>
	<script>
		jQuery(document).ready(function($) {
			$('.slider-main').show();
			$('#<?php echo esc_attr( $widget_id ); ?> .slider-main').flexslider({			
				animation: "slide",					// animation style
				controlNav: false,					// slider thumnails class
				slideshow: true,					// enable automatic sliding
				directionNav: true,					// slider nav arrows
				slideshowSpeed: 7000,   			// slider speed in milliseconds
				smoothHeight: false,				
				keyboard: false,
				mousewheel: false,
				controlsContainer: "#<?php echo esc_attr( $widget_id ); ?> .slider-main-nav"
			});
		});
	</script>
	
	<div class="slider-section slider-main slider-left" data-animation="fadeInLeft">				
		<ul class="slides list">
			<?php 
				$query = new WP_Query( $args );
				if ( $query -> have_posts() ) :
					while ( $query -> have_posts() ) : $query -> the_post();
						if ( has_post_thumbnail()) { ?>				
							<li>
								<a href="<?php the_permalink(); ?>" >
									<?php the_post_thumbnail( 'fp760_390' ); ?>
								</a>
										
								<div class="post-info">
									<?php 
										fp_get_cat();
										if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
											ec_stars_rating_archive(); 
										}
									?>
								
									<div class="title">
										<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
									</div>								
									
									<div class="post-excerpt">											
										<p>
											<?php 
												$excerpt = get_the_excerpt();
												echo mb_substr($excerpt,0, 150);
												if ( strlen($excerpt) > 149 ){ 
													echo '...'; 
												}
											?>	
										</p>
										<div class="more"><a href="<?php the_permalink() ?>"><i class="fa fa-arrow-right"></i></a></div>
									</div>
																										
								</div>											
							</li><?php 
						}
					endwhile;
				endif;
			wp_reset_query();
			?>	
		</ul>
		<div class="slider-main-nav"></div>
	</div>			
		<?php
		echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;	
		$instance['cat_id'] = $new_instance['cat_id'];
		$instance['post_ids'] = $new_instance['post_ids'];		
		$instance['post_count'] = $new_instance['post_count'];

		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array(
			'cat_id' => '', 
			'post_ids' => '', 
			'post_count' => 5
		);
		$instance = wp_parse_args((array) $instance, $defaults); 
		?>				
		
		
		<div class="widget-field">	
			<label for="<?php echo esc_attr( $this->get_field_id('cat_id') ); ?>"><?php _e('Category:', 'fairpixels'); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('cat_id') ); ?>" name="<?php echo esc_attr( $this->get_field_name('cat_id') ); ?>" class="widefat categories">
				<option value='' <?php if ('' == $instance['cat_id']) echo 'selected="selected"'; ?>><?php _e('All categories', 'fairpixels'); ?></option>
				<?php $categories = get_categories('hide_empty=1'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo esc_attr( $category->term_id ); ?>' <?php if ($category->term_id == $instance['cat_id']) echo 'selected="selected"'; ?>><?php echo esc_attr( $category->cat_name ); ?></option>
				<?php } ?>
			</select>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_ids' ) ); ?>"><?php _e('Post IDs:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('post_ids') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_ids') ); ?>" value="<?php echo esc_attr( $instance['post_ids'] ); ?>" />
			<p class="desc"><?php _e('If you want to display specific posts, enter 3 post IDs', 'fairpixels'); ?></p>
		</div>	
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>"><?php _e('Number of Posts:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('post_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_count') ); ?>" value="<?php echo esc_attr( $instance['post_count'] ); ?>" />
			<p class="desc"><?php _e('Enter number of posts you want to display', 'fairpixels'); ?></p>
		</div>
		
	<?php }
}
?>