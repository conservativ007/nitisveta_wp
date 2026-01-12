(function (window) {
	function showToast(message, options = {}) {
		if (typeof Toastify === 'undefined') {
			console.error('Toastify не загружен');
			return;
		}

		Toastify({
			text: message,
			duration: options.duration || 3000,
			gravity: options.gravity || 'top',
			position: options.position || 'right',
			close: options.close ?? false,
			backgroundColor: options.backgroundColor || '#323232',
			stopOnFocus: true,
		}).showToast();
	}

	// экспорт в глобальную область
	window.showToast = showToast;
})(window);

window.toast = {
	success(text) {
		showToast(text, { backgroundColor: '#4CAF50' });
	},
	error(text) {
		showToast(text, { backgroundColor: '#EF3343' });
	},
	info(text) {
		showToast(text, { backgroundColor: '#2196F3' });
	},
};
