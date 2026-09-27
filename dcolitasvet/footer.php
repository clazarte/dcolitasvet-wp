  <?php $dcv_home = is_front_page() ? '' : home_url( '/' ); ?>

  <!-- ══════════════════════════════
       FOOTER
  ══════════════════════════════ -->
  <footer class="footer" role="contentinfo">
    <div class="container footer__inner">
      <div class="footer__logo">
        <img src="<?php echo esc_url( DCV_URI . '/assets/images/isotipo-blanco.png' ); ?>" alt="" class="footer__logo-icon" aria-hidden="true" width="32" height="32">
        <span class="footer__logo--accent">D&#8217;Colitas Vet</span>
      </div>
      <p class="footer__copy">© <?php echo esc_html( gmdate( 'Y' ) ); ?> D'Colitas Vet · <?php echo esc_html( dcv_mod( 'address_line2' ) ); ?> 🇵🇪</p>

      <div class="footer__social" aria-label="Redes sociales">
        <?php foreach ( dcv_social_links() as $dcv_social ) : ?>
          <?php if ( $dcv_social['url'] ) : ?>
            <a href="<?php echo esc_url( $dcv_social['url'] ); ?>" target="_blank" rel="noopener noreferrer" class="footer__social-link" aria-label="<?php echo esc_attr( $dcv_social['label'] . " de D'Colitas Vet" ); ?>">
              <?php echo $dcv_social['svg']; // SVG fijo definido en inc/helpers.php. ?>
            </a>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>

      <nav class="footer__nav" aria-label="Links del pie de página">
        <a href="<?php echo esc_url( $dcv_home ); ?>#servicios" class="footer__link">Servicios</a>
        <a href="<?php echo esc_url( $dcv_home ); ?>#contacto" class="footer__link">Contacto</a>
      </nav>
    </div>
  </footer>

  <!-- WhatsApp Floating Button -->
  <a href="#"
     class="wa-float"
     id="waFloatBtn"
     target="_blank"
     rel="noopener noreferrer"
     aria-label="Escríbenos por WhatsApp">
    <span aria-hidden="true">💬</span>
  </a>

<?php wp_footer(); ?>
</body>
</html>
