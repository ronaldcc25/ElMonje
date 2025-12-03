<?php
/**
 * Add functions files
 *
 * @package Virtue Theme
 */

define( 'VIRTUE_VERSION', '3.4.13' );


// New function for text domain
function virtue_load_textdomain() {
	load_theme_textdomain( 'virtue', get_template_directory() . '/languages' );
}
add_action( 'init', 'virtue_load_textdomain', 1 );

/*
 * Init Theme Startup/Core utilities/classes
 */
function virtue_load_core_functionality() {
	require_once trailingslashit( get_template_directory() ) . 'themeoptions/framework.php'; // Options framework.
    require_once trailingslashit( get_template_directory() ) . 'themeoptions/options.php'; // Options settings.
    require_once trailingslashit( get_template_directory() ) . 'themeoptions/options/virtue_extension.php'; // Options framework extension.

    require_once trailingslashit( get_template_directory() ) . 'lib/classes/class-virtue-plugin-check.php'; // Check plugin class.
    require_once trailingslashit( get_template_directory() ) . 'lib/utils.php'; // Utility functions.
    require_once trailingslashit( get_template_directory() ) . 'lib/init.php'; // Initialize theme.
    require_once trailingslashit( get_template_directory() ) . 'lib/sidebar.php'; // Sidebar class.
    require_once trailingslashit( get_template_directory() ) . 'lib/config.php'; // Config.
    require_once trailingslashit( get_template_directory() ) . 'lib/cleanup.php'; // Cleanup.
    require_once trailingslashit( get_template_directory() ) . 'lib/elementor/elementor-support.php'; // Elementor support.
    require_once trailingslashit( get_template_directory() ) . 'lib/nav.php'; // Custom nav modifications.
    require_once trailingslashit( get_template_directory() ) . 'lib/metaboxes.php'; // Custom metaboxes.
    require_once trailingslashit( get_template_directory() ) . 'lib/comments.php'; // Custom comment modifications.
    require_once trailingslashit( get_template_directory() ) . 'lib/image-functions.php'; // Image functions.
    require_once trailingslashit( get_template_directory() ) . 'lib/class-virtue-get-image.php'; // Image class.
    require_once trailingslashit( get_template_directory() ) . 'lib/custom.php'; // Custom functions.
    require_once trailingslashit( get_template_directory() ) . 'lib/kadence-toolkit-plugin.php'; // Plugin activation.

    require_once trailingslashit( get_template_directory() ) . 'lib/woocommerce/woo-core-hooks.php'; // WooCommerce core hooks.
    require_once trailingslashit( get_template_directory() ) . 'lib/woocommerce/woo-archive-hooks.php'; // WooCommerce archive hooks.
    require_once trailingslashit( get_template_directory() ) . 'lib/woocommerce/woo-single-product-hooks.php'; // WooCommerce single product hooks.
    require_once trailingslashit( get_template_directory() ) . 'lib/woo-account.php'; // WooCommerce account functions.

    require_once trailingslashit( get_template_directory() ) . 'lib/authorbox.php'; // Author box.
    require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/portfolio_hooks.php'; // Portfolio hooks.
    require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/post_hooks.php'; // Post hooks.
    require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/page_hooks.php'; // Page hooks.

    require_once trailingslashit( get_template_directory() ) . 'lib/widgets.php'; // Sidebar widgets.

    require_once trailingslashit( get_template_directory() ) . 'lib/admin-scripts.php'; // Admin scripts.
    require_once trailingslashit( get_template_directory() ) . 'lib/scripts.php'; // Scripts and stylesheets.
    require_once trailingslashit( get_template_directory() ) . 'lib/custom-css.php'; // Frontend custom CSS.
}
add_action( 'after_setup_theme', 'virtue_load_core_functionality', 1 );

/**
 * Note: Do not add any custom code here. Please use a custom plugin or child theme so that your customizations aren't lost during updates.
 * https://www.kadencewp.com/child-themes/
 */
