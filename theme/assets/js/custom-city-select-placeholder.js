document.addEventListener('DOMContentLoaded', function () {
	const parentNode = document.body;

	let addCountryPlaceholder = () => {
		let countrySelect = document.querySelector(
			'#select2-billing_country-container'
		);

		if (countrySelect) {
			countrySelect.addEventListener('click', function () {
				let searchField = document.querySelector(
					'.select2-search__field'
				);

				if (searchField) {
					searchField.setAttribute(
						'placeholder',
						'Начните вводить название'
					);
					searchField.style.textAlign = 'center';

					searchField.focus();
				}
			});
		}
	};

	let addCityPlaceholder = () => {
		let searchField = document.querySelector('.select2-search__field');

		if (searchField) {
			searchField.setAttribute('placeholder', 'Начните вводить название');

			searchField.style.textAlign = 'center';
			searchField.focus();
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

	const callback = function (mutationsList, observer) {
		mutationsList.forEach((mutation) => {
			if (mutation.type === 'childList') {
				const targetNode = document.querySelector(
					'#select2-billing_city-container'
				);
				if (targetNode) {
					addCountryPlaceholder();
					addCityPlaceholder();
					targetNode.addEventListener('click', function () {
						addSomeClassToCitySelect();
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
