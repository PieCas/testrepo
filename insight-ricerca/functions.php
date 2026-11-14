<?php
/**
 * Insight Ricerca: funzioni e setup del tema.
 *
 * @package insight-ricerca
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'INSIGHT_RICERCA_VERSION', '1.0.0' );

/**
 * Setup del tema.
 */
function insight_ricerca_setup() {
	load_theme_textdomain( 'insight-ricerca', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 260,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Menu principale', 'insight-ricerca' ),
			'footer'  => __( 'Menu footer', 'insight-ricerca' ),
			'legal'   => __( 'Menu legale (privacy/cookie)', 'insight-ricerca' ),
		)
	);
}
add_action( 'after_setup_theme', 'insight_ricerca_setup' );

/**
 * Larghezza contenuto.
 */
function insight_ricerca_content_width() {
	$GLOBALS['content_width'] = 760;
}
add_action( 'after_setup_theme', 'insight_ricerca_content_width', 0 );

/**
 * Asset del tema.
 */
function insight_ricerca_scripts() {
	wp_enqueue_style(
		'insight-ricerca-fonts',
		'https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'insight-ricerca-style', get_stylesheet_uri(), array(), INSIGHT_RICERCA_VERSION );

	wp_enqueue_script( 'insight-ricerca-main', get_template_directory_uri() . '/assets/js/main.js', array(), INSIGHT_RICERCA_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'insight_ricerca_scripts' );

/**
 * Variabili CSS definite dal Customizer.
 */
function insight_ricerca_css_variables() {
	$primary = get_theme_mod( 'insight_ricerca_primary_color', '#14213d' );
	$accent  = get_theme_mod( 'insight_ricerca_accent_color', '#e63946' );

	$css = sprintf(
		':root{--c-primary:%1$s;--c-accent:%2$s;}',
		sanitize_hex_color( $primary ),
		sanitize_hex_color( $accent )
	);

	wp_add_inline_style( 'insight-ricerca-style', $css );
}
add_action( 'wp_enqueue_scripts', 'insight_ricerca_css_variables', 20 );

/**
 * Aree widget.
 */
function insight_ricerca_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar blog', 'insight-ricerca' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Widget mostrati negli archivi e negli articoli.', 'insight-ricerca' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'insight_ricerca_widgets_init' );

/**
 * Form di contatto della homepage.
 */
function insight_ricerca_handle_contact_form() {
	if ( ! isset( $_POST['insight_ricerca_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['insight_ricerca_contact_nonce'] ) ), 'insight_ricerca_contact' ) ) {
		wp_safe_redirect( home_url( '/?contact=error#contatti' ) );
		exit;
	}

	$name    = sanitize_text_field( wp_unslash( $_POST['contact_name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['contact_email'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['contact_phone'] ?? '' ) );
	$company = sanitize_text_field( wp_unslash( $_POST['contact_company'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ?? '' ) );

	if ( empty( $name ) || empty( $email ) || ! is_email( $email ) ) {
		wp_safe_redirect( home_url( '/?contact=error#contatti' ) );
		exit;
	}

	$to = get_theme_mod( 'insight_ricerca_contact_email', get_option( 'admin_email' ) );

	$subject = sprintf( '[%s] Nuova richiesta dal form di contatto', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) );

	$body = sprintf(
		"Nome: %s\nEmail: %s\nTelefono: %s\nAzienda: %s\n\nMessaggio:\n%s",
		$name,
		$email,
		$phone,
		$company,
		$message
	);

	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( home_url( '/?contact=' . ( $sent ? 'ok' : 'error' ) . '#contatti' ) );
	exit;
}
add_action( 'admin_post_insight_ricerca_contact', 'insight_ricerca_handle_contact_form' );
add_action( 'admin_post_nopriv_insight_ricerca_contact', 'insight_ricerca_handle_contact_form' );

/**
 * Fallback menu principale.
 */
function insight_ricerca_menu_fallback() {
	echo '<ul>';
	wp_list_pages(
		array(
			'title_li' => '',
			'depth'    => 1,
		)
	);
	echo '</ul>';
}

/**
 * Excerpt personalizzato.
 */
function insight_ricerca_excerpt_length( $length ) {
	return 22;
}
add_filter( 'excerpt_length', 'insight_ricerca_excerpt_length' );

function insight_ricerca_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'insight_ricerca_excerpt_more' );

/**
 * Immagine segnaposto per gli articoli senza featured image.
 */
function insight_ricerca_placeholder_image( $variant = 1 ) {
	$variant = (int) $variant % 3 + 1;
	return get_template_directory_uri() . '/assets/img/placeholder-' . $variant . '.svg';
}

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/template-tags.php';
