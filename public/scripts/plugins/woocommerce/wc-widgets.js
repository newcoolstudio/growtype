/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/scripts/plugins/woocommerce/widgets/categories.js":
/*!*********************************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/widgets/categories.js ***!
  \*********************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "categories": function() { return /* binding */ categories; }
/* harmony export */ });
/* harmony import */ var _util_update_url_parameter__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../util/update-url-parameter */ "./resources/scripts/util/update-url-parameter.js");
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }



function categories() {
  var filterProductsByCategories = new Event('filterProductsByCategories'); // document.addEventListener('filterProductsByPrice', widgetCategoriesInit)
  // document.addEventListener('filterProductsByOrder', widgetCategoriesInit)

  widgetCategoriesInit();
  /**
   *
   */

  function widgetCategoriesInit() {
    if ($('.product-categories[data-multiple="true"]').length > 0) {
      var currentCategoriesIds = getCurrentCategoriesIds();

      if (currentCategoriesIds.length > 0) {
        currentCategoriesIds.map(function (id) {
          $('.product-categories .cat-item-' + id).addClass('current-cat');
        });
        getFilteredProductsByCategory(currentCategoriesIds);
      }
      /**
       * Cat click
       */


      $('.product-categories[data-multiple="true"] a').click(function (e) {
        e.preventDefault();
        var parent = $(this).closest('.cat-item');
        var classes = parent.attr('class').split(' ');
        var catId = null;
        var currentCategoriesIds = [];
        var newCategoriesIds = [];
        /**
         * Disable parent
         */

        if ($('.product-categories[data-multiple-include-parent="true"]').length === 0) {
          if (parent.hasClass('cat-parent')) {
            return false;
          }
        }
        /**
         * Get categories
         */


        if (classes.length >= 2) {
          catId = classes[1];
          catId = catId.split("cat-item-").pop();
        }
        /**
         * If no categories found, redirect
         */


        if (catId === null) {
          window.redirect($(this).attr('href'));
        }

        currentCategoriesIds = getCurrentCategoriesIds();
        newCategoriesIds = getCurrentCategoriesIds();
        /**
         * Update categories with new ids
         */

        if (parent.hasClass('current-cat')) {
          parent.removeClass('current-cat');
          var index = newCategoriesIds.indexOf(catId);

          if (index !== -1) {
            newCategoriesIds.splice(index, 1);
          }
        } else {
          parent.addClass('current-cat');
          newCategoriesIds.push(catId);
        }

        updateSearchUrl(currentCategoriesIds, newCategoriesIds);
        getFilteredProductsByCategory(newCategoriesIds);
      });
      /**
       * Clear selections
       */

      $('.btn-clear-cat-filter').click(function () {
        var currentCategoriesIds = getCurrentCategoriesIds();

        if (currentCategoriesIds.length > 0) {
          updateSearchUrl(currentCategoriesIds);
          getFilteredProductsByCategory();
          $('.product-categories .cat-item').removeClass('current-cat');
        }
      });
    }
  }
  /**
   * @param categoriesIds
   */


  function getFilteredProductsByCategory() {
    var categoriesIds = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
    woocommerce_params_widgets.categories_ids = categoriesIds;
    $.ajax({
      url: woocommerce_params.ajax_url,
      type: "post",
      data: {
        orderby: woocommerce_params_widgets.orderby,
        action: 'filter_products',
        categories_ids: categoriesIds
      },
      beforeSend: function beforeSend() {
        $('.products').addClass('is-loading');
      },
      success: function success(data) {
        $('.products').removeClass('is-loading').html("").append(data).promise().done(function () {// document.dispatchEvent(filterProductsByOrderEvent);
        });
      }
    });
  }
  /**
   * Update url
   */


  function updateSearchUrl() {
    var currentCategoriesIds = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
    var newCategoriesIds = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
    var currentUrl = window.location.href;
    var newUrl = null;

    if (newCategoriesIds.length > 0) {
      if (currentUrl.includes("categories")) {
        newUrl = currentUrl.replace("categories=" + currentCategoriesIds.toString(), "categories=" + newCategoriesIds.toString());
      } else if (window.location.search.length > 0) {
        newUrl = currentUrl + '&categories=' + newCategoriesIds.toString() + '';
      } else {
        newUrl = currentUrl + '?categories=' + newCategoriesIds.toString() + '';
      }
    } else {
      newUrl = currentUrl.replace("&categories=" + currentCategoriesIds.toString(), "").replace("?categories=" + currentCategoriesIds.toString() + '&', "?").replace("?categories=" + currentCategoriesIds.toString(), "");
    }

    if (newUrl.length > 0) {
      window.history.pushState('page-url', 'url', newUrl);
    }
  }
  /**
   * Get categories ids
   */


  function getCurrentCategoriesIds() {
    var currentUrl = window.location.href;
    var site = new URL(currentUrl);
    var params = new URLSearchParams(site.search);
    var currentCategoriesIds = [];

    var _iterator = _createForOfIteratorHelper(params),
        _step;

    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var param = _step.value;

        if (param[0].length > 0 && param[0] === 'categories') {
          currentCategoriesIds = param[1].split(",");
        }
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }

    return currentCategoriesIds;
  }
}



