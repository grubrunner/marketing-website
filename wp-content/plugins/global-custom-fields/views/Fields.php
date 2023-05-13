<div id='gcf-fields' class='gcf-opt-group d-none'>
    <?php
    global $gcf_groups;
    if (count($gcf_groups) > 0) {
        foreach ($gcf_groups as $key => $group) {
            ?>
            <div class="gcf-form-section d-flex" data-group="<?php echo esc_html_e($group, 'text-domain'); ?>">
                <label>
                    <?php echo esc_html_e('"' . $group . '" Fields', 'text-domain'); ?><br>
                    <small><?php _e('Comma Separated Fields for Group', 'global-custom-fields'); ?></small>
                </label>
                <div class="d-flex flex-wrap w-100">
                    <?php 
                    $value = get_option('gcf_options')['gcf-fields'][$group];
                    ?>
                    <input type="hidden" name="gcf_options[gcf-fields][<?php echo esc_html_e($group, 'text-domain'); ?>]" value="<?php echo esc_html_e($value, 'text-domain'); ?>">
                    <?php
                    $group_fields = array_filter(explode(',', $value));
                    foreach ($group_fields as $key => $group_field) {
                        ?>
                        <div class="gcf-group-label" value="<?php echo esc_html_e($group_field, 'text-domain'); ?>"><?php echo esc_html_e($group_field, 'text-domain'); ?></div>
                    <?php
                    }
                    ?>
                    <div class="w-100 d-flex">
                        <label><?php _e('New field(s)', 'global-custom-fields'); ?><br><small><?php _e('Comma Separated', 'global-custom-fields'); ?></small></label>
                        <input type="text" class='add-fields' class="sanitize">
                    </div>
                </div>
            </div>
        <?php
        }
    } else {
        ?><p><?php _e('No group defined; Go to "Settings"', 'global-custom-fields'); ?><p><?php
    }
    ?>
</div>