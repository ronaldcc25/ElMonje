<?php

  $cafeteria_elementor_color_palette_css = '';

	// Global Color

	$cafeteria_elementor_first_color = cafeteria_elementor_get_option('cafeteria_elementor_first_color');
	$cafeteria_elementor_second_color = cafeteria_elementor_get_option('cafeteria_elementor_second_color');

	if($cafeteria_elementor_first_color != false){
		$cafeteria_elementor_color_palette_css .=':root {';
			$cafeteria_elementor_color_palette_css .='--primary-theme-color: '.esc_attr($cafeteria_elementor_first_color).'!important;';
			$cafeteria_elementor_color_palette_css .='--secondary-theme-color: '.esc_attr($cafeteria_elementor_second_color).'!important;';
		$cafeteria_elementor_color_palette_css .='}';
	}

	// Copyright Background Color
	$cafeteria_elementor_copyright_background_color = cafeteria_elementor_get_option('cafeteria_elementor_copyright_background_color');
	$cafeteria_elementor_color_palette_css .='#colophon {';
	$cafeteria_elementor_color_palette_css .='background: '.esc_attr($cafeteria_elementor_copyright_background_color);
	$cafeteria_elementor_color_palette_css .='}';

	// Copyright Text Color
	$cafeteria_elementor_copyright_text_color = cafeteria_elementor_get_option('cafeteria_elementor_copyright_text_color');
	$cafeteria_elementor_color_palette_css .='#colophon a , #colophon{';
	$cafeteria_elementor_color_palette_css .='color: '.esc_attr($cafeteria_elementor_copyright_text_color);
	$cafeteria_elementor_color_palette_css .='}';


	// Site title And tagline Option
	$cafeteria_elementor_site_title_font_size = cafeteria_elementor_get_option('cafeteria_elementor_site_title_font_size');
	$cafeteria_elementor_site_title_color = cafeteria_elementor_get_option('cafeteria_elementor_site_title_color');
	$cafeteria_elementor_color_palette_css .='.site-title>a , .site-title {';
		$cafeteria_elementor_color_palette_css .='font-size: '.esc_attr($cafeteria_elementor_site_title_font_size).'px;';
		$cafeteria_elementor_color_palette_css .='color: '.esc_attr($cafeteria_elementor_site_title_color).';';
	$cafeteria_elementor_color_palette_css .='}';
	
	$cafeteria_elementor_site_tagline_font_size = cafeteria_elementor_get_option('cafeteria_elementor_site_tagline_font_size');
	if($cafeteria_elementor_site_tagline_font_size != false){
		$cafeteria_elementor_color_palette_css .='.site-description {';
			$cafeteria_elementor_color_palette_css .='font-size: '.esc_attr($cafeteria_elementor_site_tagline_font_size).'px;';
		$cafeteria_elementor_color_palette_css .='}';
	}

	$cafeteria_elementor_show_top_header = cafeteria_elementor_get_option('cafeteria_elementor_show_top_header', false);
    if($cafeteria_elementor_show_top_header != true){
        $cafeteria_elementor_color_palette_css .='.page-template-home-page-template #middle-header{';
            $cafeteria_elementor_color_palette_css .='margin-top: 30px;';
        $cafeteria_elementor_color_palette_css .='}';
    }

	//First Cap
	$cafeteria_elementor_show_first_caps = cafeteria_elementor_get_option('cafeteria_elementor_show_first_caps', false);
	if($cafeteria_elementor_show_first_caps == 'true' ){
	$cafeteria_elementor_color_palette_css .='.blog-content .text-content p:nth-of-type(1)::first-letter{';
	$cafeteria_elementor_color_palette_css .=' font-size: 50px; font-weight: 600;';
	$cafeteria_elementor_color_palette_css .=' margin-right: 5px;';
	$cafeteria_elementor_color_palette_css .=' line-height: 1;';
	$cafeteria_elementor_color_palette_css .='}';
	}elseif($cafeteria_elementor_show_first_caps == 'false' ){
	$cafeteria_elementor_color_palette_css .='.blog-content .text-content p:nth-of-type(1)::first-letter {';
	$cafeteria_elementor_color_palette_css .='display: none;';
	$cafeteria_elementor_color_palette_css .='}';
	}

	// preloader background image
	$cafeteria_elementor_show_preloader_background_image = cafeteria_elementor_get_option('cafeteria_elementor_show_preloader_background_image');
	if($cafeteria_elementor_show_preloader_background_image != false){
		$cafeteria_elementor_color_palette_css .='#preloader {';
			$cafeteria_elementor_color_palette_css .='background: url('.esc_attr($cafeteria_elementor_show_preloader_background_image).');-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;';
		$cafeteria_elementor_color_palette_css .='}';
	}