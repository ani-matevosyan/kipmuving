require('./common');
require('jcf/dist/js/jcf');
require('jcf/dist/js/jcf.select');
window.Instafeed = require('../../../public/libs/instafeed/instafeed.min');
require('./instafeed-settings');
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

    function getsuprogram(){
        $.ajax({
            type: "GET",
            url: "/activities/getsuprogram",
            data: "",
            success: function(data){
                $("#program_activities").text(data.data.offers);
                $("#program_activities").attr('data-activities' ,data.data.offers);
                $("#program_persons").text(data.data.persons);
                $("#program_total").text(data.data.total);
            },
            error: function(){
                location.reload();
            }
        });
    }

    function numberWithDots(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    jQuery('.persona').on("change", function(){
        var priceElem = $(this).parents('.offer-item').find('.price');
        var currency = $(this).parents('.offer-item').find('.price sub').html();
        var unit_price = 0 + priceElem.data('unit-price');

        priceElem.html('<sub>'+currency+'</sub>' + numberWithDots(Math.round($(this).val() * unit_price)));
    });

    jQuery('.btn-reserve-ag').click(function(){
        var dt = jQuery(this).parents('.offer-item').find('.reserve-date').val();
        if (dt == '') {
            $('#message-modal #message').text('Please choose the date first.');
            $('#message-modal').modal('show');
            return false;
        }
        var offer_id = jQuery(this).data('offer-id');
        var persona = $(this).parents('.offer-item').find('.persona').val();
        if (persona == '') {
            $('#message-modal #message').text('Choose persona first.');
            $('#message-modal').modal('show');
            return false;
        }
        var hours = $(this).parents('.offer-item').find('select.hours').val();
        if (hours == '') {
            $('#message-modal #message').text('Choose time.');
            $('#message-modal').modal('show');
            return false;
        }
        $.ajax({
            type: "POST",
            url: "/offer/reserve",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                offer_id: offer_id,
                persons: persona,
                date: dt,
                timeRange: hours
            },
            success: function(){
                getsuprogram();
            },
            error: function(){
                location.reload();
            }
        });
        return false;
    });
});