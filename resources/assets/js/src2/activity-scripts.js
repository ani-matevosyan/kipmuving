import './product.tour';
import 'chosen-js/chosen.css';
import 'chosen-js';
import '../../../../public/libs/prettyPhoto/jquery.prettyPhoto';


$(document).ready(function(){

    if($('.dropdown-activity').length){
        var yourSelect = $(".dropdown-activity");
        var notFoundText = yourSelect.attr("data-noresulttext");
        yourSelect.chosen({
            disable_search_threshold: 10,
            no_results_text: notFoundText
        });
    }


    function numberWithDots(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $("#get-offers-persons").on('change', function(){
       var currencySign = $(this).attr('data-currencySign');
       var value = $(this).val();
       $('.offer-item').each(function(){
           var priceElem = $(this).find('.price');
           var unit_price = 0 + priceElem.data('unit-price');
           priceElem.html('<sub>'+currencySign+'</sub>' + numberWithDots(Math.round(value * unit_price)));
       })
    });

    function getsuprogram(){
        $.ajax({
            type: "GET",
            url: "/activities/getsuprogram",
            data: "",
            success: function(data){
                $("#program_activities").text(data.data.offers);
                $("#program_activities").attr('data-activities' ,data.data.offers);
                $("#program_persons").text(data.data.persons);
                $("#program_total").text(data.data.total);
            },
            error: function(){
                location.reload();
            }
        });
    }

    jQuery('.offers-list').on("click", "a", function(){
        var oid = $(this).parent().prevAll().length;
        var pickedel = $(this).parent();
        $.ajax({
            type: 'POST',
            url: "/offer/remove",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                oid: oid
            },
            success: function(){
                pickedel.remove();
                getsuprogram();
                if($(".offers-list li").length === 0 ){
                    $("section.widget.summary").slideUp();
                }
                if (window.location.pathname === '/calendar'){
                    calendarCalc();
                    jQuery('#calendar').fullCalendar('refetchEvents');
                }
                if(window.location.pathname === '/reserve'){
                    location.reload();
                }
            },
            error: function(){
                location.reload();
            }
        });
        return false;
    });

    jQuery('.raised-form').submit(function(e) {
        e.preventDefault();
        window.location.href="/activities/" + jQuery('#activity_id_r').val() + "?dt=" + jQuery('#activity_date_r').val();
        return false;
    });

    $('.btn-reserve').click(function(){
        var dt = $("#reserve-date").val();
        if (dt === '') {
            $('#message-modal #message').text('Seleccione primero la fecha.');
            $('#message-modal').modal('show');
            return false;
        }
        var offer_id = jQuery(this).data('offer-id');
        var persona = $("#get-offers-persons").val();
        if (persona === '') {
            $('#message-modal #message').text('Seleccione primero la cantidad de personas de esta actividad.');
            $('#message-modal').modal('show');
            return false;
        }
        var hours = $(this).parents('.offer-item').find('select.hours').val();
        if (hours === '') {
            $('#message-modal #message').text('Seleccione primero la cantidad de horario de esta actividad.');
            $('#message-modal').modal('show');
            return false;
        }
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
            error: function(){
                location.reload();
            }
        }).done(function(){
            getsuprogram();
            $.ajax({
                type: "GET",
                url: "/activities/getselectedoffers",
                data: "",
                success: function(data){
                    var lastel = data.data[data.data.length - 1];
                    if($(".offers-list li").length === 0){
                        $("section.widget.summary").slideDown();
                    }
                    var formattedDate = moment(lastel.date, "DD/MM/YYYY").format('DD/MM');
                    $(".offers-list").append("<li><a href='"+document.location.origin+"/offers/remove/"+offer_id+"'>"+ formattedDate   + " - "+ lastel.name+"</a>");

                    $('html, body').animate({scrollTop: '0px'}, 800);
                },
                error: function(){
                    location.reload();
                }
            })
        });
        return false;
    });


    //Activity comments script

    $(".comments-block__answer-button").click(function(e){
        e.preventDefault();
        $("#comments-block__form").find("input[name=comment_id]").val($(this).attr('href'));
        var answerText = $("#comments-block__form").attr("data-answerText");
        $("#comments-block__form").find(".comments-block__send-button").text(answerText);

    });

    var accessToken = '4884336.ba4c844.7012da712056426bb3a379ca367b7eb0';

    if($("#instafeed5").length) {
        var activityTag = $("#instafeed5").attr("data-tag");
        var feed5 = new Instafeed({
            get: 'tagged',
            tagName: activityTag,
            target: 'instafeed5',
            accessToken: accessToken,
            template: '<div class="col-xs-2 in-image-activity"><a href="{{link}}"><img src="{{image}}"/></a></div>',
            limit: 16,
            after: function () {
                $('#instafeed5 a').click(function (e) {
                    e.preventDefault();
                    var urlOfThis = $(this)[0].href;
                    if ($("#the-image img")) {
                        $("#the-image img").remove();
                    }
                    $.each($("#data span"), function (i, v) {
                        if ($(this).attr('data-link') == urlOfThis) {
                            $("#the-image").append("<img src=\"" + $(this).attr('data-url') + "\"/>");
                        }
                    });
                    $("#myModalX").modal('show');
                });
            },
            success: function (data) {
                $.each(data.data, function (i, v) {
                    var url = v.images.standard_resolution.url;
                    $("#data").append("<span data-link=\"" + v.link + "\" data-url=\"" + url + "\"></span>");
                });
            }
        });
        feed5.run();
    }


});