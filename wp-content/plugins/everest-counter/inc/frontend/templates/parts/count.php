<?php
defined('ABSPATH') or die("No script kiddies please!");
$count_options = $item['count'];
if($count_options['content'] !=''){
	$dynamic_css = array();
	if(isset($count_options['font-size']) && $count_options['font-size'] != ''){
		$dynamic_css[] = "font-size: {$count_options['font-size']}px;";
	}

	if(isset($count_options['font-color']) && $count_options['font-color'] != ''){
		$dynamic_css[] = "color: {$count_options['font-color']};";
	}

	if(isset($count_options['animation']['enable'])){
		$data_animation = "data-enable='on'";
	}else{
		$data_animation = "data-enable='off'";
	}

	if(isset($count_options['animation']['enable'])){
		if(isset( $count_options['animation']['delay'] ) && $count_options['animation']['delay'] !='' ){
			$data_delay = "data-delay='{$count_options['animation']['delay']}'";
		}else{
			$data_delay = '';
		}

		if(isset( $count_options['animation']['duration'] ) && $count_options['animation']['duration'] !='' ){
			$data_duration = "data-duration='{$count_options['animation']['duration']}'";
		}else{
			$data_duration = '';
		}
	}else{
		$data_delay = '';
		$data_duration ='';
	}
	?>

	<div class="ec-count-content"><div class='ec-count-content-inner'><?php if(isset($count_options['prefix']) && $count_options['prefix'] !=''){ ?><span class="ec-count-prefix"><?php echo $count_options['prefix']; ?></span><?php } ?><span class="ec-count-number" <?php echo $data_animation; echo $data_delay; echo $data_duration; ?> ><?php echo esc_attr($count_options['content']); ?></span><?php if(isset($count_options['suffix']) && $count_options['suffix'] !=''){ ?><span class="ec-count-suffix"><?php echo $count_options['suffix']; ?></span><?php } ?></div></div>
	<?php
	if(isset($count_options['font-family']) && $count_options['font-family'] !=''){
		if(!in_array( $count_options['font-family'], $google_fonts_used_array) ){
			array_push($google_fonts_used_array, preg_replace('/\s/', '+', $count_options['font-family']) );
		}
		$dynamic_css[] = "font-family: {$count_options['font-family']};";
	}

	if(!empty($dynamic_css)){
		$dynamic_css = implode(' ', $dynamic_css);
	}else{
		$dynamic_css ='';
	}

	ob_start();
	?>
	.ec-<?php echo $template; ?> .ec-counter-item-<?php echo $counter; ?> .ec-count-content .ec-count-number { <?php echo esc_attr($dynamic_css); ?> }
	.ec-<?php echo $template; ?> .ec-counter-item-<?php echo $counter; ?> .ec-count-content .ec-count-prefix { <?php echo esc_attr($dynamic_css); ?> }
	.ec-<?php echo $template; ?> .ec-counter-item-<?php echo $counter; ?> .ec-count-content .ec-count-suffix { <?php echo esc_attr($dynamic_css); ?> }

	<?php
 	$ec_dynamic_css_at_end[] = ob_get_contents();
  	ob_end_clean();
}