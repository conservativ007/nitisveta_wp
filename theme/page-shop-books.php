<?php

/**
 * Template Name: Shop Books Template
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
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 15,
            'tax_query'     => array(array(
                'taxonomy'  => 'product_cat',
                'field'     => 'term_id',
                'terms'     => array(18),
                'operator'  => 'IN',
            )),
            "facetwp" => true
        );
        $i = 1;
        $query = new WP_Query($args); ?>

        <div class="container ">

            <div class="bg-white shadow flex flex-col xl:flex-row xl:justify-start rounded-[10px] xl:items-center relative min-h-[215px] mb-3">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bookmarks-image.png" class="bottom-0 left-0 max-xl:order-2 max-xl:max-h-28 max-xl:w-auto self-start">

                <div class="p-5 xl:p-0 xl:ml-16">
                    <div class="text-base text-center xl:text-left xl:text-[23px] font-title">
                        При покупке 2-х и более книг, в подарок, закладка из натуральной бересты, <br class="max-xl:hidden"> с нашим авторским узором, выполненная вручную.
                    </div>

                    <!-- <a href="#" class="btn-border max-xl:text-sm h-[50px] mt-4 max-w-xs max-xl:mx-auto"><span>Подробнее о закладках для книг</span></a> -->
                </div>

            </div>

        </div>

        <?php if ($query->have_posts()) : ?>
            <div class="grid lg:grid-cols-2 container gap-[10px] mb-10">
                <?php while ($query->have_posts()) : $query->the_post();
                    $i++; ?>

                    <?php
                    $post_id = get_the_ID();
                    $product = wc_get_product($post_id);
                    ?>

                    <?php get_template_part('template-parts/blocks/product-card-horizontal'); ?>

                    <?php if ($i == 14) : ?>
                        <div class="product-card relative bg-white shadow flex flex-col justify-center items-stretch text-center p-5">
                            <div class="font-title text-2xl md:text-4xl">
                                И ещё у нас есть товары
                            </div>

                            <div class="text-[#AAAAAA] text-base md:text-lg mt-1 md:mt-4 mb-2">
                                Покупая в этом магазине, вы помогаете людям с ограниченными возможностями, инвалидностью или
                                оказавшимся в трудной жизненной ситуации.
                            </div>

                            <ul class="font-title text-base md:text-xl mt-1 md:mt-4 mb-4">
                                <li>Ручная работа</li>
                                <li>Экологичные материалы</li>
                                <li>Этичное производство</li>
                                <li>Изготовленные людьми с ограниченными возможностями</li>
                            </ul>

                            <div class="mt-auto">
                                <a href="/shop" class="btn-border hover:bg-secondary border-secondary text-secondary h-[50px] w-full"><span>Посмотреть каталог товаров</span></a>
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
