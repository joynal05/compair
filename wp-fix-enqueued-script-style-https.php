<?php
/**
 * Plugin Name: https Fix for enqueue scripts/styles
 */
 
// Fix some badly enqueued scripts with no sense of HTTPS for the back end only.
// Kudos to http://snippets.webaware.com.au/snippets/cleaning-up-wordpress-plugin-script-and-stylesheet-loads-over-ssl/
add_action( 'wp_print_scripts', 'fb_enqueueScriptsFix', 100 );
add_action( 'wp_print_styles', 'fb_enqueueStylesFix', 100 );

/**
 * Force plugins to load scripts with SSL if page is SSL.
 */
function fb_enqueueScriptsFix() {

	if ( ! is_admin() ) {
		return;
	}

	$https_values = array( NULL, 'off' );
	if ( ! isset( $_SERVER[ 'HTTPS' ] ) || in_array( $_SERVER[ 'HTTPS' ], $https_values ) ) {
		return;
	}

	foreach ( (array) $GLOBALS[ 'wp_scripts' ]->registered as $script ) {
		if ( FALSE !== stripos( $script->src, 'http://', 0 ) ) {
			$script->src = str_replace( 'http://', 'https://', $script->src );
		}
	}
}

/**
 * Force plugins to load styles with SSL if page is SSL.
 */
function fb_enqueueStylesFix() {

	if ( ! is_admin() ) {
		return;
	}

	$https_values = array( NULL, 'off' );
	if ( ! isset( $_SERVER[ 'HTTPS' ] ) || in_array( $_SERVER[ 'HTTPS' ], $https_values ) ) {
		return;
	}

	foreach ( (array) $GLOBALS[ 'wp_styles' ]->registered as $script ) {
		if ( FALSE !== stripos( $script->src, 'http://', 0 ) ) {
			$script->src = str_replace( 'http://', 'https://', $script->src );
		}
	}
}