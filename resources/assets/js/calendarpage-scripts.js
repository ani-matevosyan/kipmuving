require('./common');
require('fullcalendar');

$(document).ready(function(){


    function getsuprogram(){
        $.ajax({
            type: "GET",
            url: "/activities/getsuprogram",
            data: "",
            success: response => {
                $("#count-activities").text(response.data.offers);
                $("#count-special-offers").text(response.data.special_offers);
                $("#header-cart").text(response.data.offers + response.data.special_offers);
                $("#program_persons").text(response.data.persons);
                $("#program_total").text(numberWithDots(response.data.total));
            },
            error: err => {
                console.log(err);
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


    function calendarCalc(){
        let totalcost = 0;
        $("#instant-booking-list .basket-list__item" ).each( function(){
            let totalcostprep = ($(this).find(".basket-list__price").text());
            totalcost += parseInt(totalcostprep.split('.').join(""));
        });
        $(".s-program__price").text(Number(totalcost).toLocaleString('de-DE'));
    }

    $('.activity-basket .activity-basket__confirms-list').on("click", "button", function(e){
        e.preventDefault();
        let oid = $(this).parent().prevAll().length;
        $('#delete-modal .btn-confirm').data('oid', oid);
        $('#delete-modal').modal('show');
    });

    $("#receive-offers-list").on('click', '.basket-list__delete-button', function(e){
        e.preventDefault();
        $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
        let oid = $(this).parent().prevAll().length,
            pickedel = $(this).parent();
        $.ajax({
            type: 'POST',
            url: "/offer/special/remove",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                oid: oid
            },
            success: () => {
                let itemsCount = pickedel.parent().find('.basket-list__item').length - 1;
                pickedel.remove();
                if(itemsCount < 1){
                    $("#special-offers-basket").remove();
                    if($("#offers-basket").find('.basket-list__item').length < 1){
                        window.location.replace(document.location.origin+'/activities');
                    }
                }
            },
            error: err => {
                location.reload();
            },
          complete: () => {
            getsuprogram();
          }
        })
    });

    //-------------------CALENDAR PLUGIN --------------
    if($('#calendar').length){
        let viewdate = $("#calendar").attr("data-date"),
            calendarLang = $("#calendar").attr("data-lang"),
            dayRange, windowWidth = $(window).width();
        if(windowWidth >= 992){
            dayRange = 5;
        }else if(windowWidth < 991 && windowWidth > 600 ){
            dayRange = 3;
        }else{
            dayRange = 2;
        }
        if (calendarLang === 'es_ES'){ calendarLang = 'es' }
        jQuery('#calendar').fullCalendar({
            lang: calendarLang,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            defaultView: 'agendaFourDay',
            views: {
                agendaFourDay: {
                    type: 'agenda',
                    duration: {days: dayRange},
                    buttonText: '5 days',
                    columnFormat: 'ddd D/M'
                }
            },
            allDaySlot: false,
            defaultDate: viewdate,
            editable: false,
            eventLimit: true,
            events: '/calendar/data',
            eventOverlap: true,
            eventRender: function (event, element) {
                // console.log(isOverlapping(event));
                // event.overlap = true;
                element.data('duplicate', event.duplicate);
                console.log(event);
                const start_time = Number(event.start_time.substring(0, 2));
                const end_time = Number(event.end_time.substring(0, 2));
                const duration = end_time - start_time;
                element.append('<br>');
                element.append('<a href="#" class="move prev" data-oid="' + event.id + '"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>');
                element.append('<span class="move-days">move days</span>');
                element.append('<a href="#" class="move next" data-oid="' + event.id + '"><span class="glyphicon glyphicon-chevron-right pull-right" aria-hidden="true"></span></a>');
                element.append('<br>');
                if(event.agency_name != undefined){
                    element.append(`<div class="agency-name">${event.agency_name}</div>`);
                    element.append(`<div class="price">$ ${event.price}</div>`);
                }else{
                    element.append('<br>');
                }
                element.append('<div class="hours"><i class="glyphicon glyphicon-time"></i> ' + event.hours + ' hrs (' + event.start_time + ' a ' + event.end_time+ ')</div>');
                if(event.persons != undefined){
                    element.append('<div class="persona"><i class="glyphicon glyphicon-user"></i> ' + event.persons + ' persona</div>');
                }
                element.append('<br>');
                element.append('<a href="#" class="delete" data-oid="' + event.id + '"><span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></a>');

                if (duration < 2) {
                    element.find(".fc-title").css('margin-top', '15px');
                    element.find(".price").css('visibility', 'hidden');
                }
                if (duration > 2 && duration <= 4) {
                    element.find(".fc-title").css('margin-top', '30px');
                    element.find(".price").css('visibility', 'hidden');
                }
                if(duration < 7){
                    element.find(".hours").css('visibility', 'hidden');
                    element.find(".persona").css('visibility', 'hidden');
                }
            },
            eventAfterAllRender: function (view) {
                jQuery('.btn-reservar').attr("href", '/reserve');
                jQuery('.alert-overlap').hide();
                $.each($('.fc-event'), function (index, value) {
                    if ($(value).data('duplicate')) {
                        $('.alert-overlap').show();
                        $('.btn-reservar').removeAttr('href');
                    }
                });
            }
        });
    }

    jQuery(document).on("click", ".fc-event.cal-offer .move", function (e) {
        e.preventDefault();
        let oid = jQuery(this).data('oid'),
            dir = jQuery(this).hasClass('prev') ? 'prev' : jQuery(this).hasClass('next') ? 'next' : '';
        $.ajax({
            type: "POST",
            url: "/calendar/process",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                oid: oid,
                dir: dir
            },
            success: function (result) {
                jQuery('#calendar').fullCalendar('refetchEvents');
            }
        });
    });

    jQuery(document).on("click", ".fc-event.cal-offer .delete", function (e) {
        e.preventDefault();
        let oid = jQuery(this).data('oid');
        $('#delete-modal .btn-confirm').data('oid', oid);
        $('#delete-modal').modal('show');
    });

    jQuery('#delete-modal .btn-confirm').on("click", function (e) {
        e.preventDefault();
        let oid = jQuery(this).data('oid');
        $('#delete-modal').modal('hide');
        $.ajax({
            type: 'POST',
            url: "/offer/remove",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                oid: oid
            },
            success: function(){
                location.reload();
                jQuery('#calendar').fullCalendar('refetchEvents');
                getsuprogram();
                $( ".offers-list li" ).each( function(index){
                    if(index === oid){
                        $(this).remove();
                    }
                });
                calendarCalc();
            }
        });
    });

    function isOverlapping(event){
        let array = $("#calendar").fullCalendar('clientEvents');
        for(i in array){
            if(array[i].id != event.id){
                if(!(Date(array[i].start) >= Date(event.end) || Date(array[i].end) <= Date(event.start))){
                    return true;
                }
            }
        }
        return false;
    }


    //------------------- END CALENDAR PLUGIN --------------

    let cancel_offer_id;
    $(".delete_offer a").click(function(e){
        cancel_offer_id = $(this).attr('href');
        e.preventDefault();
        $("#myModal").modal();
    });

    $("#confirm_cancel").click(function(e){
        e.preventDefault();
        window.location.href = cancel_offer_id;
    });

    //------------------- Generate link --------------

    let generated = false;
    $("#generate-link").click(function(e){
        e.preventDefault();
        var outputBlock = $(this).parent().find('input'),
            thisButton = $(this);
        if(generated){
            outputBlock.select();
            document.execCommand('copy');
        }else{
            $.ajax({
                type: 'POST',
                url: '/proposals/save',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    outputBlock.val(data).slideDown();
                    generated = true;
                    thisButton.text('Copy');
                }
            })
        }
    });

    //------------------- END Generate link --------------

});