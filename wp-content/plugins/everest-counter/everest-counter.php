<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
/*
  Plugin name: Everest Counter
  Plugin URI: https://accesspressthemes.com/wordpress-plugins/everest-counter/
  Description: A plugin to add various stat counters to posts/pages content using shortcodes and widgets.
  version: 2.0.2
  Author: AccessPress Themes
  Author URI: https://accesspressthemes.com/
  Text Domain: everest-counter
  Domain Path: /languages/
  License: GPLv2 or later
*/

/**
* Plugin's main class initilization
*/
if(!class_exists('Mobile_Detect')){
	include_once('inc/frontend/Mobile_Detect.php');
}
include_once( 'inc/backend/widget.php' );
if(! class_exists( 'everestCounterClass' )){
	class everestCounterClass {

		function __construct() {
			add_action( 'init', array( $this, 'plugin_contants') );
			add_action( 'init',  array( $this, 'plugin_variables' ) );// Register globals variables
			add_action( 'init', array( $this, 'plugin_text_domain' ) );
			add_action( 'init', array( $this, 'register_everest_counter_post_type_and_meta_boxes' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'register_plugin_assets' ) );
			//registers all the assets required for wp-admin
            add_action( 'wp_enqueue_scripts', array($this, 'register_frontend_assets') );
			//backend ajax calls
			add_action( 'wp_ajax_backend_ajax', array($this, 'ec_backend_ajax') );
            add_action( 'wp_ajax_nopriv_backend_ajax', array($this, 'ec_backend_ajax') );
            //action to save the custom meta boxes field values
			add_action( 'save_post', array( $this, 'e_counter_save_meta_data' ) );
			add_filter('manage_everest-counter_posts_columns', array($this, 'everest_counter_columns_head')); //adding custom row
            add_action('manage_everest-counter_posts_custom_column', array($this, 'everest_counter_columns_content'), 10, 2); //adding custom row content
            add_filter('post_row_actions', array($this, 'remove_row_actions'), 10, 1);
            add_action('admin_menu', array($this, 'register_about_page')); //add submenu page
            add_shortcode('everest_counter', array($this, 'ec_shortcode')); // generating shortcode
            add_action( 'widgets_init', array($this, 'register_ec_widget') );
	    	add_action( 'wp_print_scripts', array($this, 'wpdocs_dequeue_script'), 100 );
		}

 		function wpdocs_dequeue_script() {
    			wp_dequeue_script( 'jquery-waypoints' );
			wp_deregister_script( 'jquery-waypoints' );
		}

		//registration of the social login widget
        public function register_ec_widget() {
            register_widget( 'EC_Widget' );
        }

		public function ec_shortcode($atts, $content = null){
			$args = array(
                'post_type' => 'everest-counter',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'p' => $atts['id']
            );
            foreach ($atts as $key => $val) {
                $$key = $val;
            }
            $everest_counter = new WP_Query($args);
            if ($everest_counter->have_posts()){
                ob_start();
                include('inc/frontend/ec-shortcode.php');
                $return_data = ob_get_contents();
	            ob_end_clean();
	        	wp_reset_query();
	            if(isset($return_data)){
	            	return $return_data;
	            }else{
	            	return NULL;
	            }
            }else{
	        	wp_reset_query();
            	return NULL;
            }
		}

		function remove_row_actions($actions) {
            if (get_post_type() == 'everest-counter') { // choose the post type where you want to hide the button
                unset($actions['view']); // this hides the VIEW button on your edit post screen
                unset($actions['inline hide-if-no-js']);
            }
            return $actions;
        }

		 /*
         * Add custom column to smartlogo post
         */

        function everest_counter_columns_head($columns) {
            $columns['shortcodes'] = __( 'Shortcodes', 'everest-counter' );
            $columns['template'] = __( 'Template Include', 'everest-counter' );
            return $columns;
        }

        /*
         * Added content to custom column
         */

        function everest_counter_columns_content($column, $post_id) {
            if ($column == 'shortcodes') {
                $id = $post_id;
                ?>
                <textarea class='ec-shortcode-display-value' style="resize: none;" rows="2" cols="25" readonly="readonly">[everest_counter id="<?php echo $post_id; ?>"]</textarea>
				<span class="ec-copied-info" style="display: none;"><?php _e('Shortcode copied to your clipboard.', 'everest-counter'); ?></span>
                <?php
            }
            if ($column == 'template') {
                $id = $post_id;
                ?>
                <textarea class='ec-shortcode-template-display-value' style="resize: none;" rows="2" cols="45" readonly="readonly">&lt;?php echo do_shortcode("[everest_counter id='<?php echo $post_id; ?>']"); ?&gt;</textarea>
				<span class="ec-copied-info" style="display: none;"><?php _e('Shortcode copied to your clipboard.', 'everest-counter'); ?></span>
                <?php
            }
        }

		/**
		 * Save meta box content.
		 *
		 * @param int $post_id Post ID
		 */
		function e_counter_save_meta_data( $post_id ) {
		    // Save logic goes here. Don't forget to include nonce checks!
		    // Checks save status
		    $is_autosave = wp_is_post_autosave($post_id);
		    $is_revision = wp_is_post_revision($post_id);
		    $is_valid_nonce = ( isset($_POST['ec_add_items_nonce']) && wp_verify_nonce($_POST['ec_add_items_nonce'], basename(__FILE__)) ) ? 'true' : 'false';

		    // Exits script depending on save status
		    if ($is_autosave || $is_revision || !$is_valid_nonce) {
		        return;
		    }

		    $merge_array = array();
		    if (isset($_POST['item'])) {
		        $merge_array['item'] = (array) $_POST['item'];
		    }

		    if (isset($_POST['ec_display_settings'])) {
		        $merge_array['ec_display_settings'] = (array) $_POST['ec_display_settings'];
		    }

			$sanitized_array = everestCounterClass:: sanitize_array($merge_array);
		    update_post_meta($post_id, 'ec_counter_data', $sanitized_array);
		    return;
		}

		/**
		 * Backend ajax call to perform item addition
		 * @return null
		 */
		function ec_backend_ajax(){
			$nonce = $_POST['_wpnonce'];
			$created_nonce = 'ec-backend-ajax-nonce';
			if ( ! wp_verify_nonce( $nonce, $created_nonce ) ) {
			    die( __( 'Security check', 'everest-counter' ) );
			}

			if($_POST['_action'] == 'add_item'){
				include('inc/backend/meta-boxes/item.php');
				die();
			}
		}

		/**
		 * Make plugin's variables available all around
		 * @return NULL
		 */
		public function plugin_variables() {
			global $ec_variables;
			include_once( E_COUNTER_PLUGIN_DIR . 'inc/plugin_variables.php' );
		}

		/**
		 * Function to add  plugin's necessary CSS and JS files for backend
		 * @return null
		 */
		function register_plugin_assets() {
	        //register the styles
	        wp_register_style( 'custom-icon-picker', E_COUNTER_CSS_DIR.'/icon-picker.css', false, E_COUNTER_VERSION );
	        wp_register_style( 'font-awesome-icons-v4.7.0', E_COUNTER_CSS_DIR.'/font-awesome/font-awesome.min.css', false, E_COUNTER_VERSION );
	        wp_register_style( 'ec_gener_icons', E_COUNTER_CSS_DIR . '/genericons.css', false, E_COUNTER_VERSION );
	        wp_register_style( 'jquery-ui-css', E_COUNTER_CSS_DIR.'/jquery-ui.css', false, E_COUNTER_VERSION );
	        wp_register_style( 'ec_admin_css', E_COUNTER_CSS_DIR . '/ec-backend.css', false, E_COUNTER_VERSION );

	        //enqueue of the styles
	        wp_enqueue_style( 'ec_gener_icons' );
	        wp_enqueue_style('custom-icon-picker');
	        wp_enqueue_style('font-awesome-icons-v4.7.0');
	        wp_enqueue_style('wp-color-picker');
	        wp_enqueue_style('jquery-ui-css');
	        wp_enqueue_style( 'ec_admin_css' );

	        // registration of the js
	        wp_register_script('ec_icon_picker', E_COUNTER_JS_DIR.'/icon-picker.js', array('jquery'), E_COUNTER_VERSION, true );
	        wp_enqueue_script( 'wp-color-picker-alpha', E_COUNTER_JS_DIR.'/wp-color-picker-alpha.js',array('jquery','wp-color-picker'), '2.1.2' );
	        wp_register_script( 'ec_admin_js', E_COUNTER_JS_DIR . '/ec-backend.js', array('jquery', 'wp-color-picker', 'wp-color-picker-alpha', 'ec_icon_picker', 'jquery-ui-sortable'),  E_COUNTER_VERSION, true );

	        // enqueue of the js
	        wp_enqueue_media();
            wp_enqueue_script('wp-color-picker');
	        wp_enqueue_script('ec_icon_picker');
	        wp_enqueue_script('ec_admin_js');
	        wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-slider');

	        //for the backend ajax call
            $ajax_nonce = wp_create_nonce( 'ec-backend-ajax-nonce' );
            wp_localize_script( 'ec_admin_js', 'ec_backend_ajax', array('ajax_url' => admin_url() . 'admin-ajax.php', 'ajax_nonce' => $ajax_nonce) );

		}

		function register_frontend_assets(){
	        wp_enqueue_style( 'font-awesome-icons-v4.7.0', E_COUNTER_CSS_DIR.'/font-awesome/font-awesome.min.css', false, E_COUNTER_VERSION );

	        wp_enqueue_style( 'ec_gener_icons', E_COUNTER_CSS_DIR . '/genericons.css', false, E_COUNTER_VERSION );
	        wp_enqueue_style( 'dashicons' );
			wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Raleway|ABeeZee|Aguafina+Script|Open+Sans|Roboto|Roboto+Slab|Lato|Titillium+Web|Source+Sans+Pro|Playfair+Display|Montserrat|Khand|Oswald|Ek+Mukta|Rubik|PT+Sans+Narrow|Poppins|Oxygen:300,400,600,700', array(), E_COUNTER_VERSION );
			wp_enqueue_style( 'ec_frontend_css', E_COUNTER_CSS_DIR . '/frontend/ec-frontend.css', array(), E_COUNTER_VERSION );
			wp_enqueue_style( 'ec_animate_css', E_COUNTER_CSS_DIR . '/frontend/animate.min.css', array(), E_COUNTER_VERSION );

			//for counterup js
			// wp_enqueue_script('ec_waypoints_js', E_COUNTER_JS_DIR . '/waypoints.min.js', array('jquery'), E_COUNTER_VERSION , true );
			// wp_enqueue_script('ec_counterup_js', E_COUNTER_JS_DIR . '/jquery.counterup.min.js', array('jquery', 'ec_waypoints_js'), E_COUNTER_VERSION , true );

			wp_enqueue_script('ec_waypoints_js', E_COUNTER_JS_DIR . '/jquery.waypoints.js', array('jquery'), E_COUNTER_VERSION , true );
			wp_enqueue_script('ec_counterup_js', E_COUNTER_JS_DIR . '/jquery.counterup.js', array('jquery', 'ec_waypoints_js'), E_COUNTER_VERSION , true );

			wp_enqueue_script('ec_jarallax_js', E_COUNTER_JS_DIR . '/jarallax.js', array('jquery'), E_COUNTER_VERSION , true );
			wp_enqueue_script('ec_jarallax_video_js', E_COUNTER_JS_DIR . '/jarallax-video.js', array('jquery'), E_COUNTER_VERSION , true );
			wp_enqueue_script('ec_wow_js', E_COUNTER_JS_DIR . '/wow.min.js', array('jquery'), E_COUNTER_VERSION , true );
			wp_enqueue_script('ec_frontend_js', E_COUNTER_JS_DIR . '/ec-frontend.js', array( 'jquery', 'ec_counterup_js', 'ec_wow_js', 'ec_jarallax_js', 'ec_jarallax_video_js' ), E_COUNTER_VERSION , true );
		}


		/**
		 * Function for the contant declaration of the plugins.
		 * @return null
		 */
		function plugin_contants(){
			//Declearation of the necessary constants for plugin
			defined('E_COUNTER_VERSION')  or define( 'E_COUNTER_VERSION', '2.0.2' );
			defined( 'E_COUNTER_IMAGE_DIR' ) or define( 'E_COUNTER_IMAGE_DIR', plugin_dir_url( __FILE__ ) . 'images' );
			defined( 'E_COUNTER_JS_DIR' ) or define( 'E_COUNTER_JS_DIR', plugin_dir_url( __FILE__ ) . 'js' );
			defined( 'E_COUNTER_CSS_DIR' ) or define( 'E_COUNTER_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css' );
			defined( 'E_COUNTER_ASSETS_DIR' ) or define( 'E_COUNTER_ASSETS_DIR', plugin_dir_url( __FILE__ ) . 'assets' );
			defined( 'E_COUNTER_LANG_DIR' ) or define( 'E_COUNTER_LANG_DIR', basename( dirname( __FILE__ ) ) . '/languages/' );
			defined( 'E_COUNTER_TEXT_DOMAIN' ) or define( 'E_COUNTER_TEXT_DOMAIN', 'everest-counter' );
			defined( 'E_COUNTER_SETTINGS' ) or define( 'E_COUNTER_SETTINGS', 'e_counter_settings' );
			defined('E_COUNTER_PLUGIN_DIR') or define( 'E_COUNTER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			defined( 'E_COUNTER_PLUGIN_DIR_URL' ) or define( 'E_COUNTER_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) ); //plugin directory url
		}

		/**
		 * Function to define the custom post type required for a plugin
		 * @return null
		 */
		public function register_everest_counter_post_type_and_meta_boxes(){
			include('inc/backend/register-post-type-and-meta-boxes.php');
		}

		/**
		 * Function to load the plugin text domain for plugin translation
		 * @return type
		 */
		function plugin_text_domain(){
			load_plugin_textdomain( E_COUNTER_TEXT_DOMAIN, false, E_COUNTER_LANG_DIR );
		}

		/**
		 * Function to generate random number
		 * @param  integer $length Length of the random number to be generated
		 * @return mixed Returns the mixed value of number and alphabets
		 */
		public static function generateRandomIndex($length = 10) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}

		/**
		  * Sanitizes Multi Dimensional Array
		  * @param array $array
		  * @param array $sanitize_rule
		  * @return array
		  *
		  * @since 1.0.0
		  */
		static function sanitize_array( $array = array(), $sanitize_rule = array() ){
			if ( ! is_array( $array ) || count( $array ) == 0 ) {
				return array();
			}
			foreach ( $array as $k => $v ) {
				if ( ! is_array( $v ) ) {
					$default_sanitize_rule = (is_numeric( $k )) ? 'html' : 'text';
					$sanitize_type = isset( $sanitize_rule[ $k ] ) ? $sanitize_rule[ $k ] : $default_sanitize_rule;
					$array[ $k ] = self:: sanitize_value( $v, $sanitize_type );
				}
				if ( is_array( $v ) ) {
					$array[ $k ] = self:: sanitize_array( $v, $sanitize_rule );
				}
			}
			return $array;
		}
		/**
		* Sanitizes Value
		*
		* @param type $value
		* @param type $sanitize_type
		* @return string
		*
		* @since 1.0.0
		*/
		static function sanitize_value( $value = '', $sanitize_type = 'text' ){
			switch ( $sanitize_type ) {
			 case 'html':
			     $allowed_html = wp_kses_allowed_html( 'post' );
			     return wp_kses( $value, $allowed_html );
			     break;
			 default:
			     return sanitize_text_field( $value );
			     break;
			}
		}

		public static function print_array($array){
			echo "<pre>";
			print_r($array);
			echo "</pre>";
		}
		/*
         * Adding Submenu page
         */
        function register_about_page() {
            add_submenu_page(
                    'edit.php?post_type=everest-counter', __('More WordPress Stuff', 'everest-counter'), __('More WordPress Stuff', 'everest-counter'), 'manage_options', 'about-us', array($this, 'about_us_submenu_page_callback'));
        }

        function about_us_submenu_page_callback() {
            include('inc/backend/about-page.php');
        }
	}
	$new_everest_counter_obj = new everestCounterClass();
}