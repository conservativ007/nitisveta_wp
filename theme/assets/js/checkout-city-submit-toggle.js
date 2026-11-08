jQuery(function ($) {
	const submitSelector = '#place_order';

	function toggleButton() {
		const $city = $('#billing_city');
		const cityVal = $city.val();
		const $submit = $(submitSelector);
		const consentAccepted = $('#terms').prop('checked') === true;
		const citySelected = cityVal && cityVal !== 'город';
		const disabled = !citySelected || !consentAccepted;

		$submit
			.prop('disabled', disabled)
			.toggleClass('checkout-btn-disabled', disabled);
	}

	toggleButton();
	$(document.body).on('updated_checkout', toggleButton);
	$(document).on(
		'change select2:select select2:clear',
		'#billing_city, #terms',
		toggleButton
	);
});
