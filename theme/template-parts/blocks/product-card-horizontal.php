<?php
$product = wc_get_product();  // Получить текущий продукт
$cart_url = wc_get_cart_url(); // Получить URL корзины
$in_cart = false;

// Проверяем, находится ли товар в корзине
foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
	if ($cart_item['product_id'] === $product->get_id()) {
		$in_cart = true;
		break;
	}
}
?>
<div class="items-start product-card relative bg-white shadow flex flex-col 2xl:flex-row 2xl:rounded-[10px] border border-[#EEEEEE]">

	<a href="<?php the_permalink(); ?>" class="group h-[270px] 2xl:h-[450px] w-full 2xl:max-w-[320px] 2xl:w-auto flex flex-col items-center justify-center overflow-hidden shrink-0 border-b border-[#F6F6F6]">
		<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="group-hover:scale-105 max-h-full !h-auto block mx-auto transition-all" alt="<?php the_title(); ?>">
	</a>

	<div class="p-2 lg:p-5 flex flex-col h-full max-h-full max-w-full">
		<a href="<?php the_permalink(); ?>" class="text-primary w-full font-bold text-base 2xl:text-2xl">
			<?php the_title(); ?>
		</a>

		<div class="flex items-center mt-2 gap-4">
			<div class="text-base text-primary font-bold block 2xl:hidden">
				<?php echo $product->get_price(); ?>
				<span>
					₽
				</span>
			</div>

			<?php
			$author = $product->get_attribute('book-author');

			if (!empty($author)) {
				echo '<div class="text-primary 2xl:text-xl">' . $author . '</div>';
			}
			?>

		</div>

		<?php
		$content = get_the_content();
		if ($content) : ?>
			<div class="text-sm leading-7 text-primary 2xl:pl-5 2xl:border-l 2xl:border-[#C5C5C5] mt-3 mb-3">
				<div class="hidden 2xl:block"><?php echo wp_trim_words(get_the_content(), 50, '...'); ?></div>
				<div class="2xl:hidden"><?php echo wp_trim_words(get_the_content(), 34, '...'); ?></div>

			</div>
		<?php endif; ?>

		<div class="text-2xl text-primary font-bold mb-4 mt-auto hidden 2xl:block">
			<?php echo $product->get_price(); ?>
			<span>
				₽
			</span>
		</div>

		<div class="flex gap-6 w-full items-center justify-start ">
			<div class="relative w-3/5 2xl:w-1/2">
				<?php
				if ($in_cart) {
					echo '<a href="' . esc_url($cart_url) . '" class="btn bg-primary text-center hover:ring-primary hover:ring-opacity-30" title="Просмотр корзины"><span>Уже в корзине</span></a>';
				} else {
					echo '<a href="' . esc_url($product->add_to_cart_url()) . '" data-quantity="1" class="btn button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="' . $product->get_id() . '" data-product_sku="' . esc_attr($product->get_sku()) . '" aria-label="' . esc_attr($product->add_to_cart_description()) . '" rel="nofollow">В корзину</a>';
				}
				?>
			</div>
			<a href="<?php the_permalink(); ?>" class="btn-border h-[50px] font-semibold w-2/5 2xl:w-1/2"><span>Подробнее</span></a>

			<div class="product-card-favourite-button-wrapper hidden 2xl:block">
				<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
			</div>
		</div>
	</div>

</div>