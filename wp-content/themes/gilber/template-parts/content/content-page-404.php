<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

?>

<article <?php post_class( 'vlt-page vlt-page--404' ); ?>>

	<div class="container">

		<div class="vlt-404-icon">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x" viewBox="0 0 24 24">
			<defs/>
			<path d="M18 6L6 18M6 6l12 12"/>
			</svg>
		</div>

		<h1><?php echo esc_html( gilber_get_theme_mod( 'error_title' ) ); ?></h1>

		<p><?php echo wp_kses_post( gilber_get_theme_mod( 'error_subtitle' ) ); ?></p>

		<a class="vlt-btn vlt-btn--secondary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php esc_html_e( 'Back to Home', 'gilber' ); ?>
		</a>

	</div>

</article>
<!-- /.vlt-page--404 -->