<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

$size = 'gilber-800x600';
$post_class = 'vlt-post vlt-post--masonry';

?>

<article <?php post_class( $post_class ); ?>>

	<div class="vlt-post-border">
		<span class="top"></span>
		<span class="right"></span>
		<span class="bottom"></span>
		<span class="left"></span>
	</div>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="vlt-post-media">

			<?php the_post_thumbnail( $size, array( 'loading' => 'lazy' ) ); ?>

		</div>
		<!-- /.vlt-post-thumbnail -->

	<?php endif; ?>

	<div class="vlt-post-content">

		<header class="vlt-post-header">
			<?php get_template_part( 'template-parts/post/partials/partial', 'post-meta' ); ?>
			<?php get_template_part( 'template-parts/post/partials/partial', 'post-title' ); ?>
		</header>
		<!-- /.vlt-post-header -->

		<div class="vlt-post-excerpt">
			<?php echo gilber_get_trimmed_content( get_the_content(), 18 ); ?>
		</div>
		<!-- /.vlt-post-excerpt -->

		<footer class="vlt-post-footer">
			<?php get_template_part( 'template-parts/post/partials/partial', 'post-read-more-link' ); ?>
		</footer>
		<!-- /.vlt-post-footer -->

	</div>
	<!-- /.vlt-post-content -->

</article>
<!-- /.vlt-post -->