document.addEventListener('DOMContentLoaded', function () {
	let modal = document.getElementsByClassName('image-modal')[0],
		fullsize = document.getElementsByClassName('full-size-image-modal')[0],
		productsModal = document.getElementsByClassName('products-catalog-modal')[0];


	window.onclick = function (event) {
		if (event.target == modal) {
			modal.classList.remove('active');
		}

		if (event.target == fullsize) {
			fullsize.classList.remove('active');
		}
	}


	window.addEventListener('keydown', function (event) {
		if (event.key === "Escape") {
			modal.classList.remove('active');
		}

		if (event.key === "Escape") {
			fullsize.classList.remove('active');
		}

	});


	var element = document.querySelector('.categories.product-categories');

	if (element) {
		var offset = 305; // Set the offset (in pixels) from the top at which you want the element to become sticky

		window.addEventListener('scroll', function () {
			// Check if the scroll position is below the offset
			if (window.scrollY >= offset) {
				element.classList.add('sticky'); // Add a CSS class to make the element sticky
			} else {
				element.classList.remove('sticky'); // Remove the CSS class to make the element non-sticky
			}
		});
	}


	let catDropdown = document.querySelector('#catDropdown')
	let dropdownContent = document.querySelector('.dropdown-content')
	let dropdownItems = document.querySelectorAll('.dropdown-content .item')

	if (catDropdown) {
		catDropdown.addEventListener('click', () => {
			catDropdown.classList.toggle('active')
			dropdownContent.classList.toggle('active')
		})
	}

	if (dropdownItems) {
		for (let i = 0; i < dropdownItems.length; i++) {
			dropdownItems[i].addEventListener('click', () => {
				catDropdown.classList.remove('active')
				dropdownContent.classList.remove('active')
			})
		}
	}

	function checkSelections() {
		const sections = document.querySelectorAll('.section.required');
		let allSelected = true;
		console.log('works')

		sections.forEach(function (section) {
			// Check if this section has a radio button that's checked
			const isSelected = section.querySelector('input[type="radio"]:checked');
			if (!isSelected) {
				allSelected = false;
				console.log('not checked')
			}
		});

		// Toggle the 'active' class on the Add to Cart button based on allSelected flag
		const addToCartBtn = document.querySelector('.products-catalog-modal .btn-add-to-cart');
		if (allSelected) {
			addToCartBtn.classList.add('active');
		} else {
			addToCartBtn.classList.remove('active');
		}
	}

	// Attach change event listeners to all radio buttons
	const radioButtons = document.querySelectorAll('.products-catalog-modal .section.required input');
	radioButtons.forEach(function (radio) {
		radio.addEventListener('click', checkSelections);
	});

	const productCards = document.querySelectorAll('.product-card.inactive'),
		categorySections = document.querySelectorAll('.product-catalog-category-wrapper'),
		headerHeight = document.querySelector('header').offsetHeight;

	const observer = new IntersectionObserver((entries, observer) => {
		entries.forEach(entry => {
			if (!entry.isIntersecting) {
				return;
			}

			const div = entry.target;
			div.classList.remove('inactive');
			div.classList.add('active');
			observer.unobserve(div);
		});
	});

	productCards.forEach(div => observer.observe(div));
	document.documentElement.style.setProperty('--header-height', `${headerHeight}px`);

	if (window.matchMedia('(max-width: 768px)').matches) {
		const observerMobileHeadings = new IntersectionObserver((entries, observer) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					document.querySelectorAll('.sticky').forEach(el => el.classList.remove('sticky'));
					entry.target.classList.add('sticky');
				}
			});
		}, {threshold: 0.5});

		categorySections.forEach(el => observerMobileHeadings.observe(el));
	}

	document.querySelectorAll('#categoriesWrapper a[href^="#"]').forEach(anchor => {
		anchor.addEventListener('click', function (e) {
			e.preventDefault();

			const id = this.getAttribute('href').substring(1),
				targetElement = document.querySelector(`[id="${id}"]`);

			if (targetElement) {
				targetElement.scrollIntoView({
					behavior: 'smooth'
				});
			}
		});
	});
});

