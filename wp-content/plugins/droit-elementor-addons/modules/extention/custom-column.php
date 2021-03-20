<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR\Module\Extention;

use Elementor\Controls_Manager;
use Elementor\Element_Column;

defined('ABSPATH') || die();

if (!class_exists('Custom_Column')) {
    class Custom_Column
    {

        /**
         * Constructor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function __construct()
        {
            add_action( 'elementor/element/column/layout/before_section_end', [ __CLASS__, '_droit_custom_column_control' ] );

        }

        public static function _droit_custom_column_control( Element_Column $el ) {
        $el->add_responsive_control(
            '_droit_column_custom_width',
            [
                'label' => __( 'Custom Width', 'droit-elementor-addons' ),
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
                'label_block' => true,
                'description' => __( 'Set custom column width. (E.g 500px, 100%, calc(100% - 300px))', 'droit-elementor-addons' ),
                'selectors' => [
                    '{{WRAPPER}}.elementor-column' => 'width: {{VALUE}};',
                ],
            ]
        );

        $el->add_responsive_control(
            '_droit_column_custom_order',
            [
                'label' => __( 'Column Order', 'droit-elementor-addons' ),
                'type' => Controls_Manager::NUMBER,
                'style_transfer' => true,
                'description' => sprintf(
                    __( 'Column ordering for responsive design. You can learn more about CSS order property from %sMDN%s.', 'droit-elementor-addons' ),
                    '<a
href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Flexible_Box_Layout/Ordering_Flex_Items#The_order_property" target="_blank">',
                    '</a>'
                ),
                'selectors' => [
                    '{{WRAPPER}}.elementor-column' => '-webkit-box-ordinal-group: calc({{VALUE}} + 1 ); -ms-flex-order:{{VALUE}}; order: {{VALUE}};',
                ],
            ]
        );
    }
        
    }
}
