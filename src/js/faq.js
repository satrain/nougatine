jQuery(document).ready(function($) {
    $('#faqSearch').on('input', function() {
        var searchTerm = $(this).val();

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'post',
            data: {
                action: 'search_faqs',
                search_term: searchTerm
            },
            success: function(response) {
                $('.faqs-wrapper').html(response);
                
                const faqItems = document.querySelectorAll('.faq');

                faqItems.forEach(function (faqItem) {
                    const title = faqItem.querySelector('.title');
                    const content = faqItem.querySelector('.content');

                    title.addEventListener('click', function () {
                        faqItem.classList.toggle('open');
                        content.classList.toggle('active');
                    });
                });
            }
        });
    });
});