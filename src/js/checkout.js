jQuery(document).ready(function($) {

    // Function to validate inputs
    function validateInputs(stepContent) {
        var isValid = true;
        // Check if all required inputs within the step content are filled out
        stepContent.find('.form.active input.required, .form.active select.required').each(function() {
            if (!$(this).val()) {
                isValid = false;
                // Optionally, you can add some visual feedback for the user here
                $(this).addClass('input-error'); // add this class to your CSS with the desired error styling
            } else {
                $(this).removeClass('input-error');
            }
        });
        return isValid;
    }

    // Function to check if all the inputs/select options are filled out inside active form
    function inputsFilledOut(stepContent) {
        var continueBtn = $('.step-content.active .btn-continue');
        var isValid = true;
        stepContent.find('.form.active input.required, .form.active select.required').each(function() {

        if(!$(this).val()) {
            isValid = false;
        }

        if(isValid) {
            continueBtn.classList.add('active')
        }

        });
    }
    
    // Listen to the input change and validate if all the inputs are filled out
    $(document).on('change', '.step-content.active .form.active input.required, .step-content.active .form.active select.required', function() {
        let activeContinueBtn = document.querySelector('.step-content.active .btn-continue')
        var filledOut = true;
        
        $('.step-content.active .form.active input.required, .step-content.active .form.active select.required').each(function() {
            if($(this).val() === '') {
                filledOut = false;
            }
            console.log($(this).val())
            console.log(filledOut)
        });
        
        if(filledOut) {
            activeContinueBtn.classList.add('active');
        }
    });
    
    let continueBtn = document.querySelectorAll('.btn-continue');
    // Function to move to the next step
    function moveToNextStep(currentStep) {

        if(currentStep == 3) {
            return;
        }

        var stepContent = $('.step-' + currentStep);

        // First validate inputs
        if (!validateInputs(stepContent)) {
            // If not valid, don't proceed and perhaps alert the user
            let elem = document.createElement('div')
            elem.classList.add('form-error-message')
            if(document.querySelector('body').classList.contains('lang-he')) {
                elem.innerHTML = 'אנא מלא את כל השדות הדרושים.';
            }
            else {
                elem.innerHTML = 'Please fill out all required fields.';
            }

            document.querySelector('body').appendChild(elem);

            setTimeout(function() {
                document.querySelector('.form-error-message').remove();
            }, 3500);

            return; // Stop the function if validation fails
        }

        if(currentStep == 1) {
            // if user chose Collect in store -> remove Delivery costs
            if($('.collect-in-store').hasClass('active')) {
                $.ajax({
                    url: ajax_object.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'remove_delivery_charge', // The WordPress AJAX hook action
                    },
                    success: function(response) {
                        $('.delivery-price').text('₪0');
                        $('.delivery-price-wrapper').removeClass('active')
                    }
                });
            }
        }

        // Find the current active step and add 1 to move to the next step
        var nextStep = currentStep + 1;
        
        // Update the steps indicator
        $('.step').removeClass('current').filter(function() {
            return $(this).data('step') === nextStep;
        }).addClass('active current');
        
        // Hide current content and show next step content
        $('.step-content').removeClass('active');
        $('.step-' + nextStep).addClass('active');
    }

    for(let i = 0; i < continueBtn.length; i++) {
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

    if(stepDelivery) {
        stepDelivery.addEventListener('click', () => {
            if(!stepDelivery.classList.contains('active')) {
                stepStore.classList.remove('active')
                stepDelivery.classList.add('active')
            }

            if(!formDelivery.classList.contains('active')) {
                formStore.classList.remove('active')
                formDelivery.classList.add('active')
            }
        })
    }
    
    if(stepStore) {
        stepStore.addEventListener('click', () => {
            if(!stepStore.classList.contains('active')) {
                stepDelivery.classList.remove('active')
                stepStore.classList.add('active')
            }

            if(!formStore.classList.contains('active')) {
                formDelivery.classList.remove('active')
                formStore.classList.add('active')
            }
        })
    }

    // Step 2 - Invoice on a different name
    let differentInvoice = document.querySelector('.different-name-invoice')
    let billingInfoForm = document.querySelector('.billing-info-form')

    if(differentInvoice) {
        differentInvoice.addEventListener('click', () => {
            let activeContinueBtn = document.querySelector('.step-content.active .btn-continue')
            if(!differentInvoice.classList.contains('active')) {
                differentInvoice.classList.add('active')
            }
            else {
                differentInvoice.classList.remove('active')
            }

            if(!billingInfoForm.classList.contains('active')) {
                billingInfoForm.classList.add('active')
            }
            else {
                billingInfoForm.classList.remove('active')
            }
        })
    }

    let orderSummaryBtn = document.querySelectorAll('.order-summary-btn-mobile')
    let orderSummary = document.querySelectorAll('.order-summary-mobile')
    
    if(orderSummaryBtn) {
        for(let i = 0; i < orderSummaryBtn.length; i++) {
            orderSummaryBtn[i].addEventListener('click', () => {
                orderSummary[i].querySelector('.products-list').classList.toggle('active');
                orderSummary[i].querySelector('.edit-order').classList.toggle('active');
                orderSummaryBtn[i].classList.toggle('active')
            })
        }
    }

    $('#deliveryCity').change(function() {
        var selectedCityPrice = $(this).val();
        var data = {
            'action': 'handle_delivery_charge',
            'city_price': selectedCityPrice
        };

        $.post(ajax_object.ajax_url, data, function(response) {
            $('.delivery-price-wrapper').addClass('active')
            $('.delivery-price').text('₪' + response);
        });
    });
    

});