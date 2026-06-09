document.addEventListener('DOMContentLoaded', function () {
	const addPickupPointMessage = () => {
		const targetNode = document.querySelector('#shipping_method');
		if (!targetNode) return;

		const secondLi = targetNode.children[1];
		if (!secondLi) return;

		const radioInput = secondLi.querySelector('input[type="radio"]');

		if (radioInput && radioInput.checked && !secondLi.querySelector('.pvz-text')) {
			secondLi.insertAdjacentHTML(
				'beforeend',
				'<p id="pick-up-point" class="pvz-text text-center text-red-500 hidden">Обязательно выбрать пункт выдачи *</p>'
			);
		}
	};

	addPickupPointMessage();
	jQuery(document.body).on('updated_checkout', addPickupPointMessage);
	jQuery(document).on('change', '#shipping_method input[type="radio"]', addPickupPointMessage);
});
