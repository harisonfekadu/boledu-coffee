<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR\Traits;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}


if (!trait_exists('Server')) {
	trait Server
	{
		

		/**
		 * Site Name
		 * @return string
		 * Feature added by : DroitLab Team
		 * @since : 1.0.0
		*/
		public function droit_addons_site_name() {
	        $droit_el_site_name = get_bloginfo( 'name' );

	        if ( empty( $droit_el_site_name ) ) {
	            $droit_el_site_name = get_bloginfo( 'description' );
	            $droit_el_site_name = wp_trim_words( $droit_el_site_name, 3, '' );
	        }

	        if ( empty( $droit_el_site_name ) ) {
	            $droit_el_site_name = get_bloginfo( 'url' );
	        }

	        return $droit_el_site_name;
	    }
		/**
		 * Get WordPress related data
		 * @return string
		 * Feature added by : DroitLab Team
		 * @since : 1.0.0
		*/
	    public function droit_addons_wpinfo() {
	        $wp_data = array();

	        $wp_data['memory_limit'] = WP_MEMORY_LIMIT;
	        $wp_data['debug_mode']   = ( defined('WP_DEBUG') && WP_DEBUG ) ? 'Yes' : 'No';
	        $wp_data['locale']       = get_locale();
	        $wp_data['version']      = get_bloginfo( 'version' );
	        $wp_data['multisite']    = is_multisite() ? 'Yes' : 'No';

	        return $wp_data;
	    }
	    /**
		 * Server Information
		 * @return string
		 * Feature added by : DroitLab Team
		 * @since : 1.0.0
		*/ 
	    public function droit_addons_serverinfo() {
	        global $wpdb;

	        $droit_data = array();

	        if ( isset( $_SERVER['SERVER_SOFTWARE'] ) && ! empty( $_SERVER['SERVER_SOFTWARE'] ) ) {
	            $droit_data['software'] = $_SERVER['SERVER_SOFTWARE'];
	        }

	        if ( function_exists( 'phpversion' ) ) {
	            $droit_data['php_version'] = phpversion();
	        }

	        $droit_data['mysql_version']        = $wpdb->db_version();

	        $droit_data['php_max_upload_size']  = size_format( wp_max_upload_size() );
	        $droit_data['php_soap']             = class_exists( 'SoapClient' ) ? 'Yes' : 'No';
	        $droit_data['php_default_timezone'] = date_default_timezone_get();
	        $droit_data['php_fsockopen']        = function_exists( 'fsockopen' ) ? 'Yes' : 'No';
	        $droit_data['php_curl']             = function_exists( 'curl_init' ) ? 'Yes' : 'No';

	        return $droit_data;
	    }
		/**
		 * Ip address
		 * @return string
		 * Feature added by : DroitLab Team
		 * @since : 1.0.0
		*/ 
	    public function droit_addons_ip_address() {
	        $response = wp_remote_get( 'https://icanhazip.com/' );

	        if ( is_wp_error( $response ) ) {
	            return '';
	        }

	        $ip = trim( wp_remote_retrieve_body( $response ) );

	        if ( ! filter_var( $ip, FILTER_VALIDATE_IP ) ) {
	            return '';
	        }

	        return $ip;
	    }
	    /**
		 * Local server
		 * @return string
		 * Feature added by : DroitLab Team
		 * @since : 1.0.0
		*/ 
	    public function droit_addons_is_local_servers() {
	        return false;

	        $is_local = in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1' ) );

	        return $is_local ;
	    }

	}
}