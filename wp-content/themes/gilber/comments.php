<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

if ( post_password_required() ) {
	return;
}

?>

<div class="vlt-page-comments" id="comments">

	<div class="container">

		<?php if ( comments_open() || have_comments() ) : ?>

			<?php if ( have_comments() ) : ?>

				<div class="vlt-page-comments__list">

					<h4 class="vlt-page-comments__title">
						<?php comments_number( esc_html__( 'No Comments:', 'gilber' ) , esc_html__( 'One Comment:', 'gilber' ) , esc_html__( 'Comments (%):', 'gilber' ) ); ?>
					</h4>

					<ul class="vlt-comments">

						<?php

							wp_list_comments( array(
								'avatar_size' => 80,
								'style' => 'ul',
								'max_depth' => 3,
								'short_ping' => true,
								'reply_text' => esc_html__( 'Reply', 'gilber' ),
								'callback' => 'gilber_callback_custom_comment',
							) );

						?>

					</ul>

					<?php echo gilber_get_comment_navigation(); ?>

				</div>
				<!-- /.vlt-page-comments__list -->

			<?php endif; ?>

			<?php if ( comments_open() ) : ?>

				<div class="vlt-page-comments__form">

					<?php

						$commenter = wp_get_current_commenter();

						$args = array(
							'title_reply' => esc_html__( 'Add comment:', 'gilber' ),
							'title_reply_before' => '<h4 class="vlt-page-comments__title">',
							'title_reply_after' => '</h4>',
							'cancel_reply_before' => '',
							'cancel_reply_after' => '',
							'comment_notes_before' => '',
							'comment_notes_after' => '',
							'title_reply_to' => esc_html__( 'Leave a Reply', 'gilber' ),
							'cancel_reply_link' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
							'submit_button' => '<button type="submit" id="%2$s" class="%3$s">%4$s</button>',
							'class_submit' => 'vlt-btn vlt-btn--primary',
							'label_submit' => esc_html__( 'Post a Comment', 'gilber' ),
							'fields' => array(
								'cookies' => false,
								'author' => '<div class="vlt-form-group"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Name', 'gilber' ) . '"></div>',
								'email' => '<div class="vlt-form-group"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Email', 'gilber' ) . '"></div>',
							),
						);

						$args['comment_field'] = '<div class="vlt-form-group"><textarea id="comment" name="comment" rows="3" placeholder="' . esc_attr__( 'Comment', 'gilber' ) . '"></textarea></div>';

						comment_form( $args );

					?>

				</div>
				<!-- /.vlt-page-comments__form -->

			<?php endif; ?>

		<?php endif; ?>

	</div>

</div>