require('./common');
// require('../../../public/libs/product-tour/product-tour.min');
// require('./product.tour');
require('jcf/dist/js/jcf');
require('jcf/dist/js/jcf.select');
require('owl.carousel');
require('../../../public/libs/jquery-ui/datepicker/jquery-ui');
require('../../../public/libs/image-map-resizer/rwdImageMaps.js');
require('jquery-lazyload');
window.toastr = require('toastr');

const set_toastr_options = function(){
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-center",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "4000",
        "extendedTimeOut": "0",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
};

$(document).ready(function(){

    set_toastr_options();
    $(".lazyload").lazyload();

    jcf.setOptions('Select', {
        wrapNative: false,
        wrapNativeOnMobile: false,
        maxVisibleItems: 5
    });
    jcf.replace('select');

    $('.s-banner__slider').owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        items:1,
        margin:0,
        stagePadding:0,
        smartSpeed:450,
        autoplay: true,
        loop: true,
        touchDrag: false,
        mouseDrag: false,
    });

    $('[data-datepicker]').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    $('.vectorial-img[usemap]').rwdImageMaps();

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
          "owl-arrow owl-arrow_previous",
          "owl-arrow owl-arrow_next"
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
                items: 5
            }
        }
    });
    $('#most-visited-activities-slider, some-activities-slider').removeClass('csHidden');

    $(document).on('submit','.contact-form',function(ev){
        ev.preventDefault();
        const formData = $('.contact-form').serialize();
        $.ajax({
            type: 'POST',
            url: `/contact-us`,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'formData': formData,
            },
            success: function(res){
                let response = JSON.parse(res);
                if(response.success){
                    toastr.success(langMessageSent);
                }
                if(response.errorMessages){
                    $.each(response.errorMessages, function (i, value) {
                        toastr.error(value, '');
                    });
                }
            }
        });

    });

});