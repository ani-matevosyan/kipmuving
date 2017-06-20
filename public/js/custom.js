$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        'container': 'body'
    });

    if($("#cpa-slider-1").length){
        $("#cpa-slider-1").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            pagination: false,
            navigation: true,
            navigationText: [
                "<span class='glyphicon glyphicon-menu-left'></span>",
                "<span class='glyphicon glyphicon-menu-right'></span>"
            ],
            items: 3,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3]

        });
    }

    $('#first-slider-sec').removeClass('csHidden')

    // Guia Page Sub Tabs

    $("#m-box-1 .placeholder-info ul li a").click(function (e) {
        e.preventDefault();
        var currentAttrValue = $(this).attr('href');
        //find the active class and remove it
        $('#m-box-1 .map-description').find('.active-sub-tab').removeClass("active-sub-tab");
        //add the active class to the
        $(currentAttrValue).addClass('active-sub-tab');
    });
    $("#m-box-2 .placeholder-info ul li a").click(function (e) {
        e.preventDefault();
        var currentAttrValue = $(this).attr('href');
        //find the active class and remove it
        $('#m-box-2 .map-description').find('.active-sub-tab').removeClass("active-sub-tab");
        //add the active class to the
        $(currentAttrValue).addClass('active-sub-tab');
    });

    var langPressed = false;
    var currPressed = false;

    $(".current-lang, .choose-lang").click(function(e){
        $(".pick-curr").removeClass("pressed");
        $(".pick-lang").addClass("pressed");
        langPressed = true;
        e.stopPropagation();
    });

    $(".current-curr, .choose-curr").click(function(e){
        $(".pick-lang").removeClass("pressed");
        $(".pick-curr").addClass("pressed");
        currPressed = true;
        e.stopPropagation();
    });

    $(document).click(function(){
        $(".pick-lang").removeClass("pressed");
        $(".pick-curr").removeClass("pressed");
    });

    //Deccaro plates

    var accessToken = '4884336.ba4c844.7012da712056426bb3a379ca367b7eb0';

    function deccaroPlatesHeight(){
        $(".guide-places-plate").css('height', 'auto');
        $(".guide-places-plates").each(function(){
            var maxHeight = 0;
            $(this).find('.guide-places-plate').each(function(){
                if($(this).outerHeight() > maxHeight)
                    maxHeight = $(this).outerHeight();
            });
            $(this).find('.guide-places-plate').height(maxHeight);
        });
    }

    if($(".guide-places-plates").length){
        deccaroPlatesHeight();
    }

    $(".guide-places-plate").click(function(){
        var thisWrapper = $(this).parent();
       var details_div = thisWrapper.find('.guide-place-plate-details');
        if(thisWrapper.attr('data-opened')==='true'){
            thisWrapper.attr('data-opened', 'false');
            thisWrapper.css('margin-bottom', '15px');
            details_div.css({'display': 'none', 'visibility': 'hidden'});
            ResizeSensor.detach(details_div);
        }else{
            var thisPlate = thisWrapper;
            $(".guide-places-plate").each(function () {
                var wrapper = $(this).parent();
                if(wrapper.attr('data-opened')==='true'){
                    if(wrapper!=thisPlate){
                        wrapper.attr('data-opened', 'false');
                        wrapper.css('margin-bottom', '15px');
                        wrapper.find('.guide-place-plate-details').css({'display': 'none', 'visibility': 'hidden'});
                    }
                }
            });
            thisWrapper.attr('data-opened', 'true');
            var details_height = details_div.show().outerHeight();
            thisWrapper.css('margin-bottom', details_height+ 30 + 'px');
            new ResizeSensor(details_div, function() {
                details_height = details_div.outerHeight();
                thisWrapper.css('margin-bottom', details_height+ 30 + 'px');
            });
            var thisInstagramTag = details_div.find('.instagramtag');
            if(!(thisInstagramTag.text().length)){
                var thisInsta = details_div.find('.instafeed');
                thisTag = thisInsta.attr('data-instatag');
                thisInstagramTag.text("#"+ thisTag);
                var deccaroFeed = new Instafeed({
                    get: 'tagged',
                    tagName: thisTag,
                    target: thisInsta.attr('id'),
                    accessToken: accessToken,
                    template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img src="{{image}}"/></a></div>',
                    limit: 12,
                    after: function () {
                        $('#'+thisInsta.attr("id")+' a').click(function (e) {
                            e.preventDefault();
                            var urlOfThis = $(this)[0].href;
                            if ($("#the-image img")) {
                                $("#the-image img").remove();
                            }
                            $.each($("#data span"), function (i, v) {
                                if ($(this).attr('data-link') == urlOfThis) {
                                    $("#the-image").append("<img src=\"" + $(this).attr('data-url') + "\"/>");
                                }
                            });
                            $("#myModalX").modal('show');
                        });
                    },
                    success: function (data) {
                        $.each(data.data, function (i, v) {
                            var url = v.images.standard_resolution.url;
                            $("#data").append("<span data-link=\"" + v.link + "\" data-url=\"" + url + "\"></span>");
                        });
                    }
                });
                deccaroFeed.run();
            }
            details_div.css('visibility','visible');
        }
    });

    $(window).resize(function(){
        deccaroPlatesHeight();
    });

    $(".order-theguide-form").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/guia/activity/add",
            data: {
                id: $(this).data('id'),
                date: $(this).find('input[name=guide-date]').val(),
                hours_from: $(this).find('select[name=hours_from]').val(),
                hours_to: $(this).find('select[name=hours_to]').val()
            },
            success: function(){
                $('#confirm-modal').modal('show');
                setTimeout(function(){
                    $('#confirm-modal').modal('hide');
                }, 3000)
            }
        })
    });


    $('.payu-btn').click(function (event) {
        event.preventDefault();
        var thisBtn = $(this);
        thisBtn.attr('disabled', true);
        $.ajax({
            type: "GET",
            url: "/reserve/payu",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                for (key in data) {
                    if (data.hasOwnProperty(key)) {
                        $('form[name=payuform]>input[name=' + key + ']').val(data[key]);
                    }
                }
                thisBtn.attr('disabled', false);
                document.payuform.submit();
            }
        })
    });


    //Print option

    function openPrintDialogue(){
        var printItemHeader = '<div class="print-item-header">' +
            '<a href="'+document.location.origin+'">' +
            '<img src="'+document.location.origin+'/images/KipMuving-darkgrey.svg" alt="Kipmuving logo">' +
            '</a>' +
            '</div>',
            printItemFooter = '<div class="print-item-footer">' +
                '<a href="'+document.location.origin+'">www.kipmuving.com</a>' +
                '</div>';

        $('<iframe name="myiframe" id="printFrame" frameBorder="0" height="0" style="position: absolute; bottom: 0; pointer-events: none">')
            .appendTo('body')
            .contents()
            .find('head')
            .append("<link rel='stylesheet' type='text/css' media='print' href='"+document.location.origin+"/css/print-style.min.css'>")
            .parent()
            .find('body')
            .append('<div class="print-header">' +
                '<img src="/images/printer.svg" alt="Printer icon">' +
                '<img src="http://kipmuving.lo/images/cut.svg" alt="Scissors icon">' +
                '<span><strong>Imprima</strong> y <strong>Recorte</strong> cada <strong>vousher</strong> y lleve <strong>separadamente</strong> a cada agencia</span>' +
                '</div>');

        $(".check_activity input[type=checkbox]:checked").each(function(){

            var item = $(this).parent().parent().find('.order-item').clone();

            item.prepend(printItemHeader);
            item.append(printItemFooter);

            $("#printFrame").contents().find('body').append(item);
        });

        setTimeout(function(){
            window.frames["myiframe"].print();
            $("#printFrame").remove();
        },1000);
    }


    var activity_checked = false;

    $('.to_print').on('click', function(e){
        e.preventDefault();
        if(!activity_checked){
            $(".check_activity").show();
            $(this).text("Print!");
            activity_checked = true;
        }else{
            if($(".check_activity input[type=checkbox]:checked").length){
               openPrintDialogue();
            }else{
                $("#printWarning").modal("show");
            }

        }
    });
});