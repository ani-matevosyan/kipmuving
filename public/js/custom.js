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


    //----------------------MAP-----------------------------

    // create the markers
    if (window.location.pathname === '/guia/decarro'){

        var geoJson;

        $.ajax({
           url: "../js/features.json",
            dataType: "json",
            async: false,
            success: function(data){
               geoJson = data;
            }
        });

        // create the map
        var map = L.mapbox.map('map', 'rafaelzarro.1c6j5igk').setView([-39.266018, -71.71772], 10);

        map.scrollWheelZoom.disable();
        map.featureLayer.on('layeradd', function(e) {
            var marker = e.layer;
            // custom popup content
            var popupContent =  getTitle(marker);
            marker.bindPopup(popupContent,{
                closeButton: false
            });
            // customize click event
            marker.on('click', function(e) {
                // zoom on the marker
                if(map.getZoom() > marker.feature.properties.zoom) {
                    map.setView(e.latlng, map.getZoom());
                } else {
                    map.setView(e.latlng, marker.feature.properties.zoom);
                }
                var thisId = this.feature.id;
                if($("#map-tab-"+thisId).length === 1){
                    $(".map-tab").each(function(){
                       $(this).removeClass("active");
                    });
                    $("#map-tab-"+thisId).addClass("active");
                }
            });
        });
        // load the markers in the map
        map.featureLayer.setGeoJSON(geoJson);
        // popup behaviour on marker mouseover event
        map.featureLayer.on('mouseover', function(e) {
            e.layer.openPopup();
        });
        map.featureLayer.on('mouseout', function(e) {
            e.layer.closePopup();
        });

        // language
        var lang = document.documentElement.lang;
        // by default english language
        function getTitle(marker) {
            if(lang == 'fr') {
                return marker.feature.properties.title;
            } else {
                return marker.feature.properties.title;
            }
        }
    }
    //----------------------END MAP-----------------------------


});