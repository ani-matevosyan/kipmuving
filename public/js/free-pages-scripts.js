/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 166);
/******/ })
/************************************************************************/
/******/ ({

/***/ 166:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(167);


/***/ }),

/***/ 167:
/***/ (function(module, exports) {


$(document).ready(function () {

    //BURGER
    var opened = false;
    $(".burger-menu").click(function () {
        if (!opened) {
            $(this).toggleClass("menu-on");
            $(".top_nav").addClass("active");
            $("body").css("overflow-y", "hidden");
            opened = true;
        }
    });
    $(".nav-cover").click(function () {
        if (opened) {
            $(".burger-menu").toggleClass("menu-on");
            $(".top_nav").removeClass("active");
            $("body").css("overflow-y", "visible");
            opened = false;
        }
    });

    var langPressed = false;
    var currPressed = false;

    $(".current-lang, .choose-lang").click(function (e) {
        $(".pick-curr").removeClass("pressed");
        $(".pick-lang").addClass("pressed");
        langPressed = true;
        e.stopPropagation();
    });

    $(".current-curr, .choose-curr").click(function (e) {
        $(".pick-lang").removeClass("pressed");
        $(".pick-curr").addClass("pressed");
        currPressed = true;
        e.stopPropagation();
    });

    $(document).click(function () {
        $(".pick-lang").removeClass("pressed");
        $(".pick-curr").removeClass("pressed");
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
            success: function success(data) {
                for (key in data) {
                    if (data.hasOwnProperty(key)) {
                        $('form[name=payuform]>input[name=' + key + ']').val(data[key]);
                    }
                }
                thisBtn.attr('disabled', false);
                document.payuform.submit();
            }
        });
    });

    // --------------------------- Program schedule restriction --------------------


    $("#program-schedule .btn").click(function (e) {
        if ($("#program_activities").attr('data-activities') == '0') {
            e.preventDefault();
            $('#message-modal #message').text('Debes incluir primero alguna actividad');
            $('#message-modal').modal('show');
        }
    });

    // --------------------------- END Program schedule restriction --------------------

    jQuery('#map-modal').on("shown.bs.modal", function () {

        var lat = jQuery(this).data('lat'),
            lng = jQuery(this).data('lng');
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

    //------------------- DISPLAYING CAPTCHA--------------------

    var contactMessage = $(".contact-form textarea[name='message']");
    var displayCaptcha = false;
    contactMessage.on('input', function () {
        if (contactMessage.val().length > 2 && !displayCaptcha) {
            $(".captcha-row").slideDown();
            displayCaptcha = true;
        }
    });

    //------------------- END DISPLAYING CAPTCHA--------------------

    jcf.setOptions('Select', {
        wrapNative: false,
        wrapNativeOnMobile: false,
        maxVisibleItems: 5
    });
    jcf.replace('select');

    $('[data-datepicker]').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    // Free Page Sub Tabs

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

    //Deccaro plates

    var accessToken = '4884336.ba4c844.7012da712056426bb3a379ca367b7eb0';

    function deccaroPlatesHeight() {
        $(".guide-places-plate").css('height', 'auto');
        $(".guide-places-plates").each(function () {
            var maxHeight = 0;
            $(this).find('.guide-places-plate').each(function () {
                if ($(this).outerHeight() > maxHeight) maxHeight = $(this).outerHeight();
            });
            $(this).find('.guide-places-plate').height(maxHeight);
        });
    }

    if ($(".guide-places-plates").length) {
        deccaroPlatesHeight();
    }

    $(".guide-places-plate").click(function () {
        var thisWrapper = $(this).parent();
        var details_div = thisWrapper.find('.guide-place-plate-details');
        if (thisWrapper.attr('data-opened') === 'true') {
            thisWrapper.attr('data-opened', 'false');
            thisWrapper.css('margin-bottom', '15px');
            details_div.css({ 'display': 'none', 'visibility': 'hidden' });
            ResizeSensor.detach(details_div);
        } else {
            var thisPlate = thisWrapper;
            $(".guide-places-plate").each(function () {
                var wrapper = $(this).parent();
                if (wrapper.attr('data-opened') === 'true') {
                    if (wrapper != thisPlate) {
                        wrapper.attr('data-opened', 'false');
                        wrapper.css('margin-bottom', '15px');
                        wrapper.find('.guide-place-plate-details').css({ 'display': 'none', 'visibility': 'hidden' });
                    }
                }
            });
            thisWrapper.attr('data-opened', 'true');
            var details_height = details_div.show().outerHeight();
            thisWrapper.css('margin-bottom', details_height + 30 + 'px');
            new ResizeSensor(details_div, function () {
                details_height = details_div.outerHeight();
                thisWrapper.css('margin-bottom', details_height + 30 + 'px');
            });
            var thisInstagramTag = details_div.find('.instagramtag');
            if (!thisInstagramTag.text().length) {
                var thisInsta = details_div.find('.instafeed');
                thisTag = thisInsta.attr('data-instatag');
                thisInstagramTag.text("#" + thisTag);
                var deccaroFeed = new Instafeed({
                    get: 'tagged',
                    tagName: thisTag,
                    target: thisInsta.attr('id'),
                    accessToken: accessToken,
                    template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img src="{{image}}"/></a></div>',
                    limit: 12,
                    after: function after() {
                        $('#' + thisInsta.attr("id") + ' a').click(function (e) {
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
                    success: function success(data) {
                        $.each(data.data, function (i, v) {
                            var url = v.images.standard_resolution.url;
                            $("#data").append("<span data-link=\"" + v.link + "\" data-url=\"" + url + "\"></span>");
                        });
                    }
                });
                deccaroFeed.run();
            }
            details_div.css('visibility', 'visible');
        }
    });

    $(window).resize(function () {
        deccaroPlatesHeight();
    });

    $(".order-theguide-form").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/free/activity/add",
            data: {
                id: $(this).data('id'),
                date: $(this).find('input[name=guide-date]').val(),
                hours_from: $(this).find('select[name=hours_from]').val(),
                hours_to: $(this).find('select[name=hours_to]').val()
            },
            success: function success() {
                $('#confirm-modal').modal('show');
                setTimeout(function () {
                    $('#confirm-modal').modal('hide');
                }, 3000);
            }
        });
    });
});

/***/ })

/******/ });