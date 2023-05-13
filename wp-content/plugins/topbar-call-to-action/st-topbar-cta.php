<?php
/**
 * Plugin Name: TopBar Call To Action
 * Plugin URI: https://www.sharkthemes.com/downloads/topbar-call-to-action
 * Description: TopBar Call To Action provides you option to add clean and elegant topbar notification or call to action section in your website. This plugin adds beauty to your website as well as it plays a very important role to upsell your products or services to a huge extent. This plugin uses customizer api to edit or customize. It is very easy to use and easy to setup. 
 * Version: 1.1.2
 * Author: Shark Themes
 * Author URI: https://sharkthemes.com
 * Requires at least: 5.0
 * Tested up to: 6.0
 *
 * Text Domain: st-topbar-cta
 * Domain Path: /languages/
 *
 * @package TopBar Call To Action
 * @category Core
 * @author Shark Themes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'ST_Topbar_Cta' ) ) :

	final class ST_Topbar_Cta {

		public function __construct()
		{
			$this->st_topbar_cta_constant();
			$this->st_topbar_cta_hooks();
			$this->st_topbar_cta_includes();
		}

		private function st_topbar_cta_constant()
		{
			define( 'ST_TOPBAR_CTA_BASE_PATH', dirname(__FILE__ ) );
			define( 'ST_TOPBAR_CTA_URL_PATH', plugin_dir_url(__FILE__ ) );
			define( 'ST_TOPBAR_CTA_PLUGIN_BASE_PATH', plugin_basename(__FILE__) );
		}

		public function st_topbar_cta_hooks()
		{
			// enqueue admin scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'st_topbar_cta_enqueue' ) );

			add_filter( 'plugin_action_links_' .  ST_TOPBAR_CTA_PLUGIN_BASE_PATH, array( $this, 'st_topbar_cta_add_action_links' ) );
		}

		public function st_topbar_cta_add_action_links ( $links )
		{
			/*
			 * Add Support link to plugin action
			 */
			$mylinks = array(
				'<a href="' . admin_url( 'options-general.php?page=st-topbar-cta-admin' ) . '">' . esc_html__( 'Support', 'st-topbar-cta' ) . '</a>',
			);
			return array_merge( $links, $mylinks );
		}

		public function st_topbar_cta_enqueue()
		{
			/*
			 * Enqueue scripts
			 */

            // Load TopBar Call To Action style
            wp_enqueue_style( 'st-topbar-cta-style', ST_TOPBAR_CTA_URL_PATH . 'assets/css/style.min.css' );

            // Load cookie script
            wp_enqueue_script( 'jquery-cookie', ST_TOPBAR_CTA_URL_PATH . 'assets/js/jquery.cookie.min.js', array( 'jquery' ), '1.4.1', true );

            // Load TopBar Call To Action custom script
            wp_enqueue_script( 'st-topbar-cta-script', ST_TOPBAR_CTA_URL_PATH . 'assets/js/custom.min.js', array( 'jquery', 'jquery-cookie' ), '1.0.0', true );


		}

	    public function st_topbar_cta_includes()
		{
			/*
			 * Shortcode Page
			 */
			require ST_TOPBAR_CTA_BASE_PATH . '/includes/settings.php';

			/*
			 * Customizer Settings
			 */
			require ST_TOPBAR_CTA_BASE_PATH . '/includes/customizer.php';

			/*
			 * Render Functions
			 */
			require ST_TOPBAR_CTA_BASE_PATH . '/includes/functions.php';

		}

	}

	new ST_Topbar_Cta();

endif;
