<?php
/**
 * Plugin Name: FairPixels Single Categories
 * Description: This widget displays the single categories section on the homepage.
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'fp_single_cats_widget_init');
function fp_single_cats_widget_init(){
	register_widget('fp_single_cats_widget');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class fp_single_cats_widget extends WP_widget_xxx {
	
	/**
	 * Widget setup.
	 */
	function fp_single_cats_widget(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'feat-cat single-cats', 'description' => 'Displays the single categories section on homepage.');
		
		/* Create the widget. */
		$this->WP_Widget('fp_single_cats_widget', 'FairPixels: Homepage Single Categories', $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){		 
		
		extract($args);
		$widget_id = $args['widget_id'];
		
		echo $before_widget;
		
		$left_title = isset($instance['left_title']) ? $instance['left_title'] : '';	
		$left_cat_id = isset($instance['left_cat_id']) ? $instance['left_cat_id'] : '';		
		$left_post_ids = isset($instance['left_post_ids']) ? $instance['left_post_ids'] : '';	
		
		$right_title = isset($instance['right_title']) ? $instance['right_title'] : '';
		$right_cat_id = isset($instance['right_cat_id']) ? $instance['right_cat_id'] : '';
		$right_post_ids = isset($instance['right_post_ids']) ? $instance['right_post_ids'] : '';
		
	?>
		
		
	<div class="cat-wrap">
		<div class="one-half" data-animation="fadeInLeft">
			<div class="section-title">
				<?php
					if ( $left_title ){ ?>					
						<h4><?php echo esc_html( $left_title ); ?></h4><?php												
					} else if ( $left_cat_id ) {
						$cat_url = get_category_link( $left_cat_id );
						$cat_name = get_cat_name( $left_cat_id); ?>
						<h4><a href="<?php echo esc_url( $cat_url ); ?>"><?php echo esc_html( $cat_name ); ?></a></h4><?php
					}					
				?>
			</div><?php				
			
			$ids_array = '';
			$orderby = 'date';
		
			if ($left_post_ids) {
				$ids_array = array_map( 'trim', explode( ',', $left_post_ids ) );
				$orderby = 'post__in';									
			}
		
			$args = array(
				'cat' => $left_cat_id,
				'post__in' => $ids_array,					
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page' => 3,
				'orderby' => $orderby
			);
		
			$query = new WP_Query( $args );
		
			if ( $query -> have_posts() ) :
				$last_post  = $query -> post_count -1;
			
				while ( $query -> have_posts() ) : $query -> the_post(); 
					global $post;
				
					if ( $query->current_post == 0 ) { ?>						
						<div class="main-post">
							<?php if ( has_post_thumbnail() ) {	?>														
								<div class="thumb">		
									<div class="overlay"></div>
									<div class="more-link"><a href="<?php the_permalink() ?>"><?php _e('Read more', 'fairpixels'); ?></a></div>
									<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'fp370_230' ); ?></a>
									
									<?php 								
										fp_get_cat(); 
										if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
											ec_stars_rating_archive(); 
										}
									?>
								</div>							
							<?php } ?>
														
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

							</div>							
						</div>
					<?php }
					if ( $query->current_post == 1 ) { ?>
					<div class="post-list">
						<?php } 
							if ( $query->current_post >= 1 ) { ?>	
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
										<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
										<div class="entry-meta">
											<span class="date"><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></span>
											<?php 
												if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
													ec_stars_rating_archive(); 
												}											
											?>
										</div>
									</div>
									
								</div><?php 
							} 
							
							if (( $query->post_count  > 1) AND ( $query->post_count  < 3) AND ($query->current_post == $last_post )) { ?>
					</div><?php 
					
					} 
					
					if ( ( $query->post_count  == 3) AND ($query->current_post == $last_post )) { ?>
					</div><?php 
				} 
				
				endwhile; 
			endif; 
		wp_reset_query(); ?>
	</div>	
		
	<div class="one-half col-last" data-animation="fadeInRight">
				
		<div class="section-title">
			<?php
				if ($right_title){ ?>					
					<h4><?php echo esc_html( $right_title ); ?></h4><?php												
				} else if ( $right_cat_id ) {
					$cat_url = get_category_link($right_cat_id );
					$cat_name = get_cat_name($right_cat_id); ?>
					<h4><a href="<?php echo esc_url( $cat_url ); ?>"><?php echo esc_html( $cat_name ); ?></a></h4><?php
				}					
			?>
		</div><?php
		
		$ids_array = '';
		$orderby = 'date';
	
		if ($right_post_ids) {
			$ids_array = array_map( 'trim', explode( ',', $right_post_ids ) );
			$orderby = 'post__in';									
		}
	
		$args = array(
			'cat' => $right_cat_id,
			'post__in' => $ids_array,					
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 3,
			'orderby' => $orderby
		);
	
		$query = new WP_Query( $args );
	
		if ( $query -> have_posts() ) :
			$last_post  = $query -> post_count -1;
		
			while ( $query -> have_posts() ) : $query -> the_post(); 
				global $post;
			
				if ( $query->current_post == 0 ) { ?>						
					<div class="main-post">
						<?php if ( has_post_thumbnail() ) {	?>														
							<div class="thumb">		
								<div class="overlay"></div>
								<div class="more-link"><a href="<?php the_permalink() ?>"><?php _e('Read more', 'fairpixels'); ?></a></div>
								<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'fp370_230' ); ?></a>
																
								<?php 								
									fp_get_cat(); 
									if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
										ec_stars_rating_archive(); 
									}
								?>
								
							</div>	
							
						<?php } ?>
							
						
								
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

						</div>						
					</div>
				<?php }
				if ( $query->current_post == 1 ) { ?>
				<div class="post-list">
					<?php } 
						if ( $query->current_post >= 1 ) { ?>	
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
										<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
										<div class="entry-meta">
											<span class="date"><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></span>
											<?php 
												if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
													ec_stars_rating_archive(); 
												}											
											?>
										</div>
									</div>
								
							</div><?php 
						} 
						
						if (( $query->post_count  > 1) AND ( $query->post_count  < 3) AND ($query->current_post == $last_post )) { ?>
				</div><?php 
				
				} 
				
				if ( ( $query->post_count  == 3) AND ($query->current_post == $last_post )) { ?>
				</div><?php 
			} 
			
			endwhile; 
		endif; 
		wp_reset_query(); ?>
	</div>			
