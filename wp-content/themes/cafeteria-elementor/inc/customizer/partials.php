<?php
/**
 * Customizer partials.
 *
 * @package cafeteria_elementor
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function cafeteria_elementor_customize_partial_blogname() {

	bloginfo( 'name' );

}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function cafeteria_elementor_customize_partial_blogdescription() {

	bloginfo( 'description' );

}

/**
 * Partial for copyright text.
 *
 * @since 1.0.0
 *
 * @return void
 */
function cafeteria_elementor_render_partial_copyright_text() {

	$cafeteria_elementor_copyright_text = cafeteria_elementor_get_option( 'cafeteria_elementor_copyright_text' );
	$cafeteria_elementor_copyright_text = apply_filters( 'cafeteria_elementor_filter_copyright_text', $cafeteria_elementor_copyright_text );
	if ( ! empty( $cafeteria_elementor_copyright_text ) ) {
		$cafeteria_elementor_copyright_text = wp_kses_data( $cafeteria_elementor_copyright_text );
	}
	echo $cafeteria_elementor_copyright_text;

}
