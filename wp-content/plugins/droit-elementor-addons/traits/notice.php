<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR\Traits;
use DROIT_ELEMENTOR\Utils as Droit_Utils;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if (!trait_exists('Notice')) {
    trait Notice
    {
      /**
       * Droit Editor Footer Notice
       * @return string
       * Feature added by : DroitLab Team
       * @since : 1.0.0
       */
      public static function droit_pro_editor_notice(){
            $_msg       = sprintf(esc_html__('Enjoying the experience?', 'droit-elementor-addons'));
            $_msg_learn = sprintf(esc_html__('Learn more on how you can easily work with our plugin', 'droit-elementor-addons'));
            $demo_url   = Droit_Utils::droit_addons_demo_link();
            $pro_url    = Droit_Utils::droit_addons_pro_link();

            printf('<div id="elementor-notice-bar"><i class="droit-bar-pro addons-icon"></i><div id="elementor-notice-bar__message">%1$s <a href="%2$s" target="_blank">%3$s</a></div> <div id="elementor-notice-bar__action"><a href="%4$s" target="_blank">Subscribe for Pro</a></div>
                    <i id="elementor-notice-bar__close" class="eicon-close"></i></div>', $_msg, $demo_url, $_msg_learn, $pro_url);
        }
    }

}