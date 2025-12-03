<?php
function coffee_tea_header_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

    // Site Title Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_site_title_setting' , 
			array(
			'default' => 1,
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_site_title_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Site Title', 'coffee-tea' ),
			'section'     => 'title_tagline',
			'settings'    => 'coffee_tea_site_title_setting',
			'type'        => 'checkbox'
		) 
	);

	// Tagline Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'coffee_tea_tagline_setting' , 
			array(
			'default' => '',
			'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'coffee_tea_tagline_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Tagline', 'coffee-tea' ),
			'section'     => 'title_tagline',
			'settings'    => 'coffee_tea_tagline_setting',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting( 'coffee_tea_upgrade_page_settings_9da',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Coffee_Tea_Control_Upgrade(
        $wp_customize, 'coffee_tea_upgrade_page_settings_9da',
            array(
                'priority'      => 200,
                'section'       => 'title_tagline',
                'settings'      => 'coffee_tea_upgrade_page_settings_9da',
                'label'         => __( 'Coffee Tea Pro comes with additional features.', 'coffee-tea' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'coffee-tea' ), __( 'One-Click Demo Import', 'coffee-tea' ), __( 'WooCommerce Integrated', 'coffee-tea' ), __( 'Drag & Drop Section Reordering', 'coffee-tea' ),__( 'Advanced Typography Control', 'coffee-tea' ),__( 'Intuitive Customization Options', 'coffee-tea' ),__( '24/7 Support', 'coffee-tea' ), )
            )
        )
    );

	// Add the setting for logo width
	$wp_customize->add_setting(
	    'coffee_tea_logo_width',
	    array(
	        'sanitize_callback' => 'coffee_tea_sanitize_logo_width',
	        'priority'          => 2,
	    )
	);

	// Add control for logo width
	$wp_customize->add_control( 
	    'coffee_tea_logo_width',
	    array(
	        'label'     => __('Logo Width', 'coffee-tea'),
	        'section'   => 'title_tagline',
	        'type'      => 'number',
	        'input_attrs' => array(
	            'min'   => 1,
	            'max'   => 150,
	            'step'  => 1,
	        ),
	        'transport' => $selective_refresh,
	    )  
	);

	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','coffee-tea'),
			'panel'  		=> 'coffee_tea_frontpage_sections',
		)
    );

	$wp_customize->register_panel_type( 'Coffee_Tea_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'Coffee_Tea_WP_Customize_Section' );

}
add_action( 'customize_register', 'coffee_tea_header_settings' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class Coffee_Tea_WP_Customize_Panel extends WP_Customize_Panel {
	   public $panel;
	   public $type = 'coffee_tea_panel';
	   public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class Coffee_Tea_WP_Customize_Section extends WP_Customize_Section {
	   public $section;
	   public $type = 'coffee_tea_section';
	   public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}