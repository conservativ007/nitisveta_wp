// We find the countries in the delivery list and translate them into Russian.
document.addEventListener('DOMContentLoaded', function () {
	const parentNode = document.body;

	const countries = {
		Armenia: 'Армения',
		Belarus: 'Беларусь',
		Kazakhstan: 'Казахстан',
		Kyrgyzstan: 'Кыргызстан',
		Russia: 'Россия',
	};

	const callback = function (mutationsList, observer) {
		mutationsList.forEach((mutation) => {
			if (mutation.type === 'childList') {
				const elemOfTable = document.querySelector(
					'.woocommerce-billing-fields__field-wrapper'
				);
				if (elemOfTable) {
					let elemsOfListCountries = document.querySelectorAll(
						'#billing_country option'
					);

					elemsOfListCountries.forEach((elem) => {
						let rusNameOfCountry = countries[elem.innerHTML];
						if (rusNameOfCountry) {
							elem.innerHTML = rusNameOfCountry;
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
