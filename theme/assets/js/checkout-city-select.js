document.addEventListener('DOMContentLoaded', function () {
	const countrySelect = document.querySelector('#billing_country');
	const citySelect = document.querySelector('#billing_city');
	let updateCheckoutTimeout = null;
	let lastSelectedCity = ''; // Сохраняем последний выбранный город

	if (!countrySelect || !citySelect || typeof jQuery === 'undefined') {
		return;
	}

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

	function triggerCheckoutUpdate() {
		if (updateCheckoutTimeout) {
			clearTimeout(updateCheckoutTimeout);
		}

		updateCheckoutTimeout = setTimeout(function () {
			jQuery('body').trigger('update_checkout');
		}, 500);
	}

	function toggleCityRequiredHint() {
		const cityField = document.querySelector('#billing_city_field');
		const cityValue = String(jQuery('#billing_city').val() || '').trim().toLowerCase();
		if (cityField) {
			cityField.classList.toggle('has-city', cityValue !== '' && cityValue !== 'город');
		}
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
				url: '/wp-json/custom/v1/cities',
				dataType: 'json',
				delay: 300,
				data: (params) => ({ q: params.term || '' }),
				processResults: (results) => ({ results }),
				cache: true,
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
				toggleCityRequiredHint();

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
				toggleCityRequiredHint();
			});

		toggleCityRequiredHint();
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
			toggleCityRequiredHint();
		}
	}

	updateCities();
	toggleCityRequiredHint();

	jQuery(document).ready(function ($) {
		$('#billing_country')
			.off('change')
			.on('change', function () {
				updateCities();
			});

		$(document).off('change.customCitySelect', '#billing_city');
	});
});
