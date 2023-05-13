<?php
/**
 * EDD Extension
 *
 * @package NotificationX\Extensions
 */

namespace NotificationXPro\Extensions\EDD;

use NotificationX\Extensions\EDD\EDDInline as EDDInlineFree;
use NotificationX\Extensions\GlobalFields;
use NotificationX\Types\Conversions;
use NotificationX\Core\Inline;

/**
 * EDD Extension
 * @todo normalize data for frontend.
 * @todo show_purchaseof && excludes_product
 */
class EDDInline extends EDDInlineFree {

    use _EDD;

    /**
     * __construct__ is for revoke first time to get ready
     *
     * @return void
     */
    public function __construct() {
        if ( ! class_exists( 'NotificationX\Core\Inline' ) ) {
            return;
        }

        parent::__construct();
        add_action( 'edd_purchase_link_top', array( $this, 'edd_purchase_link_top' ), 10, 2 );
        add_filter( 'nx_inline_hook_options', array( $this, 'inline_hook_options' ), 10 );
    }

    public function init_fields(){
        parent::init_fields();
        add_filter('nx_conversion_product_list', [$this, 'products']);
        add_filter('nx_conversion_category_list', [$this, 'categories']);

    }

    /**
     * This functions is hooked
     *
     * @return void
     */
    public function admin_actions() {
        parent::admin_actions();
        add_filter( "nx_can_entry_{$this->id}", array( Conversions::get_instance(), 'nx_can_entry' ), 10, 3 );
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function public_actions() {
        parent::public_actions();
        // @todo deprecated remove in the future.
        add_filter( "nx_filtered_data_{$this->id}", array( Conversions::get_instance(), 'show_exclude_product' ), 11, 2 );
    }

    /**
     * Adds option to Link Type field in Content tab.
     *
     * @param array $options
     * @return array
     */
    public function inline_hook_options( $_options ) {
        $options = [
            'edd_archive' => __( 'Archive Page', 'notificationx-pro' ),
            'edd_single'  => __( 'Single Page', 'notificationx-pro' ),
        ];
        $_options = GlobalFields::get_instance()->normalize_fields( $options, 'source', $this->id, $_options );
        return $_options;
    }


    /**
     * This method is responsible for output the shortcode.
     */
    public function edd_purchase_link_top( $download_id, $args ) {
        $result         = Inline::get_instance()->get_notifications_data( $this->id );
        $current_action = is_archive() ? 'edd_archive' : 'edd_single';
        $output         = '';
        if ( ! empty( $result['shortcode'] ) ) {
            foreach ( $result['shortcode'] as $key => $value ) {
                $entries  = $value['entries'];
                $entries  = array_values( $entries );
                $settings = $value['post'];
                if ( empty( $settings['inline_location'] ) || ! in_array( $current_action, $settings['inline_location'] ) ) {
                    continue;
                }

                $template = Inline::get_instance()->get_template( $settings );
                foreach ( $entries as $key => $entry ) {
                    if ( empty( $entry['product_id'] ) || $entry['product_id'] != $download_id ) {
                        continue;
                    }
                    $_template = $template;
                    foreach ( $entry as $key => $val ) {
                        if ( ! is_array( $val ) ) {
                            $_template = str_replace( "{{{$key}}}", $val, $_template );
                        }
                    }
                    $output .= "<div style='margin-bottom: 1rem'>$_template</div>";
                    break;
                }
            }

            // $this->shortcode_nx_ids[] = $atts['id'];
            if(!empty($output)){
                $output = "
                <style>
                .notificationx-woo-shortcode-inline-wrapper p {
                    margin-bottom: 0;
                }
                </style>
                <div id='notificationx-woo-shortcode-inline-{$download_id}' class='notificationx-woo-shortcode-inline-wrapper'>$output</div>";
                echo $output;
            }
        }
    }
}
