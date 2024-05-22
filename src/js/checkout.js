jQuery(document).ready(function ($) {
	var startTime = pickersTime.startTime,
		endTime = pickersTime.endTime,
		interval = pickersTime.interval,
		timeslots = [],
		current = moment(startTime, "HH:mm"),
		end = moment(endTime, "HH:mm"),
		disabledDates = pickersDate.disabledDates.map(function (date) {
			return moment(date, 'DD.MM.YYYY').toDate();
		}),
		bodyClasses = Array.from(document.body.classList),
		isHebrew = bodyClasses.includes('lang-he'),
		monthNames = ['ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר'],
		today = new Date(),
		fourMonthsFromNow = new Date();
	fourMonthsFromNow.setMonth(today.getMonth() + 4);

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

	document.addEventListener('click', function (e) {
		if (e.target.classList.contains('btn-see-whole-order')) {
			e.preventDefault();
			document.querySelector('.list').classList.remove('load_items');
			e.target.remove();
		}
	});


	while (current.isBefore(end)) {
		var timeslotEnd = moment(current).add(interval, "minutes");
		if (timeslotEnd.isAfter(end)) {
			timeslotEnd = end;
		}
		timeslots.push(current.format("HH:mm") + " - " + timeslotEnd.format("HH:mm"));
		current.add(interval, "minutes");
	}
	for (var key in timeslots) {
		if (timeslots.hasOwnProperty(key)) {
			var $button = jQuery("<button />").text(timeslots[key]);
			$button.on("click", function () {
				jQuery("#shipping_time").val(jQuery(this).text());
				jQuery("#pickup_time").val(jQuery(this).text());
				jQuery("#timeslots").dialog("close");
			});
			jQuery("#timeslots").append($button);
		}
	}

	jQuery("#timeslots").dialog({
		autoOpen: false,
		modal: true,
		buttons: {},
		open: function (event, ui) {
			jQuery(".ui-widget-overlay").on("click", function () {
				jQuery("#timeslots").dialog("close");
			});
		}
	});
	jQuery("#shipping_time").on("click", function () {
		jQuery("#timeslots").dialog("open");
	});


	jQuery("#pickup_time").on("click", function () {
		jQuery("#timeslots").dialog("open");
	});

	if (isHebrew) {
		var picker = new Pikaday({
			field: document.getElementById('datepicker'),
			format: 'DD.MM.YYYY',
			minDate: new Date(),
			maxDate: fourMonthsFromNow,
			i18n: {
				previousMonth: 'החודש הקודם',
				nextMonth: 'החודש הבא',
				months: monthNames,
				weekdays: ['ראשון', 'שני', 'שלישי', 'רביעי', 'חמישי', 'שישי', 'שבת'],
				weekdaysShort: ['א', 'ב', 'ג', 'ד', 'ה', 'ו', 'ש']
			},
			disableDayOfWeek: [6],
			disableDayFn: function (date) {
				var today = new Date();
				today.setHours(0, 0, 0, 0);
				return date.getTime() === today.getTime() || date.getDay() === 6 || disabledDates.some(function (disabledDate) {
					return moment(date).isSame(disabledDate, 'day');
				});
			},
			onSelect: function () {
				jQuery("#shipping_date").val(this.toString());
				jQuery("#pickup_date").val(this.toString());
				jQuery("#dateslot").dialog("close");
			}
		});
	} else {
		var picker = new Pikaday({
			field: document.getElementById('datepicker'),
			format: 'DD.MM.YYYY',
			minDate: new Date(),
			disableDayOfWeek: [6],
			maxDate: fourMonthsFromNow,
			disableDayFn: function (date) {
				var today = new Date();
				today.setHours(0, 0, 0, 0);
				return date.getTime() === today.getTime() || date.getDay() === 6 || disabledDates.some(function (disabledDate) {
					return moment(date).isSame(disabledDate, 'day');
				});
			},
			onSelect: function () {
				jQuery("#shipping_date").val(this.toString());
				jQuery("#pickup_date").val(this.toString());
				jQuery("#dateslot").dialog("close");
			},
		});
	}

	jQuery("#dateslot").dialog({
		autoOpen: false,
		modal: true,
		dialogClass: 'dateslot-dialog',
		open: function () {
			picker.show();
			jQuery(".ui-widget-overlay").on("click", function () {
				jQuery("#dateslot").dialog("close");
			});
		},
		close: function () {
			picker.hide();
		}
	});

	jQuery("#shipping_date").on("click", function () {
		jQuery("#dateslot").dialog("open");
	});
	jQuery("#pickup_date").on("click", function () {
		jQuery("#dateslot").dialog("open");
	});

	var picker_modal = new Pikaday({
		field: document.getElementById('deliveryDate_pdf_export'),
		format: 'DD.MM.YYYY',
		minDate: new Date(),
		disableDayOfWeek: [6],
		autoClose: true,
		disableDayFn: function (date) {
			var today = new Date();
			today.setHours(0, 0, 0, 0);
			return date.getTime() === today.getTime() || date.getDay() === 6 || disabledDates.some(function (disabledDate) {
				return moment(date).isSame(disabledDate, 'day');
			});
		},
		onSelect: function () {
			jQuery("#deliveryDate_pdf_export").val(this.toString());
			jQuery("#deliveryDate_pdf_export").trigger('input');
			picker_modal.hide(0);
		}
	});
	if (isHebrew) {
		var picker_modal = new Pikaday({
			field: document.getElementById('deliveryDate_pdf_export'),
			format: 'DD.MM.YYYY',
			minDate: new Date(),
			disableDayOfWeek: [6],
			maxDate: fourMonthsFromNow,
			autoClose: true,
			i18n: {
				previousMonth: 'החודש הקודם',
				nextMonth: 'החודש הבא',
				months: monthNames,
				weekdays: ['ראשון', 'שני', 'שלישי', 'רביעי', 'חמישי', 'שישי', 'שבת'],
				weekdaysShort: ['א', 'ב', 'ג', 'ד', 'ה', 'ו', 'ש']
			},
			disableDayFn: function (date) {
				var today = new Date();
				today.setHours(0, 0, 0, 0);
				return date.getTime() === today.getTime() || date.getDay() === 6 || disabledDates.some(function (disabledDate) {
					return moment(date).isSame(disabledDate, 'day');
				});
			},
			onSelect: function () {
				jQuery("#deliveryDate_pdf_export").val(this.toString());
				jQuery("#deliveryDate_pdf_export").trigger('input');
				picker_modal.hide(0);
			}
		});
	} else {
		var picker_modal = new Pikaday({
			field: document.getElementById('deliveryDate_pdf_export'),
			format: 'DD.MM.YYYY',
			minDate: new Date(),
			disableDayOfWeek: [6],
			maxDate: fourMonthsFromNow,
			autoClose: true,
			disableDayFn: function (date) {
				var today = new Date();
				today.setHours(0, 0, 0, 0);
				return date.getTime() === today.getTime() || date.getDay() === 6 || disabledDates.some(function (disabledDate) {
					return moment(date).isSame(disabledDate, 'day');
				});
			},
			onSelect: function () {
				jQuery("#deliveryDate_pdf_export").val(this.toString());
				jQuery("#deliveryDate_pdf_export").trigger('input');
				picker_modal.hide(0);
			}
		});
	}

	jQuery('.export-btn').on('click', function (event) {
		event.preventDefault();
		jQuery('#export-popup').show();
	});

	jQuery('.get_pdf').on('click', function (event) {
		// Get the URL from the data-pdf attribute.
		var url = new URL(jQuery(this).data('pdf'));

		// Get all filled fields in the #export-popup form.
		jQuery('#export-popup :input').each(function () {
			if (jQuery(this).val()) {
				// Add each field's value as a query parameter.
				url.searchParams.append(jQuery(this).attr('name'), jQuery(this).val());
			}
		});

		// Set the modified URL as the new data-pdf attribute.
		jQuery(this).attr('data-pdf', url.toString());
		window.location.href = url.toString();
	});

	if (jQuery('body.woocommerce-cart').length > 0) {
		var export_modal = document.getElementById('export-popup');
		var button = export_modal.querySelector('button');
		var requiredFields = Array.from(export_modal.querySelectorAll('input[required]'));
		var allFields = Array.from(export_modal.querySelectorAll('input'));


		// Check if all required fields are filled
		function checkRequiredFields() {
			var allFilled = requiredFields.every(function (field) {
				return field.value !== '';
			});

			if (allFilled) {
				button.disabled = false;
				button.classList.add('active');
			} else {
				button.disabled = true;
				button.classList.remove('active');
			}
		}

		// Add event listener to all fields
		allFields.forEach(function (field) {
			field.addEventListener('input', checkRequiredFields);
		});

		// Close modal when clicking outside of it
		window.addEventListener('click', function (event) {
			if (event.target == export_modal) {
				export_modal.style.display = 'none';
			}
		});

		// Close modal when pressing escape key
		window.addEventListener('keydown', function (event) {
			if (event.key === 'Escape') {
				export_modal.style.display = 'none';
			}
		});
	}

	document.addEventListener('click', function (e) {
		if (e.target.closest('.step')) {
			document.querySelectorAll('.step').forEach(function (index, element) {
				index.classList.remove('active');
				index.classList.remove('current');
			})
			e.target.closest('.step').classList.add('active');
			e.target.closest('.step').classList.add('current');
			let step = e.target.closest('.step').dataset.step;
			document.querySelectorAll('.step-content').forEach(function (index, element) {
				index.classList.remove('active');
			})
			document.querySelector('.step-' + step).classList.add('active');
		}
	})

	jQuery(document).ready(function ($) {
		$('#delivery_city').select2({
			minimumInputLength: 3,
			placeholder: 'בחר עיר',
			allowClear: true,
			dir: "rtl",
			language: {
				inputTooShort: function () {
					return "נא להזין 3 תווים או יותר";
				},
				noResults: function () {
					return "לא נמצאו תוצאות";
				},
			}
		});
	});
});
