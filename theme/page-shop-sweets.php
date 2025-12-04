<?php

/**
 * Template Name: Shop Sweets Template
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Нити_Света
 */

get_header();
?>

<section id="primary">

    <main id="main">


        <?php
        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1,
            // 'posts_per_page' => 17,
            'tax_query' => [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => ['sladosti'],
                    'operator' => 'IN',
                ]
            ],
            'meta_query' => [
                [
                    'key' => '_stock_status',
                    'value' => 'instock',
                ],
            ],
            'facetwp' => true
        ];
$query = new WP_Query($args);
$i = 0;
?>

        <?php if ($query->have_posts()) : ?>
            
            
            <div class="container">
                <!-- <div class="max-w-[1610px] m-auto mb-5"><?php get_template_part('template-parts/banner/holidays'); ?></div> -->
                <div class="grid sm:grid-cols-3 grid-cols-1 sm:gap-2 gap-1">
                    <div class="relative flex justify-center items-center ">
                        <img class="h-[144px] object-cover rounded-xl" src="<?php echo get_template_directory_uri(); ?>/images/sweets1.png" alt="">
                        <p class="absolute xl:text-[30px] lg:text-[25px] md:text-[18px] sm:text-[16px] text-[20px] text-white ">Ручная работа</p>
                    </div>
                    <div class="relative flex justify-center items-center">
                        <img class="h-[144px] object-cover rounded-xl" src="<?php echo get_template_directory_uri(); ?>/images/sweets2.png" alt="">
                        <p class="absolute xl:text-[30px] lg:text-[25px] md:text-[18px] sm:text-[16px] text-[20px] text-white">Натуральные ингредиенты</p>
                    </div>
                    <div class="relative flex justify-center items-center">
                        <img class="h-[144px] object-cover rounded-xl" src="<?php echo get_template_directory_uri(); ?>/images/sweets3.png" alt="">
                        <p class="absolute xl:text-[30px] lg:text-[25px] md:text-[18px] sm:text-[16px] text-[20px] text-white">Уникальные вкусы</p>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 2xl:grid-cols-3 gap-[10px] mb-10 mt-5">

                    <?php while ($query->have_posts()) :
                        $query->the_post();
                        $i++; ?>

                        <?php
                        $post_id = get_the_ID();
                        $product = wc_get_product($post_id);
                        ?>

                        <?php get_template_part('template-parts/blocks/product-card-sweets'); ?>
                    <?php endwhile; ?>

                </div>
            </div>
            <?php wp_reset_postdata(); ?>

        <?php else : ?>
        <?php endif; ?>

        <div class="col-span-1 lg:col-span-2 xl:col-span-3">
            <div class="max-w-[533px] mx-auto mt-8">
                <?php echo do_shortcode('[facetwp facet="loadmore"]'); ?>
            </div>
        </div>


    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
