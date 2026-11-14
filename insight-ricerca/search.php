<?php
/**
 * Template dei risultati di ricerca.
 *
 * @package insight-ricerca
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<h1>
			<?php
			printf(
				/* translators: %s: termine cercato. */
				esc_html__( 'Risultati per: %s', 'insight-ricerca' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>
	</div>
</div>

<div class="container">
	<?php get_search_form(); ?>

	<?php if ( have_posts() ) : ?>
		<div class="posts-list" style="margin-top:50px;">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			?>
		</div>
		<?php
		the_posts_pagination(
			array(
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
			)
		);
		?>
	<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; ?>
</div>

<?php
get_footer();
