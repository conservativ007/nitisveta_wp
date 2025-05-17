<?php

/**
 * Template Name: Shop Tea Template
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
                    'taxonomy' => 'product_cat', // Укажите таксономию "product_cat" (категории товаров)
                    'field' => 'slug', // Используйте поле "slug" для поиска по slug категории
                    'terms' => ['tea'], // Укажите slug категории "сладости"
                    'operator' => 'IN', // Выберите товары, **входящие** в категорию "сладости"
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
            <div class="container max-w-[1640px] max-lg:p-0">
                <div class="relative pb-[110px] xl:pl-[210px] bg-left xl:pr-[350px] pt-5 xl:pt-16 -mt-6 overflow-hidden ">
                    <div class="object-cover h-full w-full absolute left-0 top-0 overflow-hidden">
                        <img class="h-full w-auto lg:h-auto lg:w-full relative max-w-none max-lg:left-[-20px] bottom-6" src="<?php echo get_template_directory_uri(); ?>/images/tea/bg-1.png" alt="tea">
                    </div>

                    <img class="absolute w-[237px] xl:w-[388px] left-[-110px] top-[60px] xl:top-[180px] xl:left-[40px]" src="<?php echo get_template_directory_uri(); ?>/images/tea/bg-2.png" alt="tea">
                    <img class="absolute w-[126px] xl:w-[262px] bottom-[65px] xl:bottom-[108px] right-0 xl:right-[76px]" src="<?php echo get_template_directory_uri(); ?>/images/tea/bg-4.png" alt="heart">

                    <div class="z-10 relative mb-10 xl:mb-[90px]">
                        <p class="max-xl:text-center md:text-[25px] text-[20px] mb-5 leading-6 font-title">Только настоящий, качественный китайский чай</p>
                        <p class="max-xl:pl-[120px] max-xl:pt-5 block md:text-[18px] text-sm max-xl:leading-6 leading-7">Тщательно выбранные сорта с плантаций Китая. <br class="hidden xl:block">Никакого низкопробного продукта и дешёвых заменителей </p>
                    </div>
                    <div class="z-10 relative text-right ">
                        <p class="max-xl:text-center md:text-[25px] text-[20px] mb-5  font-title">Расфасовано людьми с инвалидностью и пенсионерами</p>
                        <div class="md:text-[18px] text-sm max-xl:pr-[140px] max-xl:leading-6 leading-7">
                            <p class="hidden xl:block">Заказывая чай в инклюзивном магазине, вы дарите людям возможность <br> достойно обеспечивать себя, быть полноценными участниками общества</p>
                            <p class="xl:hidden max-xl:mt-4 pl-6">Вы дарите людям возможность обеспечивать себя, быть полноценными участниками общества</p>
                        </div>

                    </div>

                </div>
            </div>


            <div class="container">


                <div class="grid lg:grid-cols-2 2xl:grid-cols-3 gap-[10px] mb-10 -mt-8">

                    <?php while ($query->have_posts()) :
                        $query->the_post();
                        $i++; ?>

                        <?php
                        $post_id = get_the_ID();
                        $product = wc_get_product($post_id);
                        ?>

                        <?php get_template_part('template-parts/blocks/product-card-tea'); ?>
                    <?php endwhile; ?>

                </div>

                <div class=" md:grid-cols-2 grid-cols-1 hidden">
                    <div class="relative">
                        <!-- <img class="object-cover" src="<?php echo get_template_directory_uri(); ?>/images/tea/gift-1.png" alt="tea"> -->
                        <img class="absolute bottom-[-10px] left-[320px] object-cover hidden 2xl:block" src="<?php echo get_template_directory_uri(); ?>/images/tea/gift-2.png" alt="tea">
                    </div>
                    <div class="flex flex-col sm:space-y-10 space-y-5">
                        <div>
                            <p class="xl:text-[43px] sm:text-[30px] text-[22px]">
                                Китайский чай в подарочном наборе
                            </p>
                            <p class="xl:text-[28px] sm:text-[24px] text-[18px]">
                                Изготовлено людьми с инвалидностью и пенсионерами
                            </p>
                        </div>

                        <ul class="ml-[25px] list-disc xl:text-[25px] sm:text-[18px] text-[16px]">
                            <li>К чаю, шоколад ручной работы, вязаные зверята</li>
                            <li>Открытка с вашими пожеланиями</li>
                            <li>Инструкция по заварке чая</li>
                            <li>Всё создано вручную</li>
                        </ul>
                        <p class="xl:text-[25px] sm:text-[18px] text-[16px]">Уникальный подарок, и плюсик в карму</p>
                        <bottom class="border border-[#EF3343] rounded text-[#EF3343] lg:px-24 px-5 py-3 flex-shrink-0 self-start">Выбрать подарочный набор</bottom>
                    </div>
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
