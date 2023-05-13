// Check device type

const isMac = navigator.platform.toLowerCase().indexOf('mac') !== -1;
const isIpad = navigator.platform.toLowerCase().indexOf('ipad') !== -1;
const isIphone = navigator.platform.toLowerCase().indexOf('iphone') !== -1;

if (isMac || isIpad || isIphone) {
	document.body.classList.add('apple');

	if (isMac) {
		document.body.classList.add('-macbook');
	}

	if (isIpad) {
		document.body.classList.add('-ipad');
	}

	if (isIphone) {
		document.body.classList.add('-iphone');
	}
}

// Check device size

let isPc = window.innerWidth > 1260;
let isTablet = window.innerWidth > 760 && window.innerWidth <= 1190;
let isMobile = window.innerWidth <= 760;

function checkDeviceSize() {
	isPc = window.innerWidth > 1260;
	isTablet = window.innerWidth > 760 && window.innerWidth <= 1190;
	isMobile = window.innerWidth <= 760;
}

window.addEventListener('resize', checkDeviceSize);

// Set window innerHeight in CSS

function setCssWindowInnerHeight() {
	document.documentElement.style.setProperty(
		'--window-inner-height',
		window.innerHeight+'px'
	);
}

window.addEventListener('DOMContentLoaded', setCssWindowInnerHeight);
window.addEventListener('resize', setCssWindowInnerHeight);

// Block scroll of body

const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;

function lockScroll() {
	if ($('html').hasClass('-is-locked')) {
		let scrollTop = $('html').attr('data-scroll');

		$('html').removeClass('-is-locked');
		$('html').css('right', 0);

		$(document).scrollTop(scrollTop);
	} else {
		let scrollTop = window.pageYOffset;

		$('html').addClass('-is-locked');
		$('html').css('right', scrollbarWidth + 'px');

		document.body.scrollTo(0, scrollTop);
		$('html').attr('data-scroll', scrollTop);
	}
}

// JSON animations settings
function playJsonAnimation(animation) {
	animation.setDirection(1);
	animation.play();
}

function stopJsonAnimation(animation) {
	animation.setDirection(-1);
	animation.play();
}

function addJsonAnimationForPc(el, animation) {
	let block = el.parentNode.closest('.step');
	block.addEventListener('mouseenter', () => {
		playJsonAnimation(animation);
	});
	block.addEventListener('mouseleave', () => {
		stopJsonAnimation(animation);
	});
}

function checkAnimationPosition(el, animation) {
	let windowWidth = window.innerWidth;
	let windowHeight = window.innerHeight;

	let offset = el.getBoundingClientRect();
	let offsetLeft = offset.left;
	let offsetRight = offset.right;
	let offsetTop = offset.top;
	let offsetBottom = offset.bottom;

	let checkLeft = offsetLeft < 0 ? false : true;
	let checkRight = offsetRight > windowWidth ? false : true;
	let checkPositionWidth = checkLeft && checkRight;

	let checkTop = offsetTop < 0 ? false : true;
	let checkBottom = offsetBottom > windowHeight ? false : true;
	let checkPositionHeight = checkTop && checkBottom;

	let checkPosition = checkPositionWidth && checkPositionHeight;

	if (checkPosition) {
		playJsonAnimation(animation);
	} else {
		stopJsonAnimation(animation);
	}
}
function addJsonAnimationForMobile (el, animation) {
	checkAnimationPosition(el, animation);
}
var ar_animation={};

