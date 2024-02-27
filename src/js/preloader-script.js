jQuery(document).ready(function($) {

    // Hide the preloader when the page is fully loaded
    $(window).on('load', function() {
        $('#preloader').fadeOut('slow', function() {
            // Animation complete. Add any additional actions here if needed.
        });
    });
    
}); 