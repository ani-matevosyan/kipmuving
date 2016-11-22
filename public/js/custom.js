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

    // Guia Page Tabs  
    $(".col a").click(function (e) {
        e.preventDefault();
        var currentAttrValue = $(this).attr('href');
        //find the active class and remove it
        $('.your-reservation').find('.active-tab').removeClass("active-tab");        
        //add the active class to the 
        $(currentAttrValue).addClass('active-tab');
    }); 
});