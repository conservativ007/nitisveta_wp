<?php

/**
 * Add to wishlist button template - Remove button
 *
 * @author YITH
 * @package YITH\Wishlist\Templates\AddToWishlist
 * @version 3.0.12
 */

/**
 * Template variables:
 *
 * @var $base_url                  string Current page url
 * @var $wishlist_url              string Url to wishlist page
 * @var $exists                    bool Whether current product is already in wishlist
 * @var $show_exists               bool Whether to show already in wishlist link on multi wishlist
 * @var $show_count                bool Whether to show count of times item was added to wishlist
 * @var $show_view                 bool Whether to show view button or not
 * @var $product_id                int Current product id
 * @var $parent_product_id         int Parent for current product
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
 * @var $found_in_list             YITH_WCWL_Wishlist Wishlist
 * @var $found_item                YITH_WCWL_Wishlist_Item Wishlist item
 */

if (!defined('YITH_WCWL')) {
    exit;
} // Exit if accessed directly

global $product;
?>

<div class="yith-wcwl-add-button">
    <a href="<?php echo esc_url(wp_nonce_url(add_query_arg('remove_from_wishlist', $product_id, $base_url), 'remove_from_wishlist')); ?>"
        class="delete_item heart-fav-delete-button <?php echo esc_attr($link_classes); ?>"
        data-item-id="<?php echo esc_attr($found_item->get_id()); ?>"
        data-product-id="<?php echo esc_attr($product_id); ?>"
        data-original-product-id="<?php echo esc_attr($parent_product_id); ?>"
        data-title="<?php echo esc_attr(apply_filters('yith_wcwl_add_to_wishlist_title', $label)); ?>" rel="nofollow">
        <?php
        // echo yith_wcwl_kses_icon( $icon );
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
?>
        <?php
// echo wp_kses_post( $label );
?>
        <div class="like-button like-button-active">

            <label>
                <svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg" stroke-linecap="round"
                    stroke-linejoin="round">
                    <g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
                        <path
                            d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z"
                            id="heart" />

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
    </a>

    <?php if ($show_view) : ?>
    <span class="separator"><?php esc_html_e('or', 'yith-woocommerce-wishlist'); ?></span>
    <a href="<?php echo esc_url($found_in_list->get_url()); ?>"
        class="view-wishlist"><?php echo esc_html(apply_filters('yith_wcwl_view_wishlist_label', __('View &rsaquo;', 'yith-woocommerce-wishlist'))); ?></a>
    <?php endif; ?>

    <a href="<?php echo esc_url(wp_nonce_url(add_query_arg('remove_from_wishlist', $product_id, $base_url), 'remove_from_wishlist')); ?>"
        class="delete_item <?php echo esc_attr($link_classes); ?> btn-border cursor-pointer group bg-primary text-white default-fav-delete-button h-[50px] lg:w-[50px] w-full"
        data-item-id="<?php echo esc_attr($found_item->get_id()); ?>"
        data-product-id="<?php echo esc_attr($product_id); ?>"
        data-original-product-id="<?php echo esc_attr($parent_product_id); ?>"
        data-title="<?php echo esc_attr(apply_filters('yith_wcwl_add_to_wishlist_title', $label)); ?>" rel="nofollow">
        <svg class="lg:mr-0 mr-3" width="19" height="18" viewBox="0 0 19 18" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M16.9952 1.59331C16.5129 1.08817 15.9403 0.687472 15.3101 0.41409C14.6799 0.140708 14.0045 0 13.3224 0C12.6402 0 11.9648 0.140708 11.3346 0.41409C10.7044 0.687472 10.1318 1.08817 9.64953 1.59331L9.1954 2.06886L8.74127 1.59331C8.25898 1.08817 7.68638 0.687472 7.05619 0.41409C6.426 0.140708 5.75056 0 5.06843 0C4.38631 0 3.71086 0.140708 3.08067 0.41409C2.45048 0.687472 1.87789 1.08817 1.3956 1.59331C-0.161682 3.22358 -0.433405 5.73524 0.669671 8.31241C2.01419 11.455 8.31125 17.494 8.57854 17.7496C8.74714 17.9107 8.96714 18 9.19537 18C9.42361 18 9.64361 17.9107 9.81221 17.7496C10.0795 17.494 16.3766 11.455 17.7211 8.31195C18.8242 5.73524 18.5525 3.22358 16.9952 1.59331ZM16.0512 7.52794C15.1635 9.60148 11.2461 13.7115 9.1954 15.7336C7.14466 13.7116 3.22822 9.60289 2.33962 7.5284C1.96594 6.65359 1.25078 4.45601 2.69005 2.94883C3.32084 2.28829 4.17637 1.91721 5.06843 1.91721C5.96049 1.91721 6.81602 2.28829 7.44681 2.94883L8.5482 4.10215C8.63318 4.19119 8.73408 4.26181 8.84513 4.31C8.95619 4.35819 9.07522 4.38299 9.19543 4.38299C9.31564 4.38299 9.43467 4.35819 9.54572 4.31C9.65677 4.26181 9.75767 4.19119 9.84265 4.10215L10.944 2.94883C11.5849 2.30865 12.4366 1.95149 13.3224 1.95149C14.2081 1.95149 15.0598 2.30865 15.7008 2.94883C17.14 4.45601 16.4249 6.65359 16.0512 7.52794Z"
                fill="#ffffff" class="group-hover:fill-white" />
        </svg>
        <span class="lg:hidden block text-white">
            В избранном
        </span>
    </a>
</div>