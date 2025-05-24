<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<!-- <a href="#test-popup" class="open-popup-link">Show inline popup</a> -->

<form class="woocommerce-cart-form container" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
  <?php do_action('woocommerce_before_cart_table'); ?>

  <?php
  foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
      $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
      $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
      /**
       * Filter the product name.
       *
       * @since 2.1.0
       * @param string $product_name Name of the product in the cart.
       * @param array $cart_item The product in the cart.
       * @param string $cart_item_key Key for the product in the cart.
       */
      $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

      if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
          $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);

          $product_id = $_product->get_id();
          $product_permalink = $_product->get_permalink();
          $cart_url = wc_get_cart_url(); // Получить URL корзины
          $in_cart = false;

          $ucenennyj_value = $_product->get_attribute('pa_ucenennyj');
          $ucenenn = '';
          if ('да' === strtolower($ucenennyj_value)) {
              $ucenenn = 'уцененный';
          }

          ?>
      <div class="woocommerce-cart-form__cart-item bg-white shadow mb-2 relative <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

        <div class="md:grid md:grid-cols-8">

          <div class="prod-thumb h-64 md:h-auto md:col-span-3 relative">

            <?php if ($ucenenn) : ?>
              <div class="absolute flex justify-center top-0 left-0 w-full">
                <div class="bg-primary text-white flex items-center h-9 px-8 font-title text-xl rounded-b-lg z-10">
                  уцененный</div>
              </div>

            <?php endif; ?>

            <?php $attachment_ids = $_product->get_gallery_image_ids(); ?>

            <div class="swiper h-64 md:h-80 select-none gallery-cart bg-white border-r border-[#f6f6f6]">
              <div class="swiper-wrapper">

                <div class="swiper-slide h-64 md:h-80 w-full">
                  <img src="<?php echo get_the_post_thumbnail_url($product_id); ?>" class="object-contain object-center h-full w-full m-0" />
                </div>

                <?php foreach ($attachment_ids as $attachment_id) { ?>
                  <div class="swiper-slide h-80 w-full">
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
                          echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s" class="no-underline text-lg md:text-xl font-bold">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                      }

          do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

          // Meta data.
          echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

          // Backorder notification.
          if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
              echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
          }
          ?>
            </div>

            <div class="mb-1 md:mb-4">

              <?php
          $thePrice = $_product->get_price(); //will give raw price
          $regularPrice = $_product->get_regular_price(); //will give raw price
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
          if ($_product->is_in_stock()) {
              $availability = __('В наличии', 'woocommerce');
          }
          if ($_product->get_stock_quantity() > 1) {
              $availability = __('Осталось на складе: ', 'woocommerce') . $_product->get_stock_quantity() . ' шт.';
          }
          // Change in Stock Text to only 1 or 2 left
          if ($_product->is_in_stock() && $_product->get_stock_quantity() <= 1 && $_product->get_stock_quantity() > 0) {
              $availability = __('Осталась 1 шт.', 'woocommerce');
          }
          if (!$_product->is_in_stock()) {
              $availability = __('Нет в наличии', 'woocommerce');
          }
          echo $availability;
          ?>
            </div>

            <td class="product-quantity  mt-4" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
              <?php
          if ($_product->is_sold_individually()) {
              $min_quantity = 1;
              $max_quantity = 1;
          } else {
              $min_quantity = 0;
              $max_quantity = $_product->get_max_purchase_quantity();
          } ?>

              <div class="flex">

                <button type="button" class="quantity-decrease w-12 h-12 rounded-l bg-primary flex items-center justify-center text-white">-</button>

                <?php
            $product_quantity = woocommerce_quantity_input(
                [
                              'input_name' => "cart[{$cart_item_key}][qty]",
                              'input_value' => $cart_item['quantity'],
                              'max_value' => $max_quantity,
                              'min_value' => $min_quantity,
                              'product_name' => $product_name,
                            ],
                $_product,
                false
            );

          echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
          ?>

                <button type="button" class="quantity-increase w-12 h-12 rounded-r bg-primary flex items-center justify-center text-white">+</button>

              </div>


            </td>
            <td class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
              <?php
              // echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
          ?>
            </td>
          </div>

        </div>

        <div class="product-remove absolute lg:right-3 lg:top-3 right-1 top-1 z-10">
          <?php
          echo apply_filters(
              // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
              'woocommerce_cart_item_remove_link',
              sprintf(
                  '<a href="%s" class="remove text-primary w-6 h-6 flex items-center justify-center" aria-label="%s" data-product_id="%s" data-product_sku="%s">
										<span  class="w-full h-full flex items-center justify-center"><svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
										<line x1="21" y1="2.82843" x2="2.82843" y2="21" stroke="#3B2F4A" stroke-width="4" stroke-linecap="round"/>
										<line x1="2" y1="-2" x2="27.6985" y2="-2" transform="matrix(0.707107 0.707107 0.707107 -0.707107 3 0)" stroke="#3B2F4A" stroke-width="4" stroke-linecap="round"/>
										</svg></span>

										</a>',
                  esc_url(wc_get_cart_remove_url($cart_item_key)),
                  /* translators: %s is the product name */
                  esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                  esc_attr($product_id),
                  esc_attr($_product->get_sku())
              ),
              $cart_item_key
          );
          ?>
        </div>
      </div>
  <?php
      }
  }
