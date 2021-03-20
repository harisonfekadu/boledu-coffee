<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR;
use DROIT_ELEMENTOR\Cache\Files;

defined('ABSPATH') || die();
if (!class_exists('Ajax_Manager')) {
    
    class Ajax_Manager {

        const __OPTION_KEY__ = '_key_el_';
        const __SETTING_KEY__ = '_key_el_settings_';
        const __OPTION_FREE__ = 'widgets';
        const __OPTION_DL_EXCLUDE_ROLE_LINK__ = '__dl_exclude_role__';
        /**
         * Constructor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function __construct() {
            add_action('wp_ajax_droit_ajax_widget_action', array($this, 'droit_addons_widget_ajax_callback'));
            add_action('wp_ajax_droit_ajax_clear_cache', array($this, 'droit_addons_clear_cache_callback'));

            add_action('wp_ajax_droit_ajax_api_action', array($this, 'droit_addons_api_ajax_callback'));
        }
        /**
         * Droit Elementor Save Widgets
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_addons_widget_ajax_callback() {
            if (!current_user_can('manage_options')) {
                return;
            }
            global $widget_data;
            $nonce = sanitize_text_field($_POST['security']);
            if (!wp_verify_nonce($nonce, 'droit_widget_ajax_nonce')) {
                die('-1');
            }
            $save_type = $_POST['type'];
            wp_parse_str($_POST['data'], $widget_data);
            unset($widget_data['security']);
            update_option(self::__OPTION_KEY__, $widget_data);
            $this->droit_save_editor_css_cache();
            die('1');
            die();
        }
        /**
         * Droit Elementor Save Api
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_addons_api_ajax_callback() {
            if (!current_user_can('manage_options')) {
                return;
            }
            global $api_data;
            $nonce = sanitize_text_field($_POST['security']);
            if (!wp_verify_nonce($nonce, 'droit_widget_ajax_nonce')) {
                die('-1');
            }
            $save_type = $_POST['type'];
            wp_parse_str($_POST['data'], $api_data);
            unset($api_data['security']);
            update_option(self::__SETTING_KEY__, $api_data);
            die('1');
            die();
        }
        /**
         * Editor css load by enable widget
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected function droit_save_editor_css_cache() {

            $active_widgets = !empty(\DROIT_ELEMENTOR\Utils::droit_get_options('widgets')) ? \DROIT_ELEMENTOR\Utils::droit_get_options('widgets') : [];
           
            $widget_css = '';
            $widget_css_size = 0;
 
            foreach ($active_widgets as $file_name) {
                $widget_key = str_replace(['_', ' ', '__'], '-', $file_name);
                $script_file_name = strtolower($file_name);
                $css_patha = DROIT_EL_ADDONS_DIR_PATH . "modules/widgets/{$widget_key}/scripts/dl_{$script_file_name}.min.css";
                if (is_readable($css_patha)) {
                    $widget_css_size += filesize($css_patha);
                    $widget_css.= $this->droit_read_from_file($css_patha);
                };
            }

            $editor_file_path = DROIT_EL_ADDONS_DIR_PATH . "assets/vendor/editor/main.min.css";
            $editor_css_size = filesize($editor_file_path);

            if($editor_css_size != $widget_css_size){
                $minified = $this->droit_css_code_minify($widget_css);
                $this->droit_put_file($editor_file_path, $minified);
            }
            do_action('dl_pro/editor/style');
        }
        /**
         * droit_put_file
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected function droit_put_file($path, $content) {
            return file_put_contents($path, $content);
        }
        /**
         * droit_read_from_file
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        
        protected function droit_read_from_file($get_read_file) {
            return file_get_contents($get_read_file);
        }
        /**
         * droit_css_minify
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected function droit_css_code_minify($css){
            // Remove comments
            $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
            // Remove remaining whitespace
            $css = str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '), '', $css);
            return $css;
        }
        /**
         * Droit Elementor Clear Cache Callback
         * @return
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_addons_clear_cache_callback() {
            if (!current_user_can('manage_options')) {
                return;
            }
            $type = sanitize_text_field($_POST['type']);
            $post_id = sanitize_text_field($_POST['post_id']);
            $nonce = sanitize_text_field($_POST['nonce']);
            $cache = new Files($post_id);
            if (!wp_verify_nonce($nonce, 'droit_cache_nonce')) {
                die('-1');
            }
            if ($type === 'all') {
                $cache->droit_remove_cache_files();
                die('1');
            } elseif ($type === 'page') {
                $cache->droit_cache_delete();
                die('1');
            }
            die();
        }
    }
}