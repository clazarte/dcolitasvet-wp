<?php
/**
 * defaults.php — Contenido por defecto del tema
 *
 * dcv_defaults(): valores iniciales de Apariencia → Personalizar.
 * dcv_seed_content(): servicios, equipo y testimonios que se crean
 * al activar el tema (ver inc/seed.php).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dcv_defaults() {
	static $defaults = null;
	if ( null !== $defaults ) {
		return $defaults;
	}

	$img = DCV_URI . '/assets/images';

	$defaults = array(
		/* ── Datos del negocio ── */
		'address_line1'    => 'Av. San Juan 407',
		'address_line2'    => 'San Luis, Lima, Perú',
		'phone_display'    => '+51 912 865 712',
		'whatsapp_number'  => '51912865712',
		'whatsapp_message' => "Hola! Quiero agendar una cita en D'Colitas Vet 🐾",
		'schedule'         => 'Lunes a Domingo · 9:30am – 6pm',
		'instagram_user'   => '@dcolitasvet',
		'instagram_url'    => 'https://www.instagram.com/dcolitasvet',
		'facebook_url'     => 'https://www.facebook.com/p/Dcolitas-veterinaria-100064053004433/',
		'tiktok_url'       => 'https://www.tiktok.com/@dcolitasvet',

		/* ── Portada ── */
		'hero_badge'        => 'Clínica Veterinaria en Lima',
		'hero_title_1'      => 'Cuidamos a tus',
		'hero_title_accent' => 'peluditos',
		'hero_title_love'   => 'con amor',
		'hero_subtitle'     => "En D'Colitas Vet brindamos atención médica veterinaria de calidad para tus mascotas. Consultas, vacunas, peluquería y más — porque ellos se merecen lo mejor.",
		'hero_stat_1_num'   => '500+',
		'hero_stat_1_label' => 'Pacientes felices',
		'hero_stat_2_num'   => '5★',
		'hero_stat_2_label' => 'Valoración',
		'hero_stat_3_num'   => 'Lun–Dom',
		'hero_stat_3_label' => 'Atención semanal',
		'hero_img_main'     => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=700&q=80',
		'hero_img_second'   => 'https://images.unsplash.com/photo-1548802673-380ab8ebc7b7?w=400&q=80',

		/* ── Por qué elegirnos ── */
		'why_img'          => 'https://images.unsplash.com/photo-1628009368231-7bb7cfcb0def?w=700&q=80',
		'why_badge_num'    => '+5',
		'why_badge_text'   => "años de\nexperiencia",
		'why_1_icon'       => '🏆',
		'why_1_title'      => 'Equipo especializado',
		'why_1_desc'       => 'Médicos veterinarios colegiados con años de experiencia en pequeños animales, dedicados a su bienestar integral.',
		'why_2_icon'       => '💊',
		'why_2_title'      => 'Tecnología moderna',
		'why_2_desc'       => 'Equipos de diagnóstico actualizados para ofrecerte los mejores resultados y la mayor precisión en cada consulta.',
		'why_3_icon'       => '❤️',
		'why_3_title'      => 'Atención con amor',
		'why_3_desc'       => 'Cada mascota es tratada con paciencia y cariño. Entendemos que son parte de tu familia y los cuidamos así.',
		'why_4_icon'       => '💬',
		'why_4_title'      => 'Comunicación constante',
		'why_4_desc'       => 'Te mantenemos informado en cada paso del tratamiento. Disponibles por WhatsApp para resolver tus dudas.',
	);

	/* ── Galería (6 fotos) ── */
	$gallery_alts = array(
		'Perro blanco y negro en consulta',
		'Schnauzer negro en atención',
		'Chihuahua en consulta veterinaria',
		'Gato naranja siendo atendido',
		'Labrador dorado en clínica',
		'Bichón blanco esponjoso',
	);
	foreach ( $gallery_alts as $i => $alt ) {
		$n = $i + 1;
		$defaults[ 'gallery_' . $n . '_img' ] = sprintf( '%s/galeria/galeria-%02d.jpg', $img, $n );
		$defaults[ 'gallery_' . $n . '_alt' ] = $alt;
	}

	return $defaults;
}

