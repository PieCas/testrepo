<?php
/**
 * Template principale (fallback).
 *
 * @package insight-ricerca
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<h1><?php single_post_title(); ?></h1>
		<?php else : ?>
			<h1><?php esc_html_e( 'Notizie', 'insight-ricerca' ); ?></h1>
		<?php endif; ?>
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
