<?php
/**
 * Plugin Name: FairPixels: Sidebar Slider Widget
 * Plugin URI: http://fairpixels.com
 * Description: This widget displays latests posts featured images
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'fp_slider_widget_init');

function fp_slider_widget_init() {
	register_widget( 'fp_slider_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class fp_slider_widget extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function fp_slider_widget(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'widget_slider', 'description' => 'Displays the slider in the sidebar.');
		
		/* Create the widget. */
		$this->WP_Widget('fp_slider_widget', 'FairPixels: Sidebar Slider', $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){	
		extract($args);
		$widget_id = $args['widget_id'];
		
		$title = $instance['title'];
		$cat_id = $instance['categories'];
		$posts = $instance['posts'];
				
		$args = array(
			'cat' => $cat_id,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $posts
		);				
			
		echo $before_widget;
		if ( $title ) { ?>
			<div class="section-title widget-title">
				<h4><?php echo esc_html( $title ); ?></h4>				
				<div class="cat-nav"></div>			
			</div>		
		<?php
		}
		?>
			
		<script>
			jQuery(document).ready(function($) {				
				$(".slider-widget-posts").show();
				$('#<?php echo esc_attr( $widget_id ); ?> .slider-widget-posts').flexslider({
					animation: "slide",	
					controlNav: false,
					slideshow: true,
					directionNav: true,
					slideshowSpeed: 6000,
					smoothHeight: false,
					controlsContainer: "#<?php echo esc_attr( $widget_id ); ?> .cat-nav",
					keyboard: true,
					mousewheel: true,
				});	
			});
		</script>
			
		<div class="slider-widget-posts" >
			
			<ul class="slides">
				<?php $query = new WP_Query( $args );
					while($query->have_posts()): $query->the_post();						
						if(has_post_thumbnail()): ?>								
						<li class="thumb-post">				
							<?php							
								if ( has_post_thumbnail() ) {	?>																
									
									<a href="<?php the_permalink(); ?>" >
										<?php the_post_thumbnail( 'fp300_200' ); ?>
									</a>
									
									<?php 
										fp_get_cat(); 
											if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
												ec_stars_rating_archive(); 
										}
									?>
									<div class="entry-wrap">
										<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						
										<div class="entry-meta">
											<span class="date"><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></span>
											<?php 
												if ( comments_open() ) :
													global $post;
													$comment_count = get_comments_number( $post->ID );
													if ($comment_count > 0){ ?>	
														<span class="comments">
															<i class="fa fa-comments-o"></i>
																<?php comments_popup_link( __('', 'fairpixels'), __( '1', 'fairpixels'), __('%', 'fairpixels')); ?>	
														</span><?php
													}	
												endif; 
												
												if ( fp_get_settings( 'fp_show_post_views' ) == 1 ) {
													$view_count = fp_get_post_views(get_the_ID());

													if ( $view_count > 0) { ?>						
														<span class="views"><i class="fa fa-flash"></i><?php echo esc_html( $view_count ); ?></span><?php
													}									
												}
											
											?>
										</div>
										<p>
											<?php 
												$excerpt = get_the_excerpt();
												$trimmed_excerpt = wp_trim_words( $excerpt, 16);
												echo esc_html( $trimmed_excerpt );
											?>
										</p>
										<div class="more"><a href="<?php the_permalink() ?>"><?php _e('Read more', 'fairpixels'); ?></a></div>
									</div>						
							<?php } ?>									
						</li>														
					<?php endif;						
				endwhile; ?>
			</ul>
		</div>
							
		<?php
		echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array('title' => '', 'categories' => 'all', 'posts' => 5);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"><?php _e('Category:', 'fairpixels'); ?></label>
			
			<select id="<?php echo esc_attr( $this->get_field_id('categories') ); ?>" name="<?php echo esc_attr( $this->get_field_name('categories') ); ?>" class="widefat categories">
				<option value='all' <?php if ('' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e('All categories', 'fairpixels'); ?></option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo esc_attr( $category->term_id ); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_attr( $category->cat_name ); ?></option>
				<?php } ?>
			</select>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>"><?php _e('Number of posts:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('posts') ); ?>" name="<?php echo esc_attr( $this->get_field_name('posts') ); ?>" value="<?php echo esc_attr( $instance['posts'] ); ?>" />
		</div>
		
	<?php }
}
?>