<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR\Module\Controls;


defined('ABSPATH') || die();

if (!class_exists('Droit_Control')) {
    class Droit_Control
    {

        /**
         * Constructor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function __construct()
        {
           
        }

        /**
         * Get Info.
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         * @access public
         * @static
         *
         */
        public static function droit_information_control($texts)
        {
            
            $output = '';
            
            $output .= '<div class="dl_element_popup_wrapper">';
                $output .= '<div class="dl_element_popup_box">';
                    if(isset($texts['icon']) && !empty($texts['icon'])){
                       
                        $output .= '<img src="' . $texts['icon'] . '" alt="#" class="dl_box_img">';
                    }
                    if(isset($texts['title']) && !empty($texts['title'])){
                        $output .= '<h4 class="dl_popup_title">' . $texts['title'] . '</h4>';
                    }
                    if(isset($texts['messages']) && !empty($texts['messages'])){
                        $output .= '<p class="dl_popup_desc">' . $texts['messages'] . '</p>';
                    }

                    if (isset($texts['btn_text']) && !empty($texts['btn_text'])) {
                        $btn_url = !empty($texts['btn_url']) ? esc_url($texts['btn_url']) : '#';
                        $output .= '<a href="'.$btn_url.'" target="_blank" class="cu_btn dl_gradient_btn">' . __($texts['btn_text'], 'droit-elementor-addons') . '</a>';
                    }

                $output .= '</div>';
            $output .= '</div>';
            return $output;
        }
    
    }
}
