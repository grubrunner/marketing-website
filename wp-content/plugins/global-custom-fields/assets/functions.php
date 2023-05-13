<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once GCF_PLUGIN_DIR . "views/Options.php";

/********************
 * SCRIPTS & STYLES
 *******************/

function gcf_scripts()
{
    // JS
    wp_register_script('gcf-js', plugin_dir_url(__DIR__) . 'js/scripts.js', array('jquery'), false, true);
    wp_enqueue_script('gcf-js');
    // CSS
    wp_register_style('gcf-css', plugin_dir_url(__DIR__) . 'css/style.css');
    wp_enqueue_style('gcf-css');
}

// Codemirror
function codemirror_enqueue_scripts($hook)
{
    // var_dump($hook);
    if ($hook == "toplevel_page_GCF") {
        $cm_settings['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/css'));
        wp_localize_script('jquery', 'cm_settings', $cm_settings);
        // wp_enqueue_script('wp-theme-plugin-editor');
        wp_enqueue_style('wp-codemirror');
    }
}

/***************************************************
 * GCF Functions ** Eval at your own risk
 **************************************************/

function get_gcf($group, $single = false, $eval = false)
{
    return gcf_Options::get_gcf_option($group, $single, $eval);
}

function gcf_eval(&$field)
{
    return gcf_Options::gcf_eval($field);
}

function gcfShortcode($attrs = array())
{
    $html = '';
    extract(shortcode_atts(array(
        'group' => '',
        'field' => '',
        'eval' => false
    ), $attrs));
    if (!$group || !$field) return $html;
    $html .= get_gcf($group, $field, $eval);
    return $html;
}
add_shortcode('gcf', 'gcfShortcode');
