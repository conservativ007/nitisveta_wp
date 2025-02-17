<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

$ucenennyj_value = $product->get_attribute('pa_ucenennyj');
$ucenenn = '';
if ('да' === strtolower($ucenennyj_value)) {
    $ucenenn = "уцененный";
}

?>

<div class="container xl:mt-6">

    <div id="product-<?php the_ID(); ?>" <?php wc_product_class('xl:grid grid-cols-1 xl:grid-cols-7 xl:gap-3', $product); ?>>

        <div class="single-product-gallery-wrapper w-full col-span-4 xl:col-span-3 px-0">

            <?php $attachment_ids = $product->get_gallery_image_ids(); ?>

            <div class="swiper mySwiper2 select-none swiper-product bg-white shadow mb-3">
                <div class="swiper-wrapper">

                    <div class="swiper-slide h-[340px] xl:h-[560px] w-full">
                        <img src="<?php echo get_the_post_thumbnail_url($product->ID); ?>" class="object-cover object-center h-full w-full" />
                    </div>

                    <?php foreach ($attachment_ids as $attachment_id) { ?>
                        <div class="swiper-slide h-[340px] xl:h-[560px] w-full">
                            <img src="<?php echo wp_get_attachment_url($attachment_id); ?>" class='object-cover object-center h-full w-full block' />
                        </div>
                    <?php } ?>

                </div>
                <div class="swiper-navigation xl:hidden absolute h-0 top-1/2 px-1 w-full flex items-center justify-between gap-5 z-10">
                    <div class="swiper-sprod-button-prev h-4 w-4 block"><svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 6.76795C0.666667 7.53775 0.666665 9.46225 2 10.2321L10.25 14.9952C11.5833 15.765 13.25 14.8027 13.25 13.2631L13.25 3.73686C13.25 2.19726 11.5833 1.23501 10.25 2.00481L2 6.76795Z" fill="#EF3343" stroke="white" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="swiper-sprod-button-next h-4 w-4 block"><svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 10.2321C14.3333 9.46225 14.3333 7.53775 13 6.76795L4.75 2.00481C3.41667 1.23501 1.75 2.19726 1.75 3.73686L1.75 13.2631C1.75 14.8027 3.41666 15.765 4.75 14.9952L13 10.2321Z" fill="#EF3343" stroke="white" stroke-width="2" />
                        </svg>
                    </div>
                </div>
                <div class="swiper-pagination xl:hidden"></div>
            </div>

            <div thumbsSlider="" class="swiper select-none mySwiper swiper-thumbs relative max-lg:hidden">
                <div class="swiper-wrapper">
                    <div class="swiper-slide h-52 card">
                        <img src="<?php echo get_the_post_thumbnail_url($product->ID); ?>" class='object-cover object-center h-full w-full block border-2 border-transparent hover:border-secondary transition cursor-pointer' />
                    </div>

                    <?php foreach ($attachment_ids as $attachment_id) { ?>
                        <div class="swiper-slide h-52 card">
                            <img src="<?php echo wp_get_attachment_url($attachment_id); ?>" class='object-cover object-center h-full w-full block border-2 border-transparent hover:border-secondary transition cursor-pointer' />
                        </div>
                    <?php } ?>
                </div>

                <div class="swiper-navigation absolute h-0 top-1/2 px-1 w-full flex items-center justify-between gap-5 z-10">
                    <div class="swiper-thumb-button-prev h-4 w-4 block"><svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 6.76795C0.666667 7.53775 0.666665 9.46225 2 10.2321L10.25 14.9952C11.5833 15.765 13.25 14.8027 13.25 13.2631L13.25 3.73686C13.25 2.19726 11.5833 1.23501 10.25 2.00481L2 6.76795Z" fill="#EF3343" stroke="white" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="swiper-thumb-button-next h-4 w-4 block"><svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 10.2321C14.3333 9.46225 14.3333 7.53775 13 6.76795L4.75 2.00481C3.41667 1.23501 1.75 2.19726 1.75 3.73686L1.75 13.2631C1.75 14.8027 3.41666 15.765 4.75 14.9952L13 10.2321Z" fill="#EF3343" stroke="white" stroke-width="2" />
                        </svg>
                    </div>
                </div>


            </div>

            <?php if (get_field('video')) : ?>
                <video controls>
                    <source src="<?php the_field('video'); ?>#t=2.0">
                    Ваш браузер не поддерживает видео
                </video>
            <?php endif; ?>

        </div>

        <div class="col-span-4 bg-white shadow p-3 xl:p-9 flex flex-col relative product-summary">

            <?php if ($ucenenn) : ?>
                <div class="bg-primary text-white flex items-center absolute top-0 right-9 h-9 px-8 font-title text-xl rounded-b-lg max-xl:hidden">
                    уцененный</div>
            <?php endif; ?>

            <h1 class="text-base xl:text-xl font-bold max-xl:mt-2 mb-4 xl:mb-9">
                <?php the_title(); ?>
            </h1>

            <div class="text-sm leading-6 mb-4 xl:mb-9">
                <?php the_content(); ?>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-x-4 text-sm leading-6 pb-7 border-b-2 xl:border-b border-slate-200">

                <?php if ($product->get_height()) : ?>
                    <div>
                        Высота:
                        <?php echo $product->get_height(); ?> см
                    </div>
                <?php endif; ?>

                <?php if ($product->get_length()) : ?>
                    <div>
                        Длина:
                        <?php echo $product->get_length(); ?> см
                    </div>
                <?php endif; ?>

                <?php if ($product->get_width()) : ?>
                    <div>
                        Ширина:
                        <?php echo $product->get_width(); ?> см
                    </div>
                <?php endif; ?>

                <?php if ($product->get_weight()) : ?>
                    <div>
                        Вес:
                        <?php echo $product->get_weight(); ?> кг
                    </div>
                <?php endif; ?>

                <?php

                $attributes = $product->get_attributes();

                foreach ($attributes as $attribute) {
                    if ($attribute->is_taxonomy()) {
                        $taxonomy = $attribute->get_name();
                        $terms = wc_get_product_terms(get_the_ID(), $taxonomy, array('fields' => 'names'));
                        $value = implode(', ', $terms);
                        $label = wc_attribute_label($taxonomy);
                    } else {
                        $value = $attribute->get_options();
                        $value = implode(', ', $value);
                        $label = $attribute->get_name();
                    }

                    echo '<div>' . $label . ': ' . $value . '</div>';
                }
                ?>


            </div>

            <div class="pb-5 pt-3 xl:pb-7 xl:pt-7 mb-6 xl:mb-8 border-b-2 xl:border-b  border-slate-200 flex xl:items-center flex-col xl:flex-row xl:gap-8 gap-4 relative">

                <?php if ($ucenenn) : ?>
                    <div class="absolute flex items-center justify-center top-1/2 z-20 -right-[60px] -mt-3 rotate-90 w-[120px] xl:hidden">
                        <div class="bg-primary text-white flex justify-center items-center h-6 xl:h-9 w-full text-center font-title text-sm xl:text-xl rounded-b-lg z-10">уцененный</div>
                    </div>

                <?php endif; ?>

                <?php
                $product = wc_get_product(get_the_ID());
                $thePrice = $product->get_price(); //will give raw price
                $regularPrice = $product->get_regular_price(); //will give raw price
                $discountValue = $regularPrice - $thePrice; //will give raw price

                $percent = (($regularPrice - $thePrice) / $regularPrice) * 100;

                if ($regularPrice != $thePrice) { ?>
                    <div class='flex items-center gap-3 max-xl:order-2'>
                        <span class='text-lg xl:text-xl font-bold'>
                            <?php echo $thePrice; ?> ₽
                        </span>
                        <span class='opacity-50 text-lg xl:text-xl font-bold relative xl:top-1/2 inline-block'>
                            <?php echo $regularPrice ?> ₽ <span class="absolute h-[2px] w-full bg-primary top-1/2 left-0"></span>
                        </span>
                        <span class='rounded-md border border-[#E6E2EB] text-sm w-16 h-8 font-bold inline-flex items-center justify-center'>-
                            <?php echo round($percent) ?> %
                        </span>
                    </div>
                <?php } else { ?>
                    <div class='product-price-wrapper'>
                        <span class='sale-price text-lg xl:text-xl font-bold max-xl:order-2'>
                            <?php echo $thePrice ?> ₽
                        </span>
                    </div>
                <?php } ?>

                <div class="text-lg xl:text-xl font-bold max-xl:order-1">
                    <?php
                    if ($product->is_in_stock()) {
                        $availability = __('В наличии', 'woocommerce');
                    }
                    if ($product->get_stock_quantity() > 1) {
                        $availability = __('Осталось на складе: ', 'woocommerce') . $product->get_stock_quantity() . ' шт.';
                    }
                    // Change in Stock Text to only 1 or 2 left
                    if ($product->is_in_stock() && $product->get_stock_quantity() <= 1 && $product->get_stock_quantity() > 0) {
                        $availability = __('Осталась 1 шт.', 'woocommerce');
                    }
                    if (!$product->is_in_stock()) {
                        $availability = __('Нет в наличии', 'woocommerce');
                    }
                    echo $availability;
                    ?>
                </div>

                <?php if ($ucenenn) : ?>
                    <div class="text-secondary text-sm ucen-link cursor-pointer max-xl:order-3">Почему товар уцененный?</div>
                <?php endif; ?>
            </div>

            <?php
            if ($product->is_in_stock()) { ?>
                <div class="pt-1 xl:pt-7 max-w-lg">
                    <form class="w-full mb-4" action="<?php echo esc_url(get_permalink()); ?>" method="post" enctype='multipart/form-data'>
                        <?php
                        $product_id = esc_attr($product->get_id());
                        $quantity = get_product_quantity_in_cart($product_id);
                        ?>

                        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />
                        <input type="hidden" name="quantity" value="1" />
                        <button type="submit" class="btn bg-secondary w-full">
                            <?php if ($quantity > 0) : ?>
                                <?php echo $quantity; ?> уже в корзине. Добавить еще?
                            <?php else : ?>
                                <?php echo esc_html($product->single_add_to_cart_text()); ?>
                            <?php endif; ?>
                        </button>
                    </form>
                </div>
            <?php  }
            ?>


            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 xl:gap-12 max-w-lg mt-2 xl:mt-5 xl:mb-10">

                <div class="">
                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                </div>

                <div class="">
                    <div class="btn-border share-link cursor-pointer h-[50px]" data-template="share"><span>Поделиться</span></div>
                </div>

            </div>



            <div style="display: none;">
                <div id="share">
                    <div class="copy-link flex items-center gap-2 py-1 px-2 rounded hover:bg-white hover:bg-opacity-5 cursor-pointer" data-clipboard-text="<?php echo esc_url(get_permalink()); ?>">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3525 10.6075C13.3525 12.1235 12.1235 13.3525 10.6075 13.3525H3.745C2.22898 13.3525 1 12.1235 1 10.6075V3.745C1 2.22898 2.22898 1 3.745 1H10.6075C12.1235 1 13.3525 2.22898 13.3525 3.745V10.6075Z" stroke="white" stroke-width="1.40625" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.39258 16.0001H13.2551C14.7711 16.0001 16.0001 14.7711 16.0001 13.2551V6.39258" stroke="white" stroke-width="1.40625" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span>Скопировать ссылку</span>
                    </div>
                    <a class="flex items-center gap-2 py-1 px-2 rounded hover:bg-white hover:bg-opacity-5" target="_blank" href="https://t.me/share/url?url=<?php echo get_permalink(); ?>">
                        <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.919431 5.32028L9.85562 1.69424C10.7374 1.31653 13.728 0.107851 13.728 0.107851C13.728 0.107851 15.1082 -0.420947 14.9932 0.863276C14.9549 1.39207 14.6481 3.24286 14.3414 5.24765L13.3829 11.1806C13.3829 11.1806 13.3062 12.0494 12.6544 12.2005C12.0027 12.3515 10.9291 11.6717 10.7374 11.5206C10.5841 11.4073 7.86193 9.70756 6.86509 8.87659C6.59671 8.64997 6.28999 8.19671 6.90343 7.66791C8.28368 6.42146 9.9323 4.87284 10.9291 3.89079C11.3892 3.43753 11.8493 2.37994 9.9323 3.66416L4.5234 7.24662C4.5234 7.24662 3.90996 7.62433 2.75976 7.28439C1.60955 6.94445 0.26765 6.49119 0.26765 6.49119C0.26765 6.49119 -0.652512 5.92462 0.919431 5.32028Z" fill="white" />
                        </svg>

                        <span>
                            Telegram
                        </span>
                    </a>
                    <a class="flex items-center gap-2 py-1 px-2 rounded hover:bg-white hover:bg-opacity-5" target="_blank" href="https://wa.me/?text=<?php echo get_permalink(); ?>">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.361625 8.04636C0.361099 9.42399 0.72093 10.7688 1.40519 11.9542L0.295898 16.0044L4.44106 14.9175C5.58312 15.5403 6.86891 15.8685 8.17748 15.8691H8.18081C12.49 15.8691 15.9981 12.3621 16 8.0525C16.0007 5.9638 15.188 3.99988 13.7118 2.52235C12.2354 1.04499 10.2723 0.230857 8.18081 0.22998C3.87072 0.22998 0.363202 3.73628 0.36145 8.04619L0.361625 8.04636ZM2.82979 11.75L2.67503 11.5043C2.02442 10.4698 1.68106 9.27431 1.68142 8.04689C1.68299 4.4647 4.59827 1.55012 8.18309 1.55012C9.91915 1.55082 11.5506 2.22754 12.7778 3.45549C14.0049 4.68344 14.6802 6.31591 14.6797 8.0518C14.6781 11.6342 11.7626 14.5487 8.18064 14.5487H8.17801C7.01158 14.548 5.86776 14.235 4.87029 13.6429L4.6328 13.5022L2.17287 14.1472L2.82979 11.75ZM8.18081 15.8691C8.18064 15.8691 8.18064 15.8691 8.18081 15.8691Z" fill="white" />
                            <path d="M6.22678 4.77817C6.08043 4.45287 5.92636 4.44621 5.7872 4.4406C5.67327 4.43569 5.54287 4.43604 5.41282 4.43604C5.28242 4.43604 5.07087 4.48494 4.89192 4.68037C4.71279 4.87597 4.20801 5.3485 4.20801 6.30969C4.20801 7.27105 4.90822 8.19981 5.00567 8.33039C5.10347 8.46061 6.35736 10.4962 8.343 11.2793C9.99335 11.9301 10.3293 11.8008 10.6874 11.7682C11.0457 11.7356 11.8433 11.2956 12.0062 10.8394C12.169 10.3832 12.169 9.99213 12.1203 9.91063C12.0714 9.82913 11.9411 9.78023 11.7457 9.6826C11.5503 9.5848 10.5898 9.11227 10.4107 9.04707C10.2315 8.98187 10.1013 8.94944 9.97092 9.14505C9.84069 9.34047 9.46649 9.7804 9.35256 9.91063C9.23864 10.0412 9.12453 10.0575 8.92928 9.95971C8.73386 9.86173 8.10463 9.65561 7.35815 8.99011C6.77731 8.47218 6.38522 7.83279 6.2713 7.63719C6.15737 7.44176 6.2592 7.33607 6.35701 7.23862C6.44482 7.15116 6.55243 7.0106 6.65023 6.89649C6.74768 6.78239 6.78029 6.70089 6.84531 6.57067C6.91051 6.44026 6.87791 6.32616 6.82901 6.22836C6.78011 6.13056 6.40047 5.16447 6.22678 4.77817Z" fill="white" />
                        </svg>

                        <span>WhatsApp</span>

                    </a>
                    <a class="flex items-center gap-2 py-1 px-2 rounded hover:bg-white hover:bg-opacity-5" target="_blank" href="https://vk.com/share.php?image=<?php echo get_the_post_thumbnail_url($product->ID); ?>&title=<?php echo get_the_title(); ?>&url=<?php echo get_permalink(); ?>">
                        <svg width="15" height="9" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33907 8.67315H8.23564C8.23564 8.67315 8.50639 8.64278 8.64483 8.49118C8.77208 8.35183 8.76801 8.09034 8.76801 8.09034C8.76801 8.09034 8.75047 6.86591 9.30873 6.6856C9.85927 6.50787 10.5661 7.86896 11.3151 8.39236C11.8816 8.78831 12.3121 8.70164 12.3121 8.70164L14.3153 8.67315C14.3153 8.67315 15.3632 8.60735 14.8663 7.76881C14.8256 7.70032 14.5768 7.14853 13.3768 6.01484C12.1206 4.82826 12.289 5.02023 13.8021 2.96774C14.7235 1.71778 15.0918 0.95471 14.9767 0.627905C14.8671 0.316528 14.1893 0.398781 14.1893 0.398781L11.9339 0.412973C11.9339 0.412973 11.7665 0.389804 11.6426 0.465282C11.5214 0.539094 11.4436 0.711555 11.4436 0.711555C11.4436 0.711555 11.0865 1.67875 10.6106 2.50143C9.60626 4.23712 9.20462 4.32899 9.04045 4.22104C8.65851 3.96982 8.75396 3.21203 8.75396 2.67352C8.75396 0.991374 9.00464 0.290025 8.2658 0.108479C8.02066 0.0482679 7.84007 0.00843181 7.21304 0.00192692C6.40822 -0.00640584 5.72722 0.00445387 5.34153 0.196752C5.08493 0.324647 4.88696 0.609573 5.0076 0.625969C5.15671 0.646183 5.49423 0.718705 5.67318 0.966537C5.90437 1.28668 5.89629 2.00534 5.89629 2.00534C5.89629 2.00534 6.02914 3.98547 5.58613 4.23136C5.28216 4.40006 4.86509 4.05568 3.96969 2.48095C3.511 1.67434 3.16455 0.782625 3.16455 0.782625C3.16455 0.782625 3.09784 0.616024 2.97868 0.526837C2.83416 0.41878 2.63223 0.384535 2.63223 0.384535L0.488906 0.398781C0.488906 0.398781 0.167232 0.40792 0.0490209 0.55033C-0.0561436 0.677095 0.0406232 0.938958 0.0406232 0.938958C0.0406232 0.938958 1.7185 4.93449 3.61854 6.948C5.36091 8.79433 7.33907 8.67315 7.33907 8.67315Z" fill="white" />
                        </svg>

                        <span>VK</span>

                    </a>
                </div>
            </div>

            <div class="mt-auto pt-5 max-xl:mt-7 xl:pt-7 border-t border-slate-200 text-sm max-xl:border-t-2">
                Доставка до двери или до пункта выдачи заказов по России, в Беларусь, Армению, Казахстан, Киргизию, <a href="/delivery" class="text-secondary"><span>другие страны</span> <svg class="inline-block" width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.35355 4.35355C9.54882 4.15829 9.54882 3.84171 9.35355 3.64645L6.17157 0.464466C5.97631 0.269204 5.65973 0.269204 5.46447 0.464466C5.2692 0.659728 5.2692 0.976311 5.46447 1.17157L8.29289 4L5.46447 6.82843C5.2692 7.02369 5.2692 7.34027 5.46447 7.53553C5.65973 7.7308 5.97631 7.7308 6.17157 7.53553L9.35355 4.35355ZM0 4.5H9V3.5H0V4.5Z" fill="#EF3343" />
                    </svg>
                </a>
            </div>

        </div>

    </div>

    <div class="mt-7 mb-7">
        <div class="font-title text-xl xl:text-4xl text-center">
            <span>Вам также может понравиться</span>
        </div>
    </div>

