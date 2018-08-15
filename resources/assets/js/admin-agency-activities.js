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

    $(document.body).undelegate('.glyphicon-plus-sign', 'click')
        .delegate(".glyphicon-plus-sign", "click", function(ev){
            const html = '<div class="timesHours">'
                            + '<div class="col-sm-4">'
                            +   '<input type="text" name="start_time[]" class="form-control start_time">'
                            + '</div>'
                            + '<div class="col-sm-4">'
                            +   '<input type="text" name="end_time[]" class="form-control end_time">'
                            + '</div>'
                            + '<div class="col-sm-4">'
                            +   '<div class="operations">'
                            +       '<span class="glyphicon glyphicon-plus-sign"></span>'
                            +       '<span class="glyphicon glyphicon-remove"></span>'
                            +   '</div>'
                            + '</div>'
                        + '</div>';
            const element = $(this).parent().parent().parent();
            $(html).insertAfter(element);
    });


    $(document.body).undelegate('.glyphicon-remove', 'click')
        .delegate(".glyphicon-remove", "click", function(ev){
            const element = $(this).parent().parent().parent();
            element.fadeOut().remove();
    });


    $('#addActivityModal').on("click", "button.addActivity", function () {
        const formData = $('.addActivityForm').serialize();
        // console.log(formData);
    });



});