<?php

/**
 * Template Name: About Template
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Нити_Света
 */

get_header();
?>

<section id="primary">
    <main id="main">

        <div class="container grid grid-cols-1 lg:grid-cols-2 gap-3 mb-10">
            <div class="bg-white px-4 lg:px-10 py-3 lg:py-8 shadow rounded-xl">
                <div class="font-title text-primary text-2xl text-center mb-5">
                    Наша миссия
                </div>
                <div class="flex flex-col space-y-4 text-sm">
                    <p>
                        Социальное предпринимательство - это непростая работа.
                        Она требует как мотивации помощи людям, так и организации сложных процессов.
                        Подобная деятельность сопряжена со многими проблемами, но опираясь на участие небезразличных
                        людей, она может приносить очень много пользы, как людям с ограниченными возможностями, так и
                        всему обществу.
                    </p>
                    <p>
                        Наша задача помочь людям с ограниченными возможностями, но не разово, а постоянно. Создавать для
                        них возможность трудится с учётом их особенностей и получать достойную оплату. Чтобы у них был
                        коллектив, общение, повод выйти из дома, чувство причастности и пользы для общества.
                    </p>
                    <p>
                        Так как не только хлебом человек жив, но и делом.
                    </p>
                </div>
            </div>
            <div class="bg-white px-4 lg:px-10 py-3 lg:py-8 shadow rounded-xl">
                <div class="font-title text-primary text-2xl  text-center mb-5">
                    О названии
                </div>
                <div class="flex flex-col space-y-4 text-sm">
                    <p>
                        Название Нити Света, имеет глубокий смысл отражающий наши ценности. <br>
                        На древнем языке санскрите, который относится к нашей индо-европейской языковой группе, включая
                        языки славянские, nīti переводится как, в том числе, “социальная этика”, а śveta переводится
                        как белый цвет. Это социальная этика белого цвета.
                    </p>
                    <p>
                        И без сомнения, жизни всех людей на нашей планете переплетены, мы все взаимосвязаны.
                        Помогая другим, кто как может, пусть даже небольшим действием, мы влияем на всю эту невообразимо
                        сложную сеть.
                        Это единый клубок ниток, раскинувшийся на всю планету.
                    </p>
                    <p>
                        Каждое ваше доброе действие важно и оказывает влияние на весь мир.
                    </p>
                </div>
            </div>
        </div>

        <div class="swiper swiper-about w-full relative">
            <div class="swiper-wrapper pb-8 select-none">
                <div class="swiper-slide">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab1.jpg">
                </div>
                <div class="swiper-slide">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab2.jpg">
                </div>
                <div class="swiper-slide">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab3.jpg">
                </div>
                <div class="swiper-slide">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab5.jpg">
                </div>
                <div class="swiper-slide">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab4.jpg">
                </div>
                <div class="swiper-slide">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab6.jpg">
                </div>
                <div class="swiper-slide">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab7.jpg">
                </div>
                <!-- <div class="swiper-slide max-w-[241px]">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab8-1.jpg">
                </div> -->
                <div class="swiper-slide">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab9-1.jpg">
                </div>
                <div class="swiper-slide">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab10-1.jpg">
                </div>
                <!-- <div class="swiper-slide max-w-[220px]">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab11-1.jpg">
                </div> -->
                <div class="swiper-slide">
                    <img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/ab12-1.jpg">
                </div>
            </div>

            <div class="swiper-navigation absolute h-0 w-full top-1/2 -mt-4 z-10 flex items-center justify-between px-4 lg:px-40 gap-5">
                <div class="swiper-button-prev bg-white bg-opacity-50 relative top-0 left-0 m-0 w-9 md:w-[50px] h-9 md:h-[50px] border border-primary rounded-md text-primary after:text-base after:hidden after:relative after:left-[-1px]">
                    <svg class="!w-4" width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.292892 7.2929C-0.0976315 7.68342 -0.0976314 8.31658 0.292893 8.70711L6.65685 15.0711C7.04738 15.4616 7.68054 15.4616 8.07107 15.0711C8.46159 14.6805 8.46159 14.0474 8.07107 13.6569L2.41421 8L8.07107 2.34315C8.46159 1.95262 8.46159 1.31946 8.07107 0.928933C7.68054 0.538409 7.04738 0.538409 6.65685 0.928934L0.292892 7.2929ZM18 7L1 7L1 9L18 9L18 7Z" fill="#142346" />
                    </svg>
                </div>
                <div class="swiper-button-next bg-white bg-opacity-50 relative top-0 left-0 m-0 w-9 md:w-[50px] h-9 md:h-[50px] border border-primary rounded-md text-primary after:text-base after:hidden after:relative after:right-[-1px]">
                    <svg class="!w-4" width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.7071 7.2929C18.0976 7.68342 18.0976 8.31658 17.7071 8.70711L11.3431 15.0711C10.9526 15.4616 10.3195 15.4616 9.92893 15.0711C9.53841 14.6805 9.53841 14.0474 9.92893 13.6569L15.5858 8L9.92893 2.34315C9.53841 1.95262 9.53841 1.31946 9.92893 0.928933C10.3195 0.538409 10.9526 0.538409 11.3431 0.928934L17.7071 7.2929ZM1.2342e-07 7L17 7L17 9L-1.2342e-07 9L1.2342e-07 7Z" fill="#142346" />
                    </svg>

                </div>
            </div>
        </div>



    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
