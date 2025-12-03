<?php
function coffee_tea_typography_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'coffee_tea_typography', array(
			'priority' => 31,
			'title' => esc_html__( 'Typography Options', 'coffee-tea' ),
		)
	);

	/*=========================================
	Typography Option  Section
	=========================================*/
	$wp_customize->add_section(
		'coffee_tea_typography_settings', array(
			'title' => esc_html__( 'Heading/Content Typography Options', 'coffee-tea' ),
			'priority' => 1,
			'panel' => 'coffee_tea_typography',
		)
	);
	$coffee_tea_font_choices = array(
		'' => 'Select',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'coffee_tea_headings_text', array(
		'sanitize_callback' => 'coffee_tea_sanitize_fonts',
	));

	$wp_customize->add_control( 'coffee_tea_headings_text', array(
		'type' => 'select',
		'description' => __('Select your appropriate font for the headings.', 'coffee-tea'),
		'section' => 'coffee_tea_typography_settings',
		'choices' => $coffee_tea_font_choices

	));

	$wp_customize->add_setting( 'coffee_tea_body_text', array(
		'sanitize_callback' => 'coffee_tea_sanitize_fonts'
	));

	$wp_customize->add_control( 'coffee_tea_body_text', array(
		'type' => 'select',
		'description' => __( 'Select your appropriate font for the body.', 'coffee-tea' ),
		'section' => 'coffee_tea_typography_settings',
		'choices' => $coffee_tea_font_choices
	) );
	
	$wp_customize->add_section(
	'coffee_tea_dynamic_color_settings', array(
		'title' => esc_html__( 'Dynamic Color Options', 'coffee-tea' ),
		'priority' => 1,
		'panel' => 'coffee_tea_typography',
		)
	);

	$wp_customize->add_setting('coffee_tea_dynamic_color_one', array(
        'default'           => '#38210f',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'coffee_tea_dynamic_color_one', array(
        'label'    => __('First Dynamic Color', 'coffee-tea'),
        'section'  => 'coffee_tea_dynamic_color_settings',
    )));

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_20_color',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
        $wp_customize, 'coffee_tea_upgrade_page_settings_20_color',
            array(
                'priority'      => 200,
                'section'       => 'coffee_tea_dynamic_color_settings',
                'settings'      => 'coffee_tea_upgrade_page_settings_20_color',
                'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
            )
        )
    ); 

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_20',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
        $wp_customize, 'coffee_tea_upgrade_page_settings_20',
            array(
                'priority'      => 200,
                'section'       => 'coffee_tea_typography_settings',
                'settings'      => 'coffee_tea_upgrade_page_settings_20',
                'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
            )
        )
    ); 
}

add_action( 'customize_register', 'coffee_tea_typography_setting' );