<?php
defined('ABSPATH') or die("No script kiddies please!");
global $ec_variables;
if(isset($key)){ $key = $key; }else{ $key = everestCounterClass:: generateRandomIndex(); }
?>
<div class='ec-count-item-wrap'>
	<div class='ec-count-item-wrap-inner'>
		<div class="ec-count-item-header clearfix">
			<div class='ec-item-header-title'><?php _e('Item '.$counter, 'everest-counter'); $counter++;?></div>
			<div class='ec-item-functions'>
				<span class='ec-item-shorting'><i class="fa fa-arrows-alt"></i></span>
				<span class='ec-item-delete' data-confirm="<?php _e('Are you sure you want to delete this item?', 'everest-counter' ); ?>"><i class="fa fa-trash"></i></span>
				<span class='ec-item-hide-show'><i class="fa fa-caret-down"></i></span>
			</div>
		</div>
		<div class='ec-count-item-body clearfix' style='display:none;'>
			<div class='ec-item-imageoricon-selection ec-item-section-wrap'>
				<div class="ec-count-item-inner-header">
					<span class='ec-item-title'><?php _e('Icon Settings', 'everest-counter'); ?></span>
					<span class='ec-item-section-hide-show'><i class="fa fa-caret-down"></i></span>
				</div>
				<div class="ec-count-item-inner-body">
					<div class="ec-item-font-or-image-selection">
						<div class="ec-item">
							<label for='ec-icon-selection_<?php echo $key; ?>' class='ec-item-label'><?php _e( 'Icon selection ', 'everest-counter' ); ?></label>
							<select id='ec-icon-selection_<?php echo $key; ?>' class="ec-icon-selection" name='item[<?php echo $key; ?>][icon-selection]'>
								<option><?php _e('None', 'everest-counter' ); ?></option>
								<option value='icon' <?php if(isset($item['icon-selection']) && $item['icon-selection'] == 'icon' ){ ?> selected <?php } ?>><?php _e('Font Icon', 'everest-counter'); ?></option>
								<option value='image' <?php if(isset($item['icon-selection']) && $item['icon-selection'] == 'image' ){ ?> selected <?php } ?>><?php _e('Image', 'everest-counter'); ?></option>
							</select>
						</div>
						<div class="ec-item ec-count-item-font-icon" <?php if(isset($item['icon-selection']) && $item['icon-selection'] == 'icon' ){ ?> style="display:block;" <?php }else{ ?> style="display:none;" <?php } ?>>
							<div class='ec-item'>
								<label for="wpfm-icon-picker-icon_<?php echo $key; ?>"><?php _e( 'Icon', 'everest-counter' ); ?></label>
								<input class="ec-icon-picker" type="hidden" id="wpfm-icon-picker-icon_<?php echo $key; ?>" name='item[<?php echo $key; ?>][icon][name]' value='<?php if(isset($item['icon']['name']) && $item['icon']['name'] != '' ){ echo esc_attr($item['icon']['name']); } ?>' />
								<div data-target="#wpfm-icon-picker-icon_<?php echo $key; ?>" class="ec-button icon-picker <?php if (isset($item['icon']['name']) && $item['icon']['name'] !='') { $v = explode('|', $item['icon']['name']); echo $v[0] . ' ' . $v[1]; } ?> "><?php _e( 'Select Icon', 'everest-counter' ); ?></div>
							</div>
							<div class='ec-style-settings'>
								<div class='ec-style-label'><?php _e( 'Styles', 'everest-counter' ); ?> </div>
								<div class="ec-item">
									<label for="ec-item-font-icon-color_<?php echo $key; ?>"><?php _e( 'Icon Color ', 'everest-counter' ); ?></label>
									<div class='ec-item-input'><input type="text" data-alpha="true" name='item[<?php echo $key; ?>][icon][font-color]' id='ec-item-font-icon-color_<?php echo $key; ?>' class='ec-color-picker' value='<?php if(isset($item['icon']['font-color']) && $item['icon']['font-color'] != '' ){ echo esc_attr($item['icon']['font-color']); } ?>' /></div>
								</div>
								<div class="ec-item">
									<label for="ec-item-font-icon-size_<?php echo $key; ?>"><?php _e( 'Font Size (px)', 'everest-counter' ); ?></label>
									<div class='ec-item-input'><input id='ec-item-font-icon-size_<?php echo $key; ?>' type="number" step=0.01 name='item[<?php echo $key; ?>][icon][font-size]' class='ec-font-size' value='<?php if(isset($item['icon']['font-size']) && $item['icon']['font-size'] !='' ){ echo esc_attr($item['icon']['font-size']); } ?>' /></div>
								</div>
							</div>
							<div class='ec-item'>
								<label for='ec-checkbox-icon-border_<?php echo $key; ?>' ><?php _e( 'Enable icon border? ', 'everest-counter' ); ?></label>
								<input type="checkbox" name='item[<?php echo $key; ?>][icon][border][enable]' class='ec-checkbox-image-border ec-checkbox-enable-option' id='ec-checkbox-icon-border_<?php echo $key; ?>' <?php if(isset($item['icon']['border']['enable'])){ echo "checked"; } ?> />
								<label for='ec-checkbox-icon-border_<?php echo $key; ?>' ></label>
								<div class="ec-image-border-options ec-checkbox-enabled-option" style="display: <?php if(isset($item['icon']['border']['enable'])){ echo "block"; }else { echo "none"; } ?>">
						      		<div class='ec-item-inner'>
										<label for="ec-item-icon-width_<?php echo $key; ?>"><?php _e( 'Container Width/Height (px)', 'everest-counter' ); ?></label>
										<input id='ec-item-icon-width_<?php echo $key; ?>' type="number" class='ec-item-half-size-field' step='0.01' name='item[<?php echo $key; ?>][icon][width]' placeholder='<?php _e('Width', 'everest-counter'); ?>' value='<?php if(isset($item['icon']['width']) && $item['icon']['width'] != '' ){ echo esc_attr($item['icon']['width']); } ?>' />
										<input type="number" class='ec-item-half-size-field' step='0.01' name='item[<?php echo $key; ?>][icon][height]' placeholder='<?php _e('Height', 'everest-counter'); ?>' value='<?php if(isset($item['icon']['height']) && $item['icon']['height'] != '' ){ echo esc_attr($item['icon']['height']); } ?>' />
									</div>
									<div class="ec-item-inner">
										<label for='ec-icon-border-width_<?php echo $key; ?>'><?php _e('Border width (px)', 'everest-counter'); ?></label>
										<input type='number' step='0.01' id='ec-icon-border-width_<?php echo $key; ?>' name='item[<?php echo $key; ?>][icon][border][width]' value='<?php if(isset($item['icon']['border']['width']) && $item['icon']['border']['width'] != '' ){ echo esc_attr($item['icon']['border']['width']); } ?>'/>
									</div>
						      		<div class="ec-item-inner">
						      			<label for='ec-icon-border-color_<?php echo $key; ?>'><?php _e('Border color', 'everest-counter'); ?></label>
										<input type='text' id='ec-icon-border-color_<?php echo $key; ?>' name='item[<?php echo $key; ?>][icon][border][color]' data-alpha="true" class='ec-color-picker' value='<?php if(isset($item['icon']['border']['color']) && $item['icon']['border']['color'] != '' ){ echo esc_attr($item['icon']['border']['color']); } ?>'/>
						      		</div>
						      		<div class="ec-item-inner">
						      			<label for='ec-icon-border-radius_<?php echo $key; ?>'><?php _e('Border Radius', 'everest-counter'); ?></label>
						      			<div class="ec-item-input-field-wrap">
											<input type='text' id='ec-icon-border-radius_<?php echo $key; ?>' name='item[<?php echo $key; ?>][icon][border][radius]' class='ec-text-input' value='<?php if(isset($item['icon']['border']['radius']) && $item['icon']['border']['radius'] != '' ){ echo esc_attr($item['icon']['border']['radius']); } ?>'/>
											<div class='input-info'><?php _e('Please enter the values either in % or in px.', 'everest-counter'); ?> </div>
						      			</div>
						      		</div>
						      		<div class="ec-item-inner">
						      			<label for='ec-icon-border-line-height_<?php echo $key; ?>'><?php _e('Line Height (px)', 'everest-counter'); ?></label>
										<input type='number' step='0.01' id='ec-icon-border-line-height_<?php echo $key; ?>' name='item[<?php echo $key; ?>][icon][border][line-height]' class='ec-text-input' value='<?php if(isset($item['icon']['border']['line-height']) && $item['icon']['border']['line-height'] != '' ){ echo esc_attr($item['icon']['border']['line-height']); } ?>'/>
						      		</div>
								</div>
							</div>
						</div>
						<div class="ec-item ec-count-item-image" <?php if(isset($item['icon-selection']) && $item['icon-selection'] == 'image' ){ ?> style="display:block;" <?php }else{ ?> style="display:none;" <?php } ?>>
							<div class='ec-item'>
								<label for="ec-image-url_<?php echo $key; ?>"><?php _e( 'Image Upload', 'everest-counter' ); ?></label>
								<div class="ec-item-input-field-wrap">
									<input type="text" id='ec-image-url_<?php echo $key; ?>' name='item[<?php echo $key; ?>][image][url]' class='ec-image-upload-url' value='<?php if(isset($item['image']['url']) && $item['image']['url'] != '' ){ echo esc_url($item['image']['url']); } ?>' />
									<input type="button" class='ec-button ec-image-upload-button' value='<?php _e('Upload Image', 'everest-counter'); ?>' />
								</div>
								<div class='ec-image-preview'>
									<img src='<?php if(isset($item['image']['url']) && $item['image']['url'] != '' ){ echo $item['image']['url']; } ?>' alt='No Image Uploaded' />
								</div>
							</div>
							<div class='ec-style-settings'>
								<div class='ec-style-label'><?php _e( 'Styles', 'everest-counter' ); ?> </div>
								<div class='ec-item'>
									<label for="ec-image-width_<?php echo $key; ?>"><?php _e( 'Width/Height (px) ', 'everest-counter' ); ?></label>
									<input type="number" step='0.01' id='ec-image-width_<?php echo $key; ?>' name='item[<?php echo $key; ?>][image][width]' placeholder='<?php _e('Width', 'everest-counter'); ?>' value='<?php if(isset($item['image']['width']) && $item['image']['width'] != '' ){ echo esc_attr($item['image']['width']); } ?>' />
									<input type="number" step='0.01' name='item[<?php echo $key; ?>][image][height]' placeholder='<?php _e('Height', 'everest-counter'); ?>' value='<?php if(isset($item['image']['height']) && $item['image']['height'] != '' ){ echo esc_attr($item['image']['height']); } ?>' />
								</div>
							</div>
							<div class='ec-item'>
								<label for='ec-checkbox-enable-image-border_<?php echo $key; ?>' ><?php _e( 'Enable Image border? ', 'everest-counter' ); ?></label>
								<input type="checkbox" name='item[<?php echo $key; ?>][image][border][enable]' class='ec-checkbox-image-border ec-checkbox-enable-option' id='ec-checkbox-enable-image-border_<?php echo $key; ?>' <?php if(isset($item['image']['border']['enable'])){ echo "checked"; } ?> />
								<label for='ec-checkbox-enable-image-border_<?php echo $key; ?>' ></label>
								<div class="ec-image-border-options ec-checkbox-enabled-option" style="display: <?php if(isset($item['image']['border']['enable'])){ echo "block"; }else { echo "none"; } ?>">
									<div class='ec-item-inner'>
										<label for="ec-item-image-container-width_<?php echo $key; ?>"><?php _e( 'Container Width/Height (px)', 'everest-counter' ); ?></label>
										<input id='ec-item-image-container-width_<?php echo $key; ?>' class='ec-item-half-size-field' type="number" step='0.01' name='item[<?php echo $key; ?>][image][container-width]' placeholder='<?php _e('Width', 'everest-counter'); ?>' value='<?php if(isset($item['image']['container-width']) && $item['image']['container-width'] != '' ){ echo esc_attr($item['image']['container-width']); } ?>' />
										<input type="number" class='ec-item-half-size-field' step='0.01' name='item[<?php echo $key; ?>][image][container-height]' placeholder='<?php _e('Height', 'everest-counter'); ?>' value='<?php if(isset($item['image']['container-height']) && $item['image']['container-height'] != '' ){ echo esc_attr($item['image']['container-height']); } ?>' />
									</div>
									<div class="ec-item-inner">
										<label for='ec-image-border-width_<?php echo $key; ?>'><?php _e('Border width (px)', 'everest-counter'); ?></label>
										<input type='number' step='0.01' id='ec-image-border-width_<?php echo $key; ?>' name='item[<?php echo $key; ?>][image][border][width]' value='<?php if(isset($item['image']['border']['width']) && $item['image']['border']['width'] != '' ){ echo esc_attr($item['image']['border']['width']); } ?>'/>
									</div>
						      		<div class="ec-item-inner">
						      			<label for='ec-image-border-color_<?php echo $key; ?>'><?php _e('Border color', 'everest-counter'); ?></label>
										<input type='text' name='item[<?php echo $key; ?>][image][border][color]' id='ec-image-border-color_<?php echo $key; ?>' data-alpha="true" class='ec-color-picker' value='<?php if(isset($item['image']['border']['color']) && $item['image']['border']['color'] != '' ){ echo esc_attr($item['image']['border']['color']); } ?>'/>
						      		</div>
						      		<div class="ec-item-inner">
						      			<label for='ec-image-border-radius_<?php echo $key; ?>'><?php _e('Border Radius', 'everest-counter'); ?></label>
						      			<div class="ec-item-input-field-wrap">
											<input type='text' id='ec-image-border-radius_<?php echo $key; ?>' name='item[<?php echo $key; ?>][image][border][radius]' class='ec-text-input' value='<?php if(isset($item['image']['border']['radius']) && $item['image']['border']['radius'] != '' ){ echo esc_attr($item['image']['border']['radius']); } ?>'/>
											<div class='input-info'><?php _e('Please enter the values either in % or in px.', 'everest-counter'); ?> </div>
						      			</div>
						      		</div>
						      		<div class="ec-item-inner">
						      			<label for='ec-image-border-line-height_<?php echo $key; ?>'><?php _e('Line Height (px)', 'everest-counter'); ?></label>
										<input type='number' step='0.01' id='ec-image-border-line-height_<?php echo $key; ?>' name='item[<?php echo $key; ?>][image][border][line-height]' class='ec-text-input' value='<?php if(isset($item['image']['border']['line-height']) && $item['image']['border']['line-height'] != '' ){ echo esc_attr($item['image']['border']['line-height']); } ?>'/>
						      		</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class='ec-item-count-value ec-item-section-wrap'>
				<div class="ec-count-item-inner-header">
					<span class="ec-item-title"><?php _e( 'Counter Settings', 'everest-counter' ); ?></span>
					<span class="ec-item-section-hide-show"><i class="fa fa-caret-down"></i></span>
				</div>
				<div class="ec-count-item-inner-body">
					<div class='ec-item'>
						<label for="ec-count-content_<?php echo $key; ?>"><?php _e( 'Count value ', 'everest-counter' ); ?></label>
						<div class="ec-item-input-field-wrap">
							<input type="text" id='ec-count-content_<?php echo $key; ?>' name='item[<?php echo $key; ?>][count][content]' value='<?php if( isset($item['count']['content']) && $item['count']['content'] !='' ){ echo esc_attr($item['count']['content']); } ?>' />
							<div class='input-info'><?php _e('Please enter the count values in decimal values. If you want to add a comma separator you can use it as well. For example 5,000.55', 'everest-counter'); ?> </div>
						</div>
					</div>
					<div class='ec-item'>
						<label for="ec-count-prefix_<?php echo $key; ?>"><?php _e( 'Count prefix ', 'everest-counter' ); ?></label>
						<div class="ec-item-input-field-wrap">
							<input type="text" id='ec-count-prefix_<?php echo $key; ?>' name='item[<?php echo $key; ?>][count][prefix]' value='<?php if( isset($item['count']['prefix']) && $item['count']['prefix'] !='' ){ echo esc_attr($item['count']['prefix']); } ?>' />
							<div class='input-info'><?php _e('Please enter the prefix value of the counter. This is specifically userful if you want to show the currency symbol before the count value. For example $5,000.55', 'everest-counter'); ?> </div>
						</div>
					</div>
					<div class='ec-item'>
						<label for="ec-count-suffix_<?php echo $key; ?>"><?php _e( 'Count suffix ', 'everest-counter' ); ?></label>
						<div class="ec-item-input-field-wrap">
							<input type="text" id='ec-count-suffix_<?php echo $key; ?>' name='item[<?php echo $key; ?>][count][suffix]' value='<?php if( isset($item['count']['suffix']) && $item['count']['suffix'] !='' ){ echo esc_attr($item['count']['suffix']); } ?>' />
							<div class="input-info"><?php _e('Please enter the suffix value of the counter. This is specifically userful if you want to show the + symbols after the count value. For example 40,000+', 'everest-counter'); ?></div>
						</div>
					</div>
					<div class='ec-style-settings'>
						<div class='ec-style-label'><?php _e( 'Styles', 'everest-counter' ); ?> </div>
						<div class='ec-item'>
							<label for="ec-count-font-family_<?php echo $key; ?>"><?php _e( 'Font Family ', 'everest-counter' ); ?></label>
							<select name='item[<?php echo $key; ?>][count][font-family]' id='ec-count-font-family_<?php echo $key; ?>'>
								<option value ><?php _e( 'Default', 'everest-counter' ); ?></option>
								<?php
								foreach ( $ec_variables['google-fonts'] as $key1 => $value1 ) { ?>
								<option value='<?php echo $key1; ?>' <?php if(isset( $item['count']['font-family'] )){ selected( $item['count']['font-family'], $key1 ); } ?> ><?php echo $key1; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class='ec-item'>
							<label for="ec-count-font-size_<?php echo $key; ?>"><?php _e( 'Font size (px) ', 'everest-counter' ); ?></label>
							<input type="number" id='ec-count-font-size_<?php echo $key; ?>' name='item[<?php echo $key; ?>][count][font-size]' value='<?php if( isset($item['count']['font-size']) && $item['count']['font-size'] !='' ){ echo esc_attr($item['count']['font-size']); } ?>' step='0.01' />
						</div>
						<div class='ec-item'>
							<label for="ec-count-font-color_<?php echo $key; ?>"><?php _e( 'Font color ', 'everest-counter' ); ?></label>
							<input type="text" id='ec-count-font-color_<?php echo $key; ?>' name='item[<?php echo $key; ?>][count][font-color]' class='ec-color-picker' data-alpha="true" value='<?php if( isset($item['count']['font-color']) && $item['count']['font-color'] !='' ){ echo esc_attr($item['count']['font-color']); } ?>' />
						</div>
						<div class='ec-item'>
							<label for="ec-count-animation-enable_<?php echo $key; ?>"><?php _e( 'Enable counter animation? ', 'everest-counter' ); ?></label>
							<input type="checkbox" id='ec-count-animation-enable_<?php echo $key; ?>' name='item[<?php echo $key; ?>][count][animation][enable]' class='ec-counter-animation-enable ec-checkbox-enable-option' id='ec-checkbox-image-border-1' <?php if(isset($item['count']['animation']['enable'])){ echo "checked"; } ?> />
							<label for="ec-count-animation-enable_<?php echo $key; ?>"></label>

							<div class="ec-counter-animation-options ec-checkbox-enabled-option" style="display: <?php if(isset($item['count']['animation']['enable'])){ echo "block"; }else { echo "none"; } ?>">
								<div class="ec-item-inner">
									<label for='ec-count-animation-delay_<?php echo $key; ?>'><?php _e('Delay(milliseconds)', 'everest-counter'); ?></label>
									<input type='number' step='0.01' id='ec-count-animation-delay_<?php echo $key; ?>' name='item[<?php echo $key; ?>][count][animation][delay]' value='<?php if(isset($item['count']['animation']['delay']) && $item['count']['animation']['delay'] != '' ){ echo esc_attr($item['count']['animation']['delay']); } ?>'/>
								</div>
					      		<div class="ec-item-inner">
					      			<label for='ec-count-animation-duration_<?php echo $key; ?>'><?php _e('Duration(milliseconds)', 'everest-counter'); ?></label>
									<input type='number' step='0.01' id='ec-count-animation-duration_<?php echo $key; ?>' name='item[<?php echo $key; ?>][count][animation][duration]' value='<?php if(isset($item['count']['animation']['duration']) && $item['count']['animation']['duration'] != '' ){ echo esc_attr($item['count']['animation']['duration']); } ?>'/>
					      		</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class='ec-item-block-title ec-item-section-wrap'>
				<div class="ec-count-item-inner-header">
					<span class="ec-item-title"><?php _e( 'Title Settings', 'everest-counter' ); ?></span>
					<span class="ec-item-section-hide-show"><i class="fa fa-caret-down"></i></span>
				</div>
				<div class="ec-count-item-inner-body">
					<div class='ec-item'>
						<label for="ec-title-content_<?php echo $key; ?>"><?php _e( 'Title ', 'everest-counter' ); ?></label>
						<input type="text" id='ec-title-content_<?php echo $key; ?>' name='item[<?php echo $key; ?>][title][content]' value='<?php if( isset($item['title']['content']) && $item['title']['content'] !='' ){ echo esc_attr($item['title']['content']); } ?>' />
					</div>
					<div class='ec-style-settings'>
						<div class='ec-style-label'><?php _e( 'Styles', 'everest-counter' ); ?> </div>
						<div class='ec-item'>
							<label for="ec-title-font-family_<?php echo $key; ?>"><?php _e( 'Font Family ', 'everest-counter' ); ?></label>
							<select id='ec-title-font-family_<?php echo $key; ?>' name='item[<?php echo $key; ?>][title][font-family]'>
								<option value ><?php _e( 'Default', 'everest-counter' ); ?></option>
								<?php
								foreach ( $ec_variables['google-fonts'] as $key1 => $value1 ) { ?>
								<option value='<?php echo $key1; ?>' <?php if(isset( $item['title']['font-family'] )){ selected( $item['title']['font-family'], $key1 ); } ?> ><?php echo $key1; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class='ec-item'>
							<label for="ec-title-font-size_<?php echo $key; ?>"><?php _e( 'Font size (px) ', 'everest-counter' ); ?></label>
							<input type="number" step='0.01' id='ec-title-font-size_<?php echo $key; ?>' name='item[<?php echo $key; ?>][title][font-size]' value='<?php if( isset($item['title']['font-size']) && $item['title']['font-size'] !='' ){ echo esc_attr($item['title']['font-size']); } ?>' />
						</div>
						<div class='ec-item'>
							<label for="ec-title-font-color_<?php echo $key; ?>"><?php _e( 'Font color ', 'everest-counter' ); ?></label>
							<input type="text" id='ec-title-font-color_<?php echo $key; ?>' name='item[<?php echo $key; ?>][title][font-color]' class='ec-color-picker' data-alpha="true" value='<?php if( isset($item['title']['font-color']) && $item['title']['font-color'] !='' ){ echo esc_attr($item['title']['font-color']); } ?>' />
						</div>
					</div>
				</div>
			</div>
			<div class='ec-item-block-subtitle ec-item-section-wrap'>
				<div class="ec-count-item-inner-header">
					<span class="ec-item-title"><?php _e( 'Sub Title Settings', 'everest-counter' ); ?></span>
					<span class="ec-item-section-hide-show"><i class="fa fa-caret-down"></i></span>
				</div>
				<div class="ec-count-item-inner-body">
					<div class='ec-item'>
						<label for="ec-subtitle-content_<?php echo $key; ?>"><?php _e( 'Sub Title ', 'everest-counter' ); ?></label>
						<input type="text" id='ec-subtitle-content_<?php echo $key; ?>' name='item[<?php echo $key; ?>][subtitle][content]' value='<?php if( isset($item['subtitle']['content']) && $item['subtitle']['content'] !='' ){ echo esc_attr($item['subtitle']['content']); } ?>' />
					</div>
					<div class='ec-style-settings'>
						<div class='ec-style-label'><?php _e( 'Styles', 'everest-counter' ); ?> </div>
						<div class='ec-item'>
							<label for="ec-subtitle-font-family_<?php echo $key; ?>"><?php _e( 'Font Family ', 'everest-counter' ); ?></label>
							<select id='ec-subtitle-font-family_<?php echo $key; ?>' name='item[<?php echo $key; ?>][subtitle][font-family]'>
								<option value ><?php _e( 'Default', 'everest-counter' ); ?></option>
								<?php
								foreach ( $ec_variables['google-fonts'] as $key1 => $value1 ) { ?>
								<option value='<?php echo $key1; ?>' <?php if(isset( $item['subtitle']['font-family'] )){ selected( $item['subtitle']['font-family'], $key1 ); } ?> ><?php echo $key1; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class='ec-item'>
							<label for="ec-subtitle-font-size_<?php echo $key; ?>"><?php _e( 'Font size (px) ', 'everest-counter' ); ?></label>
							<input type="number" step='0.01' id='ec-subtitle-font-size_<?php echo $key; ?>' name='item[<?php echo $key; ?>][subtitle][font-size]' value='<?php if( isset($item['subtitle']['font-size']) && $item['subtitle']['font-size'] !='' ){ echo esc_attr($item['subtitle']['font-size']); } ?>' />
						</div>
						<div class='ec-item'>
							<label for="ec-subtitle-font-color_<?php echo $key; ?>"><?php _e( 'Font color ', 'everest-counter' ); ?></label>
							<input type="text" id='ec-subtitle-font-color_<?php echo $key; ?>' name='item[<?php echo $key; ?>][subtitle][font-color]' class='ec-color-picker' data-alpha="true" value='<?php if( isset($item['subtitle']['font-color']) && $item['subtitle']['font-color'] !='' ){ echo esc_attr($item['subtitle']['font-color']); } ?>' />
						</div>
					</div>
				</div>
			</div>
			<div class='ec-item-button-link ec-item-section-wrap'>
				<div class="ec-count-item-inner-header">
					<span class="ec-item-title"><?php _e( 'Button Settings', 'everest-counter' ); ?></span>
					<span class="ec-item-section-hide-show"><i class="fa fa-caret-down"></i></span>
				</div>
				<div class="ec-count-item-inner-body">
					<div class='ec-item'>
						<label for="ec-button-label_<?php echo $key; ?>"><?php _e( 'Button Label ', 'everest-counter' ); ?></label>
						<input type="text" id='ec-button-label_<?php echo $key; ?>' name='item[<?php echo $key; ?>][button][label]' value='<?php if( isset($item['button']['label']) && $item['button']['label'] !='' ){ echo esc_attr($item['button']['label']); } ?>' />
					</div>
					<div class='ec-item'>
						<label for="ec-button-url_<?php echo $key; ?>"><?php _e( 'Button link URL ', 'everest-counter' ); ?></label>
						<input type="url" id='ec-button-url_<?php echo $key; ?>' name='item[<?php echo $key; ?>][button][url]' value='<?php if( isset($item['button']['url']) && $item['button']['url'] !='' ){ echo esc_url($item['button']['url']); } ?>' />
					</div>
					<div class='ec-item'>
						<label for="ec-button-target_<?php echo $key; ?>"><?php _e( 'Target ', 'everest-counter' ); ?></label>
						<select id='ec-button-target_<?php echo $key; ?>' class="ec-icon-selection" name='item[<?php echo $key; ?>][button][target]'>
							<option><?php _e('None', 'everest-counter' ); ?></option>
							<option value='_self' <?php if(isset($item['button']['target']) && $item['button']['target'] == 'icon' ){ ?> selected <?php } ?>><?php _e('_self', 'everest-counter'); ?></option>
							<option value='_blank' <?php if(isset($item['button']['target']) && $item['button']['target'] == 'image' ){ ?> selected <?php } ?>><?php _e('_blank', 'everest-counter'); ?></option>
						</select>
					</div>
					<div class='ec-style-settings'>
						<div class='ec-style-label'><?php _e( 'Styles', 'everest-counter' ); ?> </div>
						<div class='ec-item'>
							<label for="ec-button-font-family_<?php echo $key; ?>"><?php _e( 'Font Family ', 'everest-counter' ); ?></label>
							<select id='ec-button-font-family_<?php echo $key; ?>' name='item[<?php echo $key; ?>][button][font-family]'>
								<option value ><?php _e( 'Default', 'everest-counter' ); ?></option>
								<?php
								foreach ( $ec_variables['google-fonts'] as $key1 => $value1 ) { ?>
								<option value='<?php echo $key1; ?>' <?php if(isset( $item['button']['font-family'] )){ selected( $item['button']['font-family'], $key1 ); } ?> ><?php echo $key1; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class='ec-item'>
							<label for="ec-button-font-size_<?php echo $key; ?>"><?php _e( 'Font size (px) ', 'everest-counter' ); ?></label>
							<input type="number" step='0.01' id='ec-button-font-size_<?php echo $key; ?>' name='item[<?php echo $key; ?>][button][font-size]' value='<?php if( isset($item['button']['font-size']) && $item['button']['font-size'] !='' ){ echo esc_attr($item['button']['font-size']); } ?>' />
						</div>
						<div class='ec-item'>
							<label for="ec-button-font-color_<?php echo $key; ?>"><?php _e( 'Font color ', 'everest-counter' ); ?></label>
							<input type="text" id='ec-button-font-color_<?php echo $key; ?>' name='item[<?php echo $key; ?>][button][font-color]' class='ec-color-picker' data-alpha="true" value='<?php if( isset($item['button']['font-color']) && $item['button']['font-color'] !='' ){ echo esc_attr($item['button']['font-color']); } ?>' />
						</div>
					</div>
				</div>
			</div>
			<div class="ec-item-bg-image ec-item-section-wrap">
				<div class="ec-count-item-inner-header">
					<span class="ec-item-title"><?php _e( 'Background Image Settings', 'everest-counter' ); ?></span>
					<span class="ec-item-section-hide-show"><i class="fa fa-caret-down"></i></span>
				</div>
				<div class="ec-count-item-inner-body">
					<div class='ec-item'>
						<label for="ec-background-image-url_<?php echo $key; ?>"><?php _e( 'Image Upload ', 'everest-counter' ); ?></label>
						<div class="ec-item-input-field-wrap">
							<input type="url" id='ec-background-image-url_<?php echo $key; ?>' name='item[<?php echo $key; ?>][background-image][url]' class='ec-image-upload-url' value='<?php if(isset($item['background-image']['url']) && $item['background-image']['url'] != '' ){ echo esc_url($item['background-image']['url']); } ?>' />
							<input type="button" class='ec-button ec-image-upload-button' value='<?php _e('Upload Image', 'everest-counter'); ?>' />
						</div>
						<div class='ec-image-preview'>
							<img src='<?php if(isset($item['background-image']['url']) && $item['background-image']['url'] != '' ){ echo $item['background-image']['url']; } ?>' alt='No Image Uploaded' />
						</div>
					</div>
				</div>
			</div>
			<div class="ec-item-animation ec-item-section-wrap">
				<div class="ec-count-item-inner-header">
					<span class="ec-item-title"><?php _e( 'Item Animation Settings', 'everest-counter' ); ?></span>
					<span class="ec-item-section-hide-show"><i class="fa fa-caret-down"></i></span>
				</div>
				<div class="ec-count-item-inner-body">
					<div class='ec-item'>
						<label for="ec-animation-enable_<?php echo $key; ?>"><?php _e( 'Enable counter animation? ', 'everest-counter' ); ?></label>
						<input type="checkbox" id='ec-animation-enable_<?php echo $key; ?>' name='item[<?php echo $key; ?>][animation][enable]' class='ec-animation-enable ec-checkbox-enable-option' id='ec-checkbox-image-border-1' <?php if(isset($item['animation']['enable'])){ echo "checked"; } ?> />
						<label for="ec-animation-enable_<?php echo $key; ?>"></label>

						<div class="ec-animation-options ec-checkbox-enabled-option" style="display: <?php if(isset($item['animation']['enable'])){ echo "block"; }else { echo "none"; } ?>">
							<div class="ec-item-inner">
								<label for='ec-animation-type_<?php echo $key; ?>'><?php _e('Animation type', 'everest-counter'); ?></label>
								<select id='ec-animation-type_<?php echo $key; ?>' name="item[<?php echo $key; ?>][animation][type]">
									<option value=''><?php _e('None', 'everest-counter'); ?></option>
									<?php
									foreach ($ec_variables['item-animation'] as $item_animation ) :
										if ( !empty( $item_animation['group_name'] ) ):
											?>
											<optgroup label="<?php echo esc_attr( $item_animation['group_name'] ); ?>"></optgroup>
											<?php
											foreach ( $item_animation['group_data'] as $item_animation_array ) :
												?>
												<option value="<?php echo $item_animation_array['value']; ?>" <?php if(isset( $item['animation']['type'] )){ selected( $item['animation']['type'], $item_animation_array['value'] ); } ?> ><?php echo esc_attr($item_animation_array['name']); ?></option>
												<?php
											endforeach;
										endif;
									endforeach;
									?>
								</select>
							</div>
							<div class="ec-item-inner">
								<label for='ec-animation-delay_<?php echo $key; ?>'><?php _e('Delay(seconds)', 'everest-counter'); ?></label>
								<input type='number' step='0.01' id='ec-animation-delay_<?php echo $key; ?>' name='item[<?php echo $key; ?>][animation][delay]' value='<?php if(isset($item['animation']['delay']) && $item['animation']['delay'] != '' ){ echo esc_attr($item['animation']['delay']); } ?>'/>
							</div>
				      		<div class="ec-item-inner">
				      			<label for='ec-animation-duration_<?php echo $key; ?>'><?php _e('Duration(seconds)', 'everest-counter'); ?></label>
								<input type='number' step='0.01' id='ec-animation-duration_<?php echo $key; ?>' name='item[<?php echo $key; ?>][animation][duration]' value='<?php if(isset($item['animation']['duration']) && $item['animation']['duration'] != '' ){ echo esc_attr($item['animation']['duration']); } ?>'/>
				      		</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>