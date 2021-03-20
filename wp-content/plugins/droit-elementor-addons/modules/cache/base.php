<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR\Cache;
use DROIT_ELEMENTOR\Cache\Manager;
defined('ABSPATH') || die();
if (!class_exists('Base')) {
    class Base {
        /**
         * Constant
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        const __OPTION_KEY__ = '__files_save_data__';
        const __META_KEY__ = '__save_kase_data__';
        /**
         * Variable
         * @var post_id
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected $post_id = 0;
        /**
         * Variable
         * @var elementor_data
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected $elementor_data = null;
        /**
         * Variable
         * @var is_built_with_elementor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected $is_built_with_elementor = false;
        /**
         * Variable
         * @var is_published
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected $is_published = false;
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
        public function __construct($post_id = 0, $data = null) {
            if (!$post_id || !Manager::is_built_with_elementor($post_id) || !Manager::is_published($post_id)) {
                return;
            }
            if (!is_null($data)) {
                $this->elementor_data = $data;
            }
            $this->post_id = $post_id;
            $this->is_published = true;
            $this->is_built_with_elementor = true;
        }
        /**
         * droit_widget_post_id
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_widget_post_id() {
            return $this->post_id;
        }
        /**
         * droit_global_widget_cache_type
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_widget_cache_type($element) {
            if (empty($element['widgetType'])) {
                $type = $element['elType'];
            } else {
                $type = $element['widgetType'];
            }
            return $type;
        }
        /**
         * droit_widget_cache_data
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_widget_cache_data() {
            $cache = get_post_meta($this->droit_widget_post_id(), self::__META_KEY__, true);
            if (empty($cache)) {
                $cache = $this->droit_save_widget();
            }
            return $cache;
        }
        /**
         * droit_widget_cache_get
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_widget_cache_get() {
            $cache = $this->droit_widget_cache_data();
            return array_map(function ($widget_key) {
                return str_replace('droit-', '', strtolower($widget_key));
            }, array_keys($cache));
        }
        /**
         * droit_has_widget_cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_has_widget_cache() {
            $cache = $this->droit_widget_cache_get();
            return !empty($cache);
        }
        /**
         * droit_delete_widget_cache
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_delete_widget_cache() {
            delete_post_meta($this->droit_widget_post_id(), self::__META_KEY__);
        }
        /**
         * droit_widget_post_type
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_widget_post_type() {
            return get_post_type($this->droit_widget_post_id());
        }
        /**
         * droit_widget_post_type
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_elementor_data() {
            if (!$this->is_built_with_elementor || !$this->is_published) {
                return [];
            }
            if (is_null($this->elementor_data)) {
                $document = \Elementor\Plugin::instance()->documents->get($this->droit_widget_post_id());
                $data = $document ? $document->get_elements_data() : [];
            } else {
                $data = $this->elementor_data;
            }
            return $data;
        }
        /**
         * Update meta data.
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected function droit_meta($meta) {
            update_post_meta($this->droit_widget_post_id(), self::__META_KEY__, $meta);
        }
        /**
         * Update Option data.
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        protected function droit_option($option) {
            update_option(self::__OPTION_KEY__, $option);
        }
        /**
         * droit_save_widget
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function droit_save_widget() {
            $data = $this->droit_elementor_data();
            if (empty($data)) {
                return [];
            }
            $cache = [];
            \Elementor\Plugin::instance()->db->iterate_data($data, function ($element) use (&$cache) {
                $type = $this->droit_widget_cache_type($element);
                if (strpos($type, 'droit-') !== false) {
                    if (!isset($cache[$type])) {
                        $cache[$type] = 0;
                    }
                    $cache[$type]++;
                }
                return $element;
            });
            $doc_type = $this->droit_widget_post_type();
            $prev_cache = get_post_meta($this->droit_widget_post_id(), self::__META_KEY__, true);
            $global_cache = get_option(self::__OPTION_KEY__, []);
            if (is_array($prev_cache)) {
                foreach ($prev_cache as $type => $count) {
                    if (isset($global_cache[$doc_type][$type])) {
                        $global_cache[$doc_type][$type]-= $prev_cache[$type];
                        if (0 === $global_cache[$doc_type][$type]) {
                            unset($global_cache[$doc_type][$type]);
                        }
                    }
                }
            }
            foreach ($cache as $type => $count) {
                if (!isset($global_cache[$doc_type])) {
                    $global_cache[$doc_type] = [];
                }
                if (!isset($global_cache[$doc_type][$type])) {
                    $global_cache[$doc_type][$type] = 0;
                }
                $global_cache[$doc_type][$type]+= $cache[$type];
            }
            self::droit_option($global_cache);
            self::droit_meta($cache);
            return $cache;
        }
    }
}