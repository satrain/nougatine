jQuery(document).ready(function ($) {

	// Function to validate inputs
	function validateInputs(stepContent) {
		var isValid = true;
		var shippingMethod = stepContent.find('input[name="choose_delivery"]:checked').val();


		if (stepContent[0].classList.contains('step-1')) {
			if (shippingMethod === 'pickup') {
				// Validate pickup fields
				stepContent.find('input[name^="pickup_"], select[name^="pickup_"]').each(function (index, element) {
					if (!$(this).val()) {
						isValid = false;
						$(this).addClass('input-error');
					} else {
						$(this).removeClass('input-error');
					}
				});
			} else {
				// Validate shipping fields
				stepContent.find('input[name^="shipping_"], select[name^="shipping_"]').each(function (index, element) {
					if (!$(this).val()) {
						isValid = false;
						$(this).addClass('input-error');
					} else {
						$(this).removeClass('input-error');
					}
				});
			}
		} else {
			stepContent[0].querySelectorAll('.validate-required').forEach(function (index, element) {
				index.querySelectorAll('input, select').forEach(function (index, element) {
					if (jQuery('#ship-to-different-address-checkbox').is(':checked')) {
						document.querySelectorAll('.woocommerce-shipping-fields__field-wrapper .validate-required').forEach(function (index, element) {
							index.querySelectorAll('input, select').forEach(function (index, element) {
								if (!index.value) {
									isValid = false;
									index.classList.add('input-error');
								} else {
									index.classList.remove('input-error');
								}
							});
						});
					} else {
						document.querySelectorAll('.woocommerce-billing-fields .validate-required').forEach(function (index, element) {
							index.querySelectorAll('input, select').forEach(function (index, element) {
								if (!index.value) {
									isValid = false;
									index.classList.add('input-error');
								} else {
									index.classList.remove('input-error');
								}
							});
						});
					}
				});
			})
		}


		return isValid;
	}

	// Listen to the input change and validate if all the inputs are filled out
	$(document).on('change', '.step-content.active  input.required, .step-content.active  select.required', function () {
		let activeContinueBtn = document.querySelector('.step-content.active .btn-continue')
		var filledOut = true;

		$('.step-content.active  input.required, .step-content.active  select.required').each(function () {
			if ($(this).val() === '') {
				filledOut = false;
			}
		});

		if (filledOut) {
			activeContinueBtn.classList.add('active');
		}
	});

	let continueBtn = document.querySelectorAll('.btn-continue');

	// Function to move to the next step
	function moveToNextStep(currentStep) {

		if (currentStep == 3) {
			return;
		}

		var stepContent = $('.step-' + currentStep);

		// First validate inputs
		if (!validateInputs(stepContent)) {
			// If not valid, don't proceed and perhaps alert the user
			let elem = document.createElement('div')
			elem.classList.add('form-error-message')
			if (document.querySelector('body').classList.contains('lang-he')) {
				elem.innerHTML = 'אנא מלא את כל השדות הדרושים.';
			} else {
				elem.innerHTML = 'Please fill out all required fields.';
			}

			document.querySelector('body').appendChild(elem);

			setTimeout(function () {
				document.querySelector('.form-error-message').remove();
			}, 3500);

			return; // Stop the function if validation fails
		}

		// Find the current active step and add 1 to move to the next step
		var nextStep = currentStep + 1;

		// Update the steps indicator
		$('.step').removeClass('current').filter(function () {
			return $(this).data('step') === nextStep;
		}).addClass('active current');

		// Hide current content and show next step content
		$('.step-content').removeClass('active');
		$('.step-' + nextStep).addClass('active');
	}

	for (let i = 0; i < continueBtn.length; i++) {
		continueBtn[i].addEventListener('click', () => {
			var currentStep = parseInt($('.step.current').data('step'), 10);
			moveToNextStep(currentStep);
		})
	}

	// Step 1 choose Delivery/Collect in Store functionality
	let stepDelivery = document.querySelector('.delivery')
	let stepStore = document.querySelector('.collect-in-store')
	let formDelivery = document.querySelector('.delivery-form')
	let formStore = document.querySelector('.collect-in-store-form')

	if (stepDelivery) {
		stepDelivery.addEventListener('click', () => {
			if (!stepDelivery.classList.contains('active')) {
				stepStore.classList.remove('active')
				stepDelivery.classList.add('active')
			}

			if (!formDelivery.classList.contains('active')) {
				formStore.classList.remove('active')
				formDelivery.classList.add('active')
			}
		})
	}

	if (stepStore) {
		stepStore.addEventListener('click', () => {
			if (!stepStore.classList.contains('active')) {
				stepDelivery.classList.remove('active')
				stepStore.classList.add('active')
			}

			if (!formStore.classList.contains('active')) {
				formDelivery.classList.remove('active')
				formStore.classList.add('active')
			}
		})
	}

	// Step 2 - Invoice on a different name
	let differentInvoice = document.querySelector('.different-name-invoice')
	let billingInfoForm = document.querySelector('.billing-info-form')

	if (differentInvoice) {
		differentInvoice.addEventListener('click', () => {
			let activeContinueBtn = document.querySelector('.step-content.active .btn-continue')
			if (!differentInvoice.classList.contains('active')) {
				differentInvoice.classList.add('active')
			} else {
				differentInvoice.classList.remove('active')
			}

			if (!billingInfoForm.classList.contains('active')) {
				billingInfoForm.classList.add('active')
			} else {
				billingInfoForm.classList.remove('active')
			}
		})
	}

	let orderSummaryBtn = document.querySelectorAll('.order-summary-btn-mobile')
	let orderSummary = document.querySelectorAll('.order-summary-mobile')

	if (orderSummaryBtn) {
		for (let i = 0; i < orderSummaryBtn.length; i++) {
			orderSummaryBtn[i].addEventListener('click', () => {
				orderSummary[i].querySelector('.products-list').classList.toggle('active');
				orderSummary[i].querySelector('.edit-order').classList.toggle('active');
				orderSummaryBtn[i].classList.toggle('active')
			})
		}
	}

	document.addEventListener('click', function(e) {
		if(e.target.classList.contains('btn-see-whole-order')) {
			e.preventDefault();
			document.querySelector('.list').classList.remove('load_items');
			e.target.remove();
		}
	});
});
