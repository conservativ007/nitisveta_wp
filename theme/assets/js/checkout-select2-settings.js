document.addEventListener('DOMContentLoaded', function () {
	jQuery('#billing_city')
		// .select2(options)
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
			// tags: true,
			allowClear: true,
			// minimumResultsForSearch: Infinity,
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

	// remove input from countries (select2)
	jQuery(function ($) {
		setTimeout(function () {
			const $select = $('#billing_country');
			if ($select.hasClass('select2-hidden-accessible')) {
				$select.select2('destroy');
			}
			$select.select2({
				minimumResultsForSearch: Infinity,
				width: '100%',
			});
		}, 100);
	});
});
