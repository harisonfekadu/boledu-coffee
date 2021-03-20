<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR;

defined('ABSPATH') || die();

if (!class_exists('Manage_Update')) {
    class Manage_Update
    {

        public $current_version;

        public $new_version;

        public $droit_option_name;

        /**
         * Constructor
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public function __construct()
        {
            $this->current_version = \DROIT_ELEMENTOR\Utils::droit_addons_current_version();

            $this->new_version = \DROIT_ELEMENTOR\Utils::droit_addons_new_version();

            $this->droit_option_name = \DROIT_ELEMENTOR\Utils::droit_addons_version_option_name();
            

            if (version_compare($this->new_version, $this->current_version, '>')) {
                add_action('admin_notices', [ $this, 'droit_addons_update_notice_smaller_than_template_version']);
            }
            if (version_compare($this->new_version, $this->current_version, '<')) {
                add_action('admin_notices', [ $this, 'droit_addons_update_notice_greater_than_new_version']);
            }

            add_action('wp_ajax_droit_update_core_version', [ $this, 'droit_addons_core_version_update' ]);

            //SVG Support
            //add_filter( 'upload_mimes', [ __CLASS__, 'droit_svg_support' ] );

        }

        public function droit_addons_core_version_update()
        {
            $getParam = isset($_POST['param']) ? $_POST['param'] : '';
            if (!empty(sanitize_text_field($getParam))) {
                if ($getParam == "droit_update_core") {
                    $permission = check_ajax_referer('droit-update', 'nonce', false);
                    if ($permission == false) {
                        echo json_encode(array("status" => -1, "msg" => "The database update process is failed. Please try again"));
                    } else {
                        $new_version    = sanitize_text_field($_REQUEST['new_version']);
                        $update_version = update_option($this->droit_option_name, $new_version);
                        if ($update_version == true) {
                            echo json_encode(array("status" => 1, "msg" => "The database update process is now complete. Thank you for updating to the latest version!"));
                        } else {
                            echo json_encode(array("status" => 2, "error" => "The database update process is failed. Please try again!"));
                        }
                    }
                }
            }
            wp_die();
        }

        /**
         * Droit Elementor update Notice
         * Warning when the site doesn't have a minimum required wordpress version.
         * @access public
         * @since 1.0.0
         * Feature added by : DroitLab Team
         */
        public function droit_addons_update_notice_smaller_than_template_version()
        {
            $hash_symbol = "#";

            if (isset($_GET['activate'])) {
                unset($_GET['activate']);
            }

            $message = sprintf(__("Your current Droit Elementor Addons version is <strong> " . $this->current_version . " </strong>. You need to <a class='droit-update-core' data-id='" . $this->new_version . "' data-nonce='" . wp_create_nonce('droit-update') . "' href='" . $hash_symbol . "'>upgrade</a> Droit Elementor Addons to <strong> " . $this->new_version, "droit-elementor-addons"));

            printf('<div class="notice notice-warning droit-version-notice"><p>%1$s</p></div>', $message);

        }

        /**
         * Droit Elementor new version
         * Warning when the site doesn't have a minimum required wordpress version.
         * @access public
         * @since 1.0.0
         * Feature added by : DroitLab Team
         */
        public function droit_addons_update_notice_greater_than_new_version()
        {
            $hash_symbol = "#";

            if (isset($_GET['activate'])) {
                unset($_GET['activate']);
            }

            $message = sprintf(__("Your current Droit Elementor Addons version is <strong> " . $this->current_version . " </strong>. You need to <a class='droit-update-core' data-id='" . $this->new_version . "' data-nonce='" . wp_create_nonce('droit-update') . "' href='" . $hash_symbol . "'>upgrade</a> Droit Elementor Addons to <strong> " . $this->new_version, "droit-elementor-addons"));

            printf('<div class="notice notice-warning droit-version-notice"><p>%1$s</p></div>', $message);

        }
         /**
         * SVG Support
         * Warning when the site doesn't have a minimum required wordpress version.
         * @access public
         * @since 1.0.0
         * Feature added by : DroitLab Team
         */
        public static function droit_svg_support( $mimes ) {
            $mime_types['svg'] = 'image/svg+xml'; // Adding .svg extension
            $mime_types['ttf'] = 'application/x-font-ttf'; 
            $mime_types['woff'] = 'application/x-font-woff';
            $mime_types['eot'] = 'application/x-font-eot';
              
            return $mime_types;
        }
    }
}
