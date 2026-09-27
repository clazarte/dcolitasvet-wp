<?php
/**
 * customizer.php — Apariencia → Personalizar → D'Colitas Vet
 *
 * Secciones: Datos del negocio, Portada, Por qué elegirnos y Galería.
 * Cada campo se guarda como theme_mod "dcv_<clave>" (ver dcv_mod()).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ) {
	$defaults = dcv_defaults();

	$wp_customize->add_panel(
		'dcv_panel',
		array(
			'title'       => "D'Colitas Vet",
			'description' => 'Textos, imágenes y datos de contacto de la página. Servicios, Equipo y Testimonios se editan en sus propios menús del panel.',
			'priority'    => 20,
		)
	);

	/**
	 * Registra un campo.
	 * $type: text | textarea | url | image
	 */
	$add = function ( $section, $key, $label, $type = 'text', $description = '' ) use ( $wp_customize, $defaults ) {
		$sanitize = array(
			'text'     => 'sanitize_text_field',
			'textarea' => 'sanitize_textarea_field',
			'url'      => 'esc_url_raw',
			'image'    => 'esc_url_raw',
		);
		$wp_customize->add_setting(
			'dcv_' . $key,
			array(
				'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
				'sanitize_callback' => $sanitize[ $type ],
			)
		);

		$args = array(
			'label'       => $label,
			'description' => $description,
			'section'     => $section,
		);
		if ( 'image' === $type ) {
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'dcv_' . $key, $args ) );
		} else {
			$args['type'] = $type;
			$wp_customize->add_control( 'dcv_' . $key, $args );
		}
	};

	/* ── Datos del negocio ── */
	$wp_customize->add_section(
		'dcv_negocio',
		array(
			'title'       => 'Datos del negocio',
			'panel'       => 'dcv_panel',
			'description' => 'Se actualizan en toda la página: contacto, ubicación, mapa, botones de WhatsApp y footer.',
		)
	);
	$add( 'dcv_negocio', 'address_line1', 'Dirección (calle y número)' );
	$add( 'dcv_negocio', 'address_line2', 'Dirección (distrito, ciudad, país)', 'text', 'El mapa y los botones de Google Maps y Waze usan esta dirección.' );
	$add( 'dcv_negocio', 'phone_display', 'Teléfono (como se muestra)', 'text', 'Ej. +51 912 865 712' );
	$add( 'dcv_negocio', 'whatsapp_number', 'Número de WhatsApp', 'text', 'Con código de país, sin + ni espacios. Ej. 51912865712' );
	$add( 'dcv_negocio', 'whatsapp_message', 'Mensaje inicial de WhatsApp', 'textarea', 'Texto que aparece al pulsar el botón flotante de WhatsApp.' );
	$add( 'dcv_negocio', 'schedule', 'Horario de atención' );
	$add( 'dcv_negocio', 'instagram_user', 'Usuario de Instagram', 'text', 'Ej. @dcolitasvet' );
	$add( 'dcv_negocio', 'instagram_url', 'Enlace de Instagram', 'url' );
	$add( 'dcv_negocio', 'facebook_url', 'Enlace de Facebook', 'url', 'Déjalo vacío para ocultar el ícono.' );
	$add( 'dcv_negocio', 'tiktok_url', 'Enlace de TikTok', 'url', 'Déjalo vacío para ocultar el ícono.' );

	/* ── Portada ── */
	$wp_customize->add_section(
		'dcv_portada',
		array(
			'title' => 'Portada',
			'panel' => 'dcv_panel',
		)
	);
	$add( 'dcv_portada', 'hero_badge', 'Etiqueta superior' );
	$add( 'dcv_portada', 'hero_title_1', 'Título — primera línea' );
	$add( 'dcv_portada', 'hero_title_accent', 'Título — palabra destacada (naranja)' );
	$add( 'dcv_portada', 'hero_title_love', 'Título — última línea (verde)' );
	$add( 'dcv_portada', 'hero_subtitle', 'Subtítulo', 'textarea' );
	for ( $i = 1; $i <= 3; $i++ ) {
		$add( 'dcv_portada', "hero_stat_{$i}_num", "Dato {$i} — número" );
		$add( 'dcv_portada', "hero_stat_{$i}_label", "Dato {$i} — texto" );
	}
	$add( 'dcv_portada', 'hero_img_main', 'Foto principal', 'image', 'Vertical, idealmente 740 × 920 px.' );
	$add( 'dcv_portada', 'hero_img_second', 'Foto secundaria (círculo)', 'image', 'Cuadrada, idealmente 400 × 400 px.' );

	/* ── Por qué elegirnos ── */
	$wp_customize->add_section(
		'dcv_nosotros',
		array(
			'title' => 'Por qué elegirnos',
			'panel' => 'dcv_panel',
		)
	);
	$add( 'dcv_nosotros', 'why_img', 'Foto', 'image', 'Horizontal, idealmente 1200 × 1000 px.' );
	$add( 'dcv_nosotros', 'why_badge_num', 'Indicador — número', 'text', 'Ej. +5' );
	$add( 'dcv_nosotros', 'why_badge_text', 'Indicador — texto', 'textarea', 'Ej. años de experiencia (puedes usar dos líneas).' );
	for ( $i = 1; $i <= 4; $i++ ) {
		$add( 'dcv_nosotros', "why_{$i}_icon", "Punto {$i} — ícono (emoji)" );
		$add( 'dcv_nosotros', "why_{$i}_title", "Punto {$i} — título" );
		$add( 'dcv_nosotros', "why_{$i}_desc", "Punto {$i} — descripción", 'textarea' );
	}

	/* ── Galería ── */
	$wp_customize->add_section(
		'dcv_galeria',
		array(
			'title'       => 'Galería',
			'panel'       => 'dcv_panel',
			'description' => 'Seis fotos de pacientes. Tamaño ideal: 800 × 480 px (horizontal). Si subes otra medida, la página recorta los bordes automáticamente; deja a la mascota al centro.',
		)
	);
	for ( $i = 1; $i <= 6; $i++ ) {
		$add( 'dcv_galeria', "gallery_{$i}_img", "Foto {$i}", 'image' );
		$add( 'dcv_galeria', "gallery_{$i}_alt", "Foto {$i} — descripción breve", 'text', 'Para buscadores y lectores de pantalla. Ej. Gato naranja siendo atendido.' );
	}
} );
