<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR;

defined('ABSPATH') || die();

use DROIT_ELEMENTOR\Utils;

if (!class_exists('Admin_Dashboard')) {
    class Admin_Dashboard
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
         * Droit Elementor Demo Video
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_youtube_demo()
        {
              return [

                    'demo-info'     => [
                        '_thumbnail'      => DROIT_EL_ADDONS_IMAGE . 'video_popup_1.png',
                        '_play_icon'      => DROIT_EL_ADDONS_IMAGE . 'play_icon.png',
                        '_embed_url'      => 'https://www.youtube.com/embed/-w4LA-P0lfk',
                    ],

                    'demo-logo'     => [
                        '_thumbnail'      => DROIT_EL_ADDONS_IMAGE . 'video_popup_2.png',
                        '_play_icon'      => DROIT_EL_ADDONS_IMAGE . 'play_icon.png',
                        '_embed_url'      => 'https://www.youtube.com/embed/VcmguivPO4Y',
                    ],

                    'demo-post'     => [
                        '_thumbnail'      => DROIT_EL_ADDONS_IMAGE . 'video_popup_3.png',
                        '_play_icon'      => DROIT_EL_ADDONS_IMAGE . 'play_icon.png',
                        '_embed_url'      => 'https://www.youtube.com/embed/TiAV-wy7OL4',
                    ],

                ];  
        }
    
    }
}
