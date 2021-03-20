<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

$acf_navbar = gilber_get_theme_mod( 'page_custom_navigation', true );

if ( gilber_get_theme_mod( 'navigation_show', $acf_navbar ) == 'hide' ) {
	return;
}

$header_class = 'vlt-header';
$navbar_class = 'vlt-navbar vlt-navbar--main';

if ( gilber_get_theme_mod( 'navigation_opaque', $acf_navbar ) == 'enable' ) {
	$header_class .= ' vlt-header--opaque';
}

if ( gilber_get_theme_mod( 'navigation_transparent', $acf_navbar ) == 'enable' ) {
	$navbar_class .= ' vlt-navbar--transparent';
}

if ( gilber_get_theme_mod( 'navigation_transparent_always', $acf_navbar ) == 'enable' ) {
	$navbar_class .= ' vlt-navbar--transparent-always';
}

if ( gilber_get_theme_mod( 'navigation_sticky', $acf_navbar ) == 'enable' ) {
	$navbar_class .= ' vlt-navbar--sticky';
}

?>

<header class="<?php echo gilber_sanitize_class( $header_class ); ?>">

	<div class="<?php echo gilber_sanitize_class( $navbar_class ); ?>">

		<div class="vlt-navbar-background"></div>

		<div class="vlt-navbar-inner">

			<div class="vlt-navbar-inner--left">

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="vlt-navbar-logo">
					<?php if ( gilber_get_theme_mod( 'navigation_logo' ) ) : ?>
						<img src="<?php echo esc_url( gilber_get_theme_mod( 'navigation_logo' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="black">
					<?php else: ?>
						<h2><?php bloginfo( 'name' ); ?></h2>
					<?php endif; ?>
				</a>
				<!-- .vlt-navbar-logo -->

			</div>

			<div class="vlt-navbar-inner--center">

				<div class="container">

					<nav class="vlt-default-menu__navigation">

						<?php

							$acf_onepage_navigation = gilber_get_theme_mod( 'onepage_navigation', true );

							if ( $acf_onepage_navigation ) {

								wp_nav_menu( array(
									'theme_location' => 'onepage-menu',
									'container' => false,
									'depth' => 1,
									'menu_class' => 'sf-menu sf-menu-onepage',
									'fallback_cb' => 'gilber_fallback_menu',
									'walker' => new Gilber_Custom_Walker_Nav_Menu()
								) );

							} else {

								wp_nav_menu( array(
									'theme_location' => 'primary-menu',
									'container' => false,
									'depth' => 3,
									'menu_class' => 'sf-menu',
									'fallback_cb' => 'gilber_fallback_menu',
								) );

							}

						?>

					</nav>

				</div>

			</div>

			<div class="vlt-navbar-inner--right">

				<div class="d-flex align-items-center">

					<?php

						if ( has_nav_menu( 'navbar-menu' ) ) {

							echo '<nav class="vlt-navbar-contacts">';

							wp_nav_menu( array(
								'theme_location' => 'navbar-menu',
								'container' => false,
								'depth' => 1,
							) );

							echo '</nav>';

						}
					?>

					<a class="vlt-menu-burger js-offcanvas-menu-open" href="#">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
					</a>

				</div>

			</div>

		</div>

	</div>

</header>
<!-- .vlt-header -->

<?php get_template_part( 'template-parts/header/menu/menu', 'offcanvas' ); ?>
