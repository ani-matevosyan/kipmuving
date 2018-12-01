require('./common');
require('jcf/dist/js/jcf');
require('jcf/dist/js/jcf.select');
window.Instafeed = require('instafeed.js');
require('./instafeed-settings');
require('../../../public/libs/jquery-ui/datepicker/jquery-ui');
require('jquery-lazyload');

$(document).ready(function(){

  $(".lazyload").lazyload();

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
                console.log(data);
                $("#program_activities").text(data.data.offers);
                $("#program_activities").attr('data-activities' ,data.data.offers);
                $("#program_persons").text(data.data.persons);
                $("#program_total").text(data.data.total);
                $("#header-cart").text(data.data.offers + data.data.special_offers);
            },
            error: function(){
                location.reload();
            },
          complete: () => {
            $(".loader").remove();
          }
        });
    }

    function numberWithDots(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('.persona').on("change", function(){
        let _this = $(this);
        let offer_id = $(this).data('offer-id');
        let persona = $(this).val();
        let dt = $(this).parents('.offer-item').find('.reserve-date').val();

        $.ajax({
            type: "POST",
            url: "/offer/getPriceByDateAndPersons",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                offer_id: offer_id,
                persons: persona,
                date: dt,
            },
            success: function(response){
                response = JSON.parse(response);
                let currency = _this.parents('.offer-item').find('.price sub').html();
                let priceElem = _this.parents('.offer-item').find('.price');
                priceElem.html('<sub>' + currency + '</sub>' + numberWithDots(Math.round(response.priceWithPersons)));

                let oldPriceElem = _this.parents('.offer-item').find('.old_price');
                if(response.oldPrice){
                    oldPriceElem.html(currency + ' ' + numberWithDots(Math.round(response.oldPriceWithPersons)));
                }else{
                    oldPriceElem.html('');
                }
            },
            error: function(){
                // location.reload();
            }
        });
    });


    let theDatePicker = $(".reserve-date");
    theDatePicker.datepicker('option', 'onSelect', function (dt) {
        let _this = $(this);
        let offer_id = $(this).data('offer-id');
        let persona = $(this).parents('.offer-item').find('.persona').val();

        $.ajax({
            type: "POST",
            url: "/offer/getPriceByDateAndPersons",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                offer_id: offer_id,
                persons: persona,
                date: dt,
            },
            success: function(response){
                response = JSON.parse(response);
                let currency = _this.parents('.offer-item').find('.price sub').html();
                let priceElem = _this.parents('.offer-item').find('.price');
                priceElem.html('<sub>' + currency + '</sub>' + numberWithDots(Math.round(response.priceWithPersons)));

                let oldPriceElem = _this.parents('.offer-item').find('.old_price');
                if(response.oldPrice){
                    oldPriceElem.html(currency + ' ' + numberWithDots(Math.round(response.oldPriceWithPersons)));
                }else{
                     oldPriceElem.html('');
                }
            },
            error: function(){
            }
        });
    });

    jQuery('.btn-reserve-ag').click(function(){
        $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
        let dt = jQuery(this).parents('.offer-item').find('.reserve-date').val();
        if (dt == '') {
            $('#message-modal #message').text('Please choose the date first.');
            $('#message-modal').modal('show');
            return false;
        }
        let offer_id = jQuery(this).data('offer-id');
        let persona = $(this).parents('.offer-item').find('.persona').val();
        if (persona == '') {
            $('#message-modal #message').text('Choose persona first.');
            $('#message-modal').modal('show');
            return false;
        }
        let hours = $(this).parents('.offer-item').find('select.hours').val();
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