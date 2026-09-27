/**
 * form.js — Contact form validation & redirección a WhatsApp
 * D'Colitas Vet
 *
 * Al enviar, el formulario construye un mensaje con los datos
 * ingresados y abre WhatsApp (Web/App) con el chat precargado
 * hacia el número configurado en js/config.js
 */

(function () {
  'use strict';

  const config     = (window.SITE_CONFIG && window.SITE_CONFIG.whatsapp) || {};
  const form       = document.getElementById('contactForm');
  const submitBtn  = document.getElementById('submitBtn');
  const successMsg = document.getElementById('formSuccess');

  if (!form) return;

  /* ── Validators ── */
  const validators = {
    name: function (val) {
      if (!val.trim()) return 'El nombre es obligatorio.';
      if (val.trim().length < 2) return 'Ingresa al menos 2 caracteres.';
      return '';
    },
    phone: function (val) {
      if (!val.trim()) return 'El teléfono es obligatorio.';
      const cleaned = val.replace(/\s+/g, '');
      if (!/^[+]?[\d\s\-()]{7,15}$/.test(cleaned)) return 'Ingresa un teléfono válido.';
      return '';
    },
    petName: function (val) {
      if (!val.trim()) return 'El nombre de tu mascota es obligatorio.';
      return '';
    },
    petType: function (val) {
      if (!val) return 'Selecciona el tipo de mascota.';
      return '';
    },
    service: function (val) {
      if (!val) return 'Selecciona el servicio que necesitas.';
      return '';
    },
  };

  /* ── Show / clear a field error ── */
  function setError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const error = document.getElementById(fieldId + '-error');
    if (!field) return;
    if (message) {
      field.classList.add('is-invalid');
      if (error) error.textContent = message;
    } else {
      field.classList.remove('is-invalid');
      if (error) error.textContent = '';
    }
  }

  /* ── Validate one field ── */
  function validateField(fieldId) {
    const field = document.getElementById(fieldId);
    if (!field || !validators[fieldId]) return true;
    const error = validators[fieldId](field.value);
    setError(fieldId, error);
    return error === '';
  }

  /* ── Live validation on blur ── */
  ['name', 'phone', 'petName', 'petType', 'service'].forEach(function (id) {
    const el = document.getElementById(id);
    if (el) {
      el.addEventListener('blur', function () { validateField(id); });
      el.addEventListener('input', function () {
        if (el.classList.contains('is-invalid')) validateField(id);
      });
    }
  });

  /* ── Full form validation ── */
  function validateAll() {
    const fields = ['name', 'phone', 'petName', 'petType', 'service'];
    return fields.map(validateField).every(Boolean);
  }

  /* Etiquetas legibles para el tipo de mascota
     (el servicio ya llega con su nombre: las opciones salen de Servicios en WordPress) */
  const petTypeLabels = {
    dog: 'Perro',
    cat: 'Gato',
  };

  /* ── Construir el mensaje de WhatsApp ── */
  function buildWhatsAppMessage(data) {
    const petType = petTypeLabels[data.petType] || data.petType;
    const service  = data.service;

    let msg = `Hola! Quiero agendar una cita en D'Colitas Vet\n\n`;
    msg += `*Nombre:* ${data.name}\n`;
    msg += `*Teléfono:* ${data.phone}\n`;
    msg += `*Mascota:* ${data.petName} (${petType})\n`;
    msg += `*Servicio:* ${service}\n`;
    if (data.message && data.message.trim()) {
      msg += `*Mensaje:* ${data.message.trim()}\n`;
    }
    return msg;
  }

  /* ── Submit ── */
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    if (!validateAll()) return;

    /* Loading state */
    submitBtn.disabled = true;
    const btnText    = submitBtn.querySelector('.btn__text');
    const btnLoading = submitBtn.querySelector('.btn__loading');
    if (btnText)    btnText.hidden    = true;
    if (btnLoading) btnLoading.hidden = false;

    const formValues = new FormData(form);
    const data = {
      name: (formValues.get('name') || '').trim(),
      phone: (formValues.get('phone') || '').trim(),
      petName: (formValues.get('petName') || '').trim(),
      petType: formValues.get('petType') || '',
      service: formValues.get('service') || '',
      message: formValues.get('message') || '',
    };

    const phone   = config.phone || '51912865712';
    const text    = buildWhatsAppMessage(data);
    /* api.whatsapp.com conserva los emojis del mensaje (wa.me los estropea) */
    const waUrl   = `https://api.whatsapp.com/send?phone=${phone}&text=${encodeURIComponent(text)}`;

    /* Pequeño delay para mostrar el estado de carga antes de redirigir */
    setTimeout(function () {
      submitBtn.disabled = false;
      if (btnText)    btnText.hidden    = false;
      if (btnLoading) btnLoading.hidden = true;

      if (successMsg) {
        successMsg.textContent = '✅ ¡Listo! Te llevamos a WhatsApp para confirmar tu cita…';
        successMsg.hidden = false;
        successMsg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }

      window.open(waUrl, '_blank', 'noopener,noreferrer');

      form.reset();
      setTimeout(function () {
        if (successMsg) successMsg.hidden = true;
      }, 6000);
    }, 600);
  });

})();
