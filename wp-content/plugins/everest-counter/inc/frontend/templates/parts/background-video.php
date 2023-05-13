<?php
if($background_options['option'] == 'video'){
	$video_options = $background_options['video'];
	$v_height = $video_options['height'];
	$video_fallbackimage = (isset($video_options['fallbackimage']) && $video_options['fallbackimage'] !='') ? $video_options['fallbackimage'] : '';
	if(isset($v_height) && $v_height !=''){
		$video_height = $v_height.'px';
	}else{
		$video_height = '600px';
	}
	if(isset($video_options['parallax'])){
		$enable_parallax = 'on';
	}else{
		$enable_parallax = 'off';
	}
	// var_dump($video_options);
	if($video_options['type'] == 'html5'){
		if(isset($video_options['html5-video-url']) && $video_options['html5-video-url'] !=''){
			$html5_url = $video_options['html5-video-url'];
			?>
			<div class="ec-video-background-wrap"  style="width: 100%; height: <?php echo $video_height; ?>">
                <video autoplay id="ec-video-background" width="100%" height="100%" loop="true" muted>
                    <source src="<?php echo esc_url($html5_url); ?>" type="video/mp4">
                </video>
            </div>
			<?php
		}
	}else if($video_options['type'] == 'youtube'){
		$youtube_url = (isset($video_options['youtube']) && $video_options['youtube'] !='') ? $video_options['youtube'] : 'https://www.youtube.com/watch?v=uXM9dIDnxLU';
		?>
		<div class='ec-video-background-wrap ec-player' data-property="{videoURL:'<?php echo esc_url($youtube_url); ?>',containment:'self',autoPlay:true, mute:true, startAt:0, opacity:1, showControls: false, mobileFallbackImage: '<?php echo esc_url($video_fallbackimage); ?>', optimizeDisplay:true}" style="width: 100%; height: <?php echo $video_height; ?>"></div>
		<?php
	}else if($video_options['type'] == 'viemo'){
		$viemo_url = $video_options['viemo'];
	}
}

?>