<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cafeteria_elementor
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header>
				<?php  ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content' ); ?>
				<?php endwhile; ?>

				<?php
				$cafeteria_elementor_enable_post_navigation = cafeteria_elementor_get_option('cafeteria_elementor_enable_post_navigation');
				if ($cafeteria_elementor_enable_post_navigation) { ?>
				<div class="navigation">
		            <?php
			            the_posts_pagination( array(
			                'prev_text'          => __( 'Previous page', 'cafeteria-elementor' ),
			                'next_text'          => __( 'Next page', 'cafeteria-elementor' ),
			                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'cafeteria-elementor' ) . ' </span>',
			            ) );
			            ?>
			            <div class="clearfix"></div>
			    </div>
				<?php } ?>
			<?php
			/**
			 * Hook - cafeteria_elementor_action_posts_navigation.
			 *
			 * @hooked: cafeteria_elementor_custom_posts_navigation - 10
			 */
			do_action( 'cafeteria_elementor_action_posts_navigation' ); ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</main>
	</div>
	<?php
		/**
		 * Hook - cafeteria_elementor_action_sidebar.
		 *
		 * @hooked: cafeteria_elementor_add_sidebar - 10
		 */
		do_action( 'cafeteria_elementor_action_sidebar' );
	?>
<?php get_footer(); ?>
