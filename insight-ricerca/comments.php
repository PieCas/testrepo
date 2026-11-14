<?php
/**
 * Area commenti.
 *
 * @package insight-ricerca
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2>
			<?php
			printf(
				/* translators: %s: numero di commenti. */
				esc_html( _nx( '%s commento', '%s commenti', get_comments_number(), 'titolo commenti', 'insight-ricerca' ) ),
				esc_html( number_format_i18n( get_comments_number() ) )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
			)
		);
		?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="lead"><?php esc_html_e( 'I commenti sono chiusi.', 'insight-ricerca' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply'        => __( 'Lascia un commento', 'insight-ricerca' ),
			'label_submit'       => __( 'Invia commento', 'insight-ricerca' ),
			'comment_notes_before' => '',
		)
	);
	?>

</div>
