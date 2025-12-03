<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cafeteria_elementor
 */

?>
<?php
	/**
	 * Hook - cafeteria_elementor_action_doctype.
	 *
	 * @hooked cafeteria_elementor_doctype -  10
	 */
	do_action( 'cafeteria_elementor_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - cafeteria_elementor_action_head.
	 *
	 * @hooked cafeteria_elementor_head -  10
	 */
	do_action( 'cafeteria_elementor_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php do_action( 'wp_body_open' ); ?>

	<?php
	$cafeteria_elementor_show_preloader = cafeteria_elementor_get_option( 'cafeteria_elementor_show_preloader_setting' );
        if ( true === $cafeteria_elementor_show_preloader ) : ?>
			<div id="preloader" class="loader-head">
				<div class="preloader">
				    <div class="spinner"></div>
				    <div class="spinner-2"></div>
				</div>
			</div>
	<?php endif; ?>

	<?php
	/**
	 * Hook - cafeteria_elementor_action_before.
	 *
	 * @hooked cafeteria_elementor_page_start - 10
	 * @hooked cafeteria_elementor_skip_to_content - 15
	 */
	do_action( 'cafeteria_elementor_action_before' );
	?>

    <?php
	  /**
	   * Hook - cafeteria_elementor_action_before_header.
	   *
	   * @hooked cafeteria_elementor_header_start - 10
	   */
	  do_action( 'cafeteria_elementor_action_before_header' );
	?>
		<?php
		/**
		 * Hook - cafeteria_elementor_action_header.
		 *
		 * @hooked cafeteria_elementor_site_branding - 10
		 */
		do_action( 'cafeteria_elementor_action_header' );
		?>
    <?php
	  /**
	   * Hook - cafeteria_elementor_action_after_header.
	   *
	   * @hooked cafeteria_elementor_header_end - 10
	   */
	  do_action( 'cafeteria_elementor_action_after_header' );
	?>

	<?php
	/**
	 * Hook - cafeteria_elementor_action_before_content.
	 *
	 * @hooked cafeteria_elementor_content_start - 10
	 */
	do_action( 'cafeteria_elementor_action_before_content' );
	?>

	<!-- <?php
	  /**
	   * Hook - cafeteria_elementor_action_content.
	   */
	  do_action( 'cafeteria_elementor_action_content' );
	?> -->
