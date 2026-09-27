<?php $dcv_services = dcv_query( 'dcv_servicio' ); ?>
    <!-- ══════════════════════════════
         SERVICES
    ══════════════════════════════ -->
    <section class="services section" id="servicios" aria-label="Nuestros servicios">
      <div class="container">
        <div class="section__header">
          <div>
            <p class="eyebrow">Nuestros servicios</p>
            <h2 class="section__title">Todo lo que tu mascota<br>necesita en un solo lugar</h2>
          </div>
          <p class="section__sub">
            Contamos con un equipo de profesionales apasionados por el bienestar animal,
            listos para atender a tu compañero con la mejor tecnología y mucho cariño.
          </p>
        </div>

        <ul class="services__grid" role="list">
          <?php while ( $dcv_services->have_posts() ) : $dcv_services->the_post(); ?>
            <li class="service-card" role="listitem">
              <span class="service-card__icon" aria-hidden="true"><?php echo esc_html( get_post_meta( get_the_ID(), '_dcv_icono', true ) ); ?></span>
              <h3 class="service-card__name"><?php the_title(); ?></h3>
              <p class="service-card__desc"><?php echo esc_html( get_post_meta( get_the_ID(), '_dcv_descripcion', true ) ); ?></p>
            </li>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </ul>
      </div>
    </section>
