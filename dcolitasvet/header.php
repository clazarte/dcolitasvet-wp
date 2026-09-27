<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="D'Colitas Vet — Clínica veterinaria en San Luis, Lima. Atención de lunes a domingo: consulta general, oftalmología, traumatología, cirugías, ecografía, radiografía, laboratorio, vacunaciones e internamientos.">
  <meta name="keywords" content="veterinaria San Luis Lima, clínica veterinaria Lima, consulta veterinaria, vacunas mascotas, cirugía veterinaria, ecografía veterinaria, radiografía veterinaria, internamiento mascotas, oftalmología veterinaria, traumatología veterinaria, D'Colitas Vet">
  <meta property="og:title" content="D'Colitas Vet — Clínica Veterinaria en San Luis, Lima">
  <meta property="og:description" content="Atendemos a tu mascota de lunes a domingo. Consultas, cirugías, ecografía, radiografía, laboratorio, vacunaciones e internamientos en San Luis, Lima.">
  <meta property="og:image" content="<?php echo esc_url( DCV_URI . '/assets/images/logotipo.png' ); ?>">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="es_PE">
  <meta name="geo.region" content="PE-LIM">
  <meta name="geo.placename" content="San Luis, Lima, Perú">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <?php $dcv_home = is_front_page() ? '' : home_url( '/' ); ?>

  <!-- ══════════════════════════════
       NAVBAR
  ══════════════════════════════ -->
  <nav class="navbar" id="navbar" role="navigation" aria-label="Navegación principal">
    <a href="<?php echo esc_url( $dcv_home ); ?>#inicio" class="logo" aria-label="D'Colitas Veterinaria — Inicio">
      <img src="<?php echo esc_url( DCV_URI . '/assets/images/isotipo.png' ); ?>" alt="" class="logo__icon" aria-hidden="true" width="42" height="42">
      <span class="logo__text">D<span class="logo__apostrophe">&#8217;</span>COLITAS</span>
    </a>

    <button class="nav__toggle" id="navToggle" aria-label="Abrir menú" aria-expanded="false" aria-controls="navMenu">
      <span class="nav__toggle-bar"></span>
      <span class="nav__toggle-bar"></span>
      <span class="nav__toggle-bar"></span>
    </button>

    <ul class="nav__links" id="navMenu" role="list">
      <li><a href="<?php echo esc_url( $dcv_home ); ?>#servicios" class="nav__link">Servicios</a></li>
      <li><a href="<?php echo esc_url( $dcv_home ); ?>#equipo" class="nav__link">Equipo</a></li>
      <li><a href="<?php echo esc_url( $dcv_home ); ?>#nosotros" class="nav__link">Nosotros</a></li>
      <li><a href="<?php echo esc_url( $dcv_home ); ?>#ubicacion" class="nav__link">Ubicación</a></li>
      <li><a href="<?php echo esc_url( $dcv_home ); ?>#galeria" class="nav__link">Galería</a></li>
      <li><a href="<?php echo esc_url( $dcv_home ); ?>#testimonios" class="nav__link">Testimonios</a></li>
      <li><a href="<?php echo esc_url( $dcv_home ); ?>#contacto" class="nav__link nav__link--cta">Agendar cita</a></li>
    </ul>
  </nav>
