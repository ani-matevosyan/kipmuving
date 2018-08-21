require('./common');
window.select2 = require('select2');
window.toastr = require('toastr');

set_toastr_options = function(){
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-center",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "4000",
        "extendedTimeOut": "0",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
};


$(document).ready(function(){

    set_toastr_options();

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

        $.ajax({
            type: 'POST',
            url: `/admin/agency/addActivity`,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'formData': formData
            },
            success: function(res){
                let response = JSON.parse(res);
                if(response.success){
                    window.location.reload();
                    toastr.success('success', '');
                    $('#addActivityModal').modal('hide');
                }
                if(response.errorMessages){
                    $.each(response.errorMessages, function (i, value) {
                        if (isNaN(i)) {
                            // $(`input[name=${i}]`).css('border-color', '#FD676A');
                        }
                        toastr.error(value, '');
                    });
                }
            },
            error: function(data){
                console.log(data);
            },
            complete: (data) => {
            }
        })
    });


    $('.activities').on("click", ".edit-activity-icon", function () {
        const activity_id = $(this).attr('activity_id');
        const activity_name = $(this).parent().parent().find('h3').html();
        $('#deleteActivityOkModal .deleteActivityOkBtn').attr('activity_id', activity_id);
        $('#deleteActivityOkModal #activityNameSpan').html( activity_name);
        $.ajax({
            type: 'POST',
            url: `/admin/agency/getActivity`,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'activity_id': activity_id
            },
            success: function(res){
                $('.editActivityModal').html(res);
                $('.select2select').select2({
                    placeholder: '',
                    width: '100%',
                });
                $('#editActivityModal .editActivityBtn').attr('activity_id', activity_id);
                $('#editActivityModal').modal('show');
            }
        });
    });


    $(document.body).undelegate('#editActivityModal .editActivityBtn', 'click')
        .delegate('#editActivityModal .editActivityBtn', "click", function(ev) {
        const activity_id = $(this).attr('activity_id');
        const formData = $('.editActivityForm').serialize();

        $.ajax({
            type: 'POST',
            url: `/admin/agency/editActivity`,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'activity_id': activity_id,
                'formData': formData,
            },
            success: function(res){
                let response = JSON.parse(res);
                if(response.success){
                    window.location.reload();
                }
                if(response.errorMessages){
                    $.each(response.errorMessages, function (i, value) {
                        toastr.error(value, '');
                    });
                }
            }
        });
    });


    $(document.body).undelegate('#editActivityModal .deleteActivityBtn', 'click')
        .delegate('#editActivityModal .deleteActivityBtn', "click", function(ev) {
            $('#deleteActivityOkModal').modal('show');
            $('#editActivityModal').modal('hide');
    });


    $(document.body).undelegate('#deleteActivityOkModal .deleteActivityOkBtn', 'click')
        .delegate('#deleteActivityOkModal .deleteActivityOkBtn', "click", function(ev) {
            const activity_id = $(this).attr('activity_id');
            $.ajax({
                type: 'POST',
                url: `/admin/agency/deleteActivity`,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'activity_id': activity_id,
                },
                success: function(res){
                    let response = JSON.parse(res);
                    if(response.success){
                        window.location.reload();
                    }
                }
            });
    });







});