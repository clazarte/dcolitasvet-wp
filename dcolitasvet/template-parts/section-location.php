<?php $dcv_q = dcv_maps_query(); ?>
    <!-- ══════════════════════════════
         LOCATION
    ══════════════════════════════ -->
    <section class="location section" id="ubicacion" aria-label="Cómo llegar">
      <div class="container">

        <div class="location__header">
          <p class="eyebrow">¿Dónde estamos?</p>
          <h2 class="section__title">Siempre cerca de ti<br>y tu mascota</h2>
          <p class="location__subtitle">
            Atendemos de <strong>lunes a domingo</strong> con citas y urgencias.
            Encuéntranos fácilmente en San Luis, Lima.
          </p>
        </div>

        <div class="location__grid">

          <!-- Mapa -->
          <div class="location__map-wrap">
            <iframe
              class="location__map"
              title="Ubicación de D'Colitas Vet en Google Maps"
              src="<?php echo esc_url( 'https://www.google.com/maps?q=' . $dcv_q . '&output=embed' ); ?>"
              allowfullscreen
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>

          <!-- Info card -->
          <div class="location__card">
            <div class="location__card-logo">
              <img src="<?php echo esc_url( DCV_URI . '/assets/images/isotipo.png' ); ?>" alt="" aria-hidden="true" width="40" height="40">
              <div>
                <span class="location__card-name">D'Colitas Vet</span>
                <span class="location__card-tag">Clínica Veterinaria</span>
              </div>
            </div>

            <div class="location__address">
              <span class="location__address-icon">📍</span>
              <div>
                <p class="location__address-line"><?php echo esc_html( dcv_mod( 'address_line1' ) ); ?>,</p>
                <p class="location__address-line"><?php echo esc_html( dcv_mod( 'address_line2' ) ); ?></p>
              </div>
            </div>

            <p class="location__services-title">Todo en un solo lugar:</p>
            <ul class="location__services-list" role="list">
              <li>Consulta Veterinaria</li>
              <li>Laboratorio Clínico</li>
              <li>Ecografía y Radiografía</li>
              <li>Cirugía Veterinaria</li>
              <li>Vacunaciones y Tratamientos</li>
              <li>Internamientos</li>
            </ul>

            <div class="location__actions">
              <a
                href="<?php echo esc_url( 'https://maps.google.com/?q=' . $dcv_q ); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="location__btn location__btn--maps">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor"/>
                </svg>
                Google Maps
              </a>
              <a
                href="<?php echo esc_url( 'https://waze.com/ul?q=' . $dcv_q ); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="location__btn location__btn--waze">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <circle cx="12" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                  <circle cx="9"  cy="14" r="1" fill="currentColor"/>
                  <circle cx="15" cy="14" r="1" fill="currentColor"/>
                  <path d="M9 11 Q12 13 15 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                </svg>
                Ir con Waze
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>
