<?php

defined('ABSPATH') or die("No script kiddies please!");
$labels = array(
    'name' => _x('Everest Counters', 'post type general name', 'everest-counter'),
    'singular_name' => _x('Everest Counter', 'post type singular name', 'everest-counter'),
    'menu_name' => _x('Everest Counters', 'admin menu', 'everest-counter'),
    'name_admin_bar' => _x('Everest Counter', 'add new on admin bar', 'everest-counter'),
    'add_new' => _x('Add New Everest Counter', 'Everest Counter', 'everest-counter'),
    'add_new_item' => __('Add New Everest Counter', 'everest-counter'),
    'new_item' => __('New Everest Counter', 'everest-counter'),
    'edit_item' => __('Edit Everest Counter', 'everest-counter'),
    'view_item' => __('View Everest Counter', 'everest-counter'),
    'all_items' => __('All Everest Counter', 'everest-counter'),
    'search_items' => __('Search Everest Counter', 'everest-counter'),
    'parent_item_colon' => __('Parent Everest Counter:', 'everest-counter'),
    'not_found' => __('No Everest Counter found.', 'everest-counter'),
    'not_found_in_trash' => __('No Everest Counter found in Trash.', 'everest-counter')
);

$args = array(
    'labels' => $labels,
    'description' => __('Description.', 'everest-counter'),
    'public' => false,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => 'dashicons-layout',
    'query_var' => true,
    'rewrite' => array('slug' => 'everest-counter'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title')
);

register_post_type('everest-counter', $args);

add_action( 'add_meta_boxes_everest-counter', 'e_counter_adding_custom_meta_boxes' );

function e_counter_adding_custom_meta_boxes() {
    add_meta_box(
        'counter-items',
        __( 'Counter Items' ),
        'add_counter_items',
        'everest-counter',
        'normal',
        'default'
    );

    add_meta_box(
        'counter-display-settings',
        __( 'Display Settings' ),
        'render_display_settings',
        'everest-counter',
        'normal',
        'default'
    );

    add_meta_box(
        'counter-shortcode-display',
        __( 'Genereated Shortcode' ),
        'render_shortcode_display',
        'everest-counter',
        'side',
        'high'
    );
}

function add_counter_items()
{
    include('meta-boxes/add_items.php');
}

function render_display_settings()
{
    include('meta-boxes/display_settings.php');
}

function render_shortcode_display(){
    global $post;
    $post_id = $post->ID;
    ?>
    <label for='ec-shortcode-display' style="width: 100%"><?php _e("Please copy the below shortcode to display counter "); ?></label>
    <input type='text' class="ec-shortcode-display-value" readonly="" value="[everest_counter id='<?php echo $post_id; ?>']" style="width: 100%;" onclick="select()" />
    <span class="ec-copied-info" style="display: none;"><?php _e('Shortcode copied to your clipboard.', 'everest-counter'); ?></span>
    <?php
}