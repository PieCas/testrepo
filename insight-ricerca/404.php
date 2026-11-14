<?php
/**
 * Template 404.
 *
 * @package insight-ricerca
 */

get_header();
?>

<div class="container">
	<div class="error-404">
		<h1>404</h1>
		<h2><?php esc_html_e( 'Pagina non trovata', 'insight-ricerca' ); ?></h2>
		<p class="lead"><?php esc_html_e( 'La pagina che cerchi è stata spostata o non esiste più.', 'insight-ricerca' ); ?></p>

		<?php get_search_form(); ?>

		<p style="margin-top:30px;">
			<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Torna alla home', 'insight-ricerca' ); ?></a>
		</p>
	</div>
</div>

<?php
get_footer();
