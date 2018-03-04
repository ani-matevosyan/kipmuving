require('./common');
require('owl.carousel');
require('jquery-lazyload');
require('jcf/dist/js/jcf');
require('jcf/dist/js/jcf.select');
require('../../../public/libs/jquery-ui/datepicker/jquery-ui');
window.Instafeed = require('instafeed.js');

$(document).ready(function () {

  let accessToken = '3190829681.e029fea.c40a8be5bdb04454892d3d8fb4c1908b';

  if ($(".days-list__instagram-block").length) {
    $(".days-list__instagram-block").each(function () {

      let blockId = $(this).attr('id'),
        locationId = $(this).attr('data-location-id');

      let feed = new Instafeed({
        get: 'location',
        locationId: locationId,
        target: blockId,
        accessToken: accessToken,
        template: '<div class="days-list__instagram-item"><a href="{{link}}"><img src="{{image}}"/></a></div>',
        after: function () {
          $(`#${blockId} a`).click(function (e) {
            e.preventDefault();
            let urlOfThis = $(this)[0].href;
            if ($("#the-image img")) {
              $("#the-image").html('');
            }
            $.each($("#data span"), function (i, v) {
              if ($(this).attr('data-link') == urlOfThis) {
                $("#the-image").append("<img src=\"" + $(this).attr('data-url') + "\"/>");
                if ($(this).attr('data-location') !== 'undefined') {
                  $("#the-image").append("<p style='margin:10px 0 0 30px; font-size: 12px;'>" + $(this).attr('data-location') + "</p>");
                }
              }
            });
            $("#myModalX").modal('show');
          });
        },
        success: function (data) {
          $(`#${blockId}`).removeClass('days-list__instagram-block_loading');
          if (data.data.length > 6) data.data.splice(5, (data.data.length - 6));
          $.each(data.data, function (i, v) {
            let url = v.images.standard_resolution.url;
            $("#data").append("<span data-link=\"" + v.link + "\" data-url=\"" + url + "\" data-location=\"" + v.location.name + "\"></span>");
          });
        }
      });
      feed.run();
    });
  }


  if ($("#routes-activity-instagram").length) {

    let thisTagName = $("#routes-activity-instagram").attr('data-tag');

    let feed = new Instafeed({
      get: 'tagged',
      tagName: thisTagName,
      target: 'routes-activity-instagram',
      accessToken: accessToken,
      template: '<div class="routes-activity__instagram-item"><a href="{{link}}"><img src="{{image}}"/></a></div>',
      limit: 10,
      after: function () {
        $('#routes-activity-instagram a').click(function (e) {
          e.preventDefault();
          let urlOfThis = $(this)[0].href;
          if ($("#the-image img")) {
            $("#the-image").html('');
          }
          $.each($("#data span"), function (i, v) {
            if ($(this).attr('data-link') == urlOfThis) {
              $("#the-image").append("<img src=\"" + $(this).attr('data-url') + "\"/>");
              if ($(this).attr('data-location') !== 'undefined') {
                $("#the-image").append("<p style='margin:10px 0 0 30px; font-size: 12px;'>" + $(this).attr('data-location') + "</p>");
              }
            }
          });
          $("#myModalX").modal('show');
        });
      },
      success: function (data) {
        $('#routes-activity-instagram').removeClass('routes-activity__instagram_loading');
        $.each(data.data, function (i, v) {
          let url = v.images.standard_resolution.url;
          let locationName;
          if (v.location) {
            locationName = v.location.name;
          }
          $("#data").append("<span data-link=\"" + v.link + "\" data-url=\"" + url + "\" data-location=\"" + locationName + "\"></span>");
        });
      }
    });
    feed.run();
  }

  jcf.setOptions('Select', {
    wrapNative: false,
    wrapNativeOnMobile: false,
    maxVisibleItems: 5
  });
  jcf.replace('select');

  $('[data-datepicker]').datepicker({
    dateFormat: 'dd/mm/yy'
  });

  $(".lazyload").lazyload();

  $(".s-own-plans__slider").owlCarousel({
    items: 1,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    loop: false,
    margin: 14,
    nav: true,
    lazyLoad: true,
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
        items: 4
      }
    }
  });
  $('.s-own-plans__slider').removeClass('csHidden');

  let modal = $("#filters-modal");
  $("#open-filters").click(function () {
    modal.show(0, function () {
      modal.addClass('opened');
    });
    $('body').css('overflow-y', 'hidden');
  });

  $("#confirm-filters, #cancel-filters").click(function () {

    modal.removeClass('opened');
    modal.one('transitionend', function () {
      modal.hide();
    });
    $('body').css('overflow-y', '');

  });

  $(".filters input[type=checkbox]").on('change', function () {

    $(".suggested-plans > ul").html("<div class='filter-loader'><div class='filter-loader__inside'></div></div>");

    let filterData = {
      weather: [],
      time: [],
      intensity: [],
      categories: []
    }

    $(".filters input[type=checkbox]").each(function () {
      let thisName = $(this).attr('name');
      if ($(this).is(":checked")) {
        filterData[thisName].push($(this).val());
      }
    });


    $.ajax({
      type: "GET",
      url: "/routes/filter",
      data: {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        data: JSON.stringify(filterData)
      },
      success: function (data) {
        outputResults(data);
      }
    });

  });

  function outputResults(data) {

    let suggestionsList = $(".suggested-plans > ul"),
      suggestionsHTML = "";

    console.log(data);

    if(data.length > 0){
      $.each(data, function (index, value) {
        suggestionsHTML += `
          <li>
            <figure>
              <a href="${window.location.origin}/suggestions/${value.id}">
                <img src="${value.image}" alt="name">
              </a>
            </figure>
            <div class="suggested-plans__description">
              <h3>
                <a href="${window.location.origin}/suggestions/${value.id}">${value.name}</a></h3>
                <p>${value.short_description}</p>
            </div>
            <footer>
              <ul>
                <li><img src="/images/${value.category}-icon.png" alt="${value.category} icon"></li>
              </ul>
              <div class="suggested-plans__intensity">
        `
        for (let i = 0; i < 4; i++){
          if((i+1) === value.intensity){
            suggestionsHTML += `
              <span class="chosen"></span>
            `
          }else{
            suggestionsHTML += `
              <span></span>
            `
          }
        }
        suggestionsHTML += `
              </div>
            </footer>
          </li>
        `;
      })
    }else{
      suggestionsHTML = "<h4>Sorry, there is no result by your search</h4>"
    }

    suggestionsList.html(suggestionsHTML);

  }

});

