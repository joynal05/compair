<?php
/**
 * Plugin Name: FairPixels Homepage Carousel
 * Description: This widget displays the category section on the homepage layout.
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'fp_home_carousel_widget_init');
function fp_home_carousel_widget_init(){
	register_widget('fp_home_carousel_widget');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class fp_home_carousel_widget extends WP_widget_xxx {	
	/**
	 * Widget setup.
	 */
	function fp_home_carousel_widget(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'feat-carousel', 'description' => 'Displays the carousel section on homepage.');
		
		/* Create the widget. */
		$this->WP_Widget('fp_home_carousel_widget', 'FairPixels: Homepage Carousel', $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){	
		 
		
		extract($args);
		$widget_id = $args['widget_id'];
		
		echo $before_widget;		
		$title = isset($instance['title']) ? $instance['title'] : '';
		$cat_id = isset($instance['cat_id']) ? $instance['cat_id'] : '';	
		$num_post = isset($instance['num_post']) ? $instance['num_post'] : '';		
		$post_ids = isset($instance['post_ids']) ? $instance['post_ids'] : '';
					
		$ids_array = '';
		$orderby = 'date';
	
		if ($post_ids) {
			$ids_array = array_map( 'trim', explode( ',', $post_ids ) );
			$orderby = 'none';									
		}
		
		if ( $num_post < 1 or $num_post > 20){
			$num_post = 10;		
		}
	
		$args = array(
			'cat' => $cat_id,
			'post__in' => $ids_array,											
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $num_post,
			'orderby' => $orderby
		);	
		
		$query = new WP_Query( $args );			
	?>
		
	<script>
		jQuery(document).ready(function($) {				
			$("#<?php echo esc_attr( $widget_id ); ?> .content-carousel").show();
			$('#<?php echo esc_attr( $widget_id ); ?> .content-carousel').flexslider({
				slideshow: true,							
				slideshowSpeed: 3000,   
				mousewheel: false,
				keyboard: true,
				controlNav: false,
				directionNav: true,	
				controlsContainer: "#<?php echo esc_attr( $widget_id ); ?> .cat-nav",
				animation: "slide",
				itemWidth: 230,
				itemMargin: 20,
				minItems: 1,                   
				maxItems: 3,                   
				move: 1,
			});
		});
	</script>
			
	<?php
		if ($title){ ?>			
			<div class="section-title">
				<h4><?php echo esc_html( $title ); ?></h4>
				<div class="cat-nav"></div>
			</div><?php 
		}
	?>
		
	<div class="carousel content-carousel">
		<ul class="list slides">
			<?php	
				if ( $query -> have_posts() ) :
					$last_post  = $query -> post_count -1;
					
					while ( $query -> have_posts() ) : $query -> the_post(); 
						global $post;
						
						if ( has_post_thumbnail()) { ?>				
							
							<li>
								<div class="thumb">
									<div class="overlay"></div>
									<div class="more-link"><a href="<?php the_permalink() ?>"><?php _e('Read more', 'fairpixels'); ?></a></div>
									<a href="<?php the_permalink(); ?>" >
										<?php the_post_thumbnail( 'fp300_200' ); ?>
									</a>
								</div>
								
								<div class="entry-meta meta-top">
									<span class="category">
										
										<?php 
											$category = get_the_category();
											if ($category) {
												echo '<span class="sep cat main-color-bg cat'.$category[0]->term_id.'-bg ">&nbsp;</span><a href="' . get_category_link( esc_attr( $category[0]->term_id ) ) . '">' . esc_attr( $category[0]->name ).'</a> ';
											}
										?>
									</span>
									<?php
										if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
											ec_stars_rating_archive(); 
										}
									?>									
								</div>	
							
								<h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>	
																
							</li>
							
							<?php 
						} 				
					endwhile;
				endif;		
			wp_reset_query(); ?>
		</ul>
	</div><?php
		echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;	
		$instance['title'] = $new_instance['title'];
		$instance['cat_id'] = $new_instance['cat_id'];
		$instance['num_post'] = $new_instance['num_post'];	
		$instance['post_ids'] = $new_instance['post_ids'];		
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array(
			'title' => '', 
			'cat_id' => '', 
			'num_post' => 10, 			
			'post_ids' => '', 			
		);
		$instance = wp_parse_args((array) $instance, $defaults); 
		?>				
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</div>
		
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'num_post' ) ); ?>"><?php _e('Number:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('num_post') ); ?>" name="<?php echo esc_attr( $this->get_field_name('num_post') ); ?>" value="<?php echo esc_attr( $instance['num_post'] ); ?>" />
			<p class="desc"><?php _e('Enter the number of posts you want to display', 'fairpixels'); ?></p>
		</div>	
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_ids' ) ); ?>"><?php _e('Post IDs:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('post_ids') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_ids') ); ?>" value="<?php echo esc_attr( $instance['post_ids'] ); ?>" />
			<p class="desc"><?php _e('If you want to display specific posts, enter 3 post IDs', 'fairpixels'); ?></p>
		</div>		
		
	<?php }
}



?>