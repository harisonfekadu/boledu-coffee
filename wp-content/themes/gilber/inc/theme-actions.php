<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

/**
 * Register sidebars
 */
if ( ! function_exists( 'gilber_register_sidebar' ) ) {
	function gilber_register_sidebar() {
		register_sidebar( array(
			'name' => esc_html__( 'Blog Sidebar', 'gilber' ),
			'id' => 'blog_sidebar',
			'description' => esc_html__( 'Blog Widget Area', 'gilber' ),
			'before_widget' => '<div id="%1$s" class="vlt-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="vlt-widget__title">',
			'after_title' => '</h5>'
		) );
	}
}
add_action( 'widgets_init', 'gilber_register_sidebar' );

/**
 * Fixed socials
 */
if ( ! function_exists( 'gilber_fixed_socials' ) ) {
	function gilber_fixed_socials() {

		// fixed socials
		if ( gilber_get_theme_mod( 'fixed_socials_show' ) == 'show' && gilber_get_theme_mod( 'fixed_socials_list' ) ) :

			echo '<div class="vlt-fixed-socials">';
			foreach ( gilber_get_theme_mod( 'fixed_socials_list' ) as $socialItem ) :
				echo '<a class="vlt-social-icon vlt-social-icon--style-1" href="' . esc_url( $socialItem[ 'social_url' ] ) . '" target="_blank"><i class="' . esc_attr( $socialItem[ 'social_class' ] ) . '"></i></a>';
			endforeach;

			echo '</div>';

		endif;

	}
}
add_action( 'wp_body_open', 'gilber_fixed_socials' );

/**
 * Change admin logo
 */
if ( ! function_exists( 'gilber_change_admin_logo' ) ) {
	function gilber_change_admin_logo() {
		if ( ! gilber_get_theme_mod( 'login_logo_image' ) ) {
			return;
		}
		$image_url = gilber_get_theme_mod( 'login_logo_image' );
		$image_w = gilber_get_theme_mod( 'login_logo_image_width' );
		$image_h = gilber_get_theme_mod( 'login_logo_image_height' );
		echo '<style type="text/css">
			h1 a {
				background: transparent url(' . esc_url( $image_url ) . ') 50% 50% no-repeat !important;
				width:' . esc_attr( $image_w ) . '!important;
				height:' . esc_attr( $image_h ) . '!important;
				background-size: cover !important;
			}
		</style>';
	}
}
add_action( 'login_head', 'gilber_change_admin_logo' );

/**
 * Prints Tracking code
 */
if ( ! function_exists( 'gilber_print_tracking_code' ) ) {
	function gilber_print_tracking_code() {
		$tracking_code = gilber_get_theme_mod( 'tracking_code' );
		if ( ! empty( $tracking_code ) ) {
			echo '' . $tracking_code;
		}
	}
}
add_action( 'wp_head', 'gilber_print_tracking_code' );