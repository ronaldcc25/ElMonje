<?php
/**
 * Coffee Tea Theme Customizer.
 *
 * @package Coffee Tea
 */

 if ( ! class_exists( 'Coffee_Tea_Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 1.0.0
	 */
	class Coffee_Tea_Customizer {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object
		 */
		private static $coffee_tea_instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$coffee_tea_instance ) ) {
				self::$coffee_tea_instance = new self;
			}
			return self::$coffee_tea_instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			/**
			 * Customizer
			 */
			add_action( 'customize_preview_init',                  array( $this, 'Coffee_Tea_Customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts', 	   array( $this, 'Coffee_Tea_Customizer_script' ) );
			add_action( 'customize_register',                      array( $this, 'Coffee_Tea_Customizer_register' ) );
			add_action( 'after_setup_theme',                       array( $this, 'Coffee_Tea_Customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function Coffee_Tea_Customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';			
			
			/**
			 * Helper files
			 */
			require COFFEE_TEA_PARENT_INC_DIR . '/customizer/sanitization.php';
		}
		
		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		function Coffee_Tea_Customize_preview_js() {
			wp_enqueue_script( 'coffee-tea-customizer', COFFEE_TEA_PARENT_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
		}		
		
		function Coffee_Tea_Customizer_script() {
			 wp_enqueue_script( 'coffee-tea-customizer-section', COFFEE_TEA_PARENT_INC_URI .'/customizer/assets/js/customizer-section.js', array("jquery"),'', true  );
		}

		// Include customizer customizer settings.
			
		function Coffee_Tea_Customizer_settings() {
			require COFFEE_TEA_PARENT_INC_DIR . '/customizer/customizer-options/header.php';
			require COFFEE_TEA_PARENT_INC_DIR . '/customizer/customizer-options/frontpage.php';
			require COFFEE_TEA_PARENT_INC_DIR . '/customizer/customizer-options/footer.php';
			require COFFEE_TEA_PARENT_INC_DIR . '/customizer/customizer-options/post.php';
			require COFFEE_TEA_PARENT_INC_DIR . '/customizer/customizer-options/general.php';
			require COFFEE_TEA_PARENT_INC_DIR . '/customizer/customizer-pro/class-customize.php';
			require COFFEE_TEA_PARENT_INC_DIR . '/customizer/customizer-options/typography.php';
			require COFFEE_TEA_PARENT_INC_DIR . '/customizer/customizer-options/sidebar-option.php';
			require COFFEE_TEA_PARENT_INC_DIR . '/customizer/customizer-pro/customizer-upgrade-class.php';
		}

	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Coffee_Tea_Customizer::get_instance();