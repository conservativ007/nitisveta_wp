document.addEventListener('DOMContentLoaded', function () {
	const countrySelect = document.querySelector('#billing_country');
	const citySelect = document.querySelector('#billing_city');

	function initCitySelect2() {
		jQuery('#billing_city option')
			.filter(function () {
				return jQuery(this).text().trim() === 'Город';
			})
			.remove();
		jQuery('#billing_city')
			.select2({
				tags: true,
				allowClear: true,
				language: {
					noResults: function () {
						return 'Город не найден. Введите свой вариант';
					},
				},
			})
			.on('select2:open', function () {
				let city = document.querySelector(
					'#select2-billing_city-container'
				);

				let cityIsExpanded =
					city.parentElement.getAttribute('aria-expanded');

				if (cityIsExpanded) {
					city.classList.add('rotate-arrow');
				}
			})
			.on('select2:close', function () {
				let city = document.querySelector(
					'#select2-billing_city-container'
				);

				let cityIsExpanded =
					city.parentElement.getAttribute('aria-expanded');

				if (cityIsExpanded === 'false') {
					document
						.querySelector('#select2-billing_city-container')
						?.classList.remove('rotate-arrow');
				}
			});

		jQuery('#billing_country')
			.select2({
				tags: true,
				allowClear: true,
			})
			.on('select2:open', function () {
				let country = document.querySelector(
					'#select2-billing_country-container'
				);

				let countryIsExpanded =
					country.parentElement.getAttribute('aria-expanded');

				if (countryIsExpanded) {
					country.classList.add('rotate-arrow');
				}
			})
			.on('select2:close', function () {
				let country = document.querySelector(
					'#select2-billing_country-container'
				);

				let countryIsExpanded =
					country.parentElement.getAttribute('aria-expanded');

				if (countryIsExpanded === 'false') {
					country.classList.remove('rotate-arrow');
				}
			});
	}

	function updateCities() {
		const selectedCountry = countrySelect?.value; // Получаем код страны

		// console.log(typeof citiesData);
		if (typeof citiesData !== 'undefined' && citiesData) {
			const cities = citiesData[selectedCountry] || [];

			// Очищаем список городов
			citySelect.innerHTML = '';
			citySelect.classList.add('custom_city_select');

			// Добавляем плейсхолдер
			const placeholder = document.createElement('option');
			placeholder.textContent = 'Город';
			placeholder.value = 'город';
			citySelect.appendChild(placeholder);

			// Добавляем города из массива
			cities.forEach((city) => {
				// citySelect.appendChild(inpSearch);
				const option = document.createElement('option');
				option.textContent = city;
				option.value = city;
				citySelect.appendChild(option);
			});

			// Обновляем select
			citySelect.dispatchEvent(new Event('change'));

			// Инициализируем Select2 снова
			initCitySelect2();
		}
	}

	// Заполняем при загрузке
	updateCities();

	jQuery(document).ready(function ($) {
		$('#billing_country').on('change', function () {
			updateCities();
		});
	});
});
