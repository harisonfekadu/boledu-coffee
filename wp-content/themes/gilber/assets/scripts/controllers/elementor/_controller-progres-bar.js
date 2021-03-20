/***********************************************
 * WIDGET: PROGRESS BAR
 ***********************************************/
(function ($) {

	'use strict';

	// check if plugin defined
	if (typeof gsap == 'undefined') {
		return;
	}

	VLTJS.progressBar = {
		init: function ($scope, $) {

			var progressBar = $scope.find('.vlt-progress-bar'),
				final_value = progressBar.data('final-value') || 0,
				animation_duration = progressBar.data('animation-speed') || 0,
				delay = 500,
				obj = {
					count: 0
				};

			if (VLTJS.body.hasClass('page-template-template-fullpage-slider')) {
				VLTJS.progressBar.initProgressBarForSlider(progressBar, obj, animation_duration, final_value, delay);
			} else {
				VLTJS.progressBar.initProgressBar(progressBar, obj, animation_duration, final_value, delay);
			}

		},
		initProgressBar: function (progressBar, obj, animation_duration, final_value, delay) {

			progressBar.one('inview', function () {
				gsap.to(obj, (animation_duration / 1000) / 2, {
					count: final_value,
					delay: delay / 1000,
					onUpdate: function () {
						progressBar.find('.vlt-progress-bar__title > .counter').text(Math.round(obj.count));
					}
				});

				gsap.to(progressBar.find('.vlt-progress-bar__bar > span'), animation_duration / 1000, {
					width: final_value + '%',
					delay: delay / 1000
				});
			});

		},
		initProgressBarForSlider: function (progressBar, obj, animation_duration, final_value, delay) {
			function start() {
				if (progressBar.parents('.vlt-section').hasClass('active')) {

					obj.count = 0;

					progressBar.find('.vlt-progress-bar__title > .counter').text(Math.round(obj.count));

					gsap.set(progressBar.find('.vlt-progress-bar__bar > span'), {
						width: 0
					});

					gsap.to(obj, (animation_duration / 1000) / 2, {
						count: final_value,
						delay: delay / 1000,
						onUpdate: function () {
							progressBar.find('.vlt-progress-bar__title > .counter').text(Math.round(obj.count));
						}
					});

					gsap.to(progressBar.find('.vlt-progress-bar__bar > span'), animation_duration / 1000, {
						width: final_value + '%',
						delay: delay / 1000
					});

				}
			}
			VLTJS.window.on('vlt.change-slide', start);
			start();
		}
	}

	VLTJS.window.on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction(
			'frontend/element_ready/vlt-progress-bar.default',
			VLTJS.progressBar.init
		);
	});

})(jQuery);