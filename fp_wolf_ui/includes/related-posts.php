<?php
/**
 * The template for displaying the related posts.
 * Gets the related posts using the same tags. 
 * If no thre are no tags, displays the latest posts.
 *
 * @package  WordPress
 * @file     related-posts.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 * 
 **/
?>

<?php
$tags = wp_get_post_tags($post->ID);
$rp_cat = get_the_category( $post->ID );

$number = 3;
$args = array();
$args2 = array();

if ($tags) {
    $tag_ids = array();
    
	foreach($tags as $tag){
		$tag_ids[] = $tag->term_id;
	}

    $args = array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'showposts'=> $number,
    ); 
	
    if( count($args) < $number ) {
        $n = $number - count($args);
        if ($categories) {
			$category_ids = array();
			foreach($categories as $cat) $category_ids[] = $cat->term_id;

			$args2 = array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
				'showposts'=> $n,
            );      
		}
    }
    $args = array_merge( $args, $args2 );
} else {
    $categories = get_the_category($post->ID);  
    if ($categories) {
        $category_ids = array();
        foreach($categories as $cat) $category_ids[] = $cat->term_id;

        $args = array(
            'category__in' => $category_ids,
            'post__not_in' => array($post->ID),
            'showposts'=> $number,
        );      
    }
}

if($args){

	$my_query = new wp_query($args);
	
	if( $my_query->have_posts() ) {	?>
		
		<div class="related-posts section">
			<div class="gen-title">
				<span><?php _e('Related Stories', 'fairpixels'); ?></span>		
				<div class="see-all-link">See all <a href="<?php echo get_category_link( $rp_cat[0]->term_id )?>">category stories <i class="fa fa-angle-right"></i></a></div>	
			</div>
		
			<div class="section-wrap">
				
				<?php		
					$post_count = 0;
					while ($my_query->have_posts()) {
						$my_query->the_post();	
							$last = '';
							if (++$post_count  == 2) {
								$last = ' col-last';
							}
						?>							
						<div class="thumb-post<?php echo esc_attr( $last ); ?>">
							<?php if ( has_post_thumbnail() ) {	?>														
								<div class="thumb">											
									<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'fp370_230' ); ?></a>
								</div>							
							
							<?php }									
								 
								if ( fp_get_settings( 'fp_show_post_rating' ) == 1 ){
									ec_stars_rating_archive(); 
								}
							?>
								
							<div class="entry-wrap">
								<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
								<div class="thumb-post-subtitle">
									<p>
										<?php 
											$excerpt = get_the_excerpt();
											$trimmed_excerpt = wp_trim_words( $excerpt, 16);
											echo esc_html( $trimmed_excerpt );
										?>
									</p>
								</div>
								
								<div class="entry-meta">
									<?php fp_get_cat(); ?>
									<span class="date"><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></span>
									<?php 
										if ( comments_open() ) :
											global $post;
											$comment_count = get_comments_number( $post->ID );
											if ($comment_count > 0){ ?>	
												<span class="comments">
													<i class="fa fa-comments-o"></i>
														<?php comments_popup_link( __('', 'fairpixels'), __( '1', 'fairpixels'), __('%', 'fairpixels')); ?>	
												</span><?php
											}	
										endif; 
										
										if ( fp_get_settings( 'fp_show_post_views' ) == 1 ) {
											$view_count = fp_get_post_views(get_the_ID());

											if ( $view_count > 0) { ?>						
												<span class="views"><i class="fa fa-eye"></i><?php echo esc_html( $view_count ); ?> Views</span><?php
											}									
										}
									
									?>
								</div>
								
								

								<div class="more"><a href="<?php the_permalink() ?>"><?php _e('Read more', 'fairpixels'); ?></a></div>
							</div>
													
						</div>
					<?php
					}		
				?>
					
			</div>
		</div>		
		<?php		
	}
	wp_reset_query();	
}

?>