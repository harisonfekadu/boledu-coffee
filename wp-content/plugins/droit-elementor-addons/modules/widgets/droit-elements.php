<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR;
use \DROIT_ELEMENTOR\Utils as Droit_Utils;
use \Elementor\Element_Base;

if ( !defined( 'ABSPATH' ) ) {exit;}

if ( !class_exists( 'Droit_Elements' ) ) {
    class Droit_Elements {
        
        /**
         * Constructor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function __construct() {
            add_action( 'elementor/elements/categories_registered', [$this, 'droit_categories'] );
            add_action( 'elementor/widgets/widgets_registered', [$this, 'droit_addons_registered'] );
            add_action( 'elementor/frontend/before_render', [__CLASS__, 'droit_add_widget_render_attributes'] );
        }
        
        /**
         * Droit Global render attributes
         * @return string
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_add_widget_render_attributes( Element_Base $widget ) {
            if ( $widget->get_data( 'widgetType' ) === 'global' && method_exists( $widget, 'get_original_element_instance' ) ) {
                $original_instance = $widget->get_original_element_instance();
                if ( method_exists( $original_instance, 'get_html_wrapper_class' ) && strpos( $original_instance->get_data( 'widgetType' ), 'droit-' ) !== false ) {
                    $widget->add_render_attribute( '_wrapper', [
                        'class' => $original_instance->get_html_wrapper_class(),
                    ] );
                }
            }
        }

        /**
         * Droit Elementor Free Widgets
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_widget_map_free() {
            $elements = [
                '_content'         => [
                    '_heading' => __( 'Content Elements', 'droit-elementor-addons' ),
                    'elements' => [
                        [
                            '_key'        => 'accordion',
                            '_title'      => __( 'Accordion', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-accordian',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['accordion'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => [],
                            ],
                        ],
                        [
                            '_key'        => 'alert',
                            '_title'      => __( 'Alert', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-alert',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['alert'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => [],
                            ],
                        ],
                        [
                            '_key'        => 'animated_text',
                            '_title'      => __( 'Animated Text', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-animated-title',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['animated_text'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => ['animated_text'],
                            ],
                        ],
                        [
                            '_key'        => 'banner',
                            '_title'      => __( 'Banner', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-banner',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['banner'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => [],
                            ],
                        ],
                        [
                            '_key'        => 'blog',
                            '_title'      => __( 'Blog', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-blog-post',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['blog'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => ['imagesloaded', 'jquery-isotope', 'isotope-mode', 'jquery-masonary'],
                            ],
                        ],
                        [
                            '_key'        => 'bloglist',
                            '_title'      => __( 'Blog List', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-blog',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['bloglist'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => [],
                            ],
                        ],
                        [
                            '_key'        => 'card',
                            '_title'      => __( 'Card', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-card',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['card'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => ['jquery-parallax-move']
                            ],
                        ],
                        [
                            '_key'        => 'countdown',
                            '_title'      => __( 'Countdown', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-countdown',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['countdown'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => ['countdown-jquery']
                            ],
                        ],
                        [
                            '_key'        => 'contact_form_7',
                            '_title'      => __( 'Contact Form 7', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-contact-form',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['contact_form_7'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => []
                            ],
                        ],
                        [
                            '_key'        => 'faq',
                            '_title'      => __( 'Faq', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-faq',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['faq'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => []
                            ],
                        ],
                        [
                            '_key'        => 'infobox',
                            '_title'      => __( 'Info Box', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-inforbox icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['infobox'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => [],
                            ],
                        ],
                        [
                            '_key'        => 'iconbox',
                            '_title'      => __( 'Icon Box', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-iconbox',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['iconbox'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => [],
                            ],
                        ], 
                        [
                            '_key'        => 'image_carousel',
                            '_title'      => __( 'Image Carousel', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-image-carosel',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['image_carousel'],
                            'js'      => [],
                            'vendor' => [
                                'css' => ['swiper-carousel'],
                                'js'  => ['swiper-carousel']
                            ],
                        ],
                        [
                            '_key'        => 'newstricker',
                            '_title'      => __( 'News Sticker', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-newsticky',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['newstricker'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => [],
                            ],
                        ], 
                        [
                            '_key'        => 'pricing',
                            '_title'      => __( 'Pricing', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-pricing-Table',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['pricing'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => []
                            ],
                        ], 
                        [
                            '_key'        => 'process',
                            '_title'      => __( 'Process Bar', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-process',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['process'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => []
                            ],
                        ],
                        [
                            '_key'        => 'share_buttons',
                            '_title'      => __( 'Share Button', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-social-share',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['share_buttons'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => ['dl-goodshare']
                            ],
                        ],
                        [
                            '_key'        => 'tab',
                            '_title'      => __( 'Tab', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-Tab',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['tab'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => []
                            ],
                        ],
                        [
                            '_key'        => 'team',
                            '_title'      => __( 'Team Member', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-Team',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['team'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => []
                            ],
                        ],
                        [
                            '_key'        => 'testimonial',
                            '_title'      => __( 'Testimonial', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-quote',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['testimonial'],
                            'js'      => [],
                            'vendor' => [
                                'css' => ['swiper-carousel'],
                                'js'  => ['swiper-carousel', 'jquery-parallax-move', 'jquery-parallax']
                            ],
                        ],
                        [
                            '_key'        => 'timeline',
                            '_title'      => __( 'Timeline', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-timeline',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['timeline'],
                            'js'      => [],
                            'vendor' => [
                                'css' => ['owl-carousel'],
                                'js'  => ['owl-carousel'],
                            ],
                        ],
                        [
                            '_key'        => 'twitter_feed',
                            '_title'      => __( 'Twitter Feed', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-social-share',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['twitter_feed'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => [],
                            ],
                        ],
                        [
                            '_key'        => 'table',
                            '_title'      => __( 'Table', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-table',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['table'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => [],
                            ],
                        ],
                        [
                            '_key'        => 'title',
                            '_title'      => __( 'Title', 'droit-elementor-addons' ),
                            '_icon'       => 'eicon-post-title',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => false,
                            'css'     => ['title'],
                            'js'      => [],
                            'vendor' => [
                                'css' => [],
                                'js'  => [],
                            ],
                        ],
                    ],
                ],
            ];
            return $elements;
        }
        /**
         * Droit Elementor Pro Widgets
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_widget_map_pro() {
          $elements = [
                '_pro_content' => [
                    '_heading' => __( 'Pro Elements', 'droit-elementor-addons' ),
                    'elements' => [
                        [
                            '_key'        => 'accordionpro',
                            '_title'      => __( 'Accordion', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-accordian addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'alertpro',
                            '_title'      => __( 'Alert', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-alert addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'animated_textpro',
                            '_title'      => __( 'Animated Text', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-animated-title addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'bannerpro',
                            '_title'      => __( 'Banner', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-banner addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'blogpro',
                            '_title'      => __( 'Blog', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-blog addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'bloglistpro',
                            '_title'      => __( 'Blog List', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-blog-post addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'cardpro',
                            '_title'      => __( 'Card', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-card addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'countdownpro',
                            '_title'      => __( 'Countdown', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-countdown addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'contact_Form_7pro',
                            '_title'      => __( 'Contact Form 7', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-contact-form addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'faqpro',
                            '_title'      => __( 'Faq', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-faq addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'infoboxpro',
                            '_title'      => __( 'Info Box', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-inforbox addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        
                        [
                            '_key'        => 'iconboxpro',
                            '_title'      => __( 'Icon Box', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-iconbox addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'image_carouselpro',
                            '_title'      => __( 'Image Carousel', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-image-carosel addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'newstrickerpro',
                            '_title'      => __( 'News Ticker', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-newsticky addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'pricingpro',
                            '_title'      => __( 'Pricing', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-pricing-Table addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'processpro',
                            '_title'      => __( 'Process Bar', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-process addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        
                        [
                            '_key'        => 'share_buttonspro',
                            '_title'      => __( 'Share Button', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-social-share addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'tabpro',
                            '_title'      => __( 'Tab', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-Tab addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        
                        [
                            '_key'        => 'teampro',
                            '_title'      => __( 'Team Member', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-Team addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'testimonialpro',
                            '_title'      => __( 'Testimonial', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-quote addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'timelinepro',
                            '_title'      => __( 'Timeline', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-timeline addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'twitter_Feedpro',
                            '_title'      => __( 'Twitter Feed', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-social-share addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        [
                            '_key'        => 'tablepro',
                            '_title'      => __( 'Table', 'droit-elementor-addons' ),
                            '_icon'       => 'dlicons-Tab addons-icon',
                            '_icon_class' => 'icon_bg_color',
                            '_demo_url'   => \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(),
                            '_droit_pro'  => true,
                            '_category'   => 'droit_addons_pro',
                        ],
                        
                    ],
                ],
            ];
            return $elements;
        }
        /**
         * Droit Elementor Widgets Marge
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_widget_map() {
            $local_widgets_free = self::droit_addons_widget_map_free();
            $local_widgets_pro = [];
            if ( !Droit_Utils::droit_addons_has_pro() && current_user_can( 'manage_options' ) ) {
                $local_widgets_pro = self::droit_addons_widget_map_pro();
            }
            $local_widgets_free = array_merge( $local_widgets_free, $local_widgets_pro );
            return apply_filters( 'add_droit_elementor_addons', $local_widgets_free );
        }

        /**
         * Droit Elementor Cache Widgets
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_cache_widgets_map(){
             $elements_map = self::droit_addons_widget_map();
             foreach ($elements_map as $elements){
                $items_key = [];
                foreach ($elements['elements'] as $_key => $element){
                    $items_key[$element['_key']] =  $element;
                }
              return $items_key;
             }
        }
        
        /**
         * Droit Elementor Cache Base Widgets Key
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_get_cache_base_widget_key() {
           return apply_filters( 'droitaddons_droit_get_cache_base_widget_key', '_addons_base' );
        }

        /**
         * Droit Elementor Cache Widgets Maps
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_get_cache_widgets_map() {
            $widgets_map = [
                self::droit_get_cache_base_widget_key() => [
                    'css' => [],
                    'js' => [],
                    'vendor' => [
                        'js' => ['anime'],
                        'css' => ['droit-icons', 'reset', 'grid', 'button', 'droit-animate'],
                    ]
                ],
            ];

            $local_widgets_map = self::droit_cache_widgets_map();
            $widgets_map = array_merge( $widgets_map, $local_widgets_map );
            return apply_filters( 'droit_pro_cache_widgets_map', $widgets_map );
        }

        /**
         * Droit Elementor categories
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_categories() {

            \Elementor\Plugin::$instance->elements_manager->add_category(
                'droit_addons',
                [
                    'title' => esc_html__( 'DROIT ADDONS', 'droit-elementor-addons' ),
                    'icon'  => 'fa fa-plug',
                ]
            );
            \Elementor\Plugin::$instance->elements_manager->add_category(
                'droit_addons_pro',
                [
                    'title' => esc_html__( 'DROIT PRO', 'droit-elementor-addons' ),
                    'icon'  => 'fa fa-plug',
                ]
            );
        }
        /**
         * Droit Elementor Shortcode
         * @return string
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_addons_registered( $widgets_manager ) {
    
            $active_widgets = \DROIT_ELEMENTOR\Utils::droit_get_options('widgets');

            if ( !empty( $active_widgets ) ) {
                foreach ( $active_widgets as $_key ) {
                    $_key_name = str_replace(['_', ' ', '__'], '-', $_key);

                    $widgets_file = DROIT_EL_ADDONS_DIR_PATH . 'modules/widgets/' . $_key_name . '/' . strtolower($_key_name) . '.php';

                    if ( !is_readable( $widgets_file) ) { 
                        continue;
                    }
                    // load widgets files
                    include_once($widgets_file);
                    // get class name for widgets
                    $class_name = Droit_Utils::droit_addons_widget_classname( $_key );
                    if ( class_exists( $class_name ) ) {
                        $widgets_manager->register_widget_type( new $class_name() );
                    }              
                }
            }
        }
    }
}