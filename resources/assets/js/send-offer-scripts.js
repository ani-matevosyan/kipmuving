require('./common');

$(document).ready(function(){

    $(".pick-discount__button").on('click', function(e){
        e.preventDefault();
        $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
        $(this).parent().addClass('pick-discount__item_focus');
        let price = $(this).attr('data-price').split('.').join("");
        $(this).parent().parent().parent().find(".pick-discount__price-input").val(price);
        $("#pick-discount-form").submit();
    });

});