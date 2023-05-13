<?php
defined('ABSPATH') or die("No script kiddies please!");
$title_options = $item['title'];
if($title_options['content'] !=''){
	$dynamic_css = array();
	if(isset($title_options['font-size']) && $title_options['font-size'] != ''){
		$dynamic_css[] = "font-size: {$title_options['font-size']}px;";

	}

	if(isset($title_options['font-color']) && $title_options['font-color'] != ''){
		$dynamic_css[] = "color: {$title_options['font-color']};";

	}

	?>
	<div class="ec-count-title"><?php echo esc_attr($title_options['content']); ?></div>
	<?php
	if(isset($title_options['font-family']) && $title_options['font-family'] !=''){
		if(!in_array( $title_options['font-family'], $google_fonts_used_array) ){
			array_push($google_fonts_used_array, preg_replace('/\s/', '+', $title_options['font-family']) );
		}
		$dynamic_css[] = "font-family: {$title_options['font-family']};";
	}

	if(!empty($dynamic_css)){
		$dynamic_css = implode(' ', $dynamic_css);
	}else{
		$dynamic_css ='';
	}

	ob_start();
	?>
	.ec-<?php echo $template; ?> .ec-counter-item-<?php echo $counter; ?> .ec-count-title { <?php echo esc_attr($dynamic_css); ?> }
	<?php
 	$ec_dynamic_css_at_end[] = ob_get_contents();
  	ob_end_clean();
}