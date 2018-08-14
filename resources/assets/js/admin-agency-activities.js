require('./common');
window.select2 = require('select2');


$(document).ready(function(){

    $('.under-header').on("click", "button", function () {
        $('#addActivityModal').modal('show');
    });

    $('.select2select').select2({
        placeholder: '',
        width: '100%',
    });

});