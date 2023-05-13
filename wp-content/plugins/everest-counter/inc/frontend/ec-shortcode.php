<?php
defined('ABSPATH') or die("No script kiddies please!");
$ec_dynamic_css_at_end = array();
$google_fonts_used_array = array();

$post_id = $atts['id'];
$counter_data = get_post_meta($post_id, 'ec_counter_data', true);
if($counter_data !=NULL){
	$items 				= $counter_data['item'];
	$display_settings 	= $counter_data['ec_display_settings'];

	$template = $display_settings['template-selection'];

	$columns = $display_settings['columns'];

	$detect = new Mobile_Detect;

	// Any mobile device (phones or tablets).
	// Exclude tablets.
	if( $detect->isMobile() && !$detect->isTablet() ){
	  // echo "Mobile Detected";
	  $column_main_class = "ec-column-{$columns['mobile']}";
	}
	// Any tablet device.
	else if( $detect->isTablet() ){
	  // echo "Tablet Detected";
	  $column_main_class = "ec-column-{$columns['tablet']}";
	}
	// any desktop devices
	else{
		// echo "Desktop detected";
		$column_main_class = "ec-column-{$columns['desktop']}";
	}

	$background_options = $display_settings['background'];

	switch($template){
		case 'template1':
		include('templates/template1.php');
		break;

		case 'template2':
		include('templates/common-template.php');
		break;

		case 'template11':
		include('templates/template1.php');
		break;

		case 'template12':
		include('templates/template1.php');
		break;

		case 'template13':
		include('templates/template1.php');
		break;

		case 'template14':
		include('templates/template2.php');
		break;

		case 'template15':
		include('templates/template1.php');
		break;


		default:
		include('templates/common-template.php');
		break;

	}

	$google_fonts = implode('|', $google_fonts_used_array);
	if(!empty($google_fonts)){
		?>
		<link href="https://fonts.googleapis.com/css?family=<?php echo $google_fonts; ?>" rel="stylesheet">
		<?php
	}

	$ec_dynamic_css_at_end_print = implode('', $ec_dynamic_css_at_end);
	if(!empty($ec_dynamic_css_at_end_print)){
	?>
	<style type='text/css' media='all'>
		<?php echo esc_attr($ec_dynamic_css_at_end_print); ?>
	</style>
	<?php
	}
}else{
	echo _e("The shortcode id that you provided doesnot return any data. Please check the shortcode id that you have used.", "everest-counter");
}