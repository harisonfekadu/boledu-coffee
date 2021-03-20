<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

$size = 'gilber-1280x720_crop';
$post_class = 'vlt-post vlt-post--single';

while ( have_posts() ) : the_post();

?>

<?php if ( has_post_thumbnail() ) : ?>

	<div class="vlt-post-hero-title vlt-post-hero-title--has-thumbnail jarallax">

		<?php the_post_thumbnail( $size, array( 'loading' => 'lazy', 'class' => 'jarallax-img' ) ); ?>

<?php else: ?>

	<div class="vlt-post-hero-title">

<?php endif; ?>

	<div class="container">

		<div class="row">

			<div class="col-xl-9">

				<div class="vlt-animated-block" data-animation-name="fadeInUpSm">

					<?php get_template_part( 'template-parts/single-post/partials/partial-post', 'meta' ); ?>

					<?php get_template_part( 'template-parts/single-post/partials/partial-post', 'title' ); ?>

				</div>

			</div>

		</div>

	</div>

</div>

<article <?php post_class( $post_class ); ?>>

	<div class="container">

		<div class="vlt-post-content clearfix">

			<?php get_template_part( 'template-parts/single-post/partials/partial-post', 'content' ); ?>

		</div>
		<!-- /.vlt-post-content -->

		<?php if ( ( function_exists( 'vlthemes_get_post_share_buttons' ) && gilber_get_theme_mod( 'show_share_post' ) == 'show' ) || get_the_tags() ) : ?>

			<footer class="vlt-post-footer">

				<?php get_template_part( 'template-parts/single-post/partials/partial-post', 'footer' ); ?>

			</footer>
			<!-- /.vlt-post-footer -->

		<?php endif; ?>

	</div>

</article>
<!-- /.vlt-post -->

<?php endwhile;