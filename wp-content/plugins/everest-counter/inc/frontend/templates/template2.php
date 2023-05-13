<?php
defined('ABSPATH') or die("No script kiddies please!");
include('parts/template-header.php'); ?>
<div class="ec-shortcode-outer-wrap  ec-<?php echo $template; ?> <?php echo $dynamic_classes.' '.$responsive_class; ?>" <?php echo $outer_wrap_attributes; ?> style="<?php echo $wrap_inner_styles; ?>" >
	<?php include('parts/overlay.php');
	$total_count_items = count($items);

	if( $detect->isMobile() && !$detect->isTablet() ){
	  $columns = $columns['mobile'];
	}
	// Any tablet device.
	else if( $detect->isTablet() ){
	  $columns = $columns['tablet'];
	}
	// any desktop devices
	else{
	  	$columns = $columns['desktop'];
	}
	include('parts/header-text.php');
	?>
	<div class="ec-counter-items-wrap <?php echo $column_main_class; if(isset($header_text_settings['enable'])){ echo ' ec-header-text-enabled'; } ?> clearfix" >
		<?php
		$counter=0;
		foreach (array_chunk($items, $columns, true) as $item_array) {
	    	echo "<div class='ec-row-wrapper clearfix'>";
			foreach ($item_array as $item): $counter++;
				$append_classes = array();
				$append_attributes = array();
				if(isset($item['animation']['enable'])){
					$append_classes[] = "wow";
					$append_classes[] = "animated";
					$append_classes[] = $item['animation']['type'];

					if(isset($item['animation']['delay']) && $item['animation']['delay'] !=''){
						$delay_time = $item['animation']['delay'];
						$delay = "data-wow-delay='{$delay_time}s'";
					}else{
						$delay = "data-wow-delay='0s'";
					}

					if(isset($item['animation']['duration']) && $item['animation']['duration'] !=''){
						$duration_time = $item['animation']['duration'];
						$duration = "data-wow-duration='{$duration_time}s'";
					}else{
						$duration = "data-wow-duration='2s'";
					}

				}else{
					$append_classes = '';
				}

				if(!empty($append_classes)){
					$append_classes = implode(' ', $append_classes);
				}else{
					$append_classes ='';
					$delay = '';
					$duration='';
				}

				$bg_image_options = isset($item['background-image']) ? $item['background-image'] : array();
				?>
				<div class='ec-counter-item ec-counter-item-<?php echo esc_attr($counter); echo ' '.esc_attr($append_classes); ?>' <?php echo $delay.' '.$duration; ?>>
					<div class="ec-all-item-wrap <?php if(isset($bg_image_options['url']) && $bg_image_options['url'] ==''){ echo "ec-no-background-image"; } ?> clearfix ">
						<?php if(isset($bg_image_options['url']) && $bg_image_options['url']!=''){ ?>
						<div class='ec-background-image-wrap' style="background-image: url('<?php echo esc_url($bg_image_options['url']); ?>');"></div>
						<?php } ?>
						<div class='ec-right-content-wrap'>
							<?php
							include('parts/feature-item.php');
							include('parts/count.php');
							include('parts/title.php');
							include('parts/subtitle.php');
							include('parts/button.php');
							?>
						</div>
					</div>
				</div>
				<?php
			endforeach;
			echo "</div>";
		}
		?>

	</div>
</div>