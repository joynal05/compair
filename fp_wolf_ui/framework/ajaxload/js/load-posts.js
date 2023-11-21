jQuery(document).ready(function($) {	
	var pageNum = parseInt(pbd_alp.startPage) + 1;	
	var max = parseInt(pbd_alp.maxPages);
	var nextLink = pbd_alp.nextLink;
	var loadingText = pbd_alp.loadingText;
	var moreText = pbd_alp.moreText;
	var noText = pbd_alp.noText;
	
	if(pageNum <= max) {
		$('.load-more').html('<a id="fp-load-posts" href="#"><i class="fa fa-long-arrow-down"></i>'+ moreText +'</a>');
	}	
	
	$('#fp-load-posts').click(function(e) {
		e.preventDefault();
		
		if(pageNum <= max) {
			$(this).html('<i class="fa fa-spinner fa-spin"></i>'+ loadingText);
			
			$.get( nextLink, function( data ) {
				var el = $(data).find('.masonary-list').html();					
				
				var elems = $( el );	
				var container = $(".masonary-list");
				
				elems.hide();				
				container.append( elems.fadeIn() );				
				

				pageNum++;
				nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
				
								
				if (!$("#main").find('.gotop').length) {
					var r= $('<div class="gotop"><i class="fa fa-long-arrow-up"></i></div>');
					$(r).hide().appendTo("#main").fadeIn(1000);
				}
				
				
				if(pageNum <= max) {
					$('#fp-load-posts').html('<i class="fa fa-long-arrow-down"></i>'+ moreText);
					
				} else {
					$('#fp-load-posts').addClass('inactive').html('<i class="fa fa-spinner"></i>'+ noText);
				}
				
			});
		}	
		
		return false;
	});
});