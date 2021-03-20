/***********************************************
 * SITE: ANIMATED BLOCK
 ***********************************************/
(function ($) {

	'use strict';

	VLTJS.animatedBlock = {
		init: function () {

			var animatedBlock = $('.vlt-animate-element'),
				prefix = 'animate__';

			if ($('.vlt-fullpage-slider').length) {

				VLTJS.window.on('vlt.change-slide', function () {
					animatedBlock.each(function () {
						var $this = $(this);
						var animationName = $this.data('animation-name');
						$this.removeClass(prefix + 'animated').removeClass(prefix + animationName);
						if ($this.parents('.vlt-section').hasClass('active')) {
							$this.addClass(prefix + 'animated').addClass(prefix + animationName);
						}
					});
				});

			} else {
				animatedBlock.each(function () {
					var $this = $(this);
					$this.one('inview', function () {
						var animationName = $this.data('animation-name');
						$this.addClass(prefix + 'animated').addClass(prefix + animationName);
					});
				});
			}
		}
	};

	VLTJS.animatedBlock.init();

})(jQuery);