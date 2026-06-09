document.addEventListener('DOMContentLoaded', () => {
	const cityContainer = document.querySelector(
		'#select2-billing_city-container'
	);
	if (!cityContainer) return;

	const currentText = cityContainer.textContent.trim();
	if (currentText === 'Город') {
		cityContainer.textContent = 'Выберите город';
	}
});
