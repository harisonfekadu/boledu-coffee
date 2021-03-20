/***********************************************
 * WIDGET: PORTFOLIO SLIDER
 ***********************************************/
(function ($) {

	'use strict';

	// check if plugin defined
	if (typeof Swiper === 'undefined') {
		return;
	}

	VLTJS.portfolioSlider = {
		init: function ($scope, $) {

			var portfolioSlider = $scope.find('.vlt-portfolio-slider'),
				container = portfolioSlider.find('.swiper-container'),
				anchor = portfolioSlider.data('navigation-anchor'),
				project = portfolioSlider.find('.vlt-project');

			var swiper = new Swiper(container, {
				init: false,
				spaceBetween: 0,
				grabCursor: true,
				effect: 'fade',
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

			project.each(function () {

				var $this = $(this),
					backgroundContainer = project.closest('.vlt-section').find('.vlt-section__projects-background'),
					image = $this.data('image');

				$('<img src="' + image + '" alt="" loading="lazy">').appendTo(backgroundContainer);

			});

			swiper.on('init slideChange', function () {

				var current = swiper.realIndex,
					sectionsBackgroundImage = $('.vlt-section__projects-background>img');

				sectionsBackgroundImage.removeClass('is-active');
				sectionsBackgroundImage.eq(current).addClass('is-active');

			});

			swiper.init();

		}
	}

	VLTJS.window.on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction(
			'frontend/element_ready/vlt-portfolio-slider.default',
			VLTJS.portfolioSlider.init
		);
	});

})(jQuery);