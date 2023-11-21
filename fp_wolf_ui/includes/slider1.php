<?php
/**
 * The template for displaying the featured slider on homepage.
 * Gets the category for the posts from the theme options. 
 * If no category is selected, displays the latest posts.
 *
 * @package  WordPress
 * @file     slider1.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 * 
 **/
?>
<?php		
	$slider_cat_id = get_post_meta($post->ID, 'fp_meta_slider_cat', true);
	$post_ids = get_post_meta($post->ID, 'fp_meta_slider_post_ids', true);	
	$slider_speed = get_post_meta($post->ID, 'fp_meta_slider_speed', true);	
	
	$slider_right_cat1_id = get_post_meta($post->ID, 'fp_meta_slider_right_cat1', true);
	$slider_right_post1_id = get_post_meta($post->ID, 'fp_meta_slider_right_post1', true);
	$slider_right_cat2_id = get_post_meta($post->ID, 'fp_meta_slider_right_cat2', true);
	$slider_right_post2_id = get_post_meta($post->ID, 'fp_meta_slider_right_post2', true);
	
	
	if ( empty( $slider_speed ) ){
		$slider_speed = 5000;
	}
?>

<div id="slider-full" class="section slider-section">
	<div class="inner-wrap">
		<script>
			jQuery(document).ready(function($) {
				$('.slider-main').show();
				$('#slider-full .slider-main').flexslider({	
					animation: "slide",					
					controlNav: false,				
					slideshow: true,	
					directionNav: true,	
					slideshowSpeed: <?php echo esc_attr( $slider_speed ); ?>,
					smoothHeight: false,
					keyboard: true,
					mousewheel: true,
					controlsContainer: "#slider-full .slider-main-nav",
				});
			});
		</script>
		<div class="slider-main slider-left" data-animation="fadeInLeft">				
			<ul class="slides">
				<?php 
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
							'posts_per_page' => 5,
							'orderby' => $orderby
						);
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
													if (strlen($excerpt) > 149){ 
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
	
		<div class="slider-right" data-animation="fadeInRight">
			<?php 
				$args = array(
					'cat' => $slider_right_cat1_id,
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1,
					'posts_per_page' => 2
				);
				
				$query = new WP_Query( $args );
				if ( $query -> have_posts() ) :
					while ( $query -> have_posts() ) : $query -> the_post();
						if ( has_post_thumbnail()) { ?>				
							<div class="item-post">
								<a href="<?php the_permalink(); ?>" >
									<?php the_post_thumbnail( 'fp370_230' ); ?>
								</a>
									
								<div class="post-info">
									<?php fp_get_cat(); ?>
									
									<div class="title">
										<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
									</div>
									
								</div>											
							</div><?php 
						}
					endwhile;
				endif;
				wp_reset_query();
			?>
		</div>
	</div>
</div>