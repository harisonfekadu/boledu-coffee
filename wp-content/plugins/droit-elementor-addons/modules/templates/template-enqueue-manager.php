<?php
/**
 * @package droitElementorTemplate
 * @developer DroitLab Team
 *
 */

namespace DROIT_ELEMENTOR\Templates;
use DROIT_ELEMENTOR\Utils as Droit_Utils;

if ( ! defined( 'ABSPATH' ) ) {exit;}

class Template_Enqueue_Manager{
    public $notice;
    /**
     * Constructor
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    public function __construct(){
        $this->init_hooks();
    }

    /**
     * Action hooks
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    public function init_hooks(){
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'dl_template_front_script_load' ] );
        add_action( 'elementor/editor/after_enqueue_scripts', [ __CLASS__, 'dl_template_script_load' ] );
        add_action( 'elementor/preview/enqueue_styles', [ __CLASS__, 'enqueue_preview_styles' ] );
    }
    public static function dl_template_front_script_load() {
        
        //editor
        wp_register_style(
            'droit-el-template-front',
             droit_addons_protocol( '/assets/css/template-frontend.min.css' ),
            ['elementor-frontend'],
            Droit_Utils::droit_addons_el_new_version()
        );
        wp_enqueue_style( 'droit-el-template-front' );  
    }

     public static function dl_template_script_load() {
        
        //editor
        wp_register_style(
            'droit-el-template-editor',
             droit_addons_protocol( '/assets/css/template-library.min.css' ),
            ['elementor-editor'],
            Droit_Utils::droit_addons_el_new_version()
        );
        
        wp_enqueue_style( 'droit-el-template-editor' );  

        wp_enqueue_script(
            'droit-el-template-editor',
             droit_addons_protocol( '/assets/js/template-library.min.js' ),
            ['elementor-editor'],
            Droit_Utils::droit_addons_el_new_version(),
            true
        );
       

        $localize_data = [
            'hasPro'                    => false,
            'templateLogo'                    => DROIT_EL_ADDONS_IMAGE . 'template_logo.svg',
            'i18n' => [
                'templatesEmptyTitle'       => esc_html__( 'No Templates Found', 'droit-elementor-addons' ),
                'templatesEmptyMessage'     => esc_html__( 'Try different category or sync for new templates.', 'droit-elementor-addons' ),
                'templatesNoResultsTitle'   => esc_html__( 'No Results Found', 'droit-elementor-addons' ),
                'templatesNoResultsMessage' => esc_html__( 'Please make sure your search is spelled correctly or try a different words.', 'droit-elementor-addons' ),
            ],
        ];
        wp_localize_script(
            'droit-el-template-editor',
            'templateEditor',
            $localize_data
        );
    }

    public static function enqueue_preview_styles() {
        $data = '
        .elementor-add-new-section .elementor-add-lite-button {
            background-color: #6045bc;
            margin-left: 5px;
            font-size: 18px;
            vertical-align: bottom;
        }
        ';
        wp_add_inline_style( 'droit-el-template-front', $data );

    }
}