<?php if (get_theme_mod('coffee_tea_show_hide_product_section', true)) { ?>
    <section id="product_cat_slider" class="my-5 mx-md-0 mx-3">
        <div class="container">
            <?php if ($coffee_tea_small_heading = get_theme_mod('coffee_tea_category_small_heading')) { ?>
                <p class="text-center short_head mb-2"><?php echo esc_html($coffee_tea_small_heading); ?></p>
            <?php } ?>
            <?php if ($coffee_tea_product_heading = get_theme_mod('coffee_tea_product_heading')) { ?>
                <h2 class="text-center mb-4 text-capitalize"><?php echo esc_html($coffee_tea_product_heading); ?></h2>
            <?php } ?>

            <?php
            $coffee_tea_num_of_categories = get_theme_mod('coffee_tea_num_of_categories', '8');
            $coffee_tea_args = array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
                'number'     => $coffee_tea_num_of_categories,
                'orderby'    => 'name',
                'order'      => 'ASC',
            );
            $coffee_tea_terms = get_terms($coffee_tea_args);
            if (!empty($coffee_tea_terms) && !is_wp_error($coffee_tea_terms)) { ?>
                <div class="owl-carousel">
                    <?php $coffee_tea_i = 1; // Initialize counter for product icons
                    foreach ($coffee_tea_terms as $coffee_tea_term) : ?>
                        <div class="product_cat_box text-center py-5 px-3">
                            <div class="product-images">
                                <?php 
                                $coffee_tea_product_icon = get_theme_mod('coffee_tea_product_icon' . $coffee_tea_i, '8');
                                if (!empty($coffee_tea_product_icon)) : ?>
                                    <div class="icon">
                                        <i class="<?php echo esc_attr($coffee_tea_product_icon); ?> main-icon"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h3 class="my-2 text-capitalize"><a href="<?php echo esc_url(get_term_link($coffee_tea_term)); ?>"><?php echo esc_html($coffee_tea_term->name); ?></a></h3>
                            <p><?php echo esc_html($coffee_tea_term->description); ?></p>
                            <?php 
                            $coffee_tea_price_setting = get_theme_mod('coffee_tea_category_price_' . $coffee_tea_i, '');
                            if (!empty($coffee_tea_price_setting)) : ?>
                                <p class="price"><?php echo esc_html($coffee_tea_price_setting); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php $coffee_tea_i++; // Increment counter for next product icon
                    endforeach; ?>
                </div>
            <?php } else {
                echo '<p class="text-center">No product categories found.</p>';
            } ?>
        </div>
    </section>
<?php } ?>
