<?php

require get_template_directory() . '/inc/recommendations/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function cafeteria_elementor_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Mizan Demo Importor', 'cafeteria-elementor' ),
			'slug'             => 'mizan-demo-importer',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Elementor', 'cafeteria-elementor' ),
			'slug'             => 'elementor',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Prime Slider ', 'cafeteria-elementor' ),
			'slug'             => 'bdthemes-prime-slider-lite',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'WPTD Video Popup', 'cafeteria-elementor' ),
			'slug'             => 'wptd-video-popup',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	cafeteria_elementor_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'cafeteria_elementor_register_recommended_plugins' );