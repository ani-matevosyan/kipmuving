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
require('jquery-lazyload/jquery.lazyload');

$(document).ready(function () {

  $(".lazyload").lazyload();


  if ($("#image-tour").length) {
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
        opener: function (element) {
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

  let theDatePicker = $("#reserve-date");
  let getOffersButton = $("#get-offers-button");
  theDatePicker.datepicker('option', 'onSelect', function (dt) {
    $.ajax({
      type: 'POST',
      url: '/offer/date/set',
      data: {
        date: dt,
        activityId: activityId,
        '_token': $('meta[name="csrf-token"]').attr('content'),
      },
      success: (response) => {
          const result = JSON.parse(response);
          const offers = result.offers;
          let currencySign = $("#get-offers-persons").attr('data-currencySign');

          $('.offer-item').each(function () {
            let _this = $(this);
             offers.forEach(function(el) {
                 if(el.id == _this.data('offer-id')){
                     let priceElem = _this.find('.price');
                     priceElem.html('<sub>' + currencySign + '</sub>' + numberWithDots(Math.round(el.price)));

                     let oldPriceElem = _this.find('.old_price');
                     if(el.old_price){
                          oldPriceElem.html( currencySign + '  ' + numberWithDots(Math.round(el.old_price)));
                      }else{
                        oldPriceElem.html('');
                      }
                 }
             });
          });
      },
    });

    let currentMonth = theDatePicker.datepicker("getDate").getMonth()+1;
    if(currentMonth > 11 || currentMonth < 3){
      if(!getOffersButton.prop("disabled")){
        getOffersButton.addClass("get-offers__button_disabled").prop("disabled", true);
      }
    }else{
      if(getOffersButton.prop("disabled")){
        getOffersButton.removeClass("get-offers__button_disabled").prop("disabled", false);
      }
    }
  });

  if ($('#activity-search').length) {
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

  $("#get-offers-persons").on('change', function () {
      let currencySign = $(this).attr('data-currencySign'),
      value = $(this).val();
      $('.offer-item').each(function () {
        let priceElem = $(this).find('.price'),
          unit_price = 0 + priceElem.data('unit-price');
        priceElem.html('<sub>' + currencySign + '</sub>' + numberWithDots(Math.round(value * unit_price)));

        let oldPriceElem = $(this).find('.old_price'),
            old_unit_price = 0 + oldPriceElem.data('unit-price');
        oldPriceElem.html( currencySign + ' ' + numberWithDots(Math.round(value * old_unit_price)));
      })
  });

  function getsuprogram() {
    $.ajax({
      type: "GET",
      url: "/activities/getsuprogram",
      data: "",
      success: response => {
        $("#program_subscriptions").text((response.data.special_offers > 0) ? response.data.special_offers : window.translateData.still_no_offers);
        $("#program_persons").text(response.data.persons);
        $("#program_total").text(numberWithDots(response.data.total));
        $("#header-cart").text(response.data.offers + response.data.special_offers);
      },
      error: function () {
        location.reload();
      },
      complete: () => {
        $(".loader").remove();
      }
    })
  }

  getOffersButton.click(function () {
    let activityId = $(this).data('activity-id'),
      date = theDatePicker.val(),
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
      error: function (err) {
        console.error(err);
        $('#message-modal #message').text('Sorry. There is some problem with transferring data to the server. Please try again after reload');
        $('#message-modal').modal('show');
        setTimeout(function () {
          location.reload();
        }, 2000);
      },
      complete: () => {
        getsuprogram();
        $('html, body').animate({scrollTop: '0px'}, 800);
      }
    })
  });

  jQuery('.activity-basket__confirms-list').on("click", "button", function () {
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
      success: function () {
        pickedel.remove();
      },
      error: function () {
        location.reload();
      },
      complete: () => {
        getsuprogram();
      }
    });
  });

  jQuery('.raised-form').submit(function (e) {
    e.preventDefault();
    window.location.href = "/activities/" + jQuery('#activity_id_r').val() + "?dt=" + jQuery('#activity_date_r').val();
    return false;
  });

  $('.select-activity__add-button').click(function () {
    let dt = theDatePicker.val();
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
      error: function () {
        location.reload();
      },
      complete: () => {
        $.ajax({
          type: "GET",
          url: "/activities/getselectedoffers",
          data: "",
          success: function (data) {
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
          error: function () {
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

  $(".comments-block__answer-button").click(function (e) {
    e.preventDefault();
    $("#comments-block__form").find("input[name=comment_id]").val($(this).attr('href'));
    let answerText = $("#comments-block__form").attr("data-answerText");
    $("#comments-block__form").find(".comments-block__send-button").text(answerText);

  });


  if ($("#instafeed5").length) {
    let activityTag = $("#instafeed5").attr("data-tag");
    let feed5 = new Instafeed({
      get: 'tagged',
      tagName: activityTag,
      target: 'instafeed5',
      accessToken: '3468302324.ba4c844.14cdb6234cde4beb825b5b67ad86bfd3',
      template: '<div class="col-xs-2 in-image-activity"><a href="{{link}}"><img src="{{image}}"/></a></div>',
      limit: 12,
      after: function () {
        $('#instafeed5 a').click(function (e) {
          e.preventDefault();
          let urlOfThis = $(this)[0].href;
          if ($("#the-image img")) {
            $("#the-image").html('');
          }
          $.each($("#data span"), function (i, v) {
            if ($(this).attr('data-link') == urlOfThis) {
              $("#the-image").append("<img src=\"" + $(this).attr('data-url') + "\"/>");
              if($(this).attr('data-location') !== 'undefined'){
                $("#the-image").append("<p style='margin:10px 0 0 30px; font-size: 12px;'>"+$(this).attr('data-location')+"</p>");
              }
            }
          });
          $("#myModalX").modal('show');
        });
      },
      success: function (data) {
        $.each(data.data, function (i, v) {
          let locationName;
          if(v.location){
            locationName = v.location.name;
          }
          $("#data").append("<span data-link=\"" + v.link + "\" data-url=\"" + v.url + "\" data-location=\"" + locationName + "\"></span>");
        });
      }
    });
    feed5.run();
  }

    $(".in-image-activity a img").on('click', function (ev) {
        ev.preventDefault();
        $("#the-image").html("<img src=\"" + $(this).attr('data-original') + "\"/>");
        $("#myModalX").modal('show');
    });


});