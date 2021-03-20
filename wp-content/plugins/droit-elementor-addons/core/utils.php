<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR;

use \Elementor\Plugin;
defined('ABSPATH') || die();

if (!class_exists('Utils')) {
    class Utils
    {
        const __OPTION_KEY__ = '_key_el_';
        const __SETTING_KEY__ = '_key_el_settings_';
        const __OPTION_FREE__ = 'widgets';
        const __OPTION_VERSION__ = '__dl_version__';
        /**
         * Droit Elementor Pro Link
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_pro_link()
        {
            $pro_link = esc_url('https://droitthemes.com/droit-elementor-addons/');
            return $pro_link;
        }

        /**
         * Droit Elementor Demo Link
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_demo_link()
        {
            $tutorial_link = esc_url('https://droitthemes.com/droit-elementor-addons/');
            return $tutorial_link;
        }
        /**
         * Droit Elementor Demo Link
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_doc_link()
        {
            $tutorial_link = esc_url('https://droitthemes.com/droit-elementor-addons/docs');
            return $tutorial_link;
        }

        /**
         * Droit Elementor Site Link
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_site_link()
        {
            $site_link = esc_url('https://droitthemes.com/droit-elementor-addons');
            return $site_link;
        }
        /**
         * Droit Elementor Setting Link
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_setting_link()
        {
            $settings_link = admin_url('admin.php?page=droit-addons');
            return $settings_link;
        }
        /**
         * Droit Elementor Has pro
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_has_pro()
        {
            $is_pro = 'stayhere';
             if (did_action('droit_elementor_addons/pro')) {
                $is_pro = get_option('_validation_auth_');
             }
         
            $has_pro = isset($is_pro) && !empty($is_pro) && $is_pro == 'go_in_front' && defined('DROIT_EL_PRO');

            return $has_pro;

        }
        /**
         * Droit Elementor SCRIPT DEBUG
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_script_debug_enabled()
        {
            return (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG);
        }
        /**
         * Droit Elementor Activated Time
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_installed_time()
        {
            if (!get_option('_droit_addons_installed_time')) {
                return;
            }
            $get_time = get_option('_droit_addons_installed_time');
            return date("d-m-Y", $get_time);
        }
        /**
         * Droit Elementor New Version
         * @return string
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_el_new_version()
        {
            return DROIT_EL_ADDONS_VERSION;
        }
        /**
         * Droit Elementor New Version
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_new_version()
        {
            $new_version = self::droit_addons_el_new_version();
            return $new_version;
        }
        /**
         * Droit Elementor Current Version From DB
         * @return string
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        
        public static function droit_addons_current_version_option()
        {
            return self::__OPTION_VERSION__;
        }
        /**
         * Droit Elementor Current Version
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_current_version()
        {
            if (!get_option(self::droit_addons_current_version_option())) {
                return;
            }
            $current_version = get_option(self::droit_addons_current_version_option());
            return $current_version;
        }
        /**
         * Droit Elementor Current Version
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_version_option_name()
        {
            $version_option_name = self::droit_addons_current_version_option();
            return $version_option_name;
        }

        /**
         * Droit Elementor Demo Url With Icon
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_demo_url_icon($demo_url)
        {
            $output = '';
            $output .= '<div class="dl_xs_dev">';
            $output .= '<a class="dl_tooltip_bounce dl_tooltip_top_right dl_tooltip_white" href="' . $demo_url . '" target="_blank" aria-label="Demo for mobile." rel="nofollow"><img src="' . DROIT_EL_ADDONS_IMAGE . '/phone.svg' . '" alt="' . esc_html('mobile') . '"></a>';
            $output .= '</div>';
            $output .= '<div class="dl_tab_dev">';
            $output .= '<a class="dl_tooltip_bounce dl_tooltip_top_right dl_tooltip_white" href="' . $demo_url . '" target="_blank" aria-label="Demo for tab." data-role="tooltip" rel="nofollow"><img src="' . DROIT_EL_ADDONS_IMAGE . '/tab.svg' . '" alt="' . esc_html('tab') . '"></a>';
            $output .= '</div>';
            $output .= '<div class="dl_xs_dev">';
            $output .= '<a class="dl_tooltip_bounce dl_tooltip_top_right dl_tooltip_white" href="' . $demo_url . '" target="_blank" aria-label="Demo for desktop" data-role="tooltip" rel="nofollow"><img src="' . DROIT_EL_ADDONS_IMAGE . '/desktop.svg' . '" alt="' . esc_html('desktop') . '"></a>';
            $output .= '</div>';

            return $output;
        }

        /**
         * Droit Elementor Get Widgets
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_get_options($settings_key)
        {
            $widgets     = [];
            $get_widgets = get_option(self::__OPTION_KEY__) ?: [];
            if (isset($get_widgets) && !empty($get_widgets)) {
                $widgets = isset($get_widgets[$settings_key]) ? $get_widgets[$settings_key] : [];
            }
            return $widgets;
        }

        /**
         * Droit Elementor Get Api
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function get_settings_options($settings_key)
        {
            $settings     = [];
            $get_setting = get_option(self::__SETTING_KEY__) ?: [];
            if (isset($get_setting) && !empty($get_setting)) {
                $settings = isset($get_setting[$settings_key]) ? $get_setting[$settings_key] : [];
            }
            return $settings;
        }
        /**
         * Droit Elementor Get Widget Classname
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_widget_classname($_key){
            $class_name = '\DROIT_ELEMENTOR\Widgets\\' . str_replace('-', '_', 'Droit_Addons_' . $_key);
            return $class_name;
        }

        /**
         * Contact Form 7 activation check
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_contact7_activated()
        {
            return class_exists('\WPCF7');
        }
        /**
         * Get all Contact Form 7 forms
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_cf7_list(){

            $cf7_form = array();

            if (self::droit_addons_contact7_activated()) {
                $cf7_form_list = get_posts(array(
                    'post_type' => 'wpcf7_contact_form',
                    'showposts' => 999,
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ));
                $cf7_form[0] = esc_html__('Select a Contact Form', 'droit-elementor-addons');
                if (!empty($cf7_form_list) && !is_wp_error($cf7_form_list)) {
                    foreach ($cf7_form_list as $post) {
                        $cf7_form[$post->ID] = $post->post_title;
                    }
                } else {
                    $cf7_form[0] = esc_html__('Create a Form First', 'droit-elementor-addons');
                }
            }
            return $cf7_form;
        }
        /**
         * WPForms activation check
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_wpform_activated()
        {
            return class_exists('\WPForms\WPForms');
        }
        /**
         * Get all wpforms
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_wpforms_list()
        {
            $wpforms_form = [];

            if (self::droit_addons_wpform_activated()) {
                $wpforms_forms = get_posts([
                    'post_type'      => 'wpforms',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ]);

                if (!empty($wpforms_forms)) {
                    $wpforms_form = wp_list_pluck($wpforms_forms, 'post_title', 'ID');
                }
            }

            return $wpforms_form;
        }
        /**
         * Ninja activation check
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_ninja_activated()
        {
            return class_exists('\Ninja_Forms');
        }
        /**
         * Get all Ninja Forms
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_ninja_list()
        {
            $ninja_forms = [];

            if (self::droit_addons_ninja_activated()) {
                $_ninja_form = \Ninja_Forms()->form()->get_forms();

                if (!empty($_ninja_form) && !is_wp_error($_ninja_form)) {
                    foreach ($_ninja_form as $form) {
                        $ninja_forms[$form->get_id()] = $form->get_setting('title');
                    }
                }
            }

            return $ninja_forms;
        }
        /**
         * Gravityforms activation check
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_gforms_activated()
        {
            return class_exists('\GFForms');
        }
        /**
         * Get all Gravityforms Forms
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_gforms_list()
        {
            $g_forms = [];

            if (self::droit_addons_gforms_activated()) {
                $gravity_forms = \RGFormsModel::get_forms(null, 'title');

                if (!empty($gravity_forms) && !is_wp_error($gravity_forms)) {
                    foreach ($gravity_forms as $_form) {
                        $g_forms[$_form->id] = $_form->title;
                    }
                }
            }

            return $g_forms;
        }
        /**
         * FLUENTFORM activation check
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_fluentform_activated()
        {
            return defined('FLUENTFORM');
        }
        /**
         * Get all FLUENTFORM Forms
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_fluentform_list()
        {
            $f_forms = [];

            if (self::droit_addons_fluentform_activated()) {
                global $wpdb;

                $f_table  = $wpdb->prefix . 'fluentform_forms';
                $query    = "SELECT * FROM {$f_table}";
                $fl_forms = $wpdb->get_results($query);

                if ($fl_forms) {
                    foreach ($fl_forms as $form) {
                        $f_forms[$form->id] = $form->title;
                    }
                }
            }

            return $f_forms;
        }
        /**
         * Caldera activation check
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_caldera_activated()
        {
            return class_exists('\Caldera_Forms');
        }
        /**
         * Get all Caldera Forms
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_caldera_list()
        {
            $caldera_forms = [];

            if (self::droit_addons_caldera_activated()) {
                $caldera_forms = \Caldera_Forms_Forms::get_forms(true, true);

                if (!empty($caldera_forms) && !is_wp_error($caldera_forms)) {
                    foreach ($caldera_forms as $form) {
                        $caldera_forms[$form['ID']] = $form['name'];
                    }
                }
            }

            return $caldera_forms;
        }
        /**
         * WeForms activation check
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_weForms_activated()
        {
            return class_exists('\WeForms');

        }
        /**
         * Get all weform Forms
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_weform_list()
        {
            $weform_forms = [];

            if (self::droit_addons_weForms_activated()) {
                $we_forms = get_posts([
                    'post_type'      => 'wpuf_contact_form',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ]);

                if (!empty($we_forms)) {
                    $weform_forms = wp_list_pluck($we_forms, 'post_title', 'ID');
                }
            }

            return $weform_forms;
        }

        /**
         * Get all forms
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_form_list($post_type)
        {
            $_form = [];

            if (self::droit_addons_contact7_activated() || self::droit_addons_wpform_activated() || self::droit_addons_weform_list()) {
                $_forms = get_posts([
                    'post_type'      => $post_type,
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ]);

                if (!empty($_forms)) {
                    $_form = wp_list_pluck($_forms, 'post_title', 'ID');
                }
            }

            return $_form;
        }
        /**
         * Get enqueue dependencies.
         * Retrieve the name of the stylesheet used by `wp_enqueue_style()`.
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         * @access protected
         *
         * @return array Name of the stylesheet.
         */
        public static function get_enqueue_dependencies()
        {
            return ['elementor-frontend'];
        }
        /**
         * Get placeholder image source.
         * Retrieve the source of the placeholder image.
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         * @access public
         * @static
         *
         * @return string The source of the default placeholder image used by Elementor.
         */
        public static function droit_placeholder_image_src()
        {
            $placeholder_image = DROIT_EL_ADDONS_IMAGE . 'placeholder.png';

            $placeholder_image = apply_filters('elementor/utils/get_placeholder_image_src', $placeholder_image);

            return $placeholder_image;
        }

        /**
         * Get placeholder image source.
         * Retrieve the source of the placeholder image.
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         * @access public
         * @static
         *
         * @return string The source of the default placeholder image used by Elementor.
         */
        public static function droit_default_image_src()
        {
            $default_image = DROIT_EL_ADDONS_IMAGE . 'placeholder.png';

            return $default_image;
        }
        /**
         * Get All Post Types
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         * @access public
         * @static
         *
         * @return string The source of the default placeholder image used by Elementor.
         */
        
        public static function droit_get_post_types($args = [], $array_diff_key = []){
            $post_type_args = [
                'public' => true,
                'show_in_nav_menus' => true
            ];

            // Keep for backwards compatibility
            if (!empty($args['post_type'])) {
                $post_type_args['name'] = $args['post_type'];
                unset($args['post_type']);
            }

            $post_type_args = wp_parse_args($post_type_args, $args);

            $_post_types = get_post_types($post_type_args, 'objects');

            $post_types = [];
            $post_types = array(
                'by_id'    => __('Manual Selection', 'droit-elementor-addons'),
                'category' => __('Category', 'droit-elementor-addons'),
            );

            foreach ($_post_types as $post_type => $object) {
                $post_types[$post_type] = $object->label;
            }
            if( !empty( $array_diff_key ) ){
                $post_types = array_diff_key( $post_types, $array_diff_key );
            }

            return $post_types;
        }
        /**
         * Get All Post Types
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         * @access public
         * @static
         *
         * @return string The source of the default placeholder image used by Elementor.
         */
        
        public static function droit_get_all_posts($args = [], $array_diff_key = []){
             $post_args = get_posts(array(
                'posts_per_page' => -1,
                'post_status'    => 'publish',
            ));
            $_posts = get_posts($post_args);

            $posts_list = [];

            foreach ($_posts as $_key => $object) {
                $posts_list[$object->ID] = $object->post_title;
            }

            return $posts_list;
        }
        public static function get_grid_metro_size() {
            return [
                '1:1'   => esc_html__( 'Width 1 - Height 1', 'droit-elementor-addons' ),
                '1:2'   => esc_html__( 'Width 1 - Height 2', 'droit-elementor-addons' ),
                '1:0.7' => esc_html__( 'Width 1 - Height 70%', 'droit-elementor-addons' ),
                '1:1.3' => esc_html__( 'Width 1 - Height 130%', 'droit-elementor-addons' ),
                '2:1'   => esc_html__( 'Width 2 - Height 1', 'droit-elementor-addons' ),
                '2:2'   => esc_html__( 'Width 2 - Height 2', 'droit-elementor-addons' ),
            ];
        }

        /**
         * droit_css_minify
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_css_minify($css){
            // Remove comments
            $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
            // Remove remaining whitespace
            $css = str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '), '', $css);
            return $css;
        }
    }
}
