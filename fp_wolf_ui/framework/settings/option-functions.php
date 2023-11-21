<?php
/**
 * The Theme Option Functions page
 *
 * This page is implemented using the Settings API.
 * 
 * @package  WordPress
 * @file     option-functions.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */


/**
 * Set custom RSS feed links.
 *
 */
$options = get_option('fp_options');
	
function fp_custom_feed( $output, $feed ) {

	$options = get_option('fp_options');
	$url = $options['fp_rss_url'];	
	
	if ( $url ) {
		$outputarray = array( 'rss' => $url, 'rss2' => $url, 'atom' => $url, 'rdf' => $url, 'comments_rss2' => '' );
		$outputarray[$feed] = $url;
		$output = $outputarray[$feed];
	}
	return $output;
}
add_filter( 'feed_link', 'fp_custom_feed', 1, 2 );

/**
 * Set custom Favicon.
 *
 */
function fp_custom_favicon() {
	$options = get_option('fp_options');
	$favicon_url = $options['fp_favicon'];	
	
    if (!empty($favicon_url)) {
		echo '<link rel="shortcut icon" href="'. $favicon_url. '" />	'. "\n";
	}
}
add_action('wp_head', 'fp_custom_favicon');


/**
 * Set apple touch icon.
 *
 */
function fp_apple_touch() {
	$options = get_option('fp_options');
	$apple_touch = $options['fp_apple_touch'];	
	
    if (!empty($apple_touch)) {
		echo '<link rel="apple-touch-icon" href="'. $apple_touch. '" />	'. "\n";
	}
}
add_action('wp_head', 'fp_apple_touch');

/**
 * Set the animations
 *
 */
function fp_animate_css() {
	$options = get_option('fp_options');
	$show_animation = $options['fp_enable_animation'];
	
	if( $show_animation ){
		wp_enqueue_style( 'fp-animate-css', get_template_directory_uri().'/css/animations.css' );
		wp_enqueue_script('fp-animate', get_template_directory_uri() . '/js/fp-animate.min.js', array('jquery'),'', true);
	}
}
add_action( 'wp_enqueue_scripts', 'fp_animate_css' );

/**
 * Get Google Fonts
 *
 */ 
function fp_get_google_fonts() {
	include( get_template_directory() . '/framework/settings/google-fonts.php' );
	$google_font_array = json_decode ($google_api_output,true) ;
	$items = $google_font_array['items'];
	
	$fonts_list = array();

	$fontID = 0;
	foreach ($items as $item) {
		$fontID++;
		$variants='';
		$variantCount=0;
		foreach ($item['variants'] as $variant) {
			$variantCount++;
			if ($variantCount>1) { $variants .= '|'; }
			$variants .= $variant;
		}
		$variantText = ' (' . $variantCount . ' Varaints' . ')';
		if ($variantCount <= 1) $variantText = '';
		$fonts_list[ $item['family'] . ':' . $variants ] = $item['family']. $variantText;
	}
	return $fonts_list;
}

function fp_get_font($font_string) {
	if ($font_string) {
		$font_pieces = explode(":", $font_string);			
		$font_name = $font_pieces[0];
	
		return $font_name;
	}
}

function fp_get_rgb_color($color){
			
		if ( $color[0] == '#' ) {
                $color = substr( $color, 1 );
        }
        if ( strlen( $color ) == 6 ) {
                list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return false;
        }
		
		$r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        
		
		$rgb =$r.','.$g.','.$b;
		return $rgb;       
}

/**
 * Set custom CSS styles
 */ 
