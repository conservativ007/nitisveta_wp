document.addEventListener('DOMContentLoaded', function () {
	const countrySelect = document.querySelector('#billing_country');
	const cityElement = document.querySelector('#billing_city_field');
	const citySelect = document.querySelector('#billing_city');

	function initCitySelect2() {
		// jQuery('#billing_city option')
		// 	.filter(function () {
		// 		return jQuery(this).text().trim() === 'Город';
		// 	})
		// 	.remove();
		// jQuery('#billing_city')
		// 	.select2({
		// 		tags: true,
		// 		allowClear: true,
		// 		language: {
		// 			noResults: function () {
		// 				return 'Город не найден. Введите свой вариант';
		// 			},
		// 		},
		// 	})
		// 	.on('select2:open', function () {
		// 		let city = document.querySelector(
		// 			'#select2-billing_city-container'
		// 		);

		// 		let cityIsExpanded =
		// 			city.parentElement.getAttribute('aria-expanded');

		// 		if (cityIsExpanded) {
		// 			city.classList.add('rotate-arrow');
		// 		}
		// 	})
		// 	.on('select2:close', function () {
		// 		let city = document.querySelector(
		// 			'#select2-billing_city-container'
		// 		);

		// 		let cityIsExpanded =
		// 			city.parentElement.getAttribute('aria-expanded');

		// 		if (cityIsExpanded === 'false') {
		// 			document
		// 				.querySelector('#select2-billing_city-container')
		// 				?.classList.remove('rotate-arrow');
		// 		}
		// 	});

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
		const selectedCountry = countrySelect?.value;
		if (typeof citiesData !== 'undefined' && citiesData) {
			const cities = citiesData[selectedCountry] || [];

			// Очистим контейнер перед добавлением
			// cityElement.innerHTML = '';
			const children = cityElement.children;

			if (children.length >= 3) {
				cityElement.removeChild(children[2]); // удаляем третий
				cityElement.removeChild(children[1]); // удаляем второй
			}

			cityElement.classList.add('custom_city_select2');
			console.log(cityElement);

			// Создаем input для поиска
			const input = document.createElement('input');
			input.type = 'text';
			input.placeholder = 'Search city...';
			input.classList.add('city-search-input');

			// Создаем dropdown-обёртку
			const dropdown = document.createElement('div');
			dropdown.classList.add('city-dropdown');
			dropdown.style.display = 'none';

			// Создаем список городов
			const list = document.createElement('ul');
			list.classList.add('city-list');

			cities.forEach((city) => {
				const li = document.createElement('li');
				li.textContent = city;
				li.classList.add('city-item');
				list.appendChild(li);
			});

			dropdown.appendChild(list);
			cityElement.appendChild(input);
			cityElement.appendChild(dropdown);

			// Показать/скрыть список при фокусе
			input.addEventListener('focus', () => {
				dropdown.style.display = 'block';
			});
			input.addEventListener('blur', () => {
				setTimeout(() => (dropdown.style.display = 'none'), 200); // задержка для выбора
			});

			// Фильтрация городов
			input.addEventListener('input', () => {
				const query = input.value.toLowerCase();
				document.querySelectorAll('.city-item').forEach((item) => {
					item.style.display = item.textContent
						.toLowerCase()
						.includes(query)
						? 'block'
						: 'none';
				});
			});

			// Обработка выбора города
			list.addEventListener('click', (e) => {
				if (e.target.matches('.city-item')) {
					const selectedCity = e.target.textContent;

					input.value = e.target.textContent;

					// Очищаем и обновляем citySelect (если нужен select-элемент)
					citySelect.innerHTML = ''; // очищаем старые опции

					const option = document.createElement('option');
					option.textContent = selectedCity;
					// option.value = selectedCity;
					// option.setAttribute('selected', 'selected');

					console.log(option);

					citySelect.appendChild(option);

					citySelect.dispatchEvent(
						new Event('input', { bubbles: true })
					);

					dropdown.style.display = 'none';
				}
			});

			// cityElement.dispatchEvent(new Event('change', { bubbles: true }));
			// cityElement.dispatchEvent(new Event('input', { bubbles: true }));

			// cityElement.addEventListener('input', () => {
			// 	console.log('Событие change сработало');
			// });
			citySelect.addEventListener('input', () => {
				console.log('Событие change сработало');
			});
		}
	}

	// Заполняем при загрузке
	updateCities();

	jQuery(document).ready(function ($) {
		$('#billing_country').on('change', function () {
			updateCities();
		});
	});

	// const ids = [];
	// const elements = document.querySelectorAll('[id]');
	// elements.forEach((element) => {
	// 	if (ids.includes(element.id)) {
	// 		console.log(`Дублирующийся id: ${element.id}`);
	// 		console.log('Родитель:', element.parentElement);
	// 	} else {
	// 		ids.push(element.id);
	// 	}
	// });
});
