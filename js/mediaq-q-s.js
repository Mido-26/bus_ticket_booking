$(document).ready(function () {
    function applyTabletClasses() {
        if (window.matchMedia("(min-width: 780px) and (max-width: 1024px)").matches) {
            $('section form').removeClass('flex-column');
            $('.bus-info').removeClass('flex-column');
            $('.sector.bzz').removeClass('buss-row').addClass('bus-row');
            $('.bus-header').removeClass('colorr');
            $('.bus-info div').removeClass('justify-content-start align-items-center');
            // $('.modal-body').removeClass('flex-column');
            $('.seatinfo').removeClass('flex-column');
            $('.fff').addClass('justify-content-center').removeClass('justify-content-start mt-5');
        } else if (window.matchMedia("(max-width: 780px)").matches) {
            $('section form').addClass('flex-column');
            $('.bus-info').addClass('flex-column');
            $('.bzz').removeClass('bus-row').addClass('buss-row');
            $('.bus-header').addClass('colorr');
            $('.bus-header h5').removeClass('color-p');
            $('.bus-info div').addClass('justify-content-between align-items-start');
            $('.modal-body').addClass('flex-column');
            $('#Loginform').css({width:'320px'});
            $('.seatinfo').addClass('flex-column');
            $('.fff').removeClass('justify-content-center').addClass('justify-content-start mt-5');
        }
    }

    // Initial check
    applyTabletClasses();

    // Handle window resize
    $(window).on('resize', function () {
        applyTabletClasses();
    });
});
