// клонирование элемента в observer надежный способ без повторяющегося ID
// надёжный способ — поставить флаг, например, через data-* атрибут или класс, чтобы понять, что элемент уже клонировался.

document.addEventListener('DOMContentLoaded', function () {
	const cloneBillingFieldOnShipping = () => {
		const targetNode = document.querySelector('#shipping_method');
		if (!targetNode) return;

		const billingAddress2 = document.querySelector('#billing_address_2');
		const billingLastName = document.querySelector('#billing_last_name');

		const courierShippingMethod = document.querySelector(
			'#shipping_method_0_official_cdek-137'
		);
		const targetLi =
			courierShippingMethod?.closest('li') ||
			targetNode.querySelector('li:first-child');
		const alreadyCloned = targetLi?.querySelector('[data-cloned="true"]');
		// проверяем что элемент еще не клонирован
		if (targetLi && !alreadyCloned) {
			// Клонируем элемент, если он существует
			const billingField = document.querySelector(
				'#billing_address_1_field'
			);
			if (billingField) {
				// === Клонируем до изменения оригинала ===
				const clonedField = billingField.cloneNode(true);

				// 2. Меняем id и name в оригинале до вставки клона
				const originalInput = billingField.querySelector(
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
				targetLi.appendChild(clonedField);

				// 4. Настраиваем клон
				const clonedInput = clonedField.querySelector('input');
				if (clonedInput) {
					clonedInput.style.visibility = 'visible';
					clonedInput.style.position = 'static';
					clonedInput.id = 'billing_address_1';
					clonedInput.setAttribute('name', 'billing_address_1');
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

		jQuery(document.body).trigger('nitisveta_shipping_address_ready');
	};

	cloneBillingFieldOnShipping();
	jQuery(document.body).on('updated_checkout', cloneBillingFieldOnShipping);
});
