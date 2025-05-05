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

$ucenennyj_value = $product->get_attribute('pa_ucenennyj');
$ucenenn = '';
if ('да' === strtolower($ucenennyj_value)) {
    $ucenenn = "уцененный";
}
?>
<?php global $product; ?>
<div class="product-card relative bg-white shadow flex flex-col">

  <?php if ($ucenenn) : ?>
    <div class="absolute flex justify-center top-32 z-20 -right-[68px] max-xl:rotate-90 xl:top-0 xl:right-0 w-40 xl:w-full">
      <div class="bg-primary text-white flex items-center h-6 xl:h-9 px-8 font-title text-sm xl:text-xl rounded-b-lg z-10">
        уцененный</div>
    </div>
  <?php endif; ?>

  <?php
  $availability = '';
if ($product->get_stock_quantity() > 1 && $product->get_stock_quantity() < 6) {
    ?>
    <div class="absolute flex justify-center top-32 z-20 -right-[68px] max-xl:rotate-90 xl:top-0 xl:right-0 w-40 xl:w-full">
      <div class="bg-primary text-white flex items-center h-6 xl:h-9 px-8 font-title text-sm xl:text-xl rounded-b-lg z-10">
        <?php
          $availability = __('осталось  ', 'woocommerce') . $product->get_stock_quantity() . ' шт.';
    echo $availability; ?>
      </div>
    </div>
  <?php  } ?>
  <div class="absolute text-lg font-bold z-30 left-3 top-3 bg-white px-3 py-1 rounded-full">
    <?php echo $product->get_price(); ?>
    <span>₽</span>
  </div>
  <div class="absolute z-30 right-1 md:right-3 top-1 md:top-3 product-card-favourite-button-wrapper">
    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
  </div>

  <a href="<?php the_permalink(); ?>" class="group border-b-2 border-[#F6F6F6] h-[320px] 2xl:h-[440px] flex items-center justify-center overflow-hidden">
    <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="group-hover:scale-105 transition-all object-cover w-full" alt="<?php the_title(); ?>">
  </a>

  <div class="flex items-center flex-nowrap p-2 lg:p-5 justify-between">

    <div class="grid grid-cols-3 gap-x-3 gap-y-3 2xl:gap-x-4 2xl:gap-y-5 w-full items-center justify-end">
      <a href="<?php the_permalink(); ?>" class="text-primary col-span-3 2xl:col-span-1 2xl:max-w-[160px] font-bold order-1">
        <?php the_title(); ?>
      </a>

      <!-- <a href="" class="btn w-36"><span>В корзину</span></a> -->


      <div class="flex items-center gap-6 col-span-3 2xl:col-span-2 order-3 2xl:order-2">

        <div class="relative w-3/5 2xl:w-1/2">
          <?php
      if ($in_cart) {
          echo '<a href="' . esc_url($cart_url) . '" class="btn text-center bg-primary hover:ring-primary hover:ring-opacity-30" title="Просмотр корзины"><span>Уже в корзине</span></a>';
      } else {
          echo '<a href="' . esc_url($product->add_to_cart_url()) . '" data-quantity="1" class="btn button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="' . $product->get_id() . '" data-product_sku="' . esc_attr($product->get_sku()) . '" aria-label="' . esc_attr($product->add_to_cart_description()) . '" rel="nofollow">В корзину</a>';
      }
?>
        </div>

        <a href="<?php the_permalink(); ?>" class="btn-border h-[50px] w-2/5 2xl:w-1/2"><span>Подробнее</span></a>
      </div>

      <?php if (get_the_excerpt()) : ?>
        <div class="text-sm leading-6 text-primary col-span-3 order-2 2xl:order-3">
          <?php echo get_the_excerpt(); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

</div>