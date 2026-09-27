/**
 * staff.js — Accordion toggle for staff cards
 * D'Colitas Vet
 */

(function () {
  'use strict';

  document.querySelectorAll('.staff-card__toggle').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var expanded = btn.getAttribute('aria-expanded') === 'true';
      var panelId  = btn.getAttribute('aria-controls');
      var panel    = document.getElementById(panelId);

      btn.setAttribute('aria-expanded', String(!expanded));
      if (panel) panel.classList.toggle('is-open', !expanded);
    });
  });

})();