function fp_custom_styles(){
	$options = get_option('fp_options');
	
	$fp_custom_style = '';
		
	//text styles
	$text_fontsize = $options['fp_text_fontsize'];
	$text_lineheight = $options['fp_text_lineheight'];
	
	$raw_text_style = $options['fp_text_fontstyle'];
	$formatted_text_style = fp_set_font_style($raw_text_style);
	$fp_text_font_string = $options['fp_text_font_name'];
	$fp_text_color = $options['fp_text_color'];   
	
	if ((!empty ($text_fontsize)) or (!empty ($text_style)) or (!empty ($text_lineheight))  or (!empty ($fp_text_font_string)) or (!empty($fp_text_color)) ){
		$fp_custom_style .= "body{\n" ;
		
		if ( !empty ($text_fontsize) ) {
			$fp_custom_style .= "	font-size: " .$text_fontsize. ";\n";
		}
			
		if ( !empty ($formatted_text_style) ) {
			$fp_custom_style .= $formatted_text_style."\n";
		}
			
		if ( !empty ($text_lineheight) ) {
			$fp_custom_style .= "	line-height: " .$text_lineheight. ";\n";
		}
			
		if (!empty($fp_text_font_string)){
			fp_enqueue_font( $fp_text_font_string ) ;
			$font_name = fp_get_font($fp_text_font_string);
			$fp_custom_style .= "	font-family: " .$font_name. ", sans-serif, serif;\n";
		}
		
		if (!empty($fp_text_color) ){
			$fp_custom_style .= "	color: " .$fp_text_color. ";\n";
		}				
			
		$fp_custom_style .="}\n\n";
	}
	
	//heading styles
	for ($i = 1; $i < 7; $i++){ 
		$raw_font_style = $options['fp_h'.$i.'_fontstyle'];
		$formatted_font_style = fp_set_font_style($raw_font_style);
				
		$font_size = $options['fp_h'.$i.'_fontsize'];
		$font_style = $formatted_font_style;
		$font_lineheight = $options['fp_h'.$i.'_lineheight'];
		$font_marginbottom = $options['fp_h'.$i.'_marginbottom'];
		
		if ((!empty ($font_size)) or (!empty ($font_style)) or (!empty ($font_lineheight)) or (!empty ($font_marginbottom))){
			$fp_custom_style .= "h".$i."{\n" ;
			if ( !empty ($font_size) ) {
				$fp_custom_style .= "	font-size: " .$font_size. ";\n";
			}
			
			if ( !empty ($font_style) ) {
				$fp_custom_style .= $font_style."\n";
			}
				
			if ( !empty ($font_lineheight) ) {
				$fp_custom_style .= "	line-height: " .$font_lineheight. ";\n";
			}
			
			if ( !empty ($font_marginbottom) ) {
				$fp_custom_style .= "	margin-bottom: " .$font_marginbottom. ";\n";
			}				
				
			$fp_custom_style .="}\n\n";	
		}
	}	
		
	//headings font and color	
	$fp_headings_font_string = $options['fp_headings_font_name'];
			
	if (!empty($fp_headings_font_string)){
		$fp_custom_style .= "h1, h2, h3, h4, h5, h6 {\n";
		
		if (!empty($fp_headings_font_string)){
			fp_enqueue_font( $fp_headings_font_string ) ;
			$font_name = fp_get_font($fp_headings_font_string);
			$fp_custom_style .= "    font-family: ".$font_name.", sans-serif, serif;\n";	
		}
			
		$fp_custom_style .= "}\n\n";
	}
	
	//links color
	$fp_links_color = $options['fp_links_color'];	
	if (!empty($fp_links_color)){	
		$fp_custom_style .= "#slider-main .entry-header h2 a {\n    color: ".$fp_links_color.";\n}\n\n";	
		$fp_custom_style .= "a:link {\n    color: ".$fp_links_color.";\n}\n\n";	
		$fp_custom_style .= "a:visited {\n    color: ".$fp_links_color.";\n}\n\n";		
	}
	
	//links hover color
	$fp_links_hover_color = $options['fp_links_hover_color'];
	if (!empty($fp_links_hover_color)){
		$fp_custom_style .= "a:hover, \n .entry-meta a:hover {\n    color: ".$fp_links_hover_color.";\n}\n\n";	
	}
		
	//custom css field
	$fp_custom_css_field = $options['fp_custom_css'];
	if ( !empty($fp_custom_css_field) ){
		$fp_custom_style .= $fp_custom_css_field;	
	}		
	
	//set primary color
	$fp_primary_color = $options['fp_primary_color'];
	
	if ( !empty($fp_primary_color) ){	
		$rbg = fp_get_rgb_color($fp_primary_color);	

		$fp_custom_style .= ".primary-menu ul li a:hover,\n .primary-menu ul ul li,\n .menu-item-has-children:hover .sub-menu-wrap,\n .menu-item-has-children:hover a.sf-with-ul,\n .primary-menu .current-menu-item a,\n .primary-menu .current_page_item a,\n .trending-topics,\n .slider-main-nav a,\n .section-title,\n .load-more a,\n .pagination a:hover,\n .pagination .current,\n #comments .reply a,\n #respond input[type=submit],\n .search-submit,\n .widget_popular_categories .post-count,\n .tagcloud a,\n .gotop,\n .blog-list .more a,\n .button,\n .footer-menu { \n		background: ".$fp_primary_color." \n}\n\n";	

		$fp_custom_style .= ".slider-main .post-info,\n .slider-main .entry-rating { \n		background: rgba( ".$rbg." ,0.9 )\n}\n\n";	
	
	
		$fp_custom_style .= ".slider-tiles .more a:hover,\n .entry-content a { \n		color: ".$fp_primary_color." \n}\n\n";	
		$fp_custom_style .= ".pagination a:hover,\n .pagination .current{ \n    border: 1px solid ".$fp_primary_color." \n}\n\n";	
		$fp_custom_style .= ".widget_comments .comment-list li:hover{ \n    border-left: 5px solid ".$fp_primary_color." \n}\n\n";
		
	}
	
	$fp_second_color = $options['fp_second_color'];
	
	if ( !empty($fp_second_color) ){	
		$fp_custom_style .= "#sidebar .widget-title { \n		background: ".$fp_second_color." \n}\n\n";	
	}
		
		
	wp_add_inline_style('fp-style', $fp_custom_style);
}
add_action( 'wp_enqueue_scripts', 'fp_custom_styles' );


