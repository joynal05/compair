<?php
/**
 * The file contains the functions to add meta box to post
 *
 * @package  WordPress
 * @file     meta_post.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */

/**
 * Include require scripts
 *
 */
function fp_meta_post_scripts( $hook ) {
    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
       wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script( 'fp_colorpicker', get_template_directory_uri() . '/framework/settings/js/colorpicker.js', array( 'jquery' ));
		wp_enqueue_style( 'fp_cat_css', get_template_directory_uri() . '/framework/settings/css/color-picker.css');
    }
}
add_action( 'admin_enqueue_scripts', 'fp_meta_post_scripts');



function fairpixels_post_meta_settings() {
	add_meta_box("fp_meta_post_gallery", "Post Slider Settings", "fp_meta_post_gallery", "post", "normal", "high");
	add_meta_box("fp_meta_post_video", "Featured Video Settings", "fp_meta_post_video", "post", "normal", "high");
	add_meta_box("fp_meta_post_featimg", "Featured Image Settings", "fp_meta_post_featimg", "post", "normal", "high");
	add_meta_box("fp_meta_post_sidebar", "Sidebar Settings", "fp_meta_post_sidebar", "post", "normal", "high");
		
		
	$post_id = '';	
	if(isset($_GET['post'])){  
		$post_id = $_GET['post'];
    }
	
	if(isset($_POST['post_ID'])){
		$post_id =  $_POST['post_ID'];
    }	
	
	$template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
	
	if (($template_file == 'page-home.php') or ($template_file == 'page-home2.php') or ($template_file == 'page-home3.php')){
		add_meta_box("fp_meta_homepage", "HomePage Settings", "fp_meta_homepage", "page", "normal", "high");
	}
		
	if (($template_file == 'page-blog.php') or ($template_file == 'page-blog2.php')){
		add_meta_box("fp_meta_blog_page", "Blog Page Settings", "fp_meta_blog_page", "page", "normal", "high");
	}	
	
	add_meta_box("fp_meta_post_sidebar", "Sidebar Settings", "fp_meta_post_sidebar", "page", "normal", "high");
}
add_action( 'add_meta_boxes', 'fairpixels_post_meta_settings' );


function fp_register_meta_scripts($hook_suffix) {	
		if( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) {	
			wp_enqueue_script( 'fp_colorpicker', get_template_directory_uri() . '/framework/settings/js/colorpicker.js', array( 'jquery' ));
			wp_enqueue_script( 'fp_meta_js', get_template_directory_uri() . '/framework/meta/js/meta.js', array( 'jquery' ));
			wp_enqueue_style( 'fp_meta_css', get_template_directory_uri() . '/framework/meta/css/meta.css');
			wp_enqueue_script( 'fp_meta_select_js', get_template_directory_uri() . '/framework/settings/js/jquery.customSelect.min.js', array( 'jquery' ));
			wp_enqueue_style( 'fp-font-awesome', get_template_directory_uri().'/css/fonts/font-awesome/css/font-awesome.min.css' );	
		}
}
add_action( 'admin_enqueue_scripts', 'fp_register_meta_scripts' );

/**
 * Display Homepage Settings
 *
 */ 
