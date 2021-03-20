<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR\Traits;

use \Elementor\Core\Files\CSS\Post as Post_CSS;
use \DROIT_ELEMENTOR\Droit_Elements as Elements;
use \DROIT_ELEMENTOR\Utils as Droit_Utils;
use \DROIT_ELEMENTOR\Cache\Manager;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( !trait_exists( 'Manage_Enqueue' ) ) {
    trait Manage_Enqueue {
      
        /**
         * Droit Elementor Front Scripts
         * @return string
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_frontend_scripts() {
            
            $min_suffix = Droit_Utils::droit_addons_script_debug_enabled() ? '.' : '.min';
            wp_register_style(
                "droit-animate",
                droit_addons_protocol( '/assets/vendor/animation/animate.min.css' ),
                [],
                Droit_Utils::droit_addons_el_new_version()
            );
            wp_register_style(
                "reset",
                droit_addons_protocol( '/assets/vendor/reset.min.css' ),
                [],
                Droit_Utils::droit_addons_el_new_version()
            );
            wp_register_style(
                "grid",
                droit_addons_protocol( '/assets/vendor/grid.min.css' ),
                [],
                Droit_Utils::droit_addons_el_new_version()
            );

            wp_register_style(
                "button",
                droit_addons_protocol( '/assets/vendor/button.min.css' ),
                [],
                Droit_Utils::droit_addons_el_new_version()
            );
             //Owl Carousel
            wp_register_style(
                "owl-carousel",
                droit_addons_protocol( '/assets/vendor/owl_carousel/css/owl.carousel.css' ),
                [],
                Droit_Utils::droit_addons_el_new_version()
            );

            wp_register_script(
                "owl-carousel",
                droit_addons_protocol( '/assets/vendor/owl_carousel/js/owl.carousel.min.js' ),
                ['jquery'],
                Droit_Utils::droit_addons_el_new_version(),
                true
            );
            //Swiper Carousel

            wp_register_style(
                "swiper-carousel",
                droit_addons_protocol( '/assets/vendor/swiper/swiper.min.css' ),
                [],
                Droit_Utils::droit_addons_el_new_version()
            );

            wp_register_script(
                "swiper-carousel",
                droit_addons_protocol( '/assets/vendor/swiper/swiper.min.js' ),
                ['jquery'],
                Droit_Utils::droit_addons_el_new_version(),
                true
            );

            wp_register_script(
                "jquery-parallax-move",
                droit_addons_protocol( '/assets/vendor/parallax/parallax_move.js' ),
                ['jquery'],
                Droit_Utils::droit_addons_el_new_version(),
                true
            );

            wp_register_script(
                "jquery-parallax",
                droit_addons_protocol( '/assets/vendor/parallax/jquery.parallax-scroll.js' ),
                ['jquery'],
                Droit_Utils::droit_addons_el_new_version(),
                true
            );
            
            //Isotop
            
            wp_register_script(
                "jquery-isotope",
                droit_addons_protocol( '/assets/vendor/isotop/isotope.pkgd.min.js' ),
                ['jquery'],
                Droit_Utils::droit_addons_el_new_version(),
                true
            );
            
            wp_register_script(
                "isotope-mode",
                droit_addons_protocol( '/assets/vendor/isotop/packery-mode.pkgd.min.js' ),
                ['jquery'],
                Droit_Utils::droit_addons_el_new_version(),
                true
            );
            wp_register_script(
                "jquery-masonary",
                droit_addons_protocol( '/assets/vendor/masonry/masonry_grid.js' ),
                ['jquery'],
                Droit_Utils::droit_addons_el_new_version(),
                true
            );
            wp_register_script(
                "countdown-jquery",
                droit_addons_protocol( '/assets/vendor/countdown/countdown.min.js' ),
                ['jquery'],
                Droit_Utils::droit_addons_el_new_version(),
                true
            );
            wp_register_script(
                "dl-goodshare",
                droit_addons_protocol( '/assets/vendor/goodshare/goodshare.min.js' ),
                ['jquery'],
                Droit_Utils::droit_addons_el_new_version(),
                true
            );
           
            // Animated Text
            
             wp_register_script(
                "animated_text",
                droit_addons_protocol( '/assets/vendor/animation/animated_heading.js' ),
                ['jquery'],
                Droit_Utils::droit_addons_el_new_version(),
                true
            );

            //editor

            wp_enqueue_style(
                "droit-editor-animation", 
                droit_addons_protocol( '/assets/vendor/animation/animate.min.css' ),
                 [ 'elementor-editor' ],
                  Droit_Utils::droit_addons_el_new_version() 
            );
            
            wp_register_style(
                'droit-addons-enqueue',
                 droit_addons_protocol( 'assets/vendor/editor/main.min.css' ),
                ['elementor-frontend'],
                Droit_Utils::droit_addons_el_new_version()
            );

            wp_register_script(
                "droit-addons-enqueue",
                droit_addons_protocol( '/assets/js/droit-addons.js' ),
               ['imagesloaded', 'jquery'],
                Droit_Utils::droit_addons_el_new_version(),
                true
            );   
        }
        /**
         * Droit Elementor Editor Common Scripts
         * @return string
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
         public static function droit_addons_editor_common_scripts() {

            $min_suffix = Droit_Utils::droit_addons_script_debug_enabled() ? '.' : '.min';
            //style
            wp_enqueue_style( 
                "droit-icons",
                 droit_addons_protocol( '/assets/plugins/css/icons.min.css' ), 
                 [ 'elementor-editor' ], 
                 Droit_Utils::droit_addons_el_new_version() 
             );
            wp_enqueue_style( 
                "droit-common", 
                droit_addons_protocol( '/assets/plugins/css/editor-common.css' ), 
                [ 'elementor-editor' ], 
                Droit_Utils::droit_addons_el_new_version() 
            );
            wp_enqueue_style( 
                "droit-widget", 
                droit_addons_protocol( '/assets/plugins/css/widget.min.css' ), 
                [ 'elementor-editor' ], 
                Droit_Utils::droit_addons_el_new_version() 
            );
            wp_enqueue_style(
                "droit-animate",
                droit_addons_protocol( '/assets/vendor/animation/animate.min.css' ),
               [ 'elementor-editor' ],
                Droit_Utils::droit_addons_el_new_version()
            );
            wp_enqueue_style(
                "reset",
                droit_addons_protocol( '/assets/vendor/reset.min.css' ),
               [ 'elementor-editor' ],
                Droit_Utils::droit_addons_el_new_version()
            );
            wp_enqueue_style(
                "grid",
                droit_addons_protocol( '/assets/vendor/grid.min.css' ),
               [ 'elementor-editor' ],
                Droit_Utils::droit_addons_el_new_version()
            );

            wp_enqueue_style(
                "button",
                droit_addons_protocol( '/assets/vendor/button.min.css' ),
               [ 'elementor-editor' ],
                Droit_Utils::droit_addons_el_new_version()
            );
        }

        /**
         * Droit Elementor Cache Manage
         * @param Post_CSS $file
         * @return string
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */

        public static function droit_enqueue_manage_cache( Post_CSS $file )
        {
            if (get_queried_object_id() !== $file->get_post_id()) {
                if ( Manager::droit_cache_enqueue_has( $file->get_post_id() ) ) {
                    Manager::droit_enqueue_cache( $file->get_post_id() );
                } else {
                    Manager::droit_none_of_cache();
                }
            }
        }
        /**
         * Droit Elementor Cache Enqueue
         * @param Post_CSS $file
         * @return string
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_frontend_cache_enqueue(){
            if ( ! is_singular() ) {
                 return;
            }
            if ( Manager::droit_cache_enqueue_has( get_the_ID() ) ) {
                Manager::droit_enqueue_cache( get_the_ID() );
            } else {
                Manager::droit_none_of_cache();
            }         
        }

        
        /**
         * Droit Elementor Editor Scripts
         * @return string
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_editor_scripts() {

            $min_suffix = Droit_Utils::droit_addons_script_debug_enabled() ? '.' : '.min';
            //style
            wp_enqueue_style( 
                "droit-icons",
                 droit_addons_protocol( '/assets/plugins/css/icons.min.css' ), 
                 [ 'elementor-editor' ], 
                 Droit_Utils::droit_addons_el_new_version() 
             );
            wp_enqueue_style( 
                "droit-common", 
                droit_addons_protocol( '/assets/plugins/css/editor-common.css' ), 
                [ 'elementor-editor' ], 
                Droit_Utils::droit_addons_el_new_version() 
            );
            wp_enqueue_style( 
                "droit-widget", 
                droit_addons_protocol( '/assets/plugins/css/widget.min.css' ), 
                [ 'elementor-editor' ], 
                Droit_Utils::droit_addons_el_new_version() 
            );
        }

        /**
         * Droit Elementor Editor Pro Widget
         * @return string
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_pro_demo_editor_scripts() {
            //script
            wp_enqueue_script( "demo-widget", droit_addons_protocol( '/assets/plugins/js/widget.min.js' ), ['jquery'], Droit_Utils::droit_addons_el_new_version(), true );

            $localized_settings = [
                'version'        => Droit_Utils::droit_addons_el_new_version(),
                'droit_site'     => Droit_Utils::droit_addons_site_link(),
                'assets_url'     => DROIT_EL_ADDONS_ASSETS_URL,
                'i18n'           => [
                    'promotion_header'  => esc_html__( '%s Widget', 'droit-elementor-addons' ),
                    'promotion_message' => esc_html__( 'Uses %s and many more awesome widgets & features to easily build your site like a speedster.', 'droit-elementor-addons' ),
                    'see_it_in_actions' => esc_html__( 'Droit Action', 'droit-elementor-addons' ),
                ],

                'droit_pro_url'  => Droit_Utils::droit_addons_pro_link(),
                'droit_demo_url' => Droit_Utils::droit_addons_demo_link(),
                'droit_doc_url' =>  Droit_Utils::droit_addons_doc_link(),
                'has_pro'        => Droit_Utils::droit_addons_has_pro(),
                'pro_elements'   => [],
            ];
            if ( !Droit_Utils::droit_addons_has_pro() && current_user_can( 'manage_options' ) ) {
                $localized_settings['pro_elements'] = Elements::droit_addons_widget_map_pro();
            }
            wp_localize_script(
                'demo-widget',
                'DroitEditorPanel',
                $localized_settings
            );
        }
    }
}