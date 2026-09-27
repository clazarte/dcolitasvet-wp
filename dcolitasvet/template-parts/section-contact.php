<?php $dcv_services = dcv_query( 'dcv_servicio' ); ?>
    <!-- ══════════════════════════════
         CONTACT
    ══════════════════════════════ -->
    <section class="contact section section--mint" id="contacto" aria-label="Contacto y agendar cita">
      <div class="container">
        <div class="contact__grid">
          <div class="contact__info">
            <p class="eyebrow eyebrow--light">Contacto</p>
            <h2 class="section__title section__title--light">¿Listo para agendar<br>tu cita?</h2>
            <p class="section__sub section__sub--light">
              Estamos aquí para ayudarte. Contáctanos por cualquier canal
              o completa el formulario y te respondemos a la brevedad.
            </p>

            <ul class="contact__list" role="list">
              <li class="contact-item" role="listitem">
                <div class="contact-item__icon" aria-hidden="true">📍</div>
                <div>
                  <div class="contact-item__label">Dirección</div>
                  <div class="contact-item__value"><?php echo esc_html( dcv_address() ); ?></div>
                </div>
              </li>
              <li class="contact-item" role="listitem">
                <div class="contact-item__icon" aria-hidden="true">📱</div>
                <div>
                  <div class="contact-item__label">WhatsApp / Teléfono</div>
                  <div class="contact-item__value"><?php echo esc_html( dcv_mod( 'phone_display' ) ); ?></div>
                </div>
              </li>
              <li class="contact-item" role="listitem">
                <div class="contact-item__icon" aria-hidden="true">🕐</div>
                <div>
                  <div class="contact-item__label">Horario de atención</div>
                  <div class="contact-item__value"><?php echo esc_html( dcv_mod( 'schedule' ) ); ?></div>
                </div>
              </li>
              <?php if ( dcv_mod( 'instagram_user' ) ) : ?>
                <li class="contact-item" role="listitem">
                  <div class="contact-item__icon" aria-hidden="true">📸</div>
                  <div>
                    <div class="contact-item__label">Instagram</div>
                    <a href="<?php echo esc_url( dcv_mod( 'instagram_url' ) ); ?>" target="_blank" rel="noopener noreferrer" class="contact-item__value contact-item__link"><?php echo esc_html( dcv_mod( 'instagram_user' ) ); ?></a>
                  </div>
                </li>
              <?php endif; ?>
            </ul>
          </div>

          <div class="contact__form-wrap">
            <form class="form" id="contactForm" novalidate aria-label="Formulario de solicitud de cita">
              <h3 class="form__title">Solicitar cita</h3>

              <div class="form__row">
                <div class="form__group">
                  <label class="form__label" for="name">Tu nombre</label>
                  <input class="form__input" type="text" id="name" name="name" placeholder="María García" autocomplete="name" required>
                  <span class="form__error" id="name-error" aria-live="polite"></span>
                </div>
                <div class="form__group">
                  <label class="form__label" for="phone">Teléfono</label>
                  <input class="form__input" type="tel" id="phone" name="phone" placeholder="+51 999 000 000" autocomplete="tel" required>
                  <span class="form__error" id="phone-error" aria-live="polite"></span>
                </div>
              </div>

              <div class="form__row">
                <div class="form__group">
                  <label class="form__label" for="petName">Nombre de tu mascota</label>
                  <input class="form__input" type="text" id="petName" name="petName" placeholder="Max, Luna, Coco..." required>
                </div>
                <div class="form__group">
                  <label class="form__label" for="petType">Tipo de mascota</label>
                  <select class="form__input form__select" id="petType" name="petType" required>
                    <option value="">Seleccionar...</option>
                    <option value="dog">🐶 Perro</option>
                    <option value="cat">🐱 Gato</option>
                    <option value="rabbit">🐰 Conejo</option>
                    <option value="bird">🦜 Ave</option>
                    <option value="other">Otro</option>
                  </select>
                </div>
              </div>

              <div class="form__group">
                <label class="form__label" for="service">Servicio requerido</label>
                <select class="form__input form__select" id="service" name="service" required>
                  <option value="">¿Qué necesitas?</option>
                  <?php while ( $dcv_services->have_posts() ) : $dcv_services->the_post(); ?>
                    <option value="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></option>
                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?>
                  <option value="Otro">Otro</option>
                </select>
              </div>

              <div class="form__group">
                <label class="form__label" for="message">Mensaje adicional</label>
                <textarea class="form__input form__textarea" id="message" name="message" placeholder="Cuéntanos brevemente sobre tu mascota o la consulta que necesitas..."></textarea>
              </div>

              <button class="btn btn--submit" type="submit" id="submitBtn">
                <span class="btn__text">💬 Continuar por WhatsApp</span>
                <span class="btn__loading" aria-hidden="true" hidden>Abriendo WhatsApp...</span>
              </button>

              <div class="form__success" id="formSuccess" role="alert" aria-live="assertive" hidden>
                ✅ ¡Solicitud enviada! Te contactaremos pronto.
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
