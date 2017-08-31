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
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(49);


/***/ }),

/***/ 49:
/***/ (function(module, exports) {

$(document).ready(function () {

    // function sendData(s_offer_uid, price){
    //     $.ajax({
    //         type: "POST",
    //         url: "/send-offer",
    //         data: {
    //             '_token': $('meta[name="csrf-token"]').attr('content'),
    //             s_offer_uid: s_offer_uid,
    //             price: price
    //         },
    //         success: function(data){
    //             console.log("SUCCESS!");
    //            console.log(data);
    //         },
    //         error: function(err){
    //             console.error('ERROR!');
    //             console.error(err);
    //         }
    //     });
    // }

    // $(".pick-discount__button").on('click', function(e){
    //     e.preventDefault();
    //     var offer_id = $(this).parent().parent().parent().find("input[name=s_offer_uid]").val(),
    //         price = $(this).data('price');
    //     sendData(offer_id, price);
    // });

    // $(".pick-discount__form").on('submit', function(e){
    //     e.preventDefault();
    //     var offer_id = $(this).find('[name=s_offer_uid]').val(),
    //         price = $(this).find('[name=price]').val();
    //     sendData(offer_id, price);
    // });


    $(".pick-discount__button").on('click', function (e) {
        e.preventDefault();
        var price = $(this).data('price').split('.').join("");;
        $(this).parent().parent().parent().find(".pick-discount__price-input").val(price);
    });
});

/***/ })

/******/ });