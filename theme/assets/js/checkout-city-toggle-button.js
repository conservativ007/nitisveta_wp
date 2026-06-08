jQuery(function ($) {
	const $city = $('#billing_city');
	const submitSelector = '#place_order';

	function toggleButton() {
		const cityVal = $city.val();
		const $submit = $(submitSelector);
		if (!cityVal || cityVal === 'город') {
			$submit.prop('disabled', true).addClass('checkout-btn-disabled');
		} else {
			$submit
				.prop('disabled', false)
				.removeClass('checkout-btn-disabled');
		}
	}

	toggleButton();
	$(document.body).on('updated_checkout', toggleButton);
	$(document).on('change select2:select select2:clear', '#billing_city', toggleButton);
});
