jQuery(document).ready(function($){
		
	$('#fp_cat_color_selector').ColorPicker({								
		onChange: function (hsb, hex, rgb) {
				$('#fp_cat_color_selector div').css('backgroundColor', '#' + hex);
				$('#fp_cat_meta_color').val('#'+hex);
		}
	});
	
	
});