</div>

<?php

if (has_term(18, 'product_cat', $product->get_id())) {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 15,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => array(18),
                'operator' => 'IN',
            )
        ),
    );
} else {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 15,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => array(18),
                'operator' => 'NOT IN',
            )
        ),
    );
}

$i = 1;
$query = new WP_Query($args); ?>

<?php if ($query->have_posts()) : ?>


    <?php if (has_term(18, 'product_cat', $product->get_id())) : ?>

        <div class="swiper swiper-products-horizontal w-full">
            <div class="swiper-wrapper pb-8">
                <?php while ($query->have_posts()) :
                    $query->the_post();
                    $i++; ?>
                    <?php
                    $post_id = get_the_ID();
                    $product = wc_get_product($post_id);
                    ?>
                    <div class="swiper-slide max-w-[800px]">
                        <?php get_template_part('template-parts/blocks/product-card-horizontal'); ?>
                    </div>
                <?php endwhile; ?>
            </div>

        </div>

    <?php else : ?>

        <div class="swiper swiper-products-standard w-full">
            <div class="swiper-wrapper pb-4">
                <?php while ($query->have_posts()) :
                    $query->the_post();
                    $i++; ?>
                    <?php
                    $post_id = get_the_ID();
                    $product = wc_get_product($post_id);
                    ?>
                    <div class="swiper-slide">
                        <?php get_template_part('template-parts/blocks/product-card'); ?>
                    </div>
                <?php endwhile; ?>
            </div>

        </div>

    <?php endif; ?>



    <?php wp_reset_postdata(); ?>

<?php else : ?>
<?php endif; ?>

<?php do_action('woocommerce_after_single_product'); ?>