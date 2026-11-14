<?php
/**
 * Template per le pagine statiche.
 *
 * @package insight-ricerca
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="page-header">
		<div class="container">
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

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
	</div>
	<?php
endwhile;

get_footer();