/**
 * Set font styles
 */ 
function fp_set_font_style($fontstyle){
	$stack = '';
		
	switch ( $fontstyle ) {

		case "normal":
			$stack .= "";
		break;
		case "italic":
			$stack .= "    font-style: italic;";
		break;
		case 'bold':
			$stack .= "    font-weight: bold;";
		break;
		case 'bold-italic':
			$stack .= "    font-style: italic;\n    font-weight: bold;";
		break;
	}
	return $stack;
}

/**
 * Include Google fonts
 */ 
function fp_enqueue_font($fp_text_font_string){

	$font_pieces = explode(":", $fp_text_font_string);
	$font_name = $font_pieces[0];
	$font_name = str_replace (" ","+", $font_pieces[0] );
				
	$font_variants = $font_pieces[1];
	$font_variants = str_replace ("|",",", $font_pieces[1] );
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( $font_name, "$protocol://fonts.googleapis.com/css?family=".$font_name . ":" . $font_variants );
}

/**
 * Include Google fonts
 */
add_action( 'widgets_init', 'fp_add_sidebar' );
function fp_add_sidebar() {
	$options = get_option('fp_options');
	
	$sidebars = "";
	if (isset($options['fp_custom_sidebars'])){
		$sidebars = $options['fp_custom_sidebars'];
	}
	
	if($sidebars){
		foreach ($sidebars as $sidebar) {
			register_sidebar( array(
				'name' => $sidebar,
				'id' => sanitize_title($sidebar),
				'description' => __( 'FairPixels custom sidebar', 'fairpixels' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<div class="widget-title"><h4>',
				'after_title' => '</h4></div>',
			) );
		}
	}
}

/**
 * Add lightbox rel
 */ 
if (isset($options['fp_show_lightbox_gallery'])){
	$options = get_option('fp_options');
	$enable_gallery = $options['fp_show_lightbox_gallery'];
	
	if ( $enable_gallery == 1 ) {
		add_filter('wp_get_attachment_link', 'fp_add_rel_gallery');
		add_filter('the_content', 'fp_add_rel_single_img');			
	}	
}

function fp_add_rel_gallery($link) {
	$options = get_option('fp_options');	
	return str_replace('<a href', '<a rel="lightbox[fp-post-gallery]" href', $link);
	
}

function fp_add_rel_single_img($content) {
	
	global $post;
	$pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox" title="'.esc_html($post->post_title).'"$6>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
	
}


/**
 * Set category styles
 *
 */
function fp_set_header_bg(){
	$options = get_option('fp_options');
	$header_bg = $options['fp_header_bg_url'];
	
	$bg_css = '';
	if ( $header_bg ) {
		$bg_css .='#header .logo-section {background: url("'.$header_bg.'") no-repeat; background-size: cover;} ';
	}
	
	wp_add_inline_style('fp-style', $bg_css);	
	
}
add_action( 'wp_enqueue_scripts', 'fp_set_header_bg', 11 );

?>