<?php
/**
 * Plugin Name: FairPixels Homepage Thumbnail Posts
 * Description: This widget allows to display latest posts on the homepage
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'fp_home_thumb_posts_widget_init');
function fp_home_thumb_posts_widget_init(){
	register_widget('fp_home_thumb_posts_widget');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class fp_home_thumb_posts_widget extends WP_widget_xxx {
	
	/**
	 * Widget setup.
	 */
	function fp_home_thumb_posts_widget(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'thumb-posts', 'description' => 'Displays the thumb posts on homepage.');
		
		/* Create the widget. */
		$this->WP_Widget('fp_home_thumb_posts_widget', 'FairPixels: Homepage Thumb Posts', $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){	
				
		extract($args);
		$widget_id = $args['widget_id'];		
		
		$title = isset($instance['title']) ? $instance['title'] : '';		
		$cat_id = isset($instance['cat_id']) ? $instance['cat_id'] : '';
		$post_ids = isset($instance['post_ids']) ? $instance['post_ids'] : '';
		$post_count = isset($instance['post_count']) ? $instance['post_count'] : '';
		$bg_color = isset($instance['bg_color']) ? $instance['bg_color'] : '';
				
		$style = '';
		if ( $bg_color ){
			$style = ' style="background: '.$bg_color.'"';
		}
		
		$ids_array = '';
		$orderby = 'date';
		
		if ( $post_count < 1 OR $post_count > 16){
			$post_count = 12;
		}
		
		if ($post_ids) {
			$ids_array = array_map( 'trim', explode( ',', $post_ids ) );
			$orderby = 'none';									
		}
		
		$args = array(
			'cat' => $cat_id,
			'post__in' => $ids_array,											
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $post_count,
			'orderby' => $orderby
		);
		
		echo $before_widget;
		?>
		
		<script>
			jQuery(document).ready(function($) {				
				$('#<?php echo esc_attr( $widget_id ); ?> .post-list').flexslider({	
					animation: "fade",							
					slideshow: false,							
					directionNav: false,  						
					controlsContainer: "#<?php echo esc_attr( $widget_id ); ?> .cat-thumb-nav",  		
					controlNav: true,   						
					smoothHeight: false,							
					animationSpeed: 800							
				});
			});
		</script>
		
		<div class="section-wrap" data-animation="fadeInLeft">
			<?php
			if ( $title ) { ?>			
				<div class="section-title"<?php echo esc_attr( $style ); ?>>
					<h4><?php echo esc_html( $title ); ?></h4>		
					<div class="cat-thumb-nav"></div>				
				</div><?php
			}
			
			$i = 0;
			$query = new WP_Query( $args );
		
			if ( $query -> have_posts() ) : ?>
				<div class="post-list">
					<ul class="slides list"><?php 
						while ( $query -> have_posts() ) : $query -> the_post();
							echo ($i % 4 === 0) ? "<li>" : null;
								
								$post_class = '';
								if ( $i % 2 == 1 ){
									$post_class = ' col-last';
								} 
								
								$i++;	?>
								
								<div class="item-post thumb-post one-half<?php echo esc_attr( $post_class ); ?>">
									<?php if ( has_post_thumbnail() ) {	?>														
										<div class="thumb compact-thumb">											
											<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'wt335_195' ); ?></a>
										</div>							
									
									<?php }									
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
							
										<div class="more"><a href="<?php the_permalink() ?>"><?php _e('Read more', 'fairpixels'); ?></a></div>
									</div>
								</div><?php
							echo ($i % 4 === 0) ? "</li>" : null;	
						endwhile;
						echo ($i % 4 !== 0) ? "</li>" : null;	 ?>
					</ul>
				</div><?php
			endif;			
			wp_reset_query();
			?>
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
		$instance['post_ids'] = $new_instance['post_ids'];		
		$instance['cat_id'] = $new_instance['cat_id'];
		$instance['post_count'] = $new_instance['post_count'];	
		$instance['bg_color'] = $new_instance['bg_color'];			
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array('title' => 'Editor\'s Pick', 'post_ids' => '', 'cat_id' => '', 'post_count' => 8, 'bg_color' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_ids' ) ); ?>"><?php _e('Post IDs:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('post_ids') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_ids') ); ?>" value="<?php echo esc_attr( $instance['post_ids'] ); ?>" />
			<p class="desc"><?php _e('If you want to display specific posts, enter post IDs', 'fairpixels'); ?></p>
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
			<p class="desc"><?php _e('If you want to display latest posts from a category', 'fairpixels'); ?></p>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>"><?php _e('Number of Posts:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('post_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_count') ); ?>" value="<?php echo esc_attr( $instance['post_count'] ); ?>" />
			<p class="desc"><?php _e('Enter number of posts you want to display', 'fairpixels'); ?></p>
		</div>
		
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#widgets-right .my-color-picker').each(function(){
					var $this = $(this);
					var myid = $this.attr('id');						
					$("#" + myid).wpColorPicker();					
				});
			});  
		</script>
		
		<div class="widget-field">
			<label for="<?php echo esc_attr( $this->get_field_id( 'bg_color' ) ); ?>"><?php _e('Color:', 'fairpixels'); ?></label>			
			<input class="my-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'bg_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bg_color' ) ); ?>" value="<?php echo esc_attr( $instance['bg_color'] ); ?>" />	
			<p class="desc"><?php _e('Select color for the section header.', 'fairpixels'); ?></p>			
		</div>
		
	<?php }
}
?>