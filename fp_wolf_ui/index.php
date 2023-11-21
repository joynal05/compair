<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package  WordPress
 * @file     index.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<?php get_header(); ?>

<div id="content">
	<?php if ( have_posts() ) : ?>		
		<div class="archive-list">			
			<?php 
				while ( have_posts() ) : the_post();							
					get_template_part( 'content', 'excerpt' );			 
				endwhile; 
			?>
		</div>		
		<?php fp_pagination(); ?>
	<?php endif; ?>		
</div>
<?php get_sidebar('left'); ?>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>