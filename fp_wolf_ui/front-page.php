<?php
/**
 * Template Name: Blog 2
 * Description: A Page Template to display bloag archives with the sidebar.
 *
 * @package  WordPress
 * @file     page-blog2.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<?php get_header(); ?>

<div id="content" class="archive page-blog">
			
	<?php
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}		

		if ($paged < 2 ){		
			if ( ! dynamic_sidebar( 'blogpage-2' ) ) :
			endif;
		}
	
		$cat_id = get_post_meta($post->ID, 'fp_meta_blogpage_cat', true);
		$post_ids = get_post_meta($post->ID, 'fp_meta_blogpage_exclude_ids', true);
		
		$ids_array = '';
		
		if ($post_ids) {
			$ids_array = array_map( 'trim', explode( ',', $post_ids ) );
		}
			
		$args = array(
			'post_status' => 'publish',
			'post_type'  => 'post',
			'cat' => $cat_id,
			'post__not_in' => $ids_array,
			'paged' => $paged					
		);
		
		$wp_query = new WP_Query( $args );
	?>
	
	<div class="blog-list">			
		<?php while ( $wp_query -> have_posts() ) : $wp_query -> the_post(); ?>
			
			<article <?php post_class(); ?> data-animation="fadeInLeft">	
	
				<?php		
					$feat_video = get_post_meta( $post->ID, 'fp_meta_post_video_code', true );
					
					if ( !empty($feat_video) ){ ?>
						<div class="thumb-wrap video-thumb">
							
							<?php
								$allowed_html = fp_get_allowed_html_tags(); 
								echo wp_kses($feat_video, $allowed_html);
							?>
						</div>
					
					<?php } else if ( has_post_thumbnail() ) {	?>
					
						
						<div class="thumb">
							<a href="<?php the_permalink() ?>">
								<?php the_post_thumbnail( 'fp760_390' ); ?>
							</a>
						</div>
						
				<?php } ?>
				
				<div class="entry-wrap">	
					
					<div class="excerpt-top">
						<?php 
							fp_get_cats(); 
							if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
								ec_stars_rating_archive(); 
							}
						?>
					</div>
													
					<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>	
					
					<div class="entry-meta">
						<span class="date"><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></span>
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
									<i class="fa fa-flash"></i><?php
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
						<?php the_tags('<span class="tags"><i class="fa fa-tags"></i>',', ', '</span>' );?>
					</div>
					
					<?php the_excerpt(); ?>	
					
					<div class="excerpt-footer">
						
						<div class="more"><a href="<?php the_permalink() ?>"><?php _e('Read more', 'fairpixels'); ?></a></div>
						<div class="inner-sep"></div>
						<div class="social">
							<span class="fb">
								<a href="http://facebook.com/share.php?u=<?php echo urlencode( "https://www.dubicars.com" . get_the_permalink() ); ?>&amp;t=<?php echo urlencode( get_the_title() ); ?>" target="_blank"><i class="fa fa-facebook"></i></a>						
							</span>			
							
							<span class="twitter">
								<a href="http://twitter.com/home?status=<?php echo urlencode( get_the_title() ); ?>%20<?php echo urlencode( "https://www.dubicars.com" . get_the_permalink() ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>				
							</span>
						</div>
						
					</div>
				
			</article><!-- /post-<?php the_ID(); ?> -->						
			
		<?php endwhile; ?>
	</div>		
	<?php fp_pagination(); ?>
	<?php wp_reset_query();?>			
</div><!-- /content -->
<?php get_sidebar('left'); ?>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>