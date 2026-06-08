<?php
// include custom scripts

add_action('wp_enqueue_scripts', 'nitisveta_scripts', 20);

function nitisveta_scripts()
{
  wp_enqueue_style('nitisveta-swiper', get_template_directory_uri() . '/assets/libs/swiper-bundle.min.css', [], '', 'all');
  wp_enqueue_style('nitisveta-magnific', get_template_directory_uri() . '/assets/libs/magnific-popup.css', [], '', 'all');
  wp_enqueue_style('nitisveta-style', get_stylesheet_uri(), [], filemtime(get_template_directory() . '/style.css'), 'all');
  wp_enqueue_style('cart', get_template_directory_uri() . '/assets/css/cart.css', [], '', 'all');
  wp_enqueue_script('nitisveta-swiper', get_template_directory_uri() . '/assets/libs/swiper-bundle.min.js', [], NITISVETA_VERSION, true);
  wp_enqueue_script('nitisveta-magnific', get_template_directory_uri() . '/assets/libs/jquery.magnific-popup.min.js', ['jquery'], NITISVETA_VERSION, true);
  wp_enqueue_script('nitisveta-script', get_template_directory_uri() . '/assets/jsmin/script.min.js', ['jquery', 'nitisveta-swiper', 'nitisveta-magnific'], NITISVETA_VERSION, true);
  // wp_enqueue_script('nitisveta-script', get_template_directory_uri() . '/js/script.min.js', [], NITISVETA_VERSION, true);

  wp_localize_script('nitisveta-script', 'ajax_object', ['ajax_url' => admin_url('admin-ajax.php')]);

  wp_enqueue_script(
    'share-button',
    get_template_directory_uri() . '/assets/js/share-button.js',
    null,
    null,
    true
  );

  if (is_checkout()) {
    wp_enqueue_style(
      'select2-css',
      get_template_directory_uri() . '/assets/libs/select2/css/select2.css',
      [],
      '4.1.0'
    );

    wp_enqueue_style(
      'theme-main',
      get_template_directory_uri() . '/assets/css/woocommerce_checkout_fields.css',
      [],
      '1.0.0'
    );

    wp_enqueue_script(
      'select2-js',
      get_template_directory_uri() . '/assets/libs/select2/js/select2.js',
      ['jquery'],
      '4.1.0',
      true
    );

    wp_enqueue_script(
      'select2-settings',
      get_template_directory_uri() . '/assets/js/select2-settings.js',
      ['jquery', 'select2-js'],
      null,
      true
    );

    // rotate arrow in (cities and countries) for the select2
    wp_enqueue_script(
      'country_city_selector',
      get_template_directory_uri() . '/assets/js/country_city_selector.js',
      ['jquery', 'select2-js'],
      null,
      true
    );

    wp_enqueue_script(
      'update_cdek_fields',
      get_template_directory_uri() . '/assets/js/update_cdek_fields.js',
      [],
      null,
      true
    );

    wp_enqueue_script(
      'woocommerce_checkout_fields',
      get_template_directory_uri() . '/assets/js/woocommerce_checkout_fields.js',
      [],
      null,
      true
    );

    // кликабельные плашки в методах доставки СДЕК
    wp_enqueue_script(
      'clickable_shipping',
      get_template_directory_uri() . '/assets/js/clickable_shipping.js',
      [],
      null,
      true
    );

    // проверка после того как нажата кнопка "Оплатить картой или через СБП по QR коду"
    wp_enqueue_script(
      'checkout_payment',
      get_template_directory_uri() . '/assets/js/checkout_payment.js',
      [],
      null,
      true
    );

    // shippingObserver
    wp_enqueue_script(
      'shippingObserver',
      get_template_directory_uri() . '/assets/js/shippingObserver.js',
      [],
      null,
      true
    );

    // waiting for the #shipping_method block to appear,
    // clones #billing_address_1_field into the first <li> inside this block,
    // and cleans up the clone's style.
    wp_enqueue_script(
      'clone-billing-field-on-shipping',
      get_template_directory_uri() . '/assets/js/clone-billing-field-on-shipping.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'translate_country_options',
      get_template_directory_uri() . '/assets/js/translate_country_options.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'custom-city-select-placeholder',
      get_template_directory_uri() . '/assets/js/custom-city-select-placeholder.js',
      ['jquery'],
      null,
      true
    );

    // translated the some woocommerce notifies
    wp_enqueue_script(
      'woo-notice-translate',
      get_stylesheet_directory_uri() . '/assets/js/woo-notice-translate.js',
      [],
      null,
      true
    );

    wp_enqueue_script(
      'billing-city-placeholder',
      get_stylesheet_directory_uri() . '/assets/js/billing-city-placeholder.js',
      [],
      null,
      true
    );

    wp_enqueue_script(
      'checkout-city-toggle-button',
      get_stylesheet_directory_uri() . '/assets/js/checkout-city-toggle-button.js',
      [],
      null,
      true
    );

    // toastify
    wp_enqueue_script(
      'toastify',
      get_template_directory_uri() . '/assets/libs/toastify/toastify.js',
      [],
      null,
      true
    );
    wp_enqueue_style(
      'toastify',
      get_template_directory_uri() . '/assets/libs/toastify/toastify.css',
      [],
      '4.1.0'
    );
    wp_enqueue_script(
      'toast-helper',
      get_stylesheet_directory_uri() . '/assets/js/toast/toast.js',
      ['toastify'],
      null,
      true
    );

    //   wp_enqueue_style(
    //   'select2-css',
    //   get_template_directory_uri() . '/assets/libs/select2/css/select2.css',
    //   [],
    //   '4.1.0'
    // );

    // wp_enqueue_script(
    //   'test',
    //   get_stylesheet_directory_uri() . '/assets/js/test.js',
    //   [],
    //   null,
    //   true
    // );
  }

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
