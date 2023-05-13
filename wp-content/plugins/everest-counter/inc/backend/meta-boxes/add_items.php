<?php
defined('ABSPATH') or die("No script kiddies please!");
global $post;
$post_id = $post->ID;
$ec_counter_data = get_post_meta($post_id, 'ec_counter_data', true);
wp_nonce_field(basename(__FILE__), 'ec_add_items_nonce');
?>
<div class="ec-counter-main-wrap">
    <div class="ec-add-counter-wrap">
        <input type="button" class="button-secondary ec-add-counter-button" value="<?php _e( 'Add Counter Item', 'everest-counter' ); ?>" data-action='add_item'>
        <span class="ec-loader-image" style="display: none;"><img src='<?php echo E_COUNTER_IMAGE_DIR.'/preloader.gif'; ?>' alt='Loading...'/></span>
        <div class="ec-add-append-wrap clearfix">
            <?php
            if(isset( $ec_counter_data['item'])){
                $item_counts      = count($ec_counter_data['item']);
                if($item_counts != 0){
                    $counter = 1;
                    $items = $ec_counter_data['item'];
                    foreach($items as $key=>$item){
                        include('item.php');
                    }
                }
            }else{
                $column_index   = everestCounterClass:: generateRandomIndex();
                $key          = $column_index;
                $counter = 1;
                include('item.php');
            }
            ?>
        </div>
    </div>
</div>

