<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

?>

<div class="vlt-offcanvas-menu">

	<div class="vlt-offcanvas-menu__header">

		<?php if ( gilber_get_theme_mod( 'offcanvas_menu_locales' ) == 'show' ) : ?>

			<div class="vlt-language-switcher">

				<?php

					if ( class_exists( 'GTranslate' ) ) {
						echo do_shortcode( '[gtranslate]' );
					}

				?>

			</div>
			<!-- /.vlt-language-switcher -->

		<?php else: ?>

			<span></span>

		<?php endif; ?>

		<a class="vlt-menu-burger vlt-menu-burger--opened js-offcanvas-menu-close" href="#">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"><defs></defs><path d="M18 6L6 18M6 6l12 12"></path></svg>
		</a>
		<!-- /.vlt-menu-burger -->

	</div>
	<!-- /.vlt-offcanvas-menu__header -->

	<nav class="vlt-offcanvas-menu__navigation">

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
	<!-- /.vlt-offcanvas-menu__navigation -->

	<div class="vlt-offcanvas-menu__footer">

		<?php if ( gilber_get_theme_mod( 'offcanvas_menu_socials_list' ) ) : ?>

			<div class="vlt-offcanvas-menu__socials">

				<?php
					foreach ( gilber_get_theme_mod( 'offcanvas_menu_socials_list' ) as $socialItem ) :
						echo '<a class="vlt-social-icon vlt-social-icon--style-1" href="' . esc_url( $socialItem[ 'social_url' ] ) . '" target="_blank"><i class="' . esc_attr( $socialItem[ 'social_class' ] ) . '"></i></a>';
					endforeach;
				?>

			</div>
			<!-- /.vlt-offcanvas-menu__socials -->

		<?php endif; ?>

		<?php if ( gilber_get_theme_mod( 'offcanvas_menu_copyright' ) ) : ?>

			<div class="vlt-offcanvas-menu__copyright"><?php echo wp_kses_post( gilber_get_theme_mod( 'offcanvas_menu_copyright' ) ); ?></div>
			<!-- /.vlt-offcanvas-menu__copyright -->

		<?php endif; ?>

	</div>
	<!-- /.vlt-offcanvas-menu__footer -->

</div>
<!-- /.vlt-offcanvas-menu -->

<div class="vlt-site-overlay"></div>
<!-- /.vlt-site-overlay -->