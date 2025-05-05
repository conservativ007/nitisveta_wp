<?php

/**
 * Template Name: Thank You
 */

get_header();
?>

<section id="primary">
	<main id="main">

		<div class="container text-center">

			<h3 class="font-title text-2xl lg:text-4xl mb-8 mt-4 lg:mt-16">Благодарим за ваш заказ и поддержку нашей
				работы!</h3>

			<div class="grid lg:grid-cols-3 gap-3 max-w-6xl mx-auto mt-8">

				<div class="relative">
					<div class="font-title text-xl mb-2 lg:min-h-[85px] relative">Чек будет отправлен вам на email
					</div>
					<img class="mx-auto top-4 relative" src="<?php echo get_template_directory_uri(); ?>/images/thx1.svg">
					<img class="relative lg:hidden mx-auto mt-6" src="<?php echo get_template_directory_uri(); ?>/images/arrow-draw-down.svg">
					<img class="hidden lg:block absolute right-[-50px] top-1/2" src="<?php echo get_template_directory_uri(); ?>/images/arrow-draw.svg">
				</div>

				<div class="relative">
					<div class="font-title text-xl mb-2 min-h-[85px] relative">Вы получите SMS и email сообщение,
						<br>как только заказ будет передан курьерам
					</div>
					<img class="mx-auto" src="<?php echo get_template_directory_uri(); ?>/images/thx2.svg">
					<img class="relative lg:hidden mx-auto mt-6" src="<?php echo get_template_directory_uri(); ?>/images/arrow-draw-down.svg">
					<img class="hidden lg:block absolute right-[-50px] top-1/2" src="<?php echo get_template_directory_uri(); ?>/images/arrow-draw.svg">
				</div>

				<div>
					<div class="font-title text-xl mb-2 min-h-[85px]">Вы сможете отслеживать где ваш заказ, <br>с
						помощью специального кода</div>
					<img class="mx-auto -top-4 lg:top-4 relative" src="<?php echo get_template_directory_uri(); ?>/images/thx3.svg">
				</div>

			</div>

			<div class="bg-white p-7 max-w-4xl mx-auto mt-16 mb-16">

				<div class="text-base lg:text-2xl font-bold">
					В подарок для вас скидка 5% на ваш следующий заказ
				</div>

				<div class="text-base lg:text-xl">Вы можете применить промокод сами или подарить кому-то из ваших друзей.
				</div>
				<div class="mt-6 text-2xl lg:text-4xl font-title">Niti-5%</div>
				<div class="flex flex-col lg:flex-row items-center justify-center gap-2 lg:gap-10 mx-auto mt-8">
					<a class="btn w-full max-w-xs copy-link" href="#" data-clipboard-text="Niti-5%"><span>Копировать мой промо код</span></a>
					<a class="btn-border h-12 w-full max-w-xs" href="#"><span>Отправить код другу</span></a>
				</div>

			</div>

		</div>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
