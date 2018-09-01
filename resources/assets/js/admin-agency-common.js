window.$ = window.jQuery = require('jquery');
require('../../../public/libs/bootstrap/js/bootstrap');

$(document).ready(function () {

    $(".main-header .burger, .mobile-sidebar__close-btn, .main-header__overlay").click(function(){
        $(".main-header").toggleClass('open');
        $("body").toggleClass('mobile-menu-open');
    });


});


// get FormData as object
function getFormData($form){
    const unindexed_array = $form.serializeArray();
    const indexed_array = {};
    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });
    return indexed_array;
}
