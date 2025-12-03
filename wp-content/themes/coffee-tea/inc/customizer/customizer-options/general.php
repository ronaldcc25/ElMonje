<?php
function coffee_tea_general_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'coffee_tea_general', array(
			'priority' => 2,
			'title' => esc_html__( 'General Options', 'coffee-tea' ),
		)
	);

	/*=========================================
	Breadcrumb  Section
	=========================================*/
	$wp_customize->add_section(
		'coffee_tea_breadcrumb_setting', array(
			'title' => esc_html__( 'Breadcrumb Options', 'coffee-tea' ),
			'priority' => 1,
			'panel' => 'coffee_tea_general',
		)
	);
	
	// Settings 
	$wp_customize->add_setting(
		'coffee_tea_breadcrumb_settings'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'coffee_tea_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'coffee_tea_breadcrumb_settings',
		array(
			'type' => 'hidden',
			'label' => __('Settings','coffee-tea'),
			'section' => 'coffee_tea_breadcrumb_setting',
		)
	);
	
	// Breadcrumb Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_hs_breadcrumb' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_hs_breadcrumb', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'coffee-tea' ),
			'section'     => 'coffee_tea_breadcrumb_setting',
			'settings'    => 'coffee_tea_hs_breadcrumb',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting(
    	'coffee_tea_breadcrumb_seprator',
    	array(
			'default' => '/',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'coffee_tea_breadcrumb_seprator',
		array(
		    'label'   		=> __('Breadcrumb separator','coffee-tea'),
		    'section'		=> 'coffee_tea_breadcrumb_setting',
			'type' 			=> 'text',
		)  
	);

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_5',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
        $wp_customize, 'coffee_tea_upgrade_page_settings_5',
            array(
                'priority'      => 200,
                'section'       => 'coffee_tea_breadcrumb_setting',
                'settings'      => 'coffee_tea_upgrade_page_settings_5',
                'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
            )
        )
    ); 

	/*=========================================
	Preloader Section
	=========================================*/
	$wp_customize->add_section(
		'coffee_tea_preloader_section_setting', array(
			'title' => esc_html__( 'Preloader Options', 'coffee-tea' ),
			'priority' => 3,
			'panel' => 'coffee_tea_general',
		)
	);

	// Preloader Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_preloader_setting' , 
			array(
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_preloader_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Preloader', 'coffee-tea' ),
			'section'     => 'coffee_tea_preloader_section_setting',
			'settings'    => 'coffee_tea_preloader_setting',
			'type'        => 'checkbox'
		) 
	);

	
	$wp_customize->add_setting(
    	'coffee_tea_preloader_text',
    	array(
			'default' => 'Loading',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'coffee_tea_preloader_text',
		array(
		    'label'   		=> __('Preloader Text','coffee-tea'),
		    'section'		=> 'coffee_tea_preloader_section_setting',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)
	);

	// Preloader Background Color Setting
	$wp_customize->add_setting(
		'coffee_tea_preloader_bg_color',
		array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'coffee_tea_preloader_bg_color',
			array(
				'label' => esc_html__('Preloader Background Color', 'coffee-tea'),
				'section' => 'coffee_tea_preloader_section_setting', // Adjust section if needed
				'settings' => 'coffee_tea_preloader_bg_color',
			)
		)
	);

	// Preloader Color Setting
	$wp_customize->add_setting(
		'coffee_tea_preloader_color',
		array(
			'default' => '#38210f',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'coffee_tea_preloader_color',
			array(
				'label' => esc_html__('Preloader Color', 'coffee-tea'),
				'section' => 'coffee_tea_preloader_section_setting', // Adjust section if needed
				'settings' => 'coffee_tea_preloader_color',
			)
		)
	);

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_6',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
		$wp_customize, 'coffee_tea_upgrade_page_settings_6',
			array(
				'priority'      => 200,
				'section'       => 'coffee_tea_preloader_section_setting',
				'settings'      => 'coffee_tea_upgrade_page_settings_6',
				'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
			)
		)
	); 


	/*=========================================
	Scroll To Top Section
	=========================================*/
	$wp_customize->add_section(
		'coffee_tea_scroll_to_top_section_setting', array(
			'title' => esc_html__( 'Scroll To Top Options', 'coffee-tea' ),
			'priority' => 3,
			'panel' => 'coffee_tea_footer_section',
		)
	);

	// Scroll To Top Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_scroll_top_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_scroll_top_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Scroll To Top', 'coffee-tea' ),
			'section'     => 'coffee_tea_scroll_to_top_section_setting',
			'settings'    => 'coffee_tea_scroll_top_setting',
			'type'        => 'checkbox'
		) 
	);

	// Scroll To Top Color Setting
	$wp_customize->add_setting(
		'coffee_tea_scroll_top_color',
		array(
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'coffee_tea_scroll_top_color',
			array(
				'label'    => esc_html__( 'Scroll To Top Color', 'coffee-tea' ),
				'section'  => 'coffee_tea_scroll_to_top_section_setting',
				'settings' => 'coffee_tea_scroll_top_color',
			)
		)
	);

	// Scroll To Top Background Color Setting
	$wp_customize->add_setting(
		'coffee_tea_scroll_top_bg_color',
		array(
			'default'           => '#38210f',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'coffee_tea_scroll_top_bg_color',
			array(
				'label'    => esc_html__( 'Scroll To Top Background Color', 'coffee-tea' ),
				'section'  => 'coffee_tea_scroll_to_top_section_setting',
				'settings' => 'coffee_tea_scroll_top_bg_color',
			)
		)
	);

	 $wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_7',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
        $wp_customize, 'coffee_tea_upgrade_page_settings_7',
            array(
                'priority'      => 200,
                'section'       => 'coffee_tea_scroll_to_top_section_setting',
                'settings'      => 'coffee_tea_upgrade_page_settings_7',
                'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
            )
        )
    ); 


	/*=========================================
	Woocommerce Section
	=========================================*/
	$wp_customize->add_section(
		'coffee_tea_woocommerce_section_setting', array(
			'title' => esc_html__( 'Woocommerce Settings', 'coffee-tea' ),
			'priority' => 3,
			'panel' => 'woocommerce',
		)
	);

	$wp_customize->add_setting(
    	'coffee_tea_custom_shop_per_columns',
    	array(
			'default' => '3',
			'sanitize_callback' => 'absint',
		)
	);	
	$wp_customize->add_control( 
		'coffee_tea_custom_shop_per_columns',
		array(
		    'label'   		=> __('Product Per Columns','coffee-tea'),
		    'section'		=> 'coffee_tea_woocommerce_section_setting',
			'type' 			=> 'number',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'coffee_tea_custom_shop_product_per_page',
    	array(
			'default' => '9',
			'sanitize_callback' => 'absint',
		)
	);	
	$wp_customize->add_control( 
		'coffee_tea_custom_shop_product_per_page',
		array(
		    'label'   		=> __('Product Per Page','coffee-tea'),
		    'section'		=> 'coffee_tea_woocommerce_section_setting',
			'type' 			=> 'number',
			'transport'         => $selective_refresh,
		)  
	);

	// Woocommerce Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_wocommerce_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_wocommerce_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Woocommerce Sidebar', 'coffee-tea' ),
			'section'     => 'coffee_tea_woocommerce_section_setting',
			'settings'    => 'coffee_tea_wocommerce_sidebar_setting',
			'type'        => 'checkbox'
		)
	);

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_22',
	array(
		'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
		$wp_customize, 'coffee_tea_upgrade_page_settings_22',
			array(
				'priority'      => 200,
				'section'       => 'coffee_tea_woocommerce_section_setting',
				'settings'      => 'coffee_tea_upgrade_page_settings_22',
				'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
			)
		)
	); 

	/*=========================================
	Sticky Header Section
	=========================================*/
	$wp_customize->add_section(
		'sticky_header_section_setting', array(
			'title' => esc_html__( 'Sticky Header Options', 'coffee-tea' ),
			'priority' => 3,
			'panel' => 'coffee_tea_general',
		)
	);

	// Sticky Header Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_sticky_header' , 
			array(
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_sticky_header', 
		array(
			'label'	      => esc_html__( 'Hide / Show Sticky Header', 'coffee-tea' ),
			'section'     => 'sticky_header_section_setting',
			'settings'    => 'coffee_tea_sticky_header',
			'type'        => 'checkbox'
		) 
	);

	 $wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_9',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
        $wp_customize, 'coffee_tea_upgrade_page_settings_9',
            array(
                'priority'      => 200,
                'section'       => 'sticky_header_section_setting',
                'settings'      => 'coffee_tea_upgrade_page_settings_9',
                'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
            )
        )
    ); 

	/*=========================================
	404 Page Options
	=========================================*/
	$wp_customize->add_section(
		'coffee_tea_404_section', array(
			'title' => esc_html__( '404 Page Options', 'coffee-tea' ),
			'priority' => 1,
			'panel' => 'coffee_tea_general',
		)
	);

	$wp_customize->add_setting(
    	'coffee_tea_404_title',
    	array(
			'default' => '404',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 2,
		)
	);	
	$wp_customize->add_control( 
		'coffee_tea_404_title',
		array(
		    'label'   		=> __('404 Heading','coffee-tea'),
		    'section'		=> 'coffee_tea_404_section',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'coffee_tea_404_Text',
    	array(
			'default' => 'Page Not Found',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 2,
		)
	);	
	$wp_customize->add_control( 
		'coffee_tea_404_Text',
		array(
		    'label'   		=> __('404 Title','coffee-tea'),
		    'section'		=> 'coffee_tea_404_section',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'coffee_tea_404_content',
    	array(
			'default' => 'The page you were looking for could not be found.',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 2,
		)
	);	
	$wp_customize->add_control( 
		'coffee_tea_404_content',
		array(
		    'label'   		=> __('404 Content','coffee-tea'),
		    'section'		=> 'coffee_tea_404_section',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	 $wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_10',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
        $wp_customize, 'coffee_tea_upgrade_page_settings_10',
            array(
                'priority'      => 200,
                'section'       => 'coffee_tea_404_section',
                'settings'      => 'coffee_tea_upgrade_page_settings_10',
                'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
            )
        )
    ); 

}

add_action( 'customize_register', 'coffee_tea_general_setting' );