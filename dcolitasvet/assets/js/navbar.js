/**
 * navbar.js — Scroll shadow & mobile hamburger menu
 * D'Colitas Vet
 */

(function () {
  'use strict';

  const navbar    = document.getElementById('navbar');
  const toggle    = document.getElementById('navToggle');
  const menu      = document.getElementById('navMenu');
  const navLinks  = menu ? menu.querySelectorAll('.nav__link') : [];

  /* ── Scroll shadow ── */
  function onScroll() {
    if (!navbar) return;
    navbar.classList.toggle('is-scrolled', window.scrollY > 20);
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll(); // run once on load

  /* ── Mobile menu toggle ── */
  function openMenu() {
    menu.classList.add('is-open');
    toggle.classList.add('is-open');
    toggle.setAttribute('aria-expanded', 'true');
    toggle.setAttribute('aria-label', 'Cerrar menú');
  }

  function closeMenu() {
    menu.classList.remove('is-open');
    toggle.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', 'Abrir menú');
  }

  if (toggle && menu) {
    toggle.addEventListener('click', function () {
      const isOpen = menu.classList.contains('is-open');
      isOpen ? closeMenu() : openMenu();
    });

    /* Close on link click (mobile) */
    navLinks.forEach(function (link) {
      link.addEventListener('click', closeMenu);
    });

    /* Close on outside click */
    document.addEventListener('click', function (e) {
      if (!navbar.contains(e.target)) {
        closeMenu();
      }
    });

    /* Close on Escape */
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeMenu();
    });
  }

})();
