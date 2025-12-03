<?php

/**
 * Wizard
 *
 * @package Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

class Whizzie {
	
	protected $version = '1.1.0';
	
	/** @var string Current theme name, used as namespace in actions. */
	protected $coffee_tea_theme_name = '';
	protected $coffee_tea_theme_title = '';
	
	/** @var string Wizard page slug and title. */
	protected $coffee_tea_page_slug = '';
	protected $coffee_tea_page_title = '';
	
	/** @var array Wizard steps set by user. */
	protected $config_steps = array();
	
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $coffee_tea_plugin_url = '';

	public $coffee_tea_plugin_path;
	public $parent_slug;
	
	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;
	
	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';
	
	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';
	
	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}
	
	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars( $config ) {
	
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['coffee_tea_page_slug'] ) ) {
			$this->coffee_tea_page_slug = esc_attr( $config['coffee_tea_page_slug'] );
		}
		if( isset( $config['coffee_tea_page_title'] ) ) {
			$this->coffee_tea_page_title = esc_attr( $config['coffee_tea_page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}
		
		$this->coffee_tea_plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->coffee_tea_plugin_path );
		$this->coffee_tea_plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$coffee_tea_current_theme = wp_get_theme();
		$this->coffee_tea_theme_title = $coffee_tea_current_theme->get( 'Name' );
		$this->coffee_tea_theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $coffee_tea_current_theme->get( 'Name' ) ) );
		$this->coffee_tea_page_slug = apply_filters( $this->coffee_tea_theme_name . '_theme_setup_wizard_coffee_tea_page_slug', $this->coffee_tea_theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->coffee_tea_theme_name . '_theme_setup_wizard_parent_slug', '' );

	}
	
	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */	
	public function init() {
		
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );
		
	}
	
	public function enqueue_scripts() {
		wp_enqueue_style( 'coffee-tea-demo-import-style', get_template_directory_uri() . '/demo-import/assets/css/demo-import-style.css');
		wp_register_script( 'coffee-tea-demo-import-script', get_template_directory_uri() . '/demo-import/assets/js/demo-import-script.js', array( 'jquery' ), time() );
		wp_localize_script( 
			'coffee-tea-demo-import-script',
			'whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'coffee-tea' )
			)
		);
		wp_enqueue_script( 'coffee-tea-demo-import-script' );
	}
	
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}
			
	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}
	
	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->coffee_tea_theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->coffee_tea_theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}
	
	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page() {
		add_theme_page( esc_html( $this->coffee_tea_page_title ), esc_html( $this->coffee_tea_page_title ), 'manage_options', $this->coffee_tea_page_slug, array( $this, 'wizard_page' ) );
	}
	
	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page() { 
		tgmpa_load_bulk_installer();

		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( esc_html__( 'Failed to find TGM', 'coffee-tea' ) );
		}

		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );
		$method = '';
		$fields = array_keys( $_POST );

		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true;
		}

		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}

		$coffee_tea_theme = wp_get_theme();
		$coffee_tea_theme_title = $coffee_tea_theme->get( 'Name' );
		$coffee_tea_theme_version = $coffee_tea_theme->get( 'Version' );

		?>
		<div class="wrap">
			<?php 
			// Theme Title and Version
			printf( '<h1>%s %s</h1>', esc_html( $coffee_tea_theme_title ), esc_html( '(Version :- ' . $coffee_tea_theme_version . ')' ) );
			?>
			
			<div class="card whizzie-wrap">

				<div class="demo_content_image">
					<div class="demo_content">
						<?php

						$coffee_tea_steps = $this->get_steps();
						echo '<ul class="whizzie-menu">';
						foreach ( $coffee_tea_steps as $coffee_tea_step ) {
							$class = 'step step-' . esc_attr( $coffee_tea_step['id'] );
							echo '<li data-step="' . esc_attr( $coffee_tea_step['id'] ) . '" class="' . esc_attr( $class ) . '">';
							printf( '<h2>%s</h2>', esc_html( $coffee_tea_step['title'] ) );

							$content = call_user_func( array( $this, $coffee_tea_step['view'] ) );
							if ( isset( $content['summary'] ) ) {
								printf(
									'<div class="summary">%s</div>',
									wp_kses_post( $content['summary'] )
								);
							}
							if ( isset( $content['detail'] ) ) {
								printf( '<p><a href="#" class="more-info">%s</a></p>', esc_html__( 'More Info', 'coffee-tea' ) );
								printf(
									'<div class="detail">%s</div>',
									wp_kses_post( $content['detail'] )
								);
							}
							if ( isset( $coffee_tea_step['button_text'] ) && $coffee_tea_step['button_text'] ) {
								printf( 
									'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
									esc_attr( $coffee_tea_step['callback'] ),
									esc_attr( $coffee_tea_step['id'] ),
									esc_html( $coffee_tea_step['button_text'] )
								);
							}
							if ( isset( $coffee_tea_step['can_skip'] ) && $coffee_tea_step['can_skip'] ) {
								printf( 
									'<div class="button-wrap" style="margin-left: 0.5em;"><a href="#" class="button button-secondary do-it" data-callback="%s" data-step="%s">%s</a></div>',
									esc_attr( 'do_next_step' ),
									esc_attr( $coffee_tea_step['id'] ),
									esc_html__( 'Skip', 'coffee-tea' )
								);
							}
							echo '</li>';
						}
						echo '</ul>';
						?>
						
						<ul class="whizzie-nav">
							<?php
							foreach ( $coffee_tea_steps as $coffee_tea_step ) {
								if ( isset( $coffee_tea_step['icon'] ) && $coffee_tea_step['icon'] ) {
									echo '<li class="nav-step-' . esc_attr( $coffee_tea_step['id'] ) . '"><span class="dashicons dashicons-' . esc_attr( $coffee_tea_step['icon'] ) . '"></span></li>';
								}
							}
							?>
						</ul>

						<div class="step-loading"><span class="spinner"></span></div>
					</div> <!-- .demo_content -->

					<div class="demo_image">
						<div class="demo_image buttons">
							<a href="<?php echo esc_url( COFFEE_TEA_PRO_THEME_URL ); ?>" class="button button-primary bundle" target="_blank"><?php echo esc_html__( 'Get Pro Theme', 'coffee-tea' ); ?></a>
							<a href="<?php echo esc_url( COFFEE_TEA_DEMO_THEME_URL ); ?>" class="button button-primary bundle pro" target="_blank"><?php echo esc_html__( 'Live Demo', 'coffee-tea' ); ?></a>
							<a href="<?php echo esc_url( COFFEE_TEA_FREE_DOCS_THEME_URL ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Free Documentation', 'coffee-tea' ); ?></a>
							<a href="<?php echo esc_url( COFFEE_TEA_SUPPORT_THEME_URL ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Support', 'coffee-tea' ); ?></a>
						</div>
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/screenshot.png' ); ?>" alt="<?php echo esc_attr( $coffee_tea_theme_title ); ?>" />
					</div> <!-- .demo_image -->

				</div> <!-- .demo_content_image -->

				<div class="bundle-getstart-div">
					<div class="bundle-getstart-img-div">
						<a target="_blank" href="<?php echo esc_url( COFFEE_TEA_THEME_BUNDLE_URL ); ?>">
							<img class="bundle-imgs" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/bundle_image.png' ); ?>" alt="<?php echo esc_attr( $coffee_tea_theme_title ); ?>" />
						</a>
					</div>
					<div class="bundle-getstart-lifetime-div">
						<h2><?php echo esc_html__( 'WordPress Theme Bundle | 50+ Premium Designs for Every Need', 'coffee-tea' ); ?></h2>
						<a class="button button-primary" target="_blank" href="<?php echo esc_url( COFFEE_TEA_THEME_BUNDLE_URL ); ?>">
							<?php echo esc_html__( 'Get All 50+ Themes @ $79', 'coffee-tea' ); ?>
						</a>
					</div>
				</div>

			</div> <!-- .whizzie-wrap -->


			<div class="about-wrappp-main-div">
				<h1 class="title" style="margin:0;"><?php esc_html_e( 'More Information', 'coffee-tea' ); ?></h1>
				<div class="about-wrappp">
					<div class="about-wrappp-boxes-div">
						<div class="about_wrappp_demo_content">
							<p class="about-description" style="margin-bottom:0;" ><?php esc_html_e( 'Quick Links:', 'coffee-tea' ); ?></p>
							<div class="feature-section two-col">
								<div class="card buy-noww" style="background:linear-gradient(to bottom,#0189f0,#024985) !important;">
									<h2 style="color:#fff;" class="title"><?php esc_html_e( 'Upgrade To Pro', 'coffee-tea' ); ?></h2>
									<p style="color:#fff;"><?php esc_html_e( 'Take a step towards excellence, try our premium theme. Use Code', 'coffee-tea' ) ?><span class="usecode"><?php esc_html_e('" STEPRO10 "', 'coffee-tea'); ?></span></p>
									<p><a  style="background: red !important;" href="<?php echo esc_url( COFFEE_TEA_PRO_THEME_URL ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Upgrade Pro', 'coffee-tea' ); ?></a></p>
								</div>

								<div class="card">
									<h2 class="title"><?php esc_html_e( 'Lite Documentation', 'coffee-tea' ); ?></h2>
									<p><?php esc_html_e( 'The free theme documentation can help you set up the theme.', 'coffee-tea' ) ?></p>
									<p><a href="<?php echo esc_url( COFFEE_TEA_FREE_DOCS_THEME_URL ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Lite Documentation', 'coffee-tea' ); ?></a></p>
								</div>

								<div class="card">
									<h2 class="title"><?php esc_html_e( 'Theme Info', 'coffee-tea' ); ?></h2>
									<p><?php esc_html_e( 'Know more about Coffee-Tea.', 'coffee-tea' ) ?></p>
									<p><a href="<?php echo esc_url( COFFEE_TEA_FREE_THEME_URL ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Theme Info', 'coffee-tea' ); ?></a></p>
								</div>

								<div class="card">
									<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'coffee-tea' ); ?></h2>
									<p><?php esc_html_e( 'You can get all theme options in customizer.', 'coffee-tea' ) ?></p>
									<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Customize', 'coffee-tea' ); ?></a></p>
								</div>

								<div class="card">
									<h2 class="title"><?php esc_html_e( 'Need Support?', 'coffee-tea' ); ?></h2>
									<p><?php esc_html_e( 'If you are having some issues with the theme or you want to tweak some thing, you can contact us our expert team will help you.', 'coffee-tea' ) ?></p>
									<p><a href="<?php echo esc_url( COFFEE_TEA_SUPPORT_THEME_URL ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Support Forum', 'coffee-tea' ); ?></a></p>
								</div>

								<div class="card">
									<h2 class="title"><?php esc_html_e( 'Review', 'coffee-tea' ); ?></h2>
									<p><?php esc_html_e( 'If you have loved our theme please show your support with the review.', 'coffee-tea' ) ?></p>
									<p><a href="<?php echo esc_url( COFFEE_TEA_RATE_THEME_URL ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Rate Us', 'coffee-tea' ); ?></a></p>
								</div>		
							</div>
						</div> <!-- .about_wrappp_demo_content -->
					</div> <!-- .about-wrappp-boxes-div -->

					<div class="about-wrappp-free-pro-div">
						<p class="about-description"><?php esc_html_e( 'View Free vs Pro Table below:', 'coffee-tea' ); ?></p>
						<div class="seo-theme-table">
							<table>
								<thead>
									<tr><th scope="col"></th>
										<th class="head" scope="col"><?php esc_html_e( 'Free Theme', 'coffee-tea' ); ?></th>
										<th class="head" scope="col"><?php esc_html_e( 'Pro Theme', 'coffee-tea' ); ?></th>
									</tr>
								</thead>
								<tbody>
								<tr class="odd" scope="row">
										<td headers="features" class="feature"><span><?php esc_html_e( 'One click demo import', 'coffee-tea' ); ?></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( '15+ Theme Sections', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-no-alt"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'Extensive Typography Settings & Color Pallets', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-no-alt"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'Fully SEO Optimized', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-no-alt"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'Expert Technical Support', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-no-alt"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'Attractive Preloader Design', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-no-alt"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'Enhanced Plugin Integration', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-no-alt"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>	
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'Custom Post Types', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-no-alt"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'High-Level Compatibility with Modern Browsers', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-no-alt"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'Real-Time Theme Customizer', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-no-alt"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'Easy Customization', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-saved"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'Regular Bug Fixes', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-saved"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'Responsive Design', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-saved"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td headers="features" class="feature"><?php esc_html_e( 'Multiple Blog Layouts', 'coffee-tea' ); ?></td>
										<td><span class="dashicons dashicons-saved"></span></td>
										<td><span class="dashicons dashicons-saved"></span></td>
									</tr>
									<tr class="odd" scope="row">
										<td class="feature feature--empty"></td>
										<td class="feature feature--empty"></td>
										<td headers="comp-2" class="td-btn-2"><a class="button button-primary bundle" href="<?php echo esc_url(COFFEE_TEA_PRO_THEME_URL);?>" target="_blank"><?php esc_html_e( 'Go for Premium', 'coffee-tea' ); ?></a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

				</div> <!-- .about-wrappp -->
			</div> <!-- .about-wrappp-main-div -->
		</div> <!-- .wrap -->
		<?php
	}


		
	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps() {
		$coffee_tea_dev_steps = $this->config_steps;
		$coffee_tea_steps = array( 
			'intro' => array(
				'id'			=> 'intro',
				'title'			=> __( 'Welcome to ', 'coffee-tea' ) . $this->coffee_tea_theme_title,
				'icon'			=> 'dashboard',
				'view'			=> 'get_step_intro',
				'callback'		=> 'do_next_step',
				'button_text'	=> __( 'Start Now', 'coffee-tea' ),
				'can_skip'		=> false
			),
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Plugins', 'coffee-tea' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'coffee-tea' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Demo Importer', 'coffee-tea' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text'	=> __( 'Import Demo Content', 'coffee-tea' ),
				'can_skip'		=> true
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'coffee-tea' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);
		
		// Iterate through each step and replace with dev config values
		if( $coffee_tea_dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from demo-import-settings.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $coffee_tea_dev_steps as $coffee_tea_dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $coffee_tea_dev_step['id'] ) ) {
					$id = $coffee_tea_dev_step['id'];
					if( isset( $coffee_tea_steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $coffee_tea_dev_step[$element] ) ) {
								$coffee_tea_steps[$id][$element] = $coffee_tea_dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $coffee_tea_steps;
	}
	
	/**
	 * Print the content for the intro step
	 */
	public function get_step_intro() { ?>
		<div class="summary">
			<div class="steps_content">
				<p>
					<?php printf(
						/* translators: %s: Theme name. */
						esc_html__('Thank you for choosing the %s theme. You will only need a few minutes to configure and launch your new website with the help of this quick setup tutorial. To begin using your website, simply follow the wizard\'s instructions.', 'coffee-tea'),
						esc_html($this->coffee_tea_theme_title)
					); ?>
				</p>
			</div>
		</div>
	<?php }

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
	$plugins = $this->get_plugins();
	$content = array(); ?>
		<div class="summary">
			<p>
				<?php esc_html_e('Additional plugins always make your website exceptional. Install these plugins by clicking the install button. You may also deactivate them from the dashboard.','coffee-tea') ?>
			</p>
		</div>
		<?php // The detail element is initially hidden from the user
		$content['detail'] = '<ul class="whizzie-do-plugins">';
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
			$keys = array();
			if ( isset( $plugins['install'][ $slug ] ) ) {
				$keys[] = 'Installation';
			}
			if ( isset( $plugins['update'][ $slug ] ) ) {
				$keys[] = 'Update';
			}
			if ( isset( $plugins['activate'][ $slug ] ) ) {
				$keys[] = 'Activation';
			}
			$content['detail'] .= implode( ' and ', $keys ) . ' required';
			$content['detail'] .= '</span></li>';
		}
		$content['detail'] .= '</ul>';
		
		return $content;
	}
	
	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets() { ?>
	<div class="summary">
		<p>
			<?php esc_html_e('This theme supports importing the demo content and adding widgets. Get them installed with the below button. Using the Customizer, it is possible to update or even deactivate them.','coffee-tea'); ?>
		</p>
	</div>
	<?php }
	
	/**
	 * Print the content for the final step
	 */
	public function get_step_done() { ?>
		<div id="coffee-tea-demo-setup-guid">
			<div class="customize_div"><?php echo esc_html( 'Now Customize your website' ); ?>
				<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="customize_link">
					<?php echo esc_html( 'Customize ' ); ?> 
					<span class="dashicons dashicons-share-alt2"></span>
				</a>
			</div>
			<div class="coffee-tea-setup-finish">
				<a target="_blank" href="<?php echo esc_url( admin_url() ); ?>" class="button button-primary">
					<?php esc_html_e( 'Go To Dashboard', 'coffee-tea' ); ?>
				</a>
				<a target="_blank" href="<?php echo esc_url( get_home_url() ); ?>" class="button button-primary">
					<?php esc_html_e( 'Preview Site', 'coffee-tea' ); ?>
				</a>
			</div>
		</div>
	<?php }


	/**
	 * Get the plugins registered with TGMPA
	 */
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}

	/**
	 * Get the widgets.wie file from the /content folder
	 * @return Mixed	Either the file or false
	 * @since 1.1.0
	 */
	public function has_widget_file() {
		if( file_exists( $this->widget_file_url ) ) {
			return true;
		}
		return false;
	}
	
	public function setup_plugins() {
		if ( ! check_ajax_referer( 'whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found','coffee-tea' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();
		
		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','coffee-tea' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','coffee-tea' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','coffee-tea' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','coffee-tea' ) ) );
		}
		exit;
	}


	public function coffee_tea_customizer_right_menu() {

		// ---------------- Create Primary Menu ---------------- //

		$coffee_tea_themename = 'Coffee Tea';
		$coffee_tea_menuname = $coffee_tea_themename . ' Primary Right';
		$coffee_tea_menu_right_location = 'primary-left';
		$coffee_tea_menu_exists = wp_get_nav_menu_object($coffee_tea_menuname);

		if (!$coffee_tea_menu_exists) {
			$coffee_tea_menu_id = wp_create_nav_menu($coffee_tea_menuname);

			// Home
			wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
				'menu-item-title' => __('Home', 'coffee-tea'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			));

			// About
			$coffee_tea_page_about = get_page_by_path('about');
			if($coffee_tea_page_about){
				wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
					'menu-item-title' => __('About', 'coffee-tea'),
					'menu-item-classes' => 'about',
					'menu-item-url' => get_permalink($coffee_tea_page_about),
					'menu-item-status' => 'publish'
				));
			}

			// Services
			$coffee_tea_page_services = get_page_by_path('services');
			if($coffee_tea_page_services){
				wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
					'menu-item-title' => __('Services', 'coffee-tea'),
					'menu-item-classes' => 'services',
					'menu-item-url' => get_permalink($coffee_tea_page_services),
					'menu-item-status' => 'publish'
				));
			}

			// Blog
			$coffee_tea_page_blog = get_page_by_path('blog');
			if($coffee_tea_page_blog){
				wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
					'menu-item-title' => __('Blog', 'coffee-tea'),
					'menu-item-classes' => 'blog',
					'menu-item-url' => get_permalink($coffee_tea_page_blog),
					'menu-item-status' => 'publish'
				));
			}

			if (!has_nav_menu($coffee_tea_menu_right_location)) {
				$coffee_tea_locations = get_theme_mod('nav_menu_locations');
				$coffee_tea_locations[$coffee_tea_menu_right_location] = $coffee_tea_menu_id;
				set_theme_mod('nav_menu_locations', $coffee_tea_locations);
			}
		}
	}

	public function coffee_tea_customizer_left_menu() {

		// ---------------- Create Primary Menu ---------------- //

		$coffee_tea_themename = 'Coffee Tea';
		$coffee_tea_menuname = $coffee_tea_themename . ' Primary Menu';
		$coffee_tea_menulocation = 'primary-right';
		$coffee_tea_menu_exists = wp_get_nav_menu_object($coffee_tea_menuname);

		if (!$coffee_tea_menu_exists) {
			$coffee_tea_menu_id = wp_create_nav_menu($coffee_tea_menuname);

			// Team
			wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
				'menu-item-title' =>  __('Team','coffee-tea'),
				'menu-item-classes' => '',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish'));

			// Classes
			wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
				'menu-item-title' =>  __('Classes','coffee-tea'),
				'menu-item-classes' => '',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish'));

			// 404 Page
			$coffee_tea_notfound = get_page_by_path('404 Page');
			if($coffee_tea_notfound){
				wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
					'menu-item-title' => __('404 Page', 'coffee-tea'),
					'menu-item-classes' => '404',
					'menu-item-url' => get_permalink($coffee_tea_notfound),
					'menu-item-status' => 'publish'
				));
			}

			// Contact Us
			$coffee_tea_page_contact = get_page_by_path('contact');
			if($coffee_tea_page_contact){
				wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
					'menu-item-title' => __('Contact Us', 'coffee-tea'),
					'menu-item-classes' => 'contact',
					'menu-item-url' => get_permalink($coffee_tea_page_contact),
					'menu-item-status' => 'publish'
				));
			}

			if (!has_nav_menu($coffee_tea_menulocation)) {
				$coffee_tea_locations = get_theme_mod('nav_menu_locations');
				$coffee_tea_locations[$coffee_tea_menulocation] = $coffee_tea_menu_id;
				set_theme_mod('nav_menu_locations', $coffee_tea_locations);
			}
		}
	}

	public function coffee_tea_customizer_nav_menu() {

		// ---------------- Create Primary Menu ---------------- //

		$coffee_tea_themename = 'Coffee Tea';
		$coffee_tea_menuname = $coffee_tea_themename . ' Respnsive Menu';
		$coffee_tea_menulocation_respnsive = 'responsive-menu';
		$coffee_tea_menu_exists = wp_get_nav_menu_object($coffee_tea_menuname);

		if (!$coffee_tea_menu_exists) {
			$coffee_tea_menu_id = wp_create_nav_menu($coffee_tea_menuname);

			// Home
			wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
				'menu-item-title' => __('Home', 'coffee-tea'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			));

			// About
			$coffee_tea_page_about = get_page_by_path('about');
			if($coffee_tea_page_about){
				wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
					'menu-item-title' => __('About', 'coffee-tea'),
					'menu-item-classes' => 'about',
					'menu-item-url' => get_permalink($coffee_tea_page_about),
					'menu-item-status' => 'publish'
				));
			}

			// Services
			$coffee_tea_page_services = get_page_by_path('services');
			if($coffee_tea_page_services){
				wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
					'menu-item-title' => __('Services', 'coffee-tea'),
					'menu-item-classes' => 'services',
					'menu-item-url' => get_permalink($coffee_tea_page_services),
					'menu-item-status' => 'publish'
				));
			}

			// Blog
			$coffee_tea_page_blog = get_page_by_path('blog');
			if($coffee_tea_page_blog){
				wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
					'menu-item-title' => __('Blog', 'coffee-tea'),
					'menu-item-classes' => 'blog',
					'menu-item-url' => get_permalink($coffee_tea_page_blog),
					'menu-item-status' => 'publish'
				));
			}

			// 404 Page
			$coffee_tea_notfound = get_page_by_path('404 Page');
			if($coffee_tea_notfound){
				wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
					'menu-item-title' => __('404 Page', 'coffee-tea'),
					'menu-item-classes' => '404',
					'menu-item-url' => get_permalink($coffee_tea_notfound),
					'menu-item-status' => 'publish'
				));
			}

			// Team
			wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
				'menu-item-title' =>  __('Team','coffee-tea'),
				'menu-item-classes' => '',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish'));

			// Classes
			wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
				'menu-item-title' =>  __('Classes','coffee-tea'),
				'menu-item-classes' => '',
				'menu-item-url' => '#',
				'menu-item-status' => 'publish'));

			// Contact Us
			$coffee_tea_page_contact = get_page_by_path('contact');
			if($coffee_tea_page_contact){
				wp_update_nav_menu_item($coffee_tea_menu_id, 0, array(
					'menu-item-title' => __('Contact Us', 'coffee-tea'),
					'menu-item-classes' => 'contact',
					'menu-item-url' => get_permalink($coffee_tea_page_contact),
					'menu-item-status' => 'publish'
				));
			}

			if (!has_nav_menu($coffee_tea_menulocation_respnsive)) {
				$coffee_tea_locations = get_theme_mod('nav_menu_locations');
				$coffee_tea_locations[$coffee_tea_menulocation_respnsive] = $coffee_tea_menu_id;
				set_theme_mod('nav_menu_locations', $coffee_tea_locations);
			}
		}
	}


	/**
	 * Imports the Demo Content
	 * @since 1.1.0
	 */
	public function setup_widgets(){

		//................................................. MENUS .................................................//
		
			// Creation of home page //
			$coffee_tea_home_content = '';
			$coffee_tea_home_title = 'Home';
			$coffee_tea_home = array(
					'post_type' => 'page',
					'post_title' => $coffee_tea_home_title,
					'post_content'  => $coffee_tea_home_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_slug' => 'home'
			);
			$coffee_tea_home_id = wp_insert_post($coffee_tea_home);

			add_post_meta( $coffee_tea_home_id, '_wp_page_template', 'templates/template-frontpage.php' );

			$coffee_tea_home = get_page_by_title( 'Home' );
			update_option( 'page_on_front', $coffee_tea_home->ID );
			update_option( 'show_on_front', 'page' );

			// Creation of blog page //
			$coffee_tea_blog_title = 'Blog';
			$coffee_tea_blog_check = get_page_by_path('blog');
			if (!$coffee_tea_blog_check) {
				$coffee_tea_blog = array(
					'post_type'    => 'page',
					'post_title'   => $coffee_tea_blog_title,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'blog'
				);
				$coffee_tea_blog_id = wp_insert_post($coffee_tea_blog);

				if (!is_wp_error($coffee_tea_blog_id)) {
					update_option('page_for_posts', $coffee_tea_blog_id);
				}
			}

			// Creation of contact us page //
			$coffee_tea_contact_title = 'Contact Us';
			$coffee_tea_contact_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$coffee_tea_contact_check = get_page_by_path('contact');
			if (!$coffee_tea_contact_check) {
				$coffee_tea_contact = array(
					'post_type'    => 'page',
					'post_title'   => $coffee_tea_contact_title,
					'post_content'   => $coffee_tea_contact_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'contact' // Unique slug for the Contact Us page
				);
				wp_insert_post($coffee_tea_contact);
			}

			// Creation of about page //
			$coffee_tea_about_title = 'About';
			$coffee_tea_about_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$coffee_tea_about_check = get_page_by_path('about');
			if (!$coffee_tea_about_check) {
				$coffee_tea_about = array(
					'post_type'    => 'page',
					'post_title'   => $coffee_tea_about_title,
					'post_content'   => $coffee_tea_about_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'about' // Unique slug for the About page
				);
				wp_insert_post($coffee_tea_about);
			}

			// Creation of services page //
			$coffee_tea_services_title = 'Services';
			$coffee_tea_services_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$coffee_tea_services_check = get_page_by_path('services');
			if (!$coffee_tea_services_check) {
				$coffee_tea_services = array(
					'post_type'    => 'page',
					'post_title'   => $coffee_tea_services_title,
					'post_content'   => $coffee_tea_services_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'services' // Unique slug for the Services page
				);
				wp_insert_post($coffee_tea_services);
			}

			// Creation of 404 page //
			$coffee_tea_notfound_title = '404 Page';
			$coffee_tea_notfound = array(
				'post_type'   => 'page',
				'post_title'  => $coffee_tea_notfound_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug'   => '404'
			);
			$coffee_tea_notfound_id = wp_insert_post($coffee_tea_notfound);
			add_post_meta($coffee_tea_notfound_id, '_wp_page_template', '404.php');


			$coffee_tea_slider_title = 'We Have Dialysis Food 1';
			$coffee_tea_slider_content = 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration';
			$coffee_tea_slider_check = get_page_by_path('slider-page');

			// Check if the page already exists, if not, create the page
			if (!$coffee_tea_slider_check) {
				// Insert the page
				$coffee_tea_slider = array(
					'post_type'   => 'page',
					'post_title'  => $coffee_tea_slider_title,
					'post_content'  => $coffee_tea_slider_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_name'   => 'slider-page'
				);
				
				// Insert the post (page)
				$page_id = wp_insert_post($coffee_tea_slider);
				
				// Get the image URL (replace 'slider.png' with the actual path to the image)
				$image_path = get_template_directory() . '/assets/images/slider.png';  // Path to your image in theme folder
				
				// If the image exists, upload it to the media library and set it as the featured image
				if (file_exists($image_path)) {
					// Upload the image
					$upload = wp_upload_bits('slider.png', null, file_get_contents($image_path));
					
					// Check if the upload was successful
					if (!$upload['error']) {
						// Create an attachment post
						$attachment = array(
							'guid' => $upload['url'], 
							'post_mime_type' => 'image/png',
							'post_title' => basename($image_path),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						
						// Insert the attachment into the media library
						$attachment_id = wp_insert_attachment($attachment, $upload['file'], $page_id);
						
						// Generate the metadata for the attachment
						$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
						wp_update_attachment_metadata($attachment_id, $attachment_data);
						
						// Set the image as the featured image for the page
						set_post_thumbnail($page_id, $attachment_id);
					}
				}
			}

			$coffee_tea_slider_title = 'We Have Dialysis Food 2';
			$coffee_tea_slider_content = 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration';
			$coffee_tea_slider_check = get_page_by_path('slider-pages');

			// Check if the page already exists, if not, create the page
			if (!$coffee_tea_slider_check) {
				// Insert the page
				$coffee_tea_slider = array(
					'post_type'   => 'page',
					'post_title'  => $coffee_tea_slider_title,
					'post_content'  => $coffee_tea_slider_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_name'   => 'slider-pages'
				);
				
				// Insert the post (page)
				$page_id = wp_insert_post($coffee_tea_slider);
				
				// Get the image URL (replace 'slider2.png' with the actual path to the image)
				$image_path = get_template_directory() . '/assets/images/slider2.png';  // Path to your image in theme folder
				
				// If the image exists, upload it to the media library and set it as the featured image
				if (file_exists($image_path)) {
					// Upload the image
					$upload = wp_upload_bits('slider2.png', null, file_get_contents($image_path));
					
					// Check if the upload was successful
					if (!$upload['error']) {
						// Create an attachment post
						$attachment = array(
							'guid' => $upload['url'], 
							'post_mime_type' => 'image/png',
							'post_title' => basename($image_path),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						
						// Insert the attachment into the media library
						$attachment_id = wp_insert_attachment($attachment, $upload['file'], $page_id);
						
						// Generate the metadata for the attachment
						$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
						wp_update_attachment_metadata($attachment_id, $attachment_data);
						
						// Set the image as the featured image for the page
						set_post_thumbnail($page_id, $attachment_id);
					}
				}
			}

			$coffee_tea_slider_title = 'We Have Dialysis Food 3';
			$coffee_tea_slider_content = 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration';
			$coffee_tea_slider_check = get_page_by_path('slider-pagess');

			// Check if the page already exists, if not, create the page
			if (!$coffee_tea_slider_check) {
				// Insert the page
				$coffee_tea_slider = array(
					'post_type'   => 'page',
					'post_title'  => $coffee_tea_slider_title,
					'post_content'  => $coffee_tea_slider_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_name'   => 'slider-pagess'
				);
				
				// Insert the post (page)
				$page_id = wp_insert_post($coffee_tea_slider);
				
				// Get the image URL (replace 'slider3.png' with the actual path to the image)
				$image_path = get_template_directory() . '/assets/images/slider3.png';  // Path to your image in theme folder
				
				// If the image exists, upload it to the media library and set it as the featured image
				if (file_exists($image_path)) {
					// Upload the image
					$upload = wp_upload_bits('slider3.png', null, file_get_contents($image_path));
					
					// Check if the upload was successful
					if (!$upload['error']) {
						// Create an attachment post
						$attachment = array(
							'guid' => $upload['url'], 
							'post_mime_type' => 'image/png',
							'post_title' => basename($image_path),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						
						// Insert the attachment into the media library
						$attachment_id = wp_insert_attachment($attachment, $upload['file'], $page_id);
						
						// Generate the metadata for the attachment
						$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
						wp_update_attachment_metadata($attachment_id, $attachment_data);
						
						// Set the image as the featured image for the page
						set_post_thumbnail($page_id, $attachment_id);
					}
				}
			}

			$coffee_tea_slider_title = 'We Have Dialysis Food 4';
			$coffee_tea_slider_content = 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration';
			$coffee_tea_slider_check = get_page_by_path('slider-pagesss');

			// Check if the page already exists, if not, create the page
			if (!$coffee_tea_slider_check) {
				// Insert the page
				$coffee_tea_slider = array(
					'post_type'   => 'page',
					'post_title'  => $coffee_tea_slider_title,
					'post_content'  => $coffee_tea_slider_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_name'   => 'slider-pagesss'
				);
				
				// Insert the post (page)
				$page_id = wp_insert_post($coffee_tea_slider);
				
				// Get the image URL (replace 'slider4.png' with the actual path to the image)
				$image_path = get_template_directory() . '/assets/images/slider4.png';  // Path to your image in theme folder
				
				// If the image exists, upload it to the media library and set it as the featured image
				if (file_exists($image_path)) {
					// Upload the image
					$upload = wp_upload_bits('slider4.png', null, file_get_contents($image_path));
					
					// Check if the upload was successful
					if (!$upload['error']) {
						// Create an attachment post
						$attachment = array(
							'guid' => $upload['url'], 
							'post_mime_type' => 'image/png',
							'post_title' => basename($image_path),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						
						// Insert the attachment into the media library
						$attachment_id = wp_insert_attachment($attachment, $upload['file'], $page_id);
						
						// Generate the metadata for the attachment
						$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
						wp_update_attachment_metadata($attachment_id, $attachment_data);
						
						// Set the image as the featured image for the page
						set_post_thumbnail($page_id, $attachment_id);
					}
				}
			}

			$coffee_tea_slider_title = 'We Have Dialysis Food 5';
			$coffee_tea_slider_content = 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration';
			$coffee_tea_slider_check = get_page_by_path('slider-pagessss');

			// Check if the page already exists, if not, create the page
			if (!$coffee_tea_slider_check) {
				// Insert the page
				$coffee_tea_slider = array(
					'post_type'   => 'page',
					'post_title'  => $coffee_tea_slider_title,
					'post_content'  => $coffee_tea_slider_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_name'   => 'slider-pagessss'
				);
				
				// Insert the post (page)
				$page_id = wp_insert_post($coffee_tea_slider);
				
				// Get the image URL (replace 'slider5.png' with the actual path to the image)
				$image_path = get_template_directory() . '/assets/images/slider5.png';  // Path to your image in theme folder
				
				// If the image exists, upload it to the media library and set it as the featured image
				if (file_exists($image_path)) {
					// Upload the image
					$upload = wp_upload_bits('slider5.png', null, file_get_contents($image_path));
					
					// Check if the upload was successful
					if (!$upload['error']) {
						// Create an attachment post
						$attachment = array(
							'guid' => $upload['url'], 
							'post_mime_type' => 'image/png',
							'post_title' => basename($image_path),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						
						// Insert the attachment into the media library
						$attachment_id = wp_insert_attachment($attachment, $upload['file'], $page_id);
						
						// Generate the metadata for the attachment
						$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
						wp_update_attachment_metadata($attachment_id, $attachment_data);
						
						// Set the image as the featured image for the page
						set_post_thumbnail($page_id, $attachment_id);
					}
				}
			}

					
		/* -------------- Header ------------------*/
			
			set_theme_mod('coffee_tea_call_text', 'PHONE');
			set_theme_mod('coffee_tea_call', '92 666 888 0000');
			set_theme_mod('coffee_tea_mail_text', 'EMAIL');
			set_theme_mod('coffee_tea_mail', 'yogathemes@example.com');
			set_theme_mod('coffee_tea_slider_setting', true);
			set_theme_mod('cafe_coffee_charm_our_products_show_hide_section', true);
			

			set_theme_mod('cafe_coffee_charm_category_small_heading', 'OFFERED MENU\'S');
			set_theme_mod('cafe_coffee_charm_product_heading', 'Our Category');

		/* -------------- Slider ------------------*/
	
			set_theme_mod('coffee_tea_slider_text', 'Welcome Restaurant');
 

		/* -------------- Services ------------------*/

			set_theme_mod('coffee_tea_category_small_heading', 'OFFERED MENUS');
			set_theme_mod('coffee_tea_product_heading', 'Our Category');

			$iconbox_icon = array('fas fa-mug-hot','fas fa-coffee','fas fa-birthday-cake','fas fa-pizza-slice','fas fa-cloud-meatball','fas fa-stroopwafel','fas fa-cookie','fas fa-cheese');
			$iconbox_price = array('$43','$44','$45','$46','$47','$48','$49','$50');
		    for($i=1; $i<=8; $i++) {
				set_theme_mod( 'coffee_tea_product_icon'.$i, $iconbox_icon[$i-1] );
				set_theme_mod( 'coffee_tea_category_price_'.$i, $iconbox_price[$i-1] );
			}

			$coffee_tea_sliders = array('slider-page', 'slider-pagess', 'slider-pages', 'slider-pagesss', 'slider-pagessss');

			for ($i = 0; $i < count($coffee_tea_sliders); $i++) {
				$page = get_page_by_path($coffee_tea_sliders[$i]);

				if ($page) {
					set_theme_mod('coffee_tea_slider' . ($i + 1), $page->ID);
				} else {
					set_theme_mod('coffee_tea_slider' . ($i + 1), 0);
				}
			}


		/* -------------- Products ------------------*/

			$coffee_tea_uncategorized_term = get_term_by('name', 'Uncategorized', 'product_cat');
			if ($coffee_tea_uncategorized_term) {
				wp_delete_term($coffee_tea_uncategorized_term->term_id, 'product_cat');
			}

			$coffee_tea_product_category = array(
				'Pizza' => array(
				),
				'Sushi' => array(
				),
				'Hamburguesas' => array(
				),
				'Veggie' => array(
				),
				'Sopas' => array(
				),
				'Postres' => array(
				),
				'Cappacino' => array(
				),
				'Coffee' => array(
					'Vienna Coffee',
					'Frapuccino',
					'Cold Brew',
					'Nitro Cold Brew'
				)
			);

			$k = 1;
			foreach ($coffee_tea_product_category as $coffee_tea_product_cats => $coffee_tea_products_name) {

				// Insert product cats Start
				$content = 'Lorem ipsum dolor sit amet';
				$parent_category = wp_insert_term(
					$coffee_tea_product_cats, // the term
					'product_cat', // the taxonomy
					array(
						'description' => $content,
						'slug' => 'product_cat' . $k
					)
				);

				$image_url = get_template_directory_uri() . '/assets/images/cat/services' . $k . '.png';

				$coffee_tea_image_name = 'services' . $k . '.png';
				$upload_dir = wp_upload_dir();
				// Set upload folder
				$coffee_tea_image_data = file_get_contents($image_url);
				// Get image data
				$unique_file_name = wp_unique_filename($upload_dir['path'], $coffee_tea_image_name);
				// Generate unique name
				$filename = basename($unique_file_name);
				// Create image file name

				// Check folder permission and define file location
				if (wp_mkdir_p($upload_dir['path'])) {
					$file = $upload_dir['path'] . '/' . $filename;
				} else {
					$file = $upload_dir['basedir'] . '/' . $filename;
				}

				// Create the image file on the server
				if (!function_exists('WP_Filesystem')) {
					require_once(ABSPATH . 'wp-admin/includes/file.php');
				}

				WP_Filesystem();
				global $wp_filesystem;

				if (!$wp_filesystem->put_contents($file, $coffee_tea_image_data, FS_CHMOD_FILE)) {
					wp_die('Error saving file!');
				}

				// Check image file type
				$wp_filetype = wp_check_filetype($filename, null);

				// Set attachment data
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title'     => sanitize_file_name($filename),
					'post_content'   => '',
					'post_type'      => 'product',
					'post_status'    => 'inherit'
				);

				// Create the attachment
				$attach_id = wp_insert_attachment($attachment, $file, $post_id);

				// Include image.php
				require_once(ABSPATH . 'wp-admin/includes/image.php');

				// Define attachment metadata
				$attach_data = wp_generate_attachment_metadata($attach_id, $file);

				// Assign metadata to attachment
				wp_update_attachment_metadata($attach_id, $attach_data);

				update_woocommerce_term_meta($parent_category['term_id'], 'thumbnail_id', $attach_id);

				// Create Product START
				foreach ($coffee_tea_products_name as $key => $coffee_tea_product_title) {

					$content = 'Te obtinuit ut adepto satis somno.';
					// Create post object
					$my_post = array(
						'post_title'   => wp_strip_all_tags($coffee_tea_product_title),
						'post_content' => $content,
						'post_status'  => 'publish',
						'post_type'    => 'product',
					);

					// Insert the post into the database
					$post_id = wp_insert_post($my_post);

					wp_set_object_terms($post_id, 'product_cat' . $k, 'product_cat', true);

					update_post_meta($post_id, '_regular_price', '52'); // Set regular price  
					update_post_meta($post_id, '_sale_price', '32'); // Set sale price
					update_post_meta($post_id, '_price', '32'); // Set current price (sale price is applied)

					// Now replace meta with new updated value array
					$image_url = get_template_directory_uri() . '/assets/images/' . str_replace(" ", "-", $coffee_tea_product_title) . '.png';

					echo $image_url . "<br>";

					$coffee_tea_image_name = $coffee_tea_product_title . '.png';
					$upload_dir = wp_upload_dir();
					// Set upload folder
					$coffee_tea_image_data = file_get_contents(esc_url($image_url));

					// Get image data
					$unique_file_name = wp_unique_filename($upload_dir['path'], $coffee_tea_image_name);
					// Generate unique name
					$filename = basename($unique_file_name);
					// Create image file name

					// Check folder permission and define file location
					if (wp_mkdir_p($upload_dir['path'])) {
						$file = $upload_dir['path'] . '/' . $filename;
					} else {
						$file = $upload_dir['basedir'] . '/' . $filename;
					}

					// Create the image file on the server
					if (!function_exists('WP_Filesystem')) {
						require_once(ABSPATH . 'wp-admin/includes/file.php');
					}

					WP_Filesystem();
					global $wp_filesystem;

					if (!$wp_filesystem->put_contents($file, $coffee_tea_image_data, FS_CHMOD_FILE)) {
						wp_die('Error saving file!');
					}

					// Check image file type
					$wp_filetype = wp_check_filetype($filename, null);

					// Set attachment data
					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name($filename),
						'post_type'      => 'product',
						'post_status'    => 'inherit',
					);

					// Create the attachment
					$attach_id = wp_insert_attachment($attachment, $file, $post_id);

					// Include image.php
					require_once(ABSPATH . 'wp-admin/includes/image.php');

					// Define attachment metadata
					$attach_data = wp_generate_attachment_metadata($attach_id, $file);

					// Assign metadata to attachment
					wp_update_attachment_metadata($attach_id, $attach_data);

					// And finally assign featured image to post
					set_post_thumbnail($post_id, $attach_id);
				}
				// Create product END
				++$k;
			}


        
		$this->coffee_tea_customizer_left_menu();
        $this->coffee_tea_customizer_right_menu();
        $this->coffee_tea_customizer_nav_menu();
		
	    exit;
	}
}