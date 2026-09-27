/**
 * scroll.js — Smooth anchor links & scroll-reveal
 * D'Colitas Vet
 */

(function () {
  'use strict';

  /* ── Smooth scroll for anchor links ── */
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      const id = anchor.getAttribute('href').slice(1);
      if (!id) return;
      const target = document.getElementById(id);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth' });
        /* Move focus for accessibility */
        target.setAttribute('tabindex', '-1');
        target.focus({ preventScroll: true });
      }
    });
  });

  /* ── Scroll reveal ── */
  var revealElements = document.querySelectorAll(
    '.service-card, .staff-card, .why-item, .testi-card, .gallery__item, .hero__stats .stat'
  );

  if (!revealElements.length) return;

  /* Add reveal class */
  revealElements.forEach(function (el) {
    el.classList.add('reveal');
  });

  /* IntersectionObserver — show elements as they enter viewport */
  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.15,
      rootMargin: '0px 0px -40px 0px',
    }
  );

  revealElements.forEach(function (el) {
    observer.observe(el);
  });

})();
