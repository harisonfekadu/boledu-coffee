/***********************************************
 * WIDGET: SIMPLE IMAGE
 ***********************************************/
(function ($) {

	'use strict';

	VLTJS.simpleImage = {
		init: function ($scope, $) {

			var simpleImage = $scope.find('.vlt-simple-image'),
				mask = simpleImage.find('.vlt-simple-image__mask');

			simpleImage.on('inview', function () {
				mask.addClass('active');
			});

		}
	}

	VLTJS.window.on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction(
			'frontend/element_ready/vlt-simple-image.default',
			VLTJS.simpleImage.init
		);
	});

})(jQuery);