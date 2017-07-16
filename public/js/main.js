

// page init
jQuery(document).ready(function(){


	jQuery('.raised-form').submit(function(e) {
		e.preventDefault();
		window.location.href="/activities/" + jQuery('#activity_id_r').val() + "?dt=" + jQuery('#activity_date_r').val();
		return false;
	});


	jQuery('.btn-map').click(function(){
		jQuery('#map-modal').data('lat', jQuery(this).data('lat'));
		jQuery('#map-modal').data('lng', jQuery(this).data('lng'));
		jQuery('#map-modal').data('title', jQuery(this).data('title'));
		jQuery('#map-modal').modal('show');
	});

	jQuery('#map-modal').on("shown.bs.modal", function () {

		var lat = jQuery(this).data('lat'), lng = jQuery(this).data('lng');
		var title = jQuery(this).data('title');
		var latLng = new google.maps.LatLng(lat, lng);
		var myOptions = {
			zoom: 15,
			center: latLng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map-container"), myOptions);
		var marker = new google.maps.Marker({
			position: latLng,
			map: map,
			title: title
		});

	});

    function getsuprogram(){
        $.ajax({
            type: "GET",
            url: "/activities/getsuprogram",
            data: "",
            success: function(data){
                $("#program_activities").text(data.data.offers);
                $("#program_activities").attr('data-activities' ,data.data.offers);
                $("#program_persons").text(data.data.persons);
                $("#program_total").text(data.data.total);
            },
            error: function(){
                location.reload();
            }
        });
    }

    $(".overlay-opener").click(function(e){
        e.preventDefault();
    });
	$('.btn-reserve').click(function(){
		var dt = $("#reserve-date").val();
		if (dt == '') {
			$('#message-modal #message').text('Seleccione primero la fecha.');
			$('#message-modal').modal('show');
			return false;
		}
		var offer_id = jQuery(this).data('offer-id');
		var persona = $(this).parents('.offer-item').find('.persona').val();
		if (persona == '') {
			$('#message-modal #message').text('Seleccione primero la cantidad de personas de esta actividad.');
			$('#message-modal').modal('show');
			return false;
		}
		var hours = $(this).parents('.offer-item').find('select.hours').val();
        if (hours == '') {
            $('#message-modal #message').text('Seleccione primero la cantidad de horario de esta actividad.');
            $('#message-modal').modal('show');
            return false;
        }
		$.ajax({
			type: "POST",
			url: "/offer/reserve",
			data: {
				'_token': $('meta[name="csrf-token"]').attr('content'),
				offer_id: offer_id,
			 	persons: persona,
			 	date: dt,
                timeRange: hours
			},
            error: function(){
                location.reload();
            }
		}).done(function(){
            getsuprogram();
            $.ajax({
                type: "GET",
                url: "/activities/getselectedoffers",
                data: "",
                success: function(data){
                    var lastel = data.data[data.data.length - 1];
                    if($(".offers-list li").length === 0){
                        $("section.widget.summary").slideDown();
                    }
                    var formattedDate = moment(lastel.date, "DD/MM/YYYY").format('DD/MM');
                    $(".offers-list").append("<li><a href='#'>"+ formattedDate   + " - "+ lastel.name+"</a>");

                    $('html, body').animate({scrollTop: '0px'}, 800);
                },
                error: function(){
                    location.reload();
                }
            })
        });
		return false;
	});

	jQuery('.btn-reserve-ag').click(function(){
		var dt = jQuery(this).parents('.offer-item').find('.reserve-date').val();
		if (dt == '') {
			$('#message-modal #message').text('Please choose the date first.');
			$('#message-modal').modal('show');
			return false;
		}
		var offer_id = jQuery(this).data('offer-id');
		var persona = $(this).parents('.offer-item').find('.persona').val();
		if (persona == '') {
			$('#message-modal #message').text('Choose persona first.');
			$('#message-modal').modal('show');
			return false;
		}
        var hours = $(this).parents('.offer-item').find('select.hours').val();
        if (hours == '') {
            $('#message-modal #message').text('Choose time.');
            $('#message-modal').modal('show');
            return false;
        }
        $.ajax({
            type: "POST",
            url: "/offer/reserve",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                offer_id: offer_id,
                persons: persona,
                date: dt,
                timeRange: hours
            },
            error: function(){
                location.reload();
            }
        });
			return false;
	});

    function calendarCalc(){
        var totalcost = 0;
        var totaldisc;
        $( ".offers-list li" ).each( function(){
            var totalcostprep = ($(this).find("span").text());
            totalcost += parseInt(totalcostprep.split('.').join(""));
        });
        $(".total .totalprice p").text(Number(totalcost).toLocaleString('de-DE'));
        totaldisc = parseInt(totalcost * 0.1);
        $(".total .discount p").text(Number(totaldisc).toLocaleString('de-DE'));
    }

	jQuery('.offers-list').on("click", "a", function(){
        var oid = $(this).parent().prevAll().length;
        var pickedel = $(this).parent();
        $.ajax({
            type: 'POST',
            url: "/offer/remove",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                oid: oid
            },
            success: function(){
                pickedel.remove();
                getsuprogram();
                if($(".offers-list li").length === 0 ){
                    $("section.widget.summary").slideUp();
                }
                if (window.location.pathname === '/calendar'){
                    calendarCalc();
                    jQuery('#calendar').fullCalendar('refetchEvents');
				}
				if(window.location.pathname === '/reserve'){
                    location.reload();
                }
            },
            error: function(){
                location.reload();
            }
        });
		return false;
	});

    var cancel_offer_id;
    $(".delete_offer a").click(function(e){
        cancel_offer_id = $(this).attr('href');
        e.preventDefault();
        $("#myModal").modal();
    });

    $("#confirm_cancel").click(function(e){
        e.preventDefault();
        window.location.href = cancel_offer_id;
    });


    //------------------- DISPLAYING CAPTCHA--------------------

    var contactMessage = $(".contact-form textarea[name='message']");
    var displayCaptcha = false;
    contactMessage.on('input', function(){
       if(contactMessage.val().length > 2 && !displayCaptcha){
           $(".captcha-row").slideDown();
           displayCaptcha = true;
       }
    });

    //------------------- END DISPLAYING CAPTCHA--------------------


	function numberWithDots(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}



	jQuery('.persona').on("change", function(){
		var priceElem = $(this).parents('.offer-item').find('.price');
        var currency = $(this).parents('.offer-item').find('.price sub').html();
		var unit_price = 0 + priceElem.data('unit-price');

		priceElem.html('<sub>'+currency+'</sub>' + numberWithDots(Math.round($(this).val() * unit_price)));
	});

});

//TRIPADVISOR WIDGET CUSTOMIZE
$(window).load(function(){

    if (window.location.pathname.indexOf('/guia/') === 0){
        $(".opiniones").css("visibility", "visible");
        $("#CDSWIDSSP .widSSPData .widSSPTrvlRtng .widSSPOverall div").each(function(){
           var tripadvisorsubtext = $(this).html();
            $(this).html(tripadvisorsubtext.replace("de viajeros", ""));
        });
    }

    if (window.location.pathname.indexOf('/activity/') === 0){
        $("#CDSWIDSSP .widSSPData .widSSPBranding dt a img, #CDSWIDSSP .widSSPData .widSSPBranding dt a:link img").attr("src", "/images/logo-trip.png");
    }
});
