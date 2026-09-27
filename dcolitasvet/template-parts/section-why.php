<?php
$dcv_badge_num  = dcv_mod( 'why_badge_num' );
$dcv_badge_text = dcv_mod( 'why_badge_text' );
?>
    <!-- ══════════════════════════════
         WHY US
    ══════════════════════════════ -->
    <section class="why section section--dark" id="nosotros" aria-label="Por qué elegirnos">
      <div class="container">
        <p class="eyebrow eyebrow--light">¿Por qué elegirnos?</p>
        <h2 class="section__title section__title--light">Tratamos a tu mascota<br>como familia</h2>

        <div class="why__grid">
          <div class="why__visual">
            <img
              src="<?php echo esc_url( dcv_mod( 'why_img' ) ); ?>"
              alt="Veterinaria atendiendo a un perro con cariño"
              class="why__img"
              loading="lazy"
              width="600" height="500">
            <?php if ( $dcv_badge_num ) : ?>
              <div class="why__badge" aria-label="<?php echo esc_attr( $dcv_badge_num . ' ' . preg_replace( '/\s+/', ' ', $dcv_badge_text ) ); ?>">
                <span class="why__badge-num"><?php echo esc_html( $dcv_badge_num ); ?></span>
                <span class="why__badge-txt"><?php echo nl2br( esc_html( $dcv_badge_text ), false ); ?></span>
              </div>
            <?php endif; ?>
          </div>

          <ul class="why__list" role="list">
            <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
              <?php if ( ! dcv_mod( "why_{$i}_title" ) ) { continue; } ?>
              <li class="why-item" role="listitem">
                <div class="why-item__icon" aria-hidden="true"><?php echo esc_html( dcv_mod( "why_{$i}_icon" ) ); ?></div>
                <div>
                  <h3 class="why-item__title"><?php echo esc_html( dcv_mod( "why_{$i}_title" ) ); ?></h3>
                  <p class="why-item__desc"><?php echo esc_html( dcv_mod( "why_{$i}_desc" ) ); ?></p>
                </div>
              </li>
            <?php endfor; ?>
          </ul>
        </div>
      </div>
    </section>
