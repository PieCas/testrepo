<?php
/**
 * Contenuto assente / nessun risultato.
 *
 * @package insight-ricerca
 */

?>
<section class="section">
	<div class="section-head">
		<h2><?php esc_html_e( 'Nessun contenuto trovato', 'insight-ricerca' ); ?></h2>
		<p class="lead"><?php esc_html_e( 'Prova a cercare un altro termine oppure torna alla homepage.', 'insight-ricerca' ); ?></p>
	</div>

	<?php get_search_form(); ?>
</section>
