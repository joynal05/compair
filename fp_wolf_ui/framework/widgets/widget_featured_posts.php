<?php
/**
 * Plugin Name: FairPixels: Recent Posts
 * Plugin URI: http://fairpixels.com/
 * Description: This widhet displays the most recent posts with thumbnails
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'fairpixels_register_feat_posts_widget' );

function fairpixels_register_feat_posts_widget() {
	register_widget( 'fairpixels_feat_posts_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class fairpixels_feat_posts_widget extends WP_widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-feat-posts widget-postlist', 'description' => __('Displays the featured posts with one main post and rest of the posts with small thumbnails.', 'fairpixels') );

		/* Create the widget. */
		parent::__construct( 'fairpixels_feat_posts_widget', __('FairPixels: Featured Posts', 'fairpixels'), $widget_ops);
	}

	/**
	 *display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$title = isset($instance['title']) ? $instance['title'] : '';
		$entries_display = isset($instance['entries_display']) ? $instance['entries_display'] : '';
		$cat_id = isset($instance['category']) ? $instance['category'] : '';
		$post_ids = isset($instance['post_ids']) ? $instance['post_ids'] : '';
				
		if ($entries_display < 1 OR $entries_display > 10){
			$entries_display = 3; 
		}
		
		$ids_array = '';
		$orderby = 'date';
		
		if ( $post_ids ) {
			$ids_array = array_map( 'trim', explode( ',', $post_ids ) );
			$orderby = 'post__in';
		}	
		
		$args = array(
			'cat' => $cat_id,
			'post__in' => $ids_array,
			'post_type' => 'post',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $entries_display,
			'orderby' => $orderby			
		);	
		
		echo $before_widget;
		
		echo $before_title;
        echo esc_html( $title );
		echo $after_title;
		$i = 0;
		$query = new WP_Query( $args );
		if ( $query -> have_posts() ) :
			while ( $query -> have_posts() ) : $query -> the_post();
				$i++;
				if ( $query->current_post == 0 ) { 
					global $post; ?>			
					
					<div class="main-post thumb-post">
						
						<?php if ( has_post_thumbnail() ) {	?>														
							<div class="thumb">											
								<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'fp370_230' ); ?></a>
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
							<p>
								<?php 
									$excerpt = get_the_excerpt();
									$trimmed_excerpt = wp_trim_words( $excerpt, 16);
									echo esc_html( $trimmed_excerpt );
								?>
							</p>
							
							<div class="more"><a href="<?php the_permalink() ?>"><?php _e('Read more', 'fairpixels'); ?></a></div>
						</div>					
						
					</div>
				<?php } ?>
				
				<?php if ( $query->current_post >= 1 ) { ?>											
					
					<div class="item-post">
						<?php if ( has_post_thumbnail() ) {	?>
							<div class="thumb thumb-70">
								<div class="overlay"></div>
								<div class="more-link link-icon"><a href="<?php the_permalink() ?>"><i class="fa fa-plus"></i></a></div>
								<a href="<?php the_permalink(); ?>" >
									<?php the_post_thumbnail( 'fp70_70' ); ?>
								</a>
							</div>
						<?php } ?>	
						
						<div class="entry-right">
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
							<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
							<div class="entry-meta">
								<span class="date"><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></span>
								<?php 
									if ( comments_open() ) :
										$comment_count = get_comments_number($post->ID);
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
						</div>
					</div>					
					
				<?php }				
				endwhile;
			endif;
		wp_reset_query();
				
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['entries_display'] = strip_tags($new_instance['entries_display']);
        $instance['cat_id'] = strip_tags($new_instance['cat_id']);
		$instance['post_ids'] = strip_tags($new_instance['post_ids']);
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		$defaults = array('title' => 'Featured Posts', 'entries_display' => 3, 'category' => '', 'post_ids' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
	?>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>"><?php _e('Category IDs:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('cat_id') ); ?>" name="<?php echo esc_attr( $this->get_field_name('cat_id') ); ?>" value="<?php echo esc_attr( $instance['cat_id'] ); ?>" />
			<p class="desc"><?php _e('If you want to display specific category posts, enter category ids separated with a comma', 'fairpixels'); ?></p>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'entries_display' ) ); ?>"><?php _e('Number of Posts:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('entries_display') ); ?>" name="<?php echo esc_attr( $this->get_field_name('entries_display') ); ?>" value="<?php echo esc_attr( $instance['entries_display'] ); ?>" />
			<p class="desc"><?php _e('Number of posts you want to display', 'fairpixels'); ?></p>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_ids' ) ); ?>"><?php _e('Post IDs:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('post_ids') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_ids') ); ?>" value="<?php echo esc_attr( $instance['post_ids'] ); ?>" />
			<p class="desc"><?php _e('If you want to display specific posts, enter post IDs separated by commas', 'fairpixels'); ?></p>
		</div>
		
	<?php
	}
}
?>