/**
 * Insight Ricerca: interazioni lato client.
 */
(function () {
	'use strict';

	/* ---------- Menu mobile ---------- */
	var toggle = document.querySelector('.menu-toggle');
	var nav = document.getElementById('site-navigation');

	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var open = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
	}

	/* ---------- Hero slider ---------- */
	var hero = document.querySelector('.hero');

	if (hero) {
		var slides = hero.querySelectorAll('.hero-slide');
		var dots = hero.querySelectorAll('.hero-dot');
		var current = 0;
		var timer = null;
		var interval = 6000;

		function show(index) {
			current = (index + slides.length) % slides.length;

			slides.forEach(function (slide, i) {
				slide.classList.toggle('is-active', i === current);
			});

			dots.forEach(function (dot, i) {
				dot.classList.toggle('is-active', i === current);
			});
		}

		function play() {
			stop();
			timer = window.setInterval(function () {
				show(current + 1);
			}, interval);
		}

		function stop() {
			if (timer) {
				window.clearInterval(timer);
				timer = null;
			}
		}

		dots.forEach(function (dot) {
			dot.addEventListener('click', function () {
				show(parseInt(dot.getAttribute('data-goto'), 10) || 0);
				play();
			});
		});

		var prev = hero.querySelector('[data-prev]');
		var next = hero.querySelector('[data-next]');

		if (prev) {
			prev.addEventListener('click', function () {
				show(current - 1);
				play();
			});
		}

		if (next) {
			next.addEventListener('click', function () {
				show(current + 1);
				play();
			});
		}

		hero.addEventListener('mouseenter', stop);
		hero.addEventListener('mouseleave', play);

		if (slides.length > 1) {
			play();
		}
	}
})();
