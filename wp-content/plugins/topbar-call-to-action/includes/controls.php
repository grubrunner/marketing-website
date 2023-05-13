<?php
/**
 * Customizer Controls
 *
 * @package TopBar Call To Action
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists( 'WP_Customize_Control' ) ) :
    return null;
endif;

/**
 * Customize Control for Switch Control.
 *
 * @see WP_Customize_Control
 */
Class ST_Topbar_Cta_Switch_Control extends WP_Customize_Control{
    public $type = 'switch';
    public $on_off_label = array();

    public function __construct( $manager, $id, $args = array() ){
        $this->on_off_label = $args['on_off_label'];
        parent::__construct( $manager, $id, $args );
    }

    public function render_content(){
    ?>
        <span class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
        </span>

        <?php if( $this->description ) : ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post( $this->description ); ?>
            </span>
        <?php endif;

        $switch_class = ( $this->value() == 'true' ) ? 'switch-on' : '';
        $on_off_label = $this->on_off_label;
        ?>
        <div class="st-onoffswitch <?php echo esc_attr( $switch_class ); ?>">
            <div class="onoffswitch-inner">
                <div class="onoffswitch-active">
                    <div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['on'] ) ?></div>
                </div>

                <div class="onoffswitch-inactive">
                    <div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['off'] ) ?></div>
                </div>
            </div>  
        </div>
        <input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr( $this->value() ); ?>"/>
        <?php
    }
}


/**
 * Customize Control for upsell
 *
 * @see WP_Customize_Control
 */
Class ST_Topbar_Cta_Upsell extends WP_Customize_Control{
    public $type = 'upsell';

    public $url = '';

    public function render_content(){
    ?>
        <span class="customize-control-title alignleft">
            <i><?php echo esc_html( $this->label ); ?></i>
        </span>

        <a href="<?php echo esc_url( $this->url ); ?>" class="button button-primary alignright" target="_blank"><?php esc_html_e( 'Buy Pro', 'st-topbar-cta' ); ?></a>
        <?php
    }
}
