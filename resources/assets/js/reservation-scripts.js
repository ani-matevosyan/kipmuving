require('./common');
// require('../../../public/libs/product-tour/product-tour.min');
// require('./product.tour');

$(document).ready(function(){
    $('.payu-btn').click(function (event) {
        event.preventDefault();
        var thisBtn = $(this);
        thisBtn.attr('disabled', true);
        $.ajax({
            type: "GET",
            url: "/reserve/payu",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                for (key in data) {
                    if (data.hasOwnProperty(key)) {
                        $('form[name=payuform]>input[name=' + key + ']').val(data[key]);
                    }
                }
                thisBtn.attr('disabled', false);
                document.payuform.submit();
            }
        })
    });


    $("body").delegate(".cancelReservationBtn", "click", function(ev){
        const reservation = $(this).parents('li').html();
        $("#cancelActivityModal .theActivity").html(reservation);
        $("#cancelActivityModal .theActivity").find('.your-offers__cancel').remove();

        $("#cancelActivityModal .cancelReservationOK").attr('res_id',$(this).attr('res-id'));
        $("#cancelActivityModal").modal();
    });


    jQuery('.activity-basket__confirms-list').on("click", "button", function () {
        $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
        let oid = $(this).parent().prevAll().length,
            pickedel = $(this).parent();

        const reservation = $('.basket_reservations').find(`li[res_id=${oid}]`).html();
        $("#cancelActivityModal .theActivity").html(reservation);
        $("#cancelActivityModal .theActivity").find('.your-offers__cancel').remove();

        $("#cancelActivityModal .cancelReservationOK").attr('res_id',oid);
        $("#cancelActivityModal").modal();
    });


    $("body").delegate(".cancelReservationOK", "click", function(ev){
        const resId = $(this).attr('res_id');
        $.ajax({
            type: 'POST',
            url: `/offer/remove`,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'oid': resId
            },
            success: function(data){
                $('.basket_reservations').find(`li[res_id='${resId}']`).fadeOut('slow');
                $('.activity-basket').find(`li[res_id='${resId}']`).fadeOut('slow');
            },
            error: function(data){
                console.log(data);
            },
            complete: () => {
                $("#cancelActivityModal").modal('hide');
                getsuprogram();
            }
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


    function numberWithDots(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }




});