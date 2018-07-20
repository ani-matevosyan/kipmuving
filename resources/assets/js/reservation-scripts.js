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

        $("#cancelActivityModal .cancelReservationOK").attr('fake_id',$(this).attr('fake_id'));
        const prevCount = $(this).parents('li').prevAll().length;
        $("#cancelActivityModal .cancelReservationOK").attr('res_id',prevCount);
        $("#cancelActivityModal").modal();
    });



    $(document.body).undelegate('.activity-basket__confirms-list button', 'click')
    .delegate(".activity-basket__confirms-list button", "click", function(ev){
        $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
        const oid = $(this).parents('li').prevAll().length;
        const fake_id = $(this).parents('li').attr('fake_id');

        const reservation = $('.basket_reservations').find(`li[fake_id=${fake_id}]`).html();
        $("#cancelActivityModal .theActivity").html(reservation);
        $("#cancelActivityModal .theActivity").find('.your-offers__cancel').remove();

        $("#cancelActivityModal .cancelReservationOK").attr('res_id',oid);
        $("#cancelActivityModal .cancelReservationOK").attr('fake_id',fake_id);
        $("#cancelActivityModal").modal();
    });


    $("body").delegate(".cancelReservationOK", "click", function(ev){
        const resId = $(this).attr('res_id');
        const fake_id = $(this).attr('fake_id');
        $.ajax({
            type: 'POST',
            url: `/offer/remove`,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'oid': resId
            },
            success: function(data){
                $('.basket_reservations').find(`li[fake_id='${fake_id}']`).fadeOut('slow').remove();
                $('.activity-basket').find(`li[fake_id='${fake_id}']`).fadeOut('slow').remove();
            },
            error: function(data){
                console.log(data);
            },
            complete: () => {
                $("#cancelActivityModal").modal('hide');
                getsuprogram();
                // location.reload();
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