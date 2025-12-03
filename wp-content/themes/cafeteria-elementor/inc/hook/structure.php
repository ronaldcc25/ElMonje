<?php
/**
 * Theme functions related to structure.
 *
 * This file contains structural hook functions.
 *
 * @package cafeteria_elementor
 */

if ( ! function_exists( 'cafeteria_elementor_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_doctype() {
	?><!DOCTYPE html> <html <?php language_attributes(); ?>><?php
	}
endif;

add_action( 'cafeteria_elementor_action_doctype', 'cafeteria_elementor_doctype', 10 );


if ( ! function_exists( 'cafeteria_elementor_head' ) ) :
	/**
	 * Header Codes.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_head() {
	?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
	}
endif;
add_action( 'cafeteria_elementor_action_head', 'cafeteria_elementor_head', 10 );

if ( ! function_exists( 'cafeteria_elementor_page_start' ) ) :
	/**
	 * Page Start.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_page_start() {
	?>
    <div id="page" class="hfeed site">
    <?php
	}
endif;
add_action( 'cafeteria_elementor_action_before', 'cafeteria_elementor_page_start' );

if ( ! function_exists( 'cafeteria_elementor_page_end' ) ) :
	/**
	 * Page End.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_page_end() {
	?></div><!-- #page --><?php
	}
endif;

add_action( 'cafeteria_elementor_action_after', 'cafeteria_elementor_page_end' );

if ( ! function_exists( 'cafeteria_elementor_content_start' ) ) :
	/**
	 * Content Start.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_content_start() {
	?><?php if(!is_page_template( 'home-page-template.php' )) { echo '<div id="content" class="site-content">'; } ?><?php if(!is_page_template( 'home-page-template.php' )) { echo '<div class="container">'; } ?><div class="inner-wrapper"><?php
	}
endif;
add_action( 'cafeteria_elementor_action_before_content', 'cafeteria_elementor_content_start' );


if ( ! function_exists( 'cafeteria_elementor_content_end' ) ) :
	/**
	 * Content End.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_content_end() {
	?></div><!-- .inner-wrapper --></div><!-- .container --><?php if(!is_page_template( 'home-page-template.php' )) { echo '</div>'; } ?><!-- #content --><?php
	}
endif;
add_action( 'cafeteria_elementor_action_after_content', 'cafeteria_elementor_content_end' );


if ( ! function_exists( 'cafeteria_elementor_header_start' ) ) :
	/**
	 * Header Start.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_header_start() {
		?><header id="masthead" class="site-header" role="banner"><?php
	}
endif;
add_action( 'cafeteria_elementor_action_before_header', 'cafeteria_elementor_header_start' );

if ( ! function_exists( 'cafeteria_elementor_header_end' ) ) :
	/**
	 * Header End.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_header_end() {
	?></div><!-- .container --></header><!-- #masthead --><?php
	}
endif;
add_action( 'cafeteria_elementor_action_after_header', 'cafeteria_elementor_header_end' );



if ( ! function_exists( 'cafeteria_elementor_footer_start' ) ) :
	/**
	 * Footer Start.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_footer_start() {
		$cafeteria_elementor_footer_status = apply_filters( 'cafeteria_elementor_filter_footer_status', true );
		if ( true !== $cafeteria_elementor_footer_status ) {
			return;
		}
	?><footer id="colophon" class="site-footer" role="contentinfo"><div class="container"><?php
	}
endif;
add_action( 'cafeteria_elementor_action_before_footer', 'cafeteria_elementor_footer_start' );


if ( ! function_exists( 'cafeteria_elementor_footer_end' ) ) :
	/**
	 * Footer End.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_footer_end() {
		$cafeteria_elementor_footer_status = apply_filters( 'cafeteria_elementor_filter_footer_status', true );
		if ( true !== $cafeteria_elementor_footer_status ) {
			return;
		}
		$cafeteria_elementor_enable_cursor_dot_outline = cafeteria_elementor_get_option('cafeteria_elementor_enable_cursor_dot_outline');
		if ($cafeteria_elementor_enable_cursor_dot_outline) { ?>
			<!-- Custom cursor -->
			<div class="cursor-point-outline"></div>
			<div class="cursor-point"></div>
			<!-- .Custom cursor -->
		<?php } ?>
		</div><!-- .container --></footer><!-- #colophon --><?php
	}
endif;
add_action( 'cafeteria_elementor_action_after_footer', 'cafeteria_elementor_footer_end' );
