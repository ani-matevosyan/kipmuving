require('./common');
require('jcf/dist/js/jcf');
require('jcf/dist/js/jcf.select');

$(document).ready(function(){


    function numberWithDots(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $("#accept-modal__button_success").click(function(e){

       let offerId = $("#accept-offer-modal").attr('data-offer-id'),
           timeRange;
       if($("#accept-offer-modal__your-hours_time").length){
           timeRange = $("#accept-offer-modal__your-hours_time").attr('data-timerange');
           $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
       }else{
           timeRange = $("#accept-offer-modal__time-select").val();
           if(timeRange === ''){
               if(!$("#accept-offer-modal__select-hours").hasClass('reservations-modal__paragraph_error')){
                   $("#accept-offer-modal__select-hours").addClass('reservations-modal__paragraph_error');
                   $("#accept-offer-modal__time-select").parent().addClass('reservations-modal__time-select_error');
               }
               $("#accept-offer-modal__time-select").on('change', function(){
                  if($(this).val() !== ''){
                      $("#accept-offer-modal__select-hours").removeClass('reservations-modal__paragraph_error');
                      $("#accept-offer-modal__time-select").parent().removeClass('reservations-modal__time-select_error');
                  }
               });
               return false;
           }
       }
        $.ajax({
            type: 'POST',
            url: '/offer/special/confirm',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'id': offerId,
                'timerange': timeRange
            },
            success: response => {
                if(response.success === true){
                  $("#accept-offer-modal").modal('hide');
                  location.reload();
                }
            },
            error: err => {
                console.log(err);
                $(".loader").remove();
            }
        });
    });

    let pickHours = $("#accept-offer-modal__select-hours").detach(),
        yourHours = $("#accept-offer-modal__your-hours").detach();
    $(".special-offers__button").click(function(e){
        e.preventDefault();
        let offer_id = $(this).parent().parent().attr('data-offer-id');
        if(offer_id !== $("#accept-offer-modal").attr('data-offer-id')) {
            $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
            $("#accept-offer-modal__select-hours, #accept-offer-modal__your-hours").remove();
            $.ajax({
                type: 'GET',
                url: '/offer/special/confirm',
                data: {
                    id: offer_id
                },
                success: function (data) {
                    $("#accept-offer-modal__agency-name").text(data.agency_name);
                    $("#accept-offer-modal__price").text(numberWithDots(data.price));
                    if(data.timeranges.length < 2){
                        yourHours.appendTo('#accept-modal__info');
                        $("#accept-offer-modal__your-hours_time").text(data.timeranges[0].start+' - '+data.timeranges[0].end).attr('data-timerange', data.timeranges[0].start+'-'+data.timeranges[0].end);
                    }else{
                        pickHours.appendTo("#accept-modal__info");
                        $(".reservations-modal__option").remove();
                        $.each(data.timeranges, function(key,value){
                           $('<option class="reservations-modal__option" value="'+ value.start + '-' + value.end + '">'+ value.start + ' - ' + value.end + '</option>').appendTo('#accept-offer-modal__time-select');
                        });
                    }
                    $("#accept-offer-modal").attr('data-offer-id', offer_id);
                },
                error: function (data) {
                    console.error(data);
                },
              complete: () => {
                $(".loader").remove();
                $("#accept-offer-modal").modal('show');
              }
            });
        }else{
            $("#accept-offer-modal").modal('show');
        }
    });

    $("#info-modal__accept-button").click(function(e){
       e.preventDefault();
       let offerId = $("#info-modal").attr('data-offer-id');
       $("#info-modal").modal('hide');
       $("#info-modal").on('hidden.bs.modal', function(){
           $(".special-offers__item[data-offer-id="+offerId+"]").find(".special-offers__button").trigger('click');
           $("#info-modal").off();
       });
    });

    $(".special-offers__info-button").click(function(e){
        e.preventDefault();
        let offer_id = $(this).parent().parent().attr('data-offer-id');
        if(offer_id !== $("#info-modal").attr('data-offer-id')){
            $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
            $.ajax({
                type: 'POST',
                url: '/offer/special/info',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': offer_id
                },
                success: function(data){
                    $("#info-modal__icon").attr('src', document.location.origin+'/'+data.agency.logo).attr('alt', data.agency.name);
                    $("#info-modal__title-link").attr('href', document.location.origin+'/agency/'+data.agency.id).text(data.agency.name);
                    $("#info-modal__agency-address").text(data.agency.address);
                    $("#you-should-take__list").text("");
                    $.each(data.offer.includes, function(key, value){
                        $("#you-should-take__list").append("<li class='you-should-take__item info-modal__item'>"+value+"</li>");
                    });
                    $("#info-modal__discount").text(numberWithDots(data.offer.old_price));
                    $("#info-modal__price").text(numberWithDots(data.offer.new_price));
                    $("#info-modal__duration").text(data.offer.duration+'hrs');
                    $("#info-modal__schedule").text(data.offer.schedule);
                    $("#info-modal__description").text(data.activity.description);
                    $("#info-modal").attr('data-offer-id', offer_id);
                },
                error: function(data){
                    console.log(data);
                },
              complete: () => {
                $(".loader").remove();
                $("#info-modal").modal('show');
              }
            })
        }else{
            $("#info-modal").modal('show');
        }
    });

    //Print option

  const printItemHeader = `<div class="print-item-header"><img src="${document.location.origin}/images/KeepMoving_logo_grey.svg" alt="Kipmuving logo"></a></div>`,
        printItemFooter = `<div class="print-item-footer">www.keepmoving.co</div>`;

    function openPrintDialogue(){

        $('<iframe name="myiframe" id="printFrame" frameBorder="0" height="0" style="position: absolute; bottom: 0; pointer-events: none">')
        .appendTo('body')
            .contents()
            .find('head')
            .append(`<link rel='stylesheet' type='text/css' media='print' href='${document.location.origin}/css/print-style.css'>`)
            .parent()
            .find('body')
            .append(`<div class="print-header">
                <img src="${document.location.origin}/images/printer.svg" alt="Printer icon">
                <img src="${document.location.origin}/images/cut.svg" alt="Scissors icon">
                <span><strong>${window.translateData.print}</strong> ${window.translateData.and} <strong>${window.translateData.cut}</strong> ${window.translateData.each_voucher} <strong>${window.translateData.separately}</strong> ${window.translateData.to_each_agency}</span>
                </div>`);

        $(".check_activity input[type=checkbox]:checked").each(function(){

            let item = $(this).parent().parent().find('.order-item').clone();

            item.prepend(printItemHeader);
            item.append(printItemFooter);

            $("#printFrame").contents().find('body').append(item);
        });

        setTimeout(function(){
            window.frames["myiframe"].print();
            $("#printFrame").remove();
        },1000);
    }


    let activity_checked = false;

    $('.to_print').on('click', function(e){
        let printText = $(this).attr('data-print-text');
        e.preventDefault();
        if(!activity_checked){
            $(".check_activity").show();
            $(this).text(printText);
            activity_checked = true;
        }else{
            if($(".check_activity input[type=checkbox]:checked").length){
                openPrintDialogue();
            }else{
                $("#printWarning").modal("show");
            }
        }
    });

  let activityChecked = false;
  $("#print-activities").click(function(e){
     e.preventDefault();
     let printText = $(this).attr('data-print-text');
      if(activityChecked){
        let checkedOffersIds = [];
        $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
        if($(".your-offers__check-offer input[type=checkbox]:checked").length == 0){
          $(".loader").remove();
          $("#printWarning").modal("show");
          return false;
        }
        $(".your-offers__check-offer input[type=checkbox]:checked").each(function(){
          checkedOffersIds.push(parseInt($(this).val()));
        });
        $.ajax({
          type: "POST",
          url: "/reservation/print",
          data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            ids: checkedOffersIds
          },
          success: response => {
            $(".loader").remove();
            $('<iframe name="myiframe" id="printFrame" frameBorder="0" height="0" style="position: absolute; bottom: 0; pointer-events: none">')
              .appendTo('body')
              .contents()
              .find('head')
              .append(`<link rel='stylesheet' type='text/css' media='print' href='${document.location.origin}/css/activity-print.css'>`)
              .parent()
              .find('body')
              .append(`
                <div class="print-header">
                    <img src="${document.location.origin}/images/printer.svg" alt="Printer icon">
                    <img src="${document.location.origin}/images/cut.svg" alt="Scissors icon">
                    <span><strong>${window.translateData.print}</strong> ${window.translateData.and} <strong>${window.translateData.cut}</strong> ${window.translateData.each_voucher} <strong>${window.translateData.separately}</strong> ${window.translateData.to_each_agency}</span>
                </div>
              `);
            $.each(response, function(key, value){
              let youMustTakeList = `<ul>`;
              $.each(value.offer_includes, function(key, value){
                youMustTakeList += `<li>${value}</li>`;
              });
              youMustTakeList +=`</ul>`;
              let item = `
              <div class="print-item">
                ${printItemHeader}
                <header>
                    <h2>${value.activity_name}</h2>
                    <span><strong>${value.agency_name}</strong> ${value.agency_address}</span>
                </header>
                  <div class="row">
                      <div class="col">
                          <div class="list-box">
                              <strong>${window.translateData.you_must_take}</strong>
                              ${youMustTakeList}
                          </div>
                      </div>
                      <div class="col">
                          <ul class="information-list">
                              <li class="time">
                                  <img src="${document.location.origin}/images/clock.svg" alt="Time icon" class="information-list__image">
                                  <strong class="title">${window.translateData.day}: ${value.reservation_date}</strong>
                                  <span><strong>${window.translateData.duration}</strong>: ${value.activity_duration} hr</span>
                                  <span><strong>${window.translateData.schedule}</strong>: ${value.activity_schedule.start} to ${value.activity_schedule.end}</span>
                                  <span><strong>${window.translateData.summary}</strong>: $ ${value.reservation_total}</span>
                              </li>
                              <li class="person">
                                  <img src="http://kipmuving.lo/images/happy.svg" alt="Person icon" class="information-list__image">
                                  <span><strong>${value.reservation_persons}</strong> ${window.translateData.persons}</span>
                              </li>
                          </ul>
                      </div>
                  </div>
                 ${printItemFooter}
              </div>
            `;
              //Agency icon
            // <div class="icon"><img src="${document.location.origin}/${value.activity_icon}" alt="${value.activity_name}"></div>
              // Pay in agency item
            // <li class="money">
            //     <img src="http://kipmuving.lo/images/coin.svg" alt="Person icon" class="information-list__image">
            //     <span>Pay in agency</span>
            //     <strong class="title">CLP $ ${parseInt(value.reservations_total) * 0.9}</strong>
            //   </li>
              $("#printFrame").contents().find('body').append(item);
            });
            setTimeout(function(){
              window.frames["myiframe"].print();
              $("#printFrame").remove();
            },1000);
          },
          error: err => {
            $(".loader").remove();
            console.log(err);
          }
        });
      }else{
        $("#your-offers-list").addClass('your-offers_show-checkboxes');
        $(this).text(`${printText}!`);
        activityChecked = true;
      }
  });

  $("#coupon-button").click(function(e){
      e.preventDefault();
      let userName = $(this).attr('data-name'),
        date = $(this).attr('data-date');
    $('<iframe name="myiframe" id="CouponFrame" frameBorder="0" height="0" style="position: absolute; bottom: 0; pointer-events: none">')
      .appendTo('body')
      .contents()
      .find('head')
      .append(`<link rel='stylesheet' type='text/css' media='print' href='${document.location.origin}/css/coupon-print.css'>`)
      .parent()
      .find('body')
      .append(`
        <div class="print-header">
            <img src="${document.location.origin}/images/printer.svg" alt="Printer icon">
            <img src="${document.location.origin}/images/cut.svg" alt="Scissors icon">
            <span><strong>${window.translateData.print}</strong> ${window.translateData.and} <strong>${window.translateData.cut}</strong> ${window.translateData.each_voucher} <strong>${window.translateData.separately}</strong> ${window.translateData.to_each_agency}</span>
        </div>
        <div class="coupon">
            <header>
                <img src="${document.location.origin}/images/salewa-logo_black.png" alt="Salewa Chile logo">
                <img src="${document.location.origin}/images/fjallraven-logo_black.png" alt="Fjallraven logo">
                <img src="${document.location.origin}/images/volkanica-logo_black.png" alt="Volkanica logo">
            </header>
            <div class="coupon__body">
                <h1><strong>${window.translateData.congratulations} ${userName}!</strong></h1>
                <h2>${window.translateData.you_won_10}</h2>
                <h3>${window.translateData.store_located} <strong>Fresia # 275 local 6, Pucón</strong></h3>
                <h4>${window.translateData.valid_until} ${date}</h4>
            </div>
            <footer>www.keepmoving.co</footer>
        </div>
       `);

    setTimeout(function(){
      window.frames["myiframe"].print();
      $("#CouponFrame").remove();
    },1000);
  });

});