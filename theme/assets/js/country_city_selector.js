document.addEventListener('DOMContentLoaded', async function () {
	const countrySelect = document.querySelector('#billing_country');
	const citySelect = document.querySelector('#billing_city');
	let allRussianCities = [];
	let ruCitiesLoaded = false;
	let updateCheckoutTimeout = null;
	let lastSelectedCity = ''; // Сохраняем последний выбранный город

	// Перехватываем и исправляем запрос ks2008_city_autocomplete
	jQuery(document).ajaxSend(function (event, jqxhr, settings) {
		if (
			settings.data &&
			settings.data.includes('action=ks2008_city_autocomplete')
		) {
			const params = new URLSearchParams(settings.data);
			const searchTerm = params.get('search[term]');

			// Если search[term] содержит больше 100 символов или не совпадает с выбранным городом
			if (
				searchTerm &&
				(searchTerm.length > 100 || searchTerm !== lastSelectedCity)
			) {
				// console.log(
				// 	'Перехвачен некорректный запрос, подменяем на:',
				// 	lastSelectedCity
				// );

				// Подменяем search[term] на выбранный город
				params.set('search[term]', lastSelectedCity);
				settings.data = params.toString();

				// console.log('Исправленные данные запроса:', settings.data);
			}
		}
	});

	async function loadAllRussianCities() {
		if (ruCitiesLoaded) return;

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

	if (countrySelect?.value === 'RU') {
		await loadAllRussianCities();
	}

	function triggerCheckoutUpdate() {
		if (updateCheckoutTimeout) {
			clearTimeout(updateCheckoutTimeout);
		}

		updateCheckoutTimeout = setTimeout(function () {
			jQuery('body').trigger('update_checkout');
		}, 500);
	}

	function initCitySelect2() {
		const selectedCountry = countrySelect.value;

		if (jQuery('#billing_city').hasClass('select2-hidden-accessible')) {
			jQuery('#billing_city').select2('destroy');
		}

		const options = {
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

					let results = filteredCities.slice(0, 50).map((city) => {
						if (city.isDualName) {
							let text = `${city.name} ${city.region.name} ${city.region.typeShort}`;
							return {
								id: city.name,
								text,
							};
						}
						return { id: city.name, text: city.name };
					});

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

		// Обработчик выбора города
		jQuery('#billing_city')
			.off('select2:select')
			.on('select2:select', function (e) {
				const selectedCity = e.params.data.id;
				lastSelectedCity = selectedCity; // Сохраняем выбранный город
				// console.log('Выбран город:', selectedCity);

				// Устанавливаем значение явно
				jQuery(this).val(selectedCity).trigger('change.select2');

				// Триггерим обновление checkout
				triggerCheckoutUpdate();
			});

		// Также отслеживаем обычный change
		jQuery('#billing_city')
			.off('change.custom')
			.on('change.custom', function () {
				const cityValue = jQuery(this).val();
				if (cityValue && cityValue !== lastSelectedCity) {
					lastSelectedCity = cityValue;
					// console.log('Город изменен на:', cityValue);
				}
			});
	}

	function updateCities() {
		const selectedCountry = countrySelect?.value;

		if (typeof citiesData !== 'undefined' && citiesData) {
			const cities = citiesData[selectedCountry] || [];

			citySelect.innerHTML = '';
			citySelect.classList.add('custom_city_select');

			const placeholder = document.createElement('option');
			placeholder.textContent = 'Город';
			placeholder.value = 'город';
			citySelect.appendChild(placeholder);

			if (selectedCountry !== 'RU') {
				cities.forEach((city) => {
					const option = document.createElement('option');
					option.textContent = city;
					option.value = city;
					citySelect.appendChild(option);
				});
			}

			citySelect.dispatchEvent(new Event('change'));
			initCitySelect2();
		}
	}

	updateCities();

	jQuery(document).ready(function ($) {
		$('#billing_country')
			.off('change')
			.on('change', function () {
				updateCities();
			});

		$(document).off('change', '#billing_city');
	});
});
