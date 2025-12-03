<?php
function coffee_tea_post_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'coffee_tea_post', array(
			'priority' => 31,
			'title' => esc_html__( 'Post Options', 'coffee-tea' ),
		)
	);

	/*=========================================
	Archive Post  Section
	=========================================*/
	$wp_customize->add_section(
		'coffee_tea_archive_post_setting', array(
			'title' => esc_html__( 'Archive Post', 'coffee-tea' ),
			'priority' => 1,
			'panel' => 'coffee_tea_post',
		)
	);

	// Layouts Post
	$wp_customize->add_setting('coffee_tea_blog_layout_option_setting',array(
	  'default' => 'Default',
	  'sanitize_callback' => 'coffee_tea_sanitize_choices'
	));
	$wp_customize->add_control(new Coffee_Tea_Image_Radio_Control($wp_customize, 'coffee_tea_blog_layout_option_setting', array(
	  'type' => 'select',
	  'label' => __('Blog Post Layouts','coffee-tea'),
	  'section' => 'coffee_tea_archive_post_setting',
	  'choices' => array(
		'Default' => esc_url(get_template_directory_uri()).'/assets/images/layout-1.png',
		'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout-2.png',
		'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout-3.png',
	))));
		
	// Post Heading Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_post_heading_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
		'coffee_tea_post_heading_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Heading', 'coffee-tea' ),
			'section'     => 'coffee_tea_archive_post_setting',
			'settings'    => 'coffee_tea_post_heading_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Content Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_post_content_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_post_content_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Content', 'coffee-tea' ),
			'section'     => 'coffee_tea_archive_post_setting',
			'settings'    => 'coffee_tea_post_content_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Featured Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_post_featured_image_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_post_featured_image_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Feature Image', 'coffee-tea' ),
			'section'     => 'coffee_tea_archive_post_setting',
			'settings'    => 'coffee_tea_post_featured_image_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_post_date_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_post_date_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Date', 'coffee-tea' ),
			'section'     => 'coffee_tea_archive_post_setting',
			'settings'    => 'coffee_tea_post_date_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_post_comments_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_post_comments_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Comment', 'coffee-tea' ),
			'section'     => 'coffee_tea_archive_post_setting',
			'settings'    => 'coffee_tea_post_comments_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_post_author_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_post_author_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Author', 'coffee-tea' ),
			'section'     => 'coffee_tea_archive_post_setting',
			'settings'    => 'coffee_tea_post_author_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Timing Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_post_timing_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_post_timing_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Timings', 'coffee-tea' ),
			'section'     => 'coffee_tea_archive_post_setting',
			'settings'    => 'coffee_tea_post_timing_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Tags Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_post_tags_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_post_tags_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Tags', 'coffee-tea' ),
			'section'     => 'coffee_tea_archive_post_setting',
			'settings'    => 'coffee_tea_post_tags_settings',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting('coffee_tea_excerpt_limit', array(
        'default'           => 50,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('coffee_tea_excerpt_limit', array(
        'label'   => __('Excerpt Word Limit', 'coffee-tea'),
        'section' => 'coffee_tea_archive_post_setting',
        'type'    => 'number',
    ));

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_133',
	array(
		'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
		$wp_customize, 'coffee_tea_upgrade_page_settings_133',
			array(
				'priority'      => 200,
				'section'       => 'coffee_tea_archive_post_setting',
				'settings'      => 'coffee_tea_upgrade_page_settings_133',
				'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
			)
		)
	); 

	/*=========================================
	Single Post  Section
	=========================================*/
	$wp_customize->add_section(
		'coffee_tea_single_post', array(
			'title' => esc_html__( 'Single Post', 'coffee-tea' ),
			'priority' => 3,
			'panel' => 'coffee_tea_post',
		)
	);
	
	// Post Heading Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_single_post_heading_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_single_post_heading_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Heading', 'coffee-tea' ),
			'section'     => 'coffee_tea_single_post',
			'settings'    => 'coffee_tea_single_post_heading_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Content Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_single_post_content_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_single_post_content_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Content', 'coffee-tea' ),
			'section'     => 'coffee_tea_single_post',
			'settings'    => 'coffee_tea_single_post_content_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Featured Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_single_post_featured_image_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_single_post_featured_image_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Feature Image', 'coffee-tea' ),
			'section'     => 'coffee_tea_single_post',
			'settings'    => 'coffee_tea_single_post_featured_image_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_single_post_date_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_single_post_date_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Date', 'coffee-tea' ),
			'section'     => 'coffee_tea_single_post',
			'settings'    => 'coffee_tea_single_post_date_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_single_post_comments_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_single_post_comments_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Comment', 'coffee-tea' ),
			'section'     => 'coffee_tea_single_post',
			'settings'    => 'coffee_tea_single_post_comments_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_single_post_author_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_single_post_author_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Author', 'coffee-tea' ),
			'section'     => 'coffee_tea_single_post',
			'settings'    => 'coffee_tea_single_post_author_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_single_post_timing_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_single_post_timing_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Timings', 'coffee-tea' ),
			'section'     => 'coffee_tea_single_post',
			'settings'    => 'coffee_tea_single_post_timing_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Tags Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_single_post_tags_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_single_post_tags_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Tags', 'coffee-tea' ),
			'section'     => 'coffee_tea_single_post',
			'settings'    => 'coffee_tea_single_post_tags_settings',
			'type'        => 'checkbox'
		) 
	);
	
	// Related Posts Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_show_hide_related_post' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_show_hide_related_post', 
		array(
			'label'	      => esc_html__( 'Hide / Show Related Posts', 'coffee-tea' ),
			'section'     => 'coffee_tea_single_post',
			'settings'    => 'coffee_tea_show_hide_related_post',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting( 
    	'coffee_tea_related_posts_heading',
    	array(
			'default' => 'Related Posts',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority'      => 1,
		)
	);	

	$wp_customize->add_control( 
		'coffee_tea_related_posts_heading',
		array(
		    'label'   		=> __('Related Post Heading','coffee-tea'),
		    'section'		=> 'coffee_tea_single_post',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_setting('coffee_tea_related_post_counts', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('coffee_tea_related_post_counts', array(
        'label'   => __('Number Of Related Posts To Show', 'coffee-tea'),
        'section' => 'coffee_tea_single_post',
        'type'    => 'number',
    ));

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_58',
	array(
		'sanitize_callback' => 'sanitize_text_field'
	)
	);
	$wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
		$wp_customize, 'coffee_tea_upgrade_page_settings_58',
			array(
				'priority'      => 200,
				'section'       => 'coffee_tea_single_post',
				'settings'      => 'coffee_tea_upgrade_page_settings_58',
				'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
			)
		)
	); 
}

add_action( 'customize_register', 'coffee_tea_post_setting' );