function fp_meta_homepage() {
	global $post;
	wp_nonce_field( 'fairpixels_save_postmeta_nonce', 'fairpixels_postmeta_nonce' ); ?>
		
		<h4><?php _e('Slider Section', 'fairpixels'); ?></h4>
				
		<div class="meta-field">
			<label for="fp_meta_slider_type"><?php _e('Slider Type', 'fairpixels'); ?></label>
			<?php $value = get_post_meta( $post->ID, 'fp_meta_slider_type', true ); ?>
			<select name="fp_meta_slider_type" class="styled">
				<option value="none" <?php selected( $value, 'none'); ?>><?php _e('None', 'fairpixels'); ?></option>
				<option value="slider1" <?php selected( $value, 'slider1'); ?>><?php _e('Slider with Right', 'fairpixels'); ?></option>
				<option value="slider2" <?php selected( $value, 'slider2'); ?>><?php _e('Full Slider', 'fairpixels'); ?></option>
				<option value="slider3" <?php selected( $value, 'slider3'); ?>><?php _e('Tiles Slider', 'fairpixels'); ?></option>				
			</select>
			<span class="desc"><?php _e( 'Select slider type. Slider with Right section displays 2 posts on right.', 'fairpixels' ); ?></span>
		</div>
		
		<div class="meta-field">
			<?php $value = get_post_meta( $post->ID, 'fp_meta_slider_cat', true ); ?>			
			<label for="fp_meta_slider_cat"><?php _e( 'Category ID:', 'fairpixels' ); ?></label>
			<input name="fp_meta_slider_cat" class="compact-input" type="text" id="fp_meta_slider_cat" value="<?php echo esc_attr( $value ); ?>" />
			<span class="desc"><?php _e( 'If you want to display posts from specific categories, enter category IDs separated by commas', 'fairpixels' ); ?></span>
		</div>
		
		<div class="meta-field">
			<?php $value = get_post_meta( $post->ID, 'fp_meta_slider_post_ids', true ); ?>			
			<label for="fp_meta_slider_post_ids"><?php _e( 'Post IDs:', 'fairpixels' ); ?></label>
			<input name="fp_meta_slider_post_ids" class="compact-input" type="text" id="fp_meta_slider_post_ids" value="<?php echo esc_attr( $value ); ?>" />
			<span class="desc"><?php _e( 'If you want to display specific posts, enter post IDs separated by commas', 'fairpixels' ); ?></span>
		</div>
		
		<div class="meta-field">
			<?php 
				$value = get_post_meta( $post->ID, 'fp_meta_slider_speed', true ); 
				if ( empty ($value) ) {
					$value = 5000;
				}
			?>			
			<label for="fp_meta_slider_speed"><?php _e( 'Slider Speed:', 'fairpixels' ); ?></label>
			<input name="fp_meta_slider_speed" class="compact-input" type="text" id="fp_meta_slider_speed" value="<?php echo esc_attr( $value ); ?>" />
			<span class="desc"><?php _e( 'Enter slider speed in millisecons', 'fairpixels' ); ?></span>
		</div>
		
		<h4><?php _e('Slider Right Section', 'fairpixels'); ?></h4>
		
		<div class="meta-field"><?php _e( 'This section is required only if you want to use slider with right posts section', 'fairpixels' ); ?></div>
			
		<div class="meta-field">
			<?php $value = get_post_meta( $post->ID, 'fp_meta_slider_right_cat1', true ); ?>			
			<label for="fp_meta_slider_right_cat1"><?php _e( 'Category 1:', 'fairpixels' ); ?></label>
			<input name="fp_meta_slider_right_cat1" class="compact-input" type="text" id="fp_meta_slider_right_cat1" value="<?php echo esc_attr( $value ); ?>" />
			<span class="desc"><?php _e( 'If you want to display posts from specific categories, enter category IDs separated by commas', 'fairpixels' ); ?></span>
		</div>
		
		<div class="meta-field">
			<?php $value = get_post_meta( $post->ID, 'fp_meta_slider_right_post1', true ); ?>			
			<label for="fp_meta_slider_right_post1"><?php _e( 'Post 1:', 'fairpixels' ); ?></label>
			<input name="fp_meta_slider_right_post1" class="compact-input" type="text" id="fp_meta_slider_right_post1" value="<?php echo esc_attr( $value ); ?>" />
			<span class="desc"><?php _e( 'If you want to display a specific post, enter post ID.', 'fairpixels' ); ?></span>
		</div>
		
		<div class="meta-field">
			<?php $value = get_post_meta( $post->ID, 'fp_meta_slider_right_cat2', true ); ?>			
			<label for="fp_meta_slider_right_cat2"><?php _e( 'Category 2:', 'fairpixels' ); ?></label>
			<input name="fp_meta_slider_right_cat2" class="compact-input" type="text" id="fp_meta_slider_right_cat2" value="<?php echo esc_attr( $value ); ?>" />
			<span class="desc"><?php _e( 'If you want to display posts from specific categories, enter category IDs separated by commas', 'fairpixels' ); ?></span>
		</div>
		
		<div class="meta-field">
			<?php $value = get_post_meta( $post->ID, 'fp_meta_slider_right_post2', true ); ?>			
			<label for="fp_meta_slider_right_post2"><?php _e( 'Post 2:', 'fairpixels' ); ?></label>
			<input name="fp_meta_slider_right_post2" class="compact-input" type="text" id="fp_meta_slider_right_post2" value="<?php echo esc_attr( $value ); ?>" />
			<span class="desc"><?php _e( 'If you want to display a specific post, enter post ID.', 'fairpixels' ); ?></span>
		</div>
		
		
		<h4><?php _e('Blog Section', 'fairpixels'); ?></h4>
				
		<div class="meta-field">
			<label for="fp_meta_postlist_type"><?php _e('Posts Type', 'fairpixels'); ?></label>
			<?php $value = get_post_meta( $post->ID, 'fp_meta_postlist_type', true ); ?>
			<select name="fp_meta_postlist_type" class="styled">
				<option value="none" <?php selected( $value, 'none'); ?>><?php _e('None', 'fairpixels'); ?></option>
				<option value="standard" <?php selected( $value, 'standard'); ?>><?php _e('Standard', 'fairpixels'); ?></option>
				<option value="ajax" <?php selected( $value, 'ajax'); ?>><?php _e('AJAX Load', 'fairpixels'); ?></option>
			</select>
		</div>		
		
		<div class="meta-field">
			<?php $value = get_post_meta( $post->ID, 'fp_meta_postlist_title', true ); ?>			
			<label for="fp_meta_postlist_title"><?php _e( 'Section Title:', 'fairpixels' ); ?></label>
			<input name="fp_meta_postlist_title" class="compact-input" type="text" id="fp_meta_postlist_title" value="<?php echo esc_attr( $value ); ?>" />
			<span class="desc"><?php _e( 'Enter the blog section title.', 'fairpixels' ); ?></span>
		</div>
		
		<div class="meta-field">
			<label><?php _e( 'Category', 'fairpixels' ); ?></label>
			<select id="fp_meta_postlist_cat" name="fp_meta_postlist_cat" class="styled">
				<?php 
					$categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );  
					$saved_cat = get_post_meta( $post->ID, 'fp_meta_postlist_cat', true );
				?>
				<option <?php selected( 0 == $saved_cat ); ?> value="0"><?php _e('All Categories', 'fairpixels'); ?></option>	
				<?php
					if($categories){
						foreach ($categories as $category){?>
							<option <?php selected( $category->term_id == $saved_cat ); ?> value="<?php echo esc_attr( $category->term_id ); ?>"><?php echo esc_attr( $category->cat_name ); ?></option>							
							<?php					
						}
					}
				?>			
			</select>
			<span class="desc"><?php _e( 'If you want to display posts from a specific category.', 'fairpixels' ); ?></span>
		</div>
		
		<div class="meta-field">
			<label for="fp_meta_postlist_count"><?php _e( 'Number:', 'fairpixels' ); ?></label>
			<input name="fp_meta_postlist_count" class="compact-input" type="text" id="fp_meta_postlist_count" value="<?php echo esc_attr( get_post_meta( $post->ID, 'fp_meta_postlist_count', true ) ); ?>" />
			<span class="desc"><?php _e( 'Enter number of posts to display. Leave blank to display all.', 'fairpixels' ); ?></span>
		</div>
		
		<div class="meta-field">
			<label for="fp_meta_postlist_ids"><?php _e( 'Post IDs:', 'fairpixels' ); ?></label>
			<input name="fp_meta_postlist_ids" class="compact-input" type="text" id="fp_meta_postlist_ids" value="<?php echo esc_attr( get_post_meta( $post->ID, 'fp_meta_postlist_ids', true ) ); ?>" />
			<span class="desc"><?php _e( 'If you want to display specific posts. Enter post IDs separated by commas, eg. 2,5.', 'fairpixels' ); ?></span>
		</div>
		
		<div class="meta-field">
			<label for="fp_meta_postlist_link_title"><?php _e( 'Link title:', 'fairpixels' ); ?></label>
			<input name="fp_meta_postlist_link_title" class="compact-input" type="text" id="fp_meta_postlist_link_title" value="<?php echo esc_attr( get_post_meta( $post->ID, 'fp_meta_postlist_link_title', true ) ); ?>" />
			<span class="desc"><?php _e( 'If you want to display archive link in the title. Leave blank to disable.', 'fairpixels' ); ?></span>
		</div>
		
		<div class="meta-field">
			<label for="fp_meta_postlist_link_url"><?php _e( 'Link URL:', 'fairpixels' ); ?></label>
			<input name="fp_meta_postlist_link_url" class="compact-input" type="text" id="fp_meta_postlist_link_url" value="<?php echo esc_attr( get_post_meta( $post->ID, 'fp_meta_postlist_link_url', true ) ); ?>" />
			<span class="desc"><?php _e( 'Enter the full URL.', 'fairpixels' ); ?></span>
		</div>
		
	<?php
	}

