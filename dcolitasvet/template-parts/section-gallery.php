    <!-- ══════════════════════════════
         GALLERY
    ══════════════════════════════ -->
    <section class="gallery section section--cream" id="galeria" aria-label="Galería de mascotas">
      <div class="container">
        <div class="section__header section__header--center">
          <p class="eyebrow">Galería</p>
          <h2 class="section__title">Nuestros pacientes<br>más adorables</h2>
        </div>

        <div class="gallery__grid" role="list" aria-label="Fotos de nuestros pacientes">
          <?php for ( $i = 1; $i <= 6; $i++ ) : ?>
            <div class="gallery__item" role="listitem">
              <img src="<?php echo esc_url( dcv_mod( "gallery_{$i}_img" ) ); ?>" alt="<?php echo esc_attr( dcv_mod( "gallery_{$i}_alt" ) ); ?>" loading="lazy" width="800" height="480">
              <div class="gallery__overlay" aria-hidden="true"></div>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </section>