?>

  <button type="submit" class="update-cart-button hidden button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> " name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>">
    <?php esc_html_e('Update cart', 'woocommerce'); ?>
  </button>

  <div class="bg-white shadow p-3 md:p-7 ">

    <?php if (wc_coupons_enabled()) { ?>
      <div class="coupon flex items-center h-12 w-full">
        <label for="coupon_code" class="screen-reader-text">
          <?php esc_html_e('Coupon:', 'woocommerce'); ?>
        </label>

        <input type="text" name="coupon_code" class="input-text text-left text-sm md:text-base md:text-center border md:pl-6 border-gray rounded-l rounded-r-none border-r-0 h-full flex w-full max-w-none " id="coupon_code" value="" placeholder="Введите ваш промо код" />

        <button type="submit" class="submit_coupon bg-primary shrink-0 px-1 text-white h-full flex items-center justify-center rounded-r w-1/3" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
          <?php esc_html_e('Применить', 'woocommerce'); ?>
        </button>
        <?php do_action('woocommerce_cart_coupon'); ?>
      </div>
    <?php } ?>
    <?php do_action('woocommerce_cart_actions'); ?>
    <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>

    <?php do_action('woocommerce_before_cart_collaterals'); ?>

    <div class="cart-collaterals">
      <?php
    /**
     * Cart collaterals hook.
     *
     * @hooked woocommerce_cross_sell_display
     * @hooked woocommerce_cart_totals - 10
     */
    // do_action( 'woocommerce_cart_collaterals' );
    // woocommerce_cart_totals();

    function get_cart_total()
    {
        return WC()->cart->get_cart_contents_total();
    }

function get_discount_total()
{
    $discount_total = 0;

    foreach (WC()->cart->get_cart() as $cart_item) {
        $product = $cart_item['data'];
        if ($product->is_on_sale()) {
            $regular_price = $product->get_regular_price();
            $sale_price = $product->get_sale_price();
            $discount = ($regular_price - $sale_price) * $cart_item['quantity'];
            $discount_total += $discount;
        }
    }

    return $discount_total;
}

?>
      <div class="text-center text-lg md:text-xl font-bold mt-4 mb-1 md:mt-6 custom-cart">

        <div>Товаров на:
          <?php echo get_cart_total(); ?> ₽
        </div>
        <!-- <div>Экономия:
          <?php echo get_discount_total(); ?> ₽
        </div> -->
        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
				<td>
					Купон: <?php echo wc_cart_totals_coupon_html($coupon); ?>
				</td>
			</tr>
		<?php endforeach; ?>

      </div>
    </div>
  </div>

  <?php if (is_user_logged_in()) : ?>
    <a href="/checkout" class="btn mt-4 mb-8"><span>Выбрать доставку</span></a>
  <?php else : ?>
    <!-- <a href="#test-popup" class="btn mt-4 mb-8 open-popup-link login-popup-link"><span>Выбрать доставку</span></a> -->
    <a href="/checkout" class="btn mt-4 mb-8"><span>Выбрать доставку</span></a>
  <?php endif; ?>

  <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents hidden" cellspacing="0">
    <tbody>
      <?php do_action('woocommerce_before_cart_contents'); ?>

      <?php do_action('woocommerce_cart_contents'); ?>

      <tr>
        <td colspan="6" class="actions">
        </td>
      </tr>

      <?php do_action('woocommerce_after_cart_contents'); ?>
    </tbody>
  </table>
  <?php do_action('woocommerce_after_cart_table'); ?>
</form>



<?php do_action('woocommerce_after_cart'); ?>