// Products slider
$(function() {
	
	$('a[href="#open_chat"]').on('click', function(e) {
		e.preventDefault();
		window.tidioChatApi.open();
	});
	
	if ($('.anim_number_percent').length) {
		$('.anim_number_percent').each(function() {
			var $this=$(this);
			var val=$this.html().trim().trim('%');
			$this.html('<span style="font:inherit;">'+val.replace('%','')+'</span>%');
		});
		var num_anim_func=function() {
			$('.anim_number_percent').each(function() {
				var $this=$(this);
				var scrtop=$(window).scrollTop()+$(window).innerHeight();
				if (!$this.hasClass('-animated')) {
					var eltop=$this.offset().top;
					if (scrtop>eltop) {
						var num=$this.find('span').html().trim();
						$this.addClass('-animated').find('span').animateNumber({
							number: num,
						}, {
							duration: 1000,
						});
					}
				}
			});
		};
		$(window).on('scroll', num_anim_func);
		num_anim_func();
	}
	if ($('.testimonial-videos-slider').length) {
		var mySwiperTestimoinal = new Swiper('.testimonial-videos-slider', {
			loop: false,
			speed: 400,
			slidesPerGroup: 1,
			slidesPerView: 1,
			// slidesPerView: 'auto',
			pagination: {
				el: '.testimonial-videos-pagination',
				type: 'bullets',
				clickable: true
			},
			spaceBetween: 15,
			on: {
				init: function (sw) {
					// $('.swiper-counter').html('1/'+sw.slides.length)
				},
			},
		});
		mySwiperTestimoinal.on('slideChange', function (sw) {
			$('.testimonial-videos-slider').find('video').each(function() {this.pause();});
			// $('.swiper-counter').html((sw.activeIndex+1)+'/'+sw.slides.length)
		});
	}
	
	
	if ($('.swiper').length) {
		const breakpoint = window.matchMedia('(min-width:1001px)');
		// let mySwiper;
		/*const breakpointChecker = function () {
			if (breakpoint.matches === true) {
				// console.log(mySwiper);
				if (mySwiper !== undefined) {
					mySwiper.destroy(true, true); //mySwiper[0].destroy(true, true);
				}
				return;
			} else if (breakpoint.matches === false) {
				return enableSwiper();
			}
		};*/
		// const enableSwiper = function () {
			var mySwiper = new Swiper('.swiper', {
				loop: false,
				speed: 400,
				slidesPerGroup: 1,
				slidesPerView: 'auto',
				breakpoints: {
					0: {
						spaceBetween: 15,
					},
					751: {
						spaceBetween: 30,
					},
				},
				on: {
					init: function(sw) {

					}
				}
			});
			/*mySwiper.on('slideChangeTransitionEnd', () => {
				$('.json-animation').each(function(index) {
					checkAnimationPosition(this, ar_animation[index]);
				});
			});*/
		// };
		// breakpoint.addListener(breakpointChecker);
		// breakpointChecker();
		
		$('.json-animation').each(function(index) {
			var that=this;
			ar_animation[index] = lottie.loadAnimation({
				container: that,
				renderer: 'svg',
				loop: false,
				autoplay: false,
				path: window.template_directory_uri+'/video/jsons/block_'+(index + 1)+'.json',
				name: 'lottie-animation-'+index,
			});
			$(that).data('name', ar_animation[index].name);
			ar_animation[index].pause();
			ar_animation[index].addEventListener('data_ready', function () {
				if (window.innerWidth >= 1001) {
					addJsonAnimationForPc(that, ar_animation[index]);
				} else {
					addJsonAnimationForMobile(that, ar_animation[index]);
				}
			});
		});
	}
	if ($('.team_swiper').length) {
		var mySwiperTeam = new Swiper('.team_swiper', {
			loop: false,
			speed: 400,
			slidesPerGroup: 1,
			// slidesPerView: 1,
			slidesPerView: 'auto',
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			spaceBetween: 15,
			on: {
				init: function (sw) {
					$('.swiper-counter').html('1/'+sw.slides.length)
				},
			},
		});
		mySwiperTeam.on('slideChange', function (sw) {
			$('.swiper-counter').html((sw.activeIndex+1)+'/'+sw.slides.length)
		});
	}

// Open/Close modal window
	if ($('.modal-wrapper').length) {
		function preparingModal() {
			$('.modal-wrapper').removeClass('-hide');
		}

		function showModal() {
			lockScroll();
			$('.modal-wrapper').addClass('-active');
		}
		function closeModal() {
			lockScroll();
			$('.modal-wrapper').removeClass('-active');
		}

		function swipeInModal() {
			$('.swipe-button').swipe({
				swipeDown: function (event) {
					lockScroll();
					$(this).closest('.modal-wrapper').removeClass('-active');
				},
				threshold: 30,
			});
		}

		$(window).on('load', swipeInModal);
		$(window).on('load', preparingModal);

		$('.open-modal').on('click', showModal);
		$('.close-modal').on('click', closeModal);
	}
});

// Input settings

$('input').on('input', function () {
	let value = $(this).val();

	if (value.length > 0) {
		$(this).addClass('-active');
	} else {
		$(this).removeClass('-active');
	}
});

// Input only numbers

if ($('.--only-number').length) {
	$('.--only-number').bind('change keyup input click', function () {
		if (this.value.match(/[^0-9]/g)) {
			this.value = this.value.replace(/[^0-9]/g, '');
		}
	});
}

// Form validation

let formSending = false;

function noValidFunction(ths) {
	$(ths).addClass('-no-valid');
}

function validFunction(ths) {
	$(ths).addClass('-valid');
}

function checkEmail(email) {
	const reg =
		/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{1,}))$/;
	const isValid = reg.test(String(email).toLowerCase());

	return isValid;
}

function takeHeightForThanksWindow() {
	if (isMobile) return;

	const getContainer = $('.thanks__block');
	const getFormWindow = getContainer.find('.thanks__form');
	const getThanksWindow = getContainer.find('.thanks');

	let getHeightFormWindow = getFormWindow.outerHeight();
	let getHeightThanksWindow = getThanksWindow.outerHeight();
	let getBiggerHeight =
		getHeightFormWindow > getHeightThanksWindow
			? getHeightFormWindow
			: getHeightThanksWindow;

	getContainer.height(getBiggerHeight);
}

function showThanksWindow(ths) {
	const getContainer = $(ths).closest('.thanks__block');

	getContainer.addClass('-send');
}

$(window).on('load', takeHeightForThanksWindow);

