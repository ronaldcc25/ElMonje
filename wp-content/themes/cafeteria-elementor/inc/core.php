<?php
/**
 * Core functions.
 *
 * @package cafeteria_elementor
 */

if ( ! function_exists( 'cafeteria_elementor_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function cafeteria_elementor_get_option( $key ) {

		$cafeteria_elementor_default_options = cafeteria_elementor_get_default_theme_options();

		if ( empty( $key ) ) {
			return;
		}

		$cafeteria_elementor_theme_options = (array)get_theme_mod( 'theme_options' );
		$cafeteria_elementor_theme_options = wp_parse_args( $cafeteria_elementor_theme_options, $cafeteria_elementor_default_options );

		$cafeteria_elementor_value = null;

		if ( isset( $cafeteria_elementor_theme_options[ $key ] ) ) {
			$cafeteria_elementor_value = $cafeteria_elementor_theme_options[ $key ];
		}

		return $cafeteria_elementor_value;

	}

endif;

if ( ! function_exists( 'cafeteria_elementor_get_options' ) ) :

	/**
	 * Get all theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Theme options.
	 */
  function cafeteria_elementor_get_options() {

    $cafeteria_elementor_default_options = cafeteria_elementor_get_default_theme_options();
    $cafeteria_elementor_theme_options = (array)get_theme_mod( 'theme_options' );
    $cafeteria_elementor_theme_options = wp_parse_args( $cafeteria_elementor_theme_options, $cafeteria_elementor_default_options );
    return $cafeteria_elementor_theme_options;

  }

endif;

if( ! function_exists( 'cafeteria_elementor_exclude_category_in_blog_page' ) ) :

  /**
   * Exclude category in blog page.
   *
   * @since 1.0
   */
  function cafeteria_elementor_exclude_category_in_blog_page( $query ) {

    if( $query->is_home && $query->is_main_query()   ) {
      $cafeteria_elementor_exclude_categories = cafeteria_elementor_get_option( 'exclude_categories' );
      if ( ! empty( $cafeteria_elementor_exclude_categories ) ) {
        $cats = explode( ',', $cafeteria_elementor_exclude_categories );
        $cats = array_filter( $cats, 'is_numeric' );
        $cafeteria_elementor_string_exclude = '';
        if ( ! empty( $cats ) ) {
          $cafeteria_elementor_string_exclude = '-' . implode( ',-', $cats);
          $query->set( 'cat', $cafeteria_elementor_string_exclude );
        }
      }
    }
    return $query;
  }

endif;

add_filter( 'pre_get_posts', 'cafeteria_elementor_exclude_category_in_blog_page' );
