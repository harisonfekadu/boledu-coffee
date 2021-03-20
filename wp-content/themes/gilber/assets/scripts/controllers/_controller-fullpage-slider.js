/***********************************************
 * SITE: FULLPAGE SLIDER
 ***********************************************/
(function ($) {

	'use strict';

	// check if plugin defined
	if (typeof $.fn.pagepiling == 'undefined') {
		return;
	}

	VLTJS.fullpageSlider = {

		init: function () {

			var fullpageSlider = $('.vlt-fullpage-slider'),
				progressBar = fullpageSlider.find('.vlt-fullpage-slider-progress-bar'),
				loopTop = fullpageSlider.data('loop-top') ? true : false,
				loopBottom = fullpageSlider.data('loop-bottom') ? true : false,
				speed = fullpageSlider.data('speed') || 800,
				anchors = [];

			if (!fullpageSlider.length) {
				return;
			}

			$('.vlt-offcanvas-menu ul.sf-menu > li:first-of-type, .vlt-default-menu__navigation ul.sf-menu > li:first-of-type').addClass('active');

			VLTJS.body.css('overflow', 'hidden');
			VLTJS.html.css('overflow', 'hidden');

			fullpageSlider.find('[data-anchor]').each(function () {
				anchors.push($(this).data('anchor'));
			});

			function vlthemes_navbar_solid() {
				if (fullpageSlider.find('.pp-section.active').scrollTop() > 0) {
					$('.vlt-navbar').addClass('vlt-navbar--solid');
				} else {
					$('.vlt-navbar').removeClass('vlt-navbar--solid');
				}
			}
			vlthemes_navbar_solid();

			function vlthemes_navigation() {
				var total = fullpageSlider.find('.vlt-section').length,
					current = fullpageSlider.find('.vlt-section.active').index(),
					scale = (current + 1) / total;
				progressBar.find('span').css({
					'transform': 'scaleY(' + scale + ')'
				});
			}

			fullpageSlider.pagepiling({
				menu: '.vlt-offcanvas-menu ul.sf-menu, .vlt-default-menu__navigation ul.sf-menu',
				scrollingSpeed: speed,
				loopTop: loopTop,
				loopBottom: loopBottom,
				anchors: anchors,
				sectionSelector: '.vlt-section',
				navigation: false,
				afterRender: function () {
					vlthemes_navigation();
					VLTJS.window.trigger('vlt.change-slide');
				},
				onLeave: function () {
					vlthemes_navigation();
					VLTJS.window.trigger('vlt.change-slide');
				},
				afterLoad: function () {
					vlthemes_navbar_solid();
				}
			});

			fullpageSlider.find('.pp-scrollable').on('scroll', function () {
				var scrollTop = $(this).scrollTop();
				if (scrollTop > 0) {
					$('.vlt-navbar').addClass('vlt-navbar--solid');
				} else {
					$('.vlt-navbar').removeClass('vlt-navbar--solid');
				}
			});

		}
	};

	VLTJS.fullpageSlider.init();

})(jQuery);