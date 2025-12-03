<?php
/**
 * Related posts based on categories and tags.
 * 
 */

$cafeteria_elementor_related_posts_taxonomy = cafeteria_elementor_get_option( 'cafeteria_elementor_related_posts_taxonomy', 'category' );
$cafeteria_elementor_archive_layout = cafeteria_elementor_get_option( 'cafeteria_elementor_archive_layout' );

$cafeteria_elementor_post_args = array(
    'posts_per_page'    => 3,
    'orderby'           => 'rand',
    'post__not_in'      => array( get_the_ID() ),
);

$cafeteria_elementor_tax_terms = wp_get_post_terms( get_the_ID(), 'category' );
$cafeteria_elementor_terms_ids = array();
foreach( $cafeteria_elementor_tax_terms as $tax_term ) {
	$cafeteria_elementor_terms_ids[] = $tax_term->term_id;
}

$cafeteria_elementor_post_args['category__in'] = $cafeteria_elementor_terms_ids;

$cafeteria_elementor_related_posts = new WP_Query( $cafeteria_elementor_post_args );

if ( $cafeteria_elementor_related_posts->have_posts() ) : ?>
    <div class="related-post">
        <h3><?php echo esc_html__('Related Post' ,'cafeteria-elementor' );?></h3>
        <div class="row">
            <?php while ( $cafeteria_elementor_related_posts->have_posts() ) : $cafeteria_elementor_related_posts->the_post(); ?>
                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php $cafeteria_elementor_enable_related_post_image = cafeteria_elementor_get_option('cafeteria_elementor_enable_related_post_image');
                    if ($cafeteria_elementor_enable_related_post_image) { ?>
                      <div class="blog-img mb-2">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                        <?php endif; ?>
                      </div>
                    <?php } ?>
                    <div class="entry-content-wrapper">
                      <?php cafeteria_elementor_entry_meta_date(); ?>
                        <header class="entry-header">
                          <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        </header>
                    </div>
                    <div class="text-content">
                      <?php if ( 'full' === $cafeteria_elementor_archive_layout ) : ?>
                        <?php
                        the_content( sprintf(
                          wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'cafeteria-elementor' ), array( 'span' => array( 'class' => array() ) ) ),
                          the_title( '<span class="screen-reader-text">"', '"</span>', false )
                        ) );
                        ?>
                        <?php else : ?>
                        <?php the_excerpt(); ?>
                        <?php endif; ?>
                    </div>
                  </article>
              </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif;
wp_reset_postdata();