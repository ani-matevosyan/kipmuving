$(document).ready(function(){

    //Activity comments script

    $(".comments-block__answer-button").click(function(e){
        e.preventDefault();
        $("#comments-block__form").find("input[name=comment_id]").val($(this).attr('href'));
        var answerText = $("#comments-block__form").attr("data-answerText");
        $("#comments-block__form").find(".comments-block__send-button").text(answerText);

    });

});