document.addEventListener('DOMContentLoaded', function () {
	const parentNode = document.body;

	// Функция, которая будет вызываться при изменениях в DOM
	const callback = function (mutationsList, observer) {
		mutationsList.forEach((mutation) => {
			if (mutation.type === 'childList') {
				const targetNode = document.querySelector('#shipping_method'); // Пытаемся заново найти элемент

				if (targetNode) {
					const elemOfShippingMetgod137 = document.querySelector(
						'#shipping_method_0_official_cdek-137'
					);

					const elemOfBillingAddress1 =
						document.querySelector('#billing_address_1');

					if (
						!elemOfShippingMetgod137.checked &&
						elemOfBillingAddress1
					) {
						elemOfBillingAddress1.style.display = 'none';
					}
					if (
						elemOfShippingMetgod137.checked &&
						elemOfBillingAddress1
					) {
						elemOfBillingAddress1.style.display = '';
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
