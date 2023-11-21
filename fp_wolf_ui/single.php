<?php
/**
 * The Template for displaying all single posts.
 *
 * @package  WordPress
 * @file     single.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<?php get_header(); ?>

<div id="content" class="single-post">
	
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', 'single' ); ?>
		<?php comments_template( '', true ); ?>		
	<?php endwhile; // end of the loop. ?>
		
</div><!-- /content -->

<?php //get_sidebar('left'); ?>
<?php //get_sidebar('right'); ?>
<?php get_footer(); ?>