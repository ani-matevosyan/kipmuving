$(document).ready(function(){
	// var feed = new Instafeed({
 //        target: 'instafeed',
 //        get: 'tagged',
 //        tagName: 'bmw',
 //        clientId: 'clientId',
 //        accessToken : '646191610.e029fea.516b109430104ecca9b8287bfaea56a4',
 //        limit: 12,
 //        template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img src="{{image}}"/></a></div>'
 //    });
 //    feed.run();
var feed = new Instafeed({
    get: 'tagged',
    tagName: 'bmw',
    // You can change 'flower' to  'termasmenetue'
    accessToken : '646191610.e029fea.516b109430104ecca9b8287bfaea56a4',
    template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img style="width: 150px !important; height: 150px !important;" src="{{image}}"/></a></div>',
    limit: 12,
    after: function(){
        $('#instafeed a').click(function(e){
            e.preventDefault();
            var urlOfThis = $(this)[0].href;
            if($("#the-image img")) {
                $("#the-image img").remove();
            }
            $.each($("#data span"), function(i,v){
                if($(this).attr('data-link') == urlOfThis) {
                    $("#the-image").append("<img src=\"" + $(this).attr('data-url') + "\"/>");
                }
            });
            $("#myModalX").modal('show');
        });
        $.each($("#instafeed").children(), function(){
           $(this).clone().appendTo($("#instafeed1"));
           $(this).clone().appendTo($("#instafeed2"));
         });
         $('#instafeed1 a').click(function(e){
            e.preventDefault();
            var urlOfThis = $(this)[0].href;
            if($("#the-image img")) {
                $("#the-image img").remove();
            }
            $.each($("#data span"), function(i,v){
                if($(this).attr('data-link') == urlOfThis) {
                    $("#the-image").append("<img src=\"" + $(this).attr('data-url') + "\"/>");
                }
            });
            $("#myModalX").modal('show');
        });
     $('#instafeed2 a').click(function(e){
            e.preventDefault();
            var urlOfThis = $(this)[0].href;
            if($("#the-image img")) {
                $("#the-image img").remove();
            }
            $.each($("#data span"), function(i,v){
                if($(this).attr('data-link') == urlOfThis) {
                    $("#the-image").append("<img src=\"" + $(this).attr('data-url') + "\"/>");
                }
            });
            $("#myModalX").modal('show');
        });

    },
    success: function(data){
        $.each(data.data, function(i,v){
            var url = v.images.standard_resolution.url; 
            $("#data").append("<span data-link=\"" + v.link + "\" data-url=\"" + url + "\"></span>");
        });
    }
});

feed.run();    
}) 