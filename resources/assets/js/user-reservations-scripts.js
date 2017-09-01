import 'jcf/dist/js/jcf';
import 'jcf/dist/js/jcf.select';

$(document).ready(function(){


    function numberWithDots(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $("#accept-modal__button_success").click(function(e){
       let offerId = $("#accept-offer-modal").data('offer-id'),
           timeRange;
       if($("#accept-offer-modal__your-hours_time").length){
           timeRange = $("#accept-offer-modal__your-hours_time").data('timerange');
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
           success: function(data){
               console.log(data);
               $("#accept-offer-modal").modal('hide');
           },
           error: function(err){
               console.log(err);
           }
       });
    });

    $(".special-offers__button").click(function(e){
        e.preventDefault();
        let offer_id = $(this).parent().parent().data('offer-id');
        if(offer_id !== $("#accept-offer-modal").data('offer-id')) {
            $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
            $.ajax({
                type: 'GET',
                url: '/offer/special/confirm',
                data: {
                    id: offer_id
                },
                success: function (data) {
                    $("#accept-offer-modal__agency-name").text(data.agency_name);
                    $("#accept-offer-modal__price").text(data.price);
                    let pickHours = $("#accept-offer-modal__select-hours").detach(),
                        yourHours = $("#accept-offer-modal__your-hours").detach();
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
                }
            }).done(function () {
                $(".loader").remove();
                $("#accept-offer-modal").modal('show');
            })
        }else{
            $("#accept-offer-modal").modal('show');
        }
    });

    $("#info-modal__accept-button").click(function(e){
       e.preventDefault();
       let offerId = $("#info-modal").data('offer-id');
       $("#info-modal").modal('hide');
       setTimeout(function(){
           $(".special-offers__item[data-offer-id="+offerId+"]").find(".special-offers__button").trigger('click');
       }, 300);
    });

    $(".special-offers__info-button").click(function(e){
        e.preventDefault();
        let offer_id = $(this).parent().parent().data('offer-id');
        if(offer_id !== $("#info-modal").data('offer-id')){
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
                }
            }).done(function(){
                $(".loader").remove();
                $("#info-modal").modal('show');
            });
        }else{
            $("#info-modal").modal('show');
        }
    });

    //Print option

    function openPrintDialogue(){
        var printItemHeader = '<div class="print-item-header">' +
            '<a href="'+document.location.origin+'">' +
            '<img src="'+document.location.origin+'/images/KipMuving-darkgrey.svg" alt="Kipmuving logo">' +
            '</a>' +
            '</div>',
            printItemFooter = '<div class="print-item-footer">' +
                '<a href="'+document.location.origin+'">www.kipmuving.com</a>' +
                '</div>';

        $('<iframe name="myiframe" id="printFrame" frameBorder="0" height="0" style="position: absolute; bottom: 0; pointer-events: none">')
            .appendTo('body')
            .contents()
            .find('head')
            .append("<link rel='stylesheet' type='text/css' media='print' href='"+document.location.origin+"/css/print-style.css'>")
            .parent()
            .find('body')
            .append('<div class="print-header">' +
                '<img src="/images/printer.svg" alt="Printer icon">' +
                '<img src="http://kipmuving.lo/images/cut.svg" alt="Scissors icon">' +
                '<span><strong>Imprima</strong> y <strong>Recorte</strong> cada <strong>vousher</strong> y lleve <strong>separadamente</strong> a cada agencia</span>' +
                '</div>');

        $(".check_activity input[type=checkbox]:checked").each(function(){

            var item = $(this).parent().parent().find('.order-item').clone();

            item.prepend(printItemHeader);
            item.append(printItemFooter);

            $("#printFrame").contents().find('body').append(item);
        });

        setTimeout(function(){
            window.frames["myiframe"].print();
            $("#printFrame").remove();
        },1000);
    }


    var activity_checked = false;

    $('.to_print').on('click', function(e){
        var printText = $(this).data('print-text');
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

});