<?php
/**
 * Plugin Name: FairPixels Homepage Popular Posts
 * Description: This widget allows to display popular posts on the homepage
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'fp_home_popular_posts_widget_init');
function fp_home_popular_posts_widget_init(){
	register_widget('fp_home_popular_posts_widget');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class fp_home_popular_posts_widget extends WP_widget {
	
	/**
	 * Widget setup.
	 */
	function __construct(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'popular-posts', 'description' => 'Displays the popular posts on homepage.');
		
		/* Create the widget. */
		parent::__construct('fp_home_popular_posts_widget', 'FairPixels: Homepage Popular Posts', $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){	
				
		extract($args);
		
		echo $before_widget;
				
		$title = isset($instance['title']) ? $instance['title'] : '';	
		$left_cat_id = isset($instance['left_cat_id']) ? $instance['left_cat_id'] : '';
		$left_order = isset($instance['left_order']) ? $instance['left_order'] : 'views';	
		$left_post_ids = isset($instance['left_post_ids']) ? $instance['left_post_ids'] : '';
		
		$right_title = isset($instance['right_title']) ? $instance['right_title'] : '';	
		$right_cat_id = isset($instance['right_cat_id']) ? $instance['right_cat_id'] : '';
		$right_order = isset($instance['right_order']) ? $instance['right_order'] : 'views';
		$right_post_ids = isset($instance['right_post_ids']) ? $instance['right_post_ids'] : '';
		$right_post_count = isset($instance['right_post_count']) ? $instance['right_post_count'] : 6;
		$bg_color = isset($instance['bg_color']) ? $instance['bg_color'] : '';
				
		$style = '';
		if ( $bg_color ){
			$style = ' style="background: '.$bg_color.'"';
		}
		
		?>
		<div class="section-wrap" data-animation="fadeInLeft">
			<?php
				if ( $title ) { ?>				
					<div class="section-title"<?php echo esc_attr( $style ); ?>>
						<h4><?php echo esc_html( $title ); ?></h4>											
					</div><?php
				}
			?>
			<div class="one-half thumb-posts">
				<?php 							
					$meta_key = '';
					$ids_array = '';
					
					if ( $left_order == 'views'){
						$meta_key = 'post_views_count';
						$orderby = 'meta_value_num';	
					} else if ( $left_order == 'comments') {
						$orderby = 'comment_count';
					} else if ( $left_order == 'random') {
						$orderby = 'rand';
					} else {
						$orderby = 'date';
					}		
					
					if ($left_post_ids) {
						$ids_array = array_map( 'trim', explode( ',', $left_post_ids ) );
						$orderby = 'post__in';									
					}
					
					$args = array(
						'cat' => $left_cat_id,
						'post__in' => $ids_array,											
						'post_status' => 'publish',
						'ignore_sticky_posts' => 1,
						'posts_per_page' => 2,
						'meta_key' => $meta_key,
						'orderby' => $orderby
					);
			
					$query = new WP_Query( $args );			
					if ( $query -> have_posts() ) :
						while ( $query -> have_posts() ) : $query -> the_post(); 
							global $post;	
							 ?>
											
							<div class="item-post thumb-post">
								
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
								
							</div>
							<?php 
						endwhile;
					endif;	
					wp_reset_query();
				?>
			</div>
		
			<div class="one-half col-last post-list">
				<?php if ( $right_title ) { ?>				
					<h4><?php echo esc_attr( $right_title ); ?></h4>
				<?php
					}
					$meta_key = '';
					$ids_array = '';
					
					if ( $right_post_count < 1 OR $right_post_count > 10){
						$right_post_count = 6;
					}
			
					if ( $right_order == 'views'){
						$meta_key = 'post_views_count';
						$orderby = 'meta_value_num';	
					} else if ( $right_order == 'comments') {
						$orderby = 'comment_count';
					} else if ( $right_order == 'random') {
						$orderby = 'rand';
					} else {
						$orderby = 'date';
					}		
					
					if ($right_post_ids) {
						$ids_array = array_map( 'trim', explode( ',', $right_post_ids ) );
						$orderby = 'post__in';									
					}
					
					$args = array(
						'cat' => $right_cat_id,
						'post__in' => $ids_array,											
						'post_status' => 'publish',
						'ignore_sticky_posts' => 1,
						'posts_per_page' => $right_post_count,
						'meta_key' => $meta_key,
						'orderby' => $orderby
					);
					
					$i = 0;
					$query = new WP_Query( $args );			
					if ( $query -> have_posts() ) :
						while ( $query -> have_posts() ) : $query -> the_post(); 
							global $post;	
							$i++;
							 ?>
											
							<div class="item-post">
								<span class="num"><?php echo esc_attr( $i ); ?></span>
								<h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
							</div>
							<?php						
						endwhile;
					endif;	
					wp_reset_query();
				?>
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
		$instance['title'] = $new_instance['title'];		
		$instance['left_post_ids'] = $new_instance['left_post_ids'];		
		$instance['left_cat_id'] = $new_instance['left_cat_id'];
		$instance['left_order'] = $new_instance['left_order'];	
		$instance['right_title'] = $new_instance['right_title'];		
		$instance['right_cat_id'] = $new_instance['right_cat_id'];
		$instance['right_order'] = $new_instance['right_order'];		
		$instance['right_post_ids'] = $new_instance['right_post_ids'];		
		$instance['right_post_count'] = $new_instance['right_post_count'];	
		$instance['bg_color'] = $new_instance['bg_color'];			
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array(
			'title' => 'Readers\'s Choice', 
			'left_post_ids' => '', 
			'left_cat_id' => '', 			
			'left_order' => 'views',
			'right_title' => 'More popular stories', 			
			'right_cat_id' => '', 
			'right_order' => 'views',			
			'right_post_ids' => '', 
			'right_post_count' => 6,
			'bg_color' => ''
			
		);
			
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			<p class="desc"><?php _e('Enter the section title.', 'fairpixels'); ?></p>	
		</div>
		
		<div class="widget-field">	
			<h4><?php _e('Left Section', 'fairpixels'); ?></h4>
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
			<p class="desc"><?php _e('If you want to display posts from a category', 'fairpixels'); ?></p>
		</div>
		
		<div class="widget-field">
			<label for="<?php echo esc_attr( $this->get_field_id( 'left_order' ) ); ?>"><?php _e('Posts Order', 'fairpixels'); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'left_order' ) );?>">			
				<option value="views" <?php selected( $instance['left_order'], 'views'); ?>><?php _e('Most Read', 'fairpixels'); ?></option>
				<option value="comments" <?php selected( $instance['left_order'], 'comments'); ?>><?php _e('Most Commented', 'fairpixels'); ?></option>	
				<option value="latest" <?php selected( $instance['left_order'], 'latest'); ?>><?php _e('Latest', 'fairpixels'); ?></option>	
				<option value="random" <?php selected( $instance['left_order'], 'random'); ?>><?php _e('Random', 'fairpixels'); ?></option>					
			</select>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'left_post_ids' ) ); ?>"><?php _e('Post IDs:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('left_post_ids') ); ?>" name="<?php echo esc_attr( $this->get_field_name('left_post_ids') ); ?>" value="<?php echo esc_attr( $instance['left_post_ids'] ); ?>" />
			<p class="desc"><?php _e('If you want to display specific posts, enter post IDs', 'fairpixels'); ?></p>
		</div>
		
		<div class="widget-field">	
			<h4><?php _e('Right Section', 'fairpixels'); ?></h4>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'right_title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('right_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('right_title') ); ?>" value="<?php echo esc_attr( $instance['right_title'] ); ?>" />
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
			<p class="desc"><?php _e('If you want to display posts from a category', 'fairpixels'); ?></p>
		</div>
		
		<div class="widget-field">
			<label for="<?php echo esc_attr( $this->get_field_id( 'right_order' ) ); ?>"><?php _e('Posts Order', 'fairpixels'); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'right_order' ) );?>">			
				<option value="views" <?php selected( $instance['right_order'], 'views'); ?>><?php _e('Most Read', 'fairpixels'); ?></option>
				<option value="comments" <?php selected( $instance['right_order'], 'comments'); ?>><?php _e('Most Commented', 'fairpixels'); ?></option>	
				<option value="latest" <?php selected( $instance['right_order'], 'latest'); ?>><?php _e('Latest', 'fairpixels'); ?></option>
				<option value="random" <?php selected( $instance['right_order'], 'random'); ?>><?php _e('Random', 'fairpixels'); ?></option>			
			</select>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'right_post_count' ) ); ?>"><?php _e('Number of Posts:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('right_post_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('right_post_count') ); ?>" value="<?php echo esc_attr( $instance['right_post_count'] ); ?>" />
			<p class="desc"><?php _e('Enter number of posts you want to display', 'fairpixels'); ?></p>
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'right_post_ids' ) ); ?>"><?php _e('Post IDs:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('right_post_ids') ); ?>" name="<?php echo esc_attr( $this->get_field_name('right_post_ids') ); ?>" value="<?php echo esc_attr( $instance['right_post_ids'] ); ?>" />
			<p class="desc"><?php _e('If you want to display specific posts, enter post IDs', 'fairpixels'); ?></p>
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