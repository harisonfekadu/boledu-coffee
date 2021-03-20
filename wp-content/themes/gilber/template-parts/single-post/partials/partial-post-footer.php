<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

?>

<?php if ( get_the_tags() ) : ?>

	<div class="vlt-post-tags">

		<h5><?php esc_html_e( 'Tags:', 'gilber' ); ?></h5>

		<div>
			<?php the_tags( '', ', ' ); ?>
		</div>

	</div>
	<!-- /.vlt-post-tags -->

<?php endif; ?>


<?php if ( function_exists( 'vlthemes_get_post_share_buttons' ) && gilber_get_theme_mod( 'show_share_post' ) == 'show' ) : ?>

	<div class="vlt-post-share">

		<h5><?php esc_html_e( 'Share:', 'gilber' ); ?></h5>

		<?php echo vlthemes_get_post_share_buttons( get_the_ID() ); ?>

	</div>
	<!-- /.vlt-social-share -->

<?php endif; ?>