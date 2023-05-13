<?php
defined('ABSPATH') or die("No script kiddies please!");
$icon_selection = $item['icon-selection'];
if($icon_selection !=''){
	if($icon_selection == 'image'){
		$image_options = $item['image'];
		$image_options['url'];

		$dynamic_css = array();
		if(isset($image_options['width']) && $image_options['width'] !=''){
			$dynamic_css[] = "width:{$image_options['width']}px;";
		}

		if(isset($image_options['height']) && $image_options['height'] !=''){
			$dynamic_css[] = "height:{$image_options['height']}px;";
		}

		$image_border_option = $image_options['border'];
		$dynamic_css1 = array();
		if(isset($image_border_option['enable'])){
			if(isset($image_options['container-width']) && $image_options['container-width'] !=''){
				$dynamic_css1[] = "width:{$image_options['container-width']}px;";
			}

			if(isset($image_options['container-height']) && $image_options['container-height'] !=''){
				$dynamic_css1[] = "height:{$image_options['container-height']}px;";
			}

			if(isset($image_border_option['width']) && $image_border_option['width'] !=''){
				$dynamic_css1[] = "border: {$image_border_option['width']}px solid {$image_border_option['color']};";
			}

			if(isset($image_border_option['radius']) && $image_border_option['radius'] !=''){
				$dynamic_css1[] = "border-radius: {$image_border_option['radius']};";
			}

			if(isset($image_border_option['line-height']) && $image_border_option['line-height'] !=''){
				$dynamic_css1[] = "line-height: {$image_border_option['line-height']}px;";
			}
		}
		?>
		<div class='ec-featured-item'><figure><img src="<?php echo $image_options['url']; ?>" alt='Feature item' /></figure></div>
		<?php
		if(!empty($dynamic_css)){
			$dynamic_css = implode(' ', $dynamic_css);
		}else{
			$dynamic_css ='';
		}

		if(!empty($dynamic_css1)){
			$dynamic_css1 = implode(' ', $dynamic_css1);
		}else{
			$dynamic_css1 ='';
		}
		?>
		<?php
		ob_start();
		?>
		.ec-<?php echo $template; ?> .ec-counter-item-<?php echo $counter; ?> .ec-featured-item figure{ <?php echo esc_attr($dynamic_css1); ?> }
		.ec-<?php echo $template; ?> .ec-counter-item-<?php echo $counter; ?> .ec-featured-item img{ <?php echo esc_attr($dynamic_css); ?> }
		<?php
	 	$ec_dynamic_css_at_end[] = ob_get_contents();
	  	ob_end_clean();
	}else if($icon_selection == 'icon'){
		$icon_options = $item['icon'];
		$dynamic_css = array();

		$icon_border_option = $icon_options['border'];
		if(isset($icon_border_option['enable'])){
			if(isset($icon_options['width']) && $icon_options['width'] !=''){
				$dynamic_css[] = "width: {$icon_options['width']}px;";
			}
			if(isset($icon_options['height']) && $icon_options['height'] !=''){
				$dynamic_css[] = "height: {$icon_options['height']}px;";
			}
			$dynamic_css[] = "border: {$icon_border_option['width']}px solid {$icon_border_option['color']};";
			$dynamic_css[] = "border-radius: {$icon_border_option['radius']}; line-height: {$icon_border_option['line-height']}px;";
			$dynamic_css[] = "text-align: center;";
		}

		if(!empty($dynamic_css)){
			$dynamic_css = implode(' ', $dynamic_css);
		}else{
			$dynamic_css ='';
		}

		$dynamic_css1 = array();
		if(isset($icon_options['font-color']) && $icon_options['font-color'] !='' ){
			$dynamic_css1[] = "color:{$icon_options['font-color']};";
		}

		if(isset($icon_options['font-size']) && $icon_options['font-size'] !='' ){
			$dynamic_css1[] = "font-size:{$icon_options['font-size']}px;";
		}

		if(!empty($dynamic_css1)){
			$dynamic_css1 = implode(' ', $dynamic_css1);
		}else{
			$dynamic_css1 ='';
		}

		$icon_name = explode('|', $icon_options['name']);
		if(isset($icon_name) && $icon_name[0] !=''){
			?>
			<div class="ec-featured-item"><span><i class="<?php echo esc_attr($icon_name[0] . ' ' . $icon_name[1]); ?>"></i></span></div>
			<?php ob_start();
			?>
			.ec-<?php echo $template; ?> .ec-counter-item-<?php echo $counter; ?> .ec-featured-item span { <?php echo esc_attr($dynamic_css); ?> }
			.ec-<?php echo $template; ?> .ec-counter-item-<?php echo $counter; ?> .ec-featured-item span i { <?php echo esc_attr($dynamic_css1); ?> }
			<?php
		 	$ec_dynamic_css_at_end[] = ob_get_contents();
		  	ob_end_clean();
		}
	}
}