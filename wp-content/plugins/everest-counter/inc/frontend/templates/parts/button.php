<?php
defined('ABSPATH') or die("No script kiddies please!");
$button_options = $item['button'];
if($button_options['url'] !=''){
	$dynamic_css = array();
	if(isset($button_options['font-size']) && $button_options['font-size'] != ''){
		$dynamic_css[] = "font-size: {$button_options['font-size']}px;";

	}

	if(isset($button_options['font-color']) && $button_options['font-color'] != ''){
		$dynamic_css[] = "color: {$button_options['font-color']};";

	}

	if($button_options['target'] == '_self' || $button_options['target'] == 'none' ){
		$target="target='_self'";
	}else{
		$target="target='_blank'";

	}
	?>
	<div class="ec-count-button"><a href="<?php echo esc_url($button_options['url']); ?>" <?php echo esc_attr($target); ?> ><?php echo esc_attr($button_options['label']); ?></a></div>
	<?php
	if(isset($button_options['font-family']) && $button_options['font-family'] !=''){
		if(!in_array( $button_options['font-family'], $google_fonts_used_array) ){
			array_push($google_fonts_used_array, preg_replace('/\s/', '+', $button_options['font-family']) );
		}
		$dynamic_css[] = "font-family: {$button_options['font-family']};";
	}

	if(!empty($dynamic_css)){
		$dynamic_css = implode(' ', $dynamic_css);
	}else{
		$dynamic_css ='';
	}
	ob_start();
	?>
	.ec-<?php echo $template; ?> .ec-counter-item-<?php echo $counter; ?> .ec-count-button a { <?php echo $dynamic_css; ?> }
	<?php
 	$ec_dynamic_css_at_end[] = ob_get_contents();
  	ob_end_clean();
}