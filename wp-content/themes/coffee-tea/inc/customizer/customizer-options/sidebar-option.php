<?php
function coffee_tea_sidebar_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'coffee_tea_sidebar', array(
			'priority' => 31,
			'title' => esc_html__( 'Sidebar Options', 'coffee-tea' ),
		)
	);

	/*=========================================
	Sidebar Option  Section
	=========================================*/
	$wp_customize->add_section(
		'coffee_tea_sidebar_settings', array(
			'title' => esc_html__( 'Sidebar Options', 'coffee-tea' ),
			'priority' => 1,
			'panel' => 'coffee_tea_general',
		)
	);
	

	// Archive Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_archive_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_archive_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Archive Sidebar', 'coffee-tea' ),
			'section'     => 'coffee_tea_sidebar_settings',
			'settings'    => 'coffee_tea_archive_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Index Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_index_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_index_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Index Sidebar', 'coffee-tea' ),
			'section'     => 'coffee_tea_sidebar_settings',
			'settings'    => 'coffee_tea_index_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Pages Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_paged_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_paged_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Pages Sidebar', 'coffee-tea' ),
			'section'     => 'coffee_tea_sidebar_settings',
			'settings'    => 'coffee_tea_paged_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Search Result Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_search_result_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_search_result_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Search Result Sidebar', 'coffee-tea' ),
			'section'     => 'coffee_tea_sidebar_settings',
			'settings'    => 'coffee_tea_search_result_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Single Post Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_single_post_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_single_post_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Single Post Sidebar', 'coffee-tea' ),
			'section'     => 'coffee_tea_sidebar_settings',
			'settings'    => 'coffee_tea_single_post_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Sidebar Page Sidebar Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_single_page_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_single_page_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Page Width Sidebar', 'coffee-tea' ),
			'section'     => 'coffee_tea_sidebar_settings',
			'settings'    => 'coffee_tea_single_page_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting( 'coffee_tea_sidebar_position', array(
        'default'   => 'right',
        'sanitize_callback' => 'coffee_tea_sanitize_sidebar_position',
    ));

    $wp_customize->add_control( 'coffee_tea_sidebar_position', array(
        'label'    => __( 'Sidebar Position', 'coffee-tea' ),
        'section'  => 'coffee_tea_sidebar_settings',
        'settings' => 'coffee_tea_sidebar_position',
        'type'     => 'radio',
        'choices'  => array(
            'right' => __( 'Right Sidebar', 'coffee-tea' ),
            'left'  => __( 'Left Sidebar', 'coffee-tea' ),
        ),
    ));

	 $wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_15',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
        $wp_customize, 'coffee_tea_upgrade_page_settings_15',
            array(
                'priority'      => 200,
                'section'       => 'coffee_tea_sidebar_settings',
                'settings'      => 'coffee_tea_upgrade_page_settings_15',
                'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
            )
        )
    ); 
}

add_action( 'customize_register', 'coffee_tea_sidebar_setting' );