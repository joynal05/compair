jQuery(document).ready(function($){
	
	$('select.styled').customSelect();
	
	if ($('#fp_meta_post_show_gallery').is(':checked')) {		
		$('#fp-post-meta-images').css('display', 'block');
	}

	$('#fp_meta_post_show_gallery').click(function(){
		if (this.checked) {		
			$('#fp-post-meta-images').slideDown();
		} else {
			$('#fp-post-meta-images').slideUp();
		}
	});	
	
		
	 $(".image-list ul").sortable({
			placeholder: "highlight",
			start: function (event, ui) {
					ui.item.toggleClass("highlight");
			},
			stop: function (event, ui) {
					ui.item.toggleClass("highlight");
			}
	});
	
	
	var custom_uploader;
	
	$('.meta-field').on('click','.upload-post-img-btn',function(e){
		e.preventDefault();
		
		if (custom_uploader) {
            custom_uploader.open();
            return;
        }
		
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Select Images',
			library: {
				type: 'image'
			},
			multiple: false
		});
	
	
		custom_uploader.on('select', function() {
			attachment = custom_uploader.state().get('selection').first().toJSON();
				var thumbnail_id = attachment.id;
				var thumbnail_url = attachment.sizes.thumbnail.url;
				
				if (thumbnail_url != ''){
					$('.selected-images .image-list ul').append( '<li><div class="thumb"><img src="'+thumbnail_url+'" /><input type="hidden" name="fp_meta_gallery_img_id[]" value="'+thumbnail_id+'" /></div><div class="image-settings"><span class="remove"><i class="fa fa-times "></i></span></div></li>' )
				}
		});
	
		custom_uploader.open();
		
	});	
	
	$('.selected-images').on('click','.remove',function(){
		var image_li = $(this).closest('li');
		image_li.fadeOut( function(){jQuery(this).remove();} );

    });	
	
});