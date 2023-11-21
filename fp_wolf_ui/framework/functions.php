<?php

/**
 * Tell WordPress to run fp_theme_setup() when the 'after_setup_theme' hook is run.
 */
 
add_action( 'after_setup_theme', 'fp_theme_setup' );

if ( ! function_exists( 'fp_theme_setup' ) ):

function fp_theme_setup() {

	/**
	 * Load up our required theme files.
	 */
	$framework_dir = get_template_directory().'/framework/';
	
	require( $framework_dir . 'settings/theme-options.php' );
	require( $framework_dir . 'settings/option-functions.php' );	
	require( $framework_dir . 'meta/meta_post.php' );
	require( $framework_dir . 'meta/meta_category.php' );
	require( $framework_dir . 'rating/rating.php' );
	require( $framework_dir . 'ajaxload/functions.php' );
	
	/**
	 * Load our theme widgets
	 */
	require( $framework_dir . 'widgets/widget_flickr.php' );
	require( $framework_dir . 'widgets/widget_video.php' );
	require( $framework_dir . 'widgets/widget_pinterest.php' );
	require( $framework_dir . 'widgets/widget_recent_comments.php' );
	require( $framework_dir . 'widgets/widget_adsingle.php' );
	require( $framework_dir . 'widgets/widget_slider.php' );
	require( $framework_dir . 'widgets/widget_social.php' );
	require( $framework_dir . 'widgets/widget_subscribe.php' );
	require( $framework_dir . 'widgets/widget_popular_categories.php' );
	require( $framework_dir . 'widgets/widget_featured_posts.php' );
	require( $framework_dir . 'widgets/widget_posts.php' );
	require( $framework_dir . 'widgets/widget_postlist.php' );

	/* Add translation support.
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'fairpixels', get_template_directory() . '/languages' );
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) )
		$content_width = 600;
		
	add_theme_support( 'title-tag' );
	
	/** 
	 * Add default posts and comments RSS feed links to <head>.
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/**
	 * This theme styles the visual editor with editor-style.css to match the theme style.
	 */
	add_editor_style();
	
	/**
	 * Register menus
	 *
	 */
	register_nav_menus( array(
		'top-menu' => __( 'Top Menu', 'fairpixels' ),
		'primary-menu' => __( 'Primary Menu', 'fairpixels' ),
		'footer-menu' => __( 'Footer Menu', 'fairpixels' ),
		'sitemap-menu' => __( 'Sitemap Menu', 'fairpixels' )
		) );
	
	/**
	 * Add support for the featured images (also known as post thumbnails).
	 */
	if ( function_exists( 'add_theme_support' ) ) { 
		add_theme_support( 'post-thumbnails' );
	}
	
	/**
	 * Add custom image sizes
	 */
	add_image_size( 'fp760_390', 760, 390, true );		//slider
	add_image_size( 'fp370_230', 370, 230, true );		//archive	
	add_image_size( 'fp70_70', 70, 70, true );			//thumbnails
	add_image_size( 'fp268_390', 268, 390, true );		//tiles slider
	
}
endif; // fp_theme_setup


/**
 * Enqueues styles for front-end.
 *
 */ 
