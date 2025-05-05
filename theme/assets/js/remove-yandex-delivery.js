document.addEventListener('DOMContentLoaded', function () {
	const citySelect = document.getElementById('billing_city');

	const hideElement = () => {
		const elemOfYandexShippingMethod = document.getElementById(
			'shipping_method_0_flat_rate-10'
		)?.parentElement;

		if (elemOfYandexShippingMethod) {
			elemOfYandexShippingMethod.style.display = 'none';
		}
	};

	const showElement = () => {
		const elemOfYandexShippingMethod = document.getElementById(
			'shipping_method_0_flat_rate-10'
		)?.parentElement;

		if (elemOfYandexShippingMethod) {
			elemOfYandexShippingMethod.style.display = 'block';
		}
	};

	const allowedCities = ['Москва', 'Санкт-Петербург', ''];

	const parentNode = document.body;

	// Функция, которая будет вызываться при изменениях в DOM
	const callback = function (mutationsList, observer) {
		mutationsList.forEach((mutation) => {
			if (mutation.type === 'childList') {
				const targetNode = document.querySelector('#shipping_method'); // Пытаемся заново найти элемент
				if (targetNode) {
					// console.log(
					// 	'Элемент #shipping_method был добавлен или изменен'
					// );

					if (!allowedCities.includes(citySelect.value)) {
						hideElement();
					} else {
						showElement();
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
