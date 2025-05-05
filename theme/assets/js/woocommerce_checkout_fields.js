document.addEventListener('DOMContentLoaded', function () {
	const parentNode = document.body;

	// Функция, которая будет вызываться при изменениях в DOM
	const callback = function (mutationsList, observer) {
		mutationsList.forEach((mutation) => {
			if (mutation.type === 'childList') {
				const targetNode = document.querySelector('#shipping_method'); // Пытаемся заново найти элемент
				if (targetNode) {
					const secondLi = targetNode.children[1];

					if (secondLi) {
						const radioInput = secondLi.querySelector(
							'input[type="radio"]'
						); // Ищем input[type="radio"]

						if (radioInput && radioInput.checked) {
							// Проверяем, выбран ли он
							// Проверяем, есть ли уже добавленный текст
							if (!secondLi.querySelector('.pvz-text')) {
								secondLi.insertAdjacentHTML(
									'beforeend',
									'<p id="pick-up-point" class="pvz-text text-center text-red-500 hidden">Обязательно выбрать пункт выдачи *</p>'
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