/**
 * Display Homepage Settings
 *
 */ 
function fp_meta_blog_page() {
	global $post;
	wp_nonce_field( 'fairpixels_save_postmeta_nonce', 'fairpixels_postmeta_nonce' ); ?>
				
		<div class="meta-field">
			<label><?php _e( 'Blog Category', 'fairpixels' ); ?></label>
			<select id="fp_meta_blogpage_cat" name="fp_meta_blogpage_cat" class="styled">
				<?php 
					$categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );  
					$saved_cat = get_post_meta( $post->ID, 'fp_meta_blogpage_cat', true );
				?>
				<option <?php selected( 0 == $saved_cat ); ?> value="0"><?php _e('All Categories', 'fairpixels'); ?></option>	
				<?php
					if($categories){
						foreach ($categories as $category){?>
							<option <?php selected( $category->term_id == $saved_cat ); ?> value="<?php echo esc_attr( $category->term_id ); ?>"><?php echo esc_attr( $category->cat_name ); ?></option>							
							<?php					
						}
					}
				?>			
			</select>
			<span class="desc"><?php _e( 'Select category for the blog page.', 'fairpixels' ); ?></span>
		</div>
				
		<div class="meta-field">
			<label for="fp_meta_blogpage_exclude_ids"><?php _e( 'Exclude Posts:', 'fairpixels' ); ?></label>
			<input name="fp_meta_blogpage_exclude_ids" class="compact-input" type="text" id="fp_meta_blogpage_exclude_ids" value="<?php echo esc_attr(  get_post_meta( $post->ID, 'fp_meta_blogpage_exclude_ids', true ) ); ?>" />
			<span class="desc"><?php _e( 'If you want to exclude any posts. Enter post IDs separated by commas, eg. 2,5,7.', 'fairpixels' ); ?></span>
		</div>	
		
	<?php
}

