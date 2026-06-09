document.addEventListener('DOMContentLoaded', function () {
	const citySelect = document.getElementById('billing_city');

	const hideElement = () => {
		const elemOfYandexShippingMethod = document.getElementById(
			'shipping_method_0_flat_rate-10'
		)?.parentElement;

		if (elemOfYandexShippingMethod) {
			elemOfYandexShippingMethod.style.display = 'none';
		}
	};

	const showElement = () => {
		const elemOfYandexShippingMethod = document.getElementById(
			'shipping_method_0_flat_rate-10'
		)?.parentElement;

		if (elemOfYandexShippingMethod) {
			elemOfYandexShippingMethod.style.display = 'block';
		}
	};

	const allowedCities = ['Москва', 'Санкт-Петербург', ''];

	const toggleYandexDelivery = () => {
		const targetNode = document.querySelector('#shipping_method');
		if (!targetNode || !citySelect) return;

		if (!allowedCities.includes(citySelect.value)) {
			hideElement();
		} else {
			showElement();
		}
	};

	toggleYandexDelivery();
	jQuery(document.body).on('updated_checkout', toggleYandexDelivery);
	jQuery(document).on('change select2:select', '#billing_city', toggleYandexDelivery);
});
