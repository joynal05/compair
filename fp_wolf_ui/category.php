<?php
/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package  WordPress
 * @file     category.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>

<?php get_header(); ?>

<div id="content" class="post-archive">
	<?php if ( have_posts() ) : ?>
		
	<div class="entry-header">
		<h1><?php	printf( __( 'Category: %s', 'fairpixels' ), '<span>' . single_cat_title( '', false ) . '</span>' );?></h1>

		<?php
			$category_description = category_description();
			if ( ! empty( $category_description )) {
				echo apply_filters( 'category_archive_meta', '<div class="archive-desc">' . $category_description . '</div>' );
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
