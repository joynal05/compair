jQuery(document).ready(function($){
	$('select.styled').customSelect();
	
	$(".tab_block").hide();
	$(".tabs ul li:first").addClass("active").show();	
	$(".tab_block:first").show();
	
	$(".tabs ul li").click(function() {
		$(".tabs ul li").removeClass("active");
		$(this).addClass("active");
		$(".tab_block").hide();
		var activeTab = $(this).find("a").attr("href");
		$(activeTab).fadeIn(200);
		return false;
	});		
											
	$('#fp_primary_color_selector').ColorPicker({													
		onChange: function (hsb, hex, rgb) {
				$('#fp_primary_color_selector div').css('backgroundColor', '#' + hex);
				$('#fp_primary_color').val('#'+hex);
		}
	});
	
	$('#fp_second_color_selector').ColorPicker({												
		onChange: function (hsb, hex, rgb) {
				$('#fp_second_color_selector div').css('backgroundColor', '#' + hex);
				$('#fp_second_color').val('#'+hex);
		}
	});	
		
	$('#fp_text_color_selector').ColorPicker({													
		onChange: function (hsb, hex, rgb) {
				$('#fp_text_color_selector div').css('backgroundColor', '#' + hex);
				$('#fp_text_color').val('#'+hex);
		}
	});
	
	$('#fp_links_color_selector').ColorPicker({													
		onChange: function (hsb, hex, rgb) {
				$('#fp_links_color_selector div').css('backgroundColor', '#' + hex);
				$('#fp_links_color').val('#'+hex);
		}
	});
	
	$('#fp_links_hover_color_selector').ColorPicker({													
		onChange: function (hsb, hex, rgb) {
				$('#fp_links_hover_color_selector div').css('backgroundColor', '#' + hex);
				$('#fp_links_hover_color').val('#'+hex);
		}
	});
	
		
	$("#fp_custom_sidebar_add_button").click(function() {
		var custom_sidebar_name = $('#fp_custom_sidebar_name').val();
		if( custom_sidebar_name.length > 0){
			$('#fp_options_sidebar_list').append('<li><div class="sidebar-block">'+custom_sidebar_name+' <input name="fp_options[fp_custom_sidebars][]" type="hidden" value="'+custom_sidebar_name+'" /><a class="sidebar-remove"></a></div></li>');
			$('#custom-sidebars select').append('<option value="'+custom_sidebar_name+'">'+custom_sidebar_name+'</option>');
		}
		$('#fp_custom_sidebar_name').val('');

	});	
	
	$(".sidebar-remove").live("click" , function() {
		var option = $(this).parent().find('input').val();
		$(this).parent().parent().addClass('removered').fadeOut(function() {
			$(this).remove();
			$('#custom-sidebars select').find('option[value="'+option+'"]').remove();

		});
	});		
	

	$("#sidebar-position-options input:checked").parent().addClass("selected");
	$("#sidebar-position-options .checkbox-select").click(
		function(event) {
			event.preventDefault();
			$("#sidebar-position-options li").removeClass("selected");
			$(this).parent().addClass("selected");
			$(this).parent().find(":radio").attr("checked","checked");			 
		}
	);	
				
});

jQuery(document).ready(function ($) {
	setTimeout(function () {
		$(".fade").fadeOut("slow", function () {
			$(".fade").remove();
		});
	}, 2000);
});