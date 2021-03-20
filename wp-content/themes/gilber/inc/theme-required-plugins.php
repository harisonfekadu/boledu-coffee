<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

/**
 * Required plugins
 */
if ( ! function_exists( 'gilber_tgm_plugins' ) ) {
	function gilber_tgm_plugins() {

		$source = 'http://paul-themes.com/wordpress/gilber/plugins/';

		$plugins = array(
			array(
				'name' => esc_html__( 'Kirki', 'gilber' ),
				'slug' => 'kirki',
				'required' => true,
			),
			array(
				'name' => esc_html__( 'Gilber Helper Plugin', 'gilber' ),
				'slug' => 'gilber_helper_plugin',
				'source' => esc_url( $source . 'gilber_helper_plugin.zip' ),
				'required' => true,
			),
			array(
				'name' => esc_html__( 'Advanced Custom Fields PRO', 'gilber' ),
				'slug' => 'advanced-custom-fields-pro',
				'source' => esc_url( $source . 'advanced-custom-fields-pro.zip' ),
				'required' => true,
			),
			array(
				'name' => esc_html__( 'Elementor Page Builder', 'gilber' ),
				'slug' => 'elementor',
				'required' => false,
			),
			array(
				'name' => esc_html__( 'Contact Form 7', 'gilber' ),
				'slug' => 'contact-form-7',
				'required' => false,
			),
			array(
				'name' => esc_html__( 'GTranslate', 'gilber' ),
				'slug' => 'gtranslate',
				'required' => false,
			),
			array(
				'name' => esc_html__( 'Regenerate Thumbnails', 'gilber' ),
				'slug' => 'regenerate-thumbnails',
				'required' => false,
			),
			array(
				'name' => esc_html__( 'One Click Demo Import', 'gilber' ),
				'slug' => 'one-click-demo-import',
				'required' => false,
			)
		);
		tgmpa( $plugins );
	}
}
add_action( 'tgmpa_register', 'gilber_tgm_plugins' );

/**
 * Print notice if helper plugin is not installed
 */
if ( ! function_exists( 'gilber_helper_plugin_notice' ) ) {
	function gilber_helper_plugin_notice() {
		if ( class_exists( 'VLThemesHelperPlugin' ) ) {
			return;
		}
		echo '<div class="notice notice-info is-dismissible"><p>' . sprintf( __( 'Please activate <strong>%s</strong> before your work with this theme.', 'gilber' ), 'Gilber Helper Plugin' ) . '</p></div>';
	}
}
add_action( 'admin_notices', 'gilber_helper_plugin_notice' );