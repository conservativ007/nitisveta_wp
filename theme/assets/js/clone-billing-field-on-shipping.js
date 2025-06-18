// клонирование элемента в observer надежный способ без повторяющегося ID
// надёжный способ — поставить флаг, например, через data-* атрибут или класс, чтобы понять, что элемент уже клонировался.

document.addEventListener('DOMContentLoaded', function () {
	const parentNode = document.body;

	// Функция, которая будет вызываться при изменениях в DOM
	const callback = function (mutationsList, observer) {
		mutationsList.forEach((mutation) => {
			if (mutation.type === 'childList') {
				const targetNode = document.querySelector('#shipping_method'); // Пытаемся заново найти элемент
				if (targetNode) {
					const firstLi = targetNode.querySelector('li:first-child');
					const alreadyCloned = firstLi?.querySelector(
						'[data-cloned="true"]'
					);
					// проверяем что элемент еще не клонирован
					if (firstLi && !alreadyCloned) {
						// Клонируем элемент, если он существует
						const billingField = document.querySelector(
							'#billing_address_1_field'
						);
						if (billingField) {
							// === Клонируем до изменения оригинала ===
							const clonedField = billingField.cloneNode(true);

							// === Вставляем клон и отмечаем его как "вставленный" ===
							clonedField.setAttribute('data-cloned', 'true');
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
								input.id = 'billing_address_1';
							}

							// Убираем тени у клонированного блока
							clonedField.style.boxShadow = 'none';
							clonedField.style.textShadow = 'none';

							// === Меняем id и for в оригинале после клонирования ===
							const originalInput =
								billingField.querySelector(
									'#billing_address_1'
								);
							if (originalInput) {
								originalInput.id = 'billing_address_1_original';
							}

							const originalLabel = billingField.querySelector(
								'label[for="billing_address_1"]'
							);
							if (originalLabel) {
								originalLabel.setAttribute(
									'for',
									'billing_address_1_original'
								);
							}
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
