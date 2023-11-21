<?php
/**
 * The template for displaying the scrolling posts.
 * Gets the category for the posts from the theme options. 
 * If no category is selected, displays the latest posts.
 *
 * @package  WordPress
 * @file     ticker.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<div class="ticker-section">
	<div class="inner-wrap">	
			<script>
				jQuery(document).ready(function($) {
					
					$('.ticker').fadeIn();	
					$('.ticker').vTicker();									
					$('.ticker-next').click(function() { 
						$('.ticker').vTicker('next', {animate:true});
					});		
					
					$('.ticker-prev').click(function() { 
						$('.ticker').vTicker('prev', {animate:true});
					});
					 
				});
			</script>

			<?php 
				$title = fp_get_settings('fp_ticker_title');
				$post_ids = fp_get_settings( 'fp_ticker_post_ids' );
				$cat_ids = fp_get_settings( 'fp_ticker_cat_ids' );			
								
				if ( $title ){ ?>
					<div class="title">					
						<h5><?php echo esc_html( $title ); ?></h5>					
					</div>				
			<?php } ?>
			
		
		<div class="ticker">		
			<ul>
				<?php
										
					$args = array(
						'cat' => $cat_ids,
						'post_status' => 'publish',
						'ignore_sticky_posts' => 1,
						'posts_per_page' => 10
					);
				?>
				<?php $query = new WP_Query( $args ); ?>
					<?php if ( $query -> have_posts() ) : ?>
						<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
								<div class="sep"></div>
							</li>							
						<?php endwhile; ?>
					<?php endif; ?>
				<?php wp_reset_query();?>
			</ul>
		</div>
		
		<div class="ticker-nav">
			<div class="ticker-next"><i class="fa fa-angle-up"></i></div>
			<div class="ticker-prev"><i class="fa fa-angle-down"></i></div>
		</div>
		
	</div>
</div><!-- /ticker-section -->