<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package  WordPress
 * @file     tag.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<?php get_header(); ?>

<div id="content" class="post-archive tag-archive">
	<?php if ( have_posts() ) : ?>
		
		<div class="entry-header">
			<h1><?php printf( __( 'Tag: %s', 'fairpixels' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
			
			<?php
				$tag_description = tag_description();
				if ( ! empty( $tag_description )) {
					echo apply_filters( 'tag_archive_meta', '<div class="archive-desc">' . $tag_description . '</div>' );
				}
			?>
		</div>
		
		<div class="archive-list">			
			<?php 
				while ( have_posts() ) : the_post();							
					get_template_part( 'content', 'archive' );			 
				endwhile; 
			?>
		</div>		
		<?php fp_pagination(); ?>		
			
	<?php endif; ?>
</div><!-- /content -->

<?php get_sidebar('left'); ?>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>