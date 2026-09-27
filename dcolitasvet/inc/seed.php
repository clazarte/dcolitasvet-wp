<?php
/**
 * seed.php — Contenido inicial
 *
 * Al activar el tema por primera vez crea los servicios, el equipo y los
 * testimonios de la página original, para que el sitio se vea completo
 * desde el primer momento. No vuelve a crearlos si ya existen.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_switch_theme', 'dcv_seed' );

function dcv_seed() {
	if ( get_option( 'dcv_seeded' ) ) {
		return;
	}

	foreach ( dcv_seed_content() as $post_type => $items ) {
		$existing = get_posts(
			array(
				'post_type'      => $post_type,
				'post_status'    => 'any',
				'posts_per_page' => 1,
				'fields'         => 'ids',
			)
		);
		if ( $existing ) {
			continue;
		}

		foreach ( $items as $order => $item ) {
			$post_id = wp_insert_post(
				array(
					'post_type'   => $post_type,
					'post_status' => 'publish',
					'post_title'  => $item[0],
					'menu_order'  => $order + 1,
				)
			);
			if ( ! $post_id || is_wp_error( $post_id ) ) {
				continue;
			}

			switch ( $post_type ) {
				case 'dcv_servicio':
					update_post_meta( $post_id, '_dcv_icono', $item[1] );
					update_post_meta( $post_id, '_dcv_descripcion', $item[2] );
					break;
				case 'dcv_miembro':
					update_post_meta( $post_id, '_dcv_cargo', $item[1] );
					update_post_meta( $post_id, '_dcv_bio', $item[2] );
					update_post_meta( $post_id, '_dcv_foto_tema', $item[3] );
					break;
				case 'dcv_testimonio':
					update_post_meta( $post_id, '_dcv_mascota', $item[1] );
					update_post_meta( $post_id, '_dcv_texto', $item[2] );
					update_post_meta( $post_id, '_dcv_estrellas', '5' );
					break;
			}
		}
	}

	update_option( 'dcv_seeded', 1 );
}
