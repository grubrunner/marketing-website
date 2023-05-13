<?php
/**
 * EDD Extension
 *
 * @package NotificationX\Extensions
 */

namespace NotificationXPro\Extensions\LearnDash;

use NotificationX\Extensions\LearnDash\LearnDashInline as LearnDashInlineFree;
use NotificationX\Extensions\GlobalFields;
use NotificationX\Types\Conversions;
use NotificationX\Core\Inline;
use NotificationXPro\Types\ELearning;

/**
 * EDD Extension
 * @todo normalize data for frontend.
 * @todo show_purchaseof && excludes_product
 */
class LearnDashInline extends LearnDashInlineFree {

    use _LearnDash;

    /**
     * __construct__ is for revoke first time to get ready
     *
     * @return void
     */
    public function __construct() {
        if ( ! class_exists( 'NotificationX\Core\Inline' ) ) {
            return;
        }
        add_filter( 'nx_inline_hook_options', array( $this, 'inline_hook_options' ), 10 );
        add_filter( 'learndash_content', array( $this, 'learndash_content' ), 10, 2 );

        parent::__construct();
    }

    public function public_actions(){
        parent::public_actions();

        add_filter("nx_can_entry_{$this->id}", array(ELearning::get_instance(), 'show_purchase_of'), 11, 3);
        add_action( 'learndash_update_course_access', [ $this, 'save_new_enrollment' ], 10, 2 );
    }


    /**
     * Adds option to Link Type field in Content tab.
     *
     * @param array $options
     * @return array
     */
    public function inline_hook_options( $_options ) {
        $options = [
            // 'learndash_archive' => __( 'Archive Page', 'notificationx-pro' ),
            'learndash_content'  => __( 'Single Course Page', 'notificationx-pro' ),
        ];
        $_options = GlobalFields::get_instance()->normalize_fields( $options, 'source', $this->id, $_options );
        return $_options;
    }



    /**
     * This method is responsible for output the shortcode.
     */
    public function learndash_content($content, $post) {
        do_action( 'nx_ignore_analytics' );
        $result         = Inline::get_instance()->get_notifications_data( $this->id );
        $current_action = current_action();
        $output         = '';
        $download_id    = $post->ID;
        $debug_backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 4);
        if ( ! empty( $result['shortcode'] ) && isset($debug_backtrace[3]['class'], $debug_backtrace[3]['function']) && 'SFWD_CPT_Instance' === $debug_backtrace[3]['class'] && 'template_content' === $debug_backtrace[3]['function'] ) {
            // echo '<pre>';print_r($debug_backtrace);echo '</pre>';
            foreach ( $result['shortcode'] as $key => $value ) {
                $entries  = $value['entries'];
                $entries  = array_values( $entries );
                $settings = $value['post'];
                if ( empty( $settings['inline_location'] ) || ! in_array( $current_action, $settings['inline_location'] ) ) {
                    continue;
                }

                $template = Inline::get_instance()->get_template( $settings );
                foreach ( $entries as $key => $entry ) {
                    if ( empty( $entry['id'] ) || $entry['id'] != $download_id ) {
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
            }
        }
        return $output . $content;
    }

}
