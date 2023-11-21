<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package  WordPress
 * @file     search.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<?php get_header(); ?>
<div id="content" class="post-archive">
		
	<?php if ( have_posts() ) : ?>

		<div class="entry-header">
			<h1><?php printf( __( 'Search Results for: %s', 'fairpixels' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</div>

		<div class="archive-list">			
			<?php 
				while ( have_posts() ) : the_post();							
					get_template_part( 'content', 'excerpt' );			 
				endwhile; 
			?>
		</div>		
		<?php fp_pagination(); ?>

	<?php endif; ?>

</div><!-- /content -->

<?php get_sidebar('left'); ?>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>