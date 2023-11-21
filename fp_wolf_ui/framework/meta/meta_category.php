<?php
/**
 * FairPixels Category Settings
 * 
 * @package  FairPixels
 * @file     meta_category.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */ 
 
add_action( 'category_add_form_fields', 'fp_category_meta_add_field'  );
add_action( 'edit_category_form_fields', 'fp_category_meta_add_field' );
add_action( 'edited_category', 'fp_category_meta_save_field' );
add_action( 'created_category', 'fp_category_meta_save_field' );

function fp_register_meta_cat_scripts($hook_suffix) {	
	if( 'edit-tags.php' == $hook_suffix) {	
		wp_enqueue_script( 'fp_colorpicker', get_template_directory_uri() . '/framework/settings/js/colorpicker.js', array( 'jquery' ));
		wp_enqueue_script( 'fp_meta_js', get_template_directory_uri() . '/framework/meta/js/cat_meta.js', array( 'jquery' ));
		wp_enqueue_style( 'fp_cat_css', get_template_directory_uri() . '/framework/settings/css/color-picker.css');
	}
}
add_action( 'admin_enqueue_scripts', 'fp_register_meta_cat_scripts' );

function fp_category_meta_add_field( $cat ) {	
		
		$saved_color = "";
		if( isset($cat->term_id) ){
			$t_id = $cat->term_id;	
			$fp_category_meta = get_option( 'fp_category_meta_color_' . $t_id);		
			$saved_color = $fp_category_meta['fp_cat_meta_color'];			
		}		
		
		?>
		
		<table class="form-table">
			<h4><?php _e( 'fairpixels Category Settings', 'fairpixels'); ?></h4>
			<tbody>
				
				<tr class="form-field">
					<th scope="row" valign="top"><label for="fp_cat_meta_color"><?php _e( 'Category Color', 'fairpixels' ); ?></label></th>			
					<td>
						<div id="fp_cat_color_selector" class="color-pic"><div style="background-color:<?php echo esc_attr( $saved_color ); ?>"></div></div>
						<input style="width:80px; margin-right:5px;"  name="fp_category_meta[fp_cat_meta_color]" id="fp_cat_meta_color" type="text" value="<?php echo esc_attr( $saved_color ); ?>" />
											
					<p class="description"><?php _e( 'Select color for the category', 'fairpixels'); ?></p></td>
				</tr>
		
			<tbody>
		</table>
		<?php 
}
	
function fp_category_meta_save_field( $term_id ) {	    
		if ( isset( $_POST['fp_category_meta'] ) ) {			
			$t_id = $term_id;		 
		  	$fp_category_meta = get_option( "fp_category_meta_color_$t_id" );		  
		  	$cat_keys = array_keys($_POST['fp_category_meta']);		 
		    foreach ($cat_keys as $key){		    
		      	if (isset($_POST['fp_category_meta'][$key])){		          
		         	 $fp_category_meta[$key] = $_POST['fp_category_meta'][$key];		      
		      	} else {			   		
			   		unset($fp_category_meta[$key]);				
				}		 
		  	}		  
		  update_option( 'fp_category_meta_color_' . $t_id, $fp_category_meta );		
		} else {			
			delete_option( 'fp_category_meta_color_' . $term_id );		
		}	
	}