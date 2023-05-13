jQuery(function($) {
	new WOW().init();
	
	if (location.hash.replace('#','')!='faq') {
		$('.pseudo_load').css('display', 'none');
	}
	
			setTimeout(function() {
				$('.red_circle').addClass('red_circle_active');
				$('.new_white_logo').css('display', 'block');
				$('.new_green_logo').css('display', 'none');
					
				setTimeout(function() {
					
					$('body').removeClass('load');
				}, 2500);
				// $('.red_circle_out').fadeOut(700, function() {
				// 	$('body').removeClass('load');
				// });
				$(".on_load").hide(500);
				$(".after_load").show(1310);
				console.log('here');
			},8000);
	

	if ($('#typingString').length) {
			var pseudo_string_show = true;
			new TypeIt('#typingString', {
				speed: 200,
				deleteSpeed: 100,
				loop: true,
				cursorSpeed: 0,
				cursorChar: ' ',
				afterString: function(step, instance) {
					// if(pseudo_string_show) {
					// 	pseudo_string_show = false;
					// 	$('.string-erase__pseudo').hide();
					// }
				},
				afterStep: function(s,e) {
					if (typeof s[1] == 'object') {
						if (s[1].cursorChr === 'underscore') {
							$('#typingString .ti-cursor').removeClass('no-opacity').html(' ');
						}
						if (s[1].cursorChr === 'dot') {
							$('#typingString .ti-cursor').addClass('no-opacity').html('.');
						}
					}
				},
			}).delete()
			.type('Memories')
			.options({cursorChr: 'dot'})
			.pause(500)
			.options({speed: 300})
			.options({cursorChr: 'underscore'})
			.pause(100)
			.delete()
			.pause(100)
			.type('Fans')
			.pause(100)
			.options({cursorChr: 'dot'})
			.pause(1600)
			.options({cursorChr: 'underscore'})
			.pause(100)
			.delete()
			/*.pause(100)
			.type('Memories')
			.pause(100)
			.options({cursorChr: 'dot'})
			.pause(10000)
			.options({cursorChr: 'underscore'})
			.pause(100)
			.delete()
			.pause(100)
			.type('Fans')
			.pause(100)
			.options({cursorChr: 'dot'})
			.pause(10000)
			.options({cursorChr: 'underscore'})
			.pause(100)
			.delete()*/
			.go();

		// setTimeout(function() {
			$('#typingString').addClass('red_text')
		// } ,3000)
		// });
	}

	$('.button-pag').click(function() {
		if($(this).hasClass('next')) {
			$('.pagination__item.right').click();
		} else {
			$('.pagination__item.left').click();
		}
	});
});

