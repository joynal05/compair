jQuery(document).ready(function ($) {
	// $('.top-menu ul').slicknav({
	// 	prependTo:'.top-bar .inner-wrap'
	// });

	// $('.primary-menu .sf-menu').slicknav({
	// 	prependTo:'.menu-section .inner-wrap'
	// });

	// $('.footer-menu ul').slicknav({
	// 	prependTo:'.footer-menu .inner-wrap'
	// });

	//$('.mobile_nav').slicknav();  
	$('.sf-menu').slicknav({
		prependTo: '#mobile_nav_wrapper'
		//init: function() { alert('menu opened') }
	});

	$('#mobile_nav_wrapper').on('click', '.slicknav_btn', function () {
		var menu = $(this).next(".slicknav_nav");
		if (menu.hasClass("slicknav_hidden")) {
			$("body").removeClass("menu_open");
		}
		else {
			$("body").addClass("menu_open");
		}
	});



	$(".primary-menu .sub-menu").wrap('<div class="sub-menu-wrap"><div class="inner-wrap"></div></div>');
	$('.primary-menu').show();
	$('.primary-menu ul.sf-menu').superfish({
		hoverClass: 'over',
		animation: { opacity: 'show', height: 'show' },
		speed: 150,
		autoArrows: true,
		dropShadows: true,
		delay: 0
	});

	$('.post-list').show();
	$('.slider-full').show();


	$(window).scroll(function () {
		if ($(this).scrollTop() > 220) {
			$('.gotop').fadeIn(500);
		} else {
			$('.gotop').fadeOut(500);
		}
	});

	$('.gotop').click(function (event) {
		event.preventDefault();
		$('html, body').animate({ scrollTop: 0 }, 400);
		return false;
	})

	$('.feat-slider').fadeIn();

	$('.tagcloud a').append('<i class="fa fa-tag"></i>');

	$('.excerpt-slider').show();
	$('.excerpt-slider').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: true,
		slideshow: true,
		controlsContainer: ".excerpt-slider-nav",
	});

	jQuery("iframe").each(function () {
		var ifr_source = jQuery(this).attr('src');
		var wmode = "wmode=transparent&showinfo=0;";
		if (ifr_source.indexOf('?') != -1) jQuery(this).attr('src', ifr_source + '&' + wmode);
		else jQuery(this).attr('src', ifr_source + '?' + wmode);
	});
});