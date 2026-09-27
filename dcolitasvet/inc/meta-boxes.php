<?php
/**
 * meta-boxes.php — Campos extra de Servicios, Equipo y Testimonios
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Definición de campos por tipo de contenido.
 * type: text | textarea | select
 */
function dcv_meta_fields() {
	return array(
		'dcv_servicio'   => array(
			'title'  => 'Datos del servicio',
			'fields' => array(
				'_dcv_icono'       => array(
					'label' => 'Ícono (emoji)',
					'type'  => 'text',
					'help'  => 'Un emoji, por ejemplo 🩺 💉 🦷. En Windows: tecla Windows + punto.',
					'size'  => 'small',
				),
				'_dcv_descripcion' => array(
					'label' => 'Descripción',
					'type'  => 'textarea',
					'help'  => 'Texto corto que aparece en la tarjeta del servicio. El servicio también aparece automáticamente en el formulario de citas.',
				),
			),
		),
		'dcv_miembro'    => array(
			'title'  => 'Datos del profesional',
			'fields' => array(
				'_dcv_cargo' => array(
					'label' => 'Cargo',
					'type'  => 'text',
					'help'  => 'Ej. Médico Veterinario.',
				),
				'_dcv_bio'   => array(
					'label' => 'Formación y experiencia',
					'type'  => 'textarea',
					'help'  => 'Una línea por punto. Se muestra al pulsar "Ver más". La foto se elige en el recuadro "Foto" (vertical, idealmente 640 × 800 px).',
				),
			),
		),
		'dcv_testimonio' => array(
			'title'  => 'Datos del testimonio',
			'fields' => array(
				'_dcv_texto'     => array(
					'label' => 'Testimonio',
					'type'  => 'textarea',
					'help'  => 'Escríbelo sin comillas; la página las agrega sola.',
				),
				'_dcv_mascota'   => array(
					'label' => 'Línea de la mascota',
					'type'  => 'text',
					'help'  => 'Ej. 🐶 Mamá de Pepa · 🐱 Papá de Luna.',
				),
				'_dcv_estrellas' => array(
					'label'   => 'Estrellas',
					'type'    => 'select',
					'options' => array( '5' => '★★★★★', '4' => '★★★★', '3' => '★★★', '2' => '★★', '1' => '★' ),
				),
			),
		),
	);
}

add_action( 'add_meta_boxes', function () {
	foreach ( dcv_meta_fields() as $post_type => $box ) {
		add_meta_box( 'dcv_fields', $box['title'], 'dcv_render_meta_box', $post_type, 'normal', 'high' );
	}
} );

function dcv_render_meta_box( $post ) {
	$config = dcv_meta_fields();
	$fields = $config[ $post->post_type ]['fields'];
	wp_nonce_field( 'dcv_save_meta', 'dcv_meta_nonce' );

	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( $fields as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		$id    = esc_attr( ltrim( $key, '_' ) );
		echo '<tr><th scope="row"><label for="' . $id . '">' . esc_html( $field['label'] ) . '</label></th><td>';

		switch ( $field['type'] ) {
			case 'textarea':
				echo '<textarea id="' . $id . '" name="' . esc_attr( $key ) . '" rows="5" class="large-text">' . esc_textarea( $value ) . '</textarea>';
				break;
			case 'select':
				echo '<select id="' . $id . '" name="' . esc_attr( $key ) . '">';
				foreach ( $field['options'] as $opt_value => $opt_label ) {
					echo '<option value="' . esc_attr( $opt_value ) . '"' . selected( $value ? $value : '5', (string) $opt_value, false ) . '>' . esc_html( $opt_label ) . '</option>';
				}
				echo '</select>';
				break;
			default:
				$class = ( isset( $field['size'] ) && 'small' === $field['size'] ) ? 'small-text' : 'regular-text';
				echo '<input type="text" id="' . $id . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" class="' . $class . '">';
		}

		if ( ! empty( $field['help'] ) ) {
			echo '<p class="description">' . esc_html( $field['help'] ) . '</p>';
		}
		echo '</td></tr>';
	}
	echo '</tbody></table>';
}

add_action( 'save_post', function ( $post_id, $post ) {
	$config = dcv_meta_fields();
	if ( ! isset( $config[ $post->post_type ] ) ) {
		return;
	}
	if ( ! isset( $_POST['dcv_meta_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['dcv_meta_nonce'] ), 'dcv_save_meta' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( $config[ $post->post_type ]['fields'] as $key => $field ) {
		if ( ! isset( $_POST[ $key ] ) ) {
			continue;
		}
		$raw   = wp_unslash( $_POST[ $key ] );
		$value = 'textarea' === $field['type'] ? sanitize_textarea_field( $raw ) : sanitize_text_field( $raw );
		if ( '_dcv_texto' === $key ) {
			$value = trim( $value, " \t\n\r\"“”" );
		}
		if ( '_dcv_estrellas' === $key ) {
			$value = (string) max( 1, min( 5, (int) $value ) );
		}
		update_post_meta( $post_id, $key, $value );
	}
}, 10, 2 );
