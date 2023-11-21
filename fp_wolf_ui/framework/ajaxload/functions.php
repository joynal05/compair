<?php

/**
 * FairPixels functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @package  WordPress
 * @file     functions.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
 
 function pbd_alp_init() {
 	global $wp_query;

 	if( !is_singular() or is_page() ) {	
 		
		wp_enqueue_script( 'pbd-alp-load-posts', get_template_directory_uri().'/framework/ajaxload/js/load-posts.js', array('jquery' ), 
'1.0', 
true);
		
		$max = '';
		$max = $wp_query->max_num_pages;
		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		
		
			
		$args = array(
			'post_status' => 'publish',
			'post_type'  => 'post',
			'paged'      => $paged				
		);
		
		$wp_query = new WP_Query($args);
		$max = $wp_query->max_num_pages;
		wp_reset_query();			
		

		$loading_text = 'Loading';		
		if ( fp_get_settings( 'fp_ajaxload_loading_text' )){
			$loading_text =  fp_get_settings( 'fp_ajaxload_loading_text' );
		}
		
		$more_text = 'Load more posts';	
		if ( fp_get_settings( 'fp_ajaxload_more_text' )){
			$more_text =  fp_get_settings( 'fp_ajaxload_more_text' );
		}
		
		$no_text = 'No more posts to show';
		if (fp_get_settings( 'fp_ajaxload_noposts_text' )){
			$no_text =  fp_get_settings( 'fp_ajaxload_noposts_text' );
		}

 		wp_localize_script(
 			'pbd-alp-load-posts',
 			'pbd_alp',
 			array(
 				'startPage' => $paged,
 				'maxPages' => $max,
 				'nextLink' => next_posts($max, false),
				'loadingText' => $loading_text,
				'moreText' => $more_text,
				'noText' => $no_text
 			)
 		);
 	}
 }
 add_action('template_redirect', 'pbd_alp_init');
