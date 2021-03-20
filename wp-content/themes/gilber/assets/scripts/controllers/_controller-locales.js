/***********************************************
 * SITE: LOCALES
 ***********************************************/
(function ($) {

	'use strict';

	VLTJS.locales = {

		init: function () {

			var navbarLocales = $('.vlt-language-switcher'),
				navbarLocalesLink = navbarLocales.find('.glink'),
				keyValue = document['cookie'].match('(^|;) ?googtrans=([^;]*)(;|$)');

			keyValue = keyValue ? keyValue[2].split('/')[2] : null;

			function set_default_locales() {

				navbarLocalesLink.removeClass('is-active');

				navbarLocalesLink.each(function () {

					var currentLink = $(this),
						attribute = currentLink.attr('onclick');

					if (keyValue !== null) {

						if (attribute.indexOf(keyValue) !== -1) {
							currentLink.addClass('is-active');
						}

					} else {

						navbarLocales.each(function () {
							$(this).find('.glink').eq(0).addClass('is-active');
						});

					}

				});

			}

			set_default_locales();

			navbarLocales.on('click', '.glink', function () {
				var text = $(this).text();
				navbarLocalesLink.removeClass('is-active');
				navbarLocales.find('.glink:contains(' + text + ')').addClass('is-active');
			});

		}

	};

	VLTJS.locales.init();

})(jQuery);