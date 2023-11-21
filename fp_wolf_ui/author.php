<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package  WordPress
 * @file     author.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<?php get_header(); ?>

<div id="content" class="post-archive author-archive">
	<?php if ( have_posts() ) : ?>
		<?php
			/* Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			 *
			 * We reset this later so we can run the loop
			 * properly with a call to rewind_posts().
			 */
			the_post();
		?>

		<div class="entry-header">
			<h1><?php printf( __( 'Author Archives: %s', 'fairpixels' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
		</div>

		<?php
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();
		?>

		<?php
			// If a user has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' )) {?>
				<div class="archive-desc entry-author">							
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), 75 ); ?>
					</div>	
				
					<div class="author-description">								
						<h5><?php printf( __( 'About %s', 'fairpixels' ), get_the_author() ); ?></h5>
							<?php the_author_meta( 'description' ); ?>																		
					</div>
				</div>
		<?php } ?>
		
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