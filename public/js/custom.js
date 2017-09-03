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
/******/ 	return __webpack_require__(__webpack_require__.s = 32);
/******/ })
/************************************************************************/
/******/ ({

/***/ 32:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(33);


/***/ }),

/***/ 33:
/***/ (function(module, exports) {

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        'container': 'body'
    });

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
});

//TRIPADVISOR WIDGET CUSTOMIZE
$(window).load(function () {

    if (window.location.pathname.indexOf('/free/') === 0) {
        $(".opiniones").css("visibility", "visible");
        $("#CDSWIDSSP .widSSPData .widSSPTrvlRtng .widSSPOverall div").each(function () {
            var tripadvisorsubtext = $(this).html();
            $(this).html(tripadvisorsubtext.replace("de viajeros", ""));
        });
    }

    if (window.location.pathname.indexOf('/activity/') === 0) {
        $("#CDSWIDSSP .widSSPData .widSSPBranding dt a img, #CDSWIDSSP .widSSPData .widSSPBranding dt a:link img").attr("src", "/images/logo-trip.png");
    }
});

/***/ })

/******/ });