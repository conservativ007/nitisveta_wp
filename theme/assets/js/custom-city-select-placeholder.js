document.addEventListener('DOMContentLoaded', function () {
	const setSearchPlaceholder = () => {
		let searchField = document.querySelector('.select2-search__field');

		if (searchField) {
			searchField.setAttribute('placeholder', 'Начните вводить название');
			searchField.style.textAlign = 'center';

			searchField.focus();
		}
	};

	let addCountryPlaceholder = () => {
		let countrySelect = document.querySelector(
			'#select2-billing_country-container'
		);

		if (countrySelect) {
			countrySelect.removeEventListener('click', setSearchPlaceholder);
			countrySelect.addEventListener('click', setSearchPlaceholder);
		}
	};

	let addSomeClassToCitySelect = () => {
		let ul = document.querySelector('#select2-billing_city-results');

		if (ul) {
			ul.classList.add('custom-scrollbar');
		}

		let triangle = document.querySelector(
			'#select2-billing_city-container'
		);

		if (triangle) {
			triangle.classList.add('custom-triangle');
		}
	};

	const initSelectPlaceholders = () => {
		const targetNode = document.querySelector(
			'#select2-billing_city-container'
		);
		if (!targetNode) return;

		addCountryPlaceholder();
		setSearchPlaceholder();
		addSomeClassToCitySelect();
	};

	initSelectPlaceholders();
	jQuery(document.body).on('updated_checkout', initSelectPlaceholders);
	jQuery(document).on('select2:open', '#billing_city, #billing_country', initSelectPlaceholders);
});
