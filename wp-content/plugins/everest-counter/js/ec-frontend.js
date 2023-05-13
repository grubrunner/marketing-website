jQuery(document).ready(function($) {
    $('.ec-count-number').each(function(){
    	var $this = $(this);
    	$switch = $this.data('enable');
    	$delay = $this.data('delay');
    	$duration = $this.data('duration');
    	
    	if(typeof($delay) != "undefined" && $delay !== null){
    	}else{
    		$delay = '10';
    	}
    	if(typeof($duration) != "undefined" && $duration !== null){
    	}else{
    		$duration = '2000';
    	}
    	if($switch == 'on'){
    		$this.counterUp({
		        delay: $delay,
		        time: $duration
		    });
    	}
    });

    wow = new WOW(
			      {
			      boxClass:     'wow',      // default
			      animateClass: 'animated', // default
			      offset:       0,          // default
			      mobile:       true,       // default
			      live:         true        // default
			    }
    		);
    wow.init();

    $(".ec-player").each(function(){
        var $this = $(this);
        $this.YTPlayer();
    });

    $(window).resize(function(){
        setTimeout(function(){
            $('.ec-template12 .ec-bottom-container, .ec-template15 .ec-bottom-container').each(function(index, el) {
                var main_width = $(this).outerWidth();
                var span2_width = $(this).find('.span2').outerWidth();
                var count_content_width = $(this).find('.ec-count-content').outerWidth();
                var calculated_width = parseInt(main_width)-parseInt(span2_width)-parseInt(count_content_width);
                $(this).find('.span1').width(calculated_width - 15);
                // console.log('Main Width: '+main_width+' | span2_width: '+span2_width+' | count_content_width: '+count_content_width+' | calculated_width: '+calculated_width );
            });

            $('.ec-template3 .ec-featured-item, .ec-template4 .ec-featured-item').each(function(){
                var $this = $(this);
                var main_width = $this.outerWidth();
                $this.closest( '.ec-counter-item').find('.ec-item-wrap').css('padding-left', main_width+30 );
                $this.css('margin-left', -parseInt(main_width+30) );
            });

            $('.ec-template12 .ec-top-container').each(function(){
                var $this = $(this);
                var main_width = $this.outerWidth();
                $this.closest( '.ec-counter-item').find('.ec-item-wrap').css('padding-left', main_width+40 );
                $this.css('margin-left', -parseInt(main_width+40) );
            });
        }, 5000);
    }).resize();

    $('.ec-prallax-enabled').each(function () {
        var $this = $(this);
        var type = $this.attr('data-parallax-source');
        var image = false;
        var imageWidth = false;
        var imageHeight = false;
        var video = false;
        var videoStartTime = false;
        var videoEndTime = false;
        var parallax = $this.attr('data-parallax-type');
        var parallaxSpeed = $this.attr('data-parallax-speed');
        var parallaxMobile = $this.attr('data-parallax-mobile') !== 'false';

        // image type
        if (type === 'image') {
            image = $this.attr('data-parallax-image');
            imageWidth = $this.attr('data-parallax-image-width');
            imageHeight = $this.attr('data-parallax-image-height');
        }

        // video type
        if (type === 'video') {
            video = $this.attr('data-parallax-video');
            videoStartTime = $this.attr('data-parallax-video-start-time');
            videoEndTime = $this.attr('data-parallax-video-end-time');
        }
        // prevent if no parallax and no video
        if (!parallax && !video) {
            return;
        }

        var jarallaxParams = {
            type: parallax,
            imgSrc: image,
            imgWidth: imageWidth,
            imgHeight: imageHeight,
            speed: parallaxSpeed,
            noAndroid: !parallaxMobile,
            noIos: !parallaxMobile
        };

        if (video) {
            jarallaxParams.speed = parallax ? parallaxSpeed : 1;
            jarallaxParams.videoSrc = video;
            jarallaxParams.videoStartTime = videoStartTime;
            jarallaxParams.videoEndTime = videoEndTime;
        }
        $this.jarallax(jarallaxParams);
    });
});
