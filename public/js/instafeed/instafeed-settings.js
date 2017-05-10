$(document).ready(function(){

	var accessToken = '4884336.ba4c844.7012da712056426bb3a379ca367b7eb0';

	if($("#instafeed1").length){
		var feed1 = new Instafeed({
			get: 'tagged',
			tagName: 'pucon',
			target: 'instafeed1',
			accessToken : accessToken,
			template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img style="width: 150px !important; height: 150px !important;" src="{{image}}"/></a></div>',
			limit: 14,
			after: function(){
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
			},
			success: function(data){
				$.each(data.data, function(i,v){
					var url = v.images.standard_resolution.url;
					$("#data").append("<span data-link=\"" + v.link + "\" data-url=\"" + url + "\"></span>");
				});
			}
		});
		feed1.run();
	}
	if($("#instafeed2_1").length){
		var feed2_1 = new Instafeed({
			get: 'tagged',
			tagName: 'rioturbio',
			target: 'instafeed2_1',
			accessToken : accessToken,
			template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img style="width: 150px !important; height: 150px !important;" src="{{image}}"/></a></div>',
			limit: 5,
			after: function(){
				$('#instafeed2_1 a').click(function(e){
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
		feed2_1.run();
	}
	if($("#instafeed2_2").length){
		var feed2_2 = new Instafeed({
			get: 'tagged',
			tagName: 'ojosdelcaburgua',
			target: 'instafeed2_2',
			accessToken : accessToken,
			template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img style="width: 150px !important; height: 150px !important;" src="{{image}}"/></a></div>',
			limit: 5,
			after: function(){
				$('#instafeed2_2 a').click(function(e){
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
		feed2_2.run();
	};
	if($("#instafeed2_3").length){
		var feed2_3 = new Instafeed({
			get: 'tagged',
			tagName: 'saltodelclaro',
			target: 'instafeed2_3',
			accessToken : accessToken,
			template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img style="width: 150px !important; height: 150px !important;" src="{{image}}"/></a></div>',
			limit: 4,
			after: function(){
				$('#instafeed2_3 a').click(function(e){
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
		feed2_3.run();
	}

	if($("#instafeed4").length){
		var agencyId  = $("#instafeed4").attr("data-instagram-id");
		var feed4 = new Instafeed({
			get: 'user',
            userId: agencyId,
			target: 'instafeed4',
			accessToken : accessToken,
			template: '<div class="col-sm-2 col-xs-3 in-image-agency"><a href="{{link}}"><img style="width: 86px !important; height: 86px !important;" src="{{image}}"/></a></div>',
			limit: 12,
			after: function(){
				$('#instafeed4 a').click(function(e){
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
		feed4.run();
	}

	if($("#instafeed5").length) {
		var activityTag = $("#instafeed5").attr("data-tag");
		var feed5 = new Instafeed({
			get: 'tagged',
			tagName: activityTag,
			target: 'instafeed5',
			accessToken: accessToken,
			template: '<div class="col-xs-2 in-image-activity"><a href="{{link}}"><img src="{{image}}"/></a></div>',
			limit: 16,
			after: function () {
				$('#instafeed5 a').click(function (e) {
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
		feed5.run();
	}
});