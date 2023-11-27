<?php
/**
 * Plugin Name: FairPixels Category 1
 * Description: This widget displays the category section on the homepage 1 layout.
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'fp_home_cat1_widget_init');
function fp_home_cat1_widget_init(){
	register_widget('fp_home_cat1_widget');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class fp_home_cat1_widget extends WP_widget {	
	/**
	 * Widget setup.
	 */
	function __construct(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'feat-cat feat-cat1', 'description' => 'Displays the category section on homepage. Use it in the Homepage sidebar.');
		
		/* Create the widget. */
		parent::__construct('fp_home_cat1_widget', 'FairPixels: Homepage Category 1', $widget_ops);
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
		$color = isset($instance['color']) ? $instance['color'] : '';	
		
		$args = array(
			'cat' => $cat_id,					
			'post_status' => 'publish',			
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1
		);
		
		$style = '';
		if ( $color ){
			$style = ' style = "background: '.$color.'"';
		}
		
		$query = new WP_Query( $args );		
		?>
		
		<script>
			jQuery(document).ready(function($) {				
				$('#<?php echo esc_attr( $widget_id ); ?> .post-list').flexslider({	
					animation: "slide",							
					slideshow: false,							
					directionNav: true,  						
					controlsContainer: "#<?php echo esc_attr( $widget_id ); ?> .cat-nav",  		
					controlNav: false,   						
					smoothHeight: false,							
					animationSpeed: 800							
				});
			});
		</script>
		
		<div class="cat-wrap" data-animation="fadeInLeft">
			<?php
			
			if ($title){ ?>			
				<div class="section-title"<?php echo esc_attr( $style ); ?>>
					<h4><?php echo esc_html( $title ); ?></h4>				
					<div class="cat-nav"></div>			
				</div><?php 
			}
		
			if ( $query -> have_posts() ) :
				$last_post  = $query -> post_count -1;
				
				while ( $query -> have_posts() ) : $query -> the_post(); 
					global $post; ?>
					
						<div class="main-post one-half">
							
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
							
							
							
							<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>									
							
							<div class="entry-meta">
								<span class="date"><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></span>
								<?php if ( comments_open() ) : ?>
									<span class="comments">
									<i class="fa fa-comments"></i>
									<?php comments_popup_link( __('no comments', 'fairpixels'), __( '1 comment', 'fairpixels'), __('% comments', 'fairpixels')); ?></span>		
								<?php endif; ?>
							</div>
								
							<p>
								<?php 
									$excerpt = get_the_excerpt();
									$trimmed_excerpt = wp_trim_words( $excerpt, 16);
									echo esc_html( $trimmed_excerpt );
								?>
							</p>						
		
						</div> <?php
				
				endwhile;
			endif;			
			wp_reset_query();			
			
			$args = array(
					'cat' => $cat_id,
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1,
					'posts_per_page' => 12,
					'offset' => 1
				);
			$query = new WP_Query( $args );
			
			if ( $query -> have_posts() ) : ?>
				<div class="post-list one-half col-last">
					<ul class="slides list"><?php 
						$i = 0 ;
						while ( $query -> have_posts() ) : $query -> the_post();
							echo ($i % 4 === 0) ? "<li>" : null;
								$i++;	?>
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
		$instance['cat_id'] = $new_instance['cat_id'];
		$instance['color'] = $new_instance['color'];	
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
			'color' => '', 
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

		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('#widgets-right .bg-color').wpColorPicker();
			});  
		</script>
		<div class="widget-field">
			<label for="<?php echo esc_attr( $this->get_field_id('color') ); ?>"><?php _e('Color:', 'fairpixels'); ?></label> 
			<input class="widefat widget-color bg-color" id="<?php echo esc_attr( $this->get_field_id('color') ); ?>" name="<?php echo esc_attr( $this->get_field_name('color') ); ?>" type="text" value="<?php if($instance['color']) { echo esc_attr( $instance['color'] ); } ?>" />
		
		</div>
		
	<?php }
}
?>