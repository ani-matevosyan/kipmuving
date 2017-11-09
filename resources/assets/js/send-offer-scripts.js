require('./common');

$(document).ready(function(){

    // $(".pick-discount__button").on('click', function(e){
    //     e.preventDefault();
    //     $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
    //     $(this).parent().addClass('pick-discount__item_focus');
    //     let price = $(this).attr('data-price').split('.').join("");
    //     $(this).parent().parent().parent().find(".pick-discount__price-input").val(price);
    //     $("#pick-discount-form").submit();
    // });

  let price,
      checkedButton = false;

    $(".pick-discount__button").on('click', function(e){
       e.preventDefault();
       let thisButton = $(this);
       price = thisButton.attr('data-price').split('.').join("");
       thisButton.closest('.special-offers-list__pick-discount').find('.pick-discount__price-input').val('');
       if(thisButton.parent().hasClass('pick-discount__item_focus')){
         thisButton.parent().removeClass("pick-discount__item_focus");
         checkedButton = false;
       }else{
           thisButton.closest('.pick-discount__list').find('.pick-discount__item').each(function(){
               $(this).removeClass('pick-discount__item_focus');
           });
         thisButton.parent().addClass("pick-discount__item_focus");
         checkedButton = true;
       }
    });

    $(".pick-discount__price-input").on('keypress', function(){
      let thisInput = $(this);
      if(checkedButton){
        checkedButton = false;
        thisInput.closest('.special-offers-list__pick-discount').find('.pick-discount__item').each(function(){
          $(this).removeClass('pick-discount__item_focus');
        });
      }
    });

    $(".pick-discount__form").on('submit', function(e){
      let offerUid = $(this).find('[name=s_offer_uid]').val();
      if(checkedButton){
        e.preventDefault();
        $('body').append('<div class="loader"><div class="loader__inner"></div></div>');
        $.ajax({
          type: 'GET',
          url: '/send-offer',
          data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'price': price,
            's_offer_uid': offerUid
          },
          success: function(){
            $(".special-offers-list").remove();
            $(".s-send-special-offer").append(`<h3>Great, we send email to user. Many thanks!</h3>`);
          },
          error: function(err){
            console.log(err);
          },
          complete: function(){
            $(".loader").remove();
          }
        });
      }
    });

});