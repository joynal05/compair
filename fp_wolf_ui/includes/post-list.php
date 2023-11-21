<?php
/**
 * The template for displaying the single column featured categories.
 * Gets the category for the posts from the theme options. 
 * If no category is selected, displays the latest posts.
 *
 * @package  WordPress
 * @file     feat-post.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<div id="feat-postlist" class="post-list section">
	<?php
		$title = get_post_meta($post->ID, 'fp_meta_postlist_title', true);		
		$cat_id = get_post_meta($post->ID, 'fp_meta_postlist_cat', true);		
		$count = get_post_meta($post->ID, 'fp_meta_postlist_count', true);
		
		$link_title = get_post_meta($post->ID, 'fp_meta_postlist_link_title', true);
		$link_url = get_post_meta($post->ID, 'fp_meta_postlist_link_url', true);
		
		$show_pagination = 0;
		
		if ( $count < 1 or $count > 20 ){
			$show_pagination = 1;
			$count = get_option('posts_per_page');
		}
		
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}		
	
		$args = array(
			'cat' => $cat_id,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count,
			'paged' => $paged,		
		);
			
		if ($title){ ?>			
			<div class="section-title">
				<h4><?php echo esc_html( $title ); ?></h4>
				
				<?php if ( $link_title ) { ?>
					<div class="link"><a href ="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
				<?php } ?>
			</div><?php 
		}
	?>
	
	<div class="archive-list">
		<?php 
			$wp_query = new WP_Query( $args );			
			while ( $wp_query -> have_posts() ) : $wp_query -> the_post();			
				get_template_part( 'content', 'excerpt' );									
			endwhile; 
		?>
	</div>
	<?php 
		if ($show_pagination == 1){
			fp_pagination(); 
		}
	?>
	<?php wp_reset_query(); ?>		
</div>