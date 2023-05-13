<?php
/**
 * EDD Extension
 *
 * @package NotificationX\Extensions
 */

namespace NotificationXPro\Extensions\EDD;

use NotificationX\Core\Rules;
use NotificationX\Extensions\EDD\EDD as EDDFree;
use NotificationX\Extensions\GlobalFields as GlobalFieldsFree;
use NotificationXPro\Extensions\GlobalFields;

/**
 * EDD Extension
 * @todo normalize data for frontend.
 * @todo show_purchaseof && excludes_product
 */
trait _EDD {


    public function categories($options){

        $product_categories = get_terms(array(
            'taxonomy'   => 'download_category',
            'hide_empty' => false,
        ));

        $category_list = [];

        if( ! is_wp_error( $product_categories ) ) {
            foreach( $product_categories as $product ) {
                $category_list[ $product->slug ] = $product->name;
            }
        }

        $options = GlobalFields::get_instance()->normalize_fields( $category_list, 'source', $this->id, $options );
        return $options;
    }

    public function products($options){
        $products = get_posts(array(
            'post_type'      => 'download',
            'posts_per_page' => -1,
            'numberposts' => -1,
        ));

        $product_list = [];

        if( ! empty( $products ) ) {
            foreach( $products as $product ) {
                $product_list[ $product->ID ] = $product->post_title;
            }
        }
        $options = GlobalFields::get_instance()->normalize_fields( $product_list, 'source', $this->id, $options );
        return $options;
    }
}
