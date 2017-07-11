$(document).ready(function(){
    //-----------------Fixed sidebar----------------

    if($(window).width() > 991){
        var programBlock = $(".suprogram-content"),
            programWrapper = $(".s_suprogram"),
            blockWidth = programBlock.outerWidth(),
            blockHeight = programBlock.outerHeight();
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