$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        'container': 'body'
    });

    $("#cpa-slider-1").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        pagination: false,
        navigation: true,
        navigationText: [
            "<span class='glyphicon glyphicon-menu-left'></span>",
            "<span class='glyphicon glyphicon-menu-right'></span>"
        ],
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3]

    });
    $("#cpa-slider-2").owlCarousel({
        autoPlay: 4000, //Set AutoPlay to 3 seconds
        pagination: false,
        navigation: true,
        navigationText: [
            "<span class='glyphicon glyphicon-menu-left'></span>",
            "<span class='glyphicon glyphicon-menu-right'></span>"
        ],
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3]
    });

    $('#first-slider-sec').removeClass('csHidden')

    // Guia Page Sub Tabs

    $("#m-box-1 .placeholder-info ul li a").click(function (e) {
        e.preventDefault();
        var currentAttrValue = $(this).attr('href');
        //find the active class and remove it
        $('#m-box-1 .map-description').find('.active-sub-tab').removeClass("active-sub-tab");
        //add the active class to the
        $(currentAttrValue).addClass('active-sub-tab');
    });
    $("#m-box-2 .placeholder-info ul li a").click(function (e) {
        e.preventDefault();
        var currentAttrValue = $(this).attr('href');
        //find the active class and remove it
        $('#m-box-2 .map-description').find('.active-sub-tab').removeClass("active-sub-tab");
        //add the active class to the
        $(currentAttrValue).addClass('active-sub-tab');
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

    //Deccaro plates

    function deccaroPlatesHeight(){
        $(".guide-places-plate").css('height', 'auto');
        $(".guide-places-plates").each(function(){
            var maxHeight = 0;
            $(this).find('.guide-places-plate').each(function(){
                if($(this).outerHeight() > maxHeight)
                    maxHeight = $(this).outerHeight();
                if($(this).parent().attr('data-opened') === 'true'){
                    var details_height = $(this).parent().find('.guide-place-plate-details').outerHeight();
                    $(this).parent().css('margin-bottom', details_height+ 30 + 'px');
                }
            });
            $(this).find('.guide-places-plate').height(maxHeight);
        });
    }

    if($(".guide-places-plates").length){
        deccaroPlatesHeight();
    }

    $(".guide-places-plate").click(function(){
        var thisWrapper = $(this).parent();
       var details_div = thisWrapper.find('.guide-place-plate-details');
        if(thisWrapper.attr('data-opened')==='true'){
            thisWrapper.attr('data-opened', 'false');
            thisWrapper.css('margin-bottom', '15px');
            details_div.css({'display': 'none', 'visibility': 'hidden'});
        }else{
            var thisPlate = thisWrapper;
            $(".guide-places-plate").each(function () {
                var wrapper = $(this).parent();
                if(wrapper.attr('data-opened')==='true'){
                    if(wrapper!=thisPlate){
                        wrapper.attr('data-opened', 'false');
                        wrapper.css('margin-bottom', '15px');
                        wrapper.find('.guide-place-plate-details').css({'display': 'none', 'visibility': 'hidden'});
                    }
                }
            });
            thisWrapper.attr('data-opened', 'true');
            var details_height = details_div.show().outerHeight();
            thisWrapper.css('margin-bottom', details_height+ 30 + 'px');
            details_div.css('visibility','visible');
        }
    });

    $(window).resize(function(){
        deccaroPlatesHeight();
    });

    $(".test-btn").click(function(){
        $(this).after(' <div id="TA_selfserveprop189" class="TA_selfserveprop">' +
            '<ul id="30iZF5r6R" class="TA_links cEtbHiZZFQx">'+
            '<li id="MvwrsMNF" class="BRI36TXBBM0o">' +
            '<a target="_blank" href="https://www.tripadvisor.cl/"><img src="https://www.tripadvisor.cl/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a>'+
            '</li>'+
            '</ul>'+
            '</div>'+
            '<script src="https://www.jscache.com/wejs?wtype=selfserveprop&uniq=189&locationId=11880671&lang=en&rating=true&nreviews=0&writereviewlink=false&popIdx=false&iswide=false&border=false&display_version=2"></script> ');
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.src = "https://www.jscache.com/wejs?wtype=selfserveprop&uniq=189&locationId=11880671&lang=en&rating=true&nreviews=0&writereviewlink=false&popIdx=false&iswide=false&border=false&display_version=2";
        // Use any selector
        $("head").append(s);
    })

});