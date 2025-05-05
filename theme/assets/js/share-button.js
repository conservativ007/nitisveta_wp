document.addEventListener('DOMContentLoaded', function () {
	const shareButton = document.querySelector('.custom-share-icon');
	const defaultImg = document.querySelector('.img-default');
	const hoverImg = document.querySelector('.img-hover');

	if (shareButton) {
		shareButton.addEventListener('mouseenter', function () {
			defaultImg.style.opacity = '0';
			hoverImg.style.opacity = '1';
		});

		shareButton.addEventListener('mouseleave', function () {
			defaultImg.style.opacity = '1';
			hoverImg.style.opacity = '0';
		});
	}
});
