<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR\Traits;
use \DROIT_ELEMENTOR\Utils as Droit_Utils;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if (!trait_exists('Enqueue')) {
    trait Enqueue
    {
        use Server;
        
        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_gloabl_script()
        {
            $min_suffix = Droit_Utils::droit_addons_script_debug_enabled() ? '.' : '.min';

            //style
            wp_enqueue_style("droit-global", droit_addons_protocol('/assets/plugins/css/global.min.css'), array(), DROIT_EL_ADDONS_VERSION);

            //script
            wp_enqueue_script("droit-global", droit_addons_protocol('/assets/plugins/js/global.min.js'), array('jquery'), DROIT_EL_ADDONS_VERSION, true);
             $localized_settings = [
                'version'        => Droit_Utils::droit_addons_el_new_version(),
                'has_pro'        => Droit_Utils::droit_addons_has_pro(),
            ];
            wp_localize_script(
                'droit-global',
                'DroitGlobal',
                $localized_settings
            );
        }
        //Admin Css
        public static function droit_addons_admin_style() {
            ?>
            <style>
                #toplevel_page_droit-addons a.toplevel_page_droit-addons{
                    background: -webkit-linear-gradient(4.95deg, #574ff7 6.33%, #a533ff 102.21%) !important;
                    background: linear-gradient(85.05deg, #574ff7 6.33%, #a533ff 102.21%) !important
                }
            </style>
        <?php }
        /**
         * Feature added by : DroitLab Team
         * @since : 1.0.0
         */
        public static function droit_addons_dashboard_script()
        {
            $min_suffix = Droit_Utils::droit_addons_script_debug_enabled() ? '.' : '.min';

            //style
            wp_enqueue_style("droit-icons", droit_addons_protocol('/assets/plugins/css/icons.min.css'), array(), DROIT_EL_ADDONS_VERSION);

            wp_enqueue_style("droit-plugins", droit_addons_protocol('/assets/plugins/css/plugins.min.css'), array(), DROIT_EL_ADDONS_VERSION);

            wp_enqueue_style("droit-admin", droit_addons_protocol('/assets/plugins/css/admin.min.css'), array(), DROIT_EL_ADDONS_VERSION);

            //script
            wp_enqueue_script("droit-plugins", droit_addons_protocol('/assets/plugins/js/plugins.min.js'), array('jquery'), DROIT_EL_ADDONS_VERSION, true);
            
            wp_enqueue_script("ajax-chimp", droit_addons_protocol('/assets/plugins/js/ajax-chimp.js'), array('jquery'), DROIT_EL_ADDONS_VERSION, true);

            wp_enqueue_script("droit-admin", droit_addons_protocol('/assets/plugins/js/admin.min.js'), array('jquery'), DROIT_EL_ADDONS_VERSION, true);

            $localized_settings = [
                'version'            => DROIT_EL_ADDONS_VERSION,
                'droit_site'         => Droit_Utils::droit_addons_site_link(),
                'assets_url'         => DROIT_EL_ADDONS_ASSETS_URL,
                '_is_pro'            => !Droit_Utils::droit_addons_has_pro(),
                //'nonce'              => wp_create_nonce( 'droit_cache_nonce' ),
                'post_id'            => get_queried_object_id(),
                'ajax_url'           => admin_url( 'admin-ajax.php' )
            ];
            wp_localize_script(
                'droit-admin',
                'DroitAdminPanel',
                $localized_settings
            );

        }
    }

}
