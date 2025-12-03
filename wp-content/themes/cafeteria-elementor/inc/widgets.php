<?php
/**
 * Theme widgets.
 *
 * @package cafeteria_elementor
 */

if ( ! function_exists( 'cafeteria_elementor_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function cafeteria_elementor_load_widgets() {

		// Social widget.
		register_widget( 'Cafeteria_Elementor_Social_Widget' );

	}

endif;

add_action( 'widgets_init', 'cafeteria_elementor_load_widgets' );

if ( ! class_exists( 'Cafeteria_Elementor_Social_Widget' ) ) :

	/**
	 * Social widget Class.
	 *
	 * @since 1.0.0
	 */
	class Cafeteria_Elementor_Social_Widget extends cafeteria_elementor_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'cafeteria_elementor_widget_social',
				'description'                 => __( 'Displays social icons.', 'cafeteria-elementor' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'cafeteria-elementor' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				);

			if ( false === has_nav_menu( 'social' ) ) {
				$fields['message'] = array(
					'label' => __( 'Social menu is not set. Please create menu and assign it to Social Menu.', 'cafeteria-elementor' ),
					'type'  => 'message',
					'class' => 'widefat',
					);
			}

			parent::__construct( 'cafeteria-elementor-social', __( 'Social Widget', 'cafeteria-elementor' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container'      => false,
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			}

			echo $args['after_widget'];

		}
	}
endif;
