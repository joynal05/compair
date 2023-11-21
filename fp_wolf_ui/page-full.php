<?php

/**
 * Template Name: Full Width
 * Description:  The template for pages with full width.
 *
 * @package  WordPress
 * @file     page-full.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
 ?>
<?php get_header(); ?>

<div id="content" class="single-page full-width">
	
	<?php if (have_posts()) : ?>
		<?php while ( have_posts() ) : the_post(); ?>				
			<?php get_template_part( 'content', 'page' ); ?>
		<?php endwhile; // end of the loop. ?>
	<?php endif ?>	

</div><!-- /content -->

<?php get_footer(); ?>