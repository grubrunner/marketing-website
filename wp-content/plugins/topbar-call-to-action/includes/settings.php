<?php
/**
 * TopBar Call To Action Setting Page
 *
 * @package TopBar Call To Action
 * @since 0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class ST_Topbar_Cta_Setting_Page
{

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'st_topbar_cta_add_plugin_page' ) );
    }

    /**
     * Add options page
     */
    public function st_topbar_cta_add_plugin_page()
    {

        //create new top-level menu
        add_menu_page(
            esc_html__( 'TopBar Call To Action', 'st-topbar-cta' ), 
            esc_html__( 'TopBar CTA', 'st-topbar-cta' ), 
            'administrator', 
            __FILE__, 
            array( $this, 'st_topbar_cta_create_admin_page' ), 
            'dashicons-plugins-checked'
        );
    }

    /**
     * Options page callback
     */
    public function st_topbar_cta_create_admin_page()
    {
        // Link to topbar cta:
        $query['autofocus[panel]'] = 'st_topbar_cta_panel';
        $panel_link = add_query_arg( $query, admin_url( 'customize.php' ) );
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'TopBar Call To Action', 'st-topbar-cta' ); ?></h1>

            <div class="img-wrap">
                <p>
                    <a class="button button-primary button-hero" href="<?php echo esc_url( $panel_link ); ?>"><?php esc_html_e( 'Customize TopBar Call To Action', 'st-topbar-cta' ); ?></a>
                    <a class="button button-primary button-hero" href="https://sharkthemes.com/downloads/topbar-call-to-action/"><?php esc_html_e( 'Documentation', 'st-topbar-cta' ); ?></a>
                    <a class="button button-primary button-hero" href="https://sharkthemes.com/downloads/topbar-call-to-action-pro/"><?php esc_html_e( 'Buy Pro', 'st-topbar-cta' ); ?></a>
                </p>                    
                <img src="<?php echo esc_url( ST_TOPBAR_CTA_URL_PATH . 'assets/uploads/banner.png' ); ?>" width="100%" alt="<?php esc_attr_e( 'topbar call to action', 'st-topbar-cta' ); ?>">

            </div>

        </div>
    <?php
    }

}

if( is_admin() )
    new ST_Topbar_Cta_Setting_Page();
