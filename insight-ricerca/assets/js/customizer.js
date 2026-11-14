/**
 * Anteprima live dei colori nel Customizer.
 */
(function ($) {
	'use strict';

	if (typeof wp === 'undefined' || !wp.customize) {
		return;
	}

	wp.customize('insight_ricerca_primary_color', function (value) {
		value.bind(function (to) {
			document.documentElement.style.setProperty('--c-primary', to);
		});
	});

	wp.customize('insight_ricerca_accent_color', function (value) {
		value.bind(function (to) {
			document.documentElement.style.setProperty('--c-accent', to);
		});
	});
})(jQuery);
