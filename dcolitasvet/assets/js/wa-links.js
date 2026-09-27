/**
 * wa-links.js — Rellena los enlaces de WhatsApp desde config.js
 * D'Colitas Vet
 *
 * Mantiene un único número configurado en js/config.js y lo
 * propaga a todos los botones de WhatsApp del sitio (hero,
 * botón flotante, etc.) para evitar números desincronizados.
 */

(function () {
  'use strict';

  const waConfig = (window.SITE_CONFIG && window.SITE_CONFIG.whatsapp) || {};
  const phone    = waConfig.phone || '';
  const message  = waConfig.defaultMessage || '';

  if (!phone) return;

  /* api.whatsapp.com conserva los emojis del mensaje (wa.me los estropea) */
  const baseUrl = 'https://api.whatsapp.com/send?phone=' + phone;
  const fullUrl = baseUrl + '&text=' + encodeURIComponent(message);

  const heroBtn  = document.getElementById('heroWaBtn');
  const floatBtn = document.getElementById('waFloatBtn');

  if (heroBtn)  heroBtn.setAttribute('href', baseUrl);
  if (floatBtn) floatBtn.setAttribute('href', fullUrl);

})();
