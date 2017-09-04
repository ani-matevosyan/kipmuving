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
/******/ 	return __webpack_require__(__webpack_require__.s = 175);
/******/ })
/************************************************************************/
/******/ ({

/***/ 175:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(176);


/***/ }),

/***/ 176:
/***/ (function(module, exports) {

$(document).ready(function () {

	var accessToken = '4884336.ba4c844.7012da712056426bb3a379ca367b7eb0';

	if ($("#instafeed1").length) {
		var feed1 = new Instafeed({
			get: 'tagged',
			tagName: 'pucon',
			target: 'instafeed1',
			accessToken: accessToken,
			template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img style="width: 150px !important; height: 150px !important;" src="{{image}}"/></a></div>',
			limit: 14,
			after: function after() {
				$('#instafeed1 a').click(function (e) {
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
		feed1.run();
	}
	if ($("#instafeed2_1").length) {
		var feed2_1 = new Instafeed({
			get: 'tagged',
			tagName: 'rioturbio',
			target: 'instafeed2_1',
			accessToken: accessToken,
			template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img style="width: 150px !important; height: 150px !important;" src="{{image}}"/></a></div>',
			limit: 5,
			after: function after() {
				$('#instafeed2_1 a').click(function (e) {
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
		feed2_1.run();
	}
	if ($("#instafeed2_2").length) {
		var feed2_2 = new Instafeed({
			get: 'tagged',
			tagName: 'ojosdelcaburgua',
			target: 'instafeed2_2',
			accessToken: accessToken,
			template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img style="width: 150px !important; height: 150px !important;" src="{{image}}"/></a></div>',
			limit: 5,
			after: function after() {
				$('#instafeed2_2 a').click(function (e) {
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
		feed2_2.run();
	};
	if ($("#instafeed2_3").length) {
		var feed2_3 = new Instafeed({
			get: 'tagged',
			tagName: 'saltodelclaro',
			target: 'instafeed2_3',
			accessToken: accessToken,
			template: '<div class="col-md-2 col-sm-3 col-xs-4 in-image"><a href="{{link}}"><img style="width: 150px !important; height: 150px !important;" src="{{image}}"/></a></div>',
			limit: 4,
			after: function after() {
				$('#instafeed2_3 a').click(function (e) {
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
		feed2_3.run();
	}

	if ($("#instafeed4").length) {
		var agencyId = $("#instafeed4").attr("data-instagram-id");
		var feed4 = new Instafeed({
			get: 'user',
			userId: agencyId,
			target: 'instafeed4',
			accessToken: accessToken,
			template: '<div class="col-sm-2 col-xs-3 in-image-agency"><a href="{{link}}"><img style="width: 86px !important; height: 86px !important;" src="{{image}}"/></a></div>',
			limit: 12,
			after: function after() {
				$('#instafeed4 a').click(function (e) {
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
		feed4.run();
	}
});

/***/ })

/******/ });