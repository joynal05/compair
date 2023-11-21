<?php
/**
 * The template for displaying the featured slider on homepage.
 * Gets the category for the posts from the theme options. 
 * If no category is selected, displays the latest posts.
 *
 * @package  FairPixels
 * @file     slider-full.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 * 
 **/
?>
<?php		
	$cat_id = get_post_meta($post->ID, 'fp_meta_slider_cat', true);
	$post_ids = get_post_meta($post->ID, 'fp_meta_slider_post_ids', true);
	$count = get_post_meta($post->ID, 'fp_meta_slider_count', true);
	
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
		'posts_per_page' => $count,
		'orderby' => $orderby
	);
		
?>
<div class="slider-full section">
	<div class="inner-wrap">
		<script>
			(function($) {
				"use strict";
				
				$(document).ready(function() {
				
					$(function () {
					  var $highlight = function() { 
						var $this = $(".slider-posts");
						var items = $this.triggerHandler("currentVisible");
						$this.children().removeClass("active", 100);
						$this.children().addClass("inactive", 100);
						items.filter(":eq(1)").addClass("active", 100).removeClass("inactive", 100);
					  }
					  
						$('.slider-posts').carouFredSel({
							width: '100%',
							align: 'center',
							onTouch: true,
							items: {
								visible: 3,
								start: -1
							},
							scroll: {
								items: 1,
								duration: 800,
								timeoutDuration: 3000,
						  onAfter : $highlight,
							},
						prev : {
						  button : ".slider-full .prev",
						  key : "left"
						},
						next : {
						  button : ".slider-full .next",
						  key : "right"
						}
						});
					  
					  });	  
				});
				
			})(jQuery); 
		</script>
	<a href="#" class="prev"><i class="fa fa-angle-left"></i></a>
		<div class="slider-posts">
			
			<?php
				$query = new WP_Query( $args );
				if ( $query -> have_posts() ) :
					while ( $query -> have_posts() ) : $query -> the_post();
						if ( has_post_thumbnail()) { ?>	
							<div class="slide inactive">
														
								<div class="slide-wrap">
								
									<div class="thumb">
										<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'fp760_390' ); ?></a>
									</div>
									
									<div class="slide-overlay">
										
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
									</div>
								
								</div>						
								
							</div><?php	
						}
					endwhile;
				endif;
				wp_reset_query();								
			?>
		</div>
		<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
	</div>
</div>