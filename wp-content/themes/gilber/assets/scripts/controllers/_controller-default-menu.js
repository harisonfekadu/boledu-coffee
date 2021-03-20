/***********************************************
 * SITE: MENU DEFAULT
 ***********************************************/
(function ($) {

	'use strict';

	// check if plugin defined
	if (typeof $.fn.superfish == 'undefined') {
		return;
	}

	VLTJS.menuDefault = {
		init: function () {

			var menu = $('.vlt-default-menu__navigation'),
				navigation = menu.find('ul.sf-menu');

			navigation.superfish({
				popUpSelector: 'ul.sub-menu',
				delay: 0,
				speed: 300,
				speedOut: 300,
				cssArrows: false,
				animation: {
					opacity: 'show',
					marginTop: '0',
					visibility: 'visible'
				},
				animationOut: {
					opacity: 'hide',
					marginTop: '10px',
					visibility: 'hidden'
				}
			});

		}
	}

	VLTJS.menuDefault.init();

})(jQuery);