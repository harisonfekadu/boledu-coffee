<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

get_header();

?>

<main class="vlt-main">

	<?php

		// Elementor `single` location
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
			get_template_part( 'template-parts/single-post/single', 'post' );
		}

	?>

</main>
<!-- /.vlt-main -->

<?php

	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

?>

<?php get_footer(); ?>