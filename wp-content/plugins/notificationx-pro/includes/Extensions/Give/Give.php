<?php
/**
 * Give Extension
 *
 * @package NotificationX\Extensions
 */

namespace NotificationXPro\Extensions\Give;

use NotificationX\Core\Rules;
use NotificationX\Extensions\Give\Give as GiveFree;
use NotificationX\Extensions\GlobalFields as GlobalFieldsFree;

/**
 * Give Extension
 * @todo normalize data for frontend.
 */
class Give extends GiveFree {


    /**
     * Initially Invoked when initialized.
     */
    public function __construct() {
        parent::__construct();
    }



    public function init_fields(){
        parent::init_fields();
        add_filter( 'nx_content_fields', array( $this, 'content_fields' ) );

    }


    public function content_fields($fields){
        $content_fields = &$fields['content']['fields'];


        $content_fields['give_forms_control'] = array(
            'label'    => __('Show Notification Of', 'notificationx-pro'),
            'name'     => 'give_forms_control',
            'type'     => 'select',
            'priority' => 200,
            'default'  => 'none',
            'options'  => GlobalFieldsFree::get_instance()->normalize_fields(array(
                'none'      => __('All', 'notificationx-pro'),
                'give_form' => __('By Form', 'notificationx-pro'),
            )),
            'rules'       => Rules::is( 'source', $this->id ),
        );
        $content_fields['give_form_list'] = array(
            'label'    => __('Select Donation Form', 'notificationx-pro'),
            'name'     => 'give_form_list',
            'type'     => 'select',
            'multiple' => true,
            'priority' => 201,
            'options'  => GlobalFieldsFree::get_instance()->normalize_fields($this->donation_forms()),
            'rules'       => Rules::logicalRule([
                Rules::is( 'source', $this->id ),
                Rules::is( 'give_forms_control', 'give_form' ),
            ]),
        );

        return $fields;
    }

    /**
     * Get donation forms
     * @return array
     */
    protected function donation_forms(){
        $forms_list = [];
        if( ! class_exists( 'Give' ) ) {
            return $forms_list;
        }
        $forms = get_posts(array(
            'post_type' => 'give_forms',
            'numberposts' => -1,
        ));
        if( ! empty( $forms ) ) {
            foreach( $forms as $form ) {
                $forms_list[ $form->ID ] = $form->post_title;
            }
        }
        return $forms_list;
    }


}