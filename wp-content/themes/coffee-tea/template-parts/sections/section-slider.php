<?php 
$coffee_tea_slider = get_theme_mod('coffee_tea_slider_setting', false);

if ($coffee_tea_slider == '1') : ?>

<section id="slider-section" class="slider-area">
    <div class="container slider-content">
        <?php 

        $coffee_tea_pages = array();
        for ($coffee_tea_count = 1; $coffee_tea_count <= 5; $coffee_tea_count++) {
            $coffee_tea_mod = intval(get_theme_mod('coffee_tea_slider' . $coffee_tea_count));
            if ('page-none-selected' != $coffee_tea_mod) {
                $coffee_tea_pages[] = $coffee_tea_mod;
            }
        }

        if (!empty($coffee_tea_pages)) :
            $coffee_tea_args = array(
                'post_type' => 'page',
                'post__in' => $coffee_tea_pages,
                'orderby' => 'post__in'
            );
            $coffee_tea_query = new WP_Query($coffee_tea_args);
            if ($coffee_tea_query->have_posts()) :
                ?>
                <div id="main-slider" class="owl-carousel">
                    <?php while ($coffee_tea_query->have_posts()) : $coffee_tea_query->the_post(); ?>
                        <div class="item">
                            <div class="row">
                                <div class="col-lg-6 col-md-5 col-12 align-self-center px-3 wow fadeInRight" data-wow-delay="0.5s">
                                    <div class="sliderimg">
                                        <div class="inner_carousel pe-lg-5">
                                            <?php
                                            $coffee_tea_slider_text = get_theme_mod('coffee_tea_slider_text');
                                            if ($coffee_tea_slider_text != '') { ?>
                                                <p class="mb-3 slider-top-text text-capitalize"><?php echo esc_html(apply_filters('coffee_tea_topheader', $coffee_tea_slider_text)); ?></p>
                                            <?php } ?>
                                            <h1 class="text-capitalize mb-3">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h1>
                                            <p><?php echo esc_html(wp_trim_words(get_the_content(), '32')); ?></p>
                                            <div class="search-bg mt-4">
                                              <div class="product-search">
                                                  <div class="search_inner">
                                                      <?php if (class_exists('woocommerce')) { ?>
                                                          <?php get_product_search_form(); ?>
                                                      <?php } ?>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-7 col-12 slider-img-col align-self-center px-2 wow fadeInLeft" data-wow-delay="0.5s">
                                    <div class="sliderimg mt-5">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url(''); ?>"/>
                                        <?php else : ?>
                                            <div class="slider-color-box"></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="abt-slider-col">
                    <div class="abt-cat owl-carousel m-0">
                        <?php foreach ($coffee_tea_pages as $coffee_tea_index => $page_id) {
                            $post = get_post($page_id);
                            setup_postdata($post); 
                            $coffee_tea_class_name = 'item-' . ($coffee_tea_index + 1); // Assign a unique class name based on index
                            ?>
                            <div class="item <?php echo esc_attr($coffee_tea_class_name); ?>" data-slide-index="<?php echo esc_attr($coffee_tea_index); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="abt-imagebox">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                <?php else : ?>
                                    <div class="abt-img-color"></div>
                                <?php endif; ?>
                            </div>
                        <?php }
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php
            wp_reset_postdata();
            else : ?>
                <div class="no-postfound"></div>
            <?php endif; 
        endif; ?>
    </div>
</section>

<?php endif; ?>