<?php

/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;

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
<table class="shop_table woocommerce-checkout-review-order-table">

	<?php
    // if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()):
?>

	<?php
    // do_action('woocommerce_review_order_before_shipping');
?>

	<?php
    // wc_cart_totals_shipping_html();
?>

	<?php
    // do_action('woocommerce_review_order_after_shipping');
?>

	<?php
    // endif;
?>

	<thead>

	</thead>
	<tbody>
		<?php
    do_action('woocommerce_review_order_before_cart_contents');

foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
        ?>
				<!-- <tr
					class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
					<td class="product-name">
						<?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>
						<?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</strong>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        ?>
						<?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        ?>
					</td>
					<td class="product-total">
						<?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        ?>
					</td>
				</tr> -->
		<?php
    }
}

do_action('woocommerce_review_order_after_cart_contents');
?>
	</tbody>

	<tfoot>

		<span class="cart-subtotal">
			<tr class="flex flex-col items-center">

				<!-- <td>
					<img class="" src="<?php echo get_template_directory_uri(); ?>/images/1.png">
				</td> -->

				<td class="mb-5">
					<a class="no-underline font-normal text-[16px] sm:text-[18px]" href="https://t.me/nitisveta" target="_blank" rel="noopener noreferrer">Возникли сложности? Напишите в Телеграм и мы оформим заказ вручную <span class="text-red-500">&#8594;</span></a>
				</td>

				<td>
					Товаров на:
					<?php wc_cart_totals_subtotal_html(); ?>
				</td>
			</tr>


		</span>

		<?php foreach (WC()->cart->get_fees() as $fee) : ?>
			<tr class="fee">
				<th>
					<?php echo esc_html($fee->name); ?>
				</th>
				<td>
					<?php wc_cart_totals_fee_html($fee); ?>
				</td>
			</tr>
		<?php endforeach; ?>



		<?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
			<?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
				<?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				    ?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
						<th>
							<?php echo esc_html($tax->label); ?>
						</th>
						<td>
							<?php echo wp_kses_post($tax->formatted_amount); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<td>
						<?php wc_cart_totals_taxes_total_html(); ?>
					</td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>



		<?php do_action('woocommerce_review_order_before_order_total'); ?>

		<!-- <tr>
			<td>Экономия:
				<?php echo get_discount_total(); ?>₽
			</td>
		</tr>  -->




		<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
				<td>
					<!-- <?php wc_cart_totals_coupon_label($coupon); ?>
					<?php wc_cart_totals_coupon_html($coupon); ?> -->
					Купон: <?php echo wc_cart_totals_coupon_html($coupon); ?>
				</td>
			</tr>
		<?php endforeach; ?>

		<tr class="order-total">
			<td>
				Итого с доставкой:
				<?php wc_cart_totals_order_total_html(); ?>
			</td>
		</tr>

		<?php do_action('woocommerce_review_order_after_order_total'); ?>


	</tfoot>


</table>