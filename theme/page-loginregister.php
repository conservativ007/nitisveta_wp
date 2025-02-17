<?php

/**
 * Template Name: Login Register
 */

get_header();
?>

<section id="primary">
	<main id="main">

		<div class="container text-center max-w-[1076px] lg:mt-5">

			<div class="grid lg:grid-cols-2 gap-3">
				<div class="bg-white shadow px-5 py-7">
					<div class="font-bold text-xl mb-4 mt-2">У меня уже есть аккаунт</div>
					<?php echo do_shortcode('[ultimatemember form_id="67"]'); ?>
				</div>
				<div class="bg-white shadow px-5 py-7 relative register-block">
					<div class="font-bold text-xl mb-4 mt-2">Регистрация</div>
					<?php echo do_shortcode('[ultimatemember form_id="66"]'); ?>
				</div>
			</div>

			<div class="text-sm lg:text-lg mt-10 mb-10">
				<div class="font-bold text-lg mb-3">В личном кабинете:</div>

				<div class="flex items-center gap-2 justify-center mb-3">
					<svg class="shrink-0" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7.07729L1.36867 5.81262C2.96933 6.58729 3.98467 7.17596 5.78333 8.45862C9.16533 4.62062 11.4007 2.67329 15.5547 0.088623L16 1.11262C12.574 4.10196 10.0653 7.43196 6.45267 13.9113C4.224 11.2873 2.73667 9.61396 0 7.07729Z" fill="#EF3343" />
					</svg>

					<span>хранятся ваши промо коды</span>
				</div>

				<div class="flex items-center gap-2 justify-center mb-3">
					<svg class="shrink-0" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7.07729L1.36867 5.81262C2.96933 6.58729 3.98467 7.17596 5.78333 8.45862C9.16533 4.62062 11.4007 2.67329 15.5547 0.088623L16 1.11262C12.574 4.10196 10.0653 7.43196 6.45267 13.9113C4.224 11.2873 2.73667 9.61396 0 7.07729Z" fill="#EF3343" />
					</svg>

					<span>сохраняется ваше избранное</span>
				</div>

				<div class="flex items-center gap-2 justify-center mb-3">
					<svg class="shrink-0" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7.07729L1.36867 5.81262C2.96933 6.58729 3.98467 7.17596 5.78333 8.45862C9.16533 4.62062 11.4007 2.67329 15.5547 0.088623L16 1.11262C12.574 4.10196 10.0653 7.43196 6.45267 13.9113C4.224 11.2873 2.73667 9.61396 0 7.07729Z" fill="#EF3343" />
					</svg>

					<span>вы можете увидеть все ваши предыдущие заказы</span>
				</div>

				<div class="flex items-center gap-2 justify-center">
					<svg class="shrink-0" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 7.07729L1.36867 5.81262C2.96933 6.58729 3.98467 7.17596 5.78333 8.45862C9.16533 4.62062 11.4007 2.67329 15.5547 0.088623L16 1.11262C12.574 4.10196 10.0653 7.43196 6.45267 13.9113C4.224 11.2873 2.73667 9.61396 0 7.07729Z" fill="#EF3343" />
					</svg>

					<span>при оформлении заказа,
						ваши контакты загрузятся автоматически</span>
				</div>
			</div>

		</div>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
