<?php

/**
 * WooCommerce Extension
 *
 * @package NotificationX\Extensions
 */

namespace NotificationXPro\Extensions\WooCommerce;

use NotificationX\Core\Analytics;
use NotificationX\Core\PostType;
use NotificationX\Core\Rules;
use NotificationX\Extensions\WooCommerce\WooInline as WooInlineFree;
use NotificationX\Extensions\GlobalFields;
use NotificationX\Core\Inline;
use NotificationXPro\Types\Conversions;

/**
 * WooCommerce Extension Class
 */
class WooInline extends WooInlineFree {
    protected $hooks              = array();

    /**
     * Initially Invoked when initialized.
     */
    public function __construct() {
        if ( ! class_exists( 'NotificationX\Core\Inline' ) ) {
            return;
        }

        $this->hooks = array(
            'woocommerce_before_add_to_cart_form'    => [
                'priority' => 22,
                'label'    => __( 'Single Product Page', 'notificationx-pro' ),
            ],
            'woocommerce_after_shop_loop_item_title' => [
                'priority' => 22,
                'label'    => __( 'Shop Archive Page - After Product Title', 'notificationx-pro' ),
            ],
            'woocommerce_after_shop_loop_item'       => [
                'priority' => 22,
                'label'    => __( 'Shop Archive Page - After Product Container', 'notificationx-pro' ),
            ],
            'woocommerce_after_cart_item_name'       => [
                'priority' => 22,
                'label'    => __( 'Shop Cart Page', 'notificationx-pro' ),
            ],
        );
        foreach ( $this->hooks as $hook => $args ) {
            add_action( $hook, array( $this, 'before_add_to_cart_form' ), $args['priority'] );
        }
        add_filter( 'nx_inline_hook_options', array( $this, 'inline_hook_options' ), 10 );
        add_filter( "nx_can_entry_{$this->id}", array( $this, 'nx_can_entry' ), 10, 3 );
        add_filter( 'nx_filtered_notice', array( $this, 'nx_filtered_notice' ), 10, 2 );
        add_filter( 'nx_content_fields', array( $this, 'content_fields' ) );

        /*
        add_action( 'woocommerce_after_cart_item_name', function($cart_item){
            print_r( $cart_item );
            echo "<p>dfsdfsdfsdf df sdfds d sfsdf</p>";
        });
        */
        parent::__construct();
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
        $options = [];
        foreach ( $this->hooks as $key => $value ) {
            $options[ $key ] = $value['label'];
        }
        $_options = GlobalFields::get_instance()->normalize_fields( $options, 'source', $this->id, $_options );
        return $_options;
    }

    /**
     * This method is responsible for output the shortcode.
     */
    public function before_add_to_cart_form( $cart_item = null ) {
        // @var $product WC_Product_Simple
        global $product;
        if ( ! empty( $cart_item['product_id'] ) ) {
            $product_id = $cart_item['product_id'];
        } elseif ( ! empty( $product ) ) {
            $product_id = $product->get_id();
        }

        $current_action = current_action();
        if ( empty( $product_id ) || ! array_key_exists( $current_action, $this->hooks ) ) {
            return;
        }


        do_action( 'nx_ignore_analytics' );
        $result = Inline::get_instance()->get_notifications_data( $this->id );

        $output = '';
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
                    if ( ! $this->is_stock_theme( $settings['themes'] ) && ( empty( $entry['product_id'] ) || $entry['product_id'] != $product_id ) ) {
                        continue;
                    }
                    if ( isset( $entry['stock_count'] ) && $this->is_stock_theme( $settings['themes'] ) ) {
                        $max_stock = ! empty( $settings['max_stock'] ) ? $settings['max_stock'] : 10;
                        $_product = wc_get_product( $product_id );
                        $product_arr = [ 'product_id' => $product_id ];
                        if (
                            $_product &&
                            $_product->get_stock_quantity() &&
                            $_product->get_stock_quantity() <= $max_stock &&
                            Conversions::get_instance()->_excludes_product( $product_arr, $settings ) &&
                            Conversions::get_instance()->_show_purchaseof( $product_arr, $settings )
                        ) {
                            $entry['stock_count'] = $_product->get_stock_quantity();
                        } else {
                            break;
                        }
                    }

                    // Analytics::get_instance()->insert_analytics( $settings['nx_id'], 'views' );
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
                <div id='notificationx-woo-shortcode-inline-{$product_id}' class='notificationx-woo-shortcode-inline-wrapper'>$output</div>";
                echo $output;
            }
        }
    }

    public function is_stock_theme( $theme ) {
        $themes = [ 'woo_inline_stock-theme-one', 'woo_inline_stock-theme-two' ];
        if ( in_array( $theme, $themes, true ) ) {
            return true;
        }
        return false;
    }

    public function nx_can_entry( $result, $entry, $settings ) {
        if ( $this->is_stock_theme( $settings['themes'] ) ) {
            return false;
        }
        return $result;
    }
    public function nx_filtered_notice( $result, $params ) {
        if ( ! empty( $params['shortcode'] ) && is_array( $params['shortcode'] ) ) {
            foreach ( $params['shortcode'] as $key => $nx_id ) {
                if ( ! array_key_exists( $nx_id, $result['shortcode'] ) ) {
                    $settings = PostType::get_instance()->get_post( $nx_id );
                    if ( $settings && $this->is_stock_theme( $settings['themes'] ) ) {
                        $result['shortcode'][ $nx_id ]['post']    = $settings;
                        $result['shortcode'][ $nx_id ]['entries'] = [
                            [
                                'stock_count'   => 0,
                                'left_in_stock' => __( 'left in stock', 'notificationx-pro' ),
                                'left'          => __( 'left', 'notificationx-pro' ),
                                'order_soon'    => __( '- order soon.', 'notificationx-pro' ),
                                'on_our_site'   => __( 'on our site!', 'notificationx-pro' ),
                            ],
                        ];
                    }
                }
            }
        }
        return $result;
    }
    public function content_fields( $fields ) {
        $content_fields = &$fields['content']['fields'];

        $content_fields['max_stock'] = array(
            'type'     => 'number',
            'name'     => 'max_stock',
            'label'    => __( 'Low Stock Threshold', 'notificationx-pro' ),
            'priority' => 290,
            'default'  => 10,
            'help'     => __( 'The notice will appear when the product stock reaches this amount. By default the limit is 10.', 'notificationx-pro' ),
            'rules'    => Rules::logicalRule([
                Rules::is( 'source', $this->id ),
                Rules::includes( 'themes', [ 'woo_inline_stock-theme-one', 'woo_inline_stock-theme-two' ] ),
            ]),
        );

        return $fields;
    }
}
