// We find the countries in the delivery list and translate them into Russian.
document.addEventListener('DOMContentLoaded', function () {
	const countries = {
		Armenia: 'Армения',
		Belarus: 'Беларусь',
		Kazakhstan: 'Казахстан',
		Kyrgyzstan: 'Кыргызстан',
		Russia: 'Россия',
	};

	const translateCountryOptions = () => {
		const elemOfTable = document.querySelector(
			'.woocommerce-billing-fields__field-wrapper'
		);
		if (!elemOfTable) return;

		let elemsOfListCountries = document.querySelectorAll(
			'#billing_country option'
		);

		elemsOfListCountries.forEach((elem) => {
			let rusNameOfCountry = countries[elem.innerHTML];
			if (rusNameOfCountry) {
				elem.innerHTML = rusNameOfCountry;
			}
		});
	};

	translateCountryOptions();
	jQuery(document.body).on('updated_checkout', translateCountryOptions);
});
