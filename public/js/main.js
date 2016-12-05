

// page init
jQuery(document).ready(function(){

	// jQuery('.activity-form').submit(function(e) {
	// 	e.preventDefault();
	// 	window.location.href="/activities/" + jQuery('#activity_id').val() + "?dt=" + jQuery('#activity_date').val();
	// 	return false;
	// });

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
			zoom: 8,
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
                $("#count_activities").text(data.data.offers);
                $("#count_persons").text(data.data.persons);
            },
            error: function(){
                location.reload();
            }
        });
    }

	jQuery('.btn-reserve').click(function(){
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
		$.ajax({
			type: "POST",
			url: "/offer/reserve",
			data: {
				'_token': $('meta[name="csrf-token"]').attr('content'),
				offer_id: offer_id,
			 	persons: persona,
			 	date: dt
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
                    $(".offers-list").append("<li><a href='#'>"+ lastel.date + " - "+ lastel.name + " ["+lastel.persons + " pers.]</a>");
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
		// $.post( "/offer/reserve", { '_token': $('meta[name="csrf-token"]').attr('content'), offer_id: offer_id, persona: persona, date: dt })
        $.post( "/offer/reserve", {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            offer_id: offer_id,
            persons: persona,
            date: dt
        })
	  	.done(function( response ) {
				 location.reload();
  		});
			return false;
	});


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
                    var totalcost = 0;
                    var totaldisc;
                    $( ".offers-list li" ).each( function(){
                        totalcost += parseInt($(this).find("a").find("span").text());
                    });
                    $(".total .totalprice p").text(Number(totalcost).toLocaleString('de-DE'));
					totaldisc = totalcost * 0.9;
					$(".total .discount p").text(Number(totaldisc).toLocaleString('de-DE'));

				}
            },
            error: function(){
                location.reload();
            }
        });
		return false;
	});

	function numberWithDots(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}

	jQuery('.persona').on("change", function(){
		var priceElem = $(this).parents('.offer-item').find('.price');
		var unit_price = 0 + priceElem.data('unit-price');

		priceElem.html('<sub>$</sub>' + numberWithDots($(this).val() * unit_price));
	});

});
