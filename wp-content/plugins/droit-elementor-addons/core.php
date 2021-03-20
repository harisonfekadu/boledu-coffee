<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR;
if ( ! defined( 'ABSPATH' ) ) {exit;}
Final class Core
{
    const __OPTION_KEY__ = '_key_el_';
    const __OPTION_FREE__ = 'widgets';
    const __OPTION_VERSION__ = '__dl_version__';
    const __OPTION_DL_PRO_LINK__ = '__dl_pro__';
    const __OPTION_DL_DEMO_LINK__ = '__dl_demo__';
    /**
     * Instance
     * @var core The single instance of the class.
     * @access private
     * @static
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    private static $_instance = null;

    /**
     * Instance
     * Ensures only one instance of the class is loaded or can be loaded.
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
            do_action( 'droit_elementor_addons/loaded' );
        }
        return self::$_instance;

    }

    /**
     * Constructor
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function __construct()
    {
        add_action('init', [$this, 'droit_elementor_i18n']);
        add_action('plugins_loaded', [$this, 'droit_elementor_addons_init']);
        register_activation_hook(DROIT_EL_ADDONS_FILE, [$this, 'droit_elementor_addons_activation']);
        register_activation_hook(DROIT_EL_ADDONS_FILE, [__CLASS__, 'droit_save_defaults']);
        register_activation_hook(DROIT_EL_ADDONS_FILE, [__CLASS__, 'droit_save_editor_css_cache']);
        register_activation_hook(DROIT_EL_ADDONS_FILE, [$this, 'droit_installed_time']);
        add_action( 'admin_notices', [$this, 'thanks_message_notice'] );
        add_action( 'wp_ajax_droit_addons_set_thanks_message', [$this, 'ajax_droit_addons_set_thanks_message'] );
        if (version_compare(DROIT_EL_ADDONS_VERSION, '1.0.6', '==')) {
            add_action( 'admin_notices', [$this, 'version_upgrade_solved'] );
            add_action( 'wp_ajax_droit_addons_set_version_upgrade_message', [$this, 'droit_addons_set_version_upgrade_message'] );
        }
        if ($this->is_plugin_active('elementor/elementor.php')) {
            add_action('admin_init', [$this, 'droit_elementor_addons_activation_addons_redirect']);
        }
    }
    
    /**
     * Load Textdomain
     * Load plugin localization files.
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function droit_elementor_i18n()
    {
        load_plugin_textdomain('droit-elementor-addons');
    }

    /**
     * Check if a plugin is installed or Not
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    private function is_plugin_installed_or_not($basename) {
        if (!function_exists('get_plugins')) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $installed_plugins = get_plugins();

        return isset($installed_plugins[$basename]);
    }
    /**
     * Check if a plugin is active
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    private function is_plugin_active( $basename ) {
        if (!function_exists('is_plugin_active')) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $active_plugins = is_plugin_active($basename);

        return $active_plugins;
    }
    /**
     * Initialize the plugin
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed load the files required to run the plugin.
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function droit_elementor_addons_init()
    {   
        // Check for required PHP version
        if (version_compare(PHP_VERSION, DROIT_EL_ADDONS_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'droit_elementor_addons_notice_minimum_php_version']);
            return;
        }
    
        // Check for required wordpress version
        if (version_compare(get_bloginfo('version'), DROIT_EL_ADDONS_WP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'droit_elementor_addons_notice_minimum_wordpress_version']);
            return;
        }
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'droit_elementor_addons_notice_missing_elementor_plugin']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, DROIT_MINIMUM_EL_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'droit_elementor_addons_notice_minimum_elementor_version']);
            return;
        }
        self::_autoloader();
        $this->droit_init_components();
    }
    
    /**
     * Active Plugin
     * @return string
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */

    public function droit_elementor_addons_activation()
    {
 
        flush_rewrite_rules();

        $default = array();

        if (!get_option(self::__OPTION_VERSION__)) {
            update_option(self::__OPTION_VERSION__, DROIT_EL_ADDONS_VERSION);
        }

        if (!get_option(self::__OPTION_DL_PRO_LINK__)) {
            update_option(self::__OPTION_DL_PRO_LINK__, DROIT_EL_PRO_LINK);
        }

        if (!get_option(self::__OPTION_DL_DEMO_LINK__)) {
            update_option(self::__OPTION_DL_DEMO_LINK__, DROIT_EL_DEMO_LINK);
        }
       
        set_transient('droit_activation_addons_redirect', true, MINUTE_IN_SECONDS);
    }

    /**
     * Plugin Active Time
     * @return string
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public function droit_installed_time() {
        $installed_time = get_option( '_droit_addons_installed_time' );

        if ( ! $installed_time ) {
            $installed_time = time();

            update_option( '_droit_addons_installed_time', $installed_time );
        }

        return $installed_time;
    }
    /**
     * Active Plugin Redirect
     * @return string
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public function droit_elementor_addons_activation_addons_redirect()
    {
        if (!get_transient('droit_activation_addons_redirect')) {
            return;
        }

        wp_safe_redirect(admin_url('admin.php?page=droit-addons#elements'));
        delete_transient('droit_activation_addons_redirect');
        exit;
    }
    /**
     * Admin notice
     * Warning when the site doesn't have a minimum required wordpress version.
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function droit_elementor_addons_notice_minimum_wordpress_version(){
            $button_core_link = admin_url('update-core.php');
            $button_core_text = 'update Wordpress';
            $message = sprintf(__("Your current wordpress version is <strong> " . get_bloginfo('version') . " </strong>. You need to upgrade your wordpress version to <strong> " . DROIT_EL_ADDONS_WP_VERSION . " or later</strong> to run Droit Elementor Addons plugin.", "droit-elementor-addons"));
            ?>
            <style>
            .notice.droit-addons-elementor-notice {
                border-left-color: #574ff7 !important;
                padding: 20px;
            }
            .rtl .notice.droit-addons-elementor-notice {
                border-right-color: #574ff7 !important;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner .droit-addons-elementor-notice-icon,
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner .droit-addons-elementor-notice-content,
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner .droit-addons-elementor-install-now {
                display: table-row;
                align-items: center;
                justify-content: space-between;        }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-icon {
                color: #33ccff;
                font-size: 50px;
                width: 50px;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-content {
                padding: 0 0px;
            }
            .notice.droit-addons-elementor-notice p {
                padding: 0;
                margin: 0;
            }
            .notice.droit-addons-elementor-notice h3 {
                margin: 0 0 5px;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now {
                text-align: center;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button {
                padding: 5px 30px;
                height: auto;
                line-height: 20px;
                text-transform: capitalize;
                border-color: #a533ff !important;
                background-image: linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21% )!important;
                background-image: -moz-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
                background-image: -webkit-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
                background-image: -ms-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button i {
                padding-right: 5px;
            }
            .rtl .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button i {
                padding-right: 0;
                padding-left: 5px;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button:active {
                transform: translateY(1px);
            }
            @media (max-width: 767px) {
                .notice.droit-addons-elementor-notice {
                    padding: 10px;
                }
            }
        </style>
            <div class="notice updated droit-addons-elementor-notice droit-addons-elementor-install-elementor">
                <div class="droit-addons-elementor-notice-inner">
                    <div class="droit-addons-elementor-notice-content">
                        <h3><?php esc_html_e( 'Thanks for installing Droit Elementor Addons!', 'droit-elementor-addons' ); ?></h3>
                        <p><?php echo $message ?></p>
                    </div>

                    <div class="droit-addons-elementor-install-now">
                        <a class="button button-primary droit-addons-elementor-install-button" href="<?php echo esc_attr( $button_core_link ); ?>"><i class="dashicons dashicons-download"></i><?php echo esc_html( $button_core_text ); ?></a>
                    </div>
                </div>
            </div>
            <?php
    }
    /**
     * Admin notice
     * Warning when the site doesn't have Elementor installed or activated.
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
     public function droit_elementor_addons_notice_missing_elementor_plugin(){

            $screen = get_current_screen();
            if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
                return;
            }

            $plugin = 'elementor/elementor.php';
            $droit_plugins_name = 'Droit Elementor Addons for Elementor';
            $installed_plugins = get_plugins();

            $is_elementor_installed = isset( $installed_plugins[ $plugin ] );

            if ( $is_elementor_installed ) {

                if ( ! current_user_can( 'activate_plugins' ) ) {
                    return;
                }

                $button_text = __( 'Activate Elementor', 'droit-elementor-addons' );
                $button_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
                 $message = __('<strong>'.$droit_plugins_name.'</strong> requires <strong>Elementor</strong> plugin to be active. Please activate Elementor to continue.', 'droit-elementor-addons');
            } else {
                if ( ! current_user_can( 'install_plugins' ) ) {
                    return;
                }

                $button_text = __( 'Install Elementor', 'droit-elementor-addons' );
                $button_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
                $message = sprintf(__('<strong>'.$droit_plugins_name.' requires Elementor</strong> plugin to be installed and activated. Please install Elementor to continue.', 'droit-elementor-addons'), '<strong>', '</strong>');
            }
            ?>
            <style>
            .notice.droit-addons-elementor-notice {
                border-left-color: #574ff7 !important;
                padding: 20px;
            }
            .rtl .notice.droit-addons-elementor-notice {
                border-right-color: #574ff7 !important;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner .droit-addons-elementor-notice-icon,
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner .droit-addons-elementor-notice-content,
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner .droit-addons-elementor-install-now {
                display: table-row;
                align-items: center;
                justify-content: space-between;        }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-icon {
                color: #33ccff;
                font-size: 50px;
                width: 50px;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-content {
                padding: 0 0px;
            }
            .notice.droit-addons-elementor-notice p {
                padding: 0;
                margin: 0;
            }
            .notice.droit-addons-elementor-notice h3 {
                margin: 0 0 5px;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now {
                text-align: center;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button {
                padding: 5px 30px;
                height: auto;
                line-height: 20px;
                text-transform: capitalize;
                border-color: #a533ff !important;
                background-image: linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21% )!important;
                background-image: -moz-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
                background-image: -webkit-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
                background-image: -ms-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button i {
                padding-right: 5px;
            }
            .rtl .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button i {
                padding-right: 0;
                padding-left: 5px;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button:active {
                transform: translateY(1px);
            }
            @media (max-width: 767px) {
                .notice.droit-addons-elementor-notice {
                    padding: 10px;
                }
            }
        </style>
            <div class="notice updated droit-addons-elementor-notice droit-addons-elementor-install-elementor">
                <div class="droit-addons-elementor-notice-inner">
                    <div class="droit-addons-elementor-notice-content">
                        <h3><?php esc_html_e( 'Thanks for installing Droit Elementor Addons!', 'droit-elementor-addons' ); ?></h3>
                        <p><?php echo $message; ?></p>
                    </div>

                    <div class="droit-addons-elementor-install-now">
                        <a class="button button-primary droit-addons-elementor-install-button" href="<?php echo esc_attr( $button_link ); ?>"><i class="dashicons dashicons-download"></i><?php echo esc_html( $button_text ); ?></a>
                    </div>
                </div>
            </div>
            <?php
    }
    /**
     * Thanks Notice for indivisual user notice
     * Thanks message to indivisual users.
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function thanks_message_notice() {

        if ( 'true' === get_user_meta( get_current_user_id(), '_droit_addons_thanks_notice', true ) ) {
            return;
        }

    ?>
    <style>
        .notice.droit-thanks-for-install {
            border-left-color: #574ff7 !important;
            padding: 20px;
        }
        .rtl .notice.droit-thanks-for-install {
            border-right-color: #574ff7 !important;
        }
        .notice.droit-thanks-for-install h3 {
            margin: 0 0 5px;
        }
        .notice.droit-thanks-for-install p {
            padding: 0;
            margin: 0;
        }
    </style>
    <script>jQuery( function( $ ) {
            $( 'div.notice.droit-thanks-for-install' ).on( 'click', 'button.notice-dismiss', function( event ) {
                event.preventDefault();

                $.post( ajaxurl, {
                    action: 'droit_addons_set_thanks_message'
                } );
            } );
        } );</script>
        <div class="notice is-dismissible droit-thanks-notice droit-thanks-for-install">
            <div class="droit-thanks-notice-inner">
                <div class="droit-thanks-notice-content">
                    <h3><?php esc_html_e( 'Thanks for using Droit Elementor Addons!', 'droit-elementor-addons' ); ?></h3>
                    <p><?php esc_html_e( 'Droit Elementor Addons is a bundle of super useful widgets. Build a beautiful website using this addon without any hassle. Just plug and play.', 'droit-elementor-addons' ); ?></p>
                </div>
            </div>
        </div>
        <?php
    }
    public function ajax_droit_addons_set_thanks_message() {
        update_user_meta( get_current_user_id(), '_droit_addons_thanks_notice', 'true' );
        die;
    }
    /**
     * Upgrade Notice for indivisual user notice
     * Upgrade message to indivisual users.
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function version_upgrade_solved() {
        
        if ( 'true' === get_user_meta( get_current_user_id(), '_droit_addons_upgrade_notice', true ) ) {
            return;
        }

    ?>
    <style>
        .notice.droit-upgrade-notice {
            border-left-color: #574ff7 !important;
            padding: 20px;
        }
        .rtl .notice.droit-upgrade-notice {
            border-right-color: #574ff7 !important;
        }
        .notice.droit-upgrade-notice h3 {
            margin: 0 0 5px;
        }
        .notice.droit-upgrade-notice p {
            padding: 0;
            margin: 0;
        }
    </style>
    <script>jQuery( function( $ ) {
            $( 'div.notice.droit-upgrade-notice' ).on( 'click', 'button.notice-dismiss', function( event ) {
                event.preventDefault();

                $.post( ajaxurl, {
                    action: 'droit_addons_set_version_upgrade_message'
                } );
            } );
        } );</script>
        <div class="notice is-dismissible droit-thanks-notice droit-upgrade-notice">
            <div class="droit-thanks-notice-inner">
                <div class="droit-thanks-notice-content">
                    <h3><?php esc_html_e( 'Critical notice about Droit Elementor Addons!', 'droit-elementor-addons' ); ?></h3>
                    <p><?php esc_html_e( 'We have optimized performance of our addons by improving css loading system. That\'s why if you face any issues (i.e. if layout breaks or any widget causes trouble), please do the following:', 'droit-elementor-addons' ); ?></p>
                    <ul>
                        <li>1. Go to "Elements" tab in Droit Elementor Addons.</li>
                        <li>2. Then enable all the widgets or the widgets you have used.</li>
                        <li>3. If they are already enabled, please disable and re-enable them.</li>
                    </ul>   
                </div>
            </div>
        </div>
        <?php
    }
    public function droit_addons_set_version_upgrade_message() {
        update_user_meta( get_current_user_id(), '_droit_addons_upgrade_notice', 'true' );
        die;
    }
    /**
     * Minimum elementor version notice
     * Warning when the site doesn't have a minimum required Elementor version.
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function droit_elementor_addons_notice_minimum_elementor_version(){
        if ( ! current_user_can( 'update_plugins' ) ) {
            return;
        }
        $file_path = 'elementor/elementor.php';

        $upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
        $_button_text = __('Update Elementor', 'droit-elementor-addons');
       
        $message = sprintf(
            esc_html__('"%1$s" requires minimum "%2$s" version %3$s or greater.', 'droit-elementor-addons'),
            '<strong>' . esc_html__('Droit Elementor', 'droit-elementor-addons') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'droit-elementor-addons') . '</strong>',
            DROIT_MINIMUM_EL_VERSION
        );
    ?>
    <style>
        .notice.droit-minimum-el-version-elementor-notice {
            border-left-color: #574ff7 !important;
            padding: 20px;
        }
        .rtl .notice.droit-minimum-el-version-elementor-notice {
            border-right-color: #574ff7 !important;
        }
        .notice.droit-minimum-el-version-elementor-notice .droit-minimum-el-version-elementor-notice-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .notice.droit-minimum-el-version-elementor-notice .droit-minimum-el-version-elementor-notice-inner .droit-minimum-el-version-elementor-notice-icon,
        .notice.droit-minimum-el-version-elementor-notice .droit-minimum-el-version-elementor-notice-inner .droit-minimum-el-version-elementor-notice-content,
        .notice.droit-minimum-el-version-elementor-notice .droit-minimum-el-version-elementor-notice-inner .droit-minimum-el-version-elementor-install-now {
            display: table-row;
            align-items: center;
            justify-content: space-between;        }
        .notice.droit-minimum-el-version-elementor-notice .droit-minimum-el-version-elementor-notice-icon {
            color: #574ff7;
            font-size: 50px;
            width: 50px;
        }
        .notice.droit-minimum-el-version-elementor-notice .droit-minimum-el-version-elementor-notice-content {
            padding: 0 0px;
        }
        .notice.droit-minimum-el-version-elementor-notice p {
            padding: 0;
            margin: 0;
        }
        .notice.droit-minimum-el-version-elementor-notice h3 {
            margin: 0 0 5px;
        }
        .notice.droit-minimum-el-version-elementor-notice .droit-minimum-el-version-elementor-install-now {
            text-align: center;
        }
        .notice.droit-minimum-el-version-elementor-notice .droit-minimum-el-version-elementor-install-now .droit-minimum-el-version-elementor-install-button {
            padding: 5px 30px;
            height: auto;
            line-height: 20px;
            text-transform: capitalize;
            border-color: #a533ff !important;
            background-image: linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21% )!important;
            background-image: -moz-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
            background-image: -webkit-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
            background-image: -ms-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
        }
        .notice.droit-minimum-el-version-elementor-notice .droit-minimum-el-version-elementor-install-now .droit-minimum-el-version-elementor-install-button i {
            padding-right: 5px;
        }
        .rtl .notice.droit-minimum-el-version-elementor-notice .droit-minimum-el-version-elementor-install-now .droit-minimum-el-version-elementor-install-button i {
            padding-right: 0;
            padding-left: 5px;
        }
        .notice.droit-minimum-el-version-elementor-notice .droit-minimum-el-version-elementor-install-now .droit-minimum-el-version-elementor-install-button:active {
            transform: translateY(1px);
        }
        @media (max-width: 767px) {
            .notice.droit-minimum-el-version-elementor-notice {
                padding: 10px;
            }
        }
    </style>
    <div class="notice updated droit-minimum-el-version-elementor-notice droit-minimum-el-version-elementor-install-elementor">
        <div class="droit-minimum-el-version-elementor-notice-inner">
            <div class="droit-minimum-el-version-elementor-notice-content">
                <h3><?php esc_html_e( 'Thanks for installing Droit Elementor Addons!', 'droit-elementor-addons' ); ?></h3>
                <p><?php echo $message ; ?></p>
            </div>

            <div class="droit-minimum-el-version-elementor-install-now">
                <a class="button button-primary droit-minimum-el-version-elementor-install-button" href="<?php echo esc_attr( $upgrade_link ); ?>"><i class="dashicons dashicons-download"></i><?php echo $_button_text; ?></a>
            </div>
        </div>
    </div>
    <?php
    }

    /**
     * Admin PHP required version notice
     * Warning when the site doesn't have a minimum required PHP version.
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public function droit_elementor_addons_notice_minimum_php_version(){
            $message = sprintf(__("Your current PHP version is <strong> " . PHP_VERSION . " </strong>. You need to upgrade your PHP version to <strong> " . DROIT_EL_ADDONS_PHP_VERSION . " or later</strong> to run droit elementor addons plugin.", "droit-elementor-addons"));
            ?>
            <style>
            .notice.droit-addons-elementor-notice {
                border-left-color: #574ff7 !important;
                padding: 20px;
            }
            .rtl .notice.droit-addons-elementor-notice {
                border-right-color: #574ff7 !important;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner .droit-addons-elementor-notice-icon,
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner .droit-addons-elementor-notice-content,
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-inner .droit-addons-elementor-install-now {
                display: table-row;
                align-items: center;
                justify-content: space-between;        }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-icon {
                color: #33ccff;
                font-size: 50px;
                width: 50px;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-notice-content {
                padding: 0 0px;
            }
            .notice.droit-addons-elementor-notice p {
                padding: 0;
                margin: 0;
            }
            .notice.droit-addons-elementor-notice h3 {
                margin: 0 0 5px;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now {
                text-align: center;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button {
                padding: 5px 30px;
                height: auto;
                line-height: 20px;
                text-transform: capitalize;
                border-color: #a533ff !important;
                background-image: linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21% )!important;
                background-image: -moz-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
                background-image: -webkit-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
                background-image: -ms-linear-gradient( 85.05deg, #574ff7 6.33%, #a533ff 102.21%)!important;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button i {
                padding-right: 5px;
            }
            .rtl .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button i {
                padding-right: 0;
                padding-left: 5px;
            }
            .notice.droit-addons-elementor-notice .droit-addons-elementor-install-now .droit-addons-elementor-install-button:active {
                transform: translateY(1px);
            }
            @media (max-width: 767px) {
                .notice.droit-addons-elementor-notice {
                    padding: 10px;
                }
            }
        </style>
            <div class="notice updated droit-addons-elementor-notice droit-addons-elementor-install-elementor">
                <div class="droit-addons-elementor-notice-inner">
                    <div class="droit-addons-elementor-notice-content">
                        <h3><?php esc_html_e( 'Thanks for installing Droit Elementor Addons!', 'droit-elementor-addons' ); ?></h3>
                        <p><?php echo $message ?></p>
                    </div>
                </div>
            </div>
            <?php
    }

    /**
     * Remove plugin data
     * Warning when the site doesn't have Elementor installed or activated.
     * @access public
     * @since 1.0.0
     * Feature added by : DroitLab Team
     */
    public static function droit_elementor_remove_data()
    {
        delete_option(self::__OPTION_VERSION__);
        delete_option(self::__OPTION_DL_PRO_LINK__);
        delete_option(self::__OPTION_DL_DEMO_LINK__);
    }
    /**
     * Default widget Key
     * @since 1.0.0
     * @static
     * @return string
     * Feature added by : DroitLab Team
     */ 
    public static function droit_addons_widget_map_default() {
        $elements = [
            'accordion',
            'alert',
            'animated_text',
            'banner',
            'blog',
            'bloglist',
            'card',
            'countdown',
            'seven_form',
            'faq',
            'infobox',
            'iconbox',
            'image_carousel',
            'newstricker',
            'pricing',
            'process',
            'share_button',
            'tab',
            'team',
            'testimonial',
            'timeline',
            'twitter_feed',
            'table',
            'title',
        ];
        return $elements;
    }
    /**
     * Save default widget
     * @since 1.0.0
     * @static
     * @return string
     * Feature added by : DroitLab Team
     */
    public static function droit_save_defaults(){
        $widget = self::droit_addons_widget_map_default();
        if (!get_option(self::__OPTION_KEY__)) {
            update_option(self::__OPTION_KEY__, array(
                self::__OPTION_FREE__ =>  $widget
            ));
        }  
    }
    /**
     * Editor css load by enable widget
     * Feature added by : DroitLab Team
     * @since : 1.0.0
     */
    public static function droit_save_editor_css_cache() {

        $active_widgets = self::droit_addons_widget_map_default();
        $widget_css = '';
        $widget_css_size = 0;

        foreach ($active_widgets as $file_name) {
            $widget_key = str_replace(['_', ' ', '__'], '-', $file_name);
            $script_file_name = strtolower($file_name);
            $css_patha = DROIT_EL_ADDONS_DIR_PATH . "modules/widgets/{$widget_key}/scripts/dl_{$script_file_name}.min.css";
            if (is_readable($css_patha)) {
                $widget_css_size += filesize($css_patha);
                $widget_css.= file_get_contents($css_patha);
            };
        }

        $editor_file_path = DROIT_EL_ADDONS_DIR_PATH . "assets/vendor/editor/main.min.css";
        
        $editor_css_size = filesize($editor_file_path);

        $minified = self::droit_css_minify($widget_css);

        if($editor_css_size != $widget_css_size){
            file_put_contents($editor_file_path, $minified);
        }
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
    /**
     * Autoloader
     * @since 1.0.0
     * @access private
     * @return string
     * Feature added by : DroitLab Team
     */
    private static function _autoloader()
    {
        spl_autoload_register(function ($class) {
            
            // check namespace
            if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
                return;
            }
            
            $relative_class = preg_replace('/^'.__NAMESPACE__.'\\\/', '', $class);
            $final_class = __NAMESPACE__.'\\'.$relative_class;

            if(!class_exists($final_class)) {
                $map = self::classes_map();

                $fileName = isset($map[$relative_class]) ? $map[$relative_class] : strtolower(preg_replace(['/([a-z])([A-Z])/', '/_/', '/\\\/'], ['$1-$2', '-', "/"], $relative_class)).'.php';

                if( is_readable(DROIT_EL_ADDONS_DIR_PATH . $fileName)){
                    require DROIT_EL_ADDONS_DIR_PATH . $fileName;
                }
            }
        });
    }
    
    /**
     * Load File
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    private static function classes_map()
    {
        return [
            'Admin_Dashboard' => 'admin/dashboard/admin-dashboard.php',
            'Admin_Menu' => 'admin/dashboard/admin-menu.php',
            'Settings' => 'admin/api/settings.php',
            'Admin_View' => 'admin/api/callbacks/admin-view.php',
            'Ajax_Manager' => 'admin/ajax-manager.php',
            'Images' => 'core/droit-images.php',
            'Feedback' => 'core/feedback.php',
            'Init' => 'core/init.php',
            'Manage_Update' => 'core/manage-update.php',
            'Cache\Base' => 'modules/cache/base.php',
            'Cache\Files' => 'modules/cache/files.php',
            'Cache\Manager' => 'modules/cache/manager.php',
            'Utils' => 'core/utils.php',
            'Core\Utils' => 'core/utils.php',
            'Droit_Elements' => 'modules/widgets/droit-elements.php',
            'Templates\Import_Template' => 'modules/templates/import-template.php',
            'Templates\Library_Api' => 'modules/templates/library-api.php',
            'Templates\Load_Template' => 'modules/templates/load-template.php',
            'Templates\Template_Enqueue_Manager' => 'modules/templates/template-enqueue-manager.php',
            'Module\Controls\Droit_Control' => 'modules/controls/droit-control.php',
            'Module\Controls\Icons\Droit_Icons' => 'modules/controls/icons/droit-icons.php',
            'Module\Extention\Common_Section' => 'modules/extention/common-section.php',
            'Module\Extention\Custom_Column' => 'modules/extention/custom-column.php',
        ];
    }
    /**
     * Init components.
     * Initialize Droit Pro components. Register actions, run setting manager,
     * @since 1.0.0
     * @access private
     * Feature added by : DroitLab Team
     */
    private function droit_init_components(){
        new Admin_Dashboard();
        new Admin_Menu();
        new Settings();
        new Admin_View();
        new Ajax_Manager();
        new Images();
        new Feedback();
        new Init();
        new Manage_Update();
        new Cache\Base();
        new Cache\Files();
        new Cache\Manager();
        new Droit_Elements();
        new Templates\Import_Template();
        new Templates\Library_Api();
        new Templates\Load_Template();
        new Templates\Template_Enqueue_Manager();
        new Module\Controls\Droit_Control();
        new Module\Controls\Icons\Droit_Icons();
        new Module\Extention\Common_Section();
        new Module\Extention\Custom_Column();
    }
}

/**
 * Initialize Main Plugin
 * @since 1.0.0
 */
function _droit_plugin_run() {
    return Core::instance();
}

// Run the Plugin
_droit_plugin_run();