document.addEventListener('DOMContentLoaded', function () {
	let currentURL = window.location.pathname;
	const countrySelect = document.querySelector('#billing_country');

	const elemOfCustomCitySelect = document.querySelector(
		'.custom_city_select'
	);
	// console.log(currentURL === '/checkout/');

	let ul, div, input;

	const test = (e) => {
		// console.log(e.target.value);
		const selectedCountry = countrySelect?.value;
		if (typeof citiesData !== 'undefined' && citiesData) {
			const cities = citiesData[selectedCountry] || [];

			const filteredCities = cities.filter((city) =>
				city.toLowerCase().includes(e.target.value.toLowerCase())
			);

			updateCities(filteredCities);

			// console.log(filteredCities);
			// console.log(cities);
		}
	};

	const setListOfCitites = () => {
		if (currentURL === '/checkout/') {
			const parentOfWooCommerceElem =
				document.querySelector('.woocommerce');

			parentOfWooCommerceElem?.classList.add('relative');

			div = document.createElement('div');
			div.classList.add('container_list_of_cities');

			input = document.createElement('input');
			input.setAttribute('type', 'text');
			input.setAttribute('placeholder', 'Начните вводить название');
			input.classList.add('custom_input_of_cities');

			input.addEventListener('input', test);

			ul = document.createElement('ul');
			ul.classList.add('custom_list_of_cities');

			div.appendChild(input);
			div.appendChild(ul);
			parentOfWooCommerceElem?.prepend(div);
		}
	};

	setListOfCitites();

	const updateCities = (filteredCities = null) => {
		const selectedCountry = countrySelect?.value;

		// console.log(citiesData);

		if (typeof citiesData !== 'undefined' && citiesData) {
			const cities = filteredCities || citiesData[selectedCountry] || [];

			ul.innerHTML = ''; // Очищаем список перед обновлением

			cities.forEach((city) => {
				const li = document.createElement('li');
				li.textContent = city;
				li.addEventListener('click', () => {
					input.value = city; // Устанавливаем выбранный город в input
					elemOfCustomCitySelect.value = city;

					elemOfCustomCitySelect.dispatchEvent(
						new Event('input', { bubbles: true })
					);

					elemOfCustomCitySelect.dispatchEvent(
						new Event('change', { bubbles: true })
					);
				});
				ul.appendChild(li);
			});

			// div.classList.remove('hidden');
		}
	};

	updateCities();

	jQuery(document).ready(function ($) {
		$('#billing_country').on('change', function () {
			updateCities();
		});
	});

	// const countrySelect = document.querySelector('#billing_country');

	// console.log(parentOfWooCommerceElem);
});
