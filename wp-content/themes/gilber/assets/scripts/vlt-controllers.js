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
/***********************************************
 * SITE: NAVBAR
 ***********************************************/
(function ($) {
	'use strict';

	var navbarMain = $('.vlt-navbar--main'),
		navbarHeight = navbarMain.outerHeight(),
		navbarMainOffset = 0;

	// fake navbar
	var navbarFake = $('<div class="vlt-fake-navbar">').hide();

	// fixed navbar
	function _fixed_navbar() {
		navbarMain.addClass('vlt-navbar--fixed');
		navbarFake.show();
		// add solid color
		if (navbarMain.hasClass('vlt-navbar--transparent') && navbarMain.hasClass('vlt-navbar--sticky')) {
			navbarMain.addClass('vlt-navbar--solid');
		}
	}

	function _unfixed_navbar() {
		navbarMain.removeClass('vlt-navbar--fixed');
		navbarFake.hide();
		// remove solid color
		if (navbarMain.hasClass('vlt-navbar--transparent') && navbarMain.hasClass('vlt-navbar--sticky')) {
			navbarMain.removeClass('vlt-navbar--solid');
		}
	}

	function _on_scroll_navbar() {
		if (VLTJS.window.scrollTop() > navbarMainOffset) {
			_fixed_navbar();
		} else {
			_unfixed_navbar();
		}
	}

	if (navbarMain.hasClass('vlt-navbar--sticky')) {
		VLTJS.window.on('scroll resize', _on_scroll_navbar);
		_on_scroll_navbar();
		// append fake navbar
		navbarMain.after(navbarFake);
		// fake navbar height after resize
		navbarFake.height(navbarHeight);
		VLTJS.debounceResize(function () {
			navbarFake.height(navbarHeight);
		});
	}

})(jQuery);
/***********************************************
 * SITE: MENU OFFCANVAS
 ***********************************************/
(function ($) {

	'use strict';

	var menuIsOpen = false;

	VLTJS.menuOffcanvas = {
		config: {
			easing: 'power2.out'
		},
		init: function () {
			var menu = $('.vlt-offcanvas-menu'),
				navigation = menu.find('ul.sf-menu'),
				navigationItem = navigation.find('> li'),
				header = $('.vlt-offcanvas-menu__header'),
				footer = $('.vlt-offcanvas-menu__footer > div'),
				menuOpen = $('.js-offcanvas-menu-open'),
				menuClose = $('.js-offcanvas-menu-close'),
				siteOverlay = $('.vlt-site-overlay');

			if (typeof $.fn.superclick !== 'undefined') {

				navigation.superclick({
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

			menuOpen.on('click', function (e) {
				e.preventDefault();
				if (!menuIsOpen) {
					VLTJS.menuOffcanvas.open_menu(menu, siteOverlay, navigationItem, header, footer);
				}
			});

			menuClose.on('click', function (e) {
				e.preventDefault();
				if (menuIsOpen) {
					VLTJS.menuOffcanvas.close_menu(menu, siteOverlay, navigationItem, header, footer);
				}
			});

			siteOverlay.on('click', function (e) {
				e.preventDefault();
				if (menuIsOpen) {
					VLTJS.menuOffcanvas.close_menu(menu, siteOverlay, navigationItem, header, footer);
				}
			});

			VLTJS.document.keyup(function (e) {
				if (e.keyCode === 27 && menuIsOpen) {
					e.preventDefault();
					VLTJS.menuOffcanvas.close_menu(menu, siteOverlay, navigationItem, header, footer);
				}
			});

			// Close after click to anchor.
			navigationItem.filter('[data-menuanchor]').on('click', 'a', function () {
				if (menuIsOpen) {
					VLTJS.menuOffcanvas.close_menu(menu, siteOverlay, navigationItem, header, footer);
				}
			});

		},
		open_menu: function (menu, siteOverlay, navigationItem, header, footer) {
			menuIsOpen = true;
			if (typeof gsap != 'undefined') {
				gsap.timeline({
						defaults: {
							ease: this.config.easing
						}
					})
					// set overflow for html
					.set(VLTJS.html, {
						overflow: 'hidden'
					})
					// overlay animation
					.to(siteOverlay, .3, {
						autoAlpha: 1,
					})
					// menu animation
					.fromTo(menu, .6, {
						x: '100%',
					}, {
						x: 0,
						visibility: 'visible'
					}, '-=.3')
					// header animation
					.fromTo(header, .3, {
						x: 50,
						autoAlpha: 0
					}, {
						x: 0,
						autoAlpha: 1
					}, '-=.3')
					// navigation item animation
					.fromTo(navigationItem, .3, {
						x: 50,
						autoAlpha: 0
					}, {
						x: 0,
						autoAlpha: 1,
						stagger: {
							each: .1,
							from: 'start',
						}
					}, '-=.15')
					// footer animation
					.fromTo(footer, .3, {
						x: 50,
						autoAlpha: 0
					}, {
						x: 0,
						autoAlpha: 1,
						stagger: {
							each: .1,
							from: 'start',
						}
					}, '-=.15');
			}
		},
		close_menu: function (menu, siteOverlay, navigationItem, header, footer) {
			menuIsOpen = false;
			if (typeof gsap != 'undefined') {
				gsap.timeline({
						defaults: {
							ease: this.config.easing
						}
					})
					// set overflow for html
					.set(VLTJS.html, {
						overflow: 'inherit'
					})
					// footer animation
					.to(footer, .3, {
						x: 50,
						autoAlpha: 0,
						stagger: {
							each: .1,
							from: 'end',
						}
					})
					// navigation item animation
					.to(navigationItem, .3, {
						x: 50,
						autoAlpha: 0,
						stagger: {
							each: .1,
							from: 'end',
						},
					}, '-=.15')
					// header animation
					.to(header, .3, {
						x: 50,
						autoAlpha: 0,
					}, '-=.15')
					// menu animation
					.to(menu, .6, {
						x: '100%',
					}, '-=.15')
					// set visibility menu after animation
					.set(menu, {
						visibility: 'hidden'
					})
					// overlay animation
					.to(siteOverlay, .3, {
						autoAlpha: 0
					}, '-=.6');
			}
		}
	};

	VLTJS.menuOffcanvas.init();

})(jQuery);
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
/***********************************************
 * WIDGET: TIMELINE SLIDER
 ***********************************************/
(function ($) {

	'use strict';

	// check if plugin defined
	if (typeof Swiper === 'undefined') {
		return;
	}

	VLTJS.timelineSlider = {
		init: function ($scope, $) {

			var timelineSlider = $scope.find('.vlt-timeline-slider'),
				container = timelineSlider.find('.swiper-container'),
				anchor = timelineSlider.data('navigation-anchor');

			var swiper = new Swiper(container, {
				init: false,
				spaceBetween: 120,
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
			'frontend/element_ready/vlt-timeline-slider.default',
			VLTJS.timelineSlider.init
		);
	});

})(jQuery);