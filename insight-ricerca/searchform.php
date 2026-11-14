<?php
/**
 * Form di ricerca.
 *
 * @package insight-ricerca
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="search-field"><?php esc_html_e( 'Cerca nel sito', 'insight-ricerca' ); ?></label>
	<input type="search" id="search-field" placeholder="<?php esc_attr_e( 'Cerca…', 'insight-ricerca' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	<button type="submit" class="btn btn--primary btn--sm"><?php esc_html_e( 'Cerca', 'insight-ricerca' ); ?></button>
</form>
