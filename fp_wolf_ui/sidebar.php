<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package  FairPixels
 * @file     sidebar-left.php
 * @author   FairPixels Team
 * @link 	 http://fairpixels.com
 */
?> 
<?php
	$sidebar_name ="";	
	
	if ( is_single() ){
		$single_post_sidebar = get_post_meta($post->ID, 'fp_meta_sidebar_right', true);
		$sidebar_name = sanitize_title($single_post_sidebar);	
		
		if (empty( $sidebar_name)){
			$single_post_sidebar = fp_get_settings( 'fp_single_post_sidebar_right' );
			$sidebar_name = sanitize_title( $single_post_sidebar );	
		}
		
	} elseif( is_page() ){
		
		$single_page_sidebar = get_post_meta($post->ID, 'fp_meta_sidebar_right', true);
		$sidebar_name = sanitize_title($single_page_sidebar);
		
	} elseif ( is_category() ){
		$category_sidebar = fp_get_settings( 'fp_category_sidebar_right' );
		$sidebar_name = sanitize_title( $category_sidebar );	
	
	} elseif ( is_archive() ){
		$archive_sidebar = fp_get_settings( 'fp_archive_sidebar_right' );
		$sidebar_name = sanitize_title( $archive_sidebar );
	
	} elseif ( is_search() ){
		$archive_sidebar = fp_get_settings( 'fp_search_sidebar_right' );
		$sidebar_name = sanitize_title( $archive_sidebar );
	
	} else {
		$sidebar_name = 'sidebar-2';
	}
	
	if ( empty($sidebar_name) ){
		$sidebar_name = 'sidebar-2';
	}
	
?>
<div id="sidebar">
	<?php if ( ! dynamic_sidebar( $sidebar_name ) ) : ?>
		<div class="widget no-widget">
			<p><?php _e('You have not selected any widget for this sidebar. Go to your widgets section and select widgets.', 'fairpixels'); ?></p>
		</div>
	<?php endif; ?>
</div><!-- /sidebar -->
		