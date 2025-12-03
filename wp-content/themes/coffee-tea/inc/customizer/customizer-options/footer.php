<?php

function coffee_tea_footer( $wp_customize ) {
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Panel // 
	$wp_customize->add_panel( 
		'coffee_tea_footer_section', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer Options', 'coffee-tea'),
		) 
	);

	// Footer Widgets // 
	$wp_customize->add_section(
        'coffee_tea_footer_top',
        array(
            'title' 		=> __('Footer Widgets','coffee-tea'),
			'panel'  		=> 'coffee_tea_footer_section',
			'priority'      => 3,
		)
    );

    // Footer Widgets Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_footer_widgets_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_footer_widgets_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Footer Widgets', 'coffee-tea' ),
			'section'     => 'coffee_tea_footer_top',
			'settings'    => 'coffee_tea_footer_widgets_setting',
			'type'        => 'checkbox'
		) 
	);

	// Footer Background Image Setting
	$wp_customize->add_setting('coffee_tea_footer_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'coffee_tea_footer_bg_image',array(
	'label' => __('Footer Background Image','coffee-tea'),
	'section' => 'coffee_tea_footer_top'
	)));

	// Footer Background Image Opacity
	$wp_customize->add_setting('coffee_tea_footer_bg_image_opacity', array(
		'default'           => 50,
		'sanitize_callback' => 'absint',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control('coffee_tea_footer_bg_image_opacity', array(
		'label'    => __('Footer Background Image Opacity (%)', 'coffee-tea'),
		'section'  => 'coffee_tea_footer_top',
		'type'     => 'range',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
	));

	// Footer Background Color Setting
    $wp_customize->add_setting('coffee_tea_footer_bg_color',array(
		'default' => '#484544',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'coffee_tea_footer_bg_color',array(
		'label' => esc_html__('Footer Background Color', 'coffee-tea'),
		'section' => 'coffee_tea_footer_top', // Adjust section if needed
		'settings' => 'coffee_tea_footer_bg_color',
	)));

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_33',
	array(
		'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
		$wp_customize, 'coffee_tea_upgrade_page_settings_33',
			array(
				'priority'      => 200,
				'section'       => 'coffee_tea_footer_top',
				'settings'      => 'coffee_tea_upgrade_page_settings_33',
				'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
			)
		)
	); 

	// Footer Bottom // 
	$wp_customize->add_section(
        'coffee_tea_footer_bottom',
        array(
            'title' 		=> __('Footer Bottom','coffee-tea'),
			'panel'  		=> 'coffee_tea_footer_section',
			'priority'      => 3,
		)
    );

	// Site Title Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_footer_copyright_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_footer_copyright_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Footer Copytight', 'coffee-tea' ),
			'section'     => 'coffee_tea_footer_bottom',
			'settings'    => 'coffee_tea_footer_copyright_setting',
			'type'        => 'checkbox'
		) 
	);
	
	// Footer Copyright 
	$wp_customize->add_setting(
    	'coffee_tea_footer_copyright',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 4,
		)
	);

	$wp_customize->add_control( 
		'coffee_tea_footer_copyright',
		array(
		    'label'   		=> __('Edit Copyright Text','coffee-tea'),
		    'section'		=> 'coffee_tea_footer_bottom',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting( 'coffee_tea_copyright_alignment', array(
        'default'   => 'center',
        'sanitize_callback' => 'coffee_tea_sanitize_copyright_position',
    ));

    $wp_customize->add_control( 'coffee_tea_copyright_alignment', array(
        'label'    => __( 'Copyright Position', 'coffee-tea' ),
        'section'  => 'coffee_tea_footer_bottom',
        'settings' => 'coffee_tea_copyright_alignment',
        'type'     => 'radio',
        'choices'  => array(
            'right' => __( 'Right Align', 'coffee-tea' ),
            'left'  => __( 'Left Align', 'coffee-tea' ),
            'center'  => __( 'Center Align', 'coffee-tea' ),
        ),
    ));

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_122',
	array(
		'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
		$wp_customize, 'coffee_tea_upgrade_page_settings_122',
			array(
				'priority'      => 200,
				'section'       => 'coffee_tea_footer_bottom',
				'settings'      => 'coffee_tea_upgrade_page_settings_122',
				'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
			)
		)
	); 
}
add_action( 'customize_register', 'coffee_tea_footer' );

// Footer selective refresh
function coffee_tea_footer_partials( $wp_customize ){
	// footer_copyright
	$wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
		'selector'            => '.copy-right .copyright-text',
		'settings'            => 'footer_copyright',
		'render_callback'  => 'coffee_tea_footer_copyright_render_callback',
	) );
}
add_action( 'customize_register', 'coffee_tea_footer_partials' );

// copyright_content
function coffee_tea_footer_copyright_render_callback() {
	return get_theme_mod( 'footer_copyright' );
}