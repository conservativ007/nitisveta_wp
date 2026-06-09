document.addEventListener('DOMContentLoaded', function () {
	const toggleBillingAddress = () => {
		const targetNode = document.querySelector('#shipping_method');

		if (!targetNode) return;

		const elemOfShippingMetgod137 = document.querySelector(
			'#shipping_method_0_official_cdek-137'
		);

		const elemOfBillingAddress1 =
			document.querySelector('#billing_address_1');

		if (!elemOfShippingMetgod137 || !elemOfBillingAddress1) return;

		const billingAddressField = elemOfBillingAddress1.closest(
			'[data-cloned="true"], #billing_address_1_field'
		);
		const displayValue = elemOfShippingMetgod137.checked ? '' : 'none';

		elemOfBillingAddress1.style.display = displayValue;

		if (billingAddressField) {
			billingAddressField.style.display = displayValue;
		}
	};

	toggleBillingAddress();
	jQuery(document.body).on('updated_checkout', toggleBillingAddress);
	jQuery(document.body).on('nitisveta_shipping_address_ready', toggleBillingAddress);
	jQuery(document).on('change', '#shipping_method input[type="radio"]', toggleBillingAddress);
});
