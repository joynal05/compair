<?php
/**
 * Template Name: Dubicars Homepage

 *
 * @package  WordPress
 * @file     page-front.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
<?php get_header(); ?>

<div id="content">

	<?php
	$sticky = get_option('sticky_posts');
	if (!empty($sticky)) {
		//rsort($sticky);		
		$args = array(
			'posts_per_page'      => 1,
			'numberposts' => 1, 
			'orderby' => 'date', 
			'post__in' => $sticky
		);
		$sticky = new WP_Query($args);
		if ($sticky->have_posts()) {
			$sticky_post = $sticky->posts[0];
			$banner_id = $sticky_post->ID;
			$banner_title = $sticky_post->post_title;
			$banner_subtitle = wp_strip_all_tags($sticky_post->post_content);
			$banner_date = $sticky_post->post_date;
			$banner_url = get_the_permalink($banner_id);
			$banner_cats = get_the_category($banner_id);
			$banner_cat = $banner_cats[0]->name;
			$banner_cat_url = get_category_link($banner_cats[0]->cat_ID);

	?>

	
	<div class="top-banner-wrapper">
		<div class="top-banner-wrapper">
			<div class="top-banner-content">
				<h1 class="top-banner-title">
					<a href="<?php echo $banner_url; ?>"><?php echo $banner_title; ?></a>
				</h1>
				<h5 class="top-banner-subtitle" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; display: block;">
					<a href="<?php echo $banner_url; ?>"><?php echo $banner_subtitle; ?></a>
				</h5>
				<div class="top-banner-meta">
					<span class="top-banner-cat"><a href="<?php echo $banner_cat_url; ?>"><?php echo $banner_cat; ?></a></span>
					<span class="top-banner-date"><?php echo $banner_date; ?></span>
				</div>
			</div>
		</div>
	</div>

	<?php		
		}
		//endwhile; 
		//wp_reset_query();
		wp_reset_postdata();
	}
	?>

	<br><br><br>
	<?php if ( have_posts() ) : ?>		
		<div class="archive-list">			
			<?php 
				while ( have_posts() ) : the_post();							
					get_template_part( 'content', 'excerpt' );			 
				endwhile; 
			?>
		</div>		
		<?php fp_pagination(); ?>
	<?php endif; ?>		
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>