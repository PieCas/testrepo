<?php
/**
 * Template per gli archivi (categorie, tag, date, autori).
 *
 * @package insight-ricerca
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<span class="eyebrow"><?php esc_html_e( 'Archivio', 'insight-ricerca' ); ?></span>
		<h1><?php the_archive_title(); ?></h1>
		<?php the_archive_description( '<p class="lead">', '</p>' ); ?>
	</div>
</div>

<div class="container">
	<?php if ( have_posts() ) : ?>
		<div class="posts-list">
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
