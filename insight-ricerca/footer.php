<?php
/**
 * Footer del sito.
 *
 * @package insight-ricerca
 */

$footer_about     = get_theme_mod( 'insight_ricerca_footer_about', 'Segnaposto S.r.l. aiuta aziende e istituzioni a comprendere la società attraverso dati, comportamenti e cambiamenti.' );
$footer_address   = get_theme_mod( 'insight_ricerca_footer_address', "Via dei Segnaposto 1\n00100 Roma (RM) — Italia" );
$footer_copyright = get_theme_mod( 'insight_ricerca_footer_copyright', '© P.IVA 00000000000 — Tutti i diritti riservati.' );
?>

<footer class="site-footer" role="contentinfo">
	<div class="container">
		<div class="footer-grid">
			<div>
				<p class="footer-logo"><?php echo esc_html( get_bloginfo( 'name' ) ); ?><span class="accent">.</span></p>
				<p><?php echo esc_html( $footer_about ); ?></p>
				<?php insight_ricerca_social_links(); ?>
			</div>

			<div>
				<h4><?php esc_html_e( 'Contatti', 'insight-ricerca' ); ?></h4>
				<?php echo wp_kses_post( wpautop( $footer_address ) ); ?>
			</div>

			<div>
				<h4><?php esc_html_e( 'Esplora', 'insight-ricerca' ); ?></h4>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'fallback_cb'    => 'insight_ricerca_menu_fallback',
						'depth'          => 1,
					)
				);
				?>
			</div>

			<div>
				<h4><?php esc_html_e( 'Informazioni', 'insight-ricerca' ); ?></h4>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'legal',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 1,
					)
				);
				?>
			</div>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="container">
			<span><?php echo esc_html( $footer_copyright ); ?></span>
			<span><a href="#content"><?php esc_html_e( 'Torna su', 'insight-ricerca' ); ?></a></span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
