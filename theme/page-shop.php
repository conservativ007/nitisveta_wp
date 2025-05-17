<?php

/**
 * Template Name: Shop Template
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
                'posts_per_page' => 17,
                'tax_query' => [
                    [
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => [18, 41, 42],
                        'operator' => 'NOT IN',
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
            <div class="grid lg:grid-cols-2 2xl:grid-cols-3 container gap-[10px] mb-10 mt-5">
                <?php while ($query->have_posts()) :
                    $query->the_post();
                    $i++; ?>

                    <?php
                    $post_id = get_the_ID();
                    $product = wc_get_product($post_id);
                    ?>

                    <?php get_template_part('template-parts/blocks/product-card'); ?>

                    <?php if ($i == 14) : ?>
                        <div class="product-card relative bg-white shadow flex flex-col justify-center items-stretch text-center p-5">
                            <div class="font-title text-2xl md:text-4xl">
                                И ещё у нас есть книги
                            </div>

                            <div class="text-[#AAAAAA] text-base md:text-lg mt-1 md:mt-4 mb-2">
                                по философии буддизма, осознанности, медитации, йоге, психологии и саморазвитию
                            </div>

                            <img src="<?php echo get_template_directory_uri(); ?>/images/knigicatalog.png" alt="" class="">

                            <div class="mt-auto">
                                <a href="/shop-books" class="btn-border hover:bg-secondary border-secondary text-secondary h-[50px] w-full"><span>Посмотреть
                                        каталог книг</span></a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>

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
