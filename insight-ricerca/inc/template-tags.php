<?php
/**
 * Funzioni di template riutilizzabili.
 *
 * @package insight-ricerca
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Stampa la meta di un articolo (data e categorie).
 */
function insight_ricerca_post_meta() {
	$categories = get_the_category_list( ', ' );

	echo '<p class="entry-meta">';
	echo esc_html( get_the_date() );
	if ( $categories ) {
		echo ' — ' . wp_kses_post( $categories );
	}
	echo '</p>';
}

/**
 * Stampa i link social configurati nel Customizer.
 */
function insight_ricerca_social_links() {
	$networks = array(
		'linkedin'  => 'LinkedIn',
		'x'         => 'X',
		'instagram' => 'Instagram',
		'youtube'   => 'YouTube',
	);

	echo '<div class="social-links">';
	foreach ( $networks as $slug => $label ) {
		$url = get_theme_mod( 'insight_ricerca_social_' . $slug, '' );
		if ( $url ) {
			printf(
				'<a href="%1$s" target="_blank" rel="noopener noreferrer" aria-label="%2$s">%2$s</a>',
				esc_url( $url ),
				esc_attr( $label )
			);
		}
	}
	echo '</div>';
}

/**
 * Logo del sito (custom logo o segnaposto testuale).
 */
function insight_ricerca_site_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}

	printf(
		'<div class="site-branding"><p class="site-title"><a href="%1$s">%2$s<span class="accent">.</span></a></p><p class="site-description">%3$s</p></div>',
		esc_url( home_url( '/' ) ),
		esc_html( get_bloginfo( 'name' ) ),
		esc_html( get_bloginfo( 'description' ) )
	);
}
