<?php
defined('ABSPATH') or die("No script kiddies please!");
$background_type = $background_options['option'];

$wrap_inner_styles = '';
$outer_wrap_attributes = 'data-parallax-source="' . esc_attr($background_options['option']) . '"';
$dynamic_classes = '';
if ( $background_type === 'image' ) {
    $imgWidth = '880';
    $imgHeight = '400';
    $bg_image_url = $background_options['image']['url'];

    $outer_wrap_attributes .= ' data-parallax-image="' . esc_url($bg_image_url) . '"';
    $outer_wrap_attributes .= ' data-parallax-image-width="' . esc_attr($imgWidth) . '"';
    $outer_wrap_attributes .= ' data-parallax-image-height="' . esc_attr($imgHeight) . '"';
    $wrap_inner_styles .= 'background-image: url(\'' . esc_url($bg_image_url) . '\');';
}

if($background_type === 'background-color'){
	$background_color = $background_options['background-color']['color'];
	$outer_wrap_attributes = '';
    $wrap_inner_styles .= "background-color: $background_color";

}

if ($background_type === 'video') {
	$video_options = $background_options['video'];
	$video_type = $video_options['type'];

	$video_start_time = $video_options['start-time'];
	$video_end_time =$video_options['end-time'];

	if($video_type == 'html5'){
		$videos = '';
		$html5_mp4_url = $background_options['video']['html5']['mp4-video-url'];
		$html5_webm_url = $background_options['video']['html5']['webm-video-url'];
		$html5_webm_url = $background_options['video']['html5']['ogv-video-url'];
		if (isset($html5_mp4_url) && $html5_mp4_url) {
		    if ($html5_mp4_url) {
		        $videos .= 'mp4:' . esc_url($html5_mp4_url);
		    }
		}
		if (isset($html5_webm_url) && $html5_webm_url) {
		    if ($html5_webm_url) {
		        if ($videos) {
		            $videos .= ',';
		        }
		        $videos .= 'webm:' . esc_url($html5_webm_url);
		    }
		}
		if (isset($html5_ogv_url) && $html5_ogv_url) {
		    if ($html5_ogv_url) {
		        if ($videos) {
		            $videos .= ',';
		        }
		        $videos .= 'ogv:' . esc_url($html5_ogv_url);
		    }
		}
		$outer_wrap_attributes .= ' data-parallax-video="' . esc_attr($videos) . '"';
	}

	if($video_type == 'youtube'){
		$youtube_options = $video_options['youtube'];
		$youtube_url = $youtube_options['video-url'];
	    $outer_wrap_attributes .= ' data-parallax-video="' . esc_attr($youtube_url) . '"';
	}

	if($video_type == 'viemo'){
		$viemo_options = $video_options['viemo'];
		$viemo_url = $viemo_options['video-url'];
	    $outer_wrap_attributes .= ' data-parallax-video="' . esc_attr($viemo_url) . '"';
	}
    $outer_wrap_attributes .= ' data-parallax-video-start-time="' . esc_attr($video_start_time) . '"';
    $outer_wrap_attributes .= ' data-parallax-video-end-time="' . esc_attr($video_end_time) . '"';
}

// parallax
if(isset($background_options['parallax']['enable'])){
	$parallax_options = $background_options['parallax'];
	$dynamic_classes .='ec-prallax-enabled';
	$awb_parallax = $parallax_options['type'];
	$awb_parallax_speed = isset($parallax_options['speed']) ? $parallax_options['speed'] : '0.5';
	$awb_parallax_mobile = isset($parallax_options['enable-on-mobile-devices']) ? 'true' : 'false';
	if ($awb_parallax == 'scroll' || $awb_parallax == 'scale' || $awb_parallax == 'opacity' || $awb_parallax == 'scroll-opacity' || $awb_parallax == 'scale-opacity') {
	    $outer_wrap_attributes .= ' data-parallax-type="' . esc_attr($awb_parallax) . '"';
	    $outer_wrap_attributes .= ' data-parallax-speed="' . esc_attr($awb_parallax_speed) . '"';
	    $outer_wrap_attributes .= ' data-parallax-mobile="' . esc_attr($awb_parallax_mobile) . '"';
	}
}else{
	$dynamic_classes .='ec-prallax-enabled ec-parallax-for-videos-fixes';
}


if( $detect->isMobile() && !$detect->isTablet() ){
	$responsive_class = 'ec-responsive';
}
// Any tablet device.
else if( $detect->isTablet() ){
	$responsive_class = 'ec-responsive';
}
// any desktop devices
else{
	$responsive_class = '';
}