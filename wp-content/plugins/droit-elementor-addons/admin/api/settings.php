<?php 
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR;

defined('ABSPATH') || die();

if (!class_exists('Settings')) {
    class Settings
    {
        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public $droit_admin_pages = array();

        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public $droit_sub_pages = array();

        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public $droit_settings = array();

        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public $droit_sections = array();

        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public $droit_fields = array();

        /**
         * Constructor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function __construct()
        {
            if ( ! empty($this->droit_admin_pages) || ! empty($this->droit_sub_pages) ) {
                add_action( 'admin_menu', array( $this, 'droit_add_admin_menu' ) );
            }

            if ( !empty($this->droit_settings) ) {
                add_action( 'admin_init', array( $this, 'droit_register_custom_fields' ) );
            }
        }

        /**
         * Droit Elementor Admin Menu Pages
         * @return pages array
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_add_pages( array $pages )
        {
            $this->droit_admin_pages = $pages;

            return $this;
        }

        /**
         * Droit Elementor Admin Sub Pages
         * @return pages array
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_with_sub_pages( string $title = null ) 
        {
            if ( empty($this->droit_admin_pages) ) {
                return $this;
            }

            $admin_page = $this->droit_admin_pages[0];

            $subpage = array(
                array(
                    'parent_slug' => $admin_page['menu_slug'], 
                    'page_title' => $admin_page['page_title'], 
                    'menu_title' => ($title) ? $title : $admin_page['menu_title'], 
                    'capability' => $admin_page['capability'], 
                    'menu_slug' => $admin_page['menu_slug'], 
                    'callback' => $admin_page['callback']
                )
            );

            $this->droit_sub_pages = $subpage;

            return $this;
        }

        /**
         * Droit Elementor Add Sub Pages
         * @return pages array
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_add_sub_pages( array $pages )
        {
            $this->droit_sub_pages = array_merge( $this->droit_sub_pages, $pages );

            return $this;
        }

        /**
         * Droit Elementor Admin Menu
         * @return pages array
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_add_admin_menu()
        {
            foreach ( $this->droit_admin_pages as $page ) {
                add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
            }

            foreach ( $this->droit_sub_pages as $page ) {
                add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] );
            }
        }

        /**
         * Droit Elementor Admin Settings
         * @return pages array
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_set_settings( array $settings )
        {
            $this->droit_settings = $settings;

            return $this;
        }

        /**
         * Droit Elementor Admin Section
         * @return pages array
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_set_sections( array $sections )
        {
            $this->droit_sections = $sections;

            return $this;
        }

        /**
         * Droit Elementor Admin Fields
         * @return pages array
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_set_fields( array $fields )
        {
            $this->droit_fields = $fields;

            return $this;
        }

        /**
         * Droit Elementor Admin Register Fields
         * @return pages array
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_register_custom_fields()
        {
            // register setting
            foreach ( $this->droit_settings as $setting ) {
                register_setting( $setting["option_group"], $setting["option_name"], ( isset( $setting["callback"] ) ? $setting["callback"] : '' ) );
            }

            // add settings section
            foreach ( $this->droit_sections as $section ) {
                add_settings_section( $section["id"], $section["title"], ( isset( $section["callback"] ) ? $section["callback"] : '' ), $section["page"] );
            }

            // add settings field
            foreach ( $this->droit_fields as $field ) {
                add_settings_field( $field["id"], $field["title"], ( isset( $field["callback"] ) ? $field["callback"] : '' ), $field["page"], $field["section"], ( isset( $field["args"] ) ? $field["args"] : '' ) );
            }
        }
    }
}