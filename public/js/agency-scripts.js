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
/******/ 	return __webpack_require__(__webpack_require__.s = 27);
/******/ })
/************************************************************************/
/******/ ({

/***/ 27:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(28);


/***/ }),

/***/ 28:
/***/ (function(module, exports) {

$(document).ready(function () {

    function getsuprogram() {
        $.ajax({
            type: "GET",
            url: "/activities/getsuprogram",
            data: "",
            success: function success(data) {
                $("#program_activities").text(data.data.offers);
                $("#program_activities").attr('data-activities', data.data.offers);
                $("#program_persons").text(data.data.persons);
                $("#program_total").text(data.data.total);
            },
            error: function error() {
                location.reload();
            }
        });
    }

    function numberWithDots(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    jQuery('.persona').on("change", function () {
        var priceElem = $(this).parents('.offer-item').find('.price');
        var currency = $(this).parents('.offer-item').find('.price sub').html();
        var unit_price = 0 + priceElem.data('unit-price');

        priceElem.html('<sub>' + currency + '</sub>' + numberWithDots(Math.round($(this).val() * unit_price)));
    });

    jQuery('.btn-reserve-ag').click(function () {
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
            success: function success() {
                getsuprogram();
            },
            error: function error() {
                location.reload();
            }
        });
        return false;
    });
});

/***/ })

/******/ });