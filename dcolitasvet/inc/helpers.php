<?php
/**
 * helpers.php — Funciones de ayuda para las plantillas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Valor de Apariencia → Personalizar. Si nunca se guardó, usa el valor por
 * defecto; si se guardó vacío (ej. enlace de TikTok), respeta el vacío.
 * Las fotos nunca quedan vacías: vuelven a la imagen por defecto.
 */
function dcv_mod( $key ) {
	$defaults = dcv_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	$value    = get_theme_mod( 'dcv_' . $key, $default );
	$is_image = false !== strpos( $key, '_img' );
	return ( null === $value || ( $is_image && '' === $value ) ) ? $default : $value;
}

/** Dirección completa en una línea. */
function dcv_address() {
	return trim( dcv_mod( 'address_line1' ) . ', ' . dcv_mod( 'address_line2' ), ', ' );
}

/** Número de WhatsApp solo con dígitos (código de país incluido). */
function dcv_whatsapp_number() {
	return preg_replace( '/\D+/', '', dcv_mod( 'whatsapp_number' ) );
}

function dcv_maps_query() {
	return rawurlencode( dcv_address() );
}

/** Consulta ordenada de un tipo de contenido del tema. */
function dcv_query( $post_type ) {
	return new WP_Query(
		array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
			'no_found_rows'  => true,
		)
	);
}

/** Texto multilínea → líneas no vacías. */
function dcv_lines( $text ) {
	return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $text ) ) ) );
}

/** Foto de un miembro del equipo: imagen destacada o, si no hay, la foto incluida en el tema. */
function dcv_staff_photo_url( $post_id ) {
	$url = get_the_post_thumbnail_url( $post_id, 'dcv-staff' );
	if ( $url ) {
		return $url;
	}
	$file = get_post_meta( $post_id, '_dcv_foto_tema', true );
	if ( $file && file_exists( DCV_DIR . '/assets/images/staff/' . $file ) ) {
		return DCV_URI . '/assets/images/staff/' . $file;
	}
	return DCV_URI . '/assets/images/isotipo.png';
}

/** Íconos de redes sociales del footer. */
function dcv_social_links() {
	return array(
		'facebook'  => array(
			'label' => 'Facebook',
			'url'   => dcv_mod( 'facebook_url' ),
			'svg'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12.06C22 6.505 17.523 2 12 2S2 6.505 2 12.06c0 5.02 3.657 9.184 8.438 9.94v-7.03H7.898v-2.91h2.54V9.845c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562v1.878h2.773l-.443 2.91h-2.33V22c4.78-.756 8.437-4.92 8.437-9.94z"/></svg>',
		),
		'instagram' => array(
			'label' => 'Instagram',
			'url'   => dcv_mod( 'instagram_url' ),
			'svg'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>',
		),
		'tiktok'    => array(
			'label' => 'TikTok',
			'url'   => dcv_mod( 'tiktok_url' ),
			'svg'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5.8 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.84-.1z"/></svg>',
		),
	);
}
