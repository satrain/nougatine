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
})