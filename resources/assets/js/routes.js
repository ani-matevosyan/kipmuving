require('./common');
require('owl.carousel');
require('jquery-lazyload');

$(document).ready(function(){

  $("img.lazyload").lazyload();

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
  $("#open-filters").click(function(){
    modal.show(0, function(){
      modal.addClass('opened');
    });
    $('body').css('overflow-y', 'hidden');
  });

  $("#confirm-filters, #cancel-filters").click(function(){

    modal.removeClass('opened');
    modal.one('transitionend', function() {
      modal.hide();
    });
    $('body').css('overflow-y', '');

  });

});

