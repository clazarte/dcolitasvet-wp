<?php $dcv_staff = dcv_query( 'dcv_miembro' ); ?>
    <!-- ══════════════════════════════
         STAFF
    ══════════════════════════════ -->
    <section class="staff section" id="equipo" aria-label="Nuestro equipo médico">
      <div class="container">
        <div class="section__header">
          <div>
            <p class="eyebrow">Nuestro equipo</p>
            <h2 class="section__title">Profesionales que<br>aman lo que hacen</h2>
          </div>
          <p class="section__sub">
            Médicos veterinarios colegiados y especializados, comprometidos con el bienestar
            de cada paciente. Tu mascota está en las mejores manos.
          </p>
        </div>

        <ul class="staff__grid" role="list">
          <?php while ( $dcv_staff->have_posts() ) : $dcv_staff->the_post(); ?>
            <?php
            $dcv_bio_id = 'staff-bio-' . get_the_ID();
            $dcv_bio    = dcv_lines( get_post_meta( get_the_ID(), '_dcv_bio', true ) );
            ?>
            <li class="staff-card" role="listitem">
              <div class="staff-card__photo-wrap">
                <img src="<?php echo esc_url( dcv_staff_photo_url( get_the_ID() ) ); ?>" alt="<?php echo esc_attr( 'Foto de ' . get_the_title() ); ?>" class="staff-card__photo" loading="lazy" width="640" height="800">
              </div>
              <div class="staff-card__body">
                <h3 class="staff-card__name"><?php the_title(); ?></h3>
                <p class="staff-card__role"><?php echo esc_html( get_post_meta( get_the_ID(), '_dcv_cargo', true ) ); ?></p>
                <?php if ( $dcv_bio ) : ?>
                  <button class="staff-card__toggle" aria-expanded="false" aria-controls="<?php echo esc_attr( $dcv_bio_id ); ?>">
                    <span class="staff-card__toggle-label">Ver más</span>
                    <svg class="staff-card__toggle-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                      <path d="M4 6l4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </button>
                  <div class="staff-card__bio" id="<?php echo esc_attr( $dcv_bio_id ); ?>" role="region">
                    <ul class="staff-card__bio-list">
                      <?php foreach ( $dcv_bio as $dcv_line ) : ?>
                        <li><?php echo esc_html( $dcv_line ); ?></li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endif; ?>
              </div>
            </li>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </ul>
      </div>
    </section>
