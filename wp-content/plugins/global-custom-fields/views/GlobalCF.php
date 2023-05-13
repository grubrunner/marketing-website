<div id='gcf' class='gcf-opt-group d-none'>
    <?php
    global $gcf_groups, $gcf_fields;
    if (count($gcf_groups)) {
        ?>
        <div class="gcf-groups d-flex flex-wrap">
        <?php
        foreach ($gcf_groups as $key => $group) {
            ?>
            <div class="gcf-group-label" data-show="<?php echo esc_html_e($group, 'text-domain'); ?>"><?php echo esc_html_e($group, 'text-domain'); ?></div>
            <?php
        }
        ?>
        </div>
        <div clas="gcf-groups-contents">
        <?php
        foreach ($gcf_groups as $key => $group) {
            ?>
            <div class='gcf-group-content' data-show="<?php echo esc_html_e($group, 'text-domain'); ?>">
                <?php
                if (count($gcf_fields[$group]) > 0) {
                    foreach ($gcf_fields[$group] as $key => $field) {
                        ?>
                        <div class='gcf-form-section d-flex'>
                            <label><span><?php _e('Field', 'global-custom-fields'); ?></span> <?php esc_html_e($field, 'text-domain'); ?></label>
                            <?php $value = self::get_gcf_option($group)[$field]; ?>
                            <textarea type="text" class="codemirror-textarea" name="gcf_options[gcf][<?php echo esc_html_e($group, 'text-domain'); ?>][<?php echo esc_html_e($field, 'text-domain'); ?>]"><?php echo esc_html_e($value, 'text-domain'); ?></textarea>
                        </div>
                        <?php
                    }
                } else {
                    ?><p><?php _e('No fields defined for this group; Go to "Fields"', 'global-custom-fields'); ?><p><?php
                }
                ?>
            </div>
        <?php
        }
        ?>
        </div>
    <?php
    } else {
        ?><p><?php _e('No group defined; Go to "Settings"', 'global-custom-fields'); ?><p><?php
    }
    ?>
</div>