if (!function_exists('fp_theme_css')) {
	function fp_theme_css() {
		wp_enqueue_style( 'fp-fonts-style', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,700&display=swap' );
		wp_enqueue_style( 'fp-font-awesome', get_template_directory_uri().'/css/fonts/font-awesome/css/font-awesome.min.css' );
		wp_enqueue_style( 'fp-style', get_template_directory_uri().'/style.css' );
		wp_enqueue_style( 'fp-custom-style', get_template_directory_uri().'/css/custom-styles.css' );
		#wp_enqueue_style( 'fp-style', get_stylesheet_uri() );	
		if (ICL_LANGUAGE_CODE === 'ar') {
			// load the RTL style
			wp_enqueue_style( 'fp-custom-rtl', get_template_directory_uri().'/css/rtl.css' , array(), time());
		}
	}
}
add_action( 'wp_enqueue_scripts', 'fp_theme_css' );

/**
 * A safe way of adding JavaScripts to a WordPress generated page.
 */

if (!is_admin()){
    add_action('wp_enqueue_scripts', 'fp_theme_js');
}

if (!function_exists('fp_theme_js')) {

    function fp_theme_js() {
		
		$js_dir = get_template_directory_uri().'/js/';
		
		wp_enqueue_script('fp_superfish', $js_dir.'superfish.js', '','', true);		
		wp_enqueue_script('fp_lightbox', $js_dir . 'lightbox.js', array('jquery'),'', true); 		
		wp_enqueue_script('fp_jflickrfeed', $js_dir . 'jflickrfeed.min.js', array('jquery'),'', true); 		
		wp_enqueue_script('fp_slider', $js_dir . 'jquery.flexslider-min.js', array('jquery'), '', true); 
		wp_enqueue_script('fp_respmenu', $js_dir . 'jquery.slicknav.min.js', array('jquery'), '', true); 
		wp_enqueue_script('fp_ticker', $js_dir . 'jquery.vticker.min.js', array('jquery'),'', true);	
		wp_enqueue_script('fp_scripts', $js_dir . 'scripts.js', array('jquery'),'', true);			
			
		if ( is_page_template('page-home.php') OR is_page_template('page-home2.php') OR is_page_template('page-home3.php') ){
			wp_enqueue_script('fp_carouFredSel', $js_dir . 'jquery.carouFredSel.min.js', array('jquery'),'', true);		
		}
		
		if ( is_singular() && comments_open() && get_option('thread_comments') ){
			wp_enqueue_script( 'comment-reply' );
		}		
		
    }	
}


/**
 * Enqueues styles for the widgets.
 *
 */ 
function fp_widgets_css( $hook ) {
    if ( 'widgets.php' != $hook ) {
        return;
    }
	wp_enqueue_script( 'wp-color-picker');
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'fp-widgets-style', get_template_directory_uri() . '/framework/settings/css/widgets.css' );
}
add_action( 'admin_enqueue_scripts', 'fp_widgets_css' );

/**
 * Register our sidebars and widgetized areas.
 *
 */
 
