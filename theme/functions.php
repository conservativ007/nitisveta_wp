<?php

/**
 * Нити Света functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Нити_Света
 */

if (!defined('NITISVETA_VERSION')) {
    /*
     * Set the theme’s version number.
     *
     * This is used primarily for cache busting. If you use `npm run bundle`
     * to create your production build, the value below will be replaced in the
     * generated zip file with a timestamp, converted to base 36.
     */
    define('NITISVETA_VERSION', '0.1.0');
}

if (!defined('NITISVETA_TYPOGRAPHY_CLASSES')) {
    /*
     * Set Tailwind Typography classes for the front end, block editor and
     * classic editor using the constant below.
     *
     * For the front end, these classes are added by the `nitisveta_content_class`
     * function. You will see that function used everywhere an `entry-content`
     * or `page-content` class has been added to a wrapper element.
     *
     * For the block editor, these classes are converted to a JavaScript array
     * and then used by the `./javascript/block-editor.js` file, which adds
     * them to the appropriate elements in the block editor (and adds them
     * again when they’re removed.)
     *
     * For the classic editor (and anything using TinyMCE, like Advanced Custom
     * Fields), these classes are added to TinyMCE’s body class when it
     * initializes.
     */
    define(
        'NITISVETA_TYPOGRAPHY_CLASSES',
        'prose prose-neutral max-w-none prose-a:text-primary'
    );
}