function parse_url_params() {
	var params={}
	var regex = /[?&]([^=#&]+)=?([^&#]*)/g;
	var match;
	while (match = regex.exec(window.location.href)) {
		params[match[1]]=match[2];
	}
	return params;
}

function faq_link_update(section, page) {
	if (typeof section=='undefined') {
		section=null;
	}
	if (typeof page=='undefined') {
		page=null;
	}
	var url_params=parse_url_params();
	if (typeof url_params['faq_sec'] != 'undefined' && section==null) {
		section=url_params['faq_sec'];
	}
	if (typeof url_params['faq_page'] != 'undefined' && page==null) {
		page=url_params['faq_page'];
	}
	if (page!=null) {
		page=parseInt(page);
		if (isNaN(page)) {
			page=null;
		}
	}
	var params='';
	if (page!=null && page>1) {
		params+='&faq_page='+page;
	}
	if (section!=null && section.length>0) {
		params+='&faq_sec='+section;
	}
	
	var qparams = window.location.pathname;
	if (params.length) {
		qparams = '?' + params.substr(1);
	}
	if (location.hash.length) {
		qparams +='#'+location.hash.replace('#','');
	}
	window.history.replaceState(null, null, qparams);
	
	
	$('.active_question a').each(function() {
		var $link = $(this);
		var linkhref = $link.attr('href');
		var linkend = linkhref.indexOf('?');
		if (linkend < 0) { linkend = linkhref.indexOf('#'); }
		if (linkend < 0) { linkend = linkhref.length; }
		var linkpart = linkhref.substr(0,linkend);
		var idpos = linkhref.indexOf('id');
		if (idpos < 0) { idpos = linkhref.length; }
		var newlink = params;
		var idtext = linkhref.substr(idpos);
		if (idtext.length) {
			newlink += '&' + idtext;
		}
		var aparams = '';
		if (newlink.length) {
			aparams = '?' + newlink.substr(1);
		}
		$link.attr('href', linkpart + aparams);
	});
}

// formating progress bar on left
function scrollParameters(index, nextIndex) {
	//progress bar
	var pageCount = Number($('.section').length);
	var offsetSection = Number($('.section').eq(0).offset().top);
	var textHeight = Number($('.section').eq(0).find('.text_container').offset().top + Math.abs(offsetSection));
	// var offsetSection = Number($('.section').eq(nextIndex - 1).offset().top);
	// var textHeight;
	// if (nextIndex - 1 < index) {
	// 	textHeight_up = Number($('.section').eq(nextIndex - 1).find('.text_container').offset().top + Math.abs(offsetSection));
	// 	textHeight = textHeight_up;
	// 	if (nextIndex == 1) {
	// 		textHeight_up = Number($('.section').eq(nextIndex - 1).find('.text_container').offset().top + Math.abs(offsetSection));
	// 	}
	// } else {
	// 	textHeight = Number($('.section').eq(nextIndex - 1).find('.text_container').offset().top);
	// };
	var progresHeight = Number( $(window).height() - textHeight);
	var footerOffset = Number($(window).height() - $('footer').offset().top - $('footer').height());
	var	lineLimitation = progresHeight - footerOffset;
	var heightForProgresBar = lineLimitation / (pageCount - 1);
	var topHeight = nextIndex - 2;
	// console.log(progresHeight + ', ' + footerOffset + ', ' + textHeight + ', ' + topHeight);
	$('.line_scrollbar').animate({'height': progresHeight});
	if (nextIndex > 1) {
		if (nextIndex == 2) {
			$('.line_current_slide').animate({'margin-top': '0px'}, 300);
			$('.line_scrollbar').addClass('line_scrollbar_active');
		} else {
			$('.line_current_slide').animate({'margin-top': heightForProgresBar * topHeight + 'px'}, 300);
			$('.line_scrollbar').addClass('line_scrollbar_active');
		};
	} else {
		$('.line_scrollbar').removeClass('line_scrollbar_active');
	}
	$('.line_current_slide').css({'height': heightForProgresBar + 'px'});
	$('.line_grey').css({'height': lineLimitation + 'px' })
	/*var activeSlide = $('.section').eq(nextIndex - 1).attr()
	var*/
};
// formating Price in the slider block
function formatPriceNumber(num, separator) {
	var formatter = new Intl.NumberFormat('ru', {
		maximumFractionDigits: 3
	});
	var formattedNumber = formatter.format(num);
	var re = new RegExp(String.fromCharCode(160), "g");
	var replaced = formattedNumber.replace(re, separator);

	if(separator == '.') {
		return	replaced.replace(/^0+|(\.\d*[1-9])(0+)$/g, '$1');
	} else {
		return	replaced;
	}
};
// calculate price in the slider block
function calculatingPrice() {
	var price = {
		10: {
			20: {
				'start': 11200,
				'end': 34600,
				'fee': 3995
			},
			40: {
				'start': 22400,
				'end': 69200,
				'fee': 5995,
			},
			60: {
				'start': 33600,
				'end': 103800,
				'fee': 6995,
			},
		},
		20: {
			20: {
				'start': 8200,
				'end': 31600,
				'fee': 2995
			},
			40: {
				'start': 17400,
				'end': 64200,
				'fee': 4995,
			},
			60: {
				'start': 27600,
				'end': 97800,
				'fee': 5995,
			},
		},
		30: {
			20: {
				'start': 8700,
				'end': 32100,
				'fee': 2495,
			},
			40: {
				'start': 18400,
				'end': 65200,
				'fee': 3995,
			},
			60: {
				'start': 28600,
				'end': 98800,
				'fee': 4995,
			},
		},
		50: {
			20: {
				'start': 9200,
				'end': 32600,
				'fee': 1995,
			},
			40: {
				'start': 19400,
				'end': 66200,
				'fee': 2995,
			},
			60: {
				'start': 29600,
				'end': 99800,
				'fee': 3995,
			},
		},
		100: {
			20: {
				'start': 9700,
				'end': 33100,
				'fee': 1495,
			},
			40: {
				'start': 20400,
				'end': 67200,
				'fee': 1995,
			},
			60: {
				'start': 31100,
				'end': 101300,
				'fee': 2495,
			},
		},
	}

	var selectSliderPrice = $('.red_circle_slider_active').data('priceslider');
	var selectButtonSeats = $('.active_choose_button').data('pricebutton');
	var ActiveIndex = $('.red_circle_slider_active');
	var	indexOfActiveSlide = $('.red_circle_slider').index(ActiveIndex);


	var selectPrice = price[selectSliderPrice][selectButtonSeats];
	var feeStart = $('.price_total_fee').data('fee');
	var feeEnd = selectPrice.fee;


	var startValue = $('#inform_about_price').data('priceinform');
	var startValueResult = selectPrice.start;
	var endValue = $('#inform_about_price_2').data('priceinform');
	var endValueResult = selectPrice.end;

	// var totalPrice = buttonPrice - sliderPrice;
	// if (($('.button_choose').index($('.active_choose_button')) == 0)) {
	// 	if (indexOfActiveSlide > 1) {
	// 		sliderPrice = (((1 + indexOfActiveSlide) * 500));
	// 		totalPrice = buttonPrice - sliderPrice;
	// 	}
	// }
	// var numb_start = $('.price_total').attr('data-priceInform');
	// var	final_numb = totalPrice;


	var feeBlock = $('.price_total_fee');
	var startBlock = $('#inform_about_price');
	var endBlock = $('#inform_about_price_2');
	function animate_number(numb_start, result_block, get_number, separator = '.') {
		$({numberValue: numb_start}).animate({numberValue: get_number}, {
			duration: 500,
			easing: "linear",
			step: function(val) {
				$(result_block).html(formatPriceNumber(Math.ceil(val), separator));
			}
		});
	};

	$('.price_total_fee').data('fee', feeEnd);
	animate_number(feeStart, feeBlock, feeEnd, ',');

	$('#inform_about_price').data('priceinform', startValueResult);
	$('#inform_about_price2').data('priceinform', endValueResult);
	animate_number(startValue, startBlock, startValueResult);
	animate_number(endValue, endBlock, endValueResult);






	/*if (($('.button_choose').index($('.active_choose_button')) == 0)) {
		if (indexOfActiveSlide > 1) {
			sliderPrice = (((1 + indexOfActiveSlide) * 500));
			totalPrice = buttonPrice - sliderPrice;
			$('.price_total').text(formatPriceNumber(totalPrice));
		}
	}*/
	//$('.price_total').text(formatPriceNumber(totalPrice));
};
// function to search right question
function Search() {
	var textFromInput = $('#search').val().toLowerCase().trim();
	$('.hidden_list').html('');
	$('.question_block li').each(function() {
		var questionText = $(this).text().toLowerCase().trim();
		if (questionText.indexOf(textFromInput) > -1) {
			var	questionLinkText = $(this).find('a').text();
			var	questionLink = $(this).find('a').attr('href');
			$('.hidden_list').prepend('<li><a href=\"'+ questionLink + '\">' + questionLinkText + '</a> </li>')
		}
	});
	if ($('.hidden_list li').length == 0) {
		$('.hidden_list').prepend('<li class="pointer_events_none"><a href="#"> nothing found </a></li>');
	}
};
// create a navigation on the FAQ section
function Pagination(elementOnPage, init) {
	if (typeof init == 'undefined') {
		init=false;
	}
	var NumberOfQuestion = $('.active_question').length;
	var onePageQuestion = elementOnPage;
	var pageCount = Math.ceil(NumberOfQuestion / onePageQuestion);
	$('.pagination_block').empty()
	var page=1;
	var url_params=parse_url_params();
	if (typeof url_params['faq_page'] != 'undefined') {
		page=url_params['faq_page'];
	}
	for (var i = 1; i <= pageCount; i++) {
		if (i == page) {
			$('.pagination_block').append('<div class="pagination_numbers active_pagination">'+ i + '</div>')
		} else {
			$('.pagination_block').append('<div class="pagination_numbers">'+ i + '</div>')
		}
	};
	if ($('.pagination_numbers').length > 5) {
		var  PaginationCount = $('.pagination_numbers').length;
		for (var i = 5; i <= PaginationCount; i++) {
			$('.pagination_numbers').eq(i).addClass('hide_pagination');
		}

		$('.pagination_block').append('<div class="more_pagination">more</div>')
	}
	callback=null;
	if (init && location.hash.replace('#','')=='faq') {
		callback=function() {
			if (window.innerWidth < 1280) {
				setTimeout(function() {
					window.scrollTo({top: $('#faq').offset().top-$('header').outerHeight()+parseInt($('#faq').css('padding-top')), behavior: 'instant'});
					$('.pseudo_load').css('display', 'none');
				}, 1);
			} else {
				$('.pseudo_load').css('display', 'none');
			}
		}
	}
	changePagination(elementOnPage, callback);
}
// make navigation work
function changePagination(elementOnPage, callback) {
	var onePageQuestion = elementOnPage;
	var elements = $('.active_question');
	var NumberOfQuestion = $('.active_question').length;
	var pageCount = Math.ceil(NumberOfQuestion / onePageQuestion);
	var PageNumber = $('.active_pagination').text();
	var startPageElements = (PageNumber - 1) * onePageQuestion;
	var activePageElements = onePageQuestion * PageNumber;
	$('.question_block_list').fadeOut(500, function() {
		$('.question_block li').css({display: 'none'});
		for (var i = startPageElements; i < activePageElements; i++) {
			elements.eq(i).css({display: 'flex'});
		};
		$('.question_block_list').fadeIn(300, function() {
			if (typeof callback == 'function') {
				callback();
			}
		});
	});
}
//function to choose section of question
function activeSection(init) {
	if (typeof init == 'undefined') {
		init=false;
	}
	var SectionActive = $('.ToggleButton_active').attr('data-sectionName');
	if (typeof SectionActive != 'undefined') {
		$('.question_block li').removeClass('active_question');
		$('.question_block li').each(function() {
			var questionSection = $(this).attr('data-sectionName');
			if (questionSection == SectionActive ) {
				$(this).addClass('active_question')
			};
		});
	}
	if (window.innerWidth >= 1280) {
		Pagination(8, init);
	} else {
		Pagination(6, init);
	}
};
//progressbar on mobile
function mobileProgressbar() {
	if ($('.main_page').length) {
		var textHeight = $('.main_page').find('.text_container').offset().top;
		var blockHeight = $('.main_page').innerHeight();
		$('.main_page').find('.line_scrollbar').css({'height': (blockHeight - textHeight)});
	}
}
//active menu point
function MenuPointActive() {
	$('.active_point_menu').removeClass('active_point_menu');
	var slideDataText = $('.section.active').attr('data-menuPointActive').toLowerCase();
	var MenuLength = $('.menu_header li').length;
	$('.menu_header li').each(function() {
		var menuDataText = $(this).attr('data-menuachor').toLowerCase();
		if (slideDataText == menuDataText) {
			// console.log(slideDataText);
			$(this).addClass('active_point_menu');
		}
	})
}
function hiddenListBlock() {
	var offsetTop = $('#search').offset().top;
	var offsetLeft = $('#search').offset().left;
	var elementWidth = $('#search').outerWidth();
	var hiddenList = $('.hidden_list_block').css({'top':offsetTop, 'left': offsetLeft, 'width': elementWidth});
	$('.hidden_list_block').addClass('hidden_list_active');
}

var ar_video={
	'video_item__grub_bg': {
		'mp4': '/video/get_video.php?v=grub_bg.mp4',
		'webm': '/video/get_video.php?v=grub_bg.webm',
		'ogv': '/video/get_video.php?v=grub_bg.ogv',
	},
	'video_item__grub_bg_full': {
		'mp4': '/video/get_video.php?v=grub_bg_full.mp4',
		'webm': '/video/get_video.php?v=grub_bg_full.webm',
		'ogv': '/video/get_video.php?v=grub_bg_full.ogv',
	},
	'video_item__why_texting': {
		'mp4': '/video/get_video.php?v=why_texting.mp4',
		'webm': '/video/get_video.php?v=why_texting.webm',
		'ogv': '/video/get_video.php?v=why_texting.ogv',
	},
	'video_item__facebook': {
		'mp4': '/video/get_video.php?v=facebook.mp4',
		'webm': '/video/get_video.php?v=facebook.webm',
		'ogv': '/video/get_video.php?v=facebook.ogv',
	},
};

var load_video_overall_progress=0;
var load_video_overall_size=0;

function get_video_size(ar_vid, callback) {
	if (typeof callback != 'function') { callback=function() {}; }
	var http = new XMLHttpRequest();
	http.open('HEAD', ar_vid['url'], true); // true = Asynchronous
	http.onreadystatechange = function() {
		if (this.readyState == this.DONE) {
			if (this.status === 200) {
				var file_size = parseInt(this.getResponseHeader('content-length'));
				if (isNaN(file_size)) { file_size = 0; }
				// console.log('fileSize = ' + file_size);
				load_video_overall_size+=file_size;
				ar_vid['size']=file_size;
				// console.log(file_size);
				callback(ar_vid);
			} else {
				// console.log(this.status);
				setTimeout(function() {
					location.reload();
				}, 0);
			}
		}
	};
	http.onerror = function() {
		setTimeout(function() {
			location.reload();
		}, 0);
		// console.log('err' ,arguments);
	}
	http.send();
}

function get_video_size_rec(ar_videos, onprogress, callback) {
	if (typeof callback != 'function') { callback=function() {}; }
	if (typeof onprogress != 'function') { onprogress=function() {}; }
	if (ar_videos.length>0) {
		get_video_size(ar_videos.pop(), function(ar_vid) { onprogress(ar_vid); get_video_size_rec(ar_videos, onprogress, callback) });
	} else {
		callback();
	}
}

function load_video(ar_vid, onprogress, callback) {
	if (typeof callback != 'function') { callback=function() {}; }
	if (typeof onprogress != 'function') { onprogress=function() {}; }
	if (typeof ar_vid == 'object') {
		var $video=ar_vid['obj'];
		
		var xhrReq = new XMLHttpRequest();
		xhrReq.open('GET', ar_vid['url'], true);
		xhrReq.responseType = 'blob';
		xhrReq.onload = function() {
			if (this.status === 200 || this.status === 206) {
				var vid = URL.createObjectURL(this.response);
				$video.each(function() {
					$(this).get(0).src=vid;
				})
				load_video_overall_progress+=ar_vid['size'];
				// video.src = vid;
				callback();
			} else {
				// console.log(this.status);
				setTimeout(function() {
					location.reload();
				}, 0);
			}
		}
		xhrReq.onerror = function() {
			setTimeout(function() {
				location.reload();
			}, 0);
			// console.log('err' ,arguments);
		}
		xhrReq.onprogress = function(e){
			onprogress(e.loaded);
		}
		xhrReq.send();
		
	}
}

function load_video_rec(ar_videos, onprogress, callback) {
	if (ar_videos.length>0) {
		var ar_vid=ar_videos.pop();
		load_video(ar_vid, onprogress, function() { load_video_rec(ar_videos, onprogress, callback) });
	} else {
		// console.log('finished');
		if (typeof callback == 'function') {
			callback();
		}
	}
}

function video_js_load(callback) {
	var testVid=null;
	$.each(ar_video,function(i,v) {
		testVid=$('.'+i).get(0);
		return false;
	});
	var vid_type='';
	if ( testVid.canPlayType ) {
		//mpeg4 = "" !== testEl.canPlayType( 'video/mp4; codecs="mp4v.20.8"' );// Check for MPEG-4 support
		if ( "" !== ( testVid.canPlayType( 'video/mp4; codecs="avc1.42E01E"' ) || testVid.canPlayType( 'video/mp4; codecs="avc1.42E01E, mp4a.40.2"' ) ) ) { // Check for h264 support
			vid_type='mp4';
		} else if ( "" !== testVid.canPlayType( 'video/webm; codecs="vp8, vorbis"' ) ) { // Check for Webm support
			vid_type='webm';
		} else if ( '' !== testVid.canPlayType( 'video/ogg; codecs="theora"' ) ) { // Check for Ogg support
			vid_type='ogv';
		}
	}
	
	if (vid_type != '') {
		var ar_load_video=[];
		var ar_size_video=[];
		$.each(ar_video,function(i,v) {
			ar_size_video.push({
				obj: $('.'+i),
				url: v[vid_type],
			});
		});
		var $video_js_preload_percent=$('.video_js_preload_percent');
		get_video_size_rec(ar_size_video, function(ar_vid) {
			ar_load_video.push(ar_vid);
		}, function() {
			load_video_rec(ar_load_video, function(vid_progress) {
				// console.log(load_video_overall_progress+' '+vid_progress+' '+load_video_overall_size);
				var percent=(load_video_overall_progress+vid_progress)/load_video_overall_size*100;
				if (percent>100) {
					percent=100;
				}
				$video_js_preload_percent.html(percent.toFixed(1)+'%');
			}, callback);
		});
	}

}
/*
function load_video($elem) {
	// console.log('load_video_call');
	if ($elem.find('video').length==0) {
		$elem.find('img').remove();
		if ($elem.hasClass('video_block_why_texting')) {
			// console.log('why_texting');
			$elem.append('<video poster="/video/why_texting.jpg" class="video" playsinline autoplay loop muted><source src="/video/why_texting.mp4" type="video/mp4"><source src="/video/why_texting.webm" type="video/webm"><source src="/video/why_texting.ogv" type="video/ogg"></video>');
		} else if ($elem.hasClass('video_block_facebook')) {
			console.log('facebook');
			$elem.append('<video poster="/video/facebook.jpg" class="video" playsinline autoplay loop muted><source src="/video/facebook.mp4" type="video/mp4"><source src="/video/facebook.webm" type="video/webm"><source src="/video/facebook.ogv" type="video/ogg"></video>');
		}
	}
}
*/
$( document ).ready(function() {
	// video_js_load();
	$('.pagination__item').on( 'click', function() {
		var $this = $(this);
		// if(!$this.hasClass('active')) {
			var $parent = $this.closest('.right_section');

			var data = $this.data('lotitem');
			$('.pagination__item').removeClass('active');
			// $this.addClass('active');
			
			var lotie = $parent.find('.lottie-animation-json').length-1;
			$lotie_curent = $parent.find('.lottie-animation-json.active');
			$lotie_now = $parent.find('.lottie-animation-json:not(.active)');
			$lotie_now.addClass('active');
			
			var $timer = null;
			var $timer2 = null;
			clearTimeout($timer);
			clearTimeout($timer2);
			$timer = setTimeout(function() {
				$parent.find('.lottie-animation-json').css({opacity: 0, visibility: 'hidden'});
				$($lotie_curent).removeClass('active').css({display:'none'});
				$($lotie_now).addClass('active').css({display:'block'});
				$timer2 = setTimeout(function() {
					$.each(animations, function(i,v) {
						if ($lotie_curent.hasClass(i)) {
							v.anim.pause();
							$($lotie_curent).find('.button-pag').hide();
							return false;
						}
					});
					$.each(animations, function(i,v) {
						if ($lotie_now.hasClass(i)) {
							clearTimeout(anim_timeout);
							v.anim.goToAndStop(0, true);
							if(typeof v.anim.onLoopComplete == 'undefined') {				
								v.anim.onLoopComplete = function() {
									if($($lotie_now).find('.button-pag').css('display') != 'flex') {
										$($lotie_now).find('.button-pag').css("display", "flex").hide().fadeIn();
									}
								}
							}
							anim_timeout=setTimeout(function() {
								v.anim.goToAndPlay(0, true);
							}, 800);
							return false;
						}
					});
					$lotie_now.css({opacity: 1, visibility: 'visible'});
				}, 300);
			}, 0);
		// }
	});
	var animations={
		'line-animation-json': {
			anim: null,
			path: 'https://swayy.in/trytext2order/wp-content/themes/try2order/lottie-animation-json/the_problem.json',
		},
		'graph-animation-json': {
			anim: null,
			path: 'https://swayy.in/trytext2order/wp-content/themes/try2order/lottie-animation-json/graph.json',
		},
		'imagine-a-world-animation-json': {
			anim: null,
			path: 'https://swayy.in/trytext2order/wp-content/themes/try2order/lottie-animation-json/imagine_a_world.json',
		},
		'simple-like-animation-json': {
			anim: null,
			path: 'https://swayy.in/trytext2order/wp-content/themes/try2order/lottie-animation-json/simple_like_1.2.3.json',
		},
		'mobile-order-animation-json': {
			anim: null,
			path: 'https://swayy.in/trytext2order/wp-content/themes/try2order/lottie-animation-json/mobile-order.json',
		},
		
		/*'message-animation-json': {
			anim: null,
			path: '/lottie-animation-json/02_message.json?1',
		},
		'ipad-animation-json': {
			anim: null,
			path: '/lottie-animation-json/03_ipad.json',
		},
		'invoice-animation-json': {
			anim: null,
			path: '/lottie-animation-json/invoice_mobile_.json',
		},
		'woman-animation-json': {
			anim: null,
			// path: '/lottie-animation-json/05_woman.json',
			path: '/lottie-animation-json/grub_woman.json',
		},*/
		// 'facebook-animation-json': {
		// 	anim: null,
		// 	path: '/lottie-animation-json/06_facebook.json',
		// },
		/*'techmessag-animation-json': {
			anim: null,
			path: '/lottie-animation-json/techmessage_mobile_.json',
		},
		'customerpay-animation-json': {
			anim: null,
			path: '/lottie-animation-json/customerpay.json',
		},*/
	};
	
	var iframe_videos={
		'video_fullscreen_iframe': {
			desktop: false,
			mobile: false,
			player: null,
			hashtag: [],
		},
		'video_iframe_main': {
			desktop: true,
			mobile: true,
			player: null,
			hashtag: ['','main','page1'],
		},
		'video_iframe_facebook': {
			desktop: true,
			mobile: true,
			player: null,
			hashtag: ['page9'],
		},
		'video_iframe_why_texting_mobile': {
			desktop: false,
			mobile: true,
			player: null,
			hashtag: ['solution'],
		},
		'video_iframe_why_texting_desktop': {
			desktop: true,
			mobile: false,
			player: null,
			hashtag: ['solution'],
		},
		'video_iframe_how_it_works_mobile': {
			desktop: false,
			mobile: true,
			player: null,
			hashtag: ['how_it_Works'],
		},
		'video_iframe_how_it_works_desktop': {
			desktop: true,
			mobile: false,
			player: null,
			hashtag: ['how_it_Works'],
		},
		'video_iframe_benefits_mobile': {
			desktop: false,
			mobile: true,
			player: null,
			hashtag: ['benefits'],
		},
		'video_iframe_benefits_desktop': {
			desktop: true,
			mobile: false,
			player: null,
			hashtag: ['benefits'],
		},
	};
		
	var anim_timeout=null;
	$.each(animations, function(i,v) {
		if ($('.'+i).length) {
			v.anim=bodymovin.loadAnimation({
					container: $('.'+i).get(0),
					renderer: 'svg',
					autoplay: false, //true,
					loop: true,
					path : v.path
			});
			if(i == 'invoice-animation-json') {
				v.anim.loop = false;
			} else if (i == 'customerpay-animation-json') {
				v.anim.autoplay = true;
			} else if (i == 'message-animation-json') {
				if(typeof v.anim.onLoopComplete == 'undefined') {				
					v.anim.onLoopComplete = function() {
						if($('.'+i).find('.button-pag').css('display') != 'flex') {
							$('.'+i).find('.button-pag').css("display", "flex").hide().fadeIn();
						}
					}
				}
			}
		} else {
			delete animations[i];
		}
	});
	$.each(iframe_videos, function(i,v) {
		var hash=location.hash.replace('#','');
		if ($('.'+i).length) {
			v.player=new Vimeo.Player($('.'+i));
			if (i=='video_fullscreen_iframe') {
				v.player.on('ended', function(e) {
					$('.close_video').trigger('click');
				});
			}
			if (v.hashtag.indexOf(hash)>=0) {
				$('.'+i).addClass('video_iframe_playing');
				v.player.play();
			}
		} else {
			delete iframe_videos[i];
		}
	});
	
	if (window.innerWidth >= 1280) {
		if ($('#pagepiling').length) {
			$('#pagepiling').pagepiling({
				anchors: [ 'main', 'our_why', 'problem', 'solution', 'benefits', 'cutlines', 'enhance_fan', 'engage_fan', 'identify_profile', 'drive_revenue', 'how_it_Works','the_platform', 'team', 'pricing'],
				menu: '.menu',
				animateAnchor: false,
				navigation: false,
				onLeave: function(index, nextIndex, direction) {
					//window.document.title=$('.section').eq(nextIndex - 1).data('page-title');
					var $prev_anim=$('.section').eq(index - 1).find('.lottie-animation-json');
					var $next_anim=$('.section').eq(nextIndex - 1).find('.lottie-animation-json');
					// console.log(index,nextIndex)
					if ($prev_anim.length) {
						$.each(animations, function(i,v) {
							if ($prev_anim.hasClass(i)) {
								v.anim.pause();
								return false;
							}
						});
					}
					if ($next_anim.length) {
						$.each(animations, function(i,v) {
							if ($next_anim.hasClass(i)) {
								clearTimeout(anim_timeout);
								v.anim.goToAndStop(0, true);
								anim_timeout=setTimeout(function() {
									v.anim.goToAndPlay(0, true);
								}, 800);
								return false;
							}
						});
					}
					
					var $prev_iframe_video=$('.section').eq(index - 1).find('.video_iframe');
					var $next_iframe_video=$('.section').eq(nextIndex - 1).find('.video_iframe');
					// console.log(index,nextIndex)
					if ($prev_iframe_video.length) {
						$.each(iframe_videos, function(i,v) {
							if (v.desktop && $prev_iframe_video.hasClass(i)) {
								if ($prev_iframe_video.hasClass('video_iframe_playing')) {
									$prev_iframe_video.removeClass('video_iframe_playing');
									v.player.pause();
									// console.log('pause video' + i);
								}
								return false;
							}
						});
					}
					if ($next_iframe_video.length) {
						$.each(iframe_videos, function(i,v) {
							if (v.desktop && $next_iframe_video.hasClass(i)) {
								if (!$prev_iframe_video.hasClass('video_iframe_playing')) {
									$prev_iframe_video.addClass('video_iframe_playing');
									v.player.play();
									// console.log('play video' + i);
								}
								return false;
							}
						});
					}
					
					// var $next_video=$('.section').eq(nextIndex - 1).find('.video_block_dynamical_desktop');
					// if ($next_video.length) {
					// 	load_video($next_video);
					// }
					
					//change header and footer to black color
					if ($('.section').eq(nextIndex - 1).hasClass('white_section')) {
						$('header').addClass('black');
						$('footer').addClass('black');
						$('.line_scrollbar').addClass('black_progress');
					} else {
						$('header').removeClass('black');
						$('footer').removeClass('black');
						$('.line_scrollbar').removeClass('black_progress');
					}
					//show right navigation on the solution section
					if ($('.section').eq(nextIndex - 1).hasClass('section_menu_right')) {
						$('.menu_right').addClass('active_menu_right');
					} else {
						$('.menu_right').removeClass('active_menu_right');
					}
					var currentSlide = $('.section').eq(nextIndex - 1).attr('id');
					var currentPoint = 'li[data-menuachor="' + currentSlide + '"]';
					$('.active_point').removeClass('active_point');
					$(currentPoint).addClass('active_point');
					//show links in footer
					if ($('.section').eq(nextIndex - 1).hasClass('footer_link')) {
						$('.hidden_links').addClass('active_link');
					} else {
						$('.active_link').removeClass('active_link');
					};
					scrollParameters(index, nextIndex);
					// change button scrollDown/scrollUp
					if (nextIndex > 8) {
						$('.scroll').addClass('scroll_active');
					} else {
						$('.scroll').removeClass('scroll_active');
					}
					if (nextIndex > 1) {
						MenuPointActive();
					} else {
						$('.active_point_menu').removeClass('active_point_menu');
					}
				},
				afterRender: function(){
					scrollParameters(0, 1);
				},
			});
		};
	}
	if (window.innerWidth < 1280) {
		mobileProgressbar();
		var anim_scroll_timeout=null;
		$(window).on('scroll', function() {
			if(!$('body').hasClass('about-page') && !$('body').hasClass('faq') && !$('body').hasClass('privacy-page')) {
				if ($(window).scrollTop()<100) {
					$('header').addClass('first-screen');
				} else {
					$('header').removeClass('first-screen');
				}
			}
			anim_scroll_timeout=setTimeout(function() {
				$('[data-anchor]').each(function() {
					var $anchor=$(this);
					var page_title=$anchor.data('page-title');
					var anchor_top=$anchor.get(0).getBoundingClientRect().top;
					var anchor=$anchor.data('anchor');
					var win_height=(window.innerHeight || document.documentElement.clientHeight);
					if ( anchor_top >= 0 && anchor_top <= win_height) {
						var qparams = window.location.pathname;
						qparams +='#'+anchor;
						if (qparams!=window.location.pathname+'#'+window.location.hash.replace('#','')) {
							window.history.replaceState(null, null, qparams);
							window.document.title=page_title;
						}
						
						return false;
						// console.log(anchor);
					}
				});
				$.each(animations, function(i,v) {
					if ($('.'+i).length) {
						var rect = $('.'+i).get(0).getBoundingClientRect();
						// console.log(rect);
						var rect_top=rect.top+rect.height*0.3;
						var rect_bottom=rect.bottom-rect.height*0.3;
						var win_height=(window.innerHeight || document.documentElement.clientHeight);
						if ( rect_top >= 0 && rect_bottom <= win_height) {
							if (!$('.'+i).hasClass('playing')) {
								$('.'+i).addClass('playing');
								clearTimeout(anim_timeout);
								v.anim.goToAndStop(0, true);
								anim_timeout=setTimeout(function() {
									v.anim.goToAndPlay(0, true);
								}, 500);
							}
						} else {
							$('.'+i).removeClass('playing');
							v.anim.pause();
						}
					}
				});
				$.each(iframe_videos, function(i,v) {
					var rect = $('.'+i).get(0).getBoundingClientRect();
					var rect_top=rect.top+rect.height*0.3;
					var rect_bottom=rect.bottom-rect.height*0.3;
					var win_height=(window.innerHeight || document.documentElement.clientHeight);
					if ( rect_top >= 0 && rect_bottom <= win_height) {
						if (!$('.'+i).hasClass('video_iframe_playing')) {
							$('.'+i).addClass('video_iframe_playing');
							v.player.play();
							// console.log('play '+i+' mobile');
						}
					} else {
						if ($('.'+i).hasClass('video_iframe_playing')) {
							$('.'+i).removeClass('video_iframe_playing');
							v.player.pause();
							// console.log('pause '+i+' mobile');
						}
					}
				});
			}, 200);
		}).trigger('scroll');
	}
	var window_innerWidth_reload=false;
	var window_innerWidth=window.innerWidth;
	var window_innerWidth_timeout=null;
	$(window).on('resize', function() {
		clearTimeout(window_innerWidth_timeout);
		window_innerWidth_timeout=setTimeout(function() {
			if (window_innerWidth_reload) return;
			// console.log(window_innerWidth+' '+window.innerWidth);
			window_innerWidth_reload=window.innerWidth >= 1280 && 1280 > window_innerWidth || window.innerWidth < 1280 && 1280 <= window_innerWidth;
			if (window_innerWidth_reload) {
				location.reload();
				// console.log('reload');
			}
			window_innerWidth=window.innerWidth;
			
			$('.main_page .video_bg').css({width: ($('.main_page').innerHeight()*2)+'px'});
		}, 300);
	}).trigger('resize');
	
	if ($('.slider').length) {
		//slider in black section
		$( function() {
			var	sliderWidth = $('.slider').width();
			$('.circle_block').animate({'width': sliderWidth})
			var numberOfCircle = $('.red_circle_slider').length;
			$('.bottomText').on( 'click', function() {
				$('.red_circle_slider_active').removeClass('red_circle_slider_active');
				$('.red_circle_slider_active_small').removeClass('red_circle_slider_active_small');
				$(this).parent('.red_circle_slider').addClass('red_circle_slider_active');
				var indexOfButton = Number($(this).parent('.red_circle_slider').index());
				if ((indexOfButton + 1) == numberOfCircle) {
					$('.slider').addClass('slider_after_active');
				} else {
					$('.slider').removeClass('slider_after_active');
				}
				$('.red_circle_slider').eq(indexOfButton).prevAll('.red_circle_slider').addClass('red_circle_slider_active_small');
			});
			var select = Number($('.red_circle_slider_active').index() + 1);
			var slider = $( "#slider" ).slider({
				range: "min",
				value: select,
				min: 1,
				step: 1,
				max: numberOfCircle,
				slide: function( event, ui ) {
					var numberOfCircle = $('.red_circle_slider').length;
					var activeCircleIndex = ui.value - 1
					$('.red_circle_slider').eq(activeCircleIndex).nextAll('.red_circle_slider').removeClass('red_circle_slider_active_small');
					$('.red_circle_slider').eq(activeCircleIndex).prevAll('.red_circle_slider').addClass('red_circle_slider_active_small');
					$('.red_circle_slider_active').removeClass('red_circle_slider_active');
					$('.red_circle_slider').eq(activeCircleIndex).addClass('red_circle_slider_active');
					if ((activeCircleIndex + 1) == numberOfCircle) {
						$('.slider').addClass('slider_after_active');
					} else {
						$('.slider').removeClass('slider_after_active');
					}
					calculatingPrice();
				}
			});
			$( '.bottomText' ).on( 'click', function() {
				var selectCurrent = $(this).parent('.red_circle_slider').index()
				slider.slider( "value", selectCurrent + 1 );
				calculatingPrice();
			});
		} );
	};
	

	// buttons scroll up/down
	$('.scroll_down').on( 'click', function() {
		$.fn.pagepiling.moveSectionDown();
	});
	$('.scroll_up').on( 'click', function() {
		$.fn.pagepiling.moveTo('main');
	});
	// open menu in mobile
	$('.menu_open_click').on( 'click', function(){
		$('.menu_open').toggleClass('close_menu');
		$('header').toggleClass('menu_opened');
		$('.menu_container_mobile').toggleClass('menu_container_mobile_active');
	})

	$('header a').on( 'click', function() {
		$('.menu_open').removeClass('close_menu');
		$('header').removeClass('menu_opened');
		$('.menu_container_mobile').removeClass('menu_container_mobile_active');
	})
	// change question section
	$('.ToggleButton').on( 'click', function(e) {
		e.preventDefault();
		var $this=$(this);
		faq_link_update($this.attr('data-sectionName'),1);
		$('.ToggleButton_active').removeClass('ToggleButton_active');
		$this.addClass('ToggleButton_active');
		var headerText = $this.text();
		$('#sectionNameHeader').fadeOut(500, function() {
			$('#sectionNameHeader').text(headerText);
			$('#sectionNameHeader').fadeIn(500);
		})
		activeSection();
	})

	// show searching question
	$('#search').keyup(function() {
		Search();
		hiddenListBlock();
	});
	// hide searching question
	$('#search').blur(function() {
		$(document).on( 'click', function (event) {
			var $element = $(event.currentTarget);
			if (!$element.is("hidden_list_active")) {
				$('.hidden_list_active').removeClass('hidden_list_active');
			}
		});
	});

	// choose buttons in slider price block
	$('.button_choose').on( 'click', function chooseButton() {
		$('.active_choose_button').removeClass('active_choose_button');
		$(this).addClass('active_choose_button');
		calculatingPrice();
	});
	
	if ($('.img_slider_slick').length && typeof $('.img_slider_slick').slick == 'function') {
		$('.img_slider_slick').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 2000,
		});
	}
	
	//open video in fullscreen
	$('.video_block_click').on( 'click', function(e) {
		e.preventDefault();
		var $this=$(this);
		if (window.innerWidth >= 1280) {
			/*if ($('header').hasClass('black')) {
				$('header').removeClass('black');
				$('footer').removeClass('black');
				$('.hidden_links').removeClass('active_link');
				$('.line_scrollbar').fadeOut(500);
			}*/
		}
		$('.main_page .line_scrollbar').fadeOut(500);
		iframe_videos['video_iframe_main'].player.pause();
		iframe_videos['video_fullscreen_iframe'].player.play();
		iframe_videos['video_fullscreen_iframe'].player.setCurrentTime(0);
		iframe_videos['video_fullscreen_iframe'].player.setVolume(1);
		$('.video_fullscreen').addClass('active');
	});

	$('.close_video').on( 'click', function() {
		if (typeof iframe_videos['video_iframe_main'] != 'undefined') {
			iframe_videos['video_iframe_main'].player.play();
		}
		if (typeof iframe_videos['video_fullscreen_iframe'] != 'undefined') {
			iframe_videos['video_fullscreen_iframe'].player.pause();
		}
		$('.video_fullscreen').removeClass('active');
		if (window.innerWidth >= 1280) {
			if ($('.section.active').hasClass('white_section')) {
				$('header').addClass('black');
				$('footer').addClass('black');
				$('.hidden_links').addClass('active_link');
				$('.line_scrollbar').fadeIn(500);
			}
		}
		$('.main_page .line_scrollbar').fadeIn(500);
	});

	$(document).mouseup(function (e){ // ÑÐ¾Ð±Ñ‹Ñ‚Ð¸Ðµ ÐºÐ»Ð¸ÐºÐ° Ð¿Ð¾ Ð²ÐµÐ±-Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ñƒ
		var $div = $('.video_fullscreen, .video_block_click'); // Ñ‚ÑƒÑ‚ ÑƒÐºÐ°Ð·Ñ‹Ð²Ð°ÐµÐ¼ ID ÑÐ»ÐµÐ¼ÐµÐ½Ñ‚Ð°
		if (!$div.is(e.target) // ÐµÑÐ»Ð¸ ÐºÐ»Ð¸Ðº Ð±Ñ‹Ð» Ð½Ðµ Ð¿Ð¾ Ð½Ð°ÑˆÐµÐ¼Ñƒ Ð±Ð»Ð¾ÐºÑƒ
			&& $div.has(e.target).length === 0) { // Ð¸ Ð½Ðµ Ð¿Ð¾ ÐµÐ³Ð¾ Ð´Ð¾Ñ‡ÐµÑ€Ð½Ð¸Ð¼ ÑÐ»ÐµÐ¼ÐµÐ½Ñ‚Ð°Ð¼
			$('.close_video').trigger('click') // ÑÐºÑ€Ñ‹Ð²Ð°ÐµÐ¼ ÐµÐ³Ð¾
		}
	});
	
	
	var url_params=parse_url_params();
	if (typeof url_params['faq_sec'] != 'undefined') {
		var $section=$('.ToggleButton[data-sectionName="'+url_params['faq_sec']+'"]');
		if ($section.length) {
			$section.addClass('ToggleButton_active');
			$('#sectionNameHeader').text($section.text());
		}
	}
	activeSection(true);
	
	if (window.innerWidth < 1280) {
		$('header').addClass('black')
		$('footer').addClass('black')
		$('.hidden_links').addClass('active_link');
	}

	// question navigation
	$(document).on( 'click', '.pagination_numbers', function() {
		var $this=$(this);
		faq_link_update(null,$this.text());
		$('.active_pagination').removeClass('active_pagination');
		$this.addClass('active_pagination');
		if (window.innerWidth >= 1280) {
			changePagination(8);
		} else {
			changePagination(6);
		}
	})
	// show more panigation buttons
	$(document).on( 'click', '.more_pagination', function() {
		$('.hide_pagination').removeClass('hide_pagination');
		$(this).remove();
	})
});

$(function() {
	$('.videoplayer__playbutton').click(function() {
		$('.videoplayer__container').addClass('play');
		var video = $('.videoplayer__container video')[0];

		  if (video.requestFullscreen) {
		    video.requestFullscreen();
		  } else if (video.webkitRequestFullscreen) { /* Safari */
		    video.webkitRequestFullscreen();
		  } else if (video.msRequestFullscreen) { /* IE11 */
		    video.msRequestFullscreen();
		  }

		  video.play();
	});
});


