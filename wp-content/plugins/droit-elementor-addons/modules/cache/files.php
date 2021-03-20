<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR\Cache;
use \DROIT_ELEMENTOR\Droit_Elements;
use \DROIT_ELEMENTOR\Utils as Droit_Utils;
defined('ABSPATH') || die();
if (!class_exists('Files')) {
    class Files {
        const FILE_PREFIX = 'droit-';
        const UPLOADS_DIR = 'droitaddons/';
        const DEFAULT_FILES_DIR = 'css/';
        private static $wp_uploads_dir = [];
        /**
         * Variable
         * @var Post Id
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected $post_id = 0;
        /**
         * Variable
         * @var Widgets_Cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected $widgets_cache = null;
        /**
         * Instance Variable
         * @var $_instance
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
        public function __construct($post_id = 0, Base $widget_cache_instance = null) {
            $this->post_id = $post_id;
            $this->widgets_cache = $widget_cache_instance;
            $this->droit_set_path();
            $this->droit_save_cache();
        }
        /**
         * droit_widgets_cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_widgets_cache() {
            if (is_null($this->widgets_cache)) {
                $this->widgets_cache = new Base($this->droit_post_id());
            }
            return $this->widgets_cache;
        }
        /**
         * WP Uploads dir
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function get_wp_uploads_dir() {
            return wp_upload_dir();
        }
        /**
         * droit base upload dir
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function get_base_uploads_dir() {
            $wp_upload_dir = self::get_wp_uploads_dir();
            return $wp_upload_dir['basedir'] . '/' . self::UPLOADS_DIR;
        }
        /**
         * droit base upload url
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function get_base_uploads_url() {
            $wp_upload_dir = self::get_wp_uploads_dir();
            return $wp_upload_dir['baseurl'] . self::UPLOADS_DIR;
        }
        /**
         * droit file path
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function set_files_dir() {
            return self::get_base_uploads_dir() . self::DEFAULT_FILES_DIR;
        }
        /**
         * droit_cache_dir_name
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_cache_dir_name() {
            return $this->set_files_dir();
        }
        /**
         * droit_post_id
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_post_id() {
            return $this->post_id;
        }
        /**
         * droit_cache_dir
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_cache_dir() {
            return $this->droit_cache_dir_name();
        }
        /**
         * droit_cache_url
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_cache_url() {
            return $this->droit_cache_dir_name();
        }
        /**
         * droit_file_name
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_file_name() {
            return $this->droit_cache_dir() . self::FILE_PREFIX . "{$this->droit_post_id() }.css";
        }
        /**
         * droit base upload file url
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function get_base_uploads_file_url() {
            $wp_upload_dir = self::get_wp_uploads_dir();
            return $wp_upload_dir['baseurl'] . '/' . self::UPLOADS_DIR . self::DEFAULT_FILES_DIR;
        }
        /**
         * droit_file_url
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_file_url() {
            return self::get_base_uploads_file_url() . self::FILE_PREFIX . "{$this->droit_post_id() }.css";
        }
        /**
         * set path
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        private function droit_set_path() {
            $dir_path = $this->droit_cache_dir();
            if (!is_dir($dir_path)) {
                wp_mkdir_p($dir_path);
            }
        }
        /**
         * droit_is_cache_exists
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_is_cache_exists() {
            return file_exists($this->droit_file_name());
        }
        /**
         * droit_is_has_cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_is_has_cache() {
            if (!$this->droit_is_cache_exists()) {
                $this->droit_save_cache();
            }
            return $this->droit_is_cache_exists();
        }
        /**
         * droit_cache_delete
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_cache_delete() {
            if ($this->droit_is_cache_exists()) {
                unlink($this->droit_file_name());
            }
        }
        /**
         * droit_delete_all_cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_delete_all_cache() {
            $files = glob($this->droit_cache_dir() . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
        /**
         * Remove Cache File
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_remove_cache_files() {
            $files = glob($this->droit_cache_dir() . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
        /**
         * Get file handle ID.
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected function get_file_handle_id() {
            return self::FILE_PREFIX . $this->droit_post_id();
        }
        /**
         * droti_assets_cache_enqueue
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droti_assets_cache_enqueue() {
            if ($this->droit_is_has_cache()) {
                wp_enqueue_style($this->get_file_handle_id(), $this->droit_file_url(), Droit_Utils::get_enqueue_dependencies(), Droit_Utils::droit_addons_el_new_version());
            }
        }
        /**
         * droit_enqueue_cache_handler
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_enqueue_cache_handler() {
            $widgets_map = Droit_Elements::droit_get_cache_widgets_map();

            $base_widget = isset($widgets_map[Droit_Elements::droit_get_cache_base_widget_key() ]) ? $widgets_map[Droit_Elements::droit_get_cache_base_widget_key() ] : [];
            if (isset($base_widget['vendor'], $base_widget['vendor']['css']) && is_array($base_widget['vendor']['css'])) {
                foreach ($base_widget['vendor']['css'] as $vendor_css_handle) {
                    wp_enqueue_style($vendor_css_handle);
                }
            }
            if (isset($base_widget['vendor'], $base_widget['vendor']['js']) && is_array($base_widget['vendor']['js'])) {
                foreach ($base_widget['vendor']['js'] as $vendor_js_handle) {
                    wp_enqueue_script($vendor_js_handle);
                }
            }
            $widgets = $this->droit_widgets_cache()->droit_widget_cache_get();
            if (empty($widgets) || !is_array($widgets)) {
                return;
            }
            foreach ($widgets as $widget_key) {
                if (!isset($widgets_map[$widget_key], $widgets_map[$widget_key]['vendor'])) {
                    continue;
                }
                $plugins = $widgets_map[$widget_key]['vendor'];
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
        }
        /**
         * droit_save_cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_save_cache() {
            $widgets = $this->droit_widgets_cache()->droit_widget_cache_get();
            if (empty($widgets)) {
                return;
            }
            $widgets_map = Droit_Elements::droit_get_cache_widgets_map();

            $base_widget = isset($widgets_map[Droit_Elements::droit_get_cache_base_widget_key() ]) ? $widgets_map[Droit_Elements::droit_get_cache_base_widget_key() ] : [];
            $styles = '';
            if (isset($base_widget['css']) && is_array($base_widget['css'])) {
                $styles = $this->droit_cache_styles($base_widget['css']);
            }
            $cached_widgets = [];
            foreach ($widgets as $widget_key) {
                if (isset($cached_widgets[$widget_key]) || !isset($widgets_map[$widget_key], $widgets_map[$widget_key]['css'])) {
                    continue;
                }
                $is_pro = (isset($widgets_map[$widget_key]['_droit_pro']) && $widgets_map[$widget_key]['_droit_pro']);
                $styles.= $this->droit_cache_styles($widgets_map[$widget_key]['css'], $is_pro);
                $cached_widgets[$widget_key] = true;
            }

            $style = Droit_Utils::droit_css_minify($styles);
            $this->droit_put_file($this->droit_file_name(), $style);
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
         * droit_cache_styles
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected function droit_cache_styles($files_name, $is_pro = false) {
            $get_css = '';
            foreach ($files_name as $file_name) {
                $widget_key = str_replace(['_', ' ', '__'], '-', $file_name);
                $script_file_name = strtolower($file_name);
                $css_patha = DROIT_EL_ADDONS_DIR_PATH . "modules/widgets/{$widget_key}/scripts/dl_{$script_file_name}.min.css";
                $css_patha = apply_filters('droit_addons_pro_style', $css_patha, $script_file_name, $is_pro);
                if (is_readable($css_patha)) {
                    $get_css.= $this->droit_read_from_file($css_patha);
                };
            }
            return $get_css;
        }
    }
}
