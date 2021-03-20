<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'gilber_body_open' ) ) {
	function gilber_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}

/**
 * Sanitize slass tag
 */
if ( ! function_exists( 'gilber_sanitize_class' ) ) {
	function gilber_sanitize_class( $class, $fallback = null ) {
		if ( is_string( $class ) ) {
			$class = explode( ' ', $class );
		}
		if ( is_array( $class ) && count( $class ) > 0 ) {
			$class = array_map( 'sanitize_html_class', $class );
			return implode( ' ', $class );
		} else {
			return sanitize_html_class( $class, $fallback );
		}
	}
}

/**
 * Sanitize style tag
 */
if ( ! function_exists( 'gilber_sanitize_style' ) ) {
	function gilber_sanitize_style( $style ) {

		$allowed_html = array(
			'style' => array ()
		);
		return wp_kses( $style, $allowed_html );

	}
}

/**
 * Get trimmed content
 */
if ( ! function_exists( 'gilber_get_trimmed_content' ) ) {
	function gilber_get_trimmed_content( $content = false, $max_words = 18 ) {

		if ( $content == false ) {
			return;
		}

		$content = preg_replace( '~(?:\[/?)[^/\]]+/?\]~s', '', $content );
		$content = strip_tags( $content );
		$content = strip_shortcodes( $content );
		$words = explode( ' ', $content, $max_words + 1 );
		if ( count( $words ) > $max_words ) {
			array_pop( $words );
			array_push( $words, '...', '' );
		}
		$content = implode( ' ', $words );
		$content = esc_html( $content );

		return apply_filters( 'gilber/get_trimmed_content', $content );

	}
}

/**
 * Get page pagination
 */
if ( ! function_exists( 'gilber_get_page_pagination' ) ) {
	function gilber_get_page_pagination( $query = null, $paginated = 'numeric' ) {

		if ( $query == null ) {
			global $wp_query;
			$query = $wp_query;
		}

		$page = $query->query_vars[ 'paged' ];
		$pages = $query->max_num_pages;
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

		if ( $page == 0 ) {
			$page = 1;
		}

		if ( $paginated == 'none' || $pages <= 1 ) {
			return;
		}

		$class = 'vlt-pagination';

		$class .= ' vlt-pagination--' . $paginated;

		$output = '<nav class="' . gilber_sanitize_class( $class ) . '">';

		if ( $pages > 1 ) {

			if ( $paginated == 'paged' ) {

				if ( $page - 1 >= 1 ) {
					$output .= '<a class="prev" href="' . get_pagenum_link( $page - 1 ) . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><defs/><path d="M15 18l-6-6 6-6"/></svg></a>';
				}

				if ( $page + 1 <= $pages ) {
					$output .= '<a class="next" href="' . get_pagenum_link( $page + 1 ) . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><defs/><path d="M9 18l6-6-6-6"/></svg></a>';
				}

			}

			if ( $paginated == 'numeric' ) {

				$numeric_links = paginate_links( array(
					'type' => 'array',
					'foramt' => '',
					'add_args' => '',
					'current' => $paged,
					'total' => $pages,
					'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><defs/><path d="M15 18l-6-6 6-6"/></svg>',
					'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><defs/><path d="M9 18l6-6-6-6"/></svg>',
				) );

				$output .= '<ul>';
				if ( is_array( $numeric_links ) ) {
					foreach ( $numeric_links as $numeric_link ) {
						$output .= '<li>' . $numeric_link . '</li>';
					}
				}
				$output .= '</ul>';

			}

		}

		$output .= '</nav>';

		return apply_filters( 'gilber/get_page_pagination', $output );

	}
}

/**
 * Get post taxonomy
 */
if ( ! function_exists( 'gilber_get_post_taxonomy' ) ) {
	function gilber_get_post_taxonomy( $post_id, $taxonomy, $delimiter = ', ', $get = 'name', $link = true ) {

		$tags = wp_get_post_terms( $post_id, $taxonomy );
		$list = '';

		foreach ( $tags as $tag ) {
			if ( $link ) {
				$list .= '<a href="' . get_category_link( $tag->term_id ) . '">' . $tag->$get . '</a>' . $delimiter;
			} else {
				$list .= $tag->$get . $delimiter;
			}
		}

		return substr( $list, 0, strlen( $delimiter ) * ( -1 ) );

	}
}

/**
 * Callback for custom comment
 */
if ( ! function_exists( 'gilber_callback_custom_comment' ) ) {
	function gilber_callback_custom_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		global $post;

		?>

		<li <?php comment_class( 'vlt-comment-item' ); ?>>

			<div class="vlt-comment-item__inner clearfix" id="comment-<?php comment_ID(); ?>">

				<?php if ( 0 != $args['avatar_size'] && get_avatar( $comment ) ) : ?>
					<a class="vlt-comment-avatar" href="<?php echo get_comment_author_url(); ?>"><?php echo get_avatar( $comment, $args['avatar_size'] ); ?></a>
					<!-- /.vlt-comment-avatar -->
				<?php endif; ?>

				<div class="vlt-comment-content">

					<div class="vlt-comment-header">

						<h5 class="vlt-comment-name"><?php comment_author(); ?></h5>

						<div class="vlt-comment-metas">

							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>" rel="nofollow">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php printf( get_comment_date() ); ?>
								</time>
							</a>

							<?php esc_html_e( 'at ', 'gilber' ); ?>
							<span><?php printf( sprintf( esc_html__( '%s ago', 'gilber' ), human_time_diff( get_comment_date( 'U' ), current_time( 'timestamp' ) ) ) ); ?></span>

						</div>

					</div>
					<!-- /.vlt-comment-header -->

					<div class="vlt-comment-text vlt-content-markup clearfix">

						<?php comment_text(); ?>

						<?php if ( '0' == $comment->comment_approved ): ?>
							<p class="vlt-alert">
								<?php esc_html_e( 'Your comment is awaiting moderation.', 'gilber' ); ?>
							</p>
						<?php endif; ?>

					</div>
					<!-- /.vlt-comment-text -->

					<?php
						comment_reply_link( array_merge( $args, array(
							'depth' => $depth,
							'max_depth' => $args['max_depth'],
						) ) );
					?>

				</div>
				<!-- /.vlt-comment-content -->

			</div>
			<!-- /.vlt-comment-item__inner -->

		<!-- </li> is added by WordPress automatically -->
		<?php
	}
}

/**
 * Get comment navigation
 */
if ( ! function_exists( 'gilber_get_comment_navigation' ) ) {
	function gilber_get_comment_navigation() {

		$output = '';

		if ( get_comment_pages_count() > 1 ) :

			$output .= '<nav class="vlt-comments-navigation">';
			if ( get_previous_comments_link() ) {
				$output .= get_previous_comments_link( esc_html__( 'Prev Page', 'gilber' ) );
			}
			if ( get_next_comments_link() ) {
				$output .= get_next_comments_link( esc_html__( 'Next Page', 'gilber' ) );
			}
			$output .= '</nav>';

		endif;

		return apply_filters( 'gilber/get_comment_navigation', $output );

	}
}

/**
 * Render elementor template
 */
if ( ! function_exists( 'gilber_render_elementor_template' ) ) {
	function gilber_render_elementor_template( $template ) {

		if ( ! $template ) {
			return;
		}

		if ( 'publish' !== get_post_status( $template ) ) {
			return;
		}

		$new_frontend = new Elementor\Frontend;
		return $new_frontend->get_builder_content_for_display( $template, false );

	}
}