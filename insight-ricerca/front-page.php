<?php
/**
 * Homepage: slider, notizie, CTA, chi siamo, servizi, clienti, contatti.
 *
 * @package insight-ricerca
 */

get_header();

$hero_slides = array(
	array(
		'kicker'    => __( 'Osservatorio', 'insight-ricerca' ),
		'title'     => __( "Titolo della prima slide.\nInserisci qui il tuo messaggio.", 'insight-ricerca' ),
		'sub'       => __( 'Sottotitolo di esempio: sostituisci questo testo con l\'anteprima della notizia o dello studio da evidenziare.', 'insight-ricerca' ),
		'button'    => __( 'Leggi tutto', 'insight-ricerca' ),
		'link'      => '#notizie',
		'image'     => insight_ricerca_placeholder_image( 0 ),
	),
	array(
		'kicker'    => __( 'Approfondimento', 'insight-ricerca' ),
		'title'     => __( "Titolo della seconda slide.\nUn dato, una lettura.", 'insight-ricerca' ),
		'sub'       => __( 'Sottotitolo di esempio: due o tre righe che riassumono il contenuto della slide.', 'insight-ricerca' ),
		'button'    => __( 'Leggi tutto', 'insight-ricerca' ),
		'link'      => '#notizie',
		'image'     => insight_ricerca_placeholder_image( 1 ),
	),
	array(
		'kicker'    => __( 'Approfondimento', 'insight-ricerca' ),
		'title'     => __( "Titolo della terza slide.\nChiudi il racconto qui.", 'insight-ricerca' ),
		'sub'       => __( 'Sottotitolo di esempio: mantieni frasi brevi e incisive, come nel sito di riferimento.', 'insight-ricerca' ),
		'button'    => __( 'Leggi tutto', 'insight-ricerca' ),
		'link'      => '#notizie',
		'image'     => insight_ricerca_placeholder_image( 2 ),
	),
);

$hero_slides = apply_filters( 'insight_ricerca_hero_slides', $hero_slides );
?>

