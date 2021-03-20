<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

if ( ! function_exists( 'gilber_dynamic_css' ) ) {
	function gilber_dynamic_css( $css ) {
		$css .= '';

		return $css;
	}
}
add_filter( 'kirki_gilber_customize_dynamic_css', 'gilber_dynamic_css' );