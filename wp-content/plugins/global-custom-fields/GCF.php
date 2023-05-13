<?php

/**
 * Plugin Name: Global Custom Fields
 * Plugin URI: https://wordpress.org/plugins/global-custom-fields
 * Description: Create Global Custom fields and save them into WP Options, then get them in PHP or use gcf Shortcode
 * Version: 1.3
 * Author: tommasomeli
 * Author URI: https://profiles.wordpress.org/tommasomeli
 */

/******************
 * GCF Array
 *****************/

$gcf_settings = get_option('gcf_options')['gcf-settings'];
$gcf_groups = array_filter(array_map('trim', explode(',', $gcf_settings['gcf-groups'])));
$gcf_fields = get_option('gcf_options')['gcf-fields'];
array_walk($gcf_fields, function(&$item, $key){
    $item = array_filter(array_map('trim', explode(',', $item)));
});

/*********************
 * REQUIRED
 ********************/

define('GCF_PLUGIN_DIR', plugin_dir_path(__FILE__));
require_once GCF_PLUGIN_DIR . "assets/functions.php";
require_once GCF_PLUGIN_DIR . "views/Options.php";

/*********************
 * OPTIONS PAGE
 ********************/

$GCFOptions = new GCF_Options();

/********************
 * SCRIPTS & STYLES
 *******************/

add_action('wp_enqueue_scripts', 'gcf_scripts');
add_action('admin_enqueue_scripts', 'gcf_scripts');
add_action('admin_enqueue_scripts', 'codemirror_enqueue_scripts');

/****************
 * ACTIVATION
 ***************/

register_activation_hook(__FILE__, 'gcf_plugin_activation');
function gcf_plugin_activation()
{
    if(!get_option('gcf_options')){
        $gcf_options = array(
            "gcf-settings" => array(
                "gcf-groups" => "",
                "gcf-html-tags" => "",
                "gcf-html-attr" => ""
            ),
            "gcf-fields" => array(),
            "gcf" => array()
        );
        add_option('gcf_options', $gcf_options);
    }
}