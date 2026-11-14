<?php
/**
 * Header del sito.
 *
 * @package insight-ricerca
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#content"><?php esc_html_e( 'Salta al contenuto principale', 'insight-ricerca' ); ?></a>

<?php
$topbar_text  = get_theme_mod( 'insight_ricerca_topbar_text', 'Segnaposto S.r.l. — Ricerche e analisi dal 1935' );
$topbar_email = get_theme_mod( 'insight_ricerca_topbar_email', 'info@example.com' );
$topbar_phone = get_theme_mod( 'insight_ricerca_topbar_phone', '+39 000 000 0000' );
?>
<?php if ( $topbar_text || $topbar_email || $topbar_phone ) : ?>
<div class="topbar">
	<div class="container">
		<span><?php echo esc_html( $topbar_text ); ?></span>
		<span>
			<?php if ( $topbar_email ) : ?>
				<a href="mailto:<?php echo esc_attr( $topbar_email ); ?>"><?php echo esc_html( $topbar_email ); ?></a>
			<?php endif; ?>
			<?php if ( $topbar_email && $topbar_phone ) : ?>
				&nbsp;·&nbsp;
			<?php endif; ?>
			<?php if ( $topbar_phone ) : ?>
				<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $topbar_phone ) ); ?>"><?php echo esc_html( $topbar_phone ); ?></a>
			<?php endif; ?>
		</span>
	</div>
</div>
<?php endif; ?>

<header class="site-header" role="banner">
	<div class="container">
		<?php insight_ricerca_site_logo(); ?>

		<nav class="main-navigation" id="site-navigation" aria-label="<?php esc_attr_e( 'Menu principale', 'insight-ricerca' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => 'insight_ricerca_menu_fallback',
				)
			);
			?>
		</nav>

		<a class="btn btn--primary btn--sm header-cta" href="<?php echo esc_url( home_url( '/#contatti' ) ); ?>"><?php esc_html_e( 'Contattaci', 'insight-ricerca' ); ?></a>

		<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><?php esc_html_e( 'Menu', 'insight-ricerca' ); ?></button>
	</div>
</header>

<main id="content" class="site-main" role="main">
