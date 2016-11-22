$(document).ready(function () {

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
});