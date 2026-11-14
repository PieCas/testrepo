<?php
/**
 * Template per i singoli articoli.
 *
 * @package insight-ricerca
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="single-hero">
		<div class="container">
			<?php insight_ricerca_post_meta(); ?>
			<h1><?php the_title(); ?></h1>
		</div>
	</div>

	<div class="container">
		<article <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() ) : ?>
				<figure><?php the_post_thumbnail( 'large' ); ?></figure>
			<?php endif; ?>

			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<nav class="pagination">',
						'after'  => '</nav>',
					)
				);
				?>
			</div>
		</article>

		<nav class="pagination">
			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span>&larr; %title</span>',
					'next_text' => '<span>%title &rarr;</span>',
				)
			);
			?>
		</nav>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
	</div>
	<?php
endwhile;

get_footer();