</div>		
<?php
	echo $after_widget;
}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;	
		$instance['left_title'] = $new_instance['left_title'];		
		$instance['left_cat_id'] = $new_instance['left_cat_id'];
		$instance['left_post_ids'] = $new_instance['left_post_ids'];
		$instance['right_title'] = $new_instance['right_title'];		
		$instance['right_cat_id'] = $new_instance['right_cat_id'];
		$instance['right_post_ids'] = $new_instance['right_post_ids'];
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array(
			'left_title' => '', 
			'left_cat_id' => '', 
			'left_post_ids' => '',
			'right_title' => '', 
			'right_cat_id' => '', 
			'right_post_ids' => ''			
		);
		$instance = wp_parse_args((array) $instance, $defaults); 
		?>				
		
		<div class="widget-field">	
			<h4 class="section-title"><?php _e('Left Category Section', 'fairpixels'); ?></h4>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'left_title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('left_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('left_title') ); ?>" value="<?php echo esc_attr( $instance['left_title'] ); ?>" />
			<p class="desc"><?php _e('Enter the left section title', 'fairpixels'); ?></p>
		</div>		
		
		<div class="widget-field">	
			<label for="<?php echo esc_attr( $this->get_field_id('left_cat_id') ); ?>"><?php _e('Category:', 'fairpixels'); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('left_cat_id') ); ?>" name="<?php echo esc_attr( $this->get_field_name('left_cat_id') ); ?>" class="widefat categories">
				<option value='' <?php if ('' == $instance['left_cat_id']) echo 'selected="selected"'; ?>><?php _e('All categories', 'fairpixels'); ?></option>
				<?php $categories = get_categories('hide_empty=1'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo esc_attr( $category->term_id ); ?>' <?php if ($category->term_id == $instance['left_cat_id']) echo 'selected="selected"'; ?>><?php echo esc_attr( $category->cat_name ); ?></option>
				<?php } ?>
			</select>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'left_post_ids' ) ); ?>"><?php _e('Post IDs:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('left_post_ids') ); ?>" name="<?php echo esc_attr( $this->get_field_name('left_post_ids') ); ?>" value="<?php echo esc_attr( $instance['left_post_ids'] ); ?>" />
			<p class="desc"><?php _e('If you want to display specific posts, enter 3 post IDs', 'fairpixels'); ?></p>
		</div>	

		<div class="widget-field">	
			<h4 class="section-title"><?php _e('Right Category Section', 'fairpixels'); ?></h4>
		</div>

		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'right_title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('right_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('right_title') ); ?>" value="<?php echo esc_attr( $instance['right_title'] ); ?>" />
			<p class="desc"><?php _e('Enter the right section title', 'fairpixels'); ?></p>
		</div>
		
		<div class="widget-field">	
			<label for="<?php echo esc_attr( $this->get_field_id('right_cat_id') ); ?>"><?php _e('Category:', 'fairpixels'); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('right_cat_id') ); ?>" name="<?php echo esc_attr( $this->get_field_name('right_cat_id') ); ?>" class="widefat categories">
				<option value='' <?php if ('' == $instance['right_cat_id']) echo 'selected="selected"'; ?>><?php _e('All categories', 'fairpixels'); ?></option>
				<?php $categories = get_categories('hide_empty=1'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo esc_attr( $category->term_id ); ?>' <?php if ($category->term_id == $instance['right_cat_id']) echo 'selected="selected"'; ?>><?php echo esc_attr( $category->cat_name ); ?></option>
				<?php } ?>
			</select>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'right_post_ids' ) ); ?>"><?php _e('Post IDs:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('right_post_ids') ); ?>" name="<?php echo esc_attr( $this->get_field_name('right_post_ids') ); ?>" value="<?php echo esc_attr( $instance['right_post_ids'] ); ?>" />
			<p class="desc"><?php _e('If you want to display specific posts, enter 3 post IDs', 'fairpixels'); ?></p>
		</div>
		
	<?php }
}
?>