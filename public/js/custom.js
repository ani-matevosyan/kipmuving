$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        'container': 'body'
    });

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


    // --------------------------- Program schedule restriction --------------------


    $("#program-schedule .btn").click(function(e){
       if($("#program_activities").attr('data-activities') == '0'){
           e.preventDefault();
           $('#message-modal #message').text('Debes incluir primero alguna actividad');
           $('#message-modal').modal('show');
       }
    });

    // --------------------------- END Program schedule restriction --------------------

    jQuery('#map-modal').on("shown.bs.modal", function () {

        var lat = jQuery(this).data('lat'), lng = jQuery(this).data('lng');
        var title = jQuery(this).data('title');
        var latLng = new google.maps.LatLng(lat, lng);
        var myOptions = {
            zoom: 15,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-container"), myOptions);
        var marker = new google.maps.Marker({
            position: latLng,
            map: map,
            title: title
        });

    });


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


    function numberWithDots(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }



    jQuery('.persona').on("change", function(){
        var priceElem = $(this).parents('.offer-item').find('.price');
        var currency = $(this).parents('.offer-item').find('.price sub').html();
        var unit_price = 0 + priceElem.data('unit-price');

        priceElem.html('<sub>'+currency+'</sub>' + numberWithDots(Math.round($(this).val() * unit_price)));
    });

});

//TRIPADVISOR WIDGET CUSTOMIZE
$(window).load(function(){

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
