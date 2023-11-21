<?php
/**
 * Template Name: Blog
 * Description: A Page Template to display bloag archives with the sidebar.
 *
 * @package  WordPress
 * @file     page-blog.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<?php get_header(); ?>

<div id="content" class="archive page-blog">
	
	<div class="entry-header">
		<h1><?php the_title(); ?></h1>			
	</div>
	
	<div class="entry-content page-content">		
		<?php 
			while ( have_posts() ) : the_post();		
				the_content();	
			endwhile; 
		?>					
	</div>
	
	<?php
		
		
		
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}		
	
		$ids_array = '';
		$cat_id = get_post_meta($post->ID, 'fp_meta_blogpage_cat', true);
		$post_ids = get_post_meta($post->ID, 'fp_meta_blogpage_exclude_ids', true);
		
		if ($post_ids) {
			$ids_array = array_map( 'trim', explode( ',', $post_ids ) );
		}
			
		$args = array(
			'post_status' => 'publish',
			'post_type'  => 'post',
			'cat' => $cat_id,
			'post__not_in' => $ids_array,
			'paged'      => $paged					
		);
	?>
	
			
	<div class="archive-list">			
		<?php 
			$wp_query = new WP_Query( $args );
			while ( $wp_query -> have_posts() ) : $wp_query -> the_post();									
				get_template_part( 'content', 'excerpt' );						
			endwhile; 
		?>
	</div>		
	<?php fp_pagination(); ?>
	<?php wp_reset_query();?>			
</div><!-- /content -->
<?php get_sidebar('left'); ?>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>