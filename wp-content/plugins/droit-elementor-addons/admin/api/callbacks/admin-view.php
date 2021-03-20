<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR;

defined('ABSPATH') || die();

if (!class_exists('Admin_View')) {
    class Admin_View
    {
        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_el_addons_main_page()
        {
            require_once DROIT_EL_ADDONS_DIR_PATH . 'views/dashboard.php';
        }
        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_el_addons_pro_page()
        {
            require_once DROIT_EL_ADDONS_DIR_PATH . 'views/pro_page.php';
        }

        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_el_addons_upgrade_page()
        {
            require_once DROIT_EL_ADDONS_DIR_PATH . 'views/upgrade.php';
        }

    }
}
