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
        $(".guide-places-plates").each(function(){
            var maxHeight = 0;
            $(this).find('.guide-places-plate').each(function(){
                if($(this).outerHeight() > maxHeight)
                    maxHeight = $(this).outerHeight();
            });
            $(this).find('.guide-places-plate').height(maxHeight);
        });
    }

    if($(".guide-places-plates").length){
        deccaroPlatesHeight();
    }

    $(".guide-places-plate-wrapper").click(function(){
       var details_div = $(this).find('.guide-place-plate-details');
        if($(this).attr('data-opened')==='true'){
            $(this).attr('data-opened', 'false');
            $(this).css('margin-bottom', '15px');
            details_div.css({'display': 'none', 'visibility': 'hidden'});
        }else{
            var thisPlate = $(this);
            $(".guide-places-plate-wrapper").each(function () {
                if($(this).attr('data-opened')==='true'){
                    if($(this)!=thisPlate){
                        $(this).attr('data-opened', 'false');
                        $(this).css('margin-bottom', '15px');
                        $(this).find('.guide-place-plate-details').css({'display': 'none', 'visibility': 'hidden'});
                    }
                }
            });
            $(this).attr('data-opened', 'true');
            var details_height = details_div.show().outerHeight();
            $(this).css('margin-bottom', details_height+ 30 + 'px');
            details_div.css('visibility','visible');
        }
    });

    // $(window).resize(function(){
    //     // console.log('ok');
    //     deccaroPlatesHeight();
    // });

});

