<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

?>

<article <?php post_class( 'vlt-page vlt-page--custom' ); ?>>

	<?php the_content(); ?>

	<div class="clearfix"></div>

	<?php
		wp_link_pages( array(
			'before' => '<div class="vlt-link-pages"><h5>' . esc_html__( 'Pages: ', 'gilber' ) . '</h5>',
			'after' => '</div>',
			'separator' => '<span class="sep">|</span>',
			'nextpagelink' => esc_html__( 'Next page', 'gilber' ),
			'previouspagelink' => esc_html__( 'Previous page', 'gilber' ),
			'next_or_number' => 'next'
		) );
	?>

</article>
<!-- /.vlt-page -->