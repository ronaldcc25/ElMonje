<?php
/**
 * Help Panel.
 *
 */
?>
<!-- Help file panel -->
<div id="help-panel" class="panel-left">
    <div class="panel-aside">
        <h4><?php esc_html_e( 'Theme Customizer', 'cafeteria-elementor' ); ?></h4>
        <p><?php esc_html_e( 'To begin customizing your website, start by clicking "Customize"', 'cafeteria-elementor' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( admin_url('customize.php') ); ?>" title="<?php esc_attr_e( 'Visit the Demo', 'cafeteria-elementor' ); ?>" target="_blank">
            <?php esc_html_e( 'Customizing', 'cafeteria-elementor' ); ?>
        </a>
    </div><!-- .panel-aside -->

    <div class="panel-aside">
        <h4><?php esc_html_e( 'Documentation', 'cafeteria-elementor' ); ?></h4>
        <p><?php esc_html_e( 'Explore the comprehensive guide and instructions for this WordPress Theme. Begin your journey with assurance.', 'cafeteria-elementor' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( CAFETERIA_ELEMENTOR_DOCUMENTATION ); ?>" title="<?php esc_attr_e( 'Visit the doc', 'cafeteria-elementor' ); ?>" target="_blank">
            <?php esc_html_e( 'Documentation', 'cafeteria-elementor' ); ?>
        </a>
    </div><!-- .panel-aside -->

    <div class="panel-aside">
        <h4><?php esc_html_e( 'Support Ticket', 'cafeteria-elementor' ); ?></h4>
        <p><?php esc_html_e( 'Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme', 'cafeteria-elementor' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( CAFETERIA_ELEMENTOR_SUPPORT ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'cafeteria-elementor' ); ?>" target="_blank">
            <?php esc_html_e( 'Contact Support', 'cafeteria-elementor' ); ?>
        </a>
    </div><!-- .panel-aside -->

    <div class="panel-aside">
        <h4><?php esc_html_e( 'Reviews & Testimonials', 'cafeteria-elementor' ); ?></h4>
        <p><?php esc_html_e( 'All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'cafeteria-elementor' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( CAFETERIA_ELEMENTOR_REVIEW ); ?>" title="<?php esc_attr_e( 'Visit the Demo', 'cafeteria-elementor' ); ?>" target="_blank">
            <?php esc_html_e( 'Review', 'cafeteria-elementor' ); ?>
        </a>
    </div><!-- .panel-aside -->
</div>