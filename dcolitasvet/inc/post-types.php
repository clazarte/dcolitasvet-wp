<?php
/**
 * post-types.php — Servicios, Equipo y Testimonios
 *
 * Cada uno aparece como un menú propio en el panel de WordPress.
 * El campo "Orden" (Atributos) define la posición en la página.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function () {
	$common = array(
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => false,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'rewrite'             => false,
		'hierarchical'        => false,
	);

	register_post_type(
		'dcv_servicio',
		array_merge(
			$common,
			array(
				'labels'        => dcv_labels( 'Servicios', 'Servicio', 'o' ),
				'menu_icon'     => 'dashicons-heart',
				'menu_position' => 20,
				'supports'      => array( 'title', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'dcv_miembro',
		array_merge(
			$common,
			array(
				'labels'        => dcv_labels( 'Equipo', 'Miembro del equipo', 'o' ),
				'menu_icon'     => 'dashicons-groups',
				'menu_position' => 21,
				'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
			)
		)
	);

	register_post_type(
		'dcv_testimonio',
		array_merge(
			$common,
			array(
				'labels'        => dcv_labels( 'Testimonios', 'Testimonio', 'o' ),
				'menu_icon'     => 'dashicons-format-quote',
				'menu_position' => 22,
				'supports'      => array( 'title', 'page-attributes' ),
			)
		)
	);
} );

function dcv_labels( $plural, $singular, $gender = 'o' ) {
	$new = 'o' === $gender ? 'Nuevo' : 'Nueva';
	return array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'menu_name'          => $plural,
		'add_new'            => 'Añadir ' . strtolower( $singular ),
		'add_new_item'       => 'Añadir ' . strtolower( $singular ),
		'edit_item'          => 'Editar ' . strtolower( $singular ),
		'new_item'           => $new . ' ' . strtolower( $singular ),
		'view_item'          => 'Ver ' . strtolower( $singular ),
		'search_items'       => 'Buscar ' . strtolower( $plural ),
		'not_found'          => 'No hay ' . strtolower( $plural ) . ' todavía.',
		'not_found_in_trash' => 'No hay ' . strtolower( $plural ) . ' en la papelera.',
		'all_items'          => 'Todos',
		'featured_image'     => 'Foto',
		'set_featured_image' => 'Elegir foto',
		'remove_featured_image' => 'Quitar foto',
		'use_featured_image' => 'Usar como foto',
	);
}

/* Texto de ayuda en el campo del título */
add_filter( 'enter_title_here', function ( $text, $post ) {
	$placeholders = array(
		'dcv_servicio'   => 'Nombre del servicio (ej. Consulta general)',
		'dcv_miembro'    => 'Nombre (ej. Dra. Ugarte)',
		'dcv_testimonio' => 'Nombre del cliente (ej. Kelly Renquifo)',
	);
	return isset( $placeholders[ $post->post_type ] ) ? $placeholders[ $post->post_type ] : $text;
}, 10, 2 );

/* Ordenar las listas del panel igual que en la página */
add_action( 'pre_get_posts', function ( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( in_array( $query->get( 'post_type' ), array( 'dcv_servicio', 'dcv_miembro', 'dcv_testimonio' ), true ) && ! $query->get( 'orderby' ) ) {
		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'date' => 'ASC' ) );
	}
} );

/* Columnas útiles en las listas del panel */
foreach ( array( 'dcv_servicio', 'dcv_miembro', 'dcv_testimonio' ) as $dcv_pt ) {
	add_filter( "manage_{$dcv_pt}_posts_columns", function ( $columns ) {
		$new = array();
		foreach ( $columns as $key => $label ) {
			if ( 'date' === $key ) {
				continue;
			}
			$new[ $key ] = $label;
			if ( 'title' === $key ) {
				$new['dcv_detalle'] = 'Detalle';
				$new['dcv_orden']   = 'Orden';
			}
		}
		return $new;
	} );

	add_action( "manage_{$dcv_pt}_posts_custom_column", function ( $column, $post_id ) {
		if ( 'dcv_orden' === $column ) {
			echo (int) get_post_field( 'menu_order', $post_id );
			return;
		}
		if ( 'dcv_detalle' !== $column ) {
			return;
		}
		switch ( get_post_type( $post_id ) ) {
			case 'dcv_servicio':
				echo esc_html( get_post_meta( $post_id, '_dcv_icono', true ) . ' ' . wp_trim_words( get_post_meta( $post_id, '_dcv_descripcion', true ), 14 ) );
				break;
			case 'dcv_miembro':
				echo '<img src="' . esc_url( dcv_staff_photo_url( $post_id ) ) . '" alt="" style="width:40px;height:50px;object-fit:cover;border-radius:6px;vertical-align:middle;margin-right:8px">';
				echo esc_html( get_post_meta( $post_id, '_dcv_cargo', true ) );
				break;
			case 'dcv_testimonio':
				echo esc_html( get_post_meta( $post_id, '_dcv_mascota', true ) . ' — ' . wp_trim_words( get_post_meta( $post_id, '_dcv_texto', true ), 12 ) );
				break;
		}
	}, 10, 2 );
}
unset( $dcv_pt );
