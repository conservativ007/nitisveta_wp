/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

document.addEventListener('DOMContentLoaded', function () {
	const swiper = new Swiper('.swiper-products-standard', {
		// Optional parameters
		loop: false,
		autoHeight: false,
		initialSlide: 2,

		breakpoints: {
			320: {
				slidesPerView: 1.1,
				spaceBetween: 5,
			},
			// when window width is >= 480px
			480: {
				slidesPerView: 1.3,
				spaceBetween: 10,
			},
			// when window width is >= 640px 3.4
			800: {
				slidesPerView: 2.2,
				spaceBetween: 10,
			},
			1023: {
				slidesPerView: 2.8,
				spaceBetween: 10,
			},
			1300: {
				slidesPerView: 3.4,
				spaceBetween: 10,
			},
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},

		loopPreventsSliding: false,
		centeredSlides: true,
		centeredSlidesBounds: true,
		speed: 800,
	});

	const swiperHorizontal = new Swiper('.swiper-products-horizontal', {
		// Optional parameters
		loop: false,
		initialSlide: 2,
		slidesPerGroup: 1,
		centerInsufficientSlides: true,

		breakpoints: {
			320: {
				slidesPerView: 1.1,
				spaceBetween: 5,
				loopPreventsSliding: false,
				centeredSlides: true,
				centeredSlidesBounds: true,
			},
			// when window width is >= 480px
			480: {
				slidesPerView: 2.4,
				spaceBetween: 30,
			},
			// when window width is >= 640px
			640: {
				slidesPerView: 2.4,
				spaceBetween: 10,
				slidesOffsetBefore: 140,
				slidesOffsetAfter: 140,
				initialSlide: 1,
			},
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},

		// loopPreventsSliding: false,
		// centeredSlides: true,
		// centeredSlidesBounds: true,
		// autoHeight: true,
		speed: 800,
	});

	const swiperAbout = new Swiper('.swiper-about', {
		// Optional parameters
		loop: false,
		initialSlide: 3,
		spaceBetween: 8,
		breakpoints: {
			320: {
				slidesPerView: 1.4,
				spaceBetween: 8,
			},
			// when window width is >= 480px
			480: {
				slidesPerView: 2.4,
			},
			// when window width is >= 640px
			640: {
				slidesPerView: 3.4,
			},
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},

		loopPreventsSliding: false,

		centeredSlides: true,
		centeredSlidesBounds: true,
		autoHeight: true,
		speed: 800,
	});

	const swiperThumbs = new Swiper('.swiper-thumbs', {
		spaceBetween: 10,
		slidesPerView: 3,
		// freeMode: true,
		watchSlidesProgress: true,
		navigation: {
			nextEl: '.swiper-thumb-button-next',
			prevEl: '.swiper-thumb-button-prev',
		},
	});
	const swiperProduct = new Swiper('.swiper-product', {
		spaceBetween: 0,
		navigation: {
			nextEl: '.swiper-sprod-button-next',
			prevEl: '.swiper-sprod-button-prev',
		},
		breakpoints: {
			// 320: {
			// 	slidesPerView: 1.4,
			// 	spaceBetween: 8,
			// },
			// // when window width is >= 480px
			// 480: {
			// 	slidesPerView: 2.4,
			// },
			// when window width is >= 640px
			1023: {
				spaceBetween: 10,
			},
		},
		thumbs: {
			swiper: swiperThumbs,
		},
		pagination: {
			el: '.swiper-pagination',
		},
	});

	const galleryCart = new Swiper('.gallery-cart', {
		spaceBetween: 10,
		slidesPerView: 1,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

	jQuery(document.body).on('updated_cart_totals', function () {
		jQuery.ajax({
			type: 'POST',
			url: wc_add_to_cart_params.ajax_url,
			data: {
				action: 'get_cart_count',
			},
			success: function (response) {
				// Обновляем элемент с новым числом товаров
				jQuery('.cart-count').text(response);
				console.log(response);
			},
		});
	});

	jQuery(document.body).on(
		'added_to_cart',
		function (event, fragments, cart_hash, $button) {
			var $cartCount = jQuery('.cart-count'); // Находим элемент .cart-count

			if ($cartCount.hasClass('hidden')) {
				// Если у .cart-count есть класс hidden
				$cartCount.removeClass('hidden'); // Удаляем класс hidden
			}
			$cartCount.text(fragments['cart_count']); // Обновляем текст в .cart-count
		}
	);

	tippy('.ucen-link', {
		content:
			'Наши товары изготовлены вручную людьми с ограниченными возможностями. Поэтому иногда в процессе создания бывают допущены незначительные ошибки. На фотографиях мы всегда показываем в чём причина уценки.',
		trigger: 'click',
		theme: 'primary',
		placement: 'bottom',
	});

	tippy('.share-link', {
		content(reference) {
			const id = reference.getAttribute('data-template');
			const template = document.getElementById(id);
			return template.innerHTML;
		},
		allowHTML: true,
		trigger: 'click',
		placement: 'bottom',
		theme: 'white',
		interactive: true,
		interactiveBorder: 30,
		maxWidth: 350,
		zIndex: 40,
	});

	var likeButtons = document.querySelectorAll('.like-button');

	// Добавляем обработчик события click для каждого элемента
	likeButtons.forEach(function (likeButton) {
		likeButton.addEventListener('click', function () {
			// Изменяем класс элемента, переключая между 'like-button' и 'like-button-active'
			if (likeButton.classList.contains('like-button-active')) {
				likeButton.classList.remove('like-button-active');
			} else {
				likeButton.classList.add('like-button-active');
			}
		});
	});

	var clipboard = new ClipboardJS('.copy-link');

	clipboard.on('success', function (e) {
		// Создание tippy instance для элемента, который вызвал событие копирования
		tippy(e.trigger, {
			content: 'Скопировано',
			zIndex: 40,
			onShow(instance) {
				// Тултип показан
			},
			onHide(instance) {
				// Тултип скрыт, удаляем его
				// instance.destroy();
			},
			trigger: 'click', // Тултип будет управляться вручную
		}).show(); // Отображаем тултип

		// Очищаем выделение
		e.clearSelection();
	});
});

jQuery(document).ready(function ($) {
	$('#custom-profile-form').submit(function (e) {
		e.preventDefault();

		var submitButton = $(this).find('input[type="submit"]');
		var originalButtonText = submitButton.val();
		submitButton.val('Сохранение...');

		var formData = $(this).serialize();
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajax_object.ajax_url, // 'ajaxurl' определен в WordPress
			data: formData + '&action=handle_profile_update',
			success: function (response) {
				var messageClass = response.success
					? 'alert-success'
					: 'alert-danger';

				// Сброс и отображение сообщения
				$('#form-response')
					.hide() // Сначала скрываем элемент
					.html(
						'<div class="alert ' +
							messageClass +
							'">' +
							response.data +
							'</div>'
					)
					.fadeIn(); // Затем плавно показываем

				// Сброс текста кнопки и автоматическое исчезновение сообщения
				submitButton.val(originalButtonText);
				setTimeout(function () {
					$('#form-response').fadeOut();
				}, 5000); // Скрыть сообщение через 5 секунд
			},
			// error: function (response) {
			// 	$('#form-response').html(
			// 		'<div class="alert alert-danger">Ошибка при обновлении профиля.' +
			// 			response.data +
			// 			'</div>'
			// 	);
			// },
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('AJAX error:', textStatus, errorThrown);
				submitButton.val(originalButtonText);
			},
		});
	});

	$('body').on('click', '.add_to_cart_button', function () {
		var button = $(this);
		button.css('opacity', '0.5');
		setTimeout(function () {
			button.css('opacity', '1');
		}, 2000); // Вернуть прозрачность обратно через 2 секунды
	});

	// Обновляем слайдеры при обновлении корзины
	$(document.body).on('updated_cart_totals', function () {
		const galleryCart = new Swiper('.gallery-cart', {
			spaceBetween: 10,
			slidesPerView: 1,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		});
	});

	$(document).on('click', '.quantity-increase', function () {
		var $qtyInput = $(this).prev('.quantity').find('.input-text.qty');
		var currentQty = parseInt($qtyInput.val(), 10);
		$qtyInput.val(currentQty + 1);
		$qtyInput.trigger('change'); // Срабатывание события изменения (если требуется)
		$('button[name="update_cart"]').trigger('click');
	});

	// Уменьшаем количество товара на 1, но не меньше минимального значения
	$(document).on('click', '.quantity-decrease', function () {
		var $qtyInput = $(this).next('.quantity').find('.input-text.qty');
		var currentQty = parseInt($qtyInput.val(), 10);
		if (currentQty > parseInt($qtyInput.attr('min'), 10)) {
			$qtyInput.val(currentQty - 1);
			$qtyInput.trigger('change'); // Срабатывание события изменения (если требуется)
			$('button[name="update_cart"]').trigger('click');
		}
	});

	$(document.body).on('update_checkout', function () {
		$('.my-custom-shipping-table').block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6,
			},
		});
	});

	$('#billing_address_1_field').insertAfter('.my-custom-shipping-table');

	jQuery(document).ajaxComplete(function (event, xhr, settings) {
		// Проверяем, связан ли AJAX-запрос с обновлением количества в Wishlist
		if (settings.url.includes('yith_wcwl_update_wishlist_count')) {
			const galleryCart = new Swiper('.gallery-cart', {
				spaceBetween: 10,
				slidesPerView: 1,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
			});

			tippy('.share-link', {
				content(reference) {
					const id = reference.getAttribute('data-template');
					const template = document.getElementById(id);
					return template.innerHTML;
				},
				allowHTML: true,
				trigger: 'click',
				placement: 'bottom',
				theme: 'white',
				interactive: true,
				interactiveBorder: 30,
				maxWidth: 350,
				zIndex: 40,
			});

			var clipboard = new ClipboardJS('.copy-link');

			clipboard.on('success', function (e) {
				// Создание tippy instance для элемента, который вызвал событие копирования
				tippy(e.trigger, {
					content: 'Скопировано',
					zIndex: 40,
					onShow(instance) {
						// Тултип показан
					},
					onHide(instance) {
						// Тултип скрыт, удаляем его
						// instance.destroy();
					},
					trigger: 'click', // Тултип будет управляться вручную
				}).show(); // Отображаем тултип

				// Очищаем выделение
				e.clearSelection();
			});
		}
	});

	$('.mm-button').on('click', function () {
		// У блока с классом mobile-menu переключить класс hidden
		$('.mobile-menu').toggleClass('hidden');
		$('.mm-button-icon-hamburger').toggleClass('hidden');
		$('.mm-button-icon-close').toggleClass('hidden');
	});

	$('.open-popup-link').magnificPopup({
		type: 'inline',
		midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
		closeMarkup:
			'<button title="%title%" type="button" class="mfp-close"><svg width="24" height="23" viewBox="0 0 24 23" fill="none"><line x1="21" y1="2.82843" x2="2.82843" y2="21" stroke="#3B2F4A" stroke-width="4" stroke-linecap="round"/><line x1="2" y1="-2" x2="27.6985" y2="-2" transform="matrix(0.707107 0.707107 0.707107 -0.707107 3 0)" stroke="#3B2F4A" stroke-width="4" stroke-linecap="round"/></svg></button>',
	});

	if (
		$('body').hasClass('woocommerce-cart') &&
		$('body').hasClass('not-logged-in')
	) {
		// Если да, то открываем Magnific Popup
		// Замените #test-popup на селектор вашего Magnific Popup
		$.magnificPopup.open({
			items: {
				src: '#test-popup',
			},
			type: 'inline', // Указывает тип содержимого (может быть 'image', 'inline', 'ajax' и т.д.)
		});
	}

	$('.popup-auth-title').click(function () {
		$(this).next().toggleClass('max-lg:hidden');
	});
});
