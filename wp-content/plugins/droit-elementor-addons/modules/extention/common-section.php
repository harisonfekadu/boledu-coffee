<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR\Module\Extention;

use DROIT_ELEMENTOR\Utils as Droit_Utils;
use Elementor\Controls_Manager;
use Elementor\Element_Base;
use DROIT_ELEMENTOR\Module\Controls\Droit_Control as Droit_Control_Manager;

defined('ABSPATH') || die();

if (!class_exists('Common_Section')) {
    class Common_Section
    {

        /**
         * Constructor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function __construct()
        {
            if (!Droit_Utils::droit_addons_has_pro()) {
                add_action('elementor/element/column/section_advanced/after_section_end', [__CLASS__, 'section_pro'], 1);
                add_action('elementor/element/section/section_advanced/after_section_end', [__CLASS__, 'section_pro'], 1);
                add_action('elementor/element/common/_section_style/after_section_end', [__CLASS__, 'section_pro'], 1);
            }
            add_action('elementor/element/column/section_advanced/after_section_end', [__CLASS__, 'droit_controls_section'], 1);
            add_action('elementor/element/section/section_advanced/after_section_end', [__CLASS__, 'droit_controls_section'], 1);
            add_action('elementor/element/common/_section_style/after_section_end', [__CLASS__, 'droit_controls_section'], 1);

            add_action('elementor/frontend/before_render', [__CLASS__, 'droit_section_render'], 1);

        }
        /**
         * Droit Elementor Section
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_controls_section(Element_Base $el)
        {
            $tabs = Controls_Manager::TAB_CONTENT;

            if ('section' === $el->get_name() || 'column' === $el->get_name()) {
                $tabs = Controls_Manager::TAB_LAYOUT;
            }

            $el->start_controls_section(
                '_section_wrapper_link',
                [
                    'label' => __('Section Link', 'droit-elementor-addons') . _droit_get_icon(),
                    'tab'   => $tabs,
                ]
            );

            $el->add_control(
                'droit_section_link',
                [
                    'label'       => __('Link', 'droit-elementor-addons'),
                    'type'        => Controls_Manager::URL,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'placeholder' => 'https://droitthemes.com',
                ]
            );

            $el->end_controls_section();
        }
        /**
         * Droit Elementor Section Render
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_section_render(Element_Base $el)
        {
            $settings = $el->get_settings_for_display();
            $dl_link  = $settings['droit_section_link'];

            if ($dl_link && !empty($dl_link['url'])) {
                $el->add_render_attribute(
                    '_wrapper',
                    [
                        'data-section-link' => json_encode($dl_link),
                        'style'             => 'cursor: pointer',
                    ]
                );
            }
        }
        /**
         * Droit Elementor Section Pro Message
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_editor_section_pro_message($texts)
        {
            $html = '<div class="droit-pro-box">
                <div class="droit-pro-icon">
                    <i class="dl dl-home"></i>
                </div>
                <div class="droit-pro-box-title">' . $texts['title'] . '</div>
                <div class="droit-pro-box-message">' . $texts['messages'] . '</div>
                <a class="droit-pro-box-link elementor-button elementor-button-default" href="' . Droit_Utils::droit_addons_pro_link() . '" target="_blank">
                ' . __('Upgrade Droit Addons', 'droit-elementor-addons') . '
                </a>
            </div>';

            return $html;
        }
        public static function section_pro(Element_Base $el)
        {
            $tabs = Controls_Manager::TAB_CONTENT;

            if ('section' === $el->get_name() || 'column' === $el->get_name()) {
                $tabs = Controls_Manager::TAB_LAYOUT;
            }
            $el->start_controls_section(
                'section_pro_section',
                [
                    'label' => __('Premium Features', 'droit-elementor-addons')._droit_get_icon(), 
                    'tab'   => $tabs,
                ]
            );

            $el->add_control(
                'section_pro_pro_required',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw'  => Droit_Control_Manager::droit_information_control([
                        'icon'     => DROIT_EL_ADDONS_IMAGE. "pro_icon.svg",
                        'title'    => __('Go Premium with Droit Pro', 'droit-elementor-addons'),
                        'messages' => __('Enjoy additional and exclusive features to create a stunning website with premium Droit Pro', 'droit-elementor-addons'),
                        'btn_text'    => __('Get Premium Version', 'droit-elementor-addons'),
                        'btn_url'    => Droit_Utils::droit_addons_pro_link(),
                    ]),
                ]
            );

            $el->end_controls_section();
        }
    
    }
}
