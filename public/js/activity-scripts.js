$(document).ready(function(){

    if($('.dropdown-activity').length){
        var yourSelect = $(".dropdown-activity");
        var notFoundText = yourSelect.attr("data-noresulttext");
        yourSelect.chosen({
            disable_search_threshold: 10,
            no_results_text: notFoundText
        });
    }

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

    jQuery('.raised-form').submit(function(e) {
        e.preventDefault();
        window.location.href="/activities/" + jQuery('#activity_id_r').val() + "?dt=" + jQuery('#activity_date_r').val();
        return false;
    });

    $('.btn-reserve').click(function(){
        var dt = $("#reserve-date").val();
        if (dt == '') {
            $('#message-modal #message').text('Seleccione primero la fecha.');
            $('#message-modal').modal('show');
            return false;
        }
        var offer_id = jQuery(this).data('offer-id');
        var persona = $(this).parents('.offer-item').find('.persona').val();
        if (persona == '') {
            $('#message-modal #message').text('Seleccione primero la cantidad de personas de esta actividad.');
            $('#message-modal').modal('show');
            return false;
        }
        var hours = $(this).parents('.offer-item').find('select.hours').val();
        if (hours == '') {
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
                    $(".offers-list").append("<li><a href='#'>"+ formattedDate   + " - "+ lastel.name+"</a>");

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

    })


});