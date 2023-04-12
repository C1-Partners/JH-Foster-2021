<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SW
 * /*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password,
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$commentCount = get_comments_number();
?>

<div id="comments" class="comments-area default-max-width <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">

	<?php
	if ( have_comments() ) :
		;
		?>
		<h2 class="comments-title">
			<?php if ( '1' === $commentCount ) : ?>
				<?php esc_html_e( '1 comment', 'sw' ); ?>
			<?php else : ?>
				<?php
				printf(
					/* translators: %s: comment count number. */
					esc_html( _nx( '%s comment', '%s comments', $commentCount, 'Comments title', 'sw' ) ),
					esc_html( number_format_i18n( $commentCount ) )
				);
				?>
			<?php endif; ?>
		</h2><!-- .comments-title -->

		<ul class="comment-list">
		<?php wp_list_comments( 'type=comment&callback=sw_comment' ); ?>
		</ul><!-- .comment-list -->

		<?php
		the_comments_pagination(
			array(
				'before_page_number' => esc_html__( 'Page', 'sw' ) . ' ',
				'mid_size'           => 0,
				'prev_text'          => sprintf(
					'%s <span class="nav-prev-text">%s</span>',
					'<span></span>',
					esc_html__( 'Older comments', 'sw' )
				),
				'next_text'          => sprintf(
					'<span class="nav-next-text">%s</span> %s',
					esc_html__( 'Newer comments', 'sw' ),
					'<span></span>'
				),
			)
		);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sw' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'logged_in_as'       => null,
			'title_reply'        => esc_html__( 'Leave a Reply', 'sw' ),
			'label_submit' 		 => __( 'Submit', 'textdomain' ),
			'class_submit'		 => 'btn',
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'class_form' 		 => 'form',
	

			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' =>
					'<div class="before-comment">' .
					'<label for="comment">Name (required)</label>'.
					'<p class="comment-form-author">'  .
					'<input id="author" class="form__input" name="author" type="text" size="30"' . 'required="required"' . ' /></p>',

				'email' =>
					'<p class="comment-form-email">'.
					'<label for="comment">Email (required)</label>'.
					'<input id="email" class="form__input" name="email" type="text" size="30"' . 'required="required"' . ' /></p>',

				'url' =>
					'<p class="comment-form-url">'.
					'<label for="comment">Website</label>'.
					'<input id="url" class="form__input" name="url" type="text" size="30" /></p>' .
					'</div>',

				'comment' => 
					'<p class="comment-form-comment">'. 
					'<label for="comment">Comment (required)</label>'.
					'<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" class="form__input"></textarea></p>',
				)
			),
		)
	);
	?>

</div><!-- #comments -->