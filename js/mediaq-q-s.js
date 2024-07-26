$(document).ready(function () {
    function applyTabletClasses() {
        if (window.matchMedia("(min-width: 780px) and (max-width: 1024px)").matches) {
            $('section form').removeClass('flex-column');
            $('.bus-info').removeClass('flex-column');
            $('.sector.bzz').removeClass('buss-row').addClass('bus-row');
            $('.bus-header').removeClass('colorr');
            $('.bus-info div').removeClass('justify-content-start align-items-start');
            $('.modal-body').removeClass('flex-column');
        } else if (window.matchMedia("(max-width: 780px)").matches) {
            $('section form').addClass('flex-column');
            $('.bus-info').addClass('flex-column');
            $('.sector.bzz').removeClass('bus-row').addClass('buss-row');
            $('.bus-header').addClass('colorr');
            $('.bus-header h5').removeClass('color-p');
            $('.bus-info div').addClass('justify-content-between align-items-start');
            $('.modal-body').addClass('flex-column');
        }
    }

    // Initial check
    applyTabletClasses();

    // Handle window resize
    $(window).on('resize', function () {
        applyTabletClasses();
    });
});
