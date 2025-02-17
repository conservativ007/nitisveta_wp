<?php

/**
 * Add to wishlist template
 *
 * @author YITH
 * @package YITH\Wishlist\Templates\AddToWishlist
 * @version 3.0.0
 */

/**
 * Template variables:
 *
 * @var $wishlist_url              string Url to wishlist page
 * @var $exists                    bool Whether current product is already in wishlist
 * @var $show_exists               bool Whether to show already in wishlist link on multi wishlist
 * @var $show_count                bool Whether to show count of times item was added to wishlist
 * @var $product_id                int Current product id
 * @var $product_type              string Current product type
 * @var $label                     string Button label
 * @var $browse_wishlist_text      string Browse wishlist text
 * @var $already_in_wishslist_text string Already in wishlist text
 * @var $product_added_text        string Product added text
 * @var $icon                      string Icon for Add to Wishlist button
 * @var $link_classes              string Classed for Add to Wishlist button
 * @var $available_multi_wishlist  bool Whether add to wishlist is available or not
 * @var $disable_wishlist          bool Whether wishlist is disabled or not
 * @var $template_part             string Template part
 * @var $container_classes         string Container classes
 * @var $fragment_options          array Array of data to send through ajax calls
 * @var $ajax_loading              bool Whether ajax loading is enabled or not
 * @var $var                       array Array of available template variables
 */

if (!defined('YITH_WCWL')) {
	exit;
} // Exit if accessed directly

global $product;
?>

<div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr($product_id); ?> <?php echo esc_attr($container_classes); ?> wishlist-fragment on-first-load" data-fragment-ref="<?php echo esc_attr($product_id); ?>" data-fragment-options="<?php echo wc_esc_json(wp_json_encode($fragment_options)); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																																																																?>">

	<?php if (!$ajax_loading) : ?>
		<?php if (!($disable_wishlist && !is_user_logged_in())) : ?>

			<!-- ADD TO WISHLIST -->
			<?php yith_wcwl_get_template('add-to-wishlist-' . $template_part . '.php', $var); ?>
			<!-- COUNT TEXT -->
			<?php
			if ($show_count) :
				echo wp_kses_post(yith_wcwl_get_count_text($product_id));
			endif;
			?>

		<?php else : ?>
			<?php
			$login_url = add_query_arg(
				array(
					'wishlist_notice' => 'true',
					'add_to_wishlist' => $product_id,
				),
				get_permalink(wc_get_page_id('myaccount'))
			);
			?>

			<div class="yith-wcwl-add-button">
				<a href="<?php echo esc_url($login_url); ?>" class="disabled_item <?php echo esc_attr(str_replace(array('add_to_wishlist', 'single_add_to_wishlist'), '', $link_classes)); ?>" rel="nofollow">
					<?php if (is_product()) {
						echo 'single page';
					} ?>
					<div class="like-button">

						<label>
							<svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg" stroke-linecap="round" stroke-linejoin="round">
								<g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
									<path d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z" id="heart" />
									<circle class="circle" cx="29.5" cy="29.5" r="1.5" stroke="#CD85E7" stroke-width="0 " />

									<g id="grp7" opacity="0" transform="translate(7 6)">
										<circle id="oval1" fill="#9CD8C3" cx="2" cy="6" r="2" />
										<circle id="oval2" fill="#8CE8C3" cx="5" cy="2" r="2" />
									</g>

									<g id="grp6" opacity="0" transform="translate(0 28)">
										<circle id="oval1" fill="#CC8EF5" cx="2" cy="7" r="2" />
										<circle id="oval2" fill="#91D2FA" cx="3" cy="2" r="2" />
									</g>

									<g id="grp3" opacity="0" transform="translate(52 28)">
										<circle id="oval2" fill="#9CD8C3" cx="2" cy="7" r="2" />
										<circle id="oval1" fill="#8CE8C3" cx="4" cy="2" r="2" />
									</g>

									<g id="grp2" opacity="0" transform="translate(44 6)">
										<circle id="oval2" fill="#CC8EF5" cx="5" cy="6" r="2" />
										<circle id="oval1" fill="#CC8EF5" cx="2" cy="2" r="2" />
									</g>

									<g id="grp5" opacity="0" transform="translate(14 50)">
										<circle id="oval1" fill="#91D2FA" cx="6" cy="5" r="2" />
										<circle id="oval2" fill="#91D2FA" cx="2" cy="2" r="2" />
									</g>

									<g id="grp4" opacity="0" transform="translate(35 50)">
										<circle id="oval1" fill="#F48EA7" cx="6" cy="5" r="2" />
										<circle id="oval2" fill="#F48EA7" cx="2" cy="2" r="2" />
									</g>

									<g id="grp1" opacity="0" transform="translate(24)">
										<circle id="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2" />
										<circle id="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2" />
									</g>
								</g>
							</svg>
						</label>
					</div>
					<?php
					// echo yith_wcwl_kses_icon( $icon );
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
					<?php
					// echo esc_html( $label );
					?>
				</a>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</div>