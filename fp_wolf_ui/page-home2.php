<?php
/**
 * Template Name: Homepage 2
 * Description: A Page Template to display bloag archives with the sidebar.
 *
 * @package  WordPress
 * @file     page-home.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<?php get_header(); ?>

<div id="content">		
	<?php	
	
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		if ($paged < 2 ){		
			if ( ! dynamic_sidebar( 'homepage-2' ) ) :
			endif;
		}
		
		$list_type = get_post_meta($post->ID, 'fp_meta_postlist_type', true);
		
		if ( $list_type == 'standard' ){
			get_template_part( 'includes/post-list' );
		} elseif ( $list_type == 'ajax' ){
			get_template_part( 'includes/masonry-list' );
		}
	?>	
		
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>