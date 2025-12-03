<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cafeteria_elementor
 */
$cafeteria_elementor_archive_layout = cafeteria_elementor_get_option( 'cafeteria_elementor_archive_layout' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php $cafeteria_elementor_archive_layout = cafeteria_elementor_get_option( 'cafeteria_elementor_archive_layout' );
		$cafeteria_elementor_show_post_image = cafeteria_elementor_get_option( 'cafeteria_elementor_show_post_featured_image_setting' );
		if ( true === $cafeteria_elementor_show_post_image ) { ?>
			<div class="blog-img">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php
					$cafeteria_elementor_archive_image           = cafeteria_elementor_get_option( 'cafeteria_elementor_archive_image' );
					$cafeteria_elementor_archive_image_alignment = cafeteria_elementor_get_option( 'cafeteria_elementor_archive_image_alignment' );
					?>
					<?php if ( 'disable' !== $cafeteria_elementor_archive_image ) : ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( esc_attr( $cafeteria_elementor_archive_image ), array( 'class' => 'align'. esc_attr( $cafeteria_elementor_archive_image_alignment ) ) ); ?></a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php }?>
		<div class="entry-content-wrapper">
			<?php cafeteria_elementor_entry_meta_date(); ?>
			<?php $cafeteria_elementor_show_post_heading = cafeteria_elementor_get_option( 'cafeteria_elementor_show_post_heading_setting' );
			if ( true === $cafeteria_elementor_show_post_heading ) { ?>
				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				</header>
			<?php } ?>
			<footer class="entry-footer">
				<?php cafeteria_elementor_entry_footer(); ?>
			</footer>
		</div>
		<?php $cafeteria_elementor_show_post_content = cafeteria_elementor_get_option( 'cafeteria_elementor_show_post_content_setting' );
		if ( true === $cafeteria_elementor_show_post_content ) { ?>
			<div class="text-content">
				<?php if ( 'full' === $cafeteria_elementor_archive_layout ) : ?>
					<?php
					the_content( sprintf(
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'cafeteria-elementor' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
					?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cafeteria-elementor' ),
							'after'  => '</div>',
						) );
					?>
			    <?php else : ?>
					<?php the_excerpt(); ?>
			    <?php endif; ?>
			</div>
		<?php } ?>
</article>