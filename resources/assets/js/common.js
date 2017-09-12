window.$ = window.jQuery = require('jquery');
require('../../../public/libs/bootstrap/js/bootstrap');

$(document).ready(function () {

    //BURGER
    var opened = false;
    $(".burger-menu").click(function () {
        if(!opened){
            $(this).toggleClass("menu-on");
            $(".top_nav").addClass("active");
            $("body").css("overflow-y", "hidden");
            opened = true;
        }
    });
    $(".nav-cover").click(function(){
        if(opened){
            $(".burger-menu").toggleClass("menu-on");
            $(".top_nav").removeClass("active");
            $("body").css("overflow-y", "visible");
            opened = false;
        }
    });

    var langPressed = false;
    var currPressed = false;

    $(".current-lang, .choose-lang").click(function(e){
        $(".pick-curr").removeClass("pressed");
        $(".pick-lang").addClass("pressed");
        langPressed = true;
        e.stopPropagation();
    });

    $(".current-curr, .choose-curr").click(function(e){
        $(".pick-lang").removeClass("pressed");
        $(".pick-curr").addClass("pressed");
        currPressed = true;
        e.stopPropagation();
    });

    $(document).click(function(){
        $(".pick-lang").removeClass("pressed");
        $(".pick-curr").removeClass("pressed");
    });


    // --------------------------- Program schedule restriction --------------------


    $("#program-schedule .btn").click(function(e){
       if($("#program_activities").attr('data-activities') == '0' && $("#program_subscriptions").data('subscriptions') === '0'){
           e.preventDefault();
           $('#message-modal #message').text('Debes incluir primero alguna actividad');
           $('#message-modal').modal('show');
       }
    });

    // --------------------------- END Program schedule restriction --------------------


    //------------------- DISPLAYING CAPTCHA--------------------

    var contactMessage = $(".contact-form textarea[name='message']");
    var displayCaptcha = false;
    contactMessage.on('input', function(){
        if(contactMessage.val().length > 2 && !displayCaptcha){
            $(".captcha-row").slideDown();
            displayCaptcha = true;
        }
    });

    //------------------- END DISPLAYING CAPTCHA--------------------

});

//TRIPADVISOR WIDGET CUSTOMIZE
$(window).on('load', function(){

    if (window.location.pathname.indexOf('/free/') === 0){
        $(".opiniones").css("visibility", "visible");
        $("#CDSWIDSSP .widSSPData .widSSPTrvlRtng .widSSPOverall div").each(function(){
            var tripadvisorsubtext = $(this).html();
            $(this).html(tripadvisorsubtext.replace("de viajeros", ""));
        });
    }

    if (window.location.pathname.indexOf('/activity/') === 0){
        $("#CDSWIDSSP .widSSPData .widSSPBranding dt a img, #CDSWIDSSP .widSSPData .widSSPBranding dt a:link img").attr("src", "/images/logo-trip.png");
    }
});
