<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR;

defined('ABSPATH') || die();

use DROIT_ELEMENTOR\Admin_View as Page_Callbacks;
use DROIT_ELEMENTOR\Settings as Admin_Menu_Settings;

if (!class_exists('Admin_Menu')) {
    class Admin_Menu
    {

        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public $droit_settings;

        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public $droit_callbacks;

        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public $droit_pages = array();

        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public $droit_el_sub_pages = array();

        /**
         * Constructor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function __construct()
        {
            $this->droit_settings = new Admin_Menu_Settings();

            $this->droit_callbacks = new Page_Callbacks();

            $this->droit_el_addons_pages();
            $this->droit_el_addons_sub_pages();

            if (!current_user_can('manage_options')) {
                return;
            }
            $this->droit_settings->droit_add_pages($this->droit_pages)->droit_with_sub_pages('Droit Addons')->__construct();
            $this->droit_settings->droit_add_sub_pages($this->droit_el_sub_pages)->__construct();

            add_action('admin_bar_menu', [ $this, 'droit_el_addons_admin_bar_menu'], 500);
            add_action('admin_bar_menu', [ $this, 'droit_el_addons_follow'], 999);
        }

        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_el_addons_pages()
        {

            $this->droit_pages = array(
                array(
                    'page_title' => __('Droit Elementor Addons', 'droit-elementor-addons'),
                    'menu_title' => __('Droit Addons', 'droit-elementor-addons'),
                    'capability' => 'manage_options',
                    'menu_slug'  => 'droit-addons',
                    'callback'   => array($this->droit_callbacks, 'droit_el_addons_main_page'),
                    'icon_url'   => DROIT_EL_ADDONS_IMAGE . 'd_e_a.png',
                    'position'   => 59,
                ),
            );
        }
        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_el_addons_sub_pages()
        {
            if (!\DROIT_ELEMENTOR\Utils::droit_addons_has_pro()) {
                $this->droit_el_sub_pages = array(
                    array(
                        'parent_slug' => 'droit-addons',
                        'page_title'  => __('Pro is coming soon', 'droit-elementor-addons'),
                        'menu_title'  => __('Subscribe for Pro', 'droit-elementor-addons'),
                        'capability'  => 'manage_options',
                        'menu_slug'   => 'droit-pro',
                        'callback'    => array($this->droit_callbacks, 'droit_el_addons_pro_page'),
                    ),
                );
            }elseif (\DROIT_ELEMENTOR\Utils::droit_addons_has_pro()) {
                $this->droit_el_sub_pages = array(
                    array(
                        'parent_slug' => 'droit-addons',
                        'page_title'  => __('Upgrade Droit Elementor Addons', 'droit-elementor-addons'),
                        'menu_title'  => __('Upgrade', 'droit-elementor-addons'),
                        'capability'  => 'manage_options',
                        'menu_slug'   => 'droit-addons-upgrade',
                        'callback'    => array($this->droit_callbacks, 'droit_el_addons_upgrade_page'),
                    ),
                );
            }
        }

        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_el_addons_admin_bar_menu($droit_admin_bar_menu)
        {
            if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
            $args = array(
                'id'    => 'droit_el_addons',
                'title' => 'Droit Addons',
                'meta'  => [
                    'class' => 'droit-menu-parent-toolbar',
                ],
            );
            $droit_admin_bar_menu->add_node($args);

            $args = array();

            array_push($args, array(
                'id'     => 'droit-widget',
                'title'  => __('Widgets', 'droit-elementor-addons'),
                'href'   => admin_url('admin.php?page=droit-addons'),
                'parent' => 'droit_el_addons',
            ));

            if (!\DROIT_ELEMENTOR\Utils::droit_addons_has_pro()) {
            array_push($args, array(
                'id'     => 'droit-pro',
                'title'  => __('Get Pro', 'droit-elementor-addons'),
                'href'   => admin_url('admin.php?page=droit-pro'),
                'parent' => 'droit_el_addons',
                'meta'   => [
                    'class' => 'droit-menu-toolbar',
                ],
            ));
            }elseif(\DROIT_ELEMENTOR\Utils::droit_addons_has_pro()){
                array_push($args, array(
                'id'     => 'droit-addons-upgrade',
                'title'  => __('Upgrade', 'droit-elementor-addons'),
                'href'   => admin_url('admin.php?page=droit-addons-upgrade'),
                'parent' => 'droit_el_addons',
                'meta'   => [
                    'class' => 'droit-menu-toolbar',
                ],
            ));
            }

            sort($args);

            for ($i = 0; $i < sizeOf($args); $i++) {
                $droit_admin_bar_menu->add_node($args[$i]);
            }
        }
        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_el_addons_follow($droit_admin_bar_social)
        {
            if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

            $args = array(
                'id'    => 'droit_el_addons_follow',
                'title' => 'Follow Droit Addons',
                'meta'  => [
                    'class' => 'droit-social-media',
                ],
            );
            $droit_admin_bar_social->add_node($args);

            $args = array();

            array_push($args, array(
                'id'     => 'droit-twitter',
                'title'  => __('Twitter', 'droit-elementor-addons'),
                'href'   => 'https://twitter.com/droitthemes',
                'parent' => 'droit_el_addons_follow',
                'meta'   => [
                    'class' => 'droit-social-toolbar',
                    'target' => '_blank'
                ],
            ));

            array_push($args, array(
                'id'     => 'droit-youtube',
                'title'  => __('YouTube', 'droit-elementor-addons'),
                'href'   => 'https://www.youtube.com/c/DroitThemes/?sub_confirmation=1',
                'parent' => 'droit_el_addons_follow',
                'meta'   => [
                    'class' => 'droit-social-toolbar',
                    'target' => '_blank'
                ],
            ));

            array_push($args, array(
                'id'     => 'droit-fb',
                'title'  => __('Facebook', 'droit-elementor-addons'),
                'href'   => 'https://www.facebook.com/DroitThemes/',
                'parent' => 'droit_el_addons_follow',
                'meta'   => [
                    'class' => 'droit-social-toolbar',
                    'target' => '_blank'
                ],
            ));

            array_push($args, array(
                'id'     => 'droit-insta',
                'title'  => __('Instagram', 'droit-elementor-addons'),
                'href'   => 'https://www.instagram.com/droitthemes/',
                'parent' => 'droit_el_addons_follow',
                'meta'   => [
                    'class' => 'droit-social-toolbar',
                    'target' => '_blank'
                ],
            ));

            sort($args);

            for ($i = 0; $i < sizeOf($args); $i++) {
                $droit_admin_bar_social->add_node($args[$i]);
            }
        }
    }
}
