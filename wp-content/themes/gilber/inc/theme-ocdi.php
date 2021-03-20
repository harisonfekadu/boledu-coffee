<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

/**
 * Demo import
 */
if ( ! function_exists( 'gilber_demo_import_files' ) ) {
	function gilber_demo_import_files() {
		return array(
			array(
				'import_file_name' => esc_html__( 'Demo Import', 'gilber' ),
				'local_import_file' => GILBER_REQUIRE_DIRECTORY . 'inc/demo/demo-content.xml',
				'local_import_widget_file' => GILBER_REQUIRE_DIRECTORY . 'inc/demo/widgets.wie',
				'local_import_customizer_file' => GILBER_REQUIRE_DIRECTORY . 'inc/demo/customizer.dat'
			),
		);
	}
}
add_filter( 'pt-ocdi/import_files', 'gilber_demo_import_files' );

/**
 * Disable regenerate thumbnails
 */
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

/**
 * After setup function
 */
if ( ! function_exists( 'gilber_after_import_setup' ) ) {
	function gilber_after_import_setup() {

		global $wp_rewrite;

		// Update permalink
		$wp_rewrite->set_permalink_structure( '/%postname%/' );

		// Set menus
		$primary_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
		$onepage_menu = get_term_by( 'name', 'Onepage Menu', 'nav_menu' );
		$navbar_menu = get_term_by( 'name', 'Navbar Menu', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
			'primary-menu' => $primary_menu->term_id,
			'onepage-menu' => $onepage_menu->term_id,
			'navbar-menu' => $navbar_menu->term_id,
		) );

		// Set pages
		$front_page = get_page_by_title( 'Fullpage Slider' );
		if ( isset( $front_page->ID ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page->ID );
		}

		// Update option
		update_option( 'date_format', 'd F Y' );

		// Set default vars for Elementor
		if (!get_option('elementor_disable_color_schemes')) {
			update_option('elementor_disable_color_schemes', 'yes');
		}

		if (!get_option('elementor_disable_typography_schemes')) {
			update_option('elementor_disable_typography_schemes', 'yes');
		}

		$cpt_support = get_option( 'elementor_cpt_support' );

		// Check if option DOESN'T exist in db
		if ( ! $cpt_support ) {
			$cpt_support = [ 'page', 'post', 'portfolio' ]; // create array of our default supported post types
			update_option( 'elementor_cpt_support', $cpt_support ); // write it to the database
		}

		// If it DOES exist, but portfolio is NOT defined
		else if ( ! in_array( 'portfolio', $cpt_support ) ) {
			$cpt_support[] = 'portfolio'; // append to array
			update_option( 'elementor_cpt_support', $cpt_support ); // update database
		}

	}
}
add_action( 'pt-ocdi/after_import', 'gilber_after_import_setup' );