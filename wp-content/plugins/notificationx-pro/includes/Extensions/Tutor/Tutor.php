<?php
/**
 * Tutor Extension
 *
 * @package NotificationX\Extensions
 */

namespace NotificationXPro\Extensions\Tutor;

use NotificationX\Core\Rules;
use NotificationX\Extensions\Tutor\Tutor as TutorFree;
use NotificationX\Extensions\GlobalFields;

/**
 * Tutor Extension
 * @todo frontend filtering.
 */
class Tutor extends TutorFree {


    /**
     * Initially Invoked when initialized.
     */
    public function __construct() {
        parent::__construct();
    }

    public function init_fields() {
        parent::init_fields();

        add_filter('nx_elearning_course_list', [$this, 'courses']);
    }

    public function public_actions(){
        parent::public_actions();

        add_filter("nx_can_entry_{$this->id}", array($this->get_type(), 'show_purchase_of'), 10, 3);
    }

    public function courses($fields){
        $course_list = [];
        if( ! function_exists( 'tutor' ) ) {
            return $fields;
        }
        $courses = get_posts(array(
            'post_type' => 'courses',
            'numberposts' => -1,
        ));
        if( ! empty( $courses ) ) {
            foreach( $courses as $course ) {
                $course_list[ $course->ID ] = $course->post_title;
            }
        }
        $_fields = GlobalFields::get_instance()->normalize_fields($course_list, 'source', $this->id);
        return array_merge($fields, $_fields);
    }

}