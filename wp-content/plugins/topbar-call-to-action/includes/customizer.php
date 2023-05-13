<?php
/**
 * Customizer Controls
 *
 * @package TopBar Call To Action
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function st_topbar_cta_customize_register( $wp_customize ) {

    // Load custom control functions.
    require ST_TOPBAR_CTA_BASE_PATH . '/includes/controls.php';

    // Add panel for common Home Page Settings
    $wp_customize->add_panel( 'st_topbar_cta_panel' , array(
        'title'      => esc_html__( 'TopBar Call To Action','st-topbar-cta' ),
        'description'=> esc_html__( 'Topbar call to action setting options.', 'st-topbar-cta' ),
        'priority'   => 10,
    ) );


    // upsell setting and control.
    $wp_customize->add_setting( 'st_topbar_cta_upsell', array() );

    $wp_customize->add_control( new ST_Topbar_Cta_Upsell( $wp_customize, 'st_topbar_cta_upsell', array(
        'label'             => esc_html__( 'Topbar Call To Action Pro', 'st-topbar-cta' ),
        'section'           => 'st_topbar_cta_general_section',
        'url'      => 'https://sharkthemes.com/downloads/topbar-call-to-action-pro/',
    ) ) );



    /********************************
                GENERAL 
    *********************************/

    // Add details section
    $wp_customize->add_section( 'st_topbar_cta_general_section', array(
        'title'             => esc_html__( 'General','st-topbar-cta' ),
        'description'       => esc_html__( 'General Setting Options', 'st-topbar-cta' ),
        'panel'             => 'st_topbar_cta_panel',
    ) );

    // enable setting and control.
    $wp_customize->add_setting( 'enable_st_topbar_cta', array(
        'default'           => false,
        'sanitize_callback' => 'st_topbar_cta_sanitize_switch',
    ) );

    $wp_customize->add_control( new ST_Topbar_Cta_Switch_Control( $wp_customize, 'enable_st_topbar_cta', array(
        'label'             => esc_html__( 'Enable Topbar Call To Action', 'st-topbar-cta' ),
        'section'           => 'st_topbar_cta_general_section',
        'on_off_label'      => st_topbar_cta_show_options(),
    ) ) );

    // dismissible setting and control.
    $wp_customize->add_setting( 'enable_st_topbar_cta_dismiss', array(
        'default'           => true,
        'sanitize_callback' => 'st_topbar_cta_sanitize_switch',
    ) );

    $wp_customize->add_control( new ST_Topbar_Cta_Switch_Control( $wp_customize, 'enable_st_topbar_cta_dismiss', array(
        'label'             => esc_html__( 'Dismissible', 'st-topbar-cta' ),
        'section'           => 'st_topbar_cta_general_section',
        'on_off_label'      => st_topbar_cta_show_options(),
    ) ) );

    // text control and setting
    $wp_customize->add_setting( 'st_topbar_cta_text', array(
        'sanitize_callback' => 'st_topbar_cta_santize_allow_tags',
    ) );

    $wp_customize->add_control( 'st_topbar_cta_text', array(
        'label'             => esc_html__( 'Message', 'st-topbar-cta' ),
        'description'       => esc_html__( 'Note: To highlight the portion of text, wrap the text with span tag. ie: <span>Highlighted Text</span>', 'st-topbar-cta' ),
        'section'           => 'st_topbar_cta_general_section',
        'type'              => 'textarea',
    ) );

    // enable setting and control.
    $wp_customize->add_setting( 'enable_st_topbar_cta_btn', array(
        'default'           => true,
        'sanitize_callback' => 'st_topbar_cta_sanitize_switch',
    ) );

    $wp_customize->add_control( new ST_Topbar_Cta_Switch_Control( $wp_customize, 'enable_st_topbar_cta_btn', array(
        'label'             => esc_html__( 'Enable Button', 'st-topbar-cta' ),
        'section'           => 'st_topbar_cta_general_section',
        'on_off_label'      => st_topbar_cta_show_options(),
    ) ) );

    // text align control and setting
    $wp_customize->add_setting( 'enable_st_topbar_cta_btn_position', array(
        'default'           => 'right-btn',
        'sanitize_callback' => 'st_topbar_cta_sanitize_select',
    ) );

    $wp_customize->add_control( 'enable_st_topbar_cta_btn_position', array(
        'label'             => esc_html__( 'Button Position', 'st-topbar-cta' ),
        'section'           => 'st_topbar_cta_general_section',
        'type'              => 'select',
        'choices'           => array( 
            'left-btn'    => esc_html__( 'Left Side', 'st-topbar-cta' ),
            'right-btn'   => esc_html__( 'Right Side', 'st-topbar-cta' ),
        ),
    ) );

    // btn label control and setting
    $wp_customize->add_setting( 'st_topbar_cta_btn_label', array(
        'default'           => esc_html__( 'View Details', 'st-topbar-cta' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'st_topbar_cta_btn_label', array(
        'label'             => esc_html__( 'Button Label', 'st-topbar-cta' ),
        'section'           => 'st_topbar_cta_general_section',
        'type'              => 'text',
    ) );

    // btn url control and setting
    $wp_customize->add_setting( 'st_topbar_cta_btn_url', array(
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'st_topbar_cta_btn_url', array(
        'label'             => esc_html__( 'Button URL', 'st-topbar-cta' ),
        'section'           => 'st_topbar_cta_general_section',
        'type'              => 'url',
    ) );


    /********************************
                STYLING 
    *********************************/

    // Add details section
    $wp_customize->add_section( 'st_topbar_cta_styling_section', array(
        'title'             => esc_html__( 'Styling','st-topbar-cta' ),
        'description'       => esc_html__( 'Styling Setting Options', 'st-topbar-cta' ),
        'panel'             => 'st_topbar_cta_panel',
    ) );

    // background color control and setting
    $wp_customize->add_setting( 'st_topbar_cta_background_color', array(
        'default'           => '#2585ba',
        'sanitize_callback' => 'sanitize_hex_color', // The hue is stored as a positive integer.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'st_topbar_cta_background_color', array(
        'label'    => esc_html__( 'Background Color', 'st-topbar-cta' ),
        'section'  => 'st_topbar_cta_styling_section',
    ) ) );

    // text color control and setting
    $wp_customize->add_setting( 'st_topbar_cta_text_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color', // The hue is stored as a positive integer.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'st_topbar_cta_text_color', array(
        'label'    => esc_html__( 'Message Text Color', 'st-topbar-cta' ),
        'section'  => 'st_topbar_cta_styling_section',
    ) ) );

    // btn background color control and setting
    $wp_customize->add_setting( 'st_topbar_cta_btn_background_color', array(
        'default'           => '#224c63',
        'sanitize_callback' => 'sanitize_hex_color', // The hue is stored as a positive integer.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'st_topbar_cta_btn_background_color', array(
        'label'    => esc_html__( 'Button Background Color', 'st-topbar-cta' ),
        'section'  => 'st_topbar_cta_styling_section',
    ) ) );

    // btn text color control and setting
    $wp_customize->add_setting( 'st_topbar_cta_btn_text_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color', // The hue is stored as a positive integer.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'st_topbar_cta_btn_text_color', array(
        'label'    => esc_html__( 'Button Text Color', 'st-topbar-cta' ),
        'section'  => 'st_topbar_cta_styling_section',
    ) ) );

    // btn hover background color control and setting
    $wp_customize->add_setting( 'st_topbar_cta_btn_hover_background_color', array(
        'default'           => '#171d23',
        'sanitize_callback' => 'sanitize_hex_color', // The hue is stored as a positive integer.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'st_topbar_cta_btn_hover_background_color', array(
        'label'    => esc_html__( 'Button Hover Background Color', 'st-topbar-cta' ),
        'section'  => 'st_topbar_cta_styling_section',
    ) ) );

    // btn hover text color control and setting
    $wp_customize->add_setting( 'st_topbar_cta_btn_hover_text_color', array(
        'default'           => '#fff',
        'sanitize_callback' => 'sanitize_hex_color', // The hue is stored as a positive integer.
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'st_topbar_cta_btn_hover_text_color', array(
        'label'    => esc_html__( 'Button Hover Text Color', 'st-topbar-cta' ),
        'section'  => 'st_topbar_cta_styling_section',
    ) ) );

}
add_action( 'customize_register', 'st_topbar_cta_customize_register' );


