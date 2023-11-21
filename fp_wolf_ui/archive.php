<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package  WordPress
 * @file     author.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>

<?php get_header(); ?>

<div id="content" class="post-archive">
	<?php if ( have_posts() ) : ?>

		<div class="entry-header">
			<h1>
				<?php if ( is_day() ) : ?>
					<?php printf( __( 'Daily Archives: %s', 'fairpixels' ), '<span>' . get_the_date() . '</span>' ); ?>
				<?php elseif ( is_month() ) : ?>
					<?php printf( __( 'Monthly Archives: %s', 'fairpixels' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'fairpixels' ) ) . '</span>' ); ?>
				<?php elseif ( is_year() ) : ?>
					<?php printf( __( 'Yearly Archives: %s', 'fairpixels' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'fairpixels' ) ) . '</span>' ); ?>
				<?php else : ?>
					<?php _e( 'Blog Archives', 'fairpixels' ); ?>
				<?php endif; ?>
			</h1>
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