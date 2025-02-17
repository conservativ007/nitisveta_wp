<?php

/**
 * Template Name: Privacy policy
 */

get_header();
?>

<section id="primary">
	<main id="main">

		<div class="container max-w-7xl mb-16">

			<h1 class="font-title text-3xl xl:text-[40px]">Политика организации в отношении обработки персональных данных на сайте
			</h1>

			<?php if (have_rows('policy')) : ?>
				<?php while (have_rows('policy')) : the_row();
				?>
					<div class="grid xl:grid-cols-5 gap-3 xl:gap-16 mt-5 xl:mt-16">
						<div class="font-title text-xl xl:text-3xl xl:col-span-2">
							<?php echo get_sub_field('title'); ?>
						</div>
						<div class="text-sm xl:col-span-3 grid gap-4 leading-6">
							<?php echo get_sub_field('text'); ?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
