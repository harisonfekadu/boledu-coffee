<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR;
use DROIT_ELEMENTOR\Droit_Elements as Elements;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if (!class_exists('Init')) {
    class Init
    {
        use Traits\Enqueue;
        use Traits\Manage_Enqueue;
        use Traits\Notice;

        /**
         * Constructor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function __construct()
        {

            add_filter("plugin_action_links_" . DROIT_EL_ADDONS_BASE, [$this, 'droit_addons_settings_link']);
            if (is_admin()) {
                add_action('admin_enqueue_scripts', [__CLASS__, 'droit_addons_gloabl_script']);
                add_action('admin_enqueue_scripts', array( __CLASS__, 'droit_addons_admin_style' ) );
            }

            if (is_admin() && !empty($_GET["page"]) && ($_GET["page"] == "droit-addons") || (isset($_GET['page']) && $_GET['page'] == 'droit-pro') || (isset($_GET['page']) && $_GET['page'] == 'droit-addons-upgrade')) {
                add_action('admin_enqueue_scripts', [__CLASS__, 'droit_addons_dashboard_script']);
                add_action('admin_head', [__CLASS__, 'droit_remove_wp_notice']);
            }

            add_action('wp_enqueue_scripts', [__CLASS__, 'droit_addons_frontend_scripts']);
            add_action('wp_enqueue_scripts', [__CLASS__, 'droit_frontend_cache_enqueue'], 99);
            add_action('elementor/css-file/post/enqueue', [__CLASS__, 'droit_enqueue_manage_cache']);

            add_action('elementor/editor/after_enqueue_scripts', [__CLASS__, 'droit_addons_editor_scripts']);
            add_action( 'wp_enqueue_scripts', [ __CLASS__, 'droit_addons_editor_common_scripts' ], 999999 );
            if (!\DROIT_ELEMENTOR\Utils::droit_addons_has_pro()) {
                add_action('elementor/editor/footer', [__CLASS__, 'droit_pro_editor_notice']);
            }

            $widget_key = \DROIT_ELEMENTOR\Utils::droit_get_options('widgets');
            if (!empty($widget_key)) {
                add_action('elementor/editor/after_enqueue_scripts', [__CLASS__, 'droit_addons_pro_demo_editor_scripts']);
            }
 
        }
        
        /**
         * Setting Link
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_addons_settings_link($links)
        {
            $settings_link = sprintf('<a href="%1$s" class="droit-setting-links">%2$s</a>', esc_url(\DROIT_ELEMENTOR\Utils::droit_addons_setting_link()), __('Settings', 'droit-elementor-addons'));

            array_push($links, $settings_link);
            if (array_key_exists('deactivate', $links)) {
                $links['deactivate'] = str_replace('<a', '<a class="droit-elementor-deactivate-link"', $links['deactivate']);
            }

            if (!\DROIT_ELEMENTOR\Utils::droit_addons_has_pro()) {
                $pro_link = sprintf('<a href="%1$s" target="_blank" class="droit-gopro" style="color:#d30c5c; font-weight: bold;">%2$s</a>', \DROIT_ELEMENTOR\Utils::droit_addons_pro_link(), __('Pro', 'droit-elementor-addons'));
                array_push($links, $pro_link);
            }
            $demo_link = sprintf('<a href="%1$s" target="_blank" class="droit-setting-links">%2$s</a>', \DROIT_ELEMENTOR\Utils::droit_addons_demo_link(), __('Demo', 'droit-elementor-addons'));

            array_push($links, $demo_link);

            return $links;
        }
        /**
         * Remove all notice
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_remove_wp_notice(){
            remove_all_actions('admin_notices');
        }
    }
}
