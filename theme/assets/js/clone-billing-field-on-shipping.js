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
					const billingAddress2 =
						document.querySelector('#billing_address_2');
					const billingLastName =
						document.querySelector('#billing_last_name');

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

							// 2. Меняем id и name в оригинале до вставки клона
							const originalInput =
								billingField.querySelector(
									'#billing_address_1'
								);
							if (originalInput) {
								originalInput.id = 'billing_address_1_original';
								originalInput.setAttribute(
									'name',
									'billing_address_1_original'
								);
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

							// 3 Вставляем клон и отмечаем его как "вставленный"
							clonedField.setAttribute('data-cloned', 'true');
							firstLi.appendChild(clonedField);

							// 4. Настраиваем клон
							const clonedInput =
								clonedField.querySelector('input');
							if (clonedInput) {
								clonedInput.style.visibility = 'visible';
								clonedInput.style.position = 'static';
								clonedInput.id = 'billing_address_1';
								clonedInput.setAttribute(
									'name',
									'billing_address_1'
								);
							}

							// Убираем тени у клонированного блока
							clonedField.style.boxShadow = 'none';
							clonedField.style.textShadow = 'none';

							const label = clonedField.querySelector('label');
							if (label) {
								label.remove();
							}
						}
					}

					// очищаем др спрятанные инпуты
					if (billingAddress2) {
						billingAddress2.value = '';
					}
					if (billingLastName) {
						billingLastName.value = '';
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
