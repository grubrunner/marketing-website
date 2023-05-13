<?php
defined('ABSPATH') or die("No script kiddies please!");
// echo "<pre>";
// print_r($display_settings);
// echo "</pre>";

$header_text_settings = isset($display_settings['header_text']) ? $display_settings['header_text'] : array();
// $header_text_settings['enable'];
// $header_text_settings['text'];
// $header_text_settings['styles']['font-family'];
// $header_text_settings['styles']['font-size'];
// $header_text_settings['styles']['font-color'];
?>
<?php
if(isset($header_text_settings['enable'])){ ?>
	<div class="ec-header-text"><?php echo $header_text_settings['text']; ?></div>
	<?php
	$dynamic_css = array();
	if(isset($header_text_settings['styles']['font-size']) && $header_text_settings['styles']['font-size'] != ''){
		$dynamic_css[] = "font-size: {$header_text_settings['styles']['font-size']}px;";
	}

	if(isset($header_text_settings['styles']['font-color']) && $header_text_settings['styles']['font-color'] != ''){
		$dynamic_css[] = "color: {$header_text_settings['styles']['font-color']};";
	}
	if(isset($header_text_settings['styles']['font-family']) && $header_text_settings['styles']['font-family'] !=''){
		if(!in_array( $header_text_settings['styles']['font-family'], $google_fonts_used_array) ){
			array_push($google_fonts_used_array, preg_replace('/\s/', '+', $header_text_settings['styles']['font-family']) );
		}
		$dynamic_css[] = "font-family: {$header_text_settings['styles']['font-family']};";
	}

	if(!empty($dynamic_css)){
		$dynamic_css = implode(' ', $dynamic_css);
	}else{
		$dynamic_css ='';
	}

	ob_start();
	?>
	.ec-<?php echo $template; ?> .ec-header-text { <?php echo esc_attr($dynamic_css); ?> }
	<?php
 	$ec_dynamic_css_at_end[] = ob_get_contents();
  	ob_end_clean();
 } ?>