$(document).ready(function(){

    //-------------------CALENDAR PLUGIN --------------
    if($('#calendar').length){
        var viewdate = $("#calendar").attr("data-date");
        var calendarLang = $("#calendar").attr("data-lang");
        var dayRange, windowWidth = $(window).width();
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
                element.append('<br>');
                element.append('<a href="#" class="move prev" data-oid="' + event.id + '"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>');
                element.append('<a href="#" class="move next" data-oid="' + event.id + '"><span class="glyphicon glyphicon-chevron-right pull-right" aria-hidden="true"></span></a>');
                element.append('<br>');
                if(event.agency_name != undefined){
                    element.append('<div class="agency-name">' + event.agency_name + '</div>');
                }else{
                    element.append('<br>');
                }
                element.append('<div class="hours"><i class="glyphicon glyphicon-time"></i> ' + event.hours + ' hrs (' + event.start_time + ' a ' + event.end_time+ ')</div>');
                if(event.persons != undefined){
                    element.append('<div class="persona"><i class="glyphicon glyphicon-user"></i> ' + event.persons + ' persona</div>');
                }
                element.append('<br>');
                element.append('<a href="#" class="delete" data-oid="' + event.id + '"><span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span></a>');
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
        var oid = jQuery(this).data('oid');
        var dir = jQuery(this).hasClass('prev') ? 'prev' : jQuery(this).hasClass('next') ? 'next' : '';
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
        var oid = jQuery(this).data('oid');
        $('#delete-modal .btn-confirm').data('oid', oid);
        $('#delete-modal').modal('show');
    });

    jQuery('#delete-modal .btn-confirm').on("click", function (e) {
        e.preventDefault();
        var oid = jQuery(this).data('oid');
        $('#delete-modal').modal('hide');
        $.ajax({
            type: 'POST',
            url: "/offer/remove",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                oid: oid
            },
            success: function(){
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
        var array = $("#calendar").fullCalendar('clientEvents');
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

    //------------------- Generate link --------------

    $("#generate-link").click(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/proposal/save',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                console.log(data);
            }
        })
    });

    // {{ action('ProposalController@saveProposal') }}
    //------------------- END Generate link --------------

})