if (!function_exists('nitisveta_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function nitisveta_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Нити Света, use a find and replace
         * to change 'nitisveta' to the name of your theme in all the template files.
         */
        load_theme_textdomain('nitisveta', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            [
                'menu-1' => __('Primary', 'nitisveta'),
                'menu-2' => __('Footer Menu', 'nitisveta'),
            ]
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            ]
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Enqueue editor styles.
        add_editor_style('style-editor.css');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        // Remove support for block templates.
        remove_theme_support('block-templates');
    }
endif;
add_action('after_setup_theme', 'nitisveta_setup');

function add_price_widget()
{
    $product = wc_get_product(get_the_ID());
    $thePrice = $product->get_price(); //will give raw price
    $regularPrice = $product->get_regular_price(); //will give raw price
    $discountValue = $regularPrice - $thePrice; //will give raw price

    $percent = (($regularPrice - $thePrice) / $regularPrice) * 100;

    if ($regularPrice != $thePrice) {
        echo "<div class='product-price-wrapper'>"
            .
            "<span class='sale-price'>" . $thePrice . ' ₽</span>'
            .
            "<span class='regular-price'>" . $regularPrice . ' ₽</span>'
            .
            "<span class='discount-percent'>-" . round($percent) . '% </span>'
            .
            '</div>';
    } else {
        echo "<div class='product-price-wrapper'>"
            .
            "<span class='sale-price'>" . $thePrice . ' ₽</span>'
            .
            '</div>';
    }
}

// include custom scripts
function nitisveta_scripts()
{
    wp_enqueue_style('nitisveta-swiper', get_template_directory_uri() . '/libraries/swiper-bundle.min.css', [], '', 'all');
    wp_enqueue_style('nitisveta-magnific', get_template_directory_uri() . '/libraries/magnific-popup.css', [], '', 'all');
    wp_enqueue_style('nitisveta-style', get_stylesheet_uri(), [], filemtime(get_template_directory() . '/style.css'), 'all');
    wp_enqueue_script('nitisveta-swiper', get_template_directory_uri() . '/libraries/swiper-bundle.min.js', [], NITISVETA_VERSION, true);
    wp_enqueue_script('nitisveta-magnific', get_template_directory_uri() . '/libraries/jquery.magnific-popup.min.js', [], NITISVETA_VERSION, true);
    wp_enqueue_script('nitisveta-script', get_template_directory_uri() . '/js/script.min.js', [], NITISVETA_VERSION, true);

    wp_enqueue_style(
        'select2-css',
        get_template_directory_uri() . '/assets/libs/select2/select2.min.css',
        [],
        '4.1.0'
    );

    wp_enqueue_script(
        'select2-js',
        get_template_directory_uri() . '/assets/libs/select2/select2.min.js',
        ['jquery'],
        '4.1.0',
        true
    );

    wp_localize_script('nitisveta-script', 'ajax_object', ['ajax_url' => admin_url('admin-ajax.php')]);

    wp_enqueue_script(
        'share-button',
        get_template_directory_uri() . '/assets/js/share-button.js',
        null,
        null,
        true
    );

    // show list of cities and search for cities
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
        null,
        null,
        true
    );

    wp_enqueue_script(
        'woocommerce_checkout_fields',
        get_template_directory_uri() . '/assets/js/woocommerce_checkout_fields.js',
        null,
        null,
        true
    );

    // кликабельные плашки в методах доставки СДЕК
    wp_enqueue_script(
        'clickable_shipping',
        get_template_directory_uri() . '/assets/js/clickable_shipping.js',
        null,
        null,
        true
    );

    // проверка после того как нажата кнопка "Оплатить картой или через СБП по QR коду"W
    wp_enqueue_script(
        'checkout_payment',
        get_template_directory_uri() . '/assets/js/checkout_payment.js',
        null,
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
        'translate_country_options.js',
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

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'nitisveta_scripts', 20);

/**
 * Enqueue the block editor script.
 */
function nitisveta_enqueue_block_editor_script()
{
    wp_enqueue_script(
        'nitisveta-editor',
        get_template_directory_uri() . '/js/block-editor.min.js',
        [
            'wp-blocks',
            'wp-edit-post',
        ],
        NITISVETA_VERSION,
        true
    );
}
add_action('enqueue_block_editor_assets', 'nitisveta_enqueue_block_editor_script');

/**
 * Enqueue the script necessary to support Tailwind Typography in the block
 * editor, using an inline script to create a JavaScript array containing the
 * Tailwind Typography classes from NITISVETA_TYPOGRAPHY_CLASSES.
 */
function nitisveta_enqueue_typography_script()
{
    if (is_admin()) {
        wp_enqueue_script(
            'nitisveta-typography',
            get_template_directory_uri() . '/js/tailwind-typography-classes.min.js',
            [
                'wp-blocks',
                'wp-edit-post',
            ],
            NITISVETA_VERSION,
            true
        );
        wp_add_inline_script('nitisveta-typography', "tailwindTypographyClasses = '" . esc_attr(NITISVETA_TYPOGRAPHY_CLASSES) . "'.split(' ');", 'before');
    }
}
add_action('enqueue_block_assets', 'nitisveta_enqueue_typography_script');

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function nitisveta_tinymce_add_class($settings)
{
    $settings['body_class'] = NITISVETA_TYPOGRAPHY_CLASSES;
    return $settings;
}
add_filter('tiny_mce_before_init', 'nitisveta_tinymce_add_class');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

add_action('wp_ajax_get_cart_count', 'get_cart_count');
add_action('wp_ajax_nopriv_get_cart_count', 'get_cart_count');

function get_cart_count()
{
    if (function_exists('WC')) {
        echo WC()->cart->get_cart_contents_count();
    }
    die();
}

function add_cart_count_fragment($fragments)
{
    $fragments['cart_count'] = WC()->cart->get_cart_contents_count();
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'add_cart_count_fragment');

if (defined('YITH_WCWL') && !function_exists('yith_wcwl_get_items_count')) {
    function yith_wcwl_get_items_count()
    {
        ob_start();
        $favCount = esc_html(yith_wcwl_count_all_products());
        $hiddenClass = '';
        if ($favCount == 0) {
            $hiddenClass = 'hidden';
        }
        ?>		
			<span class="yith-wcwl-items-count flex items-center justify-center rounded-full bg-red-500 text-white absolute top-[-12px] right-[-12px] w-[24px] h-[24px] border-2 border-white text-center text-xs font-bold <?php echo $hiddenClass; ?>">
				<?php echo $favCount; ?>
			</span>
		<?php
        return ob_get_clean();
    }

    add_shortcode('yith_wcwl_items_count', 'yith_wcwl_get_items_count');
}

if (defined('YITH_WCWL') && !function_exists('yith_wcwl_ajax_update_count')) {
    function yith_wcwl_ajax_update_count()
    {
        $count = yith_wcwl_count_all_products();
        wp_send_json(
            [
                'count' => yith_wcwl_count_all_products(),
                'hide' => ($count == 0)
            ]
        );
    }

    add_action('wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
    add_action('wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
}

if (defined('YITH_WCWL') && !function_exists('yith_wcwl_enqueue_custom_script')) {
    function yith_wcwl_enqueue_custom_script()
    {
        wp_add_inline_script(
            'jquery-yith-wcwl',
            "
		  jQuery( function( $ ) {
			$( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
			  $.get( yith_wcwl_l10n.ajax_url, {
				action: 'yith_wcwl_update_wishlist_count'
			  }, function( data ) {
				var countEl = $('.yith-wcwl-items-count'); // Исправлено здесь
                        countEl.html( data.count ); // Исправлено здесь
                        if (data.hide) {
                            countEl.addClass('hidden'); // Исправлено здесь
                        } else {
                            countEl.removeClass('hidden'); // Исправлено здесь
                        }
			  } );
			} );
		  } );
		"
        );
    }

    add_action('wp_enqueue_scripts', 'yith_wcwl_enqueue_custom_script', 20);
}

function get_product_quantity_in_cart($product_id)
{
    $quantity = 0;

    // Проверяем, инициализирована ли корзина
    if (WC()->cart) {
        // Перебираем все товары в корзине
        foreach (WC()->cart->get_cart() as $cart_item) {
            // Сравниваем ID продукта с каждым товаром в корзине
            if ($cart_item['product_id'] == $product_id) {
                // Суммируем количество, если находим совпадение
                $quantity += $cart_item['quantity'];
            }
        }
    }

    return $quantity;
}

add_filter('woocommerce_billing_fields', 'custom_override_billing_fields');
function custom_override_billing_fields($address_fields)
{
    $address_fields['billing_postcode']['required'] = false;
    // $address_fields['billing_state']['required'] = false;
    // $address_fields['billing_country']['required'] = false;
    $address_fields['billing_first_name']['placeholder'] = 'Имя и фамилия';
    $address_fields['billing_last_name']['required'] = false;
    // $address_fields['billing_phone']['required'] = false;
    $address_fields['billing_company']['required'] = false;

    $address_fields['billing_postcode']['placeholder'] = 'Индекс (если не находит город)';
    $address_fields['billing_state']['placeholder'] = 'Область';
    $address_fields['billing_address_1']['placeholder'] = 'Улица, дом, квартира';
    $address_fields['billing_address_1']['required'] = false;
    // unset($address_fields['billing_postcode']);
    // unset($address_fields['billing_state']);
    // unset($address_fields['billing_last_name']);
    unset($address_fields['billing_company']);
    // unset( $address_fields ['billing_phone'] );
    //не сработает unset( $address_fields ['billing_country'] );

    return $address_fields;
}

add_filter('woocommerce_checkout_fields', 'customize_woo_checkout_fields', 99);
function customize_woo_checkout_fields($fields)
{
    $fields['billing']['billing_first_name']['placeholder'] = 'Фамилия и имя';
    $fields['billing']['billing_first_name']['label'] = '';
    $fields['billing']['billing_last_name']['label'] = '';
    $fields['billing']['billing_country']['label'] = '';

    $fields['billing']['billing_phone']['label'] = '';
    $fields['billing']['billing_phone']['placeholder'] = 'Телефон';

    // unset($fields['billing']['billing_postcode']);

    unset($fields['billing']['billing_address_2'], $fields['billing_address_2'], $fields['billing']['billing_email'], $fields['shipping']['ship_to_different_address']);

    $fields['billing']['billing_address_1']['label'] = 'Адрес (Заполните только при доставке курьером)';
    $fields['billing_address_1']['required'] = false;
    $fields['order']['order_comments']['label'] = '';
    $fields['order']['order_comments']['placeholder'] = 'Комментарий (не обязательно)';

    // Передаем список городов в JavaScript
    $cities_by_country = [
        'RU' => [
            'Москва', 'Санкт-Петербург', 'Новосибирск', 'Екатеринбург', 'Казань',
            'Нижний Новгород', 'Красноярск', 'Челябинск', 'Самара', 'Уфа',
            'Ростов-на-Дону', 'Краснодар', 'Омск', 'Воронеж', 'Пермь',
            'Волгоград', 'Саратов', 'Тюмень', 'Тольятти', 'Ижевск',
            'Барнаул', 'Ульяновск', 'Иркутск', 'Хабаровск', 'Ярославль',
            'Владивосток', 'Махачкала', 'Томск', 'Оренбург', 'Кемерово',
            'Новокузнецк', 'Рязань', 'Астрахань', 'Пенза', 'Липецк',
            'Киров', 'Чебоксары', 'Балашиха', 'Калининград', 'Тула',
            'Курск', 'Севастополь', 'Ставрополь', 'Улан-Удэ', 'Тверь',
            'Магнитогорск', 'Иваново', 'Брянск', 'Белгород', 'Сочи'
        ],
        'BY' => [
            'Минск', 'Гомель', 'Могилёв', 'Витебск', 'Гродно', 'Брест', 'Бобруйск',
            'Барановичи', 'Борисов', 'Пинск', 'Орша', 'Мозырь', 'Лида', 'Солигорск',
            'Новое Медвежино', 'Малиновка', 'Молодечно', 'Новополоцк', 'Полоцк', 'Жлобин',
            'Светлогорск', 'Речица', 'Слуцк', 'Жодино', 'Слоним', 'Кобрин', 'Волковыск',
            'Калинковичи', 'Сморгонь', 'Рогачёв', 'Осиповичи', 'Горки', 'Новогрудок',
            'Вилейка', 'Берёза', 'Кричев', 'Лунинец', 'Дзержинск', 'Ивацевичи',
            'Глубокое', 'Поставы', 'Марьина Горка', 'Пружаны', 'Добруш', 'Быхов',
            'Лепель', 'Колодищи', 'Мосты', 'Щучин', 'Столбцы'
        ],
        'KZ' => [
            'Алматы', 'Астана', 'Шымкент', 'Актобе', 'Караганда', 'Тараз', 'Усть-Каменогорск',
            'Павлодар', 'Атырау', 'Семей', 'Кызылорда', 'Костанай', 'Актау', 'Уральск',
            'Петропавловск', 'Туркестан', 'Кокшетау', 'Темиртау', 'Талдыкорган', 'Экибастуз',
            'Рудный', 'Жезказган', 'Каскелен', 'Кентау', 'Жанаозен', 'Балхаш', 'Сатпаев',
            'Кульсары', 'Талгар', 'Сарыагаш', 'Зашаган', 'Бейнеу', 'Конаев', 'Жаркент',
            'Арыс', 'Косшы', 'Лисаковск', 'Байконур', 'Аягоз', 'Шу', 'Зыряновск',
            'Кандыагаш', 'Аксай', 'Жетикара', 'Есик', 'Арал', 'Текели', 'Каратау',
            'Сарыагаш', 'Атбасар'
        ],

        'KG' => [
            'Бишкек', 'Ош', 'Джалал-Абад', 'Каракол', 'Токмок', 'Нарын', 'Талас',
            'Баткен', 'Кант', 'Исфана', 'Кызыл-Кия', 'Сулюкта', 'Балыкчы', 'Кадамжай',
            'Таш-Кумыр', 'Кара-Балта', 'Кара-Суу', 'Чолпон-Ата', 'Таш-Кумыр', 'Кара-Балта',
            'Кара-Суу', 'Чолпон-Ата', 'Таш-Кумыр', 'Кара-Балта', 'Кара-Суу', 'Чолпон-Ата',
            'Таш-Кумыр', 'Кара-Балта', 'Кара-Суу', 'Чолпон-Ата', 'Таш-Кумыр', 'Кара-Балта',
            'Кара-Суу', 'Чолпон-Ата', 'Таш-Кумыр', 'Кара-Балта', 'Кара-Суу', 'Чолпон-Ата',
            'Таш-Кумыр', 'Кара-Балта', 'Кара-Суу', 'Чолпон-Ата', 'Таш-Кумыр', 'Кара-Балта',
            'Кара-Суу', 'Чолпон-Ата', 'Таш-Кумыр', 'Кара-Балта', 'Кара-Суу', 'Чолпон-Ата'
        ],
        'AM' => [
            'Ереван', 'Гюмри', 'Ванадзор', 'Вагаршапат', 'Гавар', 'Арташат', 'Абовян',
            'Раздан', 'Капан', 'Иджеван', 'Аштарак', 'Чаренцаван', 'Севан', 'Масис',
            'Горис', 'Арарат', 'Армавир', 'Дилижан', 'Сисиан', 'Алаверди', 'Спитак',
            'Степанаван', 'Варденис', 'Мартуни', 'Ехегнадзор', 'Веди', 'Нор Ачн',
            'Бюракан', 'Мецамор', 'Берд', 'Ташир', 'Каджаран', 'Апаран', 'Вайк',
            'Чамбарак', 'Маралик', 'Ноемберян', 'Талин', 'Мегри', 'Джермук', 'Агарак',
            'Айрум', 'Ахтала', 'Туманян', 'Цахкадзор', 'Шамлуг', 'Дастакерт',
        ]
    ];

    // pass the array of cities to JS file
    wp_localize_script('country_city_selector', 'citiesData', $cities_by_country);

    // Плейсхолдер списка городов
    $fields['billing']['billing_city'] = [
        'type' => 'select',
        'options' => ['' => 'город'],
        'class' => ['form-row-wide'],
        // 'label' => 'Город',
        'required' => true,
        'clear' => true,
    ];

    return $fields;
}

// add_filter('woocommerce_checkout_fields', 'custom_reorder_checkout_fields', 99);
function custom_reorder_checkout_fields($fields)
{
    $ordered_fields = [
        'billing_country' => $fields['billing']['billing_country'],
        // 'billing_last_name' => $fields['billing']['billing_last_name'],
        'billing_first_name' => $fields['billing']['billing_first_name'],
        'billing_phone' => $fields['billing']['billing_phone'],
        'billing_address_1' => $fields['billing']['billing_address_1'],
        'billing_address_1' => $fields['billing']['billing_city'],
    ];

    $fields['billing'] = $ordered_fields;
    return $fields;
}

add_filter('woocommerce_checkout_fields', 'disable_autocomplete_checkout_fields');

function disable_autocomplete_checkout_fields($fields)
{
    foreach ($fields as $section => $field_group) {
        foreach ($field_group as $key => $field) {
            $fields[$section][$key]['autocomplete'] = 'off';
        }
    }
    return $fields;
}

// Single Product
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_single_add_to_cart_text');
function custom_single_add_to_cart_text()
{
    return 'В корзину'; // Change this to change the text on the Single Product Add to cart button.
}

// Перевод "Checkout is not available whilst your cart is empty."
add_filter('woocommerce_checkout_not_available_message', function ($message) {
    return 'Оформление заказа недоступно, пока ваша корзина пуста.';
});

// Перевод "Your cart is currently empty."
add_filter('wc_empty_cart_message', function ($message) {
    return 'Ваша корзина пуста.';
});

// Перевод "Return to shop"
add_filter('woocommerce_return_to_shop_text', function ($text) {
    return 'Вернуться в магазин';
});

add_filter('gettext', function ($translated_text, $text, $domain) {
    // Перевод "Checkout is not available whilst your cart is empty."
    if ('Checkout is not available whilst your cart is empty.' === $text) {
        return 'Оформление заказа недоступно, пока ваша корзина пуста.';
    }
    // Перевод "Your cart is currently empty."
    if ('Your cart is currently empty.' === $text) {
        return 'Ваша корзина пуста.';
    }
    // Перевод "Return to shop"
    if ('Return to shop' === $text) {
        return 'Вернуться в магазин';
    }
    return $translated_text;
}, 10, 3);

add_filter('woocommerce_order_button_text', function () {
    return 'Оплатить картой или через СБП по QR коду';
});

function my_custom_shipping_table_update($fragments)
{
    ob_start();
    ?>
	<div class="my-custom-shipping-table">
		<?php wc_cart_totals_shipping_html(); ?>
	</div>
<?php
    $woocommerce_shipping_methods = ob_get_clean();
    $fragments['.my-custom-shipping-table'] = $woocommerce_shipping_methods;
    return $fragments;
}
add_filter('woocommerce_update_order_review_fragments', 'my_custom_shipping_table_update');

add_filter('woocommerce_default_address_fields', 'custom_woocommerce_default_address_fields', 20);
function custom_woocommerce_default_address_fields($fields)
{
    $fields['city']['label'] = '';
    $fields['state']['required'] = false;
    $fields['address_1']['placeholder'] = 'Адрес пункта выдачи заказов или ваш адрес для курьера';
    // $fields['city']['placeholder'] = 'Город';
    $fields['address_1']['label'] = false;
    // 	unset($fields["state"]);

    return $fields;
}

function change_view_cart($params, $handle)
{
    switch ($handle) {
        case 'wc-add-to-cart':
            $params['i18n_view_cart'] = 'Уже в корзине'; //chnage Name of view cart button
            break;
    }
    return $params;
}
add_filter('woocommerce_get_script_data', 'change_view_cart', 10, 2);

function change_view_cart_2($params, $handle)
{
    switch ($handle) {
        case 'wc-add-to-cart-2':
            $params['i18n_view_cart'] = 'Уже в корзине'; //chnage Name of view cart button
            break;
    }
    return $params;
}
add_filter('woocommerce_get_script_data', 'change_view_cart_2', 10, 2);

function echo_1($data)
{
    echo $data[0] . ' ' . $data[1] . '!';
}

// привяжем функции к хуку
add_action('my_hook', 'echo_1');

// function my_custom_function($params, $handle) {
// 	switch ($handle) {
// 			case 'wc-add-to-cart':
// 					$params['i18n_view_cart'] = "Уже в корзине"; // Change name of view cart button
// 					break;
// 			case 'wc-add-to-cart2':
// 					$params['i18n_view_cart'] = "42"; // Change name of view cart button
// 					break;
// 	}
// 	return $params;
// }

// Add your function as a hook handler
// add_filter('woocommerce_get_script_data', 'my_custom_function', 10, 2);

add_filter('woocommerce_cart_shipping_method_full_label', 'custom_shipping_label', 10, 2);
function custom_shipping_label($label, $method)
{
    if (strpos($label, 'Доставка') !== false) {
        $label = str_replace('Доставка', '', $label); // Удаление или замена текста "Доставка"
    }
    return $label;
}

add_action('woocommerce_thankyou', 'redirectcustom');

function redirectcustom($order_id)
{
    $order = wc_get_order($order_id);
    $url = '/thank-you'; // Относительный URL
    if (!$order->has_status('failed')) {
        wp_safe_redirect($url);
        exit;
    }
}

function filter_woocommerce_cart_totals_coupon_html($coupon_html, $coupon, $discount_amount_html)
{
    // Change text
    $coupon_html = $discount_amount_html . ' <a href="' . esc_url(add_query_arg('remove_coupon', rawurlencode($coupon->get_code()), defined('WOOCOMMERCE_CHECKOUT') ? wc_get_checkout_url() : wc_get_cart_url())) . '" class="woocommerce-remove-coupon btn bg-gray text-base !text-white no-underline inline-flex h-10 ml-4" data-coupon="' . esc_attr($coupon->get_code()) . '">' . __('Убрать', 'woocommerce') . '</a>';

    return $coupon_html;
}
add_filter('woocommerce_cart_totals_coupon_html', 'filter_woocommerce_cart_totals_coupon_html', 10, 3);

function handle_profile_update()
{
    // Проверка nonce для безопасности
    check_ajax_referer('profile-nonce', 'profile_nonce');

    // Получение текущего пользователя
    $user_id = get_current_user_id();
    if (!$user_id) {
        wp_send_json_error('Пользователь не авторизован.');
        return;
    }

    // Обработка и обновление данных пользователя
    $user_data = ['ID' => $user_id];
    if (!empty($_POST['email'])) {
        $user_data['user_email'] = sanitize_email($_POST['email']);
    }
    if (!empty($_POST['first_name'])) {
        $user_data['first_name'] = sanitize_text_field($_POST['first_name']);
    }
    if (!empty($_POST['new_password'])) {
        $user_data['user_pass'] = $_POST['new_password'];
    }

    $update_user_result = wp_update_user($user_data);
    if (is_wp_error($update_user_result)) {
        wp_send_json_error($update_user_result->get_error_message());
        return;
    }

    // Обновление метаданных пользователя
    update_user_meta($user_id, 'billing_phone', sanitize_text_field($_POST['phone']));
    update_user_meta($user_id, 'billing_country', sanitize_text_field($_POST['country']));
    update_user_meta($user_id, 'billing_city', sanitize_text_field($_POST['town']));

    wp_send_json_success('Профиль успешно обновлен.');
}
add_action('wp_ajax_handle_profile_update', 'handle_profile_update');

add_filter('woocommerce_package_rates', 'limit_shipping_to_cities', 10, 2);

function limit_shipping_to_cities($rates, $package)
{
    $allowed_cities = ['Москва', 'Санкт-Петербург']; // Разрешённые города
    $customer_city = WC()->customer->get_shipping_city(); // Получаем город доставки клиента

    foreach ($rates as $rate_id => $rate) {
        if ($rate->method_id === 'flat_rate:10' && !in_array($customer_city, $allowed_cities)) {
            unset($rates[$rate_id]); // Удаляем метод доставки, если город не входит в список
        }
    }

    return $rates;
}

function enqueue_theme_styles()
{
    wp_enqueue_style('theme-main', get_template_directory_uri() . '/assets/css/woocommerce_checkout_fields.css', [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

// add_action('um_registration_complete', 'custom_um_registration_redirect', 10, 1);
// function custom_um_registration_redirect($user_id)
// {
// 	um_fetch_user($user_id);
// 	UM()->user()->auto_login($user_id);

// 	if ($_SERVER['REQUEST_URI'] == '/cart') {
// 		wp_redirect(home_url('/cart'));
// 	} elseif ($_SERVER['REQUEST_URI'] == '/loginregister') {
// 		wp_redirect(home_url('/profile'));
// 	} else {
// 		// Здесь может быть стандартное перенаправление, если не выполняется ни одно из условий выше
// 		wp_redirect(home_url('/checkout'));
// 	}
// 	exit;
// }

function add_custom_class_to_html_tag()
{
    // Получаем текущий URL
    $current_url = home_url(add_query_arg([], $_SERVER['REQUEST_URI']));

    // Проверяем, есть ли в URL строка '/checkout'
    if (strpos($current_url, '/checkout') !== false) {
        // Добавляем класс к тегу <html> если URL содержит '/checkout'
        echo '<script>
            document.documentElement.classList.add("html-overflow-x");
        </script>';
    } else {
        // Убираем класс, если URL не содержит '/checkout'
        echo '<script>
            document.documentElement.classList.remove("html-overflow-x");
        </script>';
    }
}

add_action('wp_head', 'add_custom_class_to_html_tag');

// --------------------------------
// очистка корзины
// Этот хук вызывается сразу после создания заказа, но ещё до перенаправления на платёжный шлюз.
// корзина будет очищена даже если оплата не прошла.
// чтобы очищалась только после успешной оплаты, нужно использовать woocommerce_payment_complete
// add_action('woocommerce_checkout_order_processed', function ($order_id, $posted_data, $order) {
//     if (WC()->cart) {
//         WC()->cart->empty_cart();
//     }
// }, 10, 3);

add_action('woocommerce_payment_complete', function ($order_id) {
    if (WC()->cart) {
        WC()->cart->empty_cart();
    }
});
