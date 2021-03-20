<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

?>

<article <?php post_class( 'vlt-page vlt-page--empty' ); ?>>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ): ?>

		<p><?php esc_html_e( 'Ready to publish your first post?', 'gilber' ); ?></p>

		<div class="vlt-gap-30"></div>

		<a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>" class="vlt-btn vlt-btn--primary">
			<?php esc_html_e( 'Get started here', 'gilber' ); ?>
		</a>

	<?php elseif ( is_search() ): ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms.', 'gilber' ); ?></p>

	<?php else: ?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'gilber' ); ?></p>

	<?php endif; ?>

</article>
<!-- /.vlt-page -->