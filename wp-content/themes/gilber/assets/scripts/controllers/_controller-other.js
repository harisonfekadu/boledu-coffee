/***********************************************
 * GILBER: OTHER SCRIPTS
 ***********************************************/
(function ($) {
	'use strict';

	// Jarallax
	if (typeof $.fn.jarallax !== 'undefined') {
		$('.jarallax').jarallax({
			speed: 0.9
		});
	}

	// Widget menu
	if (typeof $.fn.superclick !== 'undefined') {
		$('.widget_pages > ul, .widget_nav_menu ul.menu').superclick({
			delay: 300,
			cssArrows: false,
			animation: {
				opacity: 'show',
				height: 'show'
			},
			animationOut: {
				opacity: 'hide',
				height: 'hide'
			},
		});
	}

	// Fast click
	if (typeof FastClick === 'function') {
		FastClick.attach(document.body);
	}

	// Fitvids
	if (typeof $.fn.fitVids !== 'undefined') {
		VLTJS.body.fitVids();
	}

	// Masonry blog
	$('.masonry').vlt_masonry_grid();

})(jQuery);