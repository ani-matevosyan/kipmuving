import 'jcf/dist/js/jcf';
import 'jcf/dist/js/jcf.select';

$(document).ready(function(){


    function numberWithDots(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }


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
                    $("#info-modal__title-link").attr('href', 'ss').text(data.agency.name);
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