/***/ }),

/***/ "./resources/scripts/plugins/woocommerce/widgets/price.js":
/*!****************************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/widgets/price.js ***!
  \****************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "price": function() { return /* binding */ price; }
/* harmony export */ });
function price() {
  var filterProductsByPriceEvent = new Event('filterProductsByPrice');
  var price_values = 0;
  $(".price_slider").on("slidestart", function (event, ui) {
    price_values = ui.values;
  });
  $(".price_slider").on("slidestop", function (event, ui) {
    if (JSON.stringify(price_values) == JSON.stringify(ui.values)) {
      return false;
    }

    var filter = $('.widget_price_filter form');
    var existing_products = $('body').find('.products');
    var existing_main = $('body').find('.site-main');
    $.ajax({
      url: filter.attr('action'),
      data: filter.serialize(),
      // form data
      type: filter.attr('method'),
      // POST
      beforeSend: function beforeSend(xhr) {
        existing_products.addClass('is-loading');
      },
      success: function success(data) {
        var filtered_products = $(data).find('.products');
        var filtered_main = $(data).find('.site-main');
        window.history.pushState('page-url', 'url', filter.attr('action') + '?' + filter.serialize());
        $('.woocommerce-info').remove();

        if (filtered_products.html().length === 1) {
          $('.site-main').prepend($(data).find('.woocommerce-info'));
        }

        existing_main.replaceWith(filtered_main);
        document.dispatchEvent(filterProductsByPriceEvent);
      }
    });
  });
}



/***/ }),

/***/ "./resources/scripts/plugins/woocommerce/widgets/sorting.js":
/*!******************************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/widgets/sorting.js ***!
  \******************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "sorting": function() { return /* binding */ sorting; }
/* harmony export */ });
/* harmony import */ var _util_update_url_parameter__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../util/update-url-parameter */ "./resources/scripts/util/update-url-parameter.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }



function sorting() {
  var filterProductsByOrderEvent = new Event('filterProductsByOrder');
  document.addEventListener('filterProductsByPrice', widgetOrderInit);
  document.addEventListener('filterProductsByCategories', widgetOrderInit);

  function widgetOrderInit() {
    $('.woocommerce-ordering').submit(function (e) {
      e.preventDefault();
    });
    /**
     * Initiate select
     */

    $('.woocommerce-ordering select').change(function (e) {
      var orderby = $(this).val();
      var categoryId = '';
      var orderingName = $(this).attr('name');
      var orderingValue = $(this).val();

      if (_typeof($('body')[0]) !== undefined && $('body')[0].className.match(/term-\d+/) !== null) {
        categoryId = $('body')[0].className.match(/term-\d+/)[0];
        categoryId = categoryId.replace("term-", "");
      }

      window.history.replaceState('', '', (0,_util_update_url_parameter__WEBPACK_IMPORTED_MODULE_0__["default"])(window.location.href, orderingName, orderingValue));
      $('.woocommerce-pagination .page-numbers').each(function (index, element) {
        if (typeof $(element).attr('href') !== 'undefined') {
          var regex = new RegExp('(' + orderingName + '=)[^\&]+');
          $(element).attr('href', $(element).attr('href').replace(regex, '$1' + orderingValue));
        }
      });

      if (window.location.pathname.includes("/page/")) {
        window.location = $('a.page-numbers').first().attr('href');
        return false;
      }
      /**
       * Set current orderby value
       */


      woocommerce_params_widgets.orderby = orderby;

      if (categoryId.length > 0) {
        woocommerce_params_widgets.categories_ids = [categoryId];
      }
      /**
       * Get products
       */


      $.ajax({
        url: woocommerce_params.ajax_url,
        type: "post",
        data: {
          orderby: woocommerce_params_widgets.orderby,
          action: 'filter_products',
          categories_ids: woocommerce_params_widgets.categories_ids
        },
        beforeSend: function beforeSend() {
          $('.products').addClass('is-loading');
        },
        success: function success(data) {
          $('.products').removeClass('is-loading').html("").append(data).promise().done(function () {
            document.dispatchEvent(filterProductsByOrderEvent);
          });
        }
      });
    });
  }

  widgetOrderInit();
}



/***/ }),

/***/ "./resources/scripts/util/update-url-parameter.js":
/*!********************************************************!*\
  !*** ./resources/scripts/util/update-url-parameter.js ***!
  \********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ updateURLParameter; }
/* harmony export */ });
function updateURLParameter(url, param, paramVal) {
  var TheAnchor = null;
  var newAdditionalURL = "";
  var tempArray = url.split("?");
  var baseURL = tempArray[0];
  var additionalURL = tempArray[1];
  var temp = "";

  if (additionalURL) {
    var tmpAnchor = additionalURL.split("#");
    var TheParams = tmpAnchor[0];
    TheAnchor = tmpAnchor[1];
    if (TheAnchor) additionalURL = TheParams;
    tempArray = additionalURL.split("&");

    for (var i = 0; i < tempArray.length; i++) {
      if (tempArray[i].split('=')[0] != param) {
        newAdditionalURL += temp + tempArray[i];
        temp = "&";
      }
    }
  } else {
    var _tmpAnchor = baseURL.split("#");

    var _TheParams = _tmpAnchor[0];
    TheAnchor = _tmpAnchor[1];
    if (_TheParams) baseURL = _TheParams;
  }

  if (TheAnchor) paramVal += "#" + TheAnchor;
  var rows_txt = temp + "" + param + "=" + paramVal;
  return baseURL + "?" + newAdditionalURL + rows_txt;
}

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!*************************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/wc-widgets.js ***!
  \*************************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _widgets_sorting__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./widgets/sorting */ "./resources/scripts/plugins/woocommerce/widgets/sorting.js");
/* harmony import */ var _widgets_price__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./widgets/price */ "./resources/scripts/plugins/woocommerce/widgets/price.js");
/* harmony import */ var _widgets_categories__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./widgets/categories */ "./resources/scripts/plugins/woocommerce/widgets/categories.js");



jQuery(document).ready(function () {
  (0,_widgets_sorting__WEBPACK_IMPORTED_MODULE_0__.sorting)();
  (0,_widgets_price__WEBPACK_IMPORTED_MODULE_1__.price)();
  (0,_widgets_categories__WEBPACK_IMPORTED_MODULE_2__.categories)();
});
}();
/******/ })()
;