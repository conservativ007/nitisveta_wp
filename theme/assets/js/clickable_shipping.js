document.addEventListener('DOMContentLoaded', function () {
	const test = (e) => {
		let elem = e.target;
		let x = elem.querySelector('input[type="radio"]');

		if (x) {
			x.checked = true;
			// Создаём и вызываем событие change
			// чтобы сработал плагин СДЕК он слушает событие change
			let event = new Event('change', { bubbles: true });
			x.dispatchEvent(event);
		}
	};

	const parentNode = document.body;
	let flag = true;

	// Функция, которая будет вызываться при изменениях в DOM
	const callback = function (mutationsList, observer) {
		mutationsList.forEach((mutation) => {
			if (mutation.type === 'childList') {
				const targetNode = document.querySelector('#shipping_method'); // Пытаемся заново найти элемент

				if (targetNode) {
					mutation.addedNodes.forEach((node) => {
						// Если это элемент и он содержит нужный селектор
						if (node.nodeType === 1) {
							const newItems =
								node.querySelectorAll?.(
									'.my-custom-shipping-table li'
								) || [];

							// console.log(newItems);
							// Навешиваем обработчик только на новые элементы
							newItems.forEach((li, index) => {
								li.addEventListener('click', (e) => test(e));

								if (index === 1 && flag === true) {
									li.click();
									flag = false;
								}

								let firstChild = li.querySelector(
									'input[type="hidden"]'
								);
								if (
									firstChild &&
									firstChild.nodeType === 1 && // проверка, что это элемент (не текст)
									firstChild.tagName === 'INPUT' &&
									firstChild.type === 'hidden' &&
									newItems.length < 2
								) {
									// document.querySelector(
									// 	'.my-custom-shipping-table'
									// ).style.display = 'none';

									document.querySelector(
										'.my-custom-shipping-table'
									).innerHTML = '';
								}
							});
						}
					});
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
