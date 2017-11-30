require('./common');
// require('../../../public/libs/product-tour/product-tour.min');
// require('./product.tour');
window.moment = require('moment');
require('jcf/dist/js/jcf');
require('jcf/dist/js/jcf.select');
window.Instafeed = require('instafeed.js');
require('chosen-js');
require('../../../public/libs/jquery-ui/datepicker/jquery-ui');
require('magnific-popup');

$(document).ready(function(){


    if($("#image-tour").length){
        $("#image-tour").magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300,
                opener: function(element) {
                    return element.find('img');
                }
            }
        });
    }

    jcf.setOptions('Select', {
        wrapNative: false,
        wrapNativeOnMobile: false,
        maxVisibleItems: 5
    });
    jcf.replace('select:not(#activity-search)');

    $('[data-datepicker]').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    $('#reserve-date').datepicker('option', 'onSelect', function (dt) {
        $.ajax({
            type: 'POST',
            url: '/offer/date/set',
            data: {
                date: dt,
                '_token': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

  if($('#activity-search').length){
    let yourSelect = $("#activity-search"),
      notFoundText = yourSelect.attr("data-noresulttext");
    yourSelect.chosen({
      disable_search_threshold: 10,
      no_results_text: notFoundText
    });
  }


    function numberWithDots(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $("#get-offers-persons").on('change', function(){
       let currencySign = $(this).attr('data-currencySign'),
           value = $(this).val();
       $('.offer-item').each(function(){
           let priceElem = $(this).find('.price'),
               unit_price = 0 + priceElem.data('unit-price');
           priceElem.html('<sub>'+currencySign+'</sub>' + numberWithDots(Math.round(value * unit_price)));
       })
    });

    function getsuprogram(){
        $.ajax({
            type: "GET",
            url: "/activities/getsuprogram",
            data: "",
            success: response => {
                // $("#program_activities").text(response.data.offers).attr('data-activities' ,response.data.offers);
                $("#program_subscriptions").text(response.data.special_offers).attr('data-subscriptions', response.data.special_offers);
                $("#program_persons").text(response.data.persons);
                $("#program_total").text(response.data.total);
                $("#header-cart").text(response.data.offers + response.data.special_offers);
            },
            error: function(){
                location.reload();
            },
          complete: () => {
            $(".loader").remove();
          }
        })
    }

    $("#get-offers-button").click(function(){
        let activityId = $(this).data('activity-id'),
            date = $("#reserve-date").val(),
            persons = $("#get-offers-persons").val();
        if (persons === '') {
            $('#message-modal #message').text('Seleccione primero la cantidad de personas de esta actividad.');
            $('#message-modal').modal('show');
            return false;
        }
        $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
        $.ajax({
            type: "POST",
            url: "/offer/special/add",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                activity_id: activityId,
                persons: persons,
                date: date
            },
            error: function(err){
                console.error(err);
                $('#message-modal #message').text('Sorry. There is some problem with transferring data to the server. Please try again after reload');
                $('#message-modal').modal('show');
                setTimeout(function(){
                    location.reload();
                },2000);
            },
          complete: () => {
            getsuprogram();
            $('html, body').animate({scrollTop: '0px'}, 800);
          }
        })
    });

    jQuery('.activity-basket__confirms-list').on("click", "button", function(){
        $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
        let oid = $(this).parent().prevAll().length,
            pickedel = $(this).parent();
        $.ajax({
            type: 'POST',
            url: "/offer/remove",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                oid: oid
            },
            success: function(){
                pickedel.remove();
            },
            error: function(){
                location.reload();
            },
          complete: () => {
            getsuprogram();
          }
        });
    });

    jQuery('.raised-form').submit(function(e) {
        e.preventDefault();
        window.location.href="/activities/" + jQuery('#activity_id_r').val() + "?dt=" + jQuery('#activity_date_r').val();
        return false;
    });

    $('.select-activity__add-button').click(function(){
        let dt = $("#reserve-date").val();
        if (dt === '') {
            $('#message-modal #message').text('Seleccione primero la fecha.');
            $('#message-modal').modal('show');
            return false;
        }
        let offer_id = jQuery(this).data('offer-id');
        let persona = $("#get-offers-persons").val();
        if (persona === '') {
            $('#message-modal #message').text('Seleccione primero la cantidad de personas de esta actividad.');
            $('#message-modal').modal('show');
            return false;
        }
        let hours = $(this).parents('.offer-item').find('select.hours').val();
        if (hours === '') {
            $('#message-modal #message').text('Seleccione primero la cantidad de horario de esta actividad.');
            $('#message-modal').modal('show');
            return false;
        }
        $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
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
            error: function(){
                location.reload();
            },
          complete: () => {
            $.ajax({
              type: "GET",
              url: "/activities/getselectedoffers",
              data: "",
              success: function(data){
                let lastel = data.data[data.data.length - 1];
                let formattedDate = moment(lastel.date, "DD/MM/YYYY").format('DD/MM');
                $(".activity-basket__confirms-list").append(`
                  <li>
                    <button data-offer-id="${offer_id}"></button>
                    ${formattedDate} ${lastel.name}
                  </li>
                `);
                $('html, body').animate({scrollTop: '0px'}, 800);
              },
              error: function(){
                location.reload();
              },
              complete: () => {
                getsuprogram();
              }
            })
          }
        });
        return false;
    });


    //Activity comments script

    $(".comments-block__answer-button").click(function(e){
        e.preventDefault();
        $("#comments-block__form").find("input[name=comment_id]").val($(this).attr('href'));
        let answerText = $("#comments-block__form").attr("data-answerText");
        $("#comments-block__form").find(".comments-block__send-button").text(answerText);

    });



  if($("#instafeed5").length) {
        let activityTag = $("#instafeed5").attr("data-tag");
        let feed5 = new Instafeed({
            get: 'tagged',
            tagName: activityTag,
            target: 'instafeed5',
            accessToken: '3190829681.e029fea.c40a8be5bdb04454892d3d8fb4c1908b',
            template: '<div class="col-xs-2 in-image-activity"><a href="{{link}}"><img src="{{image}}"/></a></div>',
            limit: 16,
            after: function () {
                $('#instafeed5 a').click(function (e) {
                    e.preventDefault();
                    let urlOfThis = $(this)[0].href;
                    if ($("#the-image img")) {
                        $("#the-image img").remove();
                    }
                    $.each($("#data span"), function (i, v) {
                        if ($(this).attr('data-link') == urlOfThis) {
                            $("#the-image").append("<img src=\"" + $(this).attr('data-url') + "\"/>");
                        }
                    });
                    $("#myModalX").modal('show');
                });
            },
            success: function (data) {
                $.each(data.data, function (i, v) {
                    let url = v.images.standard_resolution.url;
                    $("#data").append("<span data-link=\"" + v.link + "\" data-url=\"" + url + "\"></span>");
                });
            }
        });
        feed5.run();
    }


});