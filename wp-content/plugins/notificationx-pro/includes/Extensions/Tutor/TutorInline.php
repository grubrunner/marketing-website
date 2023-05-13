<?php

/**
 * Tutor Extension
 *
 * @package NotificationX\Extensions
 */

namespace NotificationXPro\Extensions\Tutor;

use NotificationX\Core\Inline;
use NotificationX\Extensions\GlobalFields;
use NotificationX\Extensions\Tutor\TutorInline as TutorInlineFree;

/**
 * Tutor Extension
 */
class TutorInline extends TutorInlineFree {


    /**
     * Initially Invoked when initialized.
     */
    public function __construct() {
        if ( ! class_exists( 'NotificationX\Core\Inline' ) ) {
            return;
        }

        parent::__construct();
        add_filter( 'nx_inline_hook_options', array( $this, 'inline_hook_options' ), 10 );
        add_filter( 'tutor/course/single/entry-box/free', array( $this, 'single_entry_box' ), 10, 2 );
        add_action( 'tutor_course/loop/after_title', array( $this, 'tutor_course_hooks' ), 10, 2 );
    }

    /**
     * Adds option to Link Type field in Content tab.
     *
     * @param array $options
     * @return array
     */
    public function inline_hook_options( $_options ) {
        $options = [
            'tutor_course/loop/after_title'      => __( 'Archive Page', 'notificationx-pro' ),
            'tutor/course/single/entry-box/free' => __( 'Single Page', 'notificationx-pro' ),
        ];
        $_options = GlobalFields::get_instance()->normalize_fields( $options, 'source', $this->id, $_options );
        return $_options;
    }

    /**
     * This method is responsible for output the shortcode.
     */
    public function tutor_course_hooks($return = false) {
        do_action( 'nx_ignore_analytics' );
        $result         = Inline::get_instance()->get_notifications_data( $this->id );
        $current_action = current_action();
        $output         = '';
        $download_id    = get_the_ID();
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
                if($return){
                    return $output;
                }
                echo $output;
            }
        }
    }

    public function single_entry_box($return, $id){
        $return .= $this->tutor_course_hooks(true);
        return $return;
    }
}
