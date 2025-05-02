document.addEventListener('DOMContentLoaded', function () {
	const updateLabelText = (labelFor, position) => {
		const label = document.querySelector(`label[for="${labelFor}"]`);

		if (!label) return;

		// Проверяем, было ли уже обработано это изменение
		if (label.dataset.processed === 'true') return;

		const priceSpan = label.querySelector('.woocommerce-Price-amount');

		let labelText = label.textContent.replace(/[\n\r\t]/g, '').trim(); // Убираем лишние пробелы и новые строки

		// Проверяем, есть ли запятая в начале строки, если нет — вставляем её
		if (!labelText.includes(',')) {
			labelText =
				labelText.slice(0, position) + ',' + labelText.slice(position);
		}

		// Устанавливаем атрибут, чтобы предотвратить зацикливание
		label.dataset.processed = 'true';

		label.textContent = labelText;

		if (priceSpan) {
			let priceText = priceSpan.textContent.trim();

			let priceNumber = parseFloat(priceText.replace(/[^\d.-]/g, ''));
			// console.log(priceNumber);
			// Обновляем цену
			priceSpan.innerHTML = `<bdi>${priceNumber}₽</bdi>`;
		}

		// Получаем основной текст метки и обрезаем его до запятой
		const labelText1 = label.textContent
			.replace(priceSpan ? priceSpan.textContent : '', '')
			.split(',')[0]
			.trim();

		// Обновляем текст метки, оставляя цену нетронутой
		label.innerHTML = `${labelText1}: ${
			priceSpan ? priceSpan.outerHTML : ''
		}`;

		// Сбрасываем флаг через небольшой таймаут (чтобы снова можно было отслеживать)
		setTimeout(() => {
			label.removeAttribute('data-processed');
		}, 100);
	};

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
					updateLabelText('shipping_method_0_official_cdek-137', 22);
					updateLabelText('shipping_method_0_official_cdek-136', 29);
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
