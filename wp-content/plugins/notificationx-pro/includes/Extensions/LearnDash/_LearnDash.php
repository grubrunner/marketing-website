<?php

/**
 * LearnDash Extension
 *
 * @package NotificationX\Extensions
 */

namespace NotificationXPro\Extensions\LearnDash;

use NotificationX\Extensions\GlobalFields;

/**
 * LearnDash Extension
 */
trait _LearnDash {


    public function init_fields() {
        parent::init_fields();

        add_filter('nx_elearning_course_list', [$this, 'courses']);
    }

    public function courses($fields) {
        $course_list = [];
        if (!class_exists('LDLMS_Post_Types')) {
            return $fields;
        }
        $courses = get_posts(array(
            'post_type' => 'sfwd-courses',
            'numberposts' => -1,
        ));
        if (!empty($courses)) {
            foreach ($courses as $course) {
                $meta = get_post_meta($course->ID, '_sfwd-courses', true);
                $access_mode = !empty($meta['sfwd-courses_course_price_type']) ? $meta['sfwd-courses_course_price_type'] : false;
                if ($access_mode != 'open') {
                    $course_list[$course->ID] = $course->post_title;
                }
            }
        }
        $_fields = GlobalFields::get_instance()->normalize_fields($course_list, 'source', $this->id);
        return array_merge($fields, $_fields);
    }

    public function saved_post($post, $data, $nx_id) {
        $this->delete_notification(null, $nx_id);
        $this->get_notification_ready($data);
    }

    /**
     * This function is responsible for making the notification ready for first time we make the notification.
     *
    * @param string $type
     * @param array $data
     * @return void
     */
    public function get_notification_ready($data = array()) {
        if (!class_exists('LDLMS_Post_Types')) {
            return;
        }
        $enrollments = $this->get_course_enrollments($data);
        if (!empty($enrollments)) {
            $entries = [];
            foreach ($enrollments as $key => $enrollment) {
                $entries[] = [
                    'nx_id'      => $data['nx_id'],
                    'source'     => $this->id,
                    'entry_key'  => $enrollment['id'] . '-' . $enrollment['user_id'],
                    'data'       => $enrollment,
                ];
            }
            $this->update_notifications($entries);
        }
    }

    private function get_course_enrollments($data) {
        if (empty($data)) {
            return null;
        }
        global $wpdb;
        $enrollments = [];
        $from = strtotime(date(get_option('date_format'), strtotime('-' . intval($data['display_from']) . ' days')));
        $query = 'SELECT ld.user_id,ld.post_id,ld.activity_started,post.post_title FROM ' . $wpdb->prefix . 'learndash_user_activity AS ld JOIN ' . $wpdb->prefix . 'posts as post ON ld.post_id=post.ID WHERE activity_type="access" AND activity_started >' . $from . ' ORDER BY activity_started DESC';
        $results = $wpdb->get_results($query);

        if (!empty($results)) {
            foreach ($results as $result) {
                $enrollments[] = array_merge(
                    array(
                        'id' => $result->post_id,
                        'title' => $result->post_title,
                        'link' => get_the_permalink($result->post_id),
                        'timestamp' => $result->activity_started
                    ),
                    $this->get_enrolled_user($result->user_id)
                );
            }
        }
        return $enrollments;
    }

    /**
     * This function is generate and save a new notification when user enroll in a new course
     * @param int $user_id
     * @param int $course_id
     * @return void
     */
    public function save_new_enrollment($user_id, $course_id) {
        if( empty( $user_id ) || empty( $course_id ) ) {
            return;
        }
        $key = $course_id . '-' . $user_id;

        $enrollment = array_merge( $this->get_enrolled_course( $course_id ),  $this->get_enrolled_user( $user_id ) );

        $entry = [
            'source'     => $this->id,
            'entry_key'  => $key,
            'data'       => $enrollment,
        ];
        $this->save( $entry );
    }

    /**
     * Get enrolled course information
     * @param int $course_id
     * @return array
     */
    private function get_enrolled_course($course_id) {
        return array(
            'id' => $course_id,
            'title' => get_the_title($course_id),
            'link' => get_the_permalink($course_id),
            'timestamp' => time()
        );
    }

    /**
     * Get enrolled user information
     * @param $user_id
     * @return array
     */
    private function get_enrolled_user($user_id) {
        $user_data = [];
        $user_meta = get_user_meta($user_id);
        $first_name = $user_meta['first_name'][0];
        $last_name = $user_meta['last_name'][0];
        $user_data['user_id'] = $user_id;
        if (!empty($first_name)) {
            $user_data['first_name'] = $first_name;
        } else {
            $user_data['first_name'] = $user_meta['nickname'][0];
        }
        if (!empty($last_name)) {
            $user_data['last_name'] = $last_name;
        } else {
            $user_data['last_name'] = '';
        }
        $user_data['name'] = trim($user_data['first_name'] . ' ' . $user_data['last_name']);
        $user_data['email'] = get_userdata($user_id)->data->user_email;
        /**
         * User City and Country added
         */
        if (isset($_SERVER['REMOTE_ADDR'])) {
            $user_data['ip'] = $_SERVER['REMOTE_ADDR'];
        }
        $user_data['email'] = get_userdata($user_id)->data->user_email;
        return $user_data;
    }

    /**
     * Image action callback
     * @param array $image_data
     * @param array $data
     * @param stdClass $settings
     * @return array
     */
    public function notification_image($image_data, $data, $settings) {
        if (!$settings['show_default_image']) {
            $image_url = '';
            switch ($settings['show_notification_image']) {
                case 'featured_image':
                    $image_url = get_the_post_thumbnail_url($data['id'], 'thumbnail');
                    break;
                case 'gravatar':
                    $image_url = get_avatar_url($data['user_id'], ['size' => '100']);
            }
            $image_data['url'] = $image_url;
        }
        return $image_data;
    }

    /**
     * @param array    $data
     * @param array    $saved_data
     * @param stdClass $settings
     * @return array
     */
    public function fallback_data($data, $saved_data, $settings) {
        $data['name']            = __('Someone', 'notificationx-pro');
        $data['first_name']      = __('Someone', 'notificationx-pro');
        $data['last_name']       = __('Someone', 'notificationx-pro');
        $data['anonymous_title'] = __('Anonymous Product', 'notificationx-pro');
        $data['course_title']    = $saved_data['title'];
        return $data;
    }

}
