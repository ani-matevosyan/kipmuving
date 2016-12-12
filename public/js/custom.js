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


});