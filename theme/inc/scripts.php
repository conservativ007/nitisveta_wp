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
      'checkout-select2-settings',
      get_template_directory_uri() . '/assets/js/checkout-select2-settings.js',
      ['jquery', 'select2-js'],
      null,
      true
    );

    wp_enqueue_script(
      'checkout-city-select',
      get_template_directory_uri() . '/assets/js/checkout-city-select.js',
      ['jquery', 'select2-js'],
      null,
      true
    );

    wp_enqueue_script(
      'cdek-shipping-labels',
      get_template_directory_uri() . '/assets/js/cdek-shipping-labels.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'cdek-pickup-notice',
      get_template_directory_uri() . '/assets/js/cdek-pickup-notice.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'checkout-shipping-cards',
      get_template_directory_uri() . '/assets/js/checkout-shipping-cards.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'checkout-place-order-validation',
      get_template_directory_uri() . '/assets/js/checkout-place-order-validation.js',
      ['jquery', 'toast-helper'],
      null,
      true
    );

    wp_enqueue_script(
      'cdek-courier-address-toggle',
      get_template_directory_uri() . '/assets/js/cdek-courier-address-toggle.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'cdek-courier-address-field',
      get_template_directory_uri() . '/assets/js/cdek-courier-address-field.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'checkout-country-labels',
      get_template_directory_uri() . '/assets/js/checkout-country-labels.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'checkout-select2-placeholders',
      get_template_directory_uri() . '/assets/js/checkout-select2-placeholders.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'checkout-notice-translations',
      get_stylesheet_directory_uri() . '/assets/js/checkout-notice-translations.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'checkout-city-placeholder',
      get_stylesheet_directory_uri() . '/assets/js/checkout-city-placeholder.js',
      ['jquery'],
      null,
      true
    );

    wp_enqueue_script(
      'checkout-city-submit-toggle',
      get_stylesheet_directory_uri() . '/assets/js/checkout-city-submit-toggle.js',
      ['jquery'],
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