/**
 * Display gallery settings
 *
 */ 
function fp_meta_post_gallery() {
	global $post;
	wp_nonce_field( 'fairpixels_save_postmeta_nonce', 'fairpixels_postmeta_nonce' );	?>	
		
	<div class="meta-field field-checkbox first-field">
		<input type="checkbox" name="fp_meta_post_show_gallery" id="fp_meta_post_show_gallery" value="1" <?php checked( get_post_meta( $post->ID, 'fp_meta_post_show_gallery', true ), 1 ); ?> />
		<label for="fp_meta_post_show_gallery"><?php _e( 'Add Gallery', 'fairpixels' ); ?></label>
		<div class="desc inline-desc"><?php _e( 'If you want to add image slider to the post', 'fairpixels' ); ?></div>
	</div>		
		
	<div id="fp-post-meta-images" class="meta-field">
		
		<div class="meta-field">
			<button class="upload-post-img-btn"><?php _e( 'Add image', 'fairpixels' ); ?></button>				
		</div>
		
		<div class="meta-field selected-images">
			
			<div class="image-list">
				<ul>
					<?php
						$saved_img_ids = get_post_meta($post->ID, 'fp_meta_gallery_img_ids', true );
						if (!empty($saved_img_ids)){
							$img_ids = explode(',',$saved_img_ids);
							foreach($img_ids as $img_id) {    
								if (is_numeric($img_id)) {
									$image_attributes = wp_get_attachment_image_src( $img_id );
									?>									
									<li>
										<div class="thumb">
											<img src="<?php echo esc_url(  $image_attributes[0] ); ?>">
											<input type="hidden" name="fp_meta_gallery_img_id[]" value="<?php echo esc_attr( $img_id ); ?>" />
										</div>
										<div class="image-settings"><span class="remove"><i class="fa fa-times"></i></span></div>
									</li>
									<?php
								}
							}
						}
					
					?>				
				</ul>
			</div>
			
		</div>
		
		<div class="meta-field image-info"><i class="fa fa-info-circle"></i><?php _e( 'You can change the order of images with drag and drop.', 'fairpixels' ); ?></div>
	</div><!-- /fp-post-meta-gallery-options -->
	
	<?php

}

/**
 * Display featured settings
 *
 */ 
