<?php
defined('ABSPATH') or die("No script kiddies please!");
$subtitle_options = $item['subtitle'];
if($subtitle_options['content'] !=''){
	$dynamic_css = array();
	if(isset($subtitle_options['font-size']) && $subtitle_options['font-size'] != ''){
		$dynamic_css[] = "font-size: {$subtitle_options['font-size']}px;";

	}

	if(isset($subtitle_options['font-color']) && $subtitle_options['font-color'] != ''){
		$dynamic_css[] = "color: {$subtitle_options['font-color']};";
	}

	?>
	<div class="ec-count-subtitle"> <?php echo esc_attr($subtitle_options['content']); ?></div>
	<?php
	if(isset($subtitle_options['font-family']) && $subtitle_options['font-family'] !=''){
		if(!in_array( $subtitle_options['font-family'], $google_fonts_used_array) ){
			array_push($google_fonts_used_array, preg_replace('/\s/', '+', $subtitle_options['font-family']) );
		}
		$dynamic_css[] = "font-family: {$subtitle_options['font-family']};";
	}

	if(!empty($dynamic_css)){
		$dynamic_css = implode(' ', $dynamic_css);
	}else{
		$dynamic_css ='';
	}

	ob_start();
	?>
	.ec-<?php echo $template; ?> .ec-counter-item-<?php echo $counter; ?> .ec-count-subtitle { <?php echo $dynamic_css; ?> }
	<?php
 	$ec_dynamic_css_at_end[] = ob_get_contents();
  	ob_end_clean();
}