<!-- ============ HERO SLIDER ============ -->
<section class="hero" id="hero" aria-label="<?php esc_attr_e( 'In evidenza', 'insight-ricerca' ); ?>">

	<?php foreach ( $hero_slides as $index => $slide ) : ?>
		<div class="hero-slide<?php echo 0 === $index ? ' is-active' : ''; ?>" data-slide="<?php echo esc_attr( $index ); ?>" <?php echo ( '' !== $slide['image'] ) ? 'style="background-image:url(' . esc_url( $slide['image'] ) . ')"' : ''; ?>>
			<div class="container">
				<p class="hero-kicker"><?php echo esc_html( $slide['kicker'] ); ?></p>
				<h1 class="hero-title"><?php echo nl2br( esc_html( $slide['title'] ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- nl2br su testo già escaped. ?></h1>
				<p class="hero-sub"><?php echo esc_html( $slide['sub'] ); ?></p>
				<a class="btn btn--primary" href="<?php echo esc_url( $slide['link'] ); ?>"><?php echo esc_html( $slide['button'] ); ?></a>
			</div>
		</div>
	<?php endforeach; ?>

	<div class="hero-nav">
		<div class="container">
			<div class="hero-dots" role="tablist" aria-label="<?php esc_attr_e( 'Seleziona slide', 'insight-ricerca' ); ?>">
				<?php foreach ( $hero_slides as $index => $slide ) : ?>
					<button class="hero-dot<?php echo 0 === $index ? ' is-active' : ''; ?>" data-goto="<?php echo esc_attr( $index ); ?>" aria-label="<?php echo esc_attr( sprintf( /* translators: %d: numero slide. */ __( 'Vai alla slide %d', 'insight-ricerca' ), $index + 1 ) ); ?>"></button>
				<?php endforeach; ?>
			</div>
			<div class="hero-arrows">
				<button class="hero-arrow" data-prev aria-label="<?php esc_attr_e( 'Slide precedente', 'insight-ricerca' ); ?>">&#8592;</button>
				<button class="hero-arrow" data-next aria-label="<?php esc_attr_e( 'Slide successiva', 'insight-ricerca' ); ?>">&#8594;</button>
			</div>
		</div>
	</div>
</section>

<!-- ============ NOTIZIE ============ -->
<section class="section" id="notizie">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow"><?php esc_html_e( 'Notizie', 'insight-ricerca' ); ?></span>
			<h2><?php esc_html_e( 'Titolo sezione notizie', 'insight-ricerca' ); ?></h2>
			<p class="lead"><?php esc_html_e( 'Breve introduzione della sezione: sostituisci questo testo presentando gli ultimi studi pubblicati.', 'insight-ricerca' ); ?></p>
		</div>

		<div class="cards-grid">
			<?php
			$news_query = new WP_Query(
				array(
					'posts_per_page'      => 3,
					'ignore_sticky_posts' => true,
				)
			);

			if ( $news_query->have_posts() ) :
				while ( $news_query->have_posts() ) :
					$news_query->the_post();
					?>
					<article class="card">
						<a class="card-media" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'large' ); ?>
							<?php else : ?>
								<img src="<?php echo esc_url( insight_ricerca_placeholder_image( (int) get_the_ID() ) ); ?>" alt="">
							<?php endif; ?>
						</a>
						<div class="card-body">
							<p class="card-meta"><?php echo esc_html( get_the_date() ); ?></p>
							<h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p class="card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
							<a class="card-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Leggi tutto', 'insight-ricerca' ); ?> &#8594;</a>
						</div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				?>
				<article class="card">
					<div class="card-media"><img src="<?php echo esc_url( insight_ricerca_placeholder_image( 0 ) ); ?>" alt=""></div>
					<div class="card-body">
						<h3 class="card-title"><?php esc_html_e( 'Nessun articolo pubblicato', 'insight-ricerca' ); ?></h3>
						<p class="card-excerpt"><?php esc_html_e( 'Crea il primo articolo: apparirà automaticamente in questa sezione.', 'insight-ricerca' ); ?></p>
					</div>
				</article>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- ============ CTA BANNER ============ -->
<section class="section section--dark cta-banner">
	<div class="container">
		<h2><?php esc_html_e( 'Comprendi come cambia il contesto.<br>Scopri la nostra piattaforma.', 'insight-ricerca' ); ?></h2>
		<a class="btn btn--ghost" href="#contatti"><?php esc_html_e( 'Contattaci', 'insight-ricerca' ); ?></a>
	</div>
</section>

<!-- ============ CHI SIAMO ============ -->
<section class="section" id="chi-siamo">
	<div class="container">
		<div class="about-grid">
			<div class="about-media">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/about.svg' ); ?>" alt="<?php esc_attr_e( 'Immagine segnaposto chi siamo', 'insight-ricerca' ); ?>">
			</div>
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Chi siamo', 'insight-ricerca' ); ?></span>
				<h2><?php esc_html_e( 'I numeri raccontano le persone', 'insight-ricerca' ); ?></h2>
				<p><?php esc_html_e( 'Testo segnaposto: presenta qui la società, la sua storia e la missione. Due o tre paragrafi brevi che spiegano chi siete e cosa fate.', 'insight-ricerca' ); ?></p>
				<p><?php esc_html_e( 'Osservate il contesto in cui le persone vivono, consumano e scelgono: il valore del dato sta nella capacità di generare comprensione.', 'insight-ricerca' ); ?></p>
			</div>
		</div>

		<div class="values-grid">
			<div class="value">
				<span class="value-index">01</span>
				<h4><?php esc_html_e( 'Valore uno', 'insight-ricerca' ); ?></h4>
				<p><?php esc_html_e( 'Breve descrizione del primo punto di forza.', 'insight-ricerca' ); ?></p>
			</div>
			<div class="value">
				<span class="value-index">02</span>
				<h4><?php esc_html_e( 'Valore due', 'insight-ricerca' ); ?></h4>
				<p><?php esc_html_e( 'Breve descrizione del secondo punto di forza.', 'insight-ricerca' ); ?></p>
			</div>
			<div class="value">
				<span class="value-index">03</span>
				<h4><?php esc_html_e( 'Valore tre', 'insight-ricerca' ); ?></h4>
				<p><?php esc_html_e( 'Breve descrizione del terzo punto di forza.', 'insight-ricerca' ); ?></p>
			</div>
			<div class="value">
				<span class="value-index">04</span>
				<h4><?php esc_html_e( 'Valore quattro', 'insight-ricerca' ); ?></h4>
				<p><?php esc_html_e( 'Breve descrizione del quarto punto di forza.', 'insight-ricerca' ); ?></p>
			</div>
		</div>
	</div>
</section>

<!-- ============ QUOTE STRIP ============ -->
<section class="section section--light quote-strip">
	<div class="container">
		<h2><?php esc_html_e( 'Il dato misura.<br>L\'interpretazione orienta.', 'insight-ricerca' ); ?></h2>
		<a class="btn btn--outline" href="#servizi"><?php esc_html_e( 'Scopri di più', 'insight-ricerca' ); ?></a>
	</div>
</section>

<!-- ============ SERVIZI ============ -->
<section class="section" id="servizi">
	<div class="container">
		<div class="services-grid">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Servizi', 'insight-ricerca' ); ?></span>
				<h2><?php esc_html_e( 'La ricerca su misura, con una lettura interpretativa', 'insight-ricerca' ); ?></h2>
				<p class="lead"><?php esc_html_e( 'Ogni ricerca è progettata in funzione del problema da risolvere. Non consegniamo soltanto dati: mettiamo a disposizione chiavi di lettura che aiutano a decidere.', 'insight-ricerca' ); ?></p>
				<ul class="questions-list">
					<li><?php esc_html_e( 'Domanda segnaposto numero uno?', 'insight-ricerca' ); ?></li>
					<li><?php esc_html_e( 'Domanda segnaposto numero due?', 'insight-ricerca' ); ?></li>
					<li><?php esc_html_e( 'Domanda segnaposto numero tre?', 'insight-ricerca' ); ?></li>
					<li><?php esc_html_e( 'Domanda segnaposto numero quattro?', 'insight-ricerca' ); ?></li>
				</ul>
			</div>
			<div class="service-cta">
				<h3><?php esc_html_e( 'Comprendi come cambia il contesto.', 'insight-ricerca' ); ?></h3>
				<p><?php esc_html_e( 'Compila il form e ti ricontatteremo per costruire insieme la soluzione più adatta alle tue esigenze.', 'insight-ricerca' ); ?></p>
				<a class="btn btn--primary" href="#contatti"><?php esc_html_e( 'Scopri di più', 'insight-ricerca' ); ?></a>
			</div>
		</div>
	</div>
</section>

<!-- ============ CLIENTI ============ -->
<section class="section section--light" id="clienti">
	<div class="container">
		<div class="section-head section-head--center">
			<span class="eyebrow"><?php esc_html_e( 'Clienti', 'insight-ricerca' ); ?></span>
			<h2><?php esc_html_e( 'Aziende e istituzioni che si fidano di noi', 'insight-ricerca' ); ?></h2>
		</div>
		<div class="clients-grid">
			<?php for ( $i = 1; $i <= 8; $i++ ) : ?>
				<div class="client-logo"><?php echo esc_html( sprintf( /* translators: %d: numero segnaposto. */ __( 'Logo %d', 'insight-ricerca' ), $i ) ); ?></div>
			<?php endfor; ?>
		</div>
	</div>
</section>

<!-- ============ CONTATTI ============ -->
<?php
$contact_status = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : '';
?>
<section class="section" id="contatti">
	<div class="container">
		<div class="contact-grid">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Clienti', 'insight-ricerca' ); ?></span>
				<h2><?php esc_html_e( 'Contattaci', 'insight-ricerca' ); ?></h2>
				<p class="lead"><?php esc_html_e( 'Compila il form e ti ricontatteremo per capire le tue esigenze e costruire insieme la soluzione più adatta.', 'insight-ricerca' ); ?></p>
			</div>

			<div>
				<?php if ( 'ok' === $contact_status ) : ?>
					<p class="form-status is-visible form-status--ok"><?php esc_html_e( 'Grazie! Il tuo messaggio è stato inviato correttamente.', 'insight-ricerca' ); ?></p>
				<?php elseif ( 'error' === $contact_status ) : ?>
					<p class="form-status is-visible form-status--error"><?php esc_html_e( 'Si è verificato un errore: controlla i campi obbligatori e riprova.', 'insight-ricerca' ); ?></p>
				<?php endif; ?>

				<form class="form-grid" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<input type="hidden" name="action" value="insight_ricerca_contact">
					<?php wp_nonce_field( 'insight_ricerca_contact', 'insight_ricerca_contact_nonce' ); ?>

					<div class="form-field">
						<label for="contact_name"><?php esc_html_e( 'Nome e cognome *', 'insight-ricerca' ); ?></label>
						<input type="text" id="contact_name" name="contact_name" required>
					</div>

					<div class="form-field">
						<label for="contact_email"><?php esc_html_e( 'Email *', 'insight-ricerca' ); ?></label>
						<input type="email" id="contact_email" name="contact_email" required>
					</div>

					<div class="form-field">
						<label for="contact_phone"><?php esc_html_e( 'Telefono', 'insight-ricerca' ); ?></label>
						<input type="tel" id="contact_phone" name="contact_phone">
					</div>

					<div class="form-field">
						<label for="contact_company"><?php esc_html_e( 'Azienda', 'insight-ricerca' ); ?></label>
						<input type="text" id="contact_company" name="contact_company">
					</div>

					<div class="form-field form-field--full">
						<label for="contact_message"><?php esc_html_e( 'Messaggio', 'insight-ricerca' ); ?></label>
						<textarea id="contact_message" name="contact_message" rows="5"></textarea>
					</div>

					<label class="consent-field">
						<input type="checkbox" required>
						<span><?php esc_html_e( 'Ho letto ed accetto la privacy policy del sito. *', 'insight-ricerca' ); ?></span>
					</label>

					<div class="form-field--full">
						<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Invia richiesta', 'insight-ricerca' ); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
