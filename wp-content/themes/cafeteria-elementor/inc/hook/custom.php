<?php
/**
 * Custom theme functions.
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package cafeteria_elementor
 */

if ( ! function_exists( 'cafeteria_elementor_skip_to_content' ) ) :
	/**
	 * Add Skip to content.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_skip_to_content() {
	?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cafeteria-elementor' ); ?></a><?php
	}
endif;

add_action( 'cafeteria_elementor_action_before', 'cafeteria_elementor_skip_to_content', 15 );

// Middle Header

if ( ! function_exists( 'cafeteria_elementor_site_branding' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_site_branding() {

		$cafeteria_elementor_show_top_header = cafeteria_elementor_get_option( 'cafeteria_elementor_show_top_header' );
		$cafeteria_elementor_header_top_buttonlink = cafeteria_elementor_get_option( 'cafeteria_elementor_header_top_buttonlink' );
		$cafeteria_elementor_header_top_location = cafeteria_elementor_get_option( 'cafeteria_elementor_header_top_location');
		$cafeteria_elementor_header_top_location_link = cafeteria_elementor_get_option( 'cafeteria_elementor_header_top_location_link' );
		$cafeteria_elementor_header_top_email = cafeteria_elementor_get_option( 'cafeteria_elementor_header_top_email' );
		$cafeteria_elementor_header_top_phone_number = cafeteria_elementor_get_option( 'cafeteria_elementor_header_top_phone_number' );

		$cafeteria_elementor_show_social_icon = cafeteria_elementor_get_option( 'cafeteria_elementor_show_social_icon' );
		$cafeteria_elementor_header_social_facebook_link = cafeteria_elementor_get_option( 'cafeteria_elementor_header_social_facebook_link' );
		$cafeteria_elementor_header_social_twitter_link = cafeteria_elementor_get_option( 'cafeteria_elementor_header_social_twitter_link' );
		$cafeteria_elementor_header_social_instagram_link = cafeteria_elementor_get_option( 'cafeteria_elementor_header_social_instagram_link' );
		$cafeteria_elementor_header_social_youtube_link = cafeteria_elementor_get_option( 'cafeteria_elementor_header_social_youtube_link' );
		
		?>
		<div class="top-header">
			<div class="container">
				<?php if ( true === $cafeteria_elementor_show_top_header ) : ?>
					<div class="row header-top py-2">
						<div class="offset-xl-2 offset-lg-3 col-xl-10 col-lg-9 col-md-12 col-sm-12 col-12 align-self-center d-flex justify-content-between header-top-inner">
							<?php if ( true === $cafeteria_elementor_show_social_icon ) : ?>
								<div class="header-social-icon">
									<?php if( !empty($cafeteria_elementor_header_social_facebook_link) || !empty($cafeteria_elementor_header_social_twitter_link) || !empty($cafeteria_elementor_header_social_instagram_link) || !empty($cafeteria_elementor_header_social_youtube_link) ):?>
										<?php if( !empty($cafeteria_elementor_header_social_facebook_link) ):?>
											<a href="<?php echo esc_url($cafeteria_elementor_header_social_facebook_link);?>" target="_blank" ><span class="dashicons dashicons-facebook-alt"></span></a>
										<?php endif; ?>
										<?php if( !empty($cafeteria_elementor_header_social_twitter_link) ):?>
											<a href="<?php echo esc_url($cafeteria_elementor_header_social_twitter_link);?>" target="_blank" ><span class="dashicons dashicons-twitter"></span></a>
										<?php endif; ?>
										<?php if( !empty($cafeteria_elementor_header_social_instagram_link) ):?>
											<a href="<?php echo esc_url($cafeteria_elementor_header_social_instagram_link);?>" target="_blank" ><span class="dashicons dashicons-instagram"></span></a>
										<?php endif; ?>
										<?php if( !empty($cafeteria_elementor_header_social_youtube_link) ):?>
											<a href="<?php echo esc_url($cafeteria_elementor_header_social_youtube_link);?>" target="_blank" ><span class="dashicons dashicons-youtube"></span></a>
										<?php endif; ?>
									<?php endif;?>
								</div>
							<?php endif; ?>
							<?php if( !empty($cafeteria_elementor_header_top_phone_number) ):?>
								<p class="mb-0 topheader-phone"><a href="tel:<?php echo esc_attr($cafeteria_elementor_header_top_phone_number);?>"><span class="dashicons dashicons-phone me-2"></span><?php echo esc_html($cafeteria_elementor_header_top_phone_number);?></a></p>
							<?php endif; ?>
							<?php if( !empty($cafeteria_elementor_header_top_email) ):?>
								<p class="mb-0 topheader-mail"><a href="mailto:<?php echo esc_attr($cafeteria_elementor_header_top_email);?>"><span class="dashicons dashicons-email me-2"></span><?php echo esc_html($cafeteria_elementor_header_top_email);?></a></p>
							<?php endif; ?>
							<?php if( !empty($cafeteria_elementor_header_top_location) ):?>
								<p class="mb-0 topheader-location"><a href="<?php echo esc_url($cafeteria_elementor_header_top_location_link);?>"><span class="dashicons dashicons-location me-2"></span><?php echo esc_html($cafeteria_elementor_header_top_location);?></a></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div id="middle-header" class="py-2">
			<div class="container">
				<div class="row inner-middle">
					<div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12 align-self-center position-relative">
						<div class="site-branding text-center">
							<?php cafeteria_elementor_the_custom_logo(); ?>
							<?php $cafeteria_elementor_show_title = cafeteria_elementor_get_option( 'cafeteria_elementor_show_title' ); ?>
							<?php $cafeteria_elementor_show_tagline = cafeteria_elementor_get_option( 'cafeteria_elementor_show_tagline' ); ?>
							<?php if ( true === $cafeteria_elementor_show_title || true === $cafeteria_elementor_show_tagline ) :  ?>
								<div id="site-identity" class="text-center">
									<?php if ( true === $cafeteria_elementor_show_title ) :  ?>
										<?php if ( is_front_page() ) : ?>
											<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
										<?php else : ?>
											<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
										<?php endif; ?>
									<?php endif; ?>
									<?php if ( true === $cafeteria_elementor_show_tagline ) :  ?>
										<p class="site-description"><?php bloginfo( 'description' ); ?></p>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-xl-9 col-lg-7 col-md-4 col-sm-4 col-5 align-self-center text-start">
						<div class="navigation_header">
							<div class="toggle-nav mobile-menu">
								<button onclick="cafeteria_elementor_openNav()"><i class="fa-solid fa-bars"></i></button>
							</div>
							<div id="mySidenav" class="nav sidenav">
								<nav id="site-navigation" class="main-navigation navbar navbar-expand-xl" aria-label="<?php esc_attr_e( 'Top Menu', 'cafeteria-elementor' ); ?>">
									<?php {
										wp_nav_menu(
											array(
												'theme_location' => 'primary',
												'menu_class'     => 'menu', 
												'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
												'fallback_cb' => 'wp_page_menu',
											)
										);
									} ?>
								</nav>
								<a href="javascript:void(0)" class="closebtn mobile-menu" onclick="cafeteria_elementor_closeNav()"><i class="fas fa-times"></i></a>
							</div>
						</div>
					</div>
					<div class="col-xl-1 col-lg-2 col-md-4 col-sm-4 col-7 align-self-center text-end d-flex justify-content-between">
						<?php if(!empty($cafeteria_elementor_header_top_buttonlink) ):?>
						    <p class="header-button mb-0 cart-btn">
								<a href="<?php echo esc_url($cafeteria_elementor_header_top_buttonlink);?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/bag-shopping.svg"></a>
						   	</p>
						<?php endif;?>
						<div class="header-search">
							<div class="search-container">
								<button type="button" class="search-container-button"><i class="fa-solid fa-magnifying-glass"></i></button>
							</div>
							<div class="external-search">
								<div class="internal-search">
									<?php get_search_form(); ?>
								</div>
								<button type="button" class="closepop search-container-button-close" ><span class="dashicons dashicons-no"></span></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	    <?php
	}

endif;

add_action( 'cafeteria_elementor_action_header', 'cafeteria_elementor_site_branding' );

/////////////////////////////////// copyright start /////////////////////////////

if ( ! function_exists( 'cafeteria_elementor_footer_copyright' ) ) :

	/**
	 * Footer copyright
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_footer_copyright() {

		// Check if footer is disabled.
		$cafeteria_elementor_footer_status = apply_filters( 'cafeteria_elementor_filter_footer_status', true );
		if ( true !== $cafeteria_elementor_footer_status ) {
			return;
		}

		// Copyright content.
		$cafeteria_elementor_copyright_text = cafeteria_elementor_get_option( 'cafeteria_elementor_copyright_text' );
		$cafeteria_elementor_copyright_text = apply_filters( 'cafeteria_elementor_filter_copyright_text', $cafeteria_elementor_copyright_text );
		if ( ! empty( $cafeteria_elementor_copyright_text ) ) {
			$cafeteria_elementor_copyright_text = wp_kses_data( $cafeteria_elementor_copyright_text );
		}

		// Powered by content.
		$cafeteria_elementor_powered_by_text = sprintf( __( 'Cafeteria Elementor by %s', 'cafeteria-elementor' ), '<span>' . __( 'Mizan Themes', 'cafeteria-elementor' ) . '</span>' );
		?>

		<div class="colophon-inner">
		    <?php if ( ! empty( $cafeteria_elementor_copyright_text ) ) : ?>
			    <div class="colophon-column">
			    	<div class="copyright">
						<a href="<?php echo esc_url('https://www.mizanthemes.com/products/free-coffee-wordpress-theme','cafeteria-elementor'); ?>"><?php echo $cafeteria_elementor_copyright_text; ?></a>
			    	</div><!-- .copyright -->
			    </div><!-- .colophon-column -->
		    <?php endif; ?>

		    <?php if ( ! empty( $cafeteria_elementor_powered_by_text ) ) : ?>
			    <div class="colophon-column">
			    	<div class="site-info">
						<?php echo $cafeteria_elementor_powered_by_text; ?>
			    	</div><!-- .site-info -->
			    </div><!-- .colophon-column -->
		    <?php endif; ?>
		</div><!-- .colophon-inner -->
		
	    <?php
	}

endif;

add_action( 'cafeteria_elementor_action_footer', 'cafeteria_elementor_footer_copyright', 10 );

// /////////////////////////////////sidebar//////////////////

if ( ! function_exists( 'cafeteria_elementor_add_sidebar' ) ) :

	/**
	 * Add sidebar.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_add_sidebar() {

		global $post;

		$cafeteria_elementor_global_layout = cafeteria_elementor_get_option( 'cafeteria_elementor_global_layout' );
		$cafeteria_elementor_global_layout = apply_filters( 'cafeteria_elementor_filter_theme_global_layout', $cafeteria_elementor_global_layout );

		// Check if single.
		if ( $post && is_singular() ) {
			$cafeteria_elementor_post_options = get_post_meta( $post->ID, 'cafeteria_elementor_theme_settings', true );
			if ( isset( $cafeteria_elementor_post_options['post_layout'] ) && ! empty( $cafeteria_elementor_post_options['cafeteria_elementor_post_layout'] ) ) {
				$cafeteria_elementor_global_layout = $cafeteria_elementor_post_options['cafeteria_elementor_post_layout'];
			}
		}

		// Include primary sidebar.
		if ( 'no-sidebar' !== $cafeteria_elementor_global_layout ) {
			get_sidebar();
		}
		// Include Secondary sidebar.
		switch ( $cafeteria_elementor_global_layout ) {
			case 'three-columns':
			get_sidebar( 'secondary' );
			break;

			default:
			break;
		}

		// Include Secondary sidebar 1.
		switch ( $cafeteria_elementor_global_layout ) {
			case 'four-columns':
			get_sidebar( 'secondary' );
			break;

			default:
			break;
		}

	}

endif;

add_action( 'cafeteria_elementor_action_sidebar', 'cafeteria_elementor_add_sidebar' );

//////////////////////////////////////// single page


if ( ! function_exists( 'cafeteria_elementor_add_image_in_single_display' ) ) :

	/**
	 * Add image in single post.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_add_image_in_single_display() {

		global $post;

		if ( has_post_thumbnail() ) {

			$values = get_post_meta( $post->ID, 'cafeteria_elementor_theme_settings', true );
			$cafeteria_elementor_theme_settings_single_image = isset( $values['cafeteria_elementor_single_image'] ) ? esc_attr( $values['cafeteria_elementor_single_image'] ) : '';

			if ( ! $cafeteria_elementor_theme_settings_single_image ) {
				$cafeteria_elementor_theme_settings_single_image = cafeteria_elementor_get_option( 'cafeteria_elementor_single_image' );
			}

			if ( 'disable' !== $cafeteria_elementor_theme_settings_single_image ) {
				$args = array(
					'class' => 'alignleft',
				);
				the_post_thumbnail( esc_attr( $cafeteria_elementor_theme_settings_single_image ), $args );
			}
		}

	}

endif;

add_action( 'cafeteria_elementor_single_image', 'cafeteria_elementor_add_image_in_single_display' );

if ( ! function_exists( 'cafeteria_elementor_footer_goto_top' ) ) :

	/**
	 * Go to top.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_footer_goto_top() {
        
        $cafeteria_elementor_show_scroll_to_top = cafeteria_elementor_get_option( 'cafeteria_elementor_show_scroll_to_top' );
        if ( true === $cafeteria_elementor_show_scroll_to_top ) :
			echo '<a id="scrollToTopBtn" href="#page">
				<svg id="progressCircle" width="50" height="50" aria-hidden="true">
					<circle cx="25" cy="25" r="22" stroke-width="4" fill="none"/>
				</svg>
				<i class="fa-solid fa-arrow-up"></i>
				</a>';
		endif;

	}

endif;

add_action( 'cafeteria_elementor_action_after', 'cafeteria_elementor_footer_goto_top', 20 );