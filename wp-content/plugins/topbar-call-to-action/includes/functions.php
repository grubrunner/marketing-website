<?php
/**
 * Render Functions
 *
 * @package TopBar Call To Action
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function st_topbar_cta_class( $atts = array() ) {
    $class = ( array ) $atts;
    $class = array_map( 'esc_attr', $class);
    $class = implode( ' ', $class );
    return $class;
}
add_filter( 'st_topbar_cta_class_filter', 'st_topbar_cta_class', 10 );

function st_topbar_cta_main_class_render() {
    $atts = array();

    // dismissible
    if ( get_theme_mod( 'enable_st_topbar_cta_dismiss', true ) ) {
        $atts[] = 'st-topbar-cta-dismissible';
    }

    // position 
    $atts[] = 'top';

    // alignment
    $atts[] = 'center-align';

    // btn alignment
    $atts[] = get_theme_mod( 'enable_st_topbar_cta_btn_position', 'right-btn' );

    return apply_filters( 'st_topbar_cta_class_filter', $atts );

}


if ( ! function_exists( 'st_topbar_cta_render' ) ) {
    /**
     * Render topbar call to action
     */
    function st_topbar_cta_render() {
        $message = get_theme_mod( 'st_topbar_cta_text', '' );
        $btn_label = get_theme_mod( 'st_topbar_cta_btn_label', esc_html__( 'View Details', 'st-topbar-cta' ) );
        $btn_url = get_theme_mod( 'st_topbar_cta_btn_url', '#' );
        $background_image = get_theme_mod( 'st_topbar_cta_background_image', '' );

        if ( empty( $message ) || ! get_theme_mod( 'enable_st_topbar_cta', false ) ) {
            return;
        } ?>

        <div id="st-topbar-cta" class="<?php echo st_topbar_cta_main_class_render(); ?>" >
            <div class="wrapper">

                <div class="st-topbar-cta-message">
                    <p><?php echo st_topbar_cta_santize_allow_tags( $message ); ?></p>
                </div><!-- .st-topbar-cta-message -->

                <?php if ( get_theme_mod( 'enable_st_topbar_cta_btn', true ) ) : ?>
                    <div class="st-topbar-cta-btn right-btn">
                        <a class="btn" href="<?php echo esc_url( $btn_url ); ?>"><?php echo esc_html( $btn_label ); ?></a>
                    </div><!-- .right-btn -->
                <?php endif; ?>
            </div><!-- .wrapper -->

            <?php if ( get_theme_mod( 'enable_st_topbar_cta_dismiss', true ) ) : ?>
                <div class="st-topbar-cta-collapse">
                    <svg id="icon-close" viewBox="0 0 47.971 47.971" width="12px" height="12px">
                        <path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88
                        c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242
                        C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879
                        s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z"/>
                    </svg>
                </div><!-- .st-topbar-cta-collapse -->
            <?php endif; ?>


        </div><!-- #st-topbar-cta -->

        <div class="st-topbar-cta-collapse-open <?php echo ( 'top' == get_theme_mod( 'enable_st_topbar_cta_position', 'top' ) ) ? 'top' : 'bottom'; ?>">
            <svg id="icon-double-arrow" viewBox="0 0 284.929 284.929" width="12px" height="12px">
                <path d="M135.899,167.877c1.902,1.902,4.093,2.851,6.567,2.851s4.661-0.948,6.562-2.851L282.082,34.829
                c1.902-1.903,2.847-4.093,2.847-6.567s-0.951-4.665-2.847-6.567L267.808,7.417c-1.902-1.903-4.093-2.853-6.57-2.853
                c-2.471,0-4.661,0.95-6.563,2.853L142.466,119.622L30.262,7.417c-1.903-1.903-4.093-2.853-6.567-2.853
                c-2.475,0-4.665,0.95-6.567,2.853L2.856,21.695C0.95,23.597,0,25.784,0,28.262c0,2.478,0.953,4.665,2.856,6.567L135.899,167.877z"
                />
                <path d="M267.808,117.053c-1.902-1.903-4.093-2.853-6.57-2.853c-2.471,0-4.661,0.95-6.563,2.853L142.466,229.257L30.262,117.05
                c-1.903-1.903-4.093-2.853-6.567-2.853c-2.475,0-4.665,0.95-6.567,2.853L2.856,131.327C0.95,133.23,0,135.42,0,137.893
                c0,2.474,0.953,4.665,2.856,6.57l133.043,133.046c1.902,1.903,4.093,2.854,6.567,2.854s4.661-0.951,6.562-2.854l133.054-133.046
                c1.902-1.903,2.847-4.093,2.847-6.565c0-2.474-0.951-4.661-2.847-6.567L267.808,117.053z"/>
            </svg>
        </div><!-- .st-topbar-cta-collapse-open -->

    <?php }
}

