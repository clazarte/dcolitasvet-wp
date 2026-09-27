<?php
/**
 * index.php — Plantilla de respaldo
 *
 * La página principal usa front-page.php. Esta plantilla solo se usa si
 * alguien crea entradas o páginas normales de WordPress.
 */

get_header();
?>

  <main id="main-content">
    <section class="section">
      <div class="container">
        <?php if ( have_posts() ) : ?>
          <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class(); ?>>
              <h1 class="section__title"><?php the_title(); ?></h1>
              <div class="entry-content"><?php the_content(); ?></div>
            </article>
          <?php endwhile; ?>
        <?php else : ?>
          <h1 class="section__title">Página no encontrada</h1>
          <p><a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">Volver al inicio</a></p>
        <?php endif; ?>
      </div>
    </section>
  </main>

<?php
get_footer();
