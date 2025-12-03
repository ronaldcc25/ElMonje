<?php
/**
 * Default theme options.
 *
 * @package cafeteria_elementor
 */

if ( ! function_exists( 'cafeteria_elementor_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function cafeteria_elementor_get_default_theme_options() {

		$defaults = array();

		// Typography
		$defaults['cafeteria_elementor_body_font_family']         = '';
		$defaults['cafeteria_elementor_h1_font_family']          	= '';
		$defaults['cafeteria_elementor_h1_font_size']         	= '';
		$defaults['cafeteria_elementor_h2_font_family']          	= '';
		$defaults['cafeteria_elementor_h2_font_size']         	= '';
		$defaults['cafeteria_elementor_h3_font_family']          	= '';
		$defaults['cafeteria_elementor_h3_font_size']         	= '';
		$defaults['cafeteria_elementor_h4_font_family']          	= '';
		$defaults['cafeteria_elementor_h4_font_size']         	= '';
		$defaults['cafeteria_elementor_h5_font_family']          	= '';
		$defaults['cafeteria_elementor_h5_font_size']         	= '';
		$defaults['cafeteria_elementor_h6_font_family']          	= '';
		$defaults['cafeteria_elementor_h6_font_size']         	= '';

		// Site title And tagline Option

		$defaults['cafeteria_elementor_site_title_font_size']         = '';
		$defaults['cafeteria_elementor_site_tagline_font_size']         = '';
		$defaults['cafeteria_elementor_site_title_color'] = '#fff';

		// Global Color
		$defaults['cafeteria_elementor_first_color']        = '#813D18';
		$defaults['cafeteria_elementor_second_color']        = '#000000';

		//General Option
        $defaults['cafeteria_elementor_show_scroll_to_top']          = true;
        $defaults['cafeteria_elementor_show_preloader_setting']      = false;
		$defaults['cafeteria_elementor_enable_cursor_dot_outline'] = false;

        //Post Option
        $defaults['cafeteria_elementor_show_post_date_setting']         		 = true;
        $defaults['cafeteria_elementor_show_post_heading_setting']      		 = true;
        $defaults['cafeteria_elementor_show_post_content_setting']       		 = true;
        $defaults['cafeteria_elementor_show_post_admin_setting']         		 = true;
        $defaults['cafeteria_elementor_show_post_categories_setting']    		 = true;
        $defaults['cafeteria_elementor_show_post_comments_setting']    	 	 = true;
        $defaults['cafeteria_elementor_show_post_featured_image_setting']   	 = true;
        $defaults['cafeteria_elementor_show_post_tags_setting']    			 = true;
		$defaults['cafeteria_elementor_enable_post_navigation'] 				= true;
		$defaults['cafeteria_elementor_show_first_caps']      			= false;

		// Related Post
		$defaults['cafeteria_elementor_enable_related_post'] 					= true;
		$defaults['cafeteria_elementor_enable_related_post_image'] 					= true;

		// Header.
		$defaults['cafeteria_elementor_show_title']            = true;
		$defaults['cafeteria_elementor_show_tagline']          = false;
		$defaults['cafeteria_elementor_show_social_icon']      = true;
		$defaults['cafeteria_elementor_show_top_header']      = false;
	
		// Layout.
		$defaults['cafeteria_elementor_global_layout']           = 'right-sidebar';
		$defaults['cafeteria_elementor_archive_layout']          = 'excerpt';
		$defaults['cafeteria_elementor_archive_image']           = 'large';
		$defaults['cafeteria_elementor_archive_image_alignment'] = 'none';
		$defaults['cafeteria_elementor_single_image']            = 'large';

		// Home Page.
		$defaults['cafeteria_elementor_home_content_status'] = true;
		
		// No Result.
		$defaults['cafeteria_elementor_no_result_title']  = esc_html__( 'Nothing Found', 'cafeteria-elementor' );
		$defaults['cafeteria_elementor_no_result_text']  = esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cafeteria-elementor' );

		// Footer.
		$defaults['cafeteria_elementor_copyright_text']        = esc_html__( 'Copyright &copy; All rights reserved.', 'cafeteria-elementor' );
		$defaults['cafeteria_elementor_copyright_background_color'] = '#813D18';
		$defaults['cafeteria_elementor_copyright_text_color'] = '#fff';
		
		// Pass through filter.
		$defaults = apply_filters( 'cafeteria_elementor_filter_default_theme_options', $defaults );
		return $defaults;
	}

endif;