add_action( 'wp_body_open', 'st_topbar_cta_render', 10 );


if ( ! function_exists( 'st_topbar_cta_custom_style' ) ) :
    /**
     * custom css enqueue
     */
    function st_topbar_cta_custom_style() {
        $css = '';

        // background color
        $css .= '#st-topbar-cta, div.st-topbar-cta-collapse-open { 
            background-color: ' . esc_attr( get_theme_mod( 'st_topbar_cta_background_color', '#2585ba' ) ) . 
        '; }';

        // padding
        $css .= '#st-topbar-cta { 
            padding: 7px 0; }';


        // message text color
        $css .= '#st-topbar-cta .st-topbar-cta-message p { 
            font-size: 14px; 
            color: ' . esc_attr( get_theme_mod( 'st_topbar_cta_text_color', '#fff' ) ) . 
        '; }';

        // message text span
        $css .= '#st-topbar-cta .st-topbar-cta-message p span { 
            border-bottom: 1px solid' . esc_attr( get_theme_mod( 'st_topbar_cta_text_color', '#fff' ) ) . 
        '; }';

        // svg color
        $css .= 'div#st-topbar-cta .st-topbar-cta-collapse svg, div.st-topbar-cta-collapse-open svg { 
            fill: ' . esc_attr( get_theme_mod( 'st_topbar_cta_text_color', '#fff' ) ) . 
        '; }';

        // btn background
        $css .= '#st-topbar-cta .st-topbar-cta-btn a.btn { 
            background-color: ' . esc_attr( get_theme_mod( 'st_topbar_cta_btn_background_color', '#224c63' ) ) . 
        '; }';

        // btn text color
        $css .= '#st-topbar-cta .st-topbar-cta-btn a.btn { 
            color: ' . esc_attr( get_theme_mod( 'st_topbar_cta_btn_text_color', '#fff' ) ) . 
        '; }';

        // btn hover background
        $css .= '#st-topbar-cta .st-topbar-cta-btn a.btn:hover, #st-topbar-cta .st-topbar-cta-btn a.btn:focus  { 
            background-color: ' . esc_attr( get_theme_mod( 'st_topbar_cta_btn_hover_background_color', '#171d23' ) ) . 
        '; }';

        // btn hover color
        $css .= '#st-topbar-cta .st-topbar-cta-btn a.btn:hover, #st-topbar-cta .st-topbar-cta-btn a.btn:focus  { 
            color: ' . esc_attr( get_theme_mod( 'st_topbar_cta_btn_hover_text_color', '#fff' ) ) . 
        '; }';

        // btn text padding vertical and horizontal
        $css .= '#st-topbar-cta .st-topbar-cta-btn a.btn { 
            border-radius: 3px;
            padding: 5px 15px ; }';

        // btn text size
        $css .= '#st-topbar-cta .st-topbar-cta-btn a.btn { 
            font-size: 14px; }';

        wp_add_inline_style( 'st-topbar-cta-style', $css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'st_topbar_cta_custom_style', 10 );