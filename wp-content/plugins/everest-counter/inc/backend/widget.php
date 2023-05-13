<?php
defined('ABSPATH') or die("No script kiddies please!");
/**
 * Adds AccessPress Social Login Widget
 */

class EC_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'ec_widget', // Base ID
                __('Everest Counter', 'everest-counter' ), // Name
                array('description' => __('Everest Counter Widget', 'everest-counter' )) // Args
        );
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = '';
        }

        if (isset($instance['shortcode_id'])) {
            $shortcode_id = $instance['shortcode_id'];
        } else {
            $shortcode_id = '';
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title: ', 'everest-counter' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('shortcode_id'); ?>"><?php _e( 'shortcode ID: ', 'everest-counter' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('shortcode_id'); ?>" name="<?php echo $this->get_field_name('shortcode_id'); ?>" type="text" value="<?php echo esc_attr($shortcode_id); ?>">
        </p>
        <?php
    }

     /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        echo "<div class='apsl-widget'>";
        echo do_shortcode("[everest_counter id='{$instance['shortcode_id']}']");
        echo "</div>";
        echo $args['after_widget'];
    }
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['shortcode_id'] = (!empty($new_instance['shortcode_id']) ) ? strip_tags($new_instance['shortcode_id']) : '';
        return $instance;
    }
}
