$(document).ready(function(){

    function sendData(s_offer_uid, price){
        $.ajax({
            type: "POST",
            url: "/send-offer",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                s_offer_uid: s_offer_uid,
                price: price
            },
            success: function(data){
                console.log("SUCCESS!");
               console.log(data);
            },
            error: function(err){
                console.error('ERROR!');
                console.error(err);
            }
        });
    }

    $(".pick-discount__button").on('click', function(e){
        e.preventDefault();
        var offer_id = $(this).parent().parent().parent().find("input[name=s_offer_uid]").val(),
            price = $(this).data('price');
        sendData(offer_id, price);
    });

    $(".pick-discount__form").on('submit', function(e){
        e.preventDefault();
        var offer_id = $(this).find('[name=s_offer_uid]').val(),
            price = $(this).find('[name=price]').val();
        sendData(offer_id, price);
    });

});