function fp_meta_post_featimg() {
	global $post;
	wp_nonce_field( 'fairpixels_save_postmeta_nonce', 'fairpixels_postmeta_nonce' ); ?>
				
		<div class="meta-field field-checkbox first-field">
			<input type="checkbox" name="fp_meta_post_disable_featimg" id="fp_meta_post_disable_featimg" value="1" <?php checked( get_post_meta( $post->ID, 'fp_meta_post_disable_featimg', true ), 1 ); ?> />
			<label for="fp_meta_post_disable_featimg"><?php _e( 'Disable Featured image in Post', 'fairpixels' ); ?></label>
			<div class="desc inline-desc"><?php _e( 'If you do not want to include the featured image in the post.', 'fairpixels' ); ?></div>
		</div>
	
	<?php
}

	
/**
 * Display video settings
 *
 */ 
function fp_meta_post_video() {
	global $post;
	wp_nonce_field( 'fairpixels_save_postmeta_nonce', 'fairpixels_postmeta_nonce' ); ?>
			
		<div class="meta-field textarea-field">
			<label><?php _e( 'Featured Video:', 'fairpixels' ); ?></label>
			<textarea name="fp_meta_post_video_code" id="fp_meta_post_video_code" type="textarea" cols="100%" rows="3"><?php echo esc_attr( get_post_meta( $post->ID, 'fp_meta_post_video_code', true ) ); ?></textarea>
			
			<div class="meta-field-desc first-field"><i class="fa fa-info-circle"></i><?php _e( 'Enter the full embedding code for the video', 'fairpixels' ); ?></div>
		</div>
					
	<?php
	}
	
/**
 * Display video settings
 *
 */ 
function fp_meta_post_sidebar() {
	global $post;
	wp_nonce_field( 'fairpixels_save_postmeta_nonce', 'fairpixels_postmeta_nonce' );		
	?>	
		<div class="meta-field">
			<?php $saved_sidebar_right = get_post_meta( $post->ID, 'fp_meta_sidebar_right', true ); ?>
			<label><?php _e( 'Right Sidebar:', 'fairpixels' ); ?></label>
			<select id="fp_meta_sidebar_right" name="fp_meta_sidebar_right" class="styled">
				<option <?php selected( "" == $saved_sidebar_right ); ?> value=""><?php _e('Default', 'fairpixels'); ?></option>	
				<?php
					$options = get_option('fp_options');
					
					$sidebars = '';													
					if ( isset($options['fp_custom_sidebars']) ){
						$sidebars = $options['fp_custom_sidebars'] ;
					}

					if($sidebars){
						foreach ($sidebars as $sidebar){ ?>
							<option <?php selected( $sidebar == $saved_sidebar_right ); ?> value="<?php echo esc_attr( $sidebar ); ?>"><?php echo esc_attr( $sidebar ); ?></option>
							<?php					
						}
					}
				?>		
			</select>
			<span class="desc"><?php _e( 'You can create custom sidebars in the theme options page.', 'fairpixels' ); ?></span>		
		</div>
	
	
	
<?php 
}
	
/**
 * Save post meta box settings
 *
 */
