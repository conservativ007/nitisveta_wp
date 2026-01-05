jQuery(function ($) {
	const $city = $('#billing_city');
	const submitSelector = '#place_order';
	const orderReviewContainer = document.getElementById('order_review');

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

	// watch order_review
	if (orderReviewContainer) {
		const observer = new MutationObserver(() => toggleButton());
		observer.observe(orderReviewContainer, {
			childList: true, // следим за вставкой/удалением дочерних элементов
			subtree: true, // следим за всеми вложенными элементами
		});
	}
});