/******************************
        Sanitization
*******************************/

if ( ! function_exists( 'st_topbar_cta_sanitize_switch' ) ) :
    /**
     * Sanitize data from custom Switch Control.
     * @param  string $input 
     * @return boolean    
     */
    function st_topbar_cta_sanitize_switch( $input ) {
        $input = sanitize_text_field( $input );
        return ( in_array( $input, array( 'false', NULL ) ) ) ? false : true;
    }
endif;

if ( ! function_exists( 'st_topbar_cta_sanitize_select' ) ) :
    /**
     * Sanitize select, radio.
     *
     * @param mixed                $input The value to sanitize.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return mixed Sanitized value.
     */
    function st_topbar_cta_sanitize_select( $input, $setting ) {
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
endif;

if ( ! function_exists( 'st_topbar_cta_santize_allow_tags' ) ) :
    /**
     * Text field with allowed tags
     *
     * @param string  $input  
     * @param WP_Customize_Setting $setting Setting instance.
     * @return string The input with only allowed tag i.e. anchor
     */
    function st_topbar_cta_santize_allow_tags( $input ) {
        $input = wp_kses( $input, array(
            'span' => array(),
            ) );

        return $input;
    }
endif;

/******************************
            Options
*******************************/

if ( ! function_exists( 'st_topbar_cta_show_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function st_topbar_cta_show_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'st-topbar-cta' ),
            'off'       => esc_html__( 'No', 'st-topbar-cta' )
        );
        return apply_filters( 'st_topbar_cta_show_options', $arr );
    }
endif;


/**
 * Load dynamic logic for the customizer controls area.
 */
function st_topbar_cta_customize_control_js() {

    wp_enqueue_style( 'st-topbar-cta-customizer-style', ST_TOPBAR_CTA_URL_PATH . 'assets/css/customizer.min.css' );
    wp_enqueue_script( 'st-topbar-cta-customizer-controls', ST_TOPBAR_CTA_URL_PATH . 'assets/js/customizer.min.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'st_topbar_cta_customize_control_js' );
