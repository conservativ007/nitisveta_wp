document.addEventListener('DOMContentLoaded', function () {
	const parentNode = document.body;

	// Функция, которая будет вызываться при изменениях в DOM
	const callback = function (mutationsList, observer) {
		mutationsList.forEach((mutation) => {
			if (mutation.type === 'childList') {
				const targetNode = document.querySelector('#shipping_method'); // Пытаемся заново найти элемент
				if (targetNode) {
					const firstLi = targetNode.querySelector('li:first-child');
					if (
						firstLi &&
						!firstLi.querySelector('#billing_address_1_field')
					) {
						// console.log('Клонируем');
						// Клонируем элемент, если он существует
						const billingField = document.querySelector(
							'#billing_address_1_field'
						);
						if (billingField) {
							// Клонируем элемент и добавляем его в первый li
							const clonedField = billingField.cloneNode(true);
							firstLi.appendChild(clonedField);

							// Убираем label
							const label = clonedField.querySelector('label');
							if (label) {
								label.remove();
							}

							// Обновляем стили input
							const input = clonedField.querySelector('input');
							if (input) {
								input.style.visibility = 'visible';
								input.style.position = 'static';
							}

							// Убираем тени у клонированного блока
							clonedField.style.boxShadow = 'none';
							clonedField.style.textShadow = 'none';
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
