document.addEventListener('DOMContentLoaded', (event) => {

    // Init AOS
    AOS.init({once: true});

    let scrollRef = 0;

    window.addEventListener('scroll', function() {
        // increase value up to 10, then refresh AOS
        scrollRef <= 10 ? scrollRef++ : AOS.refresh();
    });

    //Mobile - show navigation on burger click and slider
    if (window.matchMedia("(max-width: 1024px)").matches) {
        let burger = document.querySelector(".burger")
        let navMobile = document.querySelector(".nav-mobile-modal")
        burger.onclick = function () {
            navMobile.classList.toggle("nav-mobile-active");
            burger.classList.toggle("open");
            document.querySelector('body').classList.toggle("overflow-hidden");
            if(navMobile.classList.contains("nav-mobile-active")) {
                document.querySelector('html').style.overflow = "hidden"
            }
            else {
                document.querySelector('html').style.overflow = "auto"
            }
        }
    }

    let playBtn = document.querySelector('.video-wrapper')
    let aboutModal = document.querySelector('.hp-about-us-video-modal')
    let closePopup = document.querySelector('.close')

    if(aboutModal) {
        playBtn.addEventListener('click', () => {
            console.log('clicked')
            aboutModal.classList.add('active')
            document.querySelector('html').style.overflow = "hidden"
        })

        closePopup.addEventListener('click', (event) => {
            event.stopPropagation();
            aboutModal.classList.remove('active')
            document.querySelector('html').style.overflow = "auto"
        })

        // Close popup when clicking outside of the video
        document.addEventListener('click', (event) => {
        if (event.target.classList.contains('modal-close-area')) {
            aboutModal.classList.remove('active');
            document.querySelector('html').style.overflow = "auto"
        }
        });
    }

    let searchBtn = document.querySelector('.search-btn')
    let searchInput = document.querySelector('.search input')

    searchBtn.addEventListener('click', () => {
        searchInput.classList.toggle('active')
    })

    const faqItems = document.querySelectorAll('.faq');

    faqItems.forEach(function (faqItem) {
        const title = faqItem.querySelector('.title');
        const content = faqItem.querySelector('.content');

        title.addEventListener('click', function () {
            faqItem.classList.toggle('open');
            content.classList.toggle('active');
        });
    });

    var options = document.querySelectorAll('.option input[type="radio"]');
            
    function updateSelectedClass() {
        options.forEach(function (option) {
            var optionDiv = option.parentNode;
            
            if (option.checked) {
                optionDiv.classList.add('selected');
            } else {
                optionDiv.classList.remove('selected');
            }
        });
    }
    
    options.forEach(function (option) {
        option.addEventListener('change', updateSelectedClass);
    });
    
    // Initial update
    updateSelectedClass();

    let galleryModal = document.querySelector('.gallery-image-modal')
    let galleryImage = document.querySelectorAll('.gallery-slider-wrapper .item img')

    if(galleryModal) {
        for(let i = 0; i < galleryImage.length; i++) {
            galleryImage[i].addEventListener('click', () => {
                galleryModal.classList.add("active");
                galleryModal.querySelector('img').src = galleryImage[i].src;
                document.querySelector('html').style.overflow = "hidden"
            })
        }

        closePopup.addEventListener('click', (event) => {
            event.stopPropagation();
            galleryModal.classList.remove('active')
            document.querySelector('html').style.overflow = "auto"
        })

        // Close popup when clicking outside of the video
        document.addEventListener('click', (event) => {
        if (event.target.classList.contains('modal-close-area')) {
            galleryModal.classList.remove('active');
            document.querySelector('html').style.overflow = "auto"
        }
        });
    }


    var scrollToTopBtn = document.querySelector('#scrollToTopBtn');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 500) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    });

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    scrollToTopBtn.addEventListener('click', () => {
        scrollToTop()
    })

    let cards = document.querySelectorAll('.card')
    let productModal = document.querySelector('.product-modal')
    let closeProductModal = document.querySelector('.product-modal .close')
    if(productModal) {
        closeProductModal.addEventListener('click', () => {
            productModal.classList.remove('active');
        })

        for(let i = 0; i < cards.length; i++) {
            cards[i].addEventListener('click', () => {
                productModal.classList.add('active')
            })
            if(cards[i].querySelector('.nougatine-add-to-cart')) {
                cards[i].querySelector('.nougatine-add-to-cart').addEventListener('click', (ev) => {
                    ev.stopPropagation();
                })
            }
        }

        // close popup by clicking outside of the popup
        productModal.addEventListener('click', () => {
            productModal.classList.remove('active')
        })
        productModal.querySelector('.modal-wrapper').addEventListener('click', (ev) => {
            ev.stopPropagation();
        })
    }

    // sidecart animation
    let sideCart = document.querySelector('.nougatine-sidecart')
    let sideCartContent = document.querySelector('.sidecart-content')
    let shoppingCarts = document.querySelectorAll('.shopping-cart')
    let closeSideCart = document.querySelector('.close-sidecart')

    shoppingCarts.forEach(cart => {
        cart.addEventListener('click', () => {
            sideCart.classList.add('active')
        })
    })

    closeSideCart.addEventListener('click', () => {
        sideCart.classList.remove('active')
    })

    sideCart.addEventListener('click', () => {
        sideCart.classList.remove('active')
    })

    sideCartContent.addEventListener('click', (ev) => {
        ev.stopPropagation();
    })

})

jQuery(document).ready(function($) {

    let decrementBtn = document.querySelectorAll('.decrement-quantity');
    let incrementBtn = document.querySelectorAll('.increment-quantity');
    let inputField = document.querySelectorAll('.custom-input-number');
    let subtotal = document.querySelector('.cart-subtotal td');
    
    for(let i = 0; i < decrementBtn.length; i++) {
        decrementBtn[i].addEventListener('click', () => {
            if(inputField[i].value > 1) {
                inputField[i].stepDown();
                updateCart(inputField[i]);
            }
        });
    }
    
    for(let i = 0; i < incrementBtn.length; i++) {
        incrementBtn[i].addEventListener('click', () => {
            inputField[i].stepUp();
            updateCart(inputField[i]);
        });
    }
    
    function updateCart(inputField) {
        let cart_item_key = inputField.getAttribute('data-cart-item-key');
        let quantity = inputField.value;

    
        jQuery.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'update_cart_item_quantity',
                cart_item_key: cart_item_key,
                quantity: quantity
            },
            success: function(response) {
                // Update subtotal
                subtotal.innerHTML = response.data.subtotal;

                // Optionally update other parts of the cart
                // e.g., mini cart in header
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

});