function fp_post_meta_save_post_settings() {
	global $post;
	
	if( !isset( $_POST['fairpixels_postmeta_nonce'] ) || !wp_verify_nonce( $_POST['fairpixels_postmeta_nonce'], 'fairpixels_save_postmeta_nonce' ) )
		return;

	if( !current_user_can( 'edit_posts' ) )
		return;
	
	if ( isset( $_POST['fp_meta_slider_type'] )){
		update_post_meta( $post->ID, 'fp_meta_slider_type', sanitize_text_field( $_POST['fp_meta_slider_type']) );	
	}
	
	if ( isset( $_POST['fp_meta_slider_cat'] )){
		update_post_meta( $post->ID, 'fp_meta_slider_cat', sanitize_text_field( $_POST['fp_meta_slider_cat']) );	
	}
	
	if ( isset( $_POST['fp_meta_slider_post_ids'] )){
		update_post_meta( $post->ID, 'fp_meta_slider_post_ids', sanitize_text_field( $_POST['fp_meta_slider_post_ids']) );	
	}
	
	if ( isset( $_POST['fp_meta_slider_speed'] )){
		update_post_meta( $post->ID, 'fp_meta_slider_speed', sanitize_text_field( $_POST['fp_meta_slider_speed']) );	
	}
	
	if ( isset( $_POST['fp_meta_slider_right_cat1'] )){
		update_post_meta( $post->ID, 'fp_meta_slider_right_cat1', sanitize_text_field( $_POST['fp_meta_slider_right_cat1']) );	
	}
	
	if ( isset( $_POST['fp_meta_slider_right_post1'] )){
		update_post_meta( $post->ID, 'fp_meta_slider_right_post1', sanitize_text_field( $_POST['fp_meta_slider_right_post1']) );	
	}
	
	if ( isset( $_POST['fp_meta_slider_right_cat2'] )){
		update_post_meta( $post->ID, 'fp_meta_slider_right_cat2', sanitize_text_field( $_POST['fp_meta_slider_right_cat2']) );	
	}
	
	if ( isset( $_POST['fp_meta_slider_right_post2'] )){
		update_post_meta( $post->ID, 'fp_meta_slider_right_post2', sanitize_text_field( $_POST['fp_meta_slider_right_post2']) );	
	}
	
	if ( isset( $_POST['fp_meta_blogpage_cat'] )){
		update_post_meta( $post->ID, 'fp_meta_blogpage_cat', $_POST['fp_meta_blogpage_cat'] );	
	}
	
	if(isset($_POST['fp_meta_blogpage_exclude_ids'])){
		update_post_meta($post->ID, 'fp_meta_blogpage_exclude_ids', sanitize_text_field($_POST['fp_meta_blogpage_exclude_ids']));
	}	
	
	if ( isset( $_POST['fp_meta_postlist_type'] )){
		update_post_meta( $post->ID, 'fp_meta_postlist_type', sanitize_text_field( $_POST['fp_meta_postlist_type']) );	
	}
	
	if(isset($_POST['fp_meta_postlist_title'])){
		update_post_meta($post->ID, 'fp_meta_postlist_title', sanitize_text_field($_POST['fp_meta_postlist_title']));
	}
	
	if ( isset( $_POST['fp_meta_postlist_cat'] )){
		update_post_meta( $post->ID, 'fp_meta_postlist_cat', $_POST['fp_meta_postlist_cat'] );	
	}
		
	if ( isset( $_POST['fp_meta_postlist_count'] )){
		update_post_meta($post->ID, 'fp_meta_postlist_count', sanitize_text_field($_POST['fp_meta_postlist_count']));
	}
		
	if ( isset( $_POST['fp_meta_postlist_ids'] )){
		update_post_meta($post->ID, 'fp_meta_postlist_ids', sanitize_text_field($_POST['fp_meta_postlist_ids']));
	}
	
	if ( isset( $_POST['fp_meta_postlist_link_title'] )){
		update_post_meta($post->ID, 'fp_meta_postlist_link_title', sanitize_text_field($_POST['fp_meta_postlist_link_title']));
	}
	
	if( isset( $_POST['fp_meta_postlist_link_url'] )){
		update_post_meta($post->ID, 'fp_meta_postlist_link_url', sanitize_text_field($_POST['fp_meta_postlist_link_url']));
	}
	
	
		
	
	if ( isset( $_POST['fp_meta_post_show_gallery'] ) && $_POST['fp_meta_post_show_gallery'] == 1  ) {
		update_post_meta( $post->ID, 'fp_meta_post_show_gallery', 1 );	
	} else {
		delete_post_meta( $post->ID, 'fp_meta_post_show_gallery', 1 );	
	}	
	
	if ( isset( $_POST['fp_meta_gallery_img_id'] )){
		
		$image_ids_list = "";		
		foreach ($_POST['fp_meta_gallery_img_id'] as $image_id) {
			$image_ids_list .= $image_id. ',';			
		} 
		update_post_meta( $post->ID, 'fp_meta_gallery_img_ids', $image_ids_list );	
		
	}else {
		delete_post_meta( $post->ID, 'fp_meta_gallery_img_ids');	
	}
		
	if(isset($_POST['fp_meta_post_video_code'])){
		update_post_meta( $post->ID, 'fp_meta_post_video_code', $_POST['fp_meta_post_video_code'] );
	}
		
	if ( isset( $_POST['fp_meta_post_disable_featimg'] ) && $_POST['fp_meta_post_disable_featimg'] == 1  ) {
		update_post_meta( $post->ID, 'fp_meta_post_disable_featimg', 1 );	
	} else {
		delete_post_meta( $post->ID, 'fp_meta_post_disable_featimg', 1 );	
	}
		
	if ( isset( $_POST['fp_meta_sidebar_right'] )){
		update_post_meta( $post->ID, 'fp_meta_sidebar_right', $_POST['fp_meta_sidebar_right'] );	
	}
	
}
add_action( 'save_post', 'fp_post_meta_save_post_settings' );