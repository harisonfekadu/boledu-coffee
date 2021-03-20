<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

$footer_class = 'vlt-footer vlt-footer--default';

$acf_footer = gilber_get_theme_mod( 'page_custom_footer', true );

if ( gilber_get_theme_mod( 'footer_fixed', $acf_footer ) == 'enable' ) {
	$footer_class .= ' vlt-footer--fixed';
}

if ( is_404() ) {
	$footer_class .= ' vlt-footer--fixed';
}

?>

<footer class="<?php echo gilber_sanitize_class( $footer_class ); ?>">

	<?php if ( gilber_get_theme_mod( 'footer_copyright' ) ) : ?>

		<div class="vlt-footer-copyright">

			<?php echo wp_kses_post( gilber_get_theme_mod( 'footer_copyright' ) ); ?>

		</div>
		<!-- /.vlt-footer-copyright -->

	<?php endif; ?>

	<?php if ( gilber_get_theme_mod( 'footer_locales' ) == 'show' ) : ?>

		<div class="vlt-language-switcher">

			<?php

				if ( class_exists( 'GTranslate' ) ) {
					echo do_shortcode( '[gtranslate]' );
				}

			?>

		</div>
		<!-- /.vlt-language-switcher -->

	<?php endif; ?>

</footer>
<!-- /.vlt-footer -->