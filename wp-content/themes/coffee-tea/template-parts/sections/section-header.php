<header class="main-header">
    <div class="container headerbox">
        <div class="<?php if( get_theme_mod( 'coffee_tea_sticky_header', '0')) { ?>sticky-header<?php } else { ?>close-sticky<?php } ?>">
            <div class="lower-header-area">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbaroffcanvase">
                        <div class="navbar-menubar responsive-menu">
                            <div class="toggle-nav mobile-menu">
                                <button onclick="coffee_tea_openNav()">
                                    <i class="fa fa-bars"></i> <!-- Initial hamburger icon -->
                                </button>
                            </div>
                            <div id="mySidenav" class="nav sidenav">
                                <nav id="site-navigation" class="main-navigation navbar navbar-expand-xl" aria-label="<?php esc_attr_e( 'Top Menu', 'coffee-tea' ); ?>">

                                    <?php 
                                        wp_nav_menu(
                                            array(
                                                'theme_location' => 'responsive-menu',
                                                'container_class' => 'main-menu clearfix',
                                                'menu_class' => 'clearfix menu',
                                                'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                                                'fallback_cb' => 'wp_page_menu',
                                            )
                                        );
                                    ?>
                                    <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="coffee_tea_closeNav()">
                                        <i class="fa fa-times"></i> <!-- Close icon for the menu -->
                                    </a>
                                </nav>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 align-self-center">
                                <div class="navbar-menubar left-menu">
                                    <nav id="site-navigation" class="main-navigation navbar navbar-expand-xl">
                                        <?php
                                        wp_nav_menu(array(
                                            'theme_location' => 'primary-left',
                                            'container_class' => 'main-menu clearfix',
                                            'menu_class' => 'menu clearfix mobile_nav',
                                            'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                                            'fallback_cb' => 'wp_page_menu',
                                        ));
                                        ?>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-2 px-0 position-relative text-center align-self-center">
                                <div class="logo <?php echo (has_custom_logo()) ? 'logo-flex' : 'logo-block'; ?>">
                                    <?php 
                                    if (has_custom_logo()) {
                                        the_custom_logo();
                                    } else {
                                        // Check if both title and tagline settings are disabled
                                        $coffee_tea_tagline_enabled = get_theme_mod('coffee_tea_tagline_setting', false);
                                        $coffee_tea_title_enabled = get_theme_mod('coffee_tea_site_title_setting', true);

                                        if (!$coffee_tea_tagline_enabled && !$coffee_tea_title_enabled) {
                                            // Display the default logo
                                            $coffee_tea_default_logo_url = get_template_directory_uri() . '/assets/images/logo.png'; // Replace with your default logo path
                                            echo '<a href="' . esc_url(home_url('/')) . '">';
                                            echo '<img src="' . esc_url($coffee_tea_default_logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                                            echo '</a>';
                                        }

                                        // Display tagline if the setting is enabled
                                        if ($coffee_tea_tagline_enabled) :
                                            $coffee_tea_site_desc = get_bloginfo('description'); ?>
                                            <p class="site-description"><?php echo esc_html($coffee_tea_site_desc); ?></p>
                                        <?php endif; ?>

                                        <?php
                                        // Display site title if the setting is enabled
                                        if ($coffee_tea_title_enabled) : ?>
                                            <p class="site-title">
                                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                                    <?php echo esc_html(get_bloginfo('name')); ?>
                                                </a>
                                            </p>
                                        <?php endif; ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-5 align-self-center">
                                <div class="navbar-menubar right-menu ps-4">
                                    <nav id="site-navigation" class="main-navigation navbar navbar-expand-xl">
                                        <?php
                                        wp_nav_menu(array(
                                            'theme_location' => 'primary-right',
                                            'container_class' => 'main-menu clearfix',
                                            'menu_class' => 'menu clearfix mobile_nav',
                                            'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                                            'fallback_cb' => 'wp_page_menu',
                                        ));
                                        ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