jQuery(document).ready(function ($) {

	// Successfully added product to the cart notification
	let addToCartBtns = document.querySelectorAll('.nougatine-add-to-cart')
	if (addToCartBtns) {
		addToCartBtns.forEach(button => {
			button.addEventListener('click', event => {
				var productInfo = event.target.closest('.product-card');
				var productName = productInfo.dataset.productName;
				let notification = document.querySelector('.added-to-cart-message')
				let notificationText = notification.querySelector('p')
				notification.classList.add('active')
				if (document.querySelector('body').classList.contains('lang-he')) {
					notificationText.innerHTML = productName + ' התווסף לעגלה.';
				} else {
					notificationText.innerHTML = productName + ' has been added to cart.';
				}

				setTimeout(function () {
					notification.classList.remove('active')
				}, 6500);
			});
		})
	}

	let productCards = document.querySelectorAll('.product-card .img-holder')
	let productCardsImages = document.querySelectorAll('.products-catalog-modal .image-holder')
	let imageContent = document.querySelectorAll('.imageContent')
	let imageModal = document.querySelector('.image-modal')
	let imageModalContent = document.querySelector('.image-modal-content')
	let closeImageModalContent = document.querySelector('.image-modal-content .close')
	let closeImageModal = document.querySelector('.image-modal .close')

	for (let i = 0; i < productCards.length; i++) {
		productCards[i].addEventListener('click', () => {
			let productId = productCards[i].getAttribute('data-product-id');
			let productName = productCards[i].getAttribute('data-product-name');
			let productPrice = productCards[i].getAttribute('data-product-price');
			let productImage = productCards[i].querySelector('img').src;

			let modal = document.querySelector('.products-catalog-modal')
			modal.querySelector('.product-image').src = productImage
			modal.querySelector('.title .price').innerHTML = '₪' + productPrice
			modal.querySelector('.title h2').innerHTML = productName

			//add ajax to pull all the additional fields
			$.ajax({
				type: 'POST',
				url: ajax_object.ajax_url,
				data: {
					'action': 'modal_load_product_data',
					'product_id': productId,
				},
				success: function (response) {

					let productData = response.data;
					console.log(productData)

					if (productData.hasOwnProperty('product_description')) {
						document.querySelector('.main-content .description').innerHTML = productData.product_description;
					}

					if (productData.hasOwnProperty('personalized_message') && productData.personalized_message.display_personalized_message == 'yes') {
						document.querySelector('.personalized-message').classList.add('active')
						document.querySelector('.personalized-message p').innerHTML = productData.personalized_message.personalized_message_title;
						document.querySelector('.personalized-message-separator').style.display = "block"
					} else {
						document.querySelector('.personalized-message').classList.remove('active')
						document.querySelector('.personalized-message-separator').style.display = "none"
					}

					if (productData.hasOwnProperty('bundle_items') && productData.bundle_items.items.length > 0) {
						const productContainingDiv = document.querySelector('.section.product-containing');
						if (productContainingDiv.querySelector('.product-containing-list')) {
							productContainingDiv.querySelector('.product-containing-list').innerHTML = '';
						}
						productContainingDiv.classList.add('active')

						// Create the h3 element
						const h3 = document.createElement('h3');
						h3.textContent = productData.bundle_items.title;

						// Create the product-containing-list div
						const productListDiv = document.createElement('div');
						productListDiv.classList.add('product-containing-list');

						productData.bundle_items.items.forEach(item => {
							const productDiv = document.createElement('div');
							const productP = document.createElement('p');
							productP.textContent = item.item_name;
							productDiv.appendChild(productP);
							productListDiv.appendChild(productDiv);
						});

						// Insert the h3 and product list before the read-more link
						const readMoreLink = productContainingDiv.querySelector('.load-product-containing-list');
						productContainingDiv.insertBefore(h3, readMoreLink);
						productContainingDiv.insertBefore(productListDiv, readMoreLink);

						let readMore = document.querySelector('.load-product-containing-list')
						let containingList = document.querySelector('.product-containing-list')

						readMore.addEventListener('click', () => {
							containingList.classList.toggle('active')

							if (!readMore.classList.contains('active')) {
								readMore.classList.add('active')
							} else {
								readMore.classList.remove('active')
							}
						})
					} else {
						const productContainingDiv = document.querySelector('.section.product-containing');
						productContainingDiv.classList.remove('active')
					}

					if (productData.hasOwnProperty('select_options')) {
						const optionsWrapper = document.querySelector('.choose-options-wrapper');
						optionsWrapper.innerHTML = '';
						optionsWrapper.classList.add('active')

						let i = 0;
						productData.select_options.forEach(item => {
							// Create the .section.choose-option div
							const sectionDiv = document.createElement('div');
							sectionDiv.classList.add('section', 'choose-option', 'required');

							// Create the h3 element
							const h3 = document.createElement('h3');
							h3.textContent = item.option.title;

							// Create the options-wrapper div
							const optionsDiv = document.createElement('div');
							optionsDiv.classList.add('options-wrapper');

							item.option.option_items.forEach(option_item => {
								const optionDiv = document.createElement('div');
								optionDiv.classList.add('option');

								const input = document.createElement('input');
								input.type = 'radio';
								input.name = 'select-' + i;
								input.value = option_item.option_title;

								const label = document.createElement('p');
								label.textContent = option_item.option_title;

								optionDiv.appendChild(input);
								optionDiv.appendChild(label);
								optionsDiv.appendChild(optionDiv);
							})

							// Assemble the section
							sectionDiv.appendChild(h3);
							sectionDiv.appendChild(optionsDiv);
							// Append the section to the .choose-options-wrapper
							optionsWrapper.appendChild(sectionDiv);
							i++;
						})
					} else {
						const optionsWrapper = document.querySelector('.choose-options-wrapper');
						optionsWrapper.classList.remove('active')
					}

					if (productData.hasOwnProperty('additional_options')) {
						const additionalOptions = document.querySelector('.additional-options')
						const optionsListDiv = document.querySelector('.additional-options-list');
						optionsListDiv.innerHTML = '';
						additionalOptions.classList.add('active')
						productData.additional_options.forEach(option => {
							const itemDiv = document.createElement('div');
							itemDiv.classList.add('item', 'active');
							itemDiv.setAttribute('data-additionaloption', option.title);

							const checkboxDiv = document.createElement('div');
							checkboxDiv.classList.add('checkbox');

							const checkedDiv = document.createElement('div');
							checkedDiv.classList.add('checked');

							const labelP = document.createElement('p');
							labelP.textContent = option.title;

							// Assemble the checkbox
							checkboxDiv.appendChild(checkedDiv);

							// Assemble the item
							itemDiv.appendChild(checkboxDiv);
							itemDiv.appendChild(labelP);

							// Append the item to the list
							optionsListDiv.appendChild(itemDiv);
						})

						// AO - Additional Options inside Product Modal
						let AOBtn = document.querySelector('.btn-additional-options')
						let AOModal = document.querySelector('.additional-options-modal')
						let AOClose = document.querySelector('.additional-options-modal .close')
						let AOModalItems = AOModal.querySelectorAll('.item')
						let AOSaveBtn = AOModal.querySelector('.btn-save-my-collection')
						let currentClasses = [];

						AOBtn.addEventListener('click', () => {
							AOModal.classList.add('active')
						})

						// Save all active classes of items in the helper variable in a case user clicks 'X' instead of 'Save my collection' btn
						for (i = 0; i < AOModalItems.length; i++) {
							currentClasses.push(AOModalItems[i].className)
						}

						console.log(currentClasses)

						for (let i = 0; i < AOModalItems.length; i++) {
							AOModalItems[i].addEventListener('click', () => {
								console.log(AOModalItems)
								AOModalItems[i].classList.toggle('active')
							})
						}

						AOClose.addEventListener('click', () => {
							for (let i = 0; i < AOModalItems.length; i++) {
								AOModalItems[i].className = currentClasses[i]
							}
							AOModal.classList.remove('active')
						})

						AOSaveBtn.addEventListener('click', () => {
							currentClasses = []
							// Save all active classes of items in the helper variable in a case user clicks 'X' instead of 'Save my collection' btn
							for (i = 0; i < AOModalItems.length; i++) {
								currentClasses.push(AOModalItems[i].className)
							}

							AOModal.classList.remove('active')
						})

						// close popup by clicking outside of the popup
						AOModal.addEventListener('click', () => {
							for (i = 0; i < AOModalItems.length; i++) {
								AOModalItems[i].className = currentClasses[i]
							}

							AOModal.classList.remove('active')
						})
						AOModal.querySelector('.wrapper').addEventListener('click', (ev) => {
							ev.stopPropagation();
						})

					} else {
						const additionalOptions = document.querySelector('.additional-options')
						additionalOptions.classList.remove('active')
					}

					if (productData.hasOwnProperty('product_variation')) {
						const priceOptionsForm = document.querySelector('form.price-options');
						// Clear existing content inside the form
						priceOptionsForm.innerHTML = '';
						priceOptionsForm.classList.add('active');
						for (let i = 0; i < productData.product_variation.ids.length; i++) {
							const optionDiv = document.createElement('div');
							optionDiv.classList.add('option');

							const input = document.createElement('input');
							input.type = 'radio';
							input.name = 'variable_price';
							input.value = productData.product_variation.ids[i];
							input.dataset.price = productData.product_variation.prices[i];
							// find the last item of the loop and make that input checked
							if (productData.product_variation.ids.length - i == 1) {
								input.setAttribute('checked', true);
							}

							const label = document.createElement('p');
							label.innerHTML = productData.product_variation.labels[i]; // Use innerHTML in case you need to parse HTML entities

							// Assemble the option
							optionDiv.appendChild(input);
							optionDiv.appendChild(label);

							// Append the option to the form
							priceOptionsForm.appendChild(optionDiv);
						}

						let productOptions = document.querySelectorAll('.products-catalog-modal .price-options .option input')
						let productVariablePrice = document.querySelector('.title .price')

						for (let i = 0; i < productOptions.length; i++) {
							productOptions[i].addEventListener('change', () => {
								if (productOptions[i].checked) {
									productVariablePrice.innerHTML = '₪' + productOptions[i].dataset.price;
								}
							})
						}
					} else {
						const priceOptionsForm = document.querySelector('form.price-options');
						priceOptionsForm.classList.remove('active');

					}

					if (productData.in_stock === false) {
						document.querySelector('.products-catalog-modal .out-of-stock-btn').classList.add('active')
						document.querySelector('.products-catalog-modal .btn-add-to-cart').classList.add('disabled')
						document.querySelector('.products-catalog-modal .btn-add-to-cart.disabled').addEventListener('click', (e) => {
							e.preventDefault();
						})
					} else {
						document.querySelector('.products-catalog-modal .out-of-stock-btn').classList.remove('active')
						document.querySelector('.products-catalog-modal .btn-add-to-cart').classList.remove('disabled')
					}
				},
				error: function () {
					console.log('Error adding product to cart');
				}
			});
		})
	}

	if (imageModal) {
		for (let i = 0; i < productCardsImages.length; i++) {
			productCardsImages[i].addEventListener('click', () => {
				imageModal.classList.add('active')
				imageModal.querySelector('img').src = productCardsImages[i].querySelector('.product-image').src;
			})
		}

		closeImageModal.addEventListener('click', () => {
			imageModal.classList.remove('active')
		})
	}

	if (imageModalContent) {
		for (let i = 0; i < imageContent.length; i++) {
			imageContent[i].addEventListener('click', () => {
				imageModalContent.classList.add('active')
				imageModalContent.querySelector('img').src = imageContent[i].querySelector('img').src;
			})
		}

		closeImageModalContent.addEventListener('click', () => {
			imageModalContent.classList.remove('active')
		})
	}

	let productQuantity = document.querySelector('.product-quantity .custom-input-number')
	productQuantity.addEventListener('change', () => {
	    let productVariablePrice = document.querySelector('.title .price')
	    let oldPrice = productVariablePrice.innerHTML
	    productVariablePrice.innerHTML = '₪' + productQuantity.value * oldPrice
	})

});

// Get all sections and anchors
var sections = document.querySelectorAll('.product-catalog-category-wrapper');
var anchors = document.querySelectorAll('.product-category a');

// Listen to the scroll event
window.addEventListener('scroll', function() {
	// Loop through each section
	for (var i = 0; i < sections.length; i++) {
		// Check if the section is in the viewport
		if (sections[i].offsetTop <= window.pageYOffset && sections[i].offsetTop + sections[i].offsetHeight > window.pageYOffset) {
			// Remove the active class from all anchor parents
			anchors.forEach(function(anchor) {
				anchor.parentElement.classList.remove('active');
			});

			// Add the active class to the parent of the corresponding anchor
			anchors[i].parentElement.classList.add('active');
		}
	}
});

// Add a click event listener to each anchor
anchors.forEach(function(anchor, index) {
	anchor.addEventListener('click', function(event) {
		// Prevent the default action
		event.preventDefault();

		// Remove the active class from all anchor parents
		anchors.forEach(function(anchor) {
			anchor.parentElement.classList.remove('active');
		});

		// Add the active class to the parent of the clicked anchor
		anchor.parentElement.classList.add('active');

		// Scroll to the corresponding section
		sections[index].scrollIntoView({ behavior: 'smooth' });
	});
});