$('.feedback_form').on('submit', function (e) {
	e.preventDefault();
	
	var form=this;
	let isValid = true;

	$(this).find('input').removeClass('-no-valid -valid');

	if (isValid && formSending == false) {
		formSending = true;
		var data=new FormData(form);


		data.append('ajax', 'feedback_send');
		var number = window.iti.getNumber(intlTelInputUtils.numberFormat.E164);
		var countryData = window.iti.getSelectedCountryData();

		data.append('number_phone', number);
		data.append('code_phone', '+'+countryData.dialCode);
		$.ajax({
			type: 'post',
			url: '/ajax.php',
			data: data,
			processData: false,
			contentType: false,
			success: function (reply) {
				if (reply == 'success') {
					form.reset();
					if ($(form).closest('.thanks__block').length) {
						showThanksWindow(form);
					}
					if(typeof gtag == 'function') {
						gtag('event', 'conversion', {'send_to': 'AW-10811891125/jVOzCO2L-acDELW7waMo'});
					}
				} else {
					alert('Error sending message: '+reply);
				}
				formSending = false;
			},
			error: function () {
				formSending = false;
				alert('Error sending message. Please check Internet connection.')
			},
		});
	}
});
function getParams(url = window.location) {
	// Create a params object
	let params = {};
	new URL(url).searchParams.forEach(function (val, key) {
		if (params[key] !== undefined) {
			if (!Array.isArray(params[key])) {
				params[key] = [params[key]];
			}
			params[key].push(val);
		} else {
			params[key] = val;
		}
	});
	return params;
}
$(function() {
	var urlParams = getParams();
	if(typeof urlParams.page !== 'undefined' && urlParams.page == 'thanks') {
		// alert(1);
		showModal();
		showThanksWindow($('.feedback_form'));

	}

});

$('input').on('focus', function () {
	$(this).removeClass('-no-valid');
});

$('input').on('input', function () {
	$(this).removeClass('-no-valid -valid');
});

// Main block | Text animation
var slideIn = null;
function preparingMainAnimationText() {
	let maxHeight = 0;
	$('.main-section')
		.find('.title li')
		.each(function () {
			let height = $(this).innerHeight();

			if (height > maxHeight) {
				maxHeight = height;
			}
		});
	$('.main-section').find('.title').height(maxHeight);
	$($('.main-section .title li')[0]).fadeIn(2000, function() {
		$($('.main-section .title li')[0]).addClass('-active')
			mainTextAnimation();
	})
}

function mainTextAnimation() {
	$(slideIn).fadeIn(1000, function() {
		slideIn.addClass('-active')
	})
}

function changeTextAnimation() {
	if (document.hasFocus()) {
		let slide = $('.main-section .title li');
		let activeSlide = $('.main-section .title li.-active');
		let nextSlide = activeSlide.next();
		
		activeSlide.fadeOut(1000, function() {
			activeSlide.removeClass('-active');

			if (nextSlide.length) {
				slideIn = nextSlide;
			} else {
				slideIn = slide.eq(0);
			}
			mainTextAnimation();
		});
	}

	setTimeout(function () {
		changeTextAnimation();
	}, 7000);
}

$(document).ready(preparingMainAnimationText);

$(window).on('load', function () {
	setTimeout(changeTextAnimation, 7000);
});

// Animation list

let listItemNumber = 0.5;

$('.animation-list')
	.find('li')
	.each(function () {
		$(this).css({
			transitionDelay: listItemNumber+'s',
		});

		listItemNumber += 0.1;
	});

// Scroll animation

function animation() {
	let scrollTop = $(this).scrollTop();

	$('.animation')
		.not('.animated')
		.each(function () {
			let offsetTop = $(this).offset().top + 50;
			let windowHeight = window.innerHeight;
			let offsetBottom = scrollTop + windowHeight;

			if (offsetBottom > offsetTop) {
				$(this).addClass('animated');
			}
		});
}

$(window).on('load scroll', animation);

// Video play
$(window).on('load', function () {
	$('video[data-src]').each(function() {
		const $video = $(this);
		const src = $video.data('src');
		$video.attr('src', src);
	})
});

$('.video-play-button').on('click', function () {
	var $this=$(this);
	var $container=$this.parent();
	var $video=$container.find('video');
	let video = $video.get(0);
	var volume=$video.data('volume');
	if (typeof volume != 'undefined') {
		volume=parseFloat(volume);
		if (!isNaN(volume)) {
			video.volume = volume;
		}
	}
	video.play();
	video.setAttribute('controls', 'controls');

	$this.addClass('-hide');

	if (!isPc) {
		$container.find('.text').addClass('-hide');
		$container.find('.button').addClass('-hide');
	}
});

if (!isPc) {
	$('.video-element-item').on('click', function () {
		this.pause();
		this.removeAttribute('controls');
		$(this).parent().find('.video-play-button').removeClass('-hide');
	});
}

$(function() {
	if ($('#phone').length) {
		const input = document.querySelector("#phone");
		window.iti = intlTelInput(input, {
		    preferredCountries: ["us", "au", "sa"],
		    utilsScript: window.template_directory_uri+"/js/lib/utils.js",
		});
	}
});

$(function() {
	/*$('.countdown').on('hurryt:finished', function(event, campaign){


	});*/
});
