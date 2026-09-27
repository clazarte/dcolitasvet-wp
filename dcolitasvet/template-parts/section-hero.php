    <!-- ══════════════════════════════
         HERO
    ══════════════════════════════ -->
    <section class="hero section" id="inicio" aria-label="Presentación">
      <div class="hero__content">
        <div class="badge hero__badge">
          <span class="badge__dot" aria-hidden="true"></span>
          <?php echo esc_html( dcv_mod( 'hero_badge' ) ); ?>
        </div>

        <h1 class="hero__title">
          <?php echo esc_html( dcv_mod( 'hero_title_1' ) ); ?><br>
          <em class="hero__title--accent"><?php echo esc_html( dcv_mod( 'hero_title_accent' ) ); ?></em><br>
          <span class="hero__title--love"><?php echo esc_html( dcv_mod( 'hero_title_love' ) ); ?></span>
        </h1>

        <p class="hero__subtitle">
          <?php echo esc_html( dcv_mod( 'hero_subtitle' ) ); ?>
        </p>

        <div class="hero__actions">
          <a href="#contacto" class="btn btn--primary">
            <span aria-hidden="true">🐶</span> Agendar cita
          </a>
          <a href="#" id="heroWaBtn" class="btn btn--ghost" target="_blank" rel="noopener noreferrer">
            <span aria-hidden="true">💬</span> WhatsApp
          </a>
        </div>

        <div class="hero__stats" role="list">
          <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
            <div class="stat" role="listitem">
              <span class="stat__number"><?php echo esc_html( dcv_mod( "hero_stat_{$i}_num" ) ); ?></span>
              <span class="stat__label"><?php echo esc_html( dcv_mod( "hero_stat_{$i}_label" ) ); ?></span>
            </div>
          <?php endfor; ?>
        </div>
      </div>

      <div class="hero__visual" aria-hidden="true">
        <div class="hero__img-wrap">
          <img
            src="<?php echo esc_url( dcv_mod( 'hero_img_main' ) ); ?>"
            alt="Perro feliz en la clínica"
            class="hero__img hero__img--main"
            loading="eager"
            width="370" height="460">
          <img
            src="<?php echo esc_url( dcv_mod( 'hero_img_second' ) ); ?>"
            alt="Gato siendo atendido"
            class="hero__img hero__img--secondary"
            loading="eager"
            width="200" height="200">
          <div class="float-card float-card--white">
            <span class="float-card__icon">💉</span>
            <div>
              <div class="float-card__label">Próxima consulta</div>
              <div class="float-card__value">Hoy disponible</div>
            </div>
          </div>
          <div class="float-card float-card--accent">
            <span class="float-card__icon-lg">❤️</span>
            <div class="float-card__text">100% AMOR</div>
          </div>
        </div>
      </div>
    </section>
