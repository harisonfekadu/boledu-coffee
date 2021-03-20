<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

define( 'GILBER_THEME_DIRECTORY', trailingslashit( get_template_directory_uri() ) );
define( 'GILBER_REQUIRE_DIRECTORY', trailingslashit( get_template_directory() ) );
define( 'GILBER_DEVELOPMENT', false );

/**
 * After setup theme
 */
if ( ! function_exists( 'gilber_setup' ) ) {
	function gilber_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Ducky, use a find and replace
		 * to change 'gilber' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'gilber', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1920, 9999 );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array(
			'gallery',
			'link',
			'quote',
			'video',
			'audio'
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		add_theme_support( 'dark-editor-style' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name' => esc_html__( 'Small', 'gilber' ),
					'shortName' => esc_html__( 'S', 'gilber' ),
					'size' => 14,
					'slug' => 'small',
				),
				array(
					'name' => esc_html__( 'Normal', 'gilber' ),
					'shortName' => esc_html__( 'M', 'gilber' ),
					'size' => 16,
					'slug' => 'normal',
				),
				array(
					'name' => esc_html__( 'Large', 'gilber' ),
					'shortName' => esc_html__( 'L', 'gilber' ),
					'size' => 28,
					'slug' => 'large',
				),
				array(
					'name' => esc_html__( 'Huge', 'gilber' ),
					'shortName' => esc_html__( 'XL', 'gilber' ),
					'size' => 38,
					'slug' => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name' => esc_html__( 'First', 'gilber' ),
				'slug' => 'first',
				'color' => gilber_get_theme_mod( 'accent_color' ),
			),
			array(
				'name' => esc_html__( 'White', 'gilber' ),
				'slug' => 'white',
				'color' => '#ffffff',
			),
			array(
				'name' => esc_html__( 'Gray', 'gilber' ),
				'slug' => 'gray',
				'color' => '#999999',
			)
		) );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Gutenberg
		add_theme_support( 'align-wide' );

		// register nav menus
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary Menu', 'gilber' ),
			'onepage-menu' => esc_html__( 'Onepage Menu', 'gilber' ),
			'navbar-menu' => esc_html__( 'Navbar Menu', 'gilber' ),
		) );

		// 800x600
		add_image_size( 'gilber-800x600_crop', 800, 600, true );
		add_image_size( 'gilber-800x600', 800 );

		// 1280x720
		add_image_size( 'gilber-1280x720_crop', 1280, 720, true );
		add_image_size( 'gilber-1280x720', 1280 );

		// 1920x1080
		add_image_size( 'gilber-1920x1080_crop', 1920, 1080, true );
		add_image_size( 'gilber-1920x1080', 1920 );

	}
}
add_action( 'after_setup_theme', 'gilber_setup' );

/**
 * Content width
 */
if ( ! function_exists( 'gilber_content_width' ) ) {
	function gilber_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'gilber/content_width', 1110 );
	}
}
add_action( 'after_setup_theme', 'gilber_content_width', 0 );

/**
 * Import ACF fields
 */
if ( ! GILBER_DEVELOPMENT ) {
	function gilber_acf_show_admin_panel() {
		return apply_filters( 'gilber/acf_show_admin_panel', false );
	}
	add_filter( 'acf/settings/show_admin', 'gilber_acf_show_admin_panel' );
}

if ( ! GILBER_DEVELOPMENT ) {
	require_once GILBER_REQUIRE_DIRECTORY . 'inc/helper/custom-fields/custom-fields.php';
}

if ( ! function_exists( 'gilber_acf_save_json' ) ) {
	function gilber_acf_save_json( $path ) {
		$path = GILBER_REQUIRE_DIRECTORY . 'inc/helper/custom-fields';
		return $path;
	}
}
add_filter( 'acf/settings/save_json', 'gilber_acf_save_json' );

if ( GILBER_DEVELOPMENT ) {
	if ( ! function_exists( 'gilber_acf_load_json' ) ) {
		function gilber_acf_load_json( $paths ) {
			unset( $paths[0] );
			$paths[] = GILBER_REQUIRE_DIRECTORY . 'inc/helper/custom-fields';
			return $paths;
		}
	}
	add_filter( 'acf/settings/load_json', 'gilber_acf_load_json' );
}

/**
 * Include Kirki fields
 */
require_once GILBER_REQUIRE_DIRECTORY . 'inc/framework/customizer-helper.php';
require_once GILBER_REQUIRE_DIRECTORY . 'inc/framework/customizer.php';

/**
 * Required files
 */
$gilber_theme_includes = array(
	'required-plugins',
	'enqueue',
	'includes',
	'ocdi',
	'functions',
	'actions',
	'filters',
	'menus'
);

foreach ( $gilber_theme_includes as $file ) {
	require_once GILBER_REQUIRE_DIRECTORY . 'inc/theme-' . $file . '.php';
}

// Unset the global variable.
unset( $gilber_theme_includes );