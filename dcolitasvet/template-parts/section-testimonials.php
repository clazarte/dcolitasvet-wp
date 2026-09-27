<?php $dcv_testimonials = dcv_query( 'dcv_testimonio' ); ?>
    <!-- ══════════════════════════════
         TESTIMONIALS
    ══════════════════════════════ -->
    <section class="testimonials section" id="testimonios" aria-label="Testimonios de clientes">
      <div class="container">
        <div class="section__header section__header--center">
          <p class="eyebrow">Testimonios</p>
          <h2 class="section__title">Lo que dicen<br>nuestros clientes</h2>
        </div>

        <ul class="testimonials__grid" role="list">
          <?php while ( $dcv_testimonials->have_posts() ) : $dcv_testimonials->the_post(); ?>
            <?php $dcv_stars = max( 1, min( 5, (int) get_post_meta( get_the_ID(), '_dcv_estrellas', true ) ?: 5 ) ); ?>
            <li class="testi-card" role="listitem">
              <div class="testi-card__stars" aria-label="<?php echo esc_attr( $dcv_stars . ' estrellas' ); ?>"><?php echo esc_html( str_repeat( '★', $dcv_stars ) ); ?></div>
              <blockquote class="testi-card__text">
                "<?php echo esc_html( get_post_meta( get_the_ID(), '_dcv_texto', true ) ); ?>"
              </blockquote>
              <div class="testi-card__author">
                <div>
                  <div class="testi-card__name"><?php the_title(); ?></div>
                  <div class="testi-card__pet"><?php echo esc_html( get_post_meta( get_the_ID(), '_dcv_mascota', true ) ); ?></div>
                </div>
              </div>
            </li>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </ul>
      </div>
    </section>
