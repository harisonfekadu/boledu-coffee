/***********************************************
 * WIDGET: TESTIMONIAL SLIDER
 ***********************************************/
(function ($) {

	'use strict';

	// check if plugin defined
	if (typeof Swiper === 'undefined') {
		return;
	}

	VLTJS.testimonialSlider = {
		init: function ($scope, $) {

			var testimonialSlider = $scope.find('.vlt-testimonial-slider'),
				container = testimonialSlider.find('.swiper-container'),
				anchor = testimonialSlider.data('navigation-anchor');

			var swiper = new Swiper(container, {
				init: false,
				spaceBetween: 30,
				grabCursor: true,
				loop: false,
				speed: 1000,
				navigation: {
					nextEl: $(anchor).find('.vlt-swiper-button-next'),
					prevEl: $(anchor).find('.vlt-swiper-button-prev'),
				},
				pagination: {
					el: $(anchor).find('.vlt-swiper-pagination'),
					clickable: true,
					renderBullet: function (index, className) {
						return '<span class="' + className + '"></span>';
					}
				}
			});

			swiper.init();

		}
	}

	VLTJS.window.on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction(
			'frontend/element_ready/vlt-testimonial-slider.default',
			VLTJS.testimonialSlider.init
		);
	});

})(jQuery);