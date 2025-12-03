<?php
function coffee_tea_blog_setting( $wp_customize ) {

	$wp_customize->register_control_type( 'Coffee_Tea_Control_Upgrade' );
	
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'coffee_tea_frontpage_sections', array(
			'priority' => 1,
			'title' => esc_html__( 'Frontpage Sections', 'coffee-tea' ),
		)
	);
	
	/*=========================================
	Slider Section
	=========================================*/
	$wp_customize->add_section(
		'coffee_tea_slider_section', array(
			'title' => esc_html__( 'Slider Section', 'coffee-tea' ),
			'priority' => 13,
			'panel' => 'coffee_tea_frontpage_sections',
		)
	);

	// Slider Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_slider_setting' , 
			array(
			'default' => false,
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_slider_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'coffee-tea' ),
			'section'     => 'coffee_tea_slider_section',
			'settings'    => 'coffee_tea_slider_setting',
			'type'        => 'checkbox'
		) 
	);
	
	// Slider 1
	$wp_customize->add_setting( 
    	'coffee_tea_slider1',
    	array(
		'default'           => get_page_id_by_slug('slider-page'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 1,
		)
	);	

	$wp_customize->add_control( 
		'coffee_tea_slider1',
		array(
		    'label'   		=> __('Slider 1','coffee-tea'),
		    'section'		=> 'coffee_tea_slider_section',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);		

	// Slider 2
	$wp_customize->add_setting(
    	'coffee_tea_slider2',
    	array(
		'default'           => get_page_id_by_slug('slider-pages'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 2,
		)
	);

	$wp_customize->add_control( 
		'coffee_tea_slider2',
		array(
		    'label'   		=> __('Slider 2','coffee-tea'),
		    'section'		=> 'coffee_tea_slider_section',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);

	// Slider 3
	$wp_customize->add_setting(
    	'coffee_tea_slider3',
    	array(
		'default'           => get_page_id_by_slug('slider-pagess'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 3,
		)
	);

	$wp_customize->add_control( 
		'coffee_tea_slider3',
		array(
		    'label'   		=> __('Slider 3','coffee-tea'),
		    'section'		=> 'coffee_tea_slider_section',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);

	// Slider 3
	$wp_customize->add_setting(
    	'coffee_tea_slider4',
    	array(
		'default'           => get_page_id_by_slug('slider-pagesss'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 3,
		)
	);

	$wp_customize->add_control( 
		'coffee_tea_slider4',
		array(
		    'label'   		=> __('Slider 4','coffee-tea'),
		    'section'		=> 'coffee_tea_slider_section',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);


// Slider 3
	$wp_customize->add_setting(
    	'coffee_tea_slider5',
    	array(
		'default'           => get_page_id_by_slug('slider-pagessss'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 3,
		)
	);

	$wp_customize->add_control( 
		'coffee_tea_slider5',
		array(
		    'label'   		=> __('Slider 5','coffee-tea'),
		    'section'		=> 'coffee_tea_slider_section',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);


	// Slider Text
	$wp_customize->add_setting( 
    	'coffee_tea_slider_text',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority'      => 1,
		)
	);	

	$wp_customize->add_control( 
		'coffee_tea_slider_text',
		array(
		    'label'   		=> __('Slider Text','coffee-tea'),
		    'section'		=> 'coffee_tea_slider_section',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_3',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
        $wp_customize, 'coffee_tea_upgrade_page_settings_3',
            array(
                'priority'      => 200,
                'section'       => 'coffee_tea_slider_section',
                'settings'      => 'coffee_tea_upgrade_page_settings_3',
                'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
            )
        )
    ); 

	// Product Section
	$wp_customize->add_section('coffee_tea_product_section', array(
	    'title' => __('Our Category Section', 'coffee-tea'),
	    'panel' => 'coffee_tea_frontpage_sections'
	));

	// Product Hide/Show Setting
	$wp_customize->add_setting('coffee_tea_show_hide_product_section', array(
	    'default' => true,
	    'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
	    'capability' => 'edit_theme_options',
	    'priority' => 2,
	));

	$wp_customize->add_control('coffee_tea_show_hide_product_section', array(
	    'label' => esc_html__('Hide / Show Product Section', 'coffee-tea'),
	    'section' => 'coffee_tea_product_section',
	    'settings' => 'coffee_tea_show_hide_product_section',
	    'type' => 'checkbox'
	));

	$wp_customize->add_setting('coffee_tea_category_small_heading', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control('coffee_tea_category_small_heading', array(
	    'label' => __('Add short Heading', 'coffee-tea'),
	    'section' => 'coffee_tea_product_section',
	    'type' => 'text'
	));

	$wp_customize->add_setting('coffee_tea_product_heading', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control('coffee_tea_product_heading', array(
	    'label' => __('Add Heading', 'coffee-tea'),
	    'section' => 'coffee_tea_product_section',
	    'type' => 'text'
	));

	// Number of Categories Setting
	$wp_customize->add_setting('coffee_tea_num_of_categories', array(
	    'default' => '8',
	    'sanitize_callback' => 'absint'
	));
	$wp_customize->add_control('coffee_tea_num_of_categories', array(
	    'label' => __('Number of Categories to Display', 'coffee-tea'),
	    'section' => 'coffee_tea_product_section',
	    'type' => 'number'
	));

	$coffee_tea_services_count = get_theme_mod('coffee_tea_num_of_categories', '8');

	for ($coffee_tea_i = 1; $coffee_tea_i <= $coffee_tea_services_count; $coffee_tea_i++) {
	    $wp_customize->add_setting('coffee_tea_product_icon' . $coffee_tea_i, array(
	        'default' => '',
	        'sanitize_callback' => 'sanitize_text_field'
	    ));
	    $wp_customize->add_control('coffee_tea_product_icon' . $coffee_tea_i, array(
	        'label' => __('Icon for Category ', 'coffee-tea') . $coffee_tea_i,
	        'description' => __('Use Font Awesome icons like fas fa-coffee', 'coffee-tea'),
	        'section' => 'coffee_tea_product_section',
	        'type' => 'text'
	    ));

	    $wp_customize->add_setting('coffee_tea_category_price_' . $coffee_tea_i, array(
	        'default' => '',
	        'sanitize_callback' => 'sanitize_text_field'
	    ));
	    $wp_customize->add_control('coffee_tea_category_price_' . $coffee_tea_i, array(
	        'label' => __('Price for Category ', 'coffee-tea') . $coffee_tea_i,
	        'section' => 'coffee_tea_product_section',
	        'type' => 'text'
	    ));
	}

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_4',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
        $wp_customize, 'coffee_tea_upgrade_page_settings_4',
            array(
                'priority'      => 200,
                'section'       => 'coffee_tea_product_section',
                'settings'      => 'coffee_tea_upgrade_page_settings_4',
                'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
            )
        )
    ); 

}

add_action( 'customize_register', 'coffee_tea_blog_setting' );

// service selective refresh
function coffee_tea_blog_section_partials( $wp_customize ){	
	// blog_title
	$wp_customize->selective_refresh->add_partial( 'blog_title', array(
		'selector'            => '.home-blog .title h6',
		'settings'            => 'blog_title',
		'render_callback'  => 'coffee_tea_blog_title_render_callback',
	
	) );
	
	// blog_subtitle
	$wp_customize->selective_refresh->add_partial( 'blog_subtitle', array(
		'selector'            => '.home-blog .title h2',
		'settings'            => 'blog_subtitle',
		'render_callback'  => 'coffee_tea_blog_subtitle_render_callback',
	
	) );
	
	// blog_description
	$wp_customize->selective_refresh->add_partial( 'blog_description', array(
		'selector'            => '.home-blog .title p',
		'settings'            => 'blog_description',
		'render_callback'  => 'coffee_tea_blog_description_render_callback',
	
	) );	
	}

add_action( 'customize_register', 'coffee_tea_blog_section_partials' );

// blog_title
function coffee_tea_blog_title_render_callback() {
	return get_theme_mod( 'blog_title' );
}

// blog_subtitle
function coffee_tea_blog_subtitle_render_callback() {
	return get_theme_mod( 'blog_subtitle' );
}

// service description
function coffee_tea_blog_description_render_callback() {
	return get_theme_mod( 'blog_description' );
}