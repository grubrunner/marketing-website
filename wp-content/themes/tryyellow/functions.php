<?php
// TryYellow

// Global Theme Params
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']=Array();
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url']=parse_url( get_template_directory_uri(), PHP_URL_PATH );
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['header_header_class']='';
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['header_main_class']='';
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['header_body_class']='';
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']=Array();
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['jqtouchswipe']=true;
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['swiper']=true;
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['intltelinput']=false;
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['lottie']=false;
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['jqanimnum']=false;
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['footer_hide']=false;

// Добавление тайтла
add_action('after_setup_theme', 'theme_supports');
function theme_supports() {
	add_theme_support('title-tag');
}

// add_filter( 'wp_enqueue_scripts', 'remove_default_js_css', PHP_INT_MAX );
// function remove_default_js_css( ){
// 	wp_dequeue_style( 'wp-block-library' );
// 	wp_dequeue_script( 'jquery');
// 	wp_deregister_script( 'jquery');
// }

// Translation file
load_theme_textdomain( 'catapulta_tryyellow_lang', get_template_directory() . '/lang' );

//enable featured images
add_theme_support( 'post-thumbnails' );

//enable menus
add_theme_support( 'menus' );

//register menus
// add_action( 'init', 'register_menus' );
// function register_menus() {
// 	register_nav_menus(
// 		Array(
// 			'catapulta_tryyellow_theme_location_header_side_menu' => __( 'Side Menu', 'catapulta_tryyellow_lang' ),
// 			'catapulta_tryyellow_theme_location_header_side_bottom_menu' => __( 'Side Bottom Menu', 'catapulta_tryyellow_lang' ),
// 			'catapulta_tryyellow_theme_location_footer_desktop_menu' => __( 'Footer Menu Desktop', 'catapulta_tryyellow_lang' ),
// 			'catapulta_tryyellow_theme_location_footer_mobile_menu' => __( 'Footer Menu Mobile', 'catapulta_tryyellow_lang' ),
// 			'catapulta_tryyellow_theme_location_footer_contacts_menu' => __( 'Footer Menu Contacts', 'catapulta_tryyellow_lang' ),
// 			'catapulta_tryyellow_theme_location_footer_mobile_bottom_menu' => __( 'Footer Menu Mobile Bottom', 'catapulta_tryyellow_lang' ),
// 			'catapulta_tryyellow_theme_location_social_menu' => __( 'Social Menu', 'catapulta_tryyellow_lang' ),
// 		)
// 	);
// }

// enqueue common scripts
add_action( 'wp_enqueue_scripts', 'catapulta_tryyellow_scripts' );
function catapulta_tryyellow_scripts() {
	wp_enqueue_script('jquery-3.6.0', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/js/lib/jquery-3.6.0.min.js', array(), 'v3.6.0', true);
	// if ($GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['jqtouchswipe']) {
		wp_enqueue_script('yel-jqtouchswipe-theme', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/js/lib/jquery.touchSwipe.min.js', array('jquery-3.6.0'), 'v0.0.0', true);
	// }
	// if ($GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['swiper']) {
		wp_enqueue_script('yel-swiper-theme', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/js/lib/swiper-bundle.min.js', array('jquery-3.6.0'), 'v0.0.0', true);
		// wp_enqueue_script('yel-swiper-theme', 'https://www.swayy.in/wp-content/plugins/testimonial-slider-and-showcase/assets/vendor/swiper/swiper.min.js', array('jquery-3.6.0'), 'v0.0.0', true);
	// }
	if ($GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['intltelinput']) {
		wp_enqueue_script('intltelinput', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/js/lib/intlTelInput.min.js', array(), 'v0.0.0', true);
	}
	if ($GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['lottie']) {
		wp_enqueue_script('lottie', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/js/lib/lottie.min.js', array(), 'v0.0.0', true);
	}
	if ($GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['jqanimnum']) {
		wp_enqueue_script('jqanimnum', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/js/lib/jquery.animateNumber.min.js', array(), 'v0.0.0', true);
	}
	
	wp_enqueue_script('yel-script', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/js/script.js', array(), 'v0.0.'.filemtime(get_template_directory().'/js/script.js'), true);
	// if ($GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['order']) {
	// 	wp_enqueue_script('order', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/js/order.js', array(), 'v0.0.'.filemtime(get_template_directory().'/js/order.js'), true);
	// }
}

// enqueue common styles
add_action('wp_print_styles', 'catapulta_tryyellow_styles');
function catapulta_tryyellow_styles() {
	// if ($GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['swiper']) {
			wp_enqueue_style( 'yel-swiper-theme', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/css/lib/swiper-bundle.min.css', array(), 'v0.0.0', 'all' );
	// }
	// if ($GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['intltelinput']) {
			wp_enqueue_style( 'intltelinput', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/css/lib/intlTelInput.css', array(), 'v0.0.0', 'all' );
	// }
	wp_enqueue_style( 'styles', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/css/styles.css', array(), 'v0.0.' . filemtime( get_template_directory() . '/css/styles.css' ), 'all' );
	// <link rel="stylesheet" type="text/css" href="/css/intlTelInput.css">

	// if ($GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['order']) {
	// 	wp_enqueue_style( 'order', $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/css/order.css', array(), 'v0.0.' . filemtime( get_template_directory() . '/css/order.css' ), 'all' );
	// }
}
// apply_filters('hurryt_campaign_content', $campaignBuilder->build($content, $options), $this->get_id())
add_filter('hurryt_campaign_content','yel_hurry_timer_test',10,2);
function yel_hurry_timer_test($build_content, $get_id){
	// var_dump($build_content);
	// var_dump($get_id);
	// echo ('abhi');
	// $campaign = hurryt_get_campaign( absint( $get_id ) );
	// echo "<pre>";
    // // var_dump($campaign);
	// echo "</pre>";
	if (empty($build_content)) {
		$build_content = "";
	}
	return $build_content;
}

// add_action("init","custom_class_check");
function custom_class_check(){
	if (is_plugin_active('hurrytimer/hurrytimer.php')) {
		$ipAddress = null;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }
		$campaignId = 310;
		global $wpdb;
		$tablename = $wpdb->prefix . "hurrytimer_evergreen";
		$sql = $wpdb->prepare(
                "SELECT id, client_expires_at FROM {$tablename}
                WHERE countdown_id = %d
                AND client_ip_address = %s",
                $campaignId,
                $ipAddress
            );

        /**
         * @var object{id, client_expires_at} $result
         */
        $found = $wpdb->get_row( $sql );
        if ($found) {
        	// code...
        	$end_time = floor($found->client_expires_at);
	        $milliseconds = floor(microtime(true) * 1000);
			$difference = $end_time - $milliseconds;
			if ($difference <= 0) {
				return true;
			} else {
				return false;
			}
        } else {
        	return false;
        }
	}
}

function yel_fire_when_timer_expires(){
	?>
	<script>
	
	(function($){
		$(document).on('hurryt:finished','.hurrytimer-campaign', function(e, campaign){
			console.log('campaign expired!');
			location.reload();
		});
	})(jQuery);
	
	</script>
	<?php
}

add_action('wp_head', 'yel_fire_when_timer_expires');