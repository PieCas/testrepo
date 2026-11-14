<?php
/**
 * Contenuto di archivio / elenco.
 *
 * @package insight-ricerca
 */

$variant = (int) get_the_ID() % 3 + 1;
?>
<article class="card">
	<a class="card-media" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large' ); ?>
		<?php else : ?>
			<img src="<?php echo esc_url( insight_ricerca_placeholder_image( $variant ) ); ?>" alt="">
		<?php endif; ?>
	</a>
	<div class="card-body">
		<?php insight_ricerca_post_meta(); ?>
		<h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p class="card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
		<a class="card-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Leggi tutto', 'insight-ricerca' ); ?> &#8594;</a>
	</div>
</article>
