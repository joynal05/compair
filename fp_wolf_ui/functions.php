<?php
/**
 * FairPixels functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package  WordPress
 * @file     functions.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */

require( get_template_directory() . '/framework/functions.php' );

define('DUBICARS_URL', 'https://www.dubicars.com');

/**
 * Set the format for the more in excerpt, return ... instead of [...]
 */ 
function fairpixels_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'fairpixels_excerpt_more');

// custom excerpt length
function fairpixels_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'fairpixels_excerpt_length');

remove_filter( 'template_redirect', 'redirect_canonical' );

/**
 * Load our homepage widgets
 */
require( get_template_directory() . '/homepage/widget_slider.php' );
require( get_template_directory() . '/homepage/widget_category1.php' );
require( get_template_directory() . '/homepage/widget_popular_posts.php' );
require( get_template_directory() . '/homepage/widget_thumb_posts.php' );



require( get_template_directory() . '/homepage/widget_single_categories.php' );
require( get_template_directory() . '/homepage/widget_carousel.php' );
//require( get_template_directory() . '/homepage/widget_home_ad.php' );

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own fairpixels_comments(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
if ( ! function_exists( 'fairpixels_comments' ) ) :
function fairpixels_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post;
	
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">
		
			<div class="author-avatar">
				<a href="<?php comment_author_url()?>"><?php echo get_avatar( $comment, 80 ); ?></a>
			</div>			
		
			<div class="comment-right">
				
				<div class="comment-header">
						<h6 class="alt"><?php printf( __( '%s', 'fairpixels' ), sprintf( '<cite class="fn cufon">%s</cite>', get_comment_author_link() ) ); ?></h6>
						
						<?php if($comment->user_id == $post->post_author) { ?>
							<span class="author-comment main-color-bg"><?php _e('Author', 'fairpixels'); ?></span>
						<?php } ?>
		
						<span class="comment-time">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php
								/* translators: 1: date, 2: time */
								printf( __( '%1$s at %2$s', 'fairpixels' ), get_comment_date(),  get_comment_time() ); ?></a>
						</span>
													
				</div>
			
				<div class="comment-text">
					<?php comment_text(); ?>
				</div>
				
				<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'fairpixels' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</span>
		
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="moderation"><?php _e( 'Your comment is awaiting moderation.', 'fairpixels' ); ?></p>
				<?php endif; ?>

				<!-- /reply -->
		
			</div><!-- /comment-right -->
		
		</article><!-- /comment  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'fairpixels' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '[ Edit ]', 'fairpixels' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php	
			break;
	endswitch;
}
endif;	//ends check for fairpixels_comments()

/**
 * Set the main menu fallback
 */
 
if ( ! function_exists( 'fp_main_menu_fallback' ) ) :
	
	function fp_main_menu_fallback() { ?>
		<ul class="menu">
			<?php
				wp_list_categories(array(
					'number' => 5,
					'exclude' => '1',
					'title_li' => '',
					'orderby' => 'count',
					'order' => 'DESC'  
				));
			?>  
		</ul>
    <?php
	}

endif; // ends check for fp_main_menu_fallback()

function fp_time_ago(){
 
	global $post;
 
	$date = get_post_time('G', true, $post);
  
	// Array of time period chunks
	$chunks = array(
		array( 60 * 60 * 24 * 365 , __( 'year', 'fairpixels' ), __( 'years', 'fairpixels' ) ),
		array( 60 * 60 * 24 * 30 , __( 'month', 'fairpixels' ), __( 'months', 'fairpixels' ) ),
		array( 60 * 60 * 24 * 7, __( 'week', 'fairpixels' ), __( 'weeks', 'fairpixels' ) ),
		array( 60 * 60 * 24 , __( 'day', 'fairpixels' ), __( 'days', 'fairpixels' ) ),
		array( 60 * 60 , __( 'hour', 'fairpixels' ), __( 'hours', 'fairpixels' ) ),
		array( 60 , __( 'minute', 'fairpixels' ), __( 'minutes', 'fairpixels' ) ),
		array( 1, __( 'second', 'fairpixels' ), __( 'seconds', 'fairpixels' ) )
	);
 
	if ( !is_numeric( $date ) ) {
		$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
		$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
		$date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
	}
 
	$current_time = current_time( 'mysql', $gmt = 0 );
	$newer_date = strtotime( $current_time );
 
	// Difference in seconds
	$since = $newer_date - $date;
 
	// Something went wrong with date calculation and we ended up with a negative date.
	if ( 0 > $since )
		return __( 'sometime', 'fairpixels' );
 
	/**
	 * We only want to output one chunks of time here, eg:
	 * x years
	 * xx months
	 * so there's only one bit of calculation below:
	 */
 
	//Step one: the first chunk
	for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];
 
		// Finding the biggest chunk (if the chunk fits, break)
		if ( ( $count = floor($since / $seconds) ) != 0 )
			break;
	}
 
	// Set output var
	$output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
  
	if ( !(int)trim($output) ){
		$output = '0 ' . __( 'seconds', 'fairpixels' );
	}
 
	$output .= __(' ago', 'fairpixels');
 
	return $output;
}


function customize_editor_role(){
    $role = get_role('editor'); // Get the user role

    if(!$role->has_cap('edit_theme_options')){
        $role->add_cap('edit_theme_options'); // Add the capability to manage widgets
    }

    // Remove unnecessary submenus for Editors
    if(current_user_can('editor')){
        remove_submenu_page( 'themes.php', 'themes.php' ); // Themes
        remove_submenu_page( 'themes.php', 'nav-menus.php' ); // Menus
        remove_submenu_page( 'themes.php', 'customize.php' ); // Customizer
        // Add other submenu pages you want to remove
    }
}

add_action('admin_init', 'customize_editor_role');

?>