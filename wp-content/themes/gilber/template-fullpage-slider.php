<?php

/**
 * Template Name: Fullpage Slider
 * @author: VLThemes
 * @version: 1.0.1
 */

get_header();

$loop_top = gilber_get_field( 'slider_loop_top' );
$loop_bottom = gilber_get_field( 'slider_loop_bottom' );
$speed = gilber_get_field( 'slider_speed' );
$progress_bar = gilber_get_field( 'slider_progress_bar' );

// prepend query
$args = array(
	'post_type' => 'slide',
	'posts_per_page' => -1,
	'post_status' => 'publish',
);

$new_query = new WP_Query( $args );

?>

<main class="vlt-main">

	<div class="vlt-fullpage-slider" data-loop-top="<?php echo esc_attr( $loop_top ); ?>" data-loop-bottom="<?php echo esc_attr( $loop_bottom ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>">

		<?php

			if ( $new_query->have_posts() ) : while ( $new_query->have_posts() ) : $new_query->the_post();

				$slide_ID = get_the_title();

				// slide settings
				$section_background_color = gilber_get_field( 'section_background_color' );
				$section_background_image = gilber_get_field( 'section_background_image' );

				// portfolio
				$section_portfolio = gilber_get_field( 'section_portfolio' );

				// ken burn
				$ken_burn_background_image = gilber_get_field( 'ken_burn_background_image' );
				$ken_burn_background_image_mobile = gilber_get_field( 'ken_burn_background_image_mobile' );

				$ken_burn_background_class = 'vlt-section__ken-burn-background';
				if ( $ken_burn_background_image_mobile ) {
					$ken_burn_background_class .= ' has-mobile-image';
				}

				$section_style = '';

				if ( $section_background_color ) {
					$section_style .= ' background-color: ' . $section_background_color . ';';
				}

				if ( $section_background_image ) {
					$section_style .= ' background-image: url(' . wp_get_attachment_image_src( $section_background_image[ 'id' ], 'gilber-1920x1080_crop' )[0] . ');';
				}

				?>

				<div class="vlt-section pp-scrollable" data-anchor="<?php echo esc_attr( $slide_ID ); ?>" style="<?php echo gilber_sanitize_style( $section_style ); ?>">

					<div class="vlt-section__vertical-align">

						<div class="vlt-section__content">

							<?php if ( $section_portfolio ) : ?>

								<div class="vlt-section__projects-background"></div>
								<!-- /.vlt-section__projects-background -->

							<?php endif; ?>

							<?php if ( $ken_burn_background_image ) : ?>

								<div class="<?php echo gilber_sanitize_class( $ken_burn_background_class ); ?>">

									<img src="<?php echo esc_url( wp_get_attachment_image_src( $ken_burn_background_image[ 'id' ], 'gilber-1920x1080_crop' )[0] ); ?>" alt="background" loading="lazy">

									<?php if ( $ken_burn_background_image_mobile ) { ?>

										<img src="<?php echo esc_url( wp_get_attachment_image_src( $ken_burn_background_image_mobile[ 'id' ], 'gilber-1920x1080_crop' )[0] ); ?>" alt="background" loading="lazy">

									<?php } ?>

								</div>
								<!-- /.vlt-section__ken-burn-background -->

							<?php endif; ?>

							<div class="container p-0">

								<?php the_content(); ?>

							</div>
							<!-- /.container -->

						</div>
						<!-- /.vlt-section__content -->

					</div>
					<!-- /.vlt-section__vertical-align -->

				</div>
				<!-- /.vlt-section -->

			<?php

			endwhile; endif; wp_reset_postdata();

			// show progress bar
			if ( $progress_bar ) {
				echo '<div class="vlt-fullpage-slider-progress-bar"><span></span></div>';
			}

		?>

	</div>

</main>
<!-- /.vlt-main -->

<?php get_footer(); ?>