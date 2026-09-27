<?php
/**
 * front-page.php — Página de inicio (landing completa)
 *
 * Cada sección vive en template-parts/section-*.php
 */

get_header();
?>

  <main id="main-content">
    <?php
    foreach ( array( 'hero', 'services', 'staff', 'why', 'gallery', 'testimonials', 'location', 'contact' ) as $dcv_section ) {
        get_template_part( 'template-parts/section', $dcv_section );
    }
    ?>
  </main>

<?php
get_footer();
