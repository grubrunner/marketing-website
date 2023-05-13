<?php

/**
 * Register Global Fields
 *
 * @package NotificationX\Extensions
 */

namespace NotificationXPro\Extensions;

use NotificationX\Core\Database;
use NotificationX\Core\Locations;
use NotificationX\GetInstance;
use NotificationX\Core\Modules;
use NotificationX\Core\Rule;
use NotificationX\Core\Rules;
use NotificationX\Extensions\GlobalFields as GlobalFieldsFree;
use NotificationX\Types\TypeFactory;

/**
 * ExtensionFactory Class
 */
class GlobalFields extends GlobalFieldsFree {

    /**
     * Initially Invoked when initialized.
     */
    public function __construct() {
        parent::__construct();
        add_filter('nx_link_types', [$this, 'nx_link_types']);
        add_filter('nx_content_fields', [$this, 'content_fields']);
        add_filter('nx_display_fields', [$this, 'display_fields']);
        add_filter('nx_design_tab_fields', [$this, 'design_fields']);
        // add_filter('nx_customize_fields', [$this, 'customize_fields']);
        add_filter('nx_notification_link', array($this, 'custom_url'), 10, 2);
        add_filter( 'nx_text_trim_length',array( $this, 'set_content_trim_length' ), 10, 2 );
        add_filter('nx_filtered_data', [$this, 'random_order'], 10, 2);
    }

    /**
     * Undocumented function
     *
     * @param array $options
     * @return array
     */
    public function nx_link_types($options) {
        $options['custom'] = [
            'value'  => 'custom',
            'label' => __('Custom URL', 'notificationx-pro'),
        ];

        return $options;
    }

    /**
     * Undocumented function
     *
     * @param array $options
     * @return array
     */
    public function content_fields($fields) {

        $fields['content']['fields']['combine_multiorder_text'] = [
            'label'    => __('Combine Multi Order Text', 'notificationx-pro'),
            'name'     => 'combine_multiorder_text',
            'type'     => 'text',
            'priority' => 101,
            'default' => __('more products', 'notificationx-pro'),
            'rules' => Rules::logicalRule([
                Rules::is('combine_multiorder', true),
                Rules::is('notification-template.first_param', 'tag_sales_count', true),
                Rules::includes('source', apply_filters('nx_combine_multiorder_text_dependency', [])),
            ]),
        ];

        $fields['content']['fields']['content_trim_length'] = array(
            'name'        => 'content_trim_length',
            'label'       => __('Content Length', 'notificationx-pro'),
            'type'        => 'text',
            'priority'    => 200,
            'default'     => 80,
            'is_pro'      => true,
            'description' => __('Enter how many characters you want to show in comment or review'),
            'rules'       => Rules::logicalRule([
                Rules::includes('themes', apply_filters('nx_content_trim_length_dependency', [])),
                Rules::is( 'notification-template.third_param', 'tag_post_comment' ),
            ], 'or'),
        );

        $fields['utm_options'] = array(
            'name' => 'utm_options',
            'label' => __('UTM Control', 'notificationx-pro'),
            'type' => 'section',
            'priority'    => 110,
            'fields' => array(
                'utm_campaign' => array(
                    'label'    => __('Campaign', 'notificationx-pro'),
                    'name'     => 'utm_campaign',
                    'type'     => 'text',
                    'priority' => 5,
                    'default'  => '',
                ),
                'utm_medium' => array(
                    'label'    => __('Medium', 'notificationx-pro'),
                    'name'     => 'utm_medium',
                    'type'     => 'text',
                    'priority' => 10,
                    'default'  => '',
                ),
                'utm_source' => array(
                    'label'    => __('Source', 'notificationx-pro'),
                    'name'     => 'utm_source',
                    'type'     => 'text',
                    'priority' => 15,
                    'default'  => '',
                ),
            ),
            'rules' => Rules::logicalRule([
                Rules::is('source', 'google', true),
                Rules::logicalRule([
                    Rules::isOfType('elementor_id', 'number', true),
                    Rules::is('source', 'press_bar', true),
                ], 'or')
            ], 'and'),
        );


        $fields['link_options']['fields']['custom_url'] = [
            'label'       => __('Custom URL', 'notificationx-pro'),
            'name'        => "custom_url",
            'type'        => 'text',
            'priority'    => 20,
            'default'     => '',
            'description' => __('Enter a link starts with http:// or https:// , it apply for all notification', 'notificationx-pro'),
            'rules'       => Rules::is('link_type', 'custom'),
        ];

        return $fields;
    }

    /**
     * Undocumented function
     *
     * @param array $options
     * @return array
     */
    public function display_fields($fields) {

        $all_locations = &$fields['visibility']['fields']['all_locations'];
        unset($fields['visibility']['fields']['show_on_display']['help']);

        $locations_key = Locations::get_instance()->get_locations(false);
        $all_locations['options'] = GlobalFieldsFree::get_instance()->normalize_fields($locations_key);
        $all_locations['options']['is_custom'] = [
            'label' => __('Custom Post or Page IDs', 'notificationx-pro'),
            'value' => 'is_custom',
        ];

        $fields['visibility']['fields']['custom_ids'] =  array(
            'label'       => __('IDs ( Posts or Pages )', 'notificationx-pro'),
            'name'      => 'custom_ids',
            'type'        => 'text',
            'priority'    => 13,
            'description' => __('Comma separated ID of post, page or custom post type posts', 'notificationx-pro'),
            'rules' => Rules::logicalRule([
                Rules::includes( 'show_on', [
                    'on_selected',
                    'hide_on_selected',
                ]),
                Rules::includes( 'all_locations', 'is_custom' ),
            ]),
        );

        return $fields;
    }

    /**
     * Undocumented function
     *
     * @param array $options
     * @return array
     */
    public function design_fields($fields) {
        $_fields = &$fields['advance_design_section']['fields'];
        $image_appearance = &$_fields['image-appearance']['fields'];
        $image_appearance["image_shape"]['options']['custom'] = [
            'label' => __('Custom', 'notificationx-pro'),
            'value' => 'custom',
        ];
        $image_appearance["custom_image_shape"] = [
            'label'   => __('Custom Radius', 'notificationx-pro'),
            'name'    => "custom_image_shape",
            'type'    => "text",
            'priority' => 7,
            'rules'   => Rules::is('image_shape', 'custom'),
        ];
        return $fields;
    }

    /**
     * Undocumented function
     *
     * @param array $options
     * @return array
     */
    public function customize_fields($fields) {

        return $fields;
    }

    /**
     * Undocumented function
     *
     * @param array $options
     * @return array
     */
    public function custom_url($url, $post) {
        if( !empty($post['link_type']) && $post['link_type'] === 'custom' ) {
            $url = $post['custom_url'];
        }
        return $url;
    }

    /**
     * Callback for 'nx_text_trim_length' filter
     * @param int $trim_length
     * @param stdClass $settings
     * @return int
     * @since 1.1.4
     */
    public function set_content_trim_length( $trim_length, $settings ) {
        if( ! empty( $settings['content_trim_length'] ) ) {
            $trim_length = $settings['content_trim_length'];
        }
        return $trim_length;
    }

    public function random_order($entries, $settings){
        if(!empty($settings['random_order'])){
            shuffle($entries);
        }
        return array_values($entries);
    }
}
