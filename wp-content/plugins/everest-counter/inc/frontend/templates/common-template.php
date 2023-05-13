<?php
defined('ABSPATH') or die("No script kiddies please!");
include('parts/template-header.php'); ?>
<div class="ec-shortcode-outer-wrap ec-<?php echo $template; ?> <?php echo $dynamic_classes.' '.$responsive_class; ?>" <?php echo $outer_wrap_attributes; ?> style="<?php echo $wrap_inner_styles; ?>" >
	<?php
	include('parts/overlay.php');
	$total_count_items = count($items);
	include('parts/header-text.php');
	?>
	<div class="ec-counter-items-wrap <?php echo $column_main_class; if(isset($header_text_settings['enable'])){ echo ' ec-header-text-enabled'; } ?> clearfix" >
		<?php
		$counter=0;
		foreach ($items as $item): $counter++;
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
			<div class='ec-counter-item ec-counter-item-<?php echo esc_attr($counter); echo ' '.esc_attr($append_classes); ?>' <?php echo $delay.' '.$duration; ?>  style="background-image: url('<?php echo esc_url($bg_image_options['url']); ?>');">
			<?php
			if($template == 'template2'){ ?>
				<div class='ec-icon-count-wrap clearfix'>
					<?php
					include('parts/feature-item.php');
					include('parts/count.php');
					?>
				</div>
				<?php
				include('parts/title.php');
				include('parts/subtitle.php');
				include('parts/button.php');
			}else if($template == 'template3' || $template == 'template4'){
				?>
				<div class="ec-item-wrap clearfix">
					<?php
					include('parts/feature-item.php');
					?>
					<div class="ec-right-content">
					<?php
					include('parts/count.php');
					include('parts/title.php');
					include('parts/subtitle.php');
					include('parts/button.php');
					?>
					</div>
				</div>
				<?php
			}else if($template =='template5' || $template =='template6' || $template =='template7' || $template =='template8' || $template =='template9' || $template =='template10'){
				include('parts/feature-item.php');
				include('parts/count.php');
				include('parts/title.php');
				include('parts/subtitle.php');
				include('parts/button.php');
			}else{
				include('parts/feature-item.php');
				include('parts/count.php');
				include('parts/title.php');
				include('parts/subtitle.php');
				include('parts/button.php');
				} ?>
			</div>
			<?php
		endforeach; ?>
	</div>
</div>