function dcv_seed_content() {
	return array(
		'dcv_servicio'   => array(
			array( 'Consulta general', '🩺', 'Realizamos una evaluación integral de tu mascota y apoyados por nuestra experiencia en conjunto de exámenes auxiliares y de descarte encontraremos el mejor tratamiento y diagnóstico del paciente.' ),
			array( 'Oftalmología', '👁️', 'Tenemos el apoyo de los mejores especialistas en cada área, las evaluaciones oftalmológicas son muy exhaustivas, precisas y con una atención fear free.' ),
			array( 'Traumatología', '🦴', 'Diagnóstico y tratamiento de fracturas, luxaciones y lesiones músculo-esqueléticas. Recuperación segura y efectiva para tu compañero.' ),
			array( 'Cirugías', '🏥', 'Procedimientos quirúrgicos con equipos modernos y total seguridad. Esterilizaciones, castraciones y cirugías de tejidos blandos.' ),
			array( 'Salud dental', '🦷', 'Profilaxis dental, exodoncias y profilaxis dental en animales gerontes. Mantenemos la salud bucal de tu mascota con técnicas profesionales.' ),
			array( 'Tratamientos', '💊', 'Planes de tratamiento personalizados para enfermedades agudas y crónicas. Seguimiento continuo para una recuperación óptima.' ),
			array( 'Ecografía', '🔊', 'Imágenes de alta resolución para evaluar órganos internos sin procedimientos invasivos. Diagnóstico rápido y preciso.' ),
			array( 'Radiografía', '🩻', 'Evaluación ósea y de tejidos mediante rayos X digitales. Indispensable para detectar fracturas, tumores y alteraciones internas.' ),
			array( 'Laboratorio', '🔬', 'Análisis de sangre, orina y más exámenes para un diagnóstico rápido y certero. Resultados confiables en poco tiempo.' ),
			array( 'Vacunaciones', '💉', 'Plan de vacunación completo y actualizado para perros y gatos. Protección contra las enfermedades virales potencialmente peligrosas en cachorros y animales gerontes.' ),
			array( 'Internamientos', '🛏️', 'Hospitalización con monitoreo continuo las 24 horas. Tu mascota recibe los cuidados intensivos que necesita en un ambiente seguro.' ),
		),
		'dcv_miembro'    => array(
			array( 'Dra. Gabriela Ugarte', 'Médico Veterinario', "Médico veterinario zootecnista\nEspecialidad en neonatología\nEspecialidad en medicina felina", 'dra-ugarte.jpeg' ),
			array( 'Dr. Henry Huamán', 'Médico Veterinario', "Médico veterinario zootecnista\nMedicina Clínica\nEspecialidad en cirugías de tejidos blandos\nEspecialidad en Ecografía", 'dr-huaman.jpeg' ),
		),
		'dcv_testimonio' => array(
			array( 'Kelly Renquifo', '🐶 Mamá de Mophy y Loky', 'Conocí al Dr. Henry, Dra. Gaby y Dra. Rossy por recomendación y desde la primera consulta quedé impresionada. La atención hacia mis poodles fue excelente, muy profesional y con mucho cariño. Se nota el amor genuino que tienen por lo que hacen. Además, admiro el compromiso del equipo con los animales abandonados. ¡Súper recomendado!' ),
			array( 'Lilian Vasquez', '🐶 Mamá de Pepa', 'Esterilizaron a mi perrita Pepa en esta veterinaria y me siento muy satisfecha con la atención y la cirugía. El equipo fue muy profesional y cuidadoso. Actualmente se encuentra bien y su recuperación fue excelente. ¡Totalmente recomendado!' ),
			array( 'Ana Varillas', '🐶 Mamá de Cookie y Charlie', "Llevo un año atendiendo en la Veterinaria D'Colitas y les doy baños a mis perritos Cookie y Charlie. El Dr. Henry y la Dra. Gaby son profesionales excelentes con un trato excepcional. Se nota la calidad en cada servicio que ofrecen. ¡Los recomiendo al 100%!" ),
		),
	);
}
