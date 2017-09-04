require('./common');
require('../../../public/libs/product-tour/product-tour.min');
require('jcf/dist/js/jcf');
require('jcf/dist/js/jcf.select');
require('owl.carousel/dist/assets/owl.carousel.css');
require('owl.carousel');
require('./product.tour');
require('../../../public/libs/jquery-ui/datepicker/jquery-ui');

$(document).ready(function(){

    jcf.setOptions('Select', {
        wrapNative: false,
        wrapNativeOnMobile: false,
        maxVisibleItems: 5
    });
    jcf.replace('select');

    $('[data-datepicker]').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    $("#most-visited-activities-slider, #some-activities-slider").owlCarousel({
        items: 1,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        loop: false,
        margin: 22,
        nav: true,
        navElement: "div",
        rewind: true,
        navClass: [
            "activities-slider__arrow activities-slider__arrow_previous",
            "activities-slider__arrow activities-slider__arrow_next"
        ],
        navText: [],
        responsive: {
            400: {
                items: 2
            },
            580: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    });
    $('#most-visited-activities-slider, some-activities-slider').removeClass('csHidden');

});