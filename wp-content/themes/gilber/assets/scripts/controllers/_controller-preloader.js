/***********************************************
 * SITE: PRELOADER
 ***********************************************/
(function ($) {
	'use strict';

	// check if plugin defined
	if (typeof $.fn.animsition == 'undefined') {
		return;
	}

	var preloader = $('.animsition');

	preloader.animsition({
		inDuration: 500,
		outDuration: 500,
		loadingParentElement: 'html',
		linkElement: 'a:not([target="_blank"]):not([href^="#"]):not([rel="nofollow"]):not([href~="#"]):not([href^=mailto]):not([href^=tel]):not(.sf-with-ul)',
		loadingClass: 'animsition-loading-2',
		loadingInner: '<div class="spinner"><span class="double-bounce-one"></span><span class="double-bounce-two"></span></div>',
	});

	preloader.on('animsition.inEnd', function () {
		VLTJS.window.trigger('vlt.preloader_done');
		VLTJS.html.addClass('vlt-is-page-loaded');
	});

})(jQuery);