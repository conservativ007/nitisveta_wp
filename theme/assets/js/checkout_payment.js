document.addEventListener('DOMContentLoaded', function () {
	const button = document.querySelector('#place_order');

	const handleClick = (e) => {
		let flag = true;

		// показываем что поле обязательно к заполенению если не заполнено (город)
		// const elem = document.querySelector('#billing_city');

		// if (elem.value === 'город') {
		// 	const parent = elem.closest('#billing_city_field');

		// 	if (parent) {
		// 		parent.classList.add('custom-opacity');
		// 		flag = false;
		// 	}
		// } else {
		// 	elem.closest('#billing_city_field').classList.remove(
		// 		'custom-opacity'
		// 	);
		// }

		// показываем что поля обязательно к заполенению если не заполнено (телефон, имя фамилия)
		// const elems = document.querySelectorAll(
		// 	'#billing_first_name_field, #billing_phone_field'
		// );

		const checkFirstNameAndSecondName = () => {
			// console.log('checkFirstNadSecondName');
			const containerFirstAndSecondNameInput = document.querySelector(
				'#billing_first_name_field'
			);
			const firstAndSecondNameInput = document.querySelector(
				'#billing_first_name'
			);
			if (
				firstAndSecondNameInput.value === '' ||
				firstAndSecondNameInput.value === undefined
			) {
				// console.log(containerFirstAndSecondNameInput);
				flag = false;
				containerFirstAndSecondNameInput.classList.add(
					'custom-opacity'
				);
				toast.error('Фамилия или имя не заполнены');
			} else {
				containerFirstAndSecondNameInput.classList.remove(
					'custom-opacity'
				);
			}
		};

		checkFirstNameAndSecondName();

		const checkPhone = () => {
			const containerPhone = document.querySelector(
				'#billing_phone_field'
			);
			const phoneInput = document.querySelector('#billing_phone');

			if (
				phoneInput.value === '' ||
				phoneInput.value === undefined ||
				phoneInput.value.length < 8
			) {
				flag = false;
				containerPhone.classList.add('custom-opacity');
				phoneInput.classList.add('!border-red-500');
				containerPhone.style.setProperty(
					'--custom-content-phone-field',
					'"минимум 8 цифр"'
				);
				toast.error('Телефон не введен');
			} else {
				containerPhone.classList.remove('custom-opacity');
				phoneInput.classList.remove('!border-red-500');
			}
		};

		checkPhone();

		// elems.forEach((elem) => {
		// 	const input = elem.querySelector('input');

		// 	if (input.value === '' || input.value === undefined) {
		// 		elem.classList.add('custom-opacity');
		// 		flag = false;
		// 	} else {
		// 		elem.classList.remove('custom-opacity');
		// 	}
		// });

		// поля CDEK

		let elemOfCDEK = document.querySelector('#shipping_method');

		if (!elemOfCDEK) return;

		let inputOfMethodDelivery1 = elemOfCDEK.querySelector(
			'#shipping_method_0_official_cdek-137'
		);

		let inputOfMethodDelivery2 = elemOfCDEK.querySelector(
			'#shipping_method_0_official_cdek-136'
		);

		if (inputOfMethodDelivery1.checked === true) {
			const billingAddress = document.querySelector('#billing_address_1');

			let elemOfMessage = elemOfCDEK.firstElementChild;

			if (billingAddress.value.length === 0) {
				elemOfMessage.classList.add('custom-opacity-after');
				elemOfMessage.style.setProperty(
					'--custom-content',
					'"Обязательно для заполнения"'
				);
				flag = false;
			} else if (billingAddress.value.length < 10) {
				elemOfMessage.classList.add('custom-opacity-after');
				elemOfMessage.style.setProperty(
					'--custom-content',
					'"Минимум 10 символов"'
				);
				flag = false;
			} else if (billingAddress.value.length >= 10) {
				elemOfMessage.classList.remove('custom-opacity-after');
			}
		}

		if (inputOfMethodDelivery2.checked === true) {
			let billingDddres = document.querySelector('.cdek-office-info');

			if (
				billingDddres === null ||
				billingDddres.innerHTML.length === 0
			) {
				flag = false;
				let elemOfMessage = document.querySelector('#pick-up-point');
				toast.error('Обязательно выбрать пункт выдачи');
				elemOfMessage.classList.remove('hidden');
			}
		}

		if (!flag) {
			e.preventDefault();
		}
	};

	// Observer
	const parentNode = document.body;

	// Функция, которая будет вызываться при изменениях в DOM
	const callback = function (mutationsList, observer) {
		mutationsList.forEach((mutation) => {
			if (mutation.type === 'childList') {
				const button = document.querySelector('#place_order'); // Пытаемся заново найти элемент
				if (button) {
					// Удаляем обработчик, если он уже был добавлен
					button.removeEventListener('click', handleClick);

					// Вешаем новый обработчик
					button.addEventListener('click', handleClick);
				}
			}
		});
	};

	// Создаем MutationObserver
	const observer = new MutationObserver(callback);

	// Настройки для отслеживания добавлений и удалений элементов
	const config = { childList: true, subtree: true };

	// Начинаем наблюдение за изменениями в родительском элементе или документе
	observer.observe(parentNode, config);
});
