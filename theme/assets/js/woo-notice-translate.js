document.addEventListener('DOMContentLoaded', function () {
	const parentNode = document.body;

	const callback = function (mutationsList, observer) {
		mutationsList.forEach((mutation) => {
			if (mutation.type === 'childList') {
				const targetNode = document.querySelector(
					'.wc-block-components-notice-banner'
				);

				if (targetNode) {
					let contentEl = targetNode.querySelector(
						'.wc-block-components-notice-banner__content'
					);

					if (contentEl) {
						const textContent = contentEl.textContent;

						// console.log(textContent);

						switch (true) {
							case textContent.includes('removed'):
								contentEl.innerHTML = contentEl.innerHTML
									.replace('removed', 'удалён из корзины')
									.replace('Undo?', 'Отменить?');
								break;
							case textContent.includes('Cart updated'):
								contentEl.innerHTML =
									contentEl.innerHTML.replace(
										'Cart updated',
										'Корзина обновлена'
									);
								break;
							case textContent.includes(
								'has been added to your cart'
							):
								contentEl.innerHTML =
									contentEl.innerHTML.replace(
										'has been added to your cart',
										'был добавлен в вашу корзину'
									);
								break;
							case textContent.includes(
								'Coupon code applied successfully'
							):
								contentEl.innerHTML =
									contentEl.innerHTML.replace(
										'Coupon code applied successfully',
										'Код купона успешно применен'
									);
								break;
							case textContent.includes(
								'Coupon code already applied'
							):
								contentEl.innerHTML =
									contentEl.innerHTML.replace(
										'Coupon code already applied',
										'Код купона уже применен'
									);
								break;
							case textContent.includes(
								'Coupon has been removed'
							):
								contentEl.innerHTML =
									contentEl.innerHTML.replace(
										'Coupon has been removed.',
										'Купон был удален.'
									);
								break;
							default:
								break;
						}
					}
				}
			}
		});
	};

	// Создаем MutationObserver
	const observer = new MutationObserver(callback);

	// Настройки для отслеживания добавлений и удалений элементов
	const config = { childList: true, subtree: true };

	// Начинаем наблюдение за изменениями в родительском элементе или документе
	observer.observe(parentNode, config);
});
