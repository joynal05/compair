<?php
/**
 * The template for displaying the single column featured categories.
 * Gets the category for the posts from the theme options. 
 * If no category is selected, displays the latest posts.
 *
 * @package  WordPress
 * @file     trending-topics.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>

<div class="trending-topics">
	<div class="inner-wrap">
		<?php			
			$title = fp_get_settings( 'fp_trending_tags_title' );
			$tag_ids = fp_get_settings( 'fp_trending_tag_ids' );
			$count = fp_get_settings( 'fp_trending_tag_count' );
			
			if ( $title ) { ?>
				<div class="title"><h5><?php echo esc_html( $title ); ?></h5></div><?php
			}
			
			$args = array(
				'include' => $tag_ids,
				'number'  => $count
			);
			
			$tags = get_tags($args); 
			
			if ($tags) {  ?>
				<ul class="list">					
					<?php
						foreach ($tags as $tag) {						
							echo '<li><a href="' . get_tag_link( $tag->term_id ) . '" ' . '>' . $tag->name.'</a></li>';    
						} 
					?>
				</ul><?php 
			}; 
		?>
	</div>
</div>