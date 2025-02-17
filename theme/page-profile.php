<?php

/**
 * Template Name: My profile
 */

get_header();
?>

<section id="primary">
  <main id="main">

    <?php if (is_user_logged_in()) : ?>


      <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-y-3 lg:gap-3">
          <div class="bg-white shadow rounded-md p-5 flex items-center justify-center flex-col">
            <?php
            $countries = array(
              'RU' => 'Россия',
              'AM' => 'Армения',
              'BY' => 'Беларусь',
              'KZ' => 'Казахстан',
              'KG' => 'Кыргызстан',
            );

            $current_user = wp_get_current_user();
            $current_user_country_code = get_user_meta($current_user->ID, 'billing_country', true);
            ?>
            <form id="custom-profile-form" action="" method="post" class="grid grid-cols-1 gap-3 max-w-sm mx-auto w-full">
              <input type="text" name="first_name" value="<?php echo esc_attr($current_user->first_name); ?>" placeholder="Имя" class="h-12 rounded-md border border-[#B6B6B6] text-base text-center">
              <input type="tel" name="phone" value="<?php echo esc_attr(get_user_meta($current_user->ID, 'billing_phone', true)); ?>" placeholder="Телефон" class="h-12 rounded-md border border-[#B6B6B6] text-base text-center">
              <input type="email" name="email" value="<?php echo esc_attr($current_user->user_email); ?>" placeholder="Email" class="h-12 rounded-md border border-[#B6B6B6] text-base text-center">
              <input type="text" name="town" value="<?php echo esc_attr(get_user_meta($current_user->ID, 'billing_city', true)); ?>" placeholder="Город" class="h-12 rounded-md border border-[#B6B6B6] text-base text-center">
              <select name="country" class="h-12 rounded-md border border-[#B6B6B6] text-base text-center">
                <?php foreach ($countries as $code => $name) : ?>
                  <option value="<?php echo esc_attr($code); ?>" <?php selected($current_user_country_code, $code); ?>>
                    <?php echo esc_html($name); ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <input type="text" name="new_password" placeholder="Новый пароль" class="h-12 rounded-md border border-[#B6B6B6] text-base text-center">
              <input type="hidden" name="profile_nonce" value="<?php echo wp_create_nonce('profile-nonce'); ?>">
              <input type="submit" value="Сохранить изменения" class="btn">
              <div id="form-response" class="response-message"></div>
            </form>
          </div>
          <div class="">
            <div class="bg-white px-3 lg:px-10 py-3 lg:py-8 shadow rounded-md mb-3">
              <div class="font-title text-lg lg:text-2xl">Если у вас возникнут вопросы, сложности <br class="hidden lg:block">или предложения,
                пишите нам
              </div>

              <div class="grid  items-center gap-4  mt-4 2xl:grid-cols-3 2xl:gap-8">
                <a class="group btn-border" href="https://t.me/nitisveta">
                  <svg class="mr-3" width="30" height="25" viewBox="0 0 30 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.83886 10.6406L19.7112 3.38849C21.4749 2.63306 27.4559 0.215701 27.4559 0.215701C27.4559 0.215701 30.2164 -0.841894 29.9864 1.72655C29.9097 2.78415 29.2963 6.48573 28.6828 10.4953L26.7658 22.3613C26.7658 22.3613 26.6125 24.0988 25.3089 24.4009C24.0053 24.7031 21.8583 23.3433 21.4749 23.0412C21.1682 22.8145 15.7239 19.4151 13.7302 17.7532C13.1934 17.2999 12.58 16.3934 13.8069 15.3358C16.5674 12.8429 19.8646 9.74568 21.8583 7.78157C22.7784 6.87506 23.6986 4.75987 19.8646 7.32832L9.0468 14.4932C9.0468 14.4932 7.81991 15.2487 5.51951 14.5688C3.21911 13.8889 0.5353 12.9824 0.5353 12.9824C0.5353 12.9824 -1.30502 11.8492 1.83886 10.6406Z" fill="#3B2F4A" class="group-hover:fill-white" />
                  </svg>
                  <span>Telegram</span>
                </a>
                <a class="group btn-border" href="https://wa.me/+79650543710">
                  <svg class="mr-3" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.41898 14.8675C0.417996 17.4473 1.09183 19.9657 2.37319 22.1854L0.295898 29.7699L8.05827 27.7346C10.1969 28.9008 12.6048 29.5155 15.0552 29.5165H15.0615C23.1311 29.5165 29.7004 22.9492 29.704 14.879C29.7053 10.9676 28.1833 7.28988 25.4191 4.523C22.6542 1.75644 18.9781 0.231866 15.0615 0.230225C6.99025 0.230225 0.421934 6.79624 0.418652 14.8671L0.41898 14.8675ZM5.04096 21.8031L4.75114 21.3429C3.53279 19.4057 2.88981 17.167 2.89047 14.8685C2.89342 8.16032 8.35268 2.70237 15.0657 2.70237C18.3167 2.70368 21.3718 3.97093 23.67 6.27043C25.9679 8.56993 27.2325 11.627 27.2315 14.8776C27.2285 21.5861 21.7689 27.0441 15.0611 27.0441H15.0562C12.8719 27.0427 10.73 26.4565 8.86208 25.3478L8.41734 25.0843L3.81079 26.2921L5.04096 21.8031ZM15.0615 29.5165C15.0611 29.5165 15.0611 29.5165 15.0615 29.5165V29.5165Z" fill="#3B2F4A" class="group-hover:fill-white" />
                    <path d="M11.402 8.74738C11.1279 8.13821 10.8394 8.12574 10.5788 8.11523C10.3655 8.10604 10.1213 8.1067 9.87776 8.1067C9.63356 8.1067 9.2374 8.19827 8.90229 8.56424C8.56685 8.93053 7.62158 9.81541 7.62158 11.6154C7.62158 13.4156 8.93282 15.1549 9.11531 15.3994C9.29845 15.6433 11.6465 19.4552 15.3649 20.9217C18.4554 22.1403 19.0846 21.8981 19.7552 21.8371C20.4261 21.776 21.9198 20.9522 22.2247 20.0978C22.5296 19.2435 22.5296 18.5112 22.4384 18.3586C22.3468 18.206 22.1029 18.1144 21.737 17.9316C21.371 17.7485 19.5724 16.8636 19.2369 16.7415C18.9015 16.6194 18.6576 16.5587 18.4134 16.925C18.1696 17.2909 17.4688 18.1147 17.2555 18.3586C17.0421 18.6031 16.8284 18.6337 16.4628 18.4505C16.0968 18.267 14.9185 17.8811 13.5207 16.6348C12.4329 15.6649 11.6987 14.4676 11.4854 14.1013C11.272 13.7353 11.4627 13.5374 11.6459 13.3549C11.8103 13.1911 12.0118 12.9279 12.195 12.7142C12.3775 12.5006 12.4385 12.3479 12.5603 12.1041C12.6824 11.8599 12.6213 11.6462 12.5298 11.4631C12.4382 11.2799 11.7273 9.47078 11.402 8.74738Z" fill="#3B2F4A" class="group-hover:fill-white" />
                  </svg>
                  <span>WhatsApp</span>
                </a>
                <a class="btn-border copy-link" data-clipboard-text="nitisveta.ru@gmail.com">
                  <span>nitisveta.ru@gmail.com</span>
                </a>
              </div>
            </div>
            <div class="bg-white p-7 max-w-4xl mx-auto shadow rounded-md">

              <div class="text-base lg:text-2xl font-bold text-center">
                В подарок для вас скидка 5% на ваш следующий заказ
              </div>

              <div class="text-base lg:text-xl text-center">Вы можете применить промокод сами или подарить кому-то из ваших друзей.
              </div>
              <div class="mt-6 text-2xl lg:text-4xl font-title text-center">Niti-5%</div>
              <div class="flex flex-col xl:flex-row items-center justify-center gap-2 xl:gap-10 mx-auto mt-8">
                <div class="btn w-full max-w-xs copy-link" data-clipboard-text="Niti-5%"><span>Копировать мой промо код</span></div>
                <div class="share-link btn-border h-12 w-full max-w-xs cursor-pointer" data-template="share">
                  <span>Отправить код другу</span>
                </div>
                <div style="display: none;">
                  <div id="share">
                    <div class="copy-link flex items-center gap-2 py-1 px-2 rounded text-white no-underline hover:bg-white hover:bg-opacity-5 cursor-pointer" data-clipboard-text="Niti-5%">
                      <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3525 10.6075C13.3525 12.1235 12.1235 13.3525 10.6075 13.3525H3.745C2.22898 13.3525 1 12.1235 1 10.6075V3.745C1 2.22898 2.22898 1 3.745 1H10.6075C12.1235 1 13.3525 2.22898 13.3525 3.745V10.6075Z" stroke="white" stroke-width="1.40625" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.39258 16.0001H13.2551C14.7711 16.0001 16.0001 14.7711 16.0001 13.2551V6.39258" stroke="white" stroke-width="1.40625" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>

                      <span>Скопировать промокод</span>
                    </div>
                    <a class="flex items-center gap-2 py-1 px-2 rounded text-white no-underline hover:bg-white hover:bg-opacity-5" target="_blank" href="https://t.me/share/url?url=https://nitisveta.ru/&text=Промокод для покупки в магазине Нити Света - Niti-5%">
                      <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.919431 5.32028L9.85562 1.69424C10.7374 1.31653 13.728 0.107851 13.728 0.107851C13.728 0.107851 15.1082 -0.420947 14.9932 0.863276C14.9549 1.39207 14.6481 3.24286 14.3414 5.24765L13.3829 11.1806C13.3829 11.1806 13.3062 12.0494 12.6544 12.2005C12.0027 12.3515 10.9291 11.6717 10.7374 11.5206C10.5841 11.4073 7.86193 9.70756 6.86509 8.87659C6.59671 8.64997 6.28999 8.19671 6.90343 7.66791C8.28368 6.42146 9.9323 4.87284 10.9291 3.89079C11.3892 3.43753 11.8493 2.37994 9.9323 3.66416L4.5234 7.24662C4.5234 7.24662 3.90996 7.62433 2.75976 7.28439C1.60955 6.94445 0.26765 6.49119 0.26765 6.49119C0.26765 6.49119 -0.652512 5.92462 0.919431 5.32028Z" fill="white" />
                      </svg>

                      <span>
                        Telegram
                      </span>
                    </a>
                    <a class="flex items-center gap-2 py-1 px-2 rounded text-white no-underline hover:bg-white hover:bg-opacity-5" target="_blank" href="https://wa.me/?text=Промокод для покупки в магазине Нити Света - Niti-5%">
                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.361625 8.04636C0.361099 9.42399 0.72093 10.7688 1.40519 11.9542L0.295898 16.0044L4.44106 14.9175C5.58312 15.5403 6.86891 15.8685 8.17748 15.8691H8.18081C12.49 15.8691 15.9981 12.3621 16 8.0525C16.0007 5.9638 15.188 3.99988 13.7118 2.52235C12.2354 1.04499 10.2723 0.230857 8.18081 0.22998C3.87072 0.22998 0.363202 3.73628 0.36145 8.04619L0.361625 8.04636ZM2.82979 11.75L2.67503 11.5043C2.02442 10.4698 1.68106 9.27431 1.68142 8.04689C1.68299 4.4647 4.59827 1.55012 8.18309 1.55012C9.91915 1.55082 11.5506 2.22754 12.7778 3.45549C14.0049 4.68344 14.6802 6.31591 14.6797 8.0518C14.6781 11.6342 11.7626 14.5487 8.18064 14.5487H8.17801C7.01158 14.548 5.86776 14.235 4.87029 13.6429L4.6328 13.5022L2.17287 14.1472L2.82979 11.75ZM8.18081 15.8691C8.18064 15.8691 8.18064 15.8691 8.18081 15.8691Z" fill="white" />
                        <path d="M6.22678 4.77817C6.08043 4.45287 5.92636 4.44621 5.7872 4.4406C5.67327 4.43569 5.54287 4.43604 5.41282 4.43604C5.28242 4.43604 5.07087 4.48494 4.89192 4.68037C4.71279 4.87597 4.20801 5.3485 4.20801 6.30969C4.20801 7.27105 4.90822 8.19981 5.00567 8.33039C5.10347 8.46061 6.35736 10.4962 8.343 11.2793C9.99335 11.9301 10.3293 11.8008 10.6874 11.7682C11.0457 11.7356 11.8433 11.2956 12.0062 10.8394C12.169 10.3832 12.169 9.99213 12.1203 9.91063C12.0714 9.82913 11.9411 9.78023 11.7457 9.6826C11.5503 9.5848 10.5898 9.11227 10.4107 9.04707C10.2315 8.98187 10.1013 8.94944 9.97092 9.14505C9.84069 9.34047 9.46649 9.7804 9.35256 9.91063C9.23864 10.0412 9.12453 10.0575 8.92928 9.95971C8.73386 9.86173 8.10463 9.65561 7.35815 8.99011C6.77731 8.47218 6.38522 7.83279 6.2713 7.63719C6.15737 7.44176 6.2592 7.33607 6.35701 7.23862C6.44482 7.15116 6.55243 7.0106 6.65023 6.89649C6.74768 6.78239 6.78029 6.70089 6.84531 6.57067C6.91051 6.44026 6.87791 6.32616 6.82901 6.22836C6.78011 6.13056 6.40047 5.16447 6.22678 4.77817Z" fill="white" />
                      </svg>

                      <span>WhatsApp</span>

                    </a>
                    <a class="flex items-center gap-2 py-1 px-2 rounded text-white no-underline hover:bg-white hover:bg-opacity-5" target="_blank" href="https://vk.com/share.php?url=https://nitisveta.ru&title=Промокод для покупки в магазине Нити Света - Niti-5%">
                      <svg width="15" height="9" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33907 8.67315H8.23564C8.23564 8.67315 8.50639 8.64278 8.64483 8.49118C8.77208 8.35183 8.76801 8.09034 8.76801 8.09034C8.76801 8.09034 8.75047 6.86591 9.30873 6.6856C9.85927 6.50787 10.5661 7.86896 11.3151 8.39236C11.8816 8.78831 12.3121 8.70164 12.3121 8.70164L14.3153 8.67315C14.3153 8.67315 15.3632 8.60735 14.8663 7.76881C14.8256 7.70032 14.5768 7.14853 13.3768 6.01484C12.1206 4.82826 12.289 5.02023 13.8021 2.96774C14.7235 1.71778 15.0918 0.95471 14.9767 0.627905C14.8671 0.316528 14.1893 0.398781 14.1893 0.398781L11.9339 0.412973C11.9339 0.412973 11.7665 0.389804 11.6426 0.465282C11.5214 0.539094 11.4436 0.711555 11.4436 0.711555C11.4436 0.711555 11.0865 1.67875 10.6106 2.50143C9.60626 4.23712 9.20462 4.32899 9.04045 4.22104C8.65851 3.96982 8.75396 3.21203 8.75396 2.67352C8.75396 0.991374 9.00464 0.290025 8.2658 0.108479C8.02066 0.0482679 7.84007 0.00843181 7.21304 0.00192692C6.40822 -0.00640584 5.72722 0.00445387 5.34153 0.196752C5.08493 0.324647 4.88696 0.609573 5.0076 0.625969C5.15671 0.646183 5.49423 0.718705 5.67318 0.966537C5.90437 1.28668 5.89629 2.00534 5.89629 2.00534C5.89629 2.00534 6.02914 3.98547 5.58613 4.23136C5.28216 4.40006 4.86509 4.05568 3.96969 2.48095C3.511 1.67434 3.16455 0.782625 3.16455 0.782625C3.16455 0.782625 3.09784 0.616024 2.97868 0.526837C2.83416 0.41878 2.63223 0.384535 2.63223 0.384535L0.488906 0.398781C0.488906 0.398781 0.167232 0.40792 0.0490209 0.55033C-0.0561436 0.677095 0.0406232 0.938958 0.0406232 0.938958C0.0406232 0.938958 1.7185 4.93449 3.61854 6.948C5.36091 8.79433 7.33907 8.67315 7.33907 8.67315Z" fill="white" />
                      </svg>

                      <span>VK</span>
                    </a>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="flex justify-between mt-10 mb-5 lg:mb-10 gap-3">
          <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="btn-border w-full h-9 text-sm font-normal border-secondary text-secondary max-w-[170px] hover:bg-secondary">Выйти</a>
          <a href="#delete-profile-popup" class="btn-border w-full h-9 px-0 text-sm font-normal border-secondary text-secondary max-w-[170px] hover:bg-secondary">Удалить профиль</a>
        </div>

        <?php
        $user_id = get_current_user_id(); // ID текущего пользователя
        $orders = wc_get_orders(array('customer_id' => $user_id)); // Получение заказов пользователя
        $products = array(); // Массив для хранения товаров

        foreach ($orders as $order) {
          foreach ($order->get_items() as $item) {
            $product = $item->get_product(); // Получение объекта товара
            if ($product) {
              $products[$product->get_id()] = $product; // Сохранение объекта товара
            }
          }
        }

        if ($products) :
          echo '<div class="font-title text-xl lg:text-4xl text-center mb-5 lg:mb-10 lg:-mt-20">Мои предыдущие заказы</div>';
          echo '<div class="grid grid-cols-1 xl:grid-cols-2 gap-3 mb-8">';
          foreach ($products as $product) {
            // Теперь $product является объектом товара
            $product_name = $product->get_name(); // Получение названия товара
            $product_id = $product->get_id(); // Получение ID товара
            $product_permalink = $product->get_permalink();
            $cart_url = wc_get_cart_url(); // Получить URL корзины
            $in_cart = false;
            $ucenennyj_value = $product->get_attribute('pa_ucenennyj');
            $ucenenn = '';
            if ('да' === strtolower($ucenennyj_value)) {
              $ucenenn = "уцененный";
            }
        ?>

            <div class="bg-white shadow">
              <div class="md:grid md:grid-cols-8">

                <div class="prod-thumb h-64 md:h-auto md:col-span-3 relative">
                  <?php if ($ucenenn) : ?>
                    <div class="absolute flex justify-center top-0 left-0 w-full">
                      <div class="bg-primary text-white flex items-center h-9 px-8 font-title text-xl rounded-b-lg z-10">
                        уцененный</div>
                    </div>

                  <?php endif; ?>
                  <?php $attachment_ids = $product->get_gallery_image_ids(); ?>

                  <div class="swiper select-none gallery-cart bg-white border-r border-[#f6f6f6]">
                    <div class="swiper-wrapper">

                      <div class="swiper-slide h-64 md:h-80 w-full">
                        <img src="<?php echo get_the_post_thumbnail_url($product_id); ?>" class="object-cover object-center h-full w-full m-0" />
                      </div>

                      <?php foreach ($attachment_ids as $attachment_id) { ?>
                        <div class="swiper-slide h-64 md:h-80 w-full">
                          <img src="<?php echo wp_get_attachment_url($attachment_id); ?>" class='object-cover object-center h-full w-full block m-0' />
                        </div>
                      <?php } ?>

                    </div>
                    <div class="swiper-navigation absolute h-0 top-1/2 px-1 w-full flex items-center justify-between gap-5 z-10">
                      <div class="swiper-button-prev h-4 w-4 block after:hidden">
                        <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M2 6.76795C0.666667 7.53775 0.666665 9.46225 2 10.2321L10.25 14.9952C11.5833 15.765 13.25 14.8027 13.25 13.2631L13.25 3.73686C13.25 2.19726 11.5833 1.23501 10.25 2.00481L2 6.76795Z" fill="#AAAAAA" stroke="white" stroke-width="2" />
                        </svg>
                      </div>
                      <div class="swiper-button-next h-4 w-4 block after:hidden">
                        <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M13 10.2321C14.3333 9.46225 14.3333 7.53775 13 6.76795L4.75 2.00481C3.41667 1.23501 1.75 2.19726 1.75 3.73686L1.75 13.2631C1.75 14.8027 3.41666 15.765 4.75 14.9952L13 10.2321Z" fill="#AAAAAA" stroke="white" stroke-width="2" />
                        </svg>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="md:col-span-5 px-3 py-5 md:pl-20">
                  <div class="product-name md:mt-8 mb-1 md:mb-4" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                    <?php
                    if (!$product_permalink) {
                      echo wp_kses_post($product_name . '&nbsp;');
                    } else {
                      echo '<a href="' . $product_permalink . '" class="no-underline text-lg md:text-xl font-bold">' . $product->get_name() . '</a>';
                    }
                    ?>
                  </div>

                  <div class="mb-1 md:mb-4">

                    <?php
                    $thePrice = $product->get_price(); //will give raw price
                    $regularPrice = $product->get_regular_price(); //will give raw price
                    $discountValue = $regularPrice - $thePrice; //will give raw price

                    $percent = (($regularPrice - $thePrice) / $regularPrice) * 100;

                    if ($regularPrice != $thePrice) { ?>
                      <div class='flex items-center gap-3'>
                        <span class='text-lg md:text-xl font-bold'>
                          <?php echo $thePrice; ?> ₽
                        </span>
                        <span class='opacity-50 text-lg md:text-xl font-bold relative top-1/2 inline-block'>
                          <?php echo $regularPrice ?> ₽ <span class="absolute h-[2px] w-full bg-primary top-1/2 left-0"></span>
                        </span>
                        <span class='rounded-md border border-[#E6E2EB] text-sm w-16 h-8 font-bold inline-flex items-center justify-center'>-
                          <?php echo round($percent) ?> %
                        </span>
                      </div>
                    <?php } else { ?>
                      <div class='product-price-wrapper'>
                        <span class='sale-price text-xl font-bold'>
                          <?php echo $thePrice ?> ₽
                        </span>
                      </div>
                    <?php } ?>

                  </div>

                  <div class="text-lg md:text-xl mb-4">
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

                  <div class="flex gap-7 w-full items-center">
                    <!-- <a href="" class="btn w-36"><span>В корзину</span></a> -->

                    <div class="relative">
                      <?php
                      if ($in_cart) {
                        echo '<a href="' . esc_url($cart_url) . '" class="btn bg-primary text-center hover:ring-primary hover:ring-opacity-30" title="Просмотр корзины"><span>Уже в корзине</span></a>';
                      } else {
                        echo '<a href="' . esc_url($product->add_to_cart_url()) . '" data-quantity="1" class="btn w-36 button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="' . $product->get_id() . '" data-product_sku="' . esc_attr($product->get_sku()) . '" aria-label="' . esc_attr($product->add_to_cart_description()) . '" rel="nofollow">В корзину</a>';
                      }
                      ?>
                    </div>

                    <div href="#" class="btn-border share-link h-[50px] w-36 no-underline cursor-pointer" data-template="share">
                      <span>Поделиться</span>
                    </div>

                    <div style="display: none;">
                      <div id="share">
                        <div class="copy-link flex items-center gap-2 py-1 px-2 rounded text-white no-underline hover:bg-white hover:bg-opacity-5 cursor-pointer" data-clipboard-text="<?php echo $product_permalink; ?>">
                          <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3525 10.6075C13.3525 12.1235 12.1235 13.3525 10.6075 13.3525H3.745C2.22898 13.3525 1 12.1235 1 10.6075V3.745C1 2.22898 2.22898 1 3.745 1H10.6075C12.1235 1 13.3525 2.22898 13.3525 3.745V10.6075Z" stroke="white" stroke-width="1.40625" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.39258 16.0001H13.2551C14.7711 16.0001 16.0001 14.7711 16.0001 13.2551V6.39258" stroke="white" stroke-width="1.40625" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>

                          <span>Скопировать ссылку</span>
                        </div>
                        <a class="flex items-center gap-2 py-1 px-2 rounded text-white no-underline hover:bg-white hover:bg-opacity-5" target="_blank" href="https://t.me/share/url?url=<?php echo $product_permalink; ?>">
                          <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.919431 5.32028L9.85562 1.69424C10.7374 1.31653 13.728 0.107851 13.728 0.107851C13.728 0.107851 15.1082 -0.420947 14.9932 0.863276C14.9549 1.39207 14.6481 3.24286 14.3414 5.24765L13.3829 11.1806C13.3829 11.1806 13.3062 12.0494 12.6544 12.2005C12.0027 12.3515 10.9291 11.6717 10.7374 11.5206C10.5841 11.4073 7.86193 9.70756 6.86509 8.87659C6.59671 8.64997 6.28999 8.19671 6.90343 7.66791C8.28368 6.42146 9.9323 4.87284 10.9291 3.89079C11.3892 3.43753 11.8493 2.37994 9.9323 3.66416L4.5234 7.24662C4.5234 7.24662 3.90996 7.62433 2.75976 7.28439C1.60955 6.94445 0.26765 6.49119 0.26765 6.49119C0.26765 6.49119 -0.652512 5.92462 0.919431 5.32028Z" fill="white" />
                          </svg>

                          <span>
                            Telegram
                          </span>
                        </a>
                        <a class="flex items-center gap-2 py-1 px-2 rounded text-white no-underline hover:bg-white hover:bg-opacity-5" target="_blank" href="https://wa.me/?text=<?php echo $product_permalink; ?>">
                          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.361625 8.04636C0.361099 9.42399 0.72093 10.7688 1.40519 11.9542L0.295898 16.0044L4.44106 14.9175C5.58312 15.5403 6.86891 15.8685 8.17748 15.8691H8.18081C12.49 15.8691 15.9981 12.3621 16 8.0525C16.0007 5.9638 15.188 3.99988 13.7118 2.52235C12.2354 1.04499 10.2723 0.230857 8.18081 0.22998C3.87072 0.22998 0.363202 3.73628 0.36145 8.04619L0.361625 8.04636ZM2.82979 11.75L2.67503 11.5043C2.02442 10.4698 1.68106 9.27431 1.68142 8.04689C1.68299 4.4647 4.59827 1.55012 8.18309 1.55012C9.91915 1.55082 11.5506 2.22754 12.7778 3.45549C14.0049 4.68344 14.6802 6.31591 14.6797 8.0518C14.6781 11.6342 11.7626 14.5487 8.18064 14.5487H8.17801C7.01158 14.548 5.86776 14.235 4.87029 13.6429L4.6328 13.5022L2.17287 14.1472L2.82979 11.75ZM8.18081 15.8691C8.18064 15.8691 8.18064 15.8691 8.18081 15.8691Z" fill="white" />
                            <path d="M6.22678 4.77817C6.08043 4.45287 5.92636 4.44621 5.7872 4.4406C5.67327 4.43569 5.54287 4.43604 5.41282 4.43604C5.28242 4.43604 5.07087 4.48494 4.89192 4.68037C4.71279 4.87597 4.20801 5.3485 4.20801 6.30969C4.20801 7.27105 4.90822 8.19981 5.00567 8.33039C5.10347 8.46061 6.35736 10.4962 8.343 11.2793C9.99335 11.9301 10.3293 11.8008 10.6874 11.7682C11.0457 11.7356 11.8433 11.2956 12.0062 10.8394C12.169 10.3832 12.169 9.99213 12.1203 9.91063C12.0714 9.82913 11.9411 9.78023 11.7457 9.6826C11.5503 9.5848 10.5898 9.11227 10.4107 9.04707C10.2315 8.98187 10.1013 8.94944 9.97092 9.14505C9.84069 9.34047 9.46649 9.7804 9.35256 9.91063C9.23864 10.0412 9.12453 10.0575 8.92928 9.95971C8.73386 9.86173 8.10463 9.65561 7.35815 8.99011C6.77731 8.47218 6.38522 7.83279 6.2713 7.63719C6.15737 7.44176 6.2592 7.33607 6.35701 7.23862C6.44482 7.15116 6.55243 7.0106 6.65023 6.89649C6.74768 6.78239 6.78029 6.70089 6.84531 6.57067C6.91051 6.44026 6.87791 6.32616 6.82901 6.22836C6.78011 6.13056 6.40047 5.16447 6.22678 4.77817Z" fill="white" />
                          </svg>

                          <span>WhatsApp</span>

                        </a>
                        <a class="flex items-center gap-2 py-1 px-2 rounded text-white no-underline hover:bg-white hover:bg-opacity-5" target="_blank" href="https://vk.com/share.php?image=<?php echo get_the_post_thumbnail_url($product->ID); ?>&title=<?php echo get_the_title(); ?>&url=<?php echo $product_permalink; ?>">
                          <svg width="15" height="9" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33907 8.67315H8.23564C8.23564 8.67315 8.50639 8.64278 8.64483 8.49118C8.77208 8.35183 8.76801 8.09034 8.76801 8.09034C8.76801 8.09034 8.75047 6.86591 9.30873 6.6856C9.85927 6.50787 10.5661 7.86896 11.3151 8.39236C11.8816 8.78831 12.3121 8.70164 12.3121 8.70164L14.3153 8.67315C14.3153 8.67315 15.3632 8.60735 14.8663 7.76881C14.8256 7.70032 14.5768 7.14853 13.3768 6.01484C12.1206 4.82826 12.289 5.02023 13.8021 2.96774C14.7235 1.71778 15.0918 0.95471 14.9767 0.627905C14.8671 0.316528 14.1893 0.398781 14.1893 0.398781L11.9339 0.412973C11.9339 0.412973 11.7665 0.389804 11.6426 0.465282C11.5214 0.539094 11.4436 0.711555 11.4436 0.711555C11.4436 0.711555 11.0865 1.67875 10.6106 2.50143C9.60626 4.23712 9.20462 4.32899 9.04045 4.22104C8.65851 3.96982 8.75396 3.21203 8.75396 2.67352C8.75396 0.991374 9.00464 0.290025 8.2658 0.108479C8.02066 0.0482679 7.84007 0.00843181 7.21304 0.00192692C6.40822 -0.00640584 5.72722 0.00445387 5.34153 0.196752C5.08493 0.324647 4.88696 0.609573 5.0076 0.625969C5.15671 0.646183 5.49423 0.718705 5.67318 0.966537C5.90437 1.28668 5.89629 2.00534 5.89629 2.00534C5.89629 2.00534 6.02914 3.98547 5.58613 4.23136C5.28216 4.40006 4.86509 4.05568 3.96969 2.48095C3.511 1.67434 3.16455 0.782625 3.16455 0.782625C3.16455 0.782625 3.09784 0.616024 2.97868 0.526837C2.83416 0.41878 2.63223 0.384535 2.63223 0.384535L0.488906 0.398781C0.488906 0.398781 0.167232 0.40792 0.0490209 0.55033C-0.0561436 0.677095 0.0406232 0.938958 0.0406232 0.938958C0.0406232 0.938958 1.7185 4.93449 3.61854 6.948C5.36091 8.79433 7.33907 8.67315 7.33907 8.67315Z" fill="white" />
                          </svg>
                          <span>VK</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>


        <?php }
          echo '</ul>';
        endif;
        ?>


      </div>
    <?php else : ?>
      <div class="container">
        <div class="bg-white shadow max-w-sm mx-auto p-4 text-center">Вы не авторизованы</div>
      </div>
    <?php endif; ?>
  </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
