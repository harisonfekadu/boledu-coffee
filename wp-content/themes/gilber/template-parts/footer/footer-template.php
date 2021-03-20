<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

$footer_class = 'vlt-footer vlt-footer--template';

$acf_footer = gilber_get_theme_mod( 'page_custom_footer', true );

if ( gilber_get_theme_mod( 'footer_fixed', $acf_footer ) == 'enable' ) {
	$footer_class .= ' vlt-footer--fixed';
}

$footer_template = gilber_get_theme_mod( 'footer_template', $acf_footer );

?>

<footer class="<?php echo gilber_sanitize_class( $footer_class ); ?>">

	<?php echo gilber_render_elementor_template( $footer_template ); ?>

</footer>
<!-- /.vlt-footer -->