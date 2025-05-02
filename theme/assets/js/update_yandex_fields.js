document.addEventListener('DOMContentLoaded', function () {
	const updateLabelText = (label) => {
		// const label = document.querySelector(`label[for="${labelFor}"]`);

		if (!label) return;

		// Проверяем, было ли уже обработано это изменение
		if (label.dataset.processed === 'true') return;

		const priceSpan = label.querySelector('.woocommerce-Price-amount');

		let labelText = label.textContent.replace(/[\n\r\t]/g, '').trim(); // Убираем лишние пробелы и новые строки

		// Ищем первую букву "в"
		const firstIndex = labelText.indexOf('в');

		// Если нашли первую букву, ищем вторую начиная с позиции после первой
		const secondIndex =
			firstIndex !== -1 ? labelText.indexOf('в', firstIndex + 1) : -1;

		if (secondIndex !== -1) {
			labelText = `<pan>${labelText.slice(
				0,
				secondIndex
			)}</pan><span>${labelText.slice(secondIndex)}</span>`;
		}

		// Устанавливаем атрибут, чтобы предотвратить зацикливание
		label.dataset.processed = 'true';

		label.textContent = labelText;

		if (priceSpan) {
			let priceText = priceSpan.textContent.trim();

			let priceNumber = parseFloat(priceText.replace(/[^\d.-]/g, ''));
			// console.log(priceNumber);
			// Обновляем цену
			// console.log(label.textContent);
			priceSpan.innerHTML = `<bdi>${priceNumber}₽</bdi>`;
			// console.log(priceSpan);

			// label.innerHTML = priceSpan.innerHTML;
		}

		// Получаем основной текст метки и обрезаем его до запятой
		const labelText1 = label.textContent
			.replace(priceSpan ? priceSpan.textContent : '', '')
			.split(':')[0]
			.trim();

		// console.log(labelText1);

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
				// const targetNode = document.querySelector('shipping_method_0_flat_rate-10'); // Пытаемся заново найти элемент
				const targetNode = document.querySelector(
					`label[for="shipping_method_0_flat_rate-10"]`
				);

				if (targetNode) {
					// console.log(
					// 	'Элемент #shipping_method был добавлен или изменен'
					// );

					updateLabelText(targetNode);
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
