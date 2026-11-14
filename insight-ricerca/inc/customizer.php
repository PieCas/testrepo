<?php
/**
 * Customizer: colori, contatti, footer, social.
 *
 * @package insight-ricerca
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registra le impostazioni del Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Gestore del Customizer.
 */
function insight_ricerca_customize_register( $wp_customize ) {

	// ---------- Colori ----------
	$wp_customize->add_section(
		'insight_ricerca_colors',
		array(
			'title'    => __( 'Colori del tema', 'insight-ricerca' ),
			'priority' => 20,
		)
	);

	$wp_customize->add_setting(
		'insight_ricerca_primary_color',
		array(
			'default'           => '#14213d',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'insight_ricerca_primary_color',
			array(
				'label'   => __( 'Colore primario (titoli, footer)', 'insight-ricerca' ),
				'section' => 'insight_ricerca_colors',
			)
		)
	);

	$wp_customize->add_setting(
		'insight_ricerca_accent_color',
		array(
			'default'           => '#e63946',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'insight_ricerca_accent_color',
			array(
				'label'   => __( 'Colore accento (pulsanti, evidenze)', 'insight-ricerca' ),
				'section' => 'insight_ricerca_colors',
			)
		)
	);

	// ---------- Contatti ----------
	$wp_customize->add_section(
		'insight_ricerca_contacts',
		array(
			'title'    => __( 'Contatti e topbar', 'insight-ricerca' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'insight_ricerca_topbar_text',
		array(
			'default'           => 'Segnaposto S.r.l. — Ricerche e analisi dal 1935',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'insight_ricerca_topbar_text',
		array(
			'label'   => __( 'Testo topbar', 'insight-ricerca' ),
			'section' => 'insight_ricerca_contacts',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'insight_ricerca_topbar_email',
		array(
			'default'           => 'info@example.com',
			'sanitize_callback' => 'sanitize_email',
		)
	);

	$wp_customize->add_control(
		'insight_ricerca_topbar_email',
		array(
			'label'   => __( 'Email in topbar', 'insight-ricerca' ),
			'section' => 'insight_ricerca_contacts',
			'type'    => 'email',
		)
	);

	$wp_customize->add_setting(
		'insight_ricerca_topbar_phone',
		array(
			'default'           => '+39 000 000 0000',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'insight_ricerca_topbar_phone',
		array(
			'label'   => __( 'Telefono in topbar', 'insight-ricerca' ),
			'section' => 'insight_ricerca_contacts',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'insight_ricerca_contact_email',
		array(
			'default'           => get_option( 'admin_email' ),
			'sanitize_callback' => 'sanitize_email',
		)
	);

	$wp_customize->add_control(
		'insight_ricerca_contact_email',
		array(
			'label'       => __( 'Email destinataria del form', 'insight-ricerca' ),
			'description' => __( 'Indirizzo al quale vengono inviate le richieste del form di contatto.', 'insight-ricerca' ),
			'section'     => 'insight_ricerca_contacts',
			'type'        => 'email',
		)
	);

	// ---------- Footer ----------
	$wp_customize->add_section(
		'insight_ricerca_footer',
		array(
			'title'    => __( 'Footer', 'insight-ricerca' ),
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'insight_ricerca_footer_about',
		array(
			'default'           => 'Segnaposto S.r.l. aiuta aziende e istituzioni a comprendere la società attraverso dati, comportamenti e cambiamenti.',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);

	$wp_customize->add_control(
		'insight_ricerca_footer_about',
		array(
			'label'   => __( 'Testo "chi siamo" nel footer', 'insight-ricerca' ),
			'section' => 'insight_ricerca_footer',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'insight_ricerca_footer_address',
		array(
			'default'           => "Via dei Segnaposto 1\n00100 Roma (RM) — Italia",
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);

	$wp_customize->add_control(
		'insight_ricerca_footer_address',
		array(
			'label'   => __( 'Indirizzo', 'insight-ricerca' ),
			'section' => 'insight_ricerca_footer',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'insight_ricerca_footer_copyright',
		array(
			'default'           => '© P.IVA 00000000000 — Tutti i diritti riservati.',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'insight_ricerca_footer_copyright',
		array(
			'label'   => __( 'Copyright', 'insight-ricerca' ),
			'section' => 'insight_ricerca_footer',
			'type'    => 'text',
		)
	);

	// ---------- Social ----------
	$wp_customize->add_section(
		'insight_ricerca_social',
		array(
			'title'    => __( 'Social', 'insight-ricerca' ),
			'priority' => 50,
		)
	);

	$social_networks = array(
		'linkedin'  => 'LinkedIn',
		'x'         => 'X (Twitter)',
		'instagram' => 'Instagram',
		'youtube'   => 'YouTube',
	);

	foreach ( $social_networks as $slug => $label ) {
		$wp_customize->add_setting(
			'insight_ricerca_social_' . $slug,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'insight_ricerca_social_' . $slug,
			array(
				'label'   => sprintf( /* translators: %s: nome del social. */ __( 'URL profilo %s (vuoto = non mostrato)', 'insight-ricerca' ), $label ),
				'section' => 'insight_ricerca_social',
				'type'    => 'url',
			)
		);
	}
}
add_action( 'customize_register', 'insight_ricerca_customize_register' );

/**
 * Anteprima live dei colori nel Customizer.
 */
function insight_ricerca_customize_preview_js() {
	wp_enqueue_script(
		'insight-ricerca-customizer',
		get_template_directory_uri() . '/assets/js/customizer.js',
		array( 'customize-preview' ),
		INSIGHT_RICERCA_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'insight_ricerca_customize_preview_js' );
