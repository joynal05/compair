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

<article <?php post_class(); ?> data-animation="fadeInLeft">	
	
	<?php if ( has_post_thumbnail() ) {	?>		
			<div class="thumb abc">
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'full' ); ?></a>
			</div>	
	<?php } ?>
	
	<div class="post-right">	
		
		<div class="excerpt-top">
			<?php 
				fp_get_cats(); 
				if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
					ec_stars_rating_archive(); 
				}
			?>
		</div>
										
		<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>	
		
		<div class="entry-meta">
			<?php 
				$updateTxt = "Updated date: ".get_the_modified_date();
				if (ICL_LANGUAGE_CODE === 'ar') {
					$updateTxt = get_the_modified_date()." :تاريخ التحديث ";
				}
				?>
				<span class="date">
					<i class="fa fa-clock-o"></i>
					<?php if(get_the_date() == get_the_modified_date()) : ?>
						<?php echo get_the_date(); ?>
					<?php else: ?>
						<?php echo $updateTxt;?>
					<?php endif; ?>
				</span>
			<?php 
				if ( comments_open() ) :
					$comment_count = get_comments_number($post->ID);
					if ($comment_count > 0){ ?>	
						<span class="comments">
							<i class="fa fa-comments-o"></i>
								<?php comments_popup_link( __('', 'fairpixels'), __( '1 comment', 'fairpixels'), __('% comments', 'fairpixels')); ?>	
						</span><?php
					}	
				endif; 
				
				if ( fp_get_settings( 'fp_show_post_views' ) == 1 ) {
					$view_count = fp_get_post_views(get_the_ID());

					if ( $view_count > 0) { ?>						
						<span class="views">
						<i class="fa fa-eye"></i><?php
							echo esc_html( $view_count ) . ' ';
						
							if ($view_count > 1 ){
								_e('views', 'fairpixels');
							} else {
								_e('view', 'fairpixels');
							} ?>
						</span><?php
					}									
				}
			
			?>
		</div>
		
		<?php 
			$excerpt = get_the_excerpt();
			$trimmed_excerpt = wp_trim_words( $excerpt, 20);
			echo esc_html( $trimmed_excerpt );
		?>	

		<div class="excerpt-footer">			
			<div class="more"><a href="<?php the_permalink() ?>"><?php _e('Read more', 'fairpixels'); ?></a></div>
			<div class="inner-sep"></div>
		</div>
		
	</div>
	
</article><!-- /post-<?php the_ID(); ?> -->