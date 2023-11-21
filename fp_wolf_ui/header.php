<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package  WordPress
 * @file     header.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
</head>
<?php
$dubiCarsURL = 'https://www.dubicars.com/';
if (ICL_LANGUAGE_CODE === 'ar') {
   $dubiCarsURL = 'https://www.dubicars.com/ar';
}
?>

<body <?php body_class(); ?>>
	
	<div id="header" class="clearfix">
		
<!-- 		<div class="top-bar">
			<div class="inner-wrap">
			
				<div class="top-menu">
					<?php //wp_nav_menu( array( 'theme_location' => 'top-menu', 'container' => '0', 'depth' => '1') ); ?>
				</div>
			</div>
		</div>	 -->	
		<div id="mobile-nav-back-cover"></div>
		<div class="logo-section">
			<div class="inner-wrap">
				<div class="logo">
					<?php if (fp_get_settings( 'fp_logo_url' )) { ?>						
						<a href="<?php echo $dubiCarsURL; ?>">
							<img src="<?php echo esc_url( fp_get_settings( 'fp_logo_url' ) ); ?>" alt="" />
						</a>					
					<?php } else {?>
						<h1 class="site-title">
							<a href="<?php echo home_url( '/' ); ?>">
								<?php bloginfo('name'); ?>
							</a>							
						</h1>	
						<p><?php bloginfo('description'); ?></p>
					<?php } ?>
				</div>

				<div class="primary-menu clearfix">							
					<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'depth' => 2, 'container' => '0', 'menu_class' => 'sf-menu', 'fallback_cb' => 'fp_main_menu_fallback')); ?>
				</div>
				<div class="lang-switcher">
					<?php do_action('wpml_add_language_selector'); ?>
				</div>
				<div id="mobile_nav_wrapper" class="mobile_nav">
					
				</div>
				
			</div>
		</div>

		<div class="fp_breadcrumb" style="display:none;">
			<?php
				if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
				}
			?>
		</div>

		<div class="sec-menu-section clearfix">
			<div class="inner-wrap">
				<?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'depth' => 2, 'container' => '0', 'menu_class' => 'sec-menu', 'fallback_cb' => 'fp_main_menu_fallback')); ?>
			</div>
		</div>

		
		<?php
			$fp_show_trending = fp_get_settings( 'fp_show_trending_tags' );
				
			if ( $fp_show_trending == 1 ){
				get_template_part( 'includes/trending-topics' );														
			}
		?>
		
		<?php
			$fp_show_ticker = fp_get_settings( 'fp_show_ticker' );
				
			if ( $fp_show_ticker == 1 ){
				get_template_part( 'includes/ticker' );														
			}
		?>
		
	</div><!-- /header -->
	
	<div id="main">
		<?php 
		
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}						
				
			if ( (is_page_template('page-home.php') OR is_page_template('page-home2.php') OR is_page_template('page-home3.php')) AND ($paged < 2 ) ){	
				$fp_slider = get_post_meta($post->ID, 'fp_meta_slider_type', true);

				if ( $fp_slider == 'slider1' ){
					get_template_part( 'includes/slider1' );
				} elseif ( $fp_slider == 'slider2' ){
					get_template_part( 'includes/slider-full' );
				} elseif ( $fp_slider == 'slider3' ){
					get_template_part( 'includes/slider-tiles' );
				}
				
			}
				
		?>
				
		<div class="inner-wrap">				
