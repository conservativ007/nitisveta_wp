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
        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1,
            // 'posts_per_page' => 15,
            'tax_query' => [[
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => [18],
                'operator' => 'IN',
            ]],
            'meta_query' => [
                [
                    'key' => '_stock_status',
                    'value' => 'instock',
                ],
            ],
            'facetwp' => true
        ];
$i = 1;
$flag = true;
$query = new WP_Query($args); ?>

        <div class="container">
            <!-- <div class="mb-5">
                <?php get_template_part('template-parts/banner/holidays'); ?>
            </div> -->
        
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

            <!-- descktop -->
                <div class="hidden 2xl:flex product-card relative bg-white shadow flex-row rounded-[10px] border border-[#EEEEEE]">
                    <div class="m-0 mt-0 max-w-[326px] w-full h-full flex items-center"> 
                        <img class="block pt-2 pb-2 pl-2 w-full h-auto " src="<?php echo get_template_directory_uri(); ?>/images/books/1.png">
                    </div>
                    <div class="pl-0 pt-[60px] pb-[70px] pr-6 flex flex-col justify-between font-poppins space-y-0">
                        <p class="pt-1 font-semibold text-[23px]">ПОДАРОК. БЕСПЛАТНО</p>
                        <p class="text-[20px]">
                            При покупке любой книги<br>
                            в подарок добавляем книгу <br>
                            «Тибетский буддизм с самых основ» <br>
                            Б. Алана Уоллеса
                        </p>
                        <p class="font-poppins font-semibold text-[23px]">0 ₽</p>
                    </div>
                    
                </div>

                <!-- mobile -->
                <div class="flex 2xl:hidden product-card relative bg-white shadow flex-col border border-[#EEEEEE]">
                    <div class="m-auto mt-0 w-[200px] h-[300px] flex items-center"> 
                        <img class="block pb-2 pl-2 w-full h-auto " src="<?php echo get_template_directory_uri(); ?>/images/books/1.png">
                    </div>
                    <div class="pl-2 2xl:pt-8 2xl:pb-10 pr-6 flex flex-col justify-between font-poppins space-y-2 md:space-y-5 pb-5">
                        <p class="pt-1 font-semibold lg:text-[20px] text-[18px] text-center">ПОДАРОК. БЕСПЛАТНО</p>
                        
                        <p class="lg:text-[18px] text-[16px] text-center">
                            При покупке любой книги <br>
                            в подарок добавляем книгу <br>
                            «Тибетский буддизм с самых основ» <br>
                            Б. Алана Уоллеса
                        </p>
                        <p class="font-poppins font-semibold lg:text-[20px] text-[18px] text-center">0 ₽</p>   
                        
                    </div>
                    
                </div>


            <?php while ($query->have_posts()) : $query->the_post(); ?>
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
                        <a href="/shop" class="btn-border hover:bg-secondary border-secondary text-secondary h-[50px] w-full">
                            <span>Посмотреть каталог товаров</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <?php
                $i++;
                $flag = false;
                // Увеличиваем счетчик?>
        <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); ?>
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
