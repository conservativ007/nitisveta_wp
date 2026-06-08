document.addEventListener('DOMContentLoaded', function () {
	const test = (e) => {
		let elem = e.target.closest('li');
		if (!elem) return;

		let x = elem.querySelector('input[type="radio"]');

		if (x) {
			x.checked = true;
			// Создаём и вызываем событие change
			// чтобы сработал плагин СДЕК он слушает событие change
			let event = new Event('change', { bubbles: true });
			x.dispatchEvent(event);
		}
	};

	let flag = true;

	const initClickableShipping = () => {
		const targetNode = document.querySelector('#shipping_method');
		if (!targetNode) return;

		const newItems = document.querySelectorAll(
			'.my-custom-shipping-table li'
		);

		newItems.forEach((li, index) => {
			if (!li.dataset.clickableShippingBound) {
				li.dataset.clickableShippingBound = 'true';
				li.addEventListener('click', test);
			}

			if (index === 1 && flag === true) {
				li.click();
				flag = false;
			}

			let firstChild = li.querySelector('input[type="hidden"]');
			if (
				firstChild &&
				firstChild.nodeType === 1 && // проверка, что это элемент (не текст)
				firstChild.tagName === 'INPUT' &&
				firstChild.type === 'hidden' &&
				newItems.length < 2
			) {
				const shippingTable = document.querySelector(
					'.my-custom-shipping-table'
				);

				if (shippingTable) {
					shippingTable.innerHTML = '';
				}
			}
		});
	};

	initClickableShipping();
	jQuery(document.body).on('updated_checkout', initClickableShipping);
});
