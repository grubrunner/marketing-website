<?php
defined('ABSPATH') or die("No script kiddies please!");
if($background_options['option'] == 'image' || $background_options['option'] == 'video' ){
	$overlay_options = $background_options['overlay'];
	$style_option1 = array();
	if(isset($overlay_options['enable'])){
		$overlay_color = $overlay_options['color'];
		$style_option1[] = "background-color: $overlay_color;";
	}

	if(!empty($style_option1)){
		$style_option1 = implode(' ', $style_option1);
	}else{
		$style_option1 ='';
	}
	?>
	<div class="ec-common-overlay" style="<?php echo esc_attr($style_option1); ?>"></div>
	<?php
}