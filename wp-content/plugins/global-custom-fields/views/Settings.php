<div id='gcf-settings' class='gcf-opt-group d-none'>
    <div class="gcf-form-section d-flex">
        <label><?php _e('GCF Groups', 'global-custom-fields'); ?></label>
        <div class="d-flex flex-wrap w-100">
            <?php $value = get_option('gcf_options')['gcf-settings']['gcf-groups']; ?>
            <input type="hidden" id='gcf-setting-groups' name="gcf_options[gcf-settings][gcf-groups]" value="<?php echo esc_html_e($value, 'text-domain'); ?>">
            <?php
            $groups = array_filter(explode(',', $value));
            foreach ($groups as $key => $group) {
                ?>
                <div class="gcf-group-label" value="<?php echo esc_html_e($group, 'text-domain'); ?>"><?php echo esc_html_e($group, 'text-domain'); ?></div>
            <?php
            }
            ?>
            <div class="w-100 d-flex">
                <label><?php _e('New group(s)', 'global-custom-fields'); ?><br><small><?php _e('Comma Separated', 'global-custom-fields'); ?></small></label>
                <input type="text" id='add-groups' class="sanitize">
            </div>
        </div>
    </div>
    <div class="gcf-form-section d-flex">
        <label><?php _e('Custom HTML Tags', 'global-custom-fields'); ?><br><small><?php _e('Enable custom HTML tags for fields (comma separated)', 'global-custom-fields'); ?></small></label>
        <div class="d-flex flex-wrap w-100">
            <?php $value = get_option('gcf_options')['gcf-settings']['gcf-html-tags']; ?>
            <textarea type="text" name="gcf_options[gcf-settings][gcf-html-tags]" class="sanitize"><?php echo esc_html_e($value, 'text-domain'); ?></textarea>
        </div>
    </div>
    <div class="gcf-form-section d-flex">
        <label><?php _e('Custom HTML Attributes', 'global-custom-fields'); ?><br><small><?php _e('Enable custom HTML attributes for fields (comma separated)', 'global-custom-fields'); ?></small></label>
        <div class="d-flex flex-wrap w-100">
            <?php $value = get_option('gcf_options')['gcf-settings']['gcf-html-attr']; ?>
            <textarea type="text" name="gcf_options[gcf-settings][gcf-html-attr]" class="sanitize"><?php echo esc_html_e($value, 'text-domain'); ?></textarea>
        </div>
    </div>
</div>