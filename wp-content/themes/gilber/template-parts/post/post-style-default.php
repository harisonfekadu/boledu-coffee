<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

$size = 'gilber-1280x720_crop';
$post_class = 'vlt-post vlt-post--default';

?>

<article <?php post_class( $post_class ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="vlt-post-media">

			<a href="<?php the_permalink(); ?>">

				<?php the_post_thumbnail( $size, array( 'loading' => 'lazy' ) ); ?>

			</a>

		</div>
		<!-- /.vlt-post-media -->

	<?php endif; ?>

	<div class="vlt-post-content">

		<header class="vlt-post-header">
			<?php get_template_part( 'template-parts/post/partials/partial', 'post-meta' ); ?>
			<?php get_template_part( 'template-parts/post/partials/partial', 'post-title' ); ?>
		</header>
		<!-- /.vlt-post-header -->

		<div class="vlt-post-excerpt">
			<?php echo gilber_get_trimmed_content( get_the_content(), 45 ); ?>
		</div>
		<!-- /.vlt-post-excerpt -->

		<footer class="vlt-post-footer">
			<?php get_template_part( 'template-parts/post/partials/partial', 'post-read-more' ); ?>
		</footer>
		<!-- /.vlt-post-footer -->

	</div>
	<!-- /.vlt-post-content -->

</article>
<!-- /.vlt-post -->