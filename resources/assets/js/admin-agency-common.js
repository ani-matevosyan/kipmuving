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



/**
 * Number.prototype.format(n, x, s, c)
 *
 * @param integer n: length of decimal
 * @param integer x: length of whole part
 * @param mixed   s: sections delimiter
 * @param mixed   c: decimal delimiter
 */
Number.prototype.format = function(n, x, s, c) {
    let re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
        num = this.toFixed(Math.max(0, ~~n));

    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};
/**
 * examples for Number.prototype.format(n, x, s, c)
 *
 var n = '2500';
 n = parseFloat(n);
 n.format(2, 3, '.', ','); // 2.500,00  for Spanish
 n.format(2, 3, ',', '.'); // 2,500.00   for English
 12345678.9.format(2, 3, '.', ',');  // "12.345.678,90"
 123456.789.format(4, 4, ' ', ':');  // "12 3456:7890"
 12345678.9.format(0, 3, '-');       // "12-345-679"
 */

