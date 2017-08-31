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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */,
/* 3 */,
/* 4 */,
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(6);
__webpack_require__(7);
__webpack_require__(8);
__webpack_require__(9);
__webpack_require__(10);
__webpack_require__(11);
__webpack_require__(12);
__webpack_require__(13);
__webpack_require__(14);
__webpack_require__(15);
__webpack_require__(16);
__webpack_require__(17);
__webpack_require__(18);
__webpack_require__(19);
module.exports = __webpack_require__(20);


/***/ }),
/* 6 */
/***/ (function(module, exports) {

$(document).ready(function () {

    if ($("#activities-slider").length) {
        $("#activities-slider").owlCarousel({
            autoPlay: 3000,
            pagination: false,
            navigation: true,
            navigationText: ["<span class='glyphicon glyphicon-menu-left'></span>", "<span class='glyphicon glyphicon-menu-right'></span>"],
            items: 3,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3]

        });
        $('#activities-slider').removeClass('csHidden');
    }

    //Opening and closing mobile filter modal


    var filtersModal = $(".filters-modal");
    $(".btn-open-filters").click(function (e) {
        e.preventDefault();
        filtersModal.show();
        $('body').css('overflow-y', 'hidden');
    });

    $(".btn-confirm-filters").click(function (e) {
        e.preventDefault();
        filtersModal.hide();
        $('body').css('overflow-y', 'auto');
    });

    $(".btn-cancel-filters").click(function (e) {
        e.preventDefault();
        clearFilters();
        filtersModal.hide();
        $('body').css('overflow-y', 'auto');
    });

    //Filters functionality

    $(".filter-item input[type=checkbox]").on('change', function () {
        collectData();
    });

    $("#slider-range").slider({
        range: true,
        min: 10000,
        max: 300000,
        step: 100,
        values: [10000, 300000],
        slide: function slide(event, ui) {
            $(".slider-range-output").val("$ " + ui.values[0] + " - $ " + ui.values[1]);
        },
        change: function change(event, ui) {
            collectData();
        }
    });
    $(".slider-range-output").val("$ " + $("#slider-range").slider("values", 0) + " - $ " + $("#slider-range").slider("values", 1));

    function collectData() {

        $(".all-activities").html("<div class='loader'><div class='loader__inside'></div></div>");

        var filterData = {
            'style': [],
            'period': [],
            'price': []
        };

        var activeFilters = 0;

        $(".filter-item input[type=checkbox]").each(function () {
            var thisName = $(this).attr('name');
            if ($(this).is(":checked")) {
                activeFilters++;
                if (thisName == 'style') {
                    filterData.style.push($(this).val());
                } else {
                    filterData.period.push($(this).val());
                }
            }
        });

        if (activeFilters != 0) {
            $(".btn-open-filters span").text('(' + activeFilters + ')');
        } else {
            $(".btn-open-filters span").text('');
        }

        filterData.price.push($("#slider-range").slider('values', 0), $("#slider-range").slider('values', 1));
        $.ajax({
            type: "POST",
            url: "/activities/filters",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                data: JSON.stringify(filterData)
            },
            success: function success(data) {
                displayActivities(data);
                calcAllActivities(data);
            }
        });
    }

    function clearFilters() {
        $(".filter-item input[type=checkbox]").each(function () {
            $(this).prop('checked', false);
        });

        $("#slider-range").slider({ values: [10000, 300000] });
        $(".slider-range-output").val("$ " + $("#slider-range").slider("values", 0) + " - $ " + $("#slider-range").slider("values", 1));

        var filterData = {
            'style': [],
            'period': [],
            'price': []
        };

        $.ajax({
            type: "POST",
            url: "/activities/filters",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                data: filterData
            },
            success: function success(data) {
                displayActivities(data);
                calcAllActivities(data);
            }
        });
    }

    function calcAllActivities(data) {
        var activitiesAmount = 0;
        $.each(data, function (index, value) {
            activitiesAmount += value.length;
        });
        $(".btn-confirm-filters span").text("(" + activitiesAmount + ")");
    }

    var passVariable = $("#pass-variable");
    var translationData = {
        dayDescription: passVariable.data('daydesc'),
        nightDescription: passVariable.data('nightdescr'),
        summerDescription: passVariable.data('summerdescr'),
        winterDescription: passVariable.data('winterdescr'),
        textFrom: passVariable.data('textfrom'),
        buttonText: passVariable.data('buttontext'),
        trekkingCat: passVariable.data('cat-trekking'),
        rioCat: passVariable.data('cat-rio'),
        aireCat: passVariable.data('cat-aire'),
        relaxCat: passVariable.data('cat-relax'),
        nieveCat: passVariable.data('cat-nieve'),
        culturalCat: passVariable.data('cat-cultural'),
        ciclismoCat: passVariable.data('cat-ciclismo')
    };

    function displayActivities(data) {
        var allActivities = $(".all-activities"),
            activitiesHTML = '';
        allActivities.html('');

        $.each(data, function (index, value) {
            switch (index) {
                case 'Trekking':
                    activitiesHTML += "<section class='activity-block trekking'>" + "<strong class='heading'>" + "<span>" + "<img src='" + document.location.origin + "/images/Trekking.svg' alt='Trekking icon' width='40' height='40'>" + "</span>" + translationData.trekkingCat;
                    break;
                case 'Rio':
                    activitiesHTML += "<section class='activity-block rio'>" + "<strong class='heading'>" + "<span>" + "<img src='" + document.location.origin + "/images/kayak.svg' alt='Rio icon' width='40' height='40'>" + "</span>" + translationData.rioCat;
                    break;
                case 'Aire':
                    activitiesHTML += "<section class='activity-block aire'>" + "<strong class='heading'>" + "<span>" + "<img src='" + document.location.origin + "/images/aire.svg' alt='Aire icon' width='33' height='33'>" + "</span>" + translationData.aireCat;
                    break;
                case 'Nieve':
                    activitiesHTML += "<section class='activity-block nieve'>" + "<strong class='heading'>" + "<span>" + "<img src='" + document.location.origin + "/images/skiing_ski_running.svg' alt='Nieve icon' width='33' height='33'>" + "</span>" + translationData.nieveCat;
                    break;
                case 'Familia':
                    activitiesHTML += "<section class='activity-block familia'>" + "<strong class='heading'>" + "<span>" + "<img src='" + document.location.origin + "/images/family.svg' alt='Cultural icon' width='33' height='33'>" + "</span>" + translationData.culturalCat;
                    break;
                case 'Relax':
                    activitiesHTML += "<section class='activity-block relax'>" + "<strong class='heading'>" + "<span>" + "<img src='" + document.location.origin + "/images/relax.svg' alt='Relax icon' width='33' height='33'>" + "</span>" + translationData.relaxCat;
                    break;
                case 'Ciclismo':
                    activitiesHTML += "<section class='activity-block ciclismo'>" + "<strong class='heading'>" + translationData.ciclismoCat;
                    break;
            }
            activitiesHTML += "</strong>" + "<div class='row'>";
            var keyFor4Col = 0,
                keyFor3Col = 0;
            $.each(value, function (index, value) {
                activitiesHTML += "<div class='col-md-3 col-sm-4 col-xs-12 col'>" + "<div class='img-holder'>" + "<a href='" + document.location.origin + "/activity/" + value.id + "'>" + "<img src='" + document.location.origin + "/" + value.image_thumb + "' alt='" + value.name + "'>" + "</a>" + "</div>" + "<div class='caption'>" + "<div class='activity-icons'>" + "<ul>";
                $.each(value.availability, function (index, value) {
                    if (value != 0) switch (index) {
                        case 'day':
                            activitiesHTML += "<li>" + "<div class='ico'>" + "<img src='" + document.location.origin + "/images/day.svg' alt='Day icon' width='33' height='33'>" + "<p>" + translationData.dayDescription + "<span class='glyphicon glyphicon-triangle-bottom'></span>" + "</p>" + "</div>" + "</li>";
                            break;
                        case 'night':
                            activitiesHTML += "<li>" + "<div class='ico'>" + "<img src='" + document.location.origin + "/images/night.svg' alt='Night icon' width='33' height='33'>" + "<p>" + translationData.nightDescription + "<span class='glyphicon glyphicon-triangle-bottom'></span>" + "</p>" + "</div>" + "</li>";
                            break;
                        case 'summer':
                            activitiesHTML += "<li>" + "<div class='ico'>" + "<img src='" + document.location.origin + "/images/down-arrow.svg' alt='Down arrow icon' width='25' height='25'>" + "<p>" + translationData.summerDescription + "<span class='glyphicon glyphicon-triangle-bottom'></span>" + "</p>" + "</div>" + "</li>";
                            break;
                        case 'winter':
                            activitiesHTML += "<li>" + "<div class='ico'>" + "<img src='" + document.location.origin + "/images/up-arrow.svg' alt='Up arrow icon' width='25' height='25'>" + "<p>" + translationData.winterDescription + "<span class='glyphicon glyphicon-triangle-bottom'></span>" + "</p>" + "</div>" + "</li>";
                            break;
                    }
                });
                activitiesHTML += "</ul>" + "</div>" + "<h2>" + "<a href='" + document.location.origin + "/activity/" + value.id + "'>" + value.name + "</a>" + "</h2>" + "<p>" + value.short_description + "</p>" + "<p>" + "<strong class='price'>" + "<span>" + translationData.textFrom + "</span>" + "<sub>$</sub>" + value.offers_min_price + "</strong>" + "<a href='" + document.location.origin + "/activity/" + value.id + "' class='btn-primary'>" + translationData.buttonText + "</a>" + "</p>" + "</div>" + "</div>";
                ++keyFor3Col;
                ++keyFor4Col;
                if (keyFor3Col === 3) {
                    activitiesHTML += '<div class="clearfix visible-sm-block"></div>';
                    keyFor3Col = 0;
                }
                if (keyFor4Col === 4) {
                    activitiesHTML += '<div class="clearfix visible-lg-block"></div>' + '<div class="clearfix visible-md-block"></div>';
                    keyFor4Col = 0;
                }
            });
            activitiesHTML += "</div>" + "</section>";
        });
        allActivities.html(activitiesHTML);
        if (data.length == 0) {
            allActivities.html("<h2> Sorry there are no activities </h2>");
        }
    }
});

/***/ }),
/* 7 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 8 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 9 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 10 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 11 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 12 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 13 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 14 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 15 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 16 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 17 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 18 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 19 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 20 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);