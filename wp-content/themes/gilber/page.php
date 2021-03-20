<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

get_header();

get_template_part( 'template-parts/page-title/page-title', 'page' );

?>

<main class="vlt-main vlt-main--padding">

	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content/content', 'page' );
		endwhile;
	?>

</main>
<!-- /.vlt-main -->

<?php

	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

?>

<?php get_footer(); ?>