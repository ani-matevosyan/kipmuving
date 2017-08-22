$(document).ready(function(){
    //-----------------Fixed sidebar----------------

    var programBlock = $(".s-program__content"),
        programWrapper = $(".s-program"),
        blockWidth = programBlock.outerWidth(),
        blockHeight = programBlock.outerHeight();

    $(window).resize(function(){
        blockWidth = programBlock.outerWidth();
    });

    if($(window).width() > 991){
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            var topDistance = programWrapper.offset().top;
            if (topDistance < scroll) {
                programWrapper.css('height', blockHeight+'px');
                programBlock.css('width', blockWidth+'px').addClass("fixed");
            }else{
                programWrapper.css('height', '');
                programBlock.css('width', '').removeClass("fixed");
            }
        });
    }

    //-----------------END Fixed sidebar----------------
});