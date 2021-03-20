<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR\Cache;
use Elementor\Core\Files\CSS\Post as Post_CSS;
use \DROIT_ELEMENTOR\Droit_Elements;

defined('ABSPATH') || die();
if (!class_exists('Manager')) {
    class Manager {
        /**
         * widgets_cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        private static $droit_widgets_cache;
        /**
         * Instance Variable
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        private static $_instance = null;
        /**
         * Instance
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function instance() {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        /**
         * Constructor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function __construct() {
            add_action('elementor/editor/after_save', [__CLASS__, 'delete_widgets_cache'], 10, 2);
            add_action('after_delete_post', [__CLASS__, 'droit_delete_cache']);
        }
        /**
         * droit_delete_cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_delete_cache($post_id) {
            $css_file = new Files($post_id);
            $css_file->droit_cache_delete();
        }
        /**
         * delete_widgets_cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function delete_widgets_cache($post_id, $data) {
            if (!self::is_published($post_id)) {
                return;
            }
            self::$droit_widgets_cache = new Base($post_id, $data);
            self::$droit_widgets_cache->droit_save_widget();
            $css_file = new Files($post_id, self::$droit_widgets_cache);
            $css_file->droit_cache_delete();
        }
        /**
         * is_published
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function is_published($post_id) {
            return get_post_status($post_id) === 'publish';
        }
        /**
         * is_editing_mode
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function is_editing_mode() {
            return (\Elementor\Plugin::instance()->editor->is_edit_mode() || \Elementor\Plugin::instance()->preview->is_preview_mode() || is_preview());
        }
        /**
         * is_built_with_elementor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function is_built_with_elementor($post_id) {
            return \Elementor\Plugin::instance()->db->is_built_with_elementor($post_id);
        }
        /**
         * droit_cache_enqueue
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_cache_enqueue_has($post_id) {
            if (!is_droit() || !self::is_built_with_elementor($post_id) || !self::is_published($post_id) || self::is_editing_mode()) {
                return false;
            }
            return true;
        }
        /**
         * droit_enqueue_fonts_awesome5
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_enqueue_fonts_awesome5($post_id) {
            $post_css = new Post_CSS($post_id);
            $meta = $post_css->get_meta();
            if (!empty($meta['icons'])) {
                $icons_types = \Elementor\Icons_Manager::get_icon_manager_tabs();
                foreach ($meta['icons'] as $icon_font) {
                    if (!isset($icons_types[$icon_font])) {
                        continue;
                    }
                    \Elementor\Plugin::instance()->frontend->enqueue_font($icon_font);
                }
            }
        }
        /**
         * droit_enqueue_cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_enqueue_cache($post_id) {
            $css_file = new Files($post_id, self::$droit_widgets_cache);
            $css_file->droit_enqueue_cache_handler();
            $css_file->droti_assets_cache_enqueue();
            self::droit_enqueue_fonts_awesome5($post_id);
            wp_enqueue_script('droit-addons-enqueue');
            do_action('droit_enqueue_assets', $is_cache = true, $post_id);
        }
        
        public static function droit_none_of_cache() {
            if (!self::is_editing_mode()) {
                return;
            }
            $widgets_map = Droit_Elements::droit_get_cache_widgets_map();
            
            $get_active_key = \DROIT_ELEMENTOR\Utils::droit_get_options('widgets');
            $active_key = !empty($get_active_key) ? $get_active_key : [];
            foreach ($widgets_map as $widget_key => $data) {
                if (!isset($data['vendor'])) {
                    continue;
                }
                if (!in_array($widget_key, $active_key)) {
                    continue;
                }
                $plugins = $data['vendor'];
               
                if (isset($plugins['css']) && is_array($plugins['css'])) {
                    foreach ($plugins['css'] as $plugins_css_handle) {
                        wp_enqueue_style($plugins_css_handle);
                    }
                }
                if (isset($plugins['js']) && is_array($plugins['js'])) {
                    foreach ($plugins['js'] as $plugins_js_handle) {
                        wp_enqueue_script($plugins_js_handle);
                    }
                }
            }
            wp_enqueue_style('droit-addons-enqueue');
            wp_enqueue_script('droit-addons-enqueue');
            do_action('droit_enqueue_assets', $is_cache = false, 0);
        }
        /**
         * droit_none_of_cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_none_of_cached() {
            if (!self::is_editing_mode()) {
                return;
            }
            $widgets_map = Droit_Elements::droit_get_cache_widgets_map();
            $get_active_key = \DROIT_ELEMENTOR\Utils::droit_get_options('widgets');
            $active_key = !empty($get_active_key) ? $get_active_key : [];
           
            foreach ($widgets_map['_content']['elements'] as $_key => $data) {
               
                if (!isset($data['vendor'])) {
                    continue;
                }

                if (!in_array($data['_key'], $active_key)) {
                    continue;
                }
                $plugins = $data['vendor'];
                
                if (isset($plugins['css']) && is_array($plugins['css'])) {
                    foreach ($plugins['css'] as $plugins_css_handle) {
                        wp_enqueue_style($plugins_css_handle);
                    }
                }
                if (isset($plugins['js']) && is_array($plugins['js'])) {
                    foreach ($plugins['js'] as $plugins_js_handle) {
                        wp_enqueue_script($plugins_js_handle);
                    }
                }
            }
            wp_enqueue_style('droit-addons-enqueue');
            wp_enqueue_script('droit-addons-enqueue');
            do_action('droit_enqueue_assets', $is_cache = false, 0);
        }
    }
}