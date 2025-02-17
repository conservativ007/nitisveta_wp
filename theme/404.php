<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Нити_Света
 */

get_header();
?>

<section id="primary">
	<main id="main">

		<div class="container text-center">

			<h1 class="title-404 font-title mt-2 lg:mt-16">
				<span class="text-4xl lg:text-8xl">404</span> <br>
				<span class="text-xl lg:text-5xl">К сожалению, страница не существует :(</span>
			</h1>

			<div class="image-404-wrap relative lg:flex max-w-2xl mx-auto mt-0 lg:mt-14">
				<img src="<?php echo get_template_directory_uri(); ?>/images/404.png" class="mx-auto"
					alt="Нити Света страница не найдена">
				<div class="font-title text-sm lg:text-xl shrink-0 relative lg:top-[50px] lg:right-[100px]">Тихая лунная
					ночь...
					<br>
					Слышно, как в глубине каштана <br>
					Ядрышко гложет червяк.
				</div>
			</div>

			<a href="/" class="btn max-w-sm mx-auto mb-14 mt-4 lg:mt-14"><span>Вернуться в реальность</span></a>

		</div>



	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
