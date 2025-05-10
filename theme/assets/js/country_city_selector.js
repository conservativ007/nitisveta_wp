document.addEventListener('DOMContentLoaded', async function () {
	const countrySelect = document.querySelector('#billing_country');
	const citySelect = document.querySelector('#billing_city');
	let allRussianCities = [];
	let ruCitiesLoaded = false;

	async function loadAllRussianCities() {
		if (ruCitiesLoaded) return;

		// try to get cities from localStorage
		const cached = localStorage.getItem('russianCitiesCache');
		if (cached) {
			try {
				allRussianCities = JSON.parse(cached);
				ruCitiesLoaded = true;
				return;
			} catch (error) {
				console.warn(
					'Ошибка парсинга localStorage, загружаем заново...'
				);
			}
		}

		try {
			const res = await fetch('/wp-json/custom/v1/cities');
			if (!res.ok) throw new Error('Ошибка загрузки городов России');

			const data = await res.json();
			allRussianCities = data;
			ruCitiesLoaded = true;

			localStorage.setItem('russianCitiesCache', JSON.stringify(data));
		} catch (error) {
			console.error('Ошибка загрузки JSON:', error);
		}
	}

	// preload cities
	if (countrySelect?.value === 'RU') {
		await loadAllRussianCities();
	}

	function initCitySelect2() {
		const selectedCountry = countrySelect.value;
		// console.log(selectedCountry);

		const options = {
			tags: true,
			allowClear: true,
			language: {
				noResults: () => 'Город не найден. Введите свой вариант.',
			},
		};

		if (selectedCountry === 'RU') {
			options.ajax = {
				transport: async function (params, success, failure) {
					await loadAllRussianCities();

					const term = params.data.q?.toLowerCase() || '';

					let filteredCities = allRussianCities.filter((city) => {
						return city.name.toLowerCase().includes(term);
					});

					if (!term) {
						filteredCities = filteredCities
							.filter((city) => city.population)
							.sort((a, b) => b.population - a.population);
					}

					const results = filteredCities.slice(0, 50).map((city) => {
						if (city.isDualName) {
							let text = `${city.name} ${city.region.name} ${city.region.typeShort}`;

							return {
								id: city.name,
								text,
							};
						}
						return { id: city.name, text: city.name };
					});
					// .map((city) => ({ id: city.name, text: city.name }));

					success({ results });
				},
				delay: 300,
			};
		}

		if (selectedCountry !== 'RU') {
			jQuery('#billing_city option')
				.filter(function () {
					return jQuery(this).text().trim() === 'Город';
				})
				.remove();
		}

		jQuery('#billing_city').select2(options);
	}

	function updateCities() {
		const selectedCountry = countrySelect?.value; // Получаем код страны

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

			if (selectedCountry !== 'RU') {
				cities.forEach((city) => {
					// citySelect.appendChild(inpSearch);
					const option = document.createElement('option');
					option.textContent = city;
					option.value = city;
					citySelect.appendChild(option);
				});
			}

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
