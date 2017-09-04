require('./common');

$(document).ready(function(){


    //-----------AVATAR LOADING--------------

    $('#image').change(function(){
        this.form.submit();
        $("#hiddenframe").on('load', function(){
            $.ajax({
                type: "GET",
                url: "/user/getAvatar",
                data: "",
                success: function(data){
                    $("#youravatar").attr('src', data);
                }
            })
        });
    });

    //----------END AVATAR LOADING---------------

});