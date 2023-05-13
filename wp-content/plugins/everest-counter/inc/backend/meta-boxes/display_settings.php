<?php
defined('ABSPATH') or die("No script kiddies please!");
global $ec_variables;
global $post;
$post_id = $post->ID;

$ec_counter_data = get_post_meta($post_id, 'ec_counter_data', true);
$display_settings = isset($ec_counter_data['ec_display_settings']) ? $ec_counter_data['ec_display_settings'] : array();
?>
<div class="ec-display-settings-wrap clearfix">
	<div class="ec-tabs-header">
		<ul class='ec-tabs-wrap'>
			<li class="ec-tab ec-header-text ec-active" id='ec-tab-header-text'><?php _e( 'Header Text', 'everest-counter' ); ?></li>
			<li class="ec-tab ec-template-selection" id='ec-tab-template-selection'><?php _e( 'Template Selection', 'everest-counter' ); ?></li>
			<li class="ec-tab" id='ec-tab-column-settings'><?php _e('Column Settings', 'everest-counter'); ?></li>
			<li class="ec-tab" id='ec-tab-background-settings'><?php _e('Background Settings', 'everest-counter'); ?></li>
		</ul>
	</div>
	<div class="ec-tabs-content-wrap">
		<div class='ec-tab-content ec-tab-header-text ec-tab-content-active' style=''>
			<div class="ec-tab-content-header">
				<div class='ec-tab-content-header-title'><?php _e('Header Text' , 'everest-counter'); ?></div>
			</div>
			<div class='ec-tab-content-body'>
				<div class="ec-header-text-options-wrap">
					<div class="ec-input-field-wrap">
						<label for="ec-header_text_enable"><?php _e('Enable Header Texts?'); ?></label>
						<input type="checkbox" id='ec-header_text_enable' name='ec_display_settings[header_text][enable]' class='ec-image-overlay-enable-option ec-header-text-enable-option' <?php if(isset($display_settings['header_text']['enable'])){ ?> checked <?php } ?> />
						<label for='ec-header_text_enable'></label>
					</div>
					<div class="ec-input-field-wrap">
						<label for="ec-header-text-input-field"><?php _e( 'Enter texts', 'everest-counter' ); ?></label>
						<input id="ec-header-text-input-field" type="text" name="ec_display_settings[header_text][text]" value="<?php if(isset($display_settings['header_text']['text']) && $display_settings['header_text']['text'] != '' ){ echo $display_settings['header_text']['text']; } ?>">
					</div>
					<div class='ec-style-settings'>
						<div class='ec-style-label'><?php _e( 'Styles', 'everest-counter' ); ?> </div>
						<div class='ec-input-field-wrap'>
							<label for="ec-count-font-family_header_text"><?php _e( 'Font Family ', 'everest-counter' ); ?></label>
							<select name='ec_display_settings[header_text][styles][font-family]' id='ec-count-font-family_header_text'>
								<option value ><?php _e( 'Default', 'everest-counter' ); ?></option>
								<?php
								foreach ( $ec_variables['google-fonts'] as $key1 => $value1 ) { ?>
								<option value='<?php echo $key1; ?>' <?php if(isset( $display_settings['header_text']['styles']['font-family'] )){ selected( $display_settings['header_text']['styles']['font-family'], $key1 ); } ?> ><?php echo $key1; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class='ec-input-field-wrap'>
							<label for="ec-count-font-size_header_text"><?php _e( 'Font size (px) ', 'everest-counter' ); ?></label>
							<input type="number" id='ec-count-font-size_header_text' name='ec_display_settings[header_text][styles][font-size]' value='<?php if( isset($display_settings['header_text']['styles']['font-size']) && $display_settings['header_text']['styles']['font-size'] !='' ){ echo esc_attr($display_settings['header_text']['styles']['font-size']); } ?>' step='0.01' />
						</div>
						<div class='ec-input-field-wrap'>
							<label for="ec-count-font-color_header_text"><?php _e( 'Font color ', 'everest-counter' ); ?></label>
							<input type="text" id='ec-count-font-color_header_text' name='ec_display_settings[header_text][styles][font-color]' class='ec-color-picker' data-alpha="true" value='<?php if( isset($display_settings['header_text']['styles']['font-color']) && $display_settings['header_text']['styles']['font-color'] !='' ){ echo esc_attr($display_settings['header_text']['styles']['font-color']); } ?>' />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='ec-tab-content ec-tab-template-selection' style='display:none;'>
			<div class="ec-tab-content-header">
				<div class='ec-tab-content-header-title'><?php _e('Template Settings' , 'everest-counter'); ?></div>
			</div>
			<div class='ec-tab-content-body'>
				<div class="ec-template-selection-options-wrap">
					<label for='ec-template-selection'><?php _e('Template Selection', 'everest-counter'); ?></label>
					<div class="ec-template-select-wrap">
						<select id='ec-template-selection' name='ec_display_settings[template-selection]' class="ec-img-selector">
						<?php
						$img_url = E_COUNTER_IMAGE_DIR . "/templates/template1.jpg";
						foreach ($ec_variables['templates'] as $key => $value) { ?>
							<option value="<?php echo esc_attr($value['value']); ?>" <?php if(isset($display_settings['template-selection']) && $display_settings['template-selection'] == $value['value'] ){ ?> selected <?php $img_url = $value['img']; } ?> data-img="<?php echo esc_url($value['img']); ?>"><?php echo esc_attr($value['name']); ?></option>
						<?php
						}
						?>
						</select>
					</div>
					<div class="ec-img-selector-media">
						<img src="<?php echo esc_url($img_url); ?>" alt='template image' />
					</div>
				</div>
			</div>
		</div>
		<div class="ec-tab-content ec-tab-column-settings" style="display: none;">
			<div class="ec-tab-content-header">
				<div class='ec-tab-content-header-title'><?php _e('Column Settings' , 'everest-counter'); ?></div>
			</div>
			<div class='ec-tab-content-body'>
				<div class="ec-template-selection-options-wrap">
					<label for='ec-desktop'><?php _e('Desktop', 'everest-counter'); ?></label>
					<div class="ec-template-input-wrap clearfix">
						<div class="slider-range-max"></div>
						<input type='int' id="ec-desktop" readonly name='ec_display_settings[columns][desktop]' key='any' class='ec-input-field' data-min='1' data-max='6' value='<?php if(isset($display_settings['columns']['desktop']) && $display_settings['columns']['desktop'] != '' ){ echo $display_settings['columns']['desktop']; }else{ echo "3"; } ?>' />
					</div>
				</div>
				<div class="ec-template-selection-options-wrap">
					<label for='ec-tablet'><?php _e('Tablet', 'everest-counter'); ?></label>
					<div class="ec-template-input-wrap clearfix">
						<div class="slider-range-max"></div>
						<input type='int' id="ec-tablet" readonly name='ec_display_settings[columns][tablet]' key='any' class='ec-input-field' data-min='1' data-max='4' value='<?php if(isset($display_settings['columns']['tablet']) && $display_settings['columns']['tablet'] != '' ){ echo $display_settings['columns']['tablet']; }else{ echo "3"; } ?>' />
					</div>
				</div>
				<div class="ec-template-selection-options-wrap">
					<label for="ec-mobile"><?php _e('Mobile', 'everest-counter'); ?></label>
					<div class="ec-template-input-wrap clearfix">
						<div class="slider-range-max"></div>
						<input type='int' id="ec-mobile" readonly name='ec_display_settings[columns][mobile]' key='any' class='ec-input-field' data-min='1' data-max='2' value='<?php if(isset($display_settings['columns']['mobile']) && $display_settings['columns']['mobile'] != '' ){ echo $display_settings['columns']['mobile']; }else{ echo "2"; } ?>' />
					</div>
				</div>
			</div>
		</div>
		<div class="ec-tab-content ec-tab-background-settings" style="display: none;">
			<div class="ec-tab-content-header">
				<div class='ec-tab-content-header-title'><?php _e('Background settings' , 'everest-counter'); ?></div>
			</div>
			<div class='ec-tab-content-body'>
				<div class="ec-options-wrap">
					<label for="ec-background-option"><?php _e('Background selection', 'everest-counter'); ?></label>
					<div class="ec-background-select-wrap">
						<select id='ec-background-option' name='ec_display_settings[background][option]' class="ec-select-options ec-background-selector">
							<option value='' ><?php _e( 'None', 'everest-counter' ); ?></option>
							<option value='image' <?php if(isset($display_settings['background']['option']) && $display_settings['background']['option'] == 'image' ){ ?> selected  <?php } ?> > <?php _e( 'Image', 'everest-counter'); ?></option>
							<option value='background-color' <?php if(isset($display_settings['background']['option']) && $display_settings['background']['option'] == 'background-color' ){ ?> selected  <?php } ?>><?php _e( 'Background Color', 'everest-counter'); ?></option>
							<option value='video' <?php if(isset($display_settings['background']['option']) && $display_settings['background']['option'] == 'video' ){ ?> selected  <?php } ?>><?php _e( 'Video', 'everest-counter' ); ?></option>
						</select>
					</div>
					<div class="ec-background-select-content">
						<div class="ec-background-image-content-wrap ec-image ec-common-content-wrap" style="display: <?php if(isset($display_settings['background']['option']) && $display_settings['background']['option'] =='image' ){ ?> block; <?php }else{ ?> none; <?php } ?>">
							<div class="ec-input-field-wrap">
								<label for="ec-background-image-url"><?php _e( 'Image Upload: ', 'everest-counter' ); ?></label>
								<div class="ec-item-input-field-wrap">
									<input type="text" id='ec-background-image-url' name='ec_display_settings[background][image][url]' class='ec-image-upload-url' value='<?php if(isset($display_settings['background']['image']['url']) && $display_settings['background']['image']['url'] != '' ){ echo $display_settings['background']['image']['url']; } ?>' />
									<input type="button" class='ec-button ec-image-upload-button' value='<?php _e('Upload Image', 'everest-counter'); ?>' />
								</div>
								<div class='ec-image-preview'>
									<img src='<?php if(isset($display_settings['background']['image']['url']) && $display_settings['background']['image']['url'] != '' ){ echo $display_settings['background']['image']['url']; } ?>' />
								</div>
							</div>
						</div>
						<div class="ec-background-color-content ec-background-color ec-common-content-wrap" style="display: <?php if(isset($display_settings['background']['option']) && $display_settings['background']['option'] =='background-color' ){ ?> block; <?php }else{ ?> none; <?php } ?>">
							<div class="ec-background-color-content-wrap ec-options-wrap">
								<div class="ec-input-field-wrap">
									<label for="ec-background-background-color"><?php _e('Background Color', 'everest-counter' ); ?></label>
									<input id='ec-background-background-color' type="text" name='ec_display_settings[background][background-color][color]' class='ec-color-picker' data-alpha="true" value='<?php if(isset($display_settings['background']['background-color']['color']) && $display_settings['background']['background-color']['color'] != '' ){ echo $display_settings['background']['background-color']['color']; } ?>' />
								</div>
							</div>
						</div>
						<div class="ec-video-content ec-video ec-common-content-wrap" style="display: <?php if(isset($display_settings['background']['option']) && $display_settings['background']['option'] =='video' ){ ?> block; <?php }else{ ?> none; <?php } ?>">
							<div class="ec-background-color-content-wrap ec-options-wrap">
								<div class="ec-input-field-wrap">
									<label for="ec-background-video-type"> <?php _e('Background Video type', 'everest-counter' ); ?></label>
									<select id='ec-background-video-type' name='ec_display_settings[background][video][type]' class='ec-video-select-option'>
										<option value='youtube' <?php if(isset($display_settings['background']['video']['type']) && $display_settings['background']['video']['type'] == 'youtube' ){ ?> selected  <?php } ?> ><?php _e('Youtube', 'everest-counter'); ?></option>
										<option value='viemo' <?php if(isset($display_settings['background']['video']['type']) && $display_settings['background']['video']['type'] == 'viemo' ){ ?> selected  <?php } ?> ><?php _e('Viemo', 'everest-counter'); ?></option>
										<option value='html5' <?php if(isset($display_settings['background']['video']['type']) && $display_settings['background']['video']['type'] == 'html5' ){ ?> selected  <?php } ?>><?php _e('HTML5', 'everest-counter'); ?></option>
									</select>
								</div>
								<div class="ec-common-content-wrap-inner ec-youtube-details-input ec-youtube" style='display: <?php if(isset($display_settings['background']['video']['type']) && $display_settings['background']['video']['type'] =='youtube' ){ ?> block; <?php }else if(!isset($display_settings['background']['video']['type'])){ echo "block"; }else{ ?> none; <?php } ?>'>
									<div class='ec-input-field-wrap'>
										<label for="ec-background-video-youtube"><?php _e('Youtube Video URL', 'everest-counter'); ?></label>
										<input id='ec-background-video-youtube' type="url" name='ec_display_settings[background][video][youtube][video-url]' value='<?php if(isset($display_settings['background']['video']['youtube']['video-url']) && $display_settings['background']['video']['youtube']['video-url'] != '' ){ echo $display_settings['background']['video']['youtube']['video-url']; } ?>'/>
									</div>
								</div>
								<div class="ec-input-field-wrap ec-common-content-wrap-inner ec-viemo-details-input ec-viemo" style='display: <?php if(isset($display_settings['background']['video']['type']) && $display_settings['background']['video']['type'] =='viemo' ){ ?> block; <?php }else{ ?> none; <?php } ?>'>
									<label for="ec-background-video-viemo"><?php _e( 'Viemo Video URL', 'everest-counter' ); ?></label>
									<input id='ec-background-video-viemo' type="url" name='ec_display_settings[background][video][viemo][video-url]' value='<?php if(isset($display_settings['background']['video']['viemo']['video-url']) && $display_settings['background']['video']['viemo']['video-url'] != '' ){ echo $display_settings['background']['video']['viemo']['video-url']; } ?>' />
								</div>
								<div class="ec-input-field-wrap ec-common-content-wrap-inner ec-html5-video-details-input ec-html5" style='display: <?php if(isset($display_settings['background']['video']['type']) && $display_settings['background']['video']['type'] =='html5' ){ ?> block; <?php }else{ ?> none; <?php } ?>'>
									<div class="ec-options-wrap">
										<label for="ec-background-video-html5-video-url"><?php _e( 'MP4 video URL: ', 'everest-counter' ); ?></label>
										<div class="ec-item-input-field-wrap">
											<input type="url" id='ec-background-video-html5-video-url' name='ec_display_settings[background][video][html5][mp4-video-url]' class='ec-image-upload-url' value='<?php if(isset($display_settings['background']['video']['html5']['mp4-video-url']) && $display_settings['background']['video']['html5']['mp4-video-url'] != '' ){ echo $display_settings['background']['video']['html5']['mp4-video-url']; } ?>' />
											<input type="button" class='ec-button ec-image-upload-button' value='<?php _e('Upload Video', 'everest-counter'); ?>' />
										</div>
									</div>
									<div class="ec-options-wrap">
										<label for="ec-background-video-html5-video-url"><?php _e( 'WEBM video URL: ', 'everest-counter' ); ?></label>
										<div class="ec-item-input-field-wrap">
											<input type="url" id='ec-background-video-html5-video-url' name='ec_display_settings[background][video][html5][webm-video-url]' class='ec-image-upload-url' value='<?php if(isset($display_settings['background']['video']['html5']['webm-video-url']) && $display_settings['background']['video']['html5']['webm-video-url'] != '' ){ echo $display_settings['background']['video']['html5']['webm-video-url']; } ?>' />
											<input type="button" class='ec-button ec-image-upload-button' value='<?php _e('Upload Video', 'everest-counter'); ?>' />
										</div>
									</div>
									<div class="ec-options-wrap">
										<label for="ec-background-video-html5-video-url"><?php _e( 'OGV video URL: ', 'everest-counter' ); ?></label>
										<div class="ec-item-input-field-wrap">
											<input type="url" id='ec-background-video-html5-video-url' name='ec_display_settings[background][video][html5][ogv-video-url]' class='ec-image-upload-url' value='<?php if(isset($display_settings['background']['video']['html5']['ogv-video-url']) && $display_settings['background']['video']['html5']['ogv-video-url'] != '' ){ echo $display_settings['background']['video']['html5']['ogv-video-url']; } ?>' />
											<input type="button" class='ec-button ec-image-upload-button' value='<?php _e('Upload Video', 'everest-counter'); ?>' />
										</div>
									</div>
								</div>
								<div class='ec-input-field-wrap'>
									<label for='ec-display-settings-background-video-start-time'><?php _e( 'Video start/end time (sec)', 'everest-counter' ); ?></label>
									<div class="ec-item-input-field-wrap">
										<input type="number" placeholder="Start Time" step="0.01" id='ec-display-settings-background-video-start-time' name='ec_display_settings[background][video][start-time]' class="ec-image-upload-url" value='<?php if(isset($display_settings['background']['video']['start-time']) && $display_settings['background']['video']['start-time'] != '' ){ echo $display_settings['background']['video']['start-time']; } ?>'>
										<input type="number" step="0.01" placeholder="End Time" id='ec-display-settings-background-video-end-time' name='ec_display_settings[background][video][end-time]' class="ec-image-upload-url" value='<?php if(isset($display_settings['background']['video']['end-time']) && $display_settings['background']['video']['end-time'] != '' ){ echo $display_settings['background']['video']['end-time']; } ?>'>
										<div class="input-info"><?php _e("Please enter the start time and end time in seconds for video(these values will be applied for each loop as well.)", 'everest-counter'); ?></div>
									</div>
								</div>
							</div>
						</div>
						<div class="ec-parallax-options-content-wrap ec-options-wrap ec-common-content-wrap ec-common-content-wrap-all" style="<?php if( isset($display_settings['background']['option']) && ($display_settings['background']['option'] =='image' || $display_settings['background']['option'] =='video' ) ){ ?> display:block; <?php }else{ ?> display: none; <?php } ?>">
							<div class="ec-checkbox-outer-wrap">
								<div class="ec-input-field-wrap">
									<label for="ec-background-video-parallax"><?php _e('Enable Parallax Effect?'); ?></label>
									<input type="checkbox" id='ec-background-video-parallax' name='ec_display_settings[background][parallax][enable]' class='ec-image-overlay-enable-option ec-parallax-enable-option' <?php if(isset($display_settings['background']['parallax']['enable'])){ ?> checked <?php } ?> />
									<label for='ec-background-video-parallax'></label>
								</div>

								<div class="ec-checkbox-checked-options" style='display: <?php if(isset($display_settings['background']['parallax']['enable'])){ ?> block; <?php }else{ ?> none; <?php } ?>'>
									<div class="ec-input-field-wrap ec-image-overlay-color">
										<label for="ec-parallax-type-select-option"><?php _e( 'Parallax Type', 'everest-counter' ); ?></label>
										<select id='ec-parallax-type-select-option' name='ec_display_settings[background][parallax][type]' class='ec-parallax-type-select-option'>
											<option value='scroll' <?php if(isset($display_settings['background']['parallax']['type']) && $display_settings['background']['parallax']['type'] == 'scroll' ){ ?> selected  <?php } ?> ><?php _e('Scroll', 'everest-counter'); ?></option>
											<option value='scale' <?php if(isset($display_settings['background']['parallax']['type']) && $display_settings['background']['parallax']['type'] == 'scale' ){ ?> selected  <?php } ?> ><?php _e('Scale', 'everest-counter'); ?></option>
											<option value='opacity' <?php if(isset($display_settings['background']['parallax']['type']) && $display_settings['background']['parallax']['type'] == 'opacity' ){ ?> selected  <?php } ?>><?php _e('Opacity', 'everest-counter'); ?></option>
											<option value='scroll-opacity' <?php if(isset($display_settings['background']['parallax']['type']) && $display_settings['background']['parallax']['type'] == 'scroll-opacity' ){ ?> selected  <?php } ?> ><?php _e('Scroll Opacity', 'everest-counter'); ?></option>
											<option value='scale-opacity' <?php if(isset($display_settings['background']['parallax']['type']) && $display_settings['background']['parallax']['type'] == 'scale-opacity' ){ ?> selected  <?php } ?> ><?php _e('Scale Opacity', 'everest-counter'); ?></option>
										</select>
									</div>
									<div class="ec-input-field-wrap ec-image-overlay-color">
										<label for="ec-background-video-overlay-color"><?php _e( 'Speed', 'everest-counter' ); ?></label>
										<div class="ec-item-input-field-wrap">
											<input type="number" step='0.01' min='0' max='2' id='ec-background-video-overlay-color' class='min-max-value' name='ec_display_settings[background][parallax][speed]' data-alpha="true" value='<?php if(isset($display_settings['background']['parallax']['speed']) && $display_settings['background']['parallax']['speed'] != '' ){ echo $display_settings['background']['parallax']['speed']; }else { echo "0.5"; } ?>' />
											<div class="input-info"><?php _e('Please enter the number between 0 and 2', 'everest-counter'); ?></div>
										</div>
									</div>

									<div class="ec-input-field-wrap ec-image-overlay-color">
										<label for="ec-background-video-enable-parallax-mobile"><?php _e( 'Enable on Mobile devices?', 'everest-counter' ); ?></label>
										<input type="checkbox" id='ec-background-video-enable-parallax-mobile' name='ec_display_settings[background][parallax][enable-on-mobile-devices]' class='ec-enable-parallax-on-mobile-option' <?php if(isset($display_settings['background']['parallax']['enable-on-mobile-devices'])){ ?> checked <?php } ?> />
										<label for='ec-background-video-enable-parallax-mobile'></label>
									</div>
								</div>
							</div>
							<div class="ec-checkbox-outer-wrap">
								<div class="ec-input-field-wrap">
									<label for="ec-background-video-overlay-enable"><?php _e( 'Enable Overlay?', 'everest-counter' ); ?></label>
									<input type="checkbox" id='ec-background-video-overlay-enable' name='ec_display_settings[background][overlay][enable]' class='ec-image-overlay-enable-option' <?php if(isset($display_settings['background']['overlay']['enable'])){ ?> checked <?php } ?> />
									<label for='ec-background-video-overlay-enable'></label>
								</div>

								<div class="ec-input-field-wrap ec-checkbox-checked-options ec-image-overlay-color" style='display: <?php if(isset($display_settings['background']['overlay']['enable'])){ ?> block; <?php }else{ ?> none; <?php } ?>'>
									<label for="ec-background-video-overlay-color"><?php _e( 'Overlay Color', 'everest-counter' ); ?></label>
									<input type="text" id='ec-background-video-overlay-color' class='ec-color-picker' name='ec_display_settings[background][overlay][color]' data-alpha="true" value='<?php if(isset($display_settings['background']['overlay']['color']) && $display_settings['background']['overlay']['color'] != '' ){ echo $display_settings['background']['overlay']['color']; } ?>' />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>