<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

$acf_footer = gilber_get_theme_mod( 'page_custom_footer', true );

if ( gilber_get_theme_mod( 'footer_show', $acf_footer ) == 'show' ) {
	get_template_part( 'template-parts/footer/footer', gilber_get_theme_mod( 'footer_layout', $acf_footer ) );
}