if ( function_exists('register_sidebar') ) {
	
	register_sidebar( array(
		'name' => __( 'Homepage 1', 'fairpixels' ),
		'id' => 'homepage-1',
		'description' => __( 'Homepage 1 widgets area', 'fairpixels' ),
		'before_widget' => '<div id="%1$s" class="section %2$s">',
		'after_widget' => '</div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Homepage 2', 'fairpixels' ),
		'id' => 'homepage-2',
		'description' => __( 'Homepage 2 widgets area', 'fairpixels' ),
		'before_widget' => '<div id="%1$s" class="section %2$s">',
		'after_widget' => '</div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Homepage 3', 'fairpixels' ),
		'id' => 'homepage-3',
		'description' => __( 'Homepage 3 widgets area', 'fairpixels' ),
		'before_widget' => '<div id="%1$s" class="section %2$s">',
		'after_widget' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Blogpage 2', 'fairpixels' ),
		'id' => 'blogpage-2',
		'description' => __( 'Blogpage 2 widgets area', 'fairpixels' ),
		'before_widget' => '<div id="%1$s" class="section %2$s">',
		'after_widget' => '</div>',
	) );
		
	register_sidebar( array(
		'name' => __( 'Right Sidebar', 'fairpixels' ),
		'id' => 'sidebar-2',
		'description' => __( 'Right sidebar area', 'fairpixels' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s" data-animation="fadeInUp">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 1', 'fairpixels' ),
		'id' => 'footer-1',
		'description' => __( 'Footer sidebar area', 'fairpixels' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 2', 'fairpixels' ),
		'id' => 'footer-2',
		'description' => __( 'Footer sidebar area', 'fairpixels' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 3', 'fairpixels' ),
		'id' => 'footer-3',
		'description' => __( 'Footer sidebar area', 'fairpixels' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 4', 'fairpixels' ),
		'id' => 'footer-4',
		'description' => __( 'Footer sidebar area', 'fairpixels' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );
	
}

/**
 * Pagination for archive, taxonomy, category, tag and search results pages
 *
 * @global $wp_query http://codex.wordpress.org/Class_Reference/WP_Query
 * @return Prints the HTML for the pagination if a template is $paged
 */
if ( ! function_exists( 'fp_pagination' ) ) :
function fp_pagination() {
	global $wp_query;
 
	$big = 999999999; // This needs to be an unlikely integer
 
	// For more options and info view the docs for paginate_links()
	// http://codex.wordpress.org/Function_Reference/paginate_links
	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 5
	) );
 
	// Display the pagination if more than one page is found
	if ( $paginate_links ) {
		$allowed_html = fp_get_allowed_html_tags(); 
		
		echo '<div class="pagination">';
		echo wp_kses($paginate_links, $allowed_html);
		echo '</div>';
	}
}
endif; // ends check for fp_pagination()

/**
 * Get first category of the post
 *
 */
function fp_get_cat(){
	$category = get_the_category();
	
	if ( $category ){		
	
		$output = '';
		$output .= '<div class="entry-cats">';
		
		if (isset($category[0]->term_id)){
			
			$cat_id = $category[0]->term_id;		
			
			$output .= '<div class="cat main-color-bg cat'.$cat_id.'-bg">';	
			$output .= '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name.'</a>';
			$output .= '</div>';
		}
				
		$output .= '</div>';
		
		$allowed_html = fp_get_allowed_html_tags(); 
		echo wp_kses($output, $allowed_html);
			
	}
}

/**
 * Get first two categories of the post
 *
 */
function fp_get_cats(){
	$category = get_the_category();
	
	if ( $category ){		
	
		$output = '';
		$output .= '<div class="entry-cats">';
		
		if (isset($category[0]->term_id)){
			
			$cat_id = $category[0]->term_id;		
			
			$output .= '<div class="cat main-color-bg cat'.$cat_id.'-bg">';	
			$output .= '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name.'</a>';
			$output .= '</div>';
		}
		
		if (isset($category[1]->term_id)){
			
			$cat_id = $category[1]->term_id;		
			
			$output .= '<div class="cat main-color-bg cat'.$cat_id.'-bg">';	
			$output .= '<a href="' . get_category_link( $category[1]->term_id ) . '">' . $category[1]->name.'</a>';
			$output .= '</div>';
		}		
		
		$output .= '</div>';
		
		$allowed_html = fp_get_allowed_html_tags(); 
		echo wp_kses($output, $allowed_html);
				
	}
}

/**
 * Set category styles
 *
 */
function fp_set_category_styles(){
	$categories = get_categories();
		$cat_css = '';
		foreach($categories as $category) {
			
			$cat_id = $category->term_id;
			$fp_category_meta = get_option( "fp_category_meta_color_$cat_id" );
			
			if (isset($fp_category_meta['fp_cat_meta_color'])){
				$cat_color = $fp_category_meta['fp_cat_meta_color'];					
				$cat_css .=".cat".$cat_id."-bg{background:".$cat_color.";} ";
			}		
				
		}
				
		wp_add_inline_style('fp-style', $cat_css);	
	
}
add_action( 'wp_enqueue_scripts', 'fp_set_category_styles',11 );

/**
 * Get the number of viewws
 *
 */
function fp_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    
	if( $count == '' ){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
	}
	
   return $count;
}
 
/**
 * Set the number of viewws
 *
 */
function fp_set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    
	if( $count == '' ){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/**
 * Sanitization function
 *
 */
function fp_get_allowed_html_tags(){
	
	$allowed_tags = array(
		'a' => array(
			'href' => true,
			'rel' => true,
			'rev' => true,
			'name' => true,
			'target' => true,
			'class' => true
		),
		
		'img' => array(
			'alt' => true,
			'align' => true,
			'border' => true,
			'height' => true,
			'hspace' => true,
			'longdesc' => true,
			'vspace' => true,
			'src' => true,
			'usemap' => true,
			'width' => true,
			'class' => true
	   ),
	   
	   'p' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'class' => true
		),
		
		'div' => array(
			'align' => true,
			'dir' => true,
			'lang' => true,
			'class' => true
		),

		'span' => array(
			'dir' => true,
			'align' => true,
			'lang' => true,
			'class' => true
		),
		
		'br' => array(),
		
		'iframe' => array(
			'src' => array(),
			'height' => array(),
			'width' => array(),
			'frameborder' => array(),
			'allowfullscreen' => array(),
		)
	);
	
	return $allowed_tags;
}
