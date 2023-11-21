<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package  WordPress
 * @file     content-single.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>

<div class="post-wrap">
	<div class="single-header-top">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="single-entry-media single-entry-media--v2" style="background-image:url(<?php the_post_thumbnail_url("full"); ?>);">
				<img src='<?php the_post_thumbnail_url("full"); ?>'/>
		<?php }	else { ?>
			<div class="single-entry-media">
		<?php } ?>		
				<div class="single-entry-overlay"></div>				
				<div class="single-entry-top-wrapper">
					<h1 class="single-entry-title"><?php the_title(); ?></h1>
				</div>
			</div>
	</div>
<div class="post-left-col">	
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">			 
		<?php if ( fp_get_settings( 'fp_show_post_meta' ) == 1 ){ ?>
			<div class="entry-meta">
				<?php 
					fp_get_cats(); 
					// if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
					// 	ec_stars_rating_archive(); 
					// }
				?>
				
		<?php if ( fp_get_settings( 'fp_show_post_author' ) == 1 ) { ?>
			<span class="author">
				<i class="fa fa-user"></i>
				<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
					<?php printf( __( '%s', 'fairpixels' ), get_the_author() ); ?>
				</a>
			</span>
		<?php }; 	?>
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
				<?php the_tags('<span class="tags"><i class="fa fa-tags"></i>',', ', '</span>' );?>
				
				<?php if ( fp_get_settings( 'fp_show_post_social' ) == 1 ){ ?>
				<div class="social">
					<span class="share-text">Share:</span>
					<span class="fb">
						<a href="http://facebook.com/share.php?u=<?php echo urlencode( "https://www.dubicars.com" . get_the_permalink() ); ?>&amp;t=<?php echo urlencode( get_the_title() ); ?>" target="_blank"><i class="fa fa-facebook"></i></a>						
					</span>				
					
					<span class="twitter">
						<a href="http://twitter.com/home?status=<?php echo urlencode( get_the_title() ); ?>%20<?php echo urlencode( "https://www.dubicars.com" . get_the_permalink() ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>				
					</span>
					
					<span class="gplus">
						<a href="https://plus.google.com/share?url=<?php echo urlencode( "https://www.dubicars.com" . get_the_permalink() ); ?>&amp;t=<?php echo urlencode( get_the_title() ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>		
					</span>
					
					<span class="pinterest">
						<?php
							$thumbnail = "";
							if (has_post_thumbnail() ){
								 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
								 $thumbnail = $image[0];
							}
						?>
						<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( "https://www.dubicars.com" . get_the_permalink() ); ?>&amp;media=<?php echo urlencode( "https://www.dubicars.com" . $thumbnail ); ?>&amp;description=<?php echo urlencode( get_the_title() ); ?>" target="_blank"><i class="fa fa-pinterest"></i>
						</a>
					</span>				
				</div>
			<?php } ?>
			
			</div>
		<?php } ?>
		
	</header>	
	
	<?php 
		$saved_img_ids = get_post_meta($post->ID, 'fp_meta_gallery_img_ids', true);
		if (!empty($saved_img_ids)) { ?>
			
			<script>
				jQuery(document).ready(function($) {
					
					$('.entry-slider').show();						  
					$('.entry-slider-main').flexslider({
						animation: "slide",					// animation style
						controlNav: false,					// slider thumnails class
						slideshow: true,					// enable automatic sliding
						directionNav: true,					// slider nav arrows
						slideshowSpeed: 7000,   			// slider speed in milliseconds
						smoothHeight: false,				
						keyboard: false,
						mousewheel: false,
						controlsContainer: ".slider-main-nav"
					});
				});
			</script>

			<div class="entry-slider">
				<div class="entry-slider-main">
					<ul class="list slides">
						<?php $img_ids = explode(',',$saved_img_ids);
							foreach($img_ids as $img_id) { 
								if (is_numeric($img_id)) {
									$image_attributes = wp_get_attachment_image_src( $img_id, 'fp760_390');?>
									<li><img class="attachment-fp760_390" src="<?php echo esc_url( $image_attributes[0] ); ?>"></li>
									<?php									
								}
							}
						?>
					</ul>
				</div>	
				<div class="slider-main-nav"></div>
			</div>
			
		<?php } else if ( fp_get_settings( 'fp_show_feat_img' ) == 1 ){
			
			$disable_feat_img = get_post_meta($post->ID, 'fp_meta_post_disable_featimg', true); 				
			if ( $disable_feat_img  != 1 ) { ?>					
				<!-- <div class="entry-image">
					<php the_post_thumbnail( 'fp760_390' ); ?>
				</div>				 -->
			<?php
			}
		
		} ?>
		
	<?php			
		$video_code = get_post_meta($post->ID, 'fp_meta_post_video_code', true);	
		
		if ($video_code){ ?>			
			<div class="entry-video">
				<?php 
					$allowed_html = fp_get_allowed_html_tags(); 
					echo wp_kses($video_code, $allowed_html);
				?>
			</div>					
	<?php }	?>
			
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'fairpixels' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div>
		
	<?php fp_set_post_views(get_the_ID()); ?>
</article><!-- /post-<?php the_ID(); ?> -->

<?php		
	if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){ ?>
		<div class="entry-footer clearfix">
			<div class="rating">
				<span class="text"><?php _e('Rate this', 'fairpixels'); ?></span>
				<?php ec_stars_rating(); ?>
			</div>
		</div><?php 
	} 

	if ( fp_get_settings( 'fp_show_post_author' ) == 1 ) { ?>
		<!--<div class="entry-author">	
			<div class="author-description">
				<h5><?php printf( __( '%s', 'fairpixels' ), get_the_author() ); ?></h5>
				<?php the_author_meta( 'description' ); ?>	
			</div>
		</div> -->
<?php 
	}; 	
				
	if ( fp_get_settings( 'fp_show_post_nav' ) == 1 ) { ?>
		<div class="entry-nav">
			<?php
				previous_post_link('<div class="prev-post"><i class="fa fa-chevron-left"></i><h5>%link</h5></div>');
				next_post_link('<div class="next-post"><i class="fa fa-chevron-right"></i><h5>%link</h5></div>');
			?>						
		</div>
	<?php } 
		
	if ( fp_get_settings( 'fp_show_related_posts' ) == 1 ){
		get_template_part( 'includes/related-posts' );
	}
?>
</div><!-- /post-left-col -->
<?php get_sidebar('right'); ?>

</div><!-- /post-wrap -->
