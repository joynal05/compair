<?php
/**
 * The template for displaying content in the archive and search results template
 *
 * @package  WordPress
 * @file     content-excerpt.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>


<div class="item-post" data-animation="fadeInUp">

	<?php if ( has_post_thumbnail() ) {	?>														
		<div class="thumb">		
			<div class="overlay"></div>
			<div class="more-link"><a href="<?php the_permalink() ?>"><?php _e('Read more', 'fairpixels'); ?></a></div>
			<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'fp370_230' ); ?></a>
		</div>							
	<?php } ?>

	<div class="meta-top">
		<?php 								
			fp_get_cat(); 
			if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
				ec_stars_rating_archive(); 
			}
		?>
	</div>
		
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