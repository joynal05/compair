<?php
/**
 * The template for displaying the featured slider on homepage.
 * Gets the category for the posts from the theme options. 
 * If no category is selected, displays the latest posts.
 *
 * @package  WordPress
 * @file     slider.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 * 
 **/
?>
<?php		
	$slider_cat_id = get_post_meta($post->ID, 'fp_meta_slider_cat', true);
	$post_ids = get_post_meta($post->ID, 'fp_meta_slider_post_ids', true);
	$slider_speed = get_post_meta($post->ID, 'fp_meta_slider_speed', true);	
	
	if ( empty( $slider_speed ) ) {
		$slider_speed = 5000;
	}
	
	$ids_array = '';
	$orderby = 'date';
	
	if ( $post_ids ) {
		$ids_array = array_map( 'trim', explode( ',', $post_ids ) );
		$orderby = 'post__in';
	}		
	
	$args = array(
		'cat' => $slider_cat_id,
		'post__in' => $ids_array,
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page' => 12,
		'orderby' => $orderby
	);
		
?>

<div class="section slider-section slider-tiles clearfix">
	<div class="inner-wrap">
		<script>
			jQuery(document).ready(function($) {
				$('.slider-tiles .slider-main').show();
				$('.slider-tiles .slider-main').flexslider({		// slider settings
					animation: "slide",								// animation style
					controlNav: false,								// slider thumnails class
					slideshow: true,								// enable automatic sliding
					directionNav: true,								// disable nav arrows
					slideshowSpeed: <?php echo esc_attr( $slider_speed ); ?>,   // slider speed
					mousewheel: false,
					keyboard: true,
					controlsContainer: ".slider-tiles .slider-nav",
					itemWidth: 265,
					itemMargin: 10,
					minItems: 2,                   
					maxItems: 4,                   
					move: 1,
				});
			});
		</script>
		<div class="slider-main">				
			<ul class="slides">
				<?php $query = new WP_Query( $args ); ?>
					<?php if ( $query -> have_posts() ) : ?>
						<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
								<?php if ( has_post_thumbnail()) { ?>				
									<li>
										<a href="<?php the_permalink(); ?>" >
											<?php the_post_thumbnail( 'fp268_390' ); ?>
										</a>
										
										<div class="default-meta">
											<?php 
												fp_get_cat();
												if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
													ec_stars_rating_archive(); 
												}
											?>
										</div>
											
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
														if (strlen($excerpt) > 149){ 
															echo '...'; 
														}
													?>	
												</p>
												<div class="more"><a href="<?php the_permalink() ?>"><?php _e('Read more', 'fairpixels'); ?></a></div>
											</div>
																		
										</div>											
									</li>					
							<?php } ?>
						<?php endwhile; ?>
					<?php endif;?>
				<?php wp_reset_query();?>	
			</ul>
			<div class="slider-nav"></div>
		</div>	
	</div>
</div>