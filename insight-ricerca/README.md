# Insight Ricerca — Tema WordPress

Tema WordPress classico (PHP) per studi di ricerca, analisi e istituzioni. Ispirato nella struttura a un sito editoriale di ricerca: hero slider, sezione notizie, banner CTA, chi siamo, servizi, clienti e form di contatto.

Tutti i nomi della società, i testi e le immagini sono **segnaposto originali** (nessun contenuto copiato dal sito di riferimento). Le immagini in `assets/img/` sono grafiche SVG create appositamente per questo tema, utilizzabili liberamente (CC0).

## Installazione

1. Comprimi la cartella `insight-ricerca` in un file `.zip` (o usa il zip già fornito).
2. In WordPress vai su **Aspetto → Temi → Aggiungi nuovo → Carica tema** e seleziona lo zip.
3. Attiva il tema.
4. Vai su **Impostazioni → Lettura** e imposta una pagina statica come homepage: il tema userà automaticamente `front-page.php` per la pagina iniziale.

## Configurazione (Aspetto → Personalizza)

- **Colori del tema**: colore primario e colore accento (applicati a tutto il sito via variabili CSS).
- **Contatti e topbar**: testo, email e telefono mostrati nella barra superiore; email destinataria del form di contatto.
- **Footer**: testo "chi siamo", indirizzo, copyright.
- **Social**: URL dei profili (LinkedIn, X, Instagram, YouTube — vuoto = non mostrato).
- **Identità del sito**: carica il logo in *Aspetto → Personalizza → Identità del sito*; senza logo viene mostrato il nome del sito in testo.

## Menu

Il tema registra tre posizioni menu (**Aspetto → Menu**):

- `Menu principale` — header
- `Menu footer` — colonna "Esplora"
- `Menu legale (privacy/cookie)` — colonna "Informazioni"

## Form di contatto

Il form nella homepage invia una email all'indirizzo impostato nel Customizer (predefinito: email amministratore) tramite `wp_mail()`. Richiede che il sito possa inviare email (in produzione configura un SMTP, ad esempio con un plugin tipo WP Mail SMTP). In alternativa il form è facilmente sostituibile con Contact Form 7 o Gravity Forms sostituendo il markup nella sezione `#contatti` di `front-page.php`.

## Sostituire i segnaposto

- **Testi**: tutti i testi di esempio sono in `front-page.php` (slide hero, sezioni, valori, domande servizi) e sono filtrabili; le slide dell'hero sono modificabili anche via filtro `insight_ricerca_hero_slides` in un child theme.
- **Immagini**: sostituisci gli SVG in `assets/img/` con foto di tuo possesso o con immagini di pubblico dominio (es. Unsplash, Pexels, Wikimedia Commons verificando la licenza).
- **Loghi clienti**: la griglia in `#clienti` usa box segnaposto; sostituiscili con `<img>` dei logo (richiedi autorizzazione ai clienti).

## Struttura file

```
insight-ricerca/
├── style.css              Intestazione tema + stili (variabili CSS per i colori)
├── functions.php          Setup tema, asset, widget, form di contatto
├── header.php / footer.php
├── front-page.php         Homepage: slider, notizie, CTA, chi siamo, servizi, clienti, contatti
├── page.php / single.php / archive.php / search.php / 404.php / index.php
├── comments.php / searchform.php
├── template-parts/        Card articolo, contenuto assente
├── inc/
│   ├── customizer.php     Opzioni del Customizer
│   └── template-tags.php  Funzioni di template
├── assets/
│   ├── js/main.js         Menu mobile + slider hero (vanilla JS, nessuna dipendenza)
│   ├── js/customizer.js   Anteprima live colori
│   └── img/*.svg          Immagini segnaposto originali (CC0)
└── screenshot.png
```

## Requisiti

- WordPress 6.0+, PHP 7.4+
- Nessun plugin obbligatorio, nessuna dipendenza di build
