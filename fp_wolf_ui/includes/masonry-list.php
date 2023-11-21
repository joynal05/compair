<?php
/**
 * The template for displaying the single column featured categories.
 * Gets the category for the posts from the theme options. 
 * If no category is selected, displays the latest posts.
 *
 * @package  WordPress
 * @file     masonry-list.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<div id="feat-postlist" class="post-list section">
	
	<?php	
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}		
	
		$args = array(
			'post_status' => 'publish',
			'post_type'  => 'post',
			'paged'      => $paged				
		);
		
		$title = get_post_meta($post->ID, 'fp_meta_postlist_title', true);
		$link_title = get_post_meta($post->ID, 'fp_meta_postlist_link_title', true);
		$link_url = get_post_meta($post->ID, 'fp_meta_postlist_link_url', true);
		
		if ($title){ ?>			
			<div class="section-title">
				<h4><?php echo esc_html( $title ); ?></h4>
				
				<?php if ( $link_title ) { ?>
					<div class="link"><a href ="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
				<?php } ?>
			</div><?php 
		}		
	?>
	
	<div class="post-list masonary-list clearfix">
		<?php 	
			$wp_query = new WP_Query( $args );			
			if ( $wp_query -> have_posts() ) :
				$i = 0;

				while ( $wp_query -> have_posts() ) : $wp_query -> the_post();
					$post_class = '';
					if ( $i % 2 == 1 ){
						$post_class = ' col-last';
					} ?>
					
					<div class="one-half<?php echo esc_attr( $post_class ); ?>">
						<?php get_template_part( 'content', 'masonry' ); ?>
					</div><?php 
					
					$i++;
				
				endwhile;
			endif; 
		?>				
	</div>
	<div class="load-more"></div>
	<?php wp_reset_query(); ?>	
</div>