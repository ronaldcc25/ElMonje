<?php

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script(
		'coffee-tea-customize-section-button',
		get_theme_file_uri( 'assets/js/customize-controls.js' ),
		[ 'customize-controls' ],
		$version,
		true
	);
	wp_localize_script(
		'coffee-tea-customize-section-button',
		'Coffee_Tea_Customizer_params',
		array(
			'ajaxurl' =>	admin_url( 'admin-ajax.php' )
		)
	);

	wp_enqueue_style(
		'coffee-tea-customize-section-button',
		get_theme_file_uri( 'assets/css/customize-controls.css' ),
		[ 'customize-controls' ],
 		$version
	);

} );

 /**
 * Enqueue scripts and styles.
 */
function coffee_tea_scripts() {
	// Styles	 

	wp_enqueue_style('all-min',get_template_directory_uri().'/assets/css/all.min.css');

	// owl
	wp_enqueue_style( 'owl-carousel-css', get_theme_file_uri( '/assets/css/owl.carousel.css' ) );

	wp_enqueue_style('bootstrap-min',get_template_directory_uri().'/assets/css/bootstrap.min.css');
		
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/css/fonts/font-awesome/css/font-awesome.min.css');
	
	wp_enqueue_style('coffee-tea-editor-style',get_template_directory_uri().'/assets/css/editor-style.css');

	wp_enqueue_style('coffee-tea-main', get_template_directory_uri() . '/assets/css/main.css');

	wp_enqueue_style('coffee-tea-woo', get_template_directory_uri() . '/assets/css/woo.css');
	
	wp_enqueue_style( 'coffee-tea-style', get_stylesheet_uri() );


	wp_enqueue_style('coffee-tea-style', get_stylesheet_uri(), array() );
		wp_style_add_data('coffee-tea-style', 'rtl', 'replace');
	
	// Scripts

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), false, true);

	wp_enqueue_script( 'owl-carousel-js', get_theme_file_uri( '/assets/js/owl.carousel.js' ), array( 'jquery' ), true );

	wp_enqueue_script('coffee-tea-theme-js', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Define a unique handle for your inline stylesheet
	$handle = 'coffee-tea-style';
		
	// Get the generated custom CSS
	$coffee_tea_custom_css = "";

	$coffee_tea_blog_layouts = get_theme_mod('coffee_tea_blog_layout_option_setting', 'Default');
	if ($coffee_tea_blog_layouts == 'Default') {
		$coffee_tea_custom_css .= '.blog-item{';
		$coffee_tea_custom_css .= 'text-align:center;';
		$coffee_tea_custom_css .= '}';
	} elseif ($coffee_tea_blog_layouts == 'Left') {
		$coffee_tea_custom_css .= '.blog-item{';
		$coffee_tea_custom_css .= 'text-align:Left;';
		$coffee_tea_custom_css .= '}';
	} elseif ($coffee_tea_blog_layouts == 'Right') {
		$coffee_tea_custom_css .= '.blog-item{';
		$coffee_tea_custom_css .= 'text-align:Right;';
		$coffee_tea_custom_css .= '}';
	}

	// Enqueue the inline stylesheet
	wp_add_inline_style($handle, $coffee_tea_custom_css);

	// inlin css
	$coffee_tea_inline_style = '';

	$coffee_tea_slider_setting = get_theme_mod( 'coffee_tea_slider_setting', '0');
	if($coffee_tea_slider_setting == '0') {
	    $coffee_tea_inline_style .= '.page-template-template-frontpage .logo{';
	    $coffee_tea_inline_style .= 'position: static;';
	    $coffee_tea_inline_style .= '}';
	    $coffee_tea_inline_style .= '.page-template-template-frontpage .main-header{';
	    $coffee_tea_inline_style .= 'transform: none; position:static;margin-top:0; background: #967258;
    padding: 20px;';
	    $coffee_tea_inline_style .= '}';
	}

	wp_add_inline_style( 'coffee-tea-style', $coffee_tea_inline_style );

	// Add inline style for Scroll to Top
    $coffee_tea_scroll_top_bg_color = get_theme_mod('coffee_tea_scroll_top_bg_color', '#38210f');
    $coffee_tea_scroll_top_color = get_theme_mod('coffee_tea_scroll_top_color', '#fff');

	// Use global if still default
    if ( $coffee_tea_scroll_top_bg_color === '#38210f' ) {
        $coffee_tea_scroll_top_bg_color = get_theme_mod('coffee_tea_dynamic_color_one');
    }

    $coffee_tea_scroll_custom_css = "
        #scrolltop {
            background-color: {$coffee_tea_scroll_top_bg_color};
        }
        #scrolltop span {
            color: {$coffee_tea_scroll_top_color};
        }
    ";
    wp_add_inline_style('coffee-tea-style', $coffee_tea_scroll_custom_css);

    // Add inline style for Preloader
    $coffee_tea_preloader_bg_color = get_theme_mod('coffee_tea_preloader_bg_color', '#ffffff');
    $coffee_tea_preloader_color = get_theme_mod('coffee_tea_preloader_color', '#38210f');

	// Use global if still default
    if ( $coffee_tea_preloader_color === '#38210f' ) {
        $coffee_tea_preloader_color = get_theme_mod('coffee_tea_dynamic_color_one');
    }

    $coffee_tea_preloader_custom_css = "
        .loading {
            background-color: {$coffee_tea_preloader_bg_color};
        }
        .loader {
            border-color: {$coffee_tea_preloader_color};
            color: {$coffee_tea_preloader_color};
            text-shadow: 0 0 10px {$coffee_tea_preloader_color};
        }
        .loader::before {
            border-top-color: {$coffee_tea_preloader_color};
            border-right-color: {$coffee_tea_preloader_color};
        }
        .loader span::before {
            background: {$coffee_tea_preloader_color};
            box-shadow: 0 0 10px {$coffee_tea_preloader_color};
        }
    ";
    wp_add_inline_style('coffee-tea-style', $coffee_tea_preloader_custom_css);

}
add_action( 'wp_enqueue_scripts', 'coffee_tea_scripts' );