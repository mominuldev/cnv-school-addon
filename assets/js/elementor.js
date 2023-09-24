(function ($, elementor) {
	"use strict";

	var CNV = {

		init: function () {

			var widgets = {
				'cnv-banner-slider.default': CNV.BannerSlider,
				'cnv-hero-static.default': CNV.Hero,
				'cnv-project-slider.default': CNV.Slider,
				'cnv-image-carousel.default': CNV.ImageCarousel,
				'cnv-blog-slider.default': CNV.BlogSlider,
				'cnv-dynamic-tabs.default': CNV.DynamicTabs,
				'cnv-feature-list-tabs.default': CNV.Tabs,
				'cnv-testimonial.default': CNV.Testimonial,
				'cnv-testimonial-creative.default': CNV.TestimonialCreative,
				'cnv-logo-carousel.default': CNV.Logo,
				'cnv-counter-list.default': CNV.CountUp,

			};
			$.each(widgets, function (widget, callback) {
				elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
			});
		},

		BannerSlider: function ($scope) {
			var slideInit = $scope.find('[data-banner]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-banner]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-banner'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});
				}
			});
		},

		Hero: function ($scope) {
			var element = $scope.find('.marquee-wrap');
			var elementtwo = $scope.find('.marquee-wrap-two');


			element.marquee({
				speed: 5, // this echos 20
				gap: 10,
				delayBeforeStart: 0,
				direction: 'right',
				duplicated: true,
				startVisible: true
			});

			elementtwo.marquee({
				speed: 5, // this echos 20
				gap: 10,
				delayBeforeStart: 0,
				direction: 'left',
				duplicated: true,
				startVisible: true
			});


			let tHero = gsap.timeline()


			var title = $('.banner__title');

			let style = title.attr('data-animation');


			if (style == 'one') {
				let heading_title = new SplitText(".banner__title", {type: 'chars', linesClass: "lineChild"});
				let heading_char = heading_title.chars

				tHero.from(heading_char, {opacity: 0, y: 70, duration: 1.5, ease: "power4.out", stagger: 0.03});
			} else if (style == 'two') {
				let heading_title = new SplitText(".banner__title", {type: "lines, words", linesClass: "lineChild"});
				let heading_char = heading_title.lines
				// tHero.from(heading_char, {duration: 1, delay: 0.3, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1});
				tHero.from(heading_char, {duration: 1, delay: 0.3, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1});
			} else if (style == 'three') {
				let heading_title = new SplitText(".banner__title", {type: 'words,chars', linesClass: "lineChild"});
				let heading_char = heading_title.chars
				gsap.set(".banner__title", { perspective: 400 });
				tHero.from(heading_char, {
					duration: 1,
					opacity: 0,
					scale: 0,
					y: 80,
					rotationX: 100,
					transformOrigin: "0% 50% -50",
					ease: "back",
					stagger: 0.05,
				});
			} else if (style == 'four') {
				let heading_title = new SplitText(".banner__title", {type: 'chars,words', linesClass: "lineChild"});
				let heading_char = heading_title.chars
				tHero.from(heading_char, {
					duration: 1, x: 70, autoAlpha: 0, stagger: 0.05
					// duration: 1, y: 50, autoAlpha: 0, stagger: 0.05
				});
			}


			var tl = gsap.timeline(),
				mySplitText = new SplitText(".banner__description", { type: "words,chars" }),
				chars = mySplitText.chars; //an array of all the divs that wrap each character

			gsap.set(".banner__description", { perspective: 400 });

			tl.from(chars, {
				duration: 1,
				opacity: 0,
				scale: 0,
				y: 80,
				rotationX: 100,
				transformOrigin: "0% 50% -50",
				ease: "back",
				stagger: 0.01,
				delay: 1.5
			});

			tHero.from(".banner__social-links li i", {
				opacity: 0,
				y:160,
				stagger: 0.2,
				duration: 1,
				ease: "back",
			})

			// Banner Button Animation
			// gsap.set(".banner-btn", { scale: 0.5, opacity: 0, y: 50, ease: "Power2.easeOut", duration: 0.1,  stagger: 0.2 });
			tHero.from('.banner-btn', {
				scale: 0.5,  opacity: 0, y: 50, ease: "Power2.easeOut", duration: 0.1,  stagger: 0.1
			});

			// tHero.from('.banner-btn', {
			// 	opacity: 0,
			// 	y: -70,
			// 	ease: "bounce",
			// 	duration: 1.5
			// }, '-=5');
		},
		
		DynamicTabs: function ($scope) {
			var tabnav = $scope.find('#cnv-dynamic-tabs-nav li');

			$('#cnv-dynamic-tabs-nav li:nth-child(1)').addClass('active');
			$('#cnv-dynamic-tabs-content .content').hide();
			$('#cnv-dynamic-tabs-content .content:nth-child(1)').show();

			if ($('#cnv-dynamic-tabs-nav li').length > 0) {
				// $('.tt-portfolio__filter').append('<li class="indicator"></li>');
				if ($('#cnv-dynamic-tabs-nav li').hasClass('active')) {
					var cLeft = $('#cnv-dynamic-tabs-nav li.active').position().left + 'px',
						cWidth = $('#cnv-dynamic-tabs-nav li.active').css('width');
					$('.tab-swipe-line').css({
						left: cLeft,
						width: cWidth
					})
				}
			}

			// Tab Click function
			tabnav.on('click', function () {
				$('#cnv-dynamic-tabs-nav li').removeClass('active');
				$(this).addClass('active');

				var cLeft = $('#cnv-dynamic-tabs-nav li.active').position().left + 'px',
					cWidth = $('#cnv-dynamic-tabs-nav li.active').css('width');
				$('.tab-swipe-line').css({
					left: cLeft,
					width: cWidth
				});

				$('#cnv-dynamic-tabs-content .content').hide();

				var activeTab = $(this).find('a').attr('href');
				$(activeTab).fadeIn(600);
				return false;
			});
		},

		Tabs: function ($scope) {
			var tabnav = $scope.find('.cnv-feature .cnv-feature__item');

			$('.cnv-feature .cnv-feature__item:nth-child(1)').addClass('active');
			$('.cnv-feature__image-wrapper .cnv-feature__image').hide();
			$('.cnv-feature__image-wrapper .cnv-feature__image:nth-child(1)').show();

			// Tab Click function
			tabnav.on('click', function () {
				$('.cnv-feature .cnv-feature__item').removeClass('active');
				$(this).addClass('active');
				$('.cnv-feature__image-wrapper .cnv-feature__image').hide();

				var activeTab = $(this).find('a').attr('href');
				$(activeTab).fadeIn(600);
				return false;
			});
		},

		Counting: function ($scope) {
			var counting = $scope.find('.countdown');

			counting.each(function (index, value) {
				var count_year = $(this).attr("data-count-year");
				var count_month = $(this).attr("data-count-month");
				var count_day = $(this).attr("data-count-day");
				var count_date = count_year + '/' + count_month + '/' + count_day;
				$(this).countdown(count_date, function (event) {
					$(this).html(
						event.strftime('<div class="counting"><span class="minus">-</span><span class="CountdownContent">%D<span class="CountdownLabel">Days</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%H <span class="CountdownLabel">Hours</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%M <span class="CountdownLabel">Minutes</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%S <span class="CountdownLabel">Seconds</span></span></div>')
					);
				});
			});
		},

		Slider: function ($scope) {
			var slideInit = $scope.find('[data-swiper]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-swiper]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-swiper'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});
				}
			});
		},

		ImageCarousel: function ($scope) {
			const imageSlider = document.querySelector("..cnv-image-slider");

			var swiper = new Swiper(".cnv-image-slider", {
				autoplay: {
					delay: 5000,
				},
				speed: 1000,
				loop: true,
				slidesPerView: 1,
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev"
				},
				on: {
					init: function () {
						$(".swiper-progress-bar").removeClass("animate");
						$(".swiper-progress-bar").removeClass("active");
						$(".swiper-progress-bar").eq(0).addClass("animate");
						$(".swiper-progress-bar").eq(0).addClass("active");

						$('.js-current-slide').text( this.realIndex + 1);
						$('.js-all-slide').text(this.slides.length -2 );
					},

					slideChange: function() {
						$('.js-current-slide').text(this.realIndex + 1);
					},

					slideChangeTransitionStart: function () {
						$(".swiper-progress-bar").removeClass("animate");
						$(".swiper-progress-bar").removeClass("active");
						$(".swiper-progress-bar").eq(0).addClass("active");
					},
					slideChangeTransitionEnd: function () {
						$(".swiper-progress-bar").eq(0).addClass("animate");
					}
				}
			});
			// $(".swiper-container").hover(function () {
			// 	swiper.autoplay.stop();
			// 	$(".swiper-progress-bar").removeClass("animate");
			// }, function () {
			// 	swiper.autoplay.start();
			// 	$(".swiper-progress-bar").addClass("animate");
			// });

		},

		BlogSlider: function ($scope) {
			var slideInit = $scope.find('[data-blog]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-blog]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-blog'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});
				}
			});
		},

		Testimonial: function ($scope) {

			var slideInit = $scope.find('[data-testi]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-testi]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-testi'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});

				}
			});
		},

		TestimonialCreative: function ($scope) {

			var slideInit = $scope.find('.cnv-creative-testimonial');
			var layout = slideInit.data('testimonial');

			if(layout == 'three'){
				var options = {
					loop: true,
					spaceBetween: 0,
					centeredSlides: true,
					slidesPerView: 3,
					speed: 700,
					freeMode: true,
					watchSlidesProgress: true,
					breakpoints: {
						'1400': {
							slidesPerView: 3,
						},
						'1200': {
							slidesPerView: 3,
						},
						'992': {
							slidesPerView: 3,
						},
						'768': {
							slidesPerView: 3,
						},
						'576': {
							slidesPerView: 3,
						},
						'0': {
							slidesPerView: 3,
							spaceBetween: 10,
						},
					},
				}
			} else  {
				var options = {
					// loop: true,
					spaceBetween: 40,
					speed: 700,
					freeMode: true,
					watchSlidesProgress: true,
					breakpoints: {
						'1400': {
							slidesPerView: 4,
						},
						'1200': {
							slidesPerView: 3,
						},
						'992': {
							slidesPerView: 3,
							spaceBetween: 30,
						},
						'768': {
							slidesPerView: 3,
						},
						'420': {
							slidesPerView: 2,
						},
						'0': {
							slidesPerView: 1,
							spaceBetween: 10,
						},
					},
				}
			}


			// Testimonial
			var swiperthumb = new Swiper(".testimonial-thumb", options);

			// Testimonial-3
			var swipertestlist = new Swiper(".cnv-creative-testimonial", {
				loop: true,
				spaceBetween: 10,
				speed: 1000,
				//  effect: 'fade',
				navigation: {
					nextEl: ".testimonial-next",
					prevEl: ".testimonial-prev",
				},
				thumbs: {
					swiper: swiperthumb,
				},
			});
		},

		Logo: function ($scope) {

			var slideInit = $scope.find('[data-logo]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-logo]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-logo'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});

				}


			});
		},

		CountUp: function ($scope) {

			var counteEl = $scope.find('[data-counter]');

			var options = {
				useEasing: true,
				useGrouping: true,
				separator: ',',
				decimal: '.',
				prefix: '',
				suffix: ''
			};

			// var counteEl = $('[data-counter]');

			if (counteEl) {
				counteEl.each(function () {
					var val = $(this).data('counter');

					var countup = new CountUp(this, 0, val, 0, 2.5, options);
					$(this).appear(function () {
						countup.start();
					}, {
						accX: 0,
						accY: 0
					})
				});
			}
		}

	};
	$(window).on('elementor/frontend/init', CNV.init);
}(jQuery, window.elementorFrontend));


// !function () {
// 	"use strict";
// 	class Heading extends elementorModules.frontend.handlers.Base {
// 		onInit(...e) {
// 			super.onInit(...e), this.handleDestroy(), this.initSplitText(), this.initTextRotator(), this.initInView()
// 		}
//
// 		getDefaultSettings() {
// 			return {
// 				selectors: {
// 					splitTextElement: "[data-split-text]",
// 					textRotatorElement: "[data-text-rotator]",
// 					inViewElement: "[data-inview]"
// 				}
// 			}
// 		}
//
// 		getDefaultElements() {
// 			const e = this.getSettings("selectors");
// 			return {
// 				$splitTextElement: this.$element.find(e.splitTextElement),
// 				$textRotatorElement: this.$element.find(e.textRotatorElement),
// 				$inViewElement: this.$element.find(e.inViewElement)
// 			}
// 		}
//
// 		initSplitText() {
// 			this.elements.$splitTextElement.liquidSplitText()
// 		}
//
// 		initCustomAnimation() {
// 			this.elements.$customAnimationElement.liquidCustomAnimations()
// 		}
//
// 		initTextRotator() {
// 			this.elements.$textRotatorElement.liquidTextRotator()
// 		}
//
// 		initInView() {
// 			this.elements.$inViewElement.liquidInView()
// 		}
//
// 		onDestroy() {
// 			this.handleDestroy(), super.onDestroy()
// 		}
//
// 		handleDestroy() {
// 			this.handleSplitTextDestroy(), this.handleTextRotatorDestroy()
// 		}
//
// 		handleSplitTextDestroy() {
// 			if (!this.elements.$splitTextElement.length) return;
// 			const e = this.elements.$splitTextElement.data("plugin_liquidSplitText");
// 			e && e.destroy()
// 		}
//
// 		handleTextRotatorDestroy() {
// 			if (!this.elements.$textRotatorElement.length) return;
// 			const e = this.elements.$textRotatorElement.data("plugin_liquidTextRotator");
// 			e && e.destroy()
// 		}
// 	}
//
// 	var SplitHeading = e => {
// 		elementorFrontend.elementsHandler.addHandler(Heading, {$element: e})
// 	};
//
// 	jQuery(window).on("elementor/frontend/init", () => {
// 			elementorFrontend.hooks.addAction("frontend/element_ready/cnv_fancy_heading.default", SplitHeading)
//
//
// 	});
// }();


// jQuery(document).ready(function ($) {
// 	const $elements = $('[data-split-text]').filter((i, el) => {
// 		const $el = $(el);
// 		const isCustomAnimation = el.hasAttribute('data-custom-animations');
// 		const hasCustomAnimationParent = $el.closest('[data-custom-animations]').length;
// 		const hasAccordionParent = $el.closest('.accordion-content').length;
// 		const hasTabParent = $el.closest('.lqd-tabs-pane').length;
// 		const webglSlideshowParent = $el.closest('[data-lqd-webgl-slideshow]').length;
// 		return !isCustomAnimation && !hasCustomAnimationParent && !hasAccordionParent && !hasTabParent && !webglSlideshowParent;
// 	});
// 	$elements.liquidSplitText();
// });