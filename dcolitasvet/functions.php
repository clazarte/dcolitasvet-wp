<?php
/**
 * functions.php — D'Colitas Vet
 *
 * Carga los estilos/scripts del sitio y los módulos del tema:
 *   inc/defaults.php     Contenido por defecto (textos, imágenes, datos del negocio)
 *   inc/helpers.php      Funciones de ayuda para las plantillas
 *   inc/post-types.php   Servicios, Equipo y Testimonios (editables desde el panel)
 *   inc/meta-boxes.php   Campos extra de cada tipo de contenido
 *   inc/customizer.php   Apariencia → Personalizar: datos del negocio, portada, galería…
 *   inc/seed.php         Crea el contenido inicial al activar el tema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DCV_VERSION', '1.0.1' );
define( 'DCV_DIR', get_template_directory() );
define( 'DCV_URI', get_template_directory_uri() );

require DCV_DIR . '/inc/defaults.php';
require DCV_DIR . '/inc/helpers.php';
require DCV_DIR . '/inc/post-types.php';
require DCV_DIR . '/inc/meta-boxes.php';
require DCV_DIR . '/inc/customizer.php';
require DCV_DIR . '/inc/seed.php';

/* ── Soporte del tema ── */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'script', 'style', 'gallery', 'caption' ) );
	add_image_size( 'dcv-staff', 640, 800, true );
	add_image_size( 'dcv-gallery', 800, 480, true );
} );

/* ── Estilos y scripts ── */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'dcv-fonts',
		'https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Work+Sans:wght@300;400;500;600;700&display=swap',
		array(),
		null
	);

	$prev = array( 'dcv-fonts' );
	foreach ( array( 'reset', 'variables', 'base', 'layout', 'components', 'sections', 'animations', 'responsive' ) as $sheet ) {
		wp_enqueue_style( 'dcv-' . $sheet, DCV_URI . '/assets/css/' . $sheet . '.css', $prev, DCV_VERSION );
		$prev = array( 'dcv-' . $sheet );
	}

	foreach ( array( 'wa-links', 'navbar', 'form', 'scroll', 'staff' ) as $script ) {
		wp_enqueue_script( 'dcv-' . $script, DCV_URI . '/assets/js/' . $script . '.js', array(), DCV_VERSION, true );
	}

	/* Reemplaza a js/config.js: los datos salen de Apariencia → Personalizar */
	$config = array(
		'business' => array(
			'name'         => "D'Colitas Vet",
			'address'      => dcv_address(),
			'phoneDisplay' => dcv_mod( 'phone_display' ),
			'schedule'     => dcv_mod( 'schedule' ),
			'instagram'    => dcv_mod( 'instagram_user' ),
			'instagramUrl' => dcv_mod( 'instagram_url' ),
		),
		'whatsapp' => array(
			'phone'          => dcv_whatsapp_number(),
			'defaultMessage' => dcv_mod( 'whatsapp_message' ),
		),
		'form'     => array( 'provider' => 'whatsapp' ),
	);
	wp_add_inline_script( 'dcv-wa-links', 'window.SITE_CONFIG = ' . wp_json_encode( $config ) . ';', 'before' );
} );

/* La barra de administración de WordPress no debe tapar el menú fijo */
add_action( 'wp_head', function () {
	if ( ! is_admin_bar_showing() ) {
		return;
	}
	echo '<style>.admin-bar .navbar{top:32px}@media screen and (max-width:782px){.admin-bar .navbar{top:46px}}@media screen and (max-width:600px){.admin-bar .navbar{top:0}}</style>' . "\n";
} );
