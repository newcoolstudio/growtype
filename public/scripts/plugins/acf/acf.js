/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/scripts/plugins/acf/sections/accordions/horizontal.js":
/*!*************************************************************************!*\
  !*** ./resources/scripts/plugins/acf/sections/accordions/horizontal.js ***!
  \*************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "tabAccordionHorizontal": function() { return /* binding */ tabAccordionHorizontal; }
/* harmony export */ });
function tabAccordionHorizontal() {
  var accordionIsSelected = false;
  $('.b-accordion-horizontal .b-accordion--tab').click(function () {
    if (!accordionIsSelected) {
      if (!$(this).hasClass('is-active')) {
        accordionIsSelected = true;
        var tab_nr = $(this).data('nr');
        $('.b-accordion-horizontal .b-accordion--tab').removeClass('is-active');
        $(this).addClass('is-active');
        $('.b-accordion-horizontal .b-accordion--content').fadeOut().promise().done(function () {
          accordionIsSelected = false;
          $('.b-accordion-horizontal .b-accordion--content').removeClass('is-active');
          $('.b-accordion-horizontal .b-accordion--content[data-nr="' + tab_nr + '"]').fadeIn().addClass('is-active');
        });
      }
    }
  });
}



/***/ }),

/***/ "./resources/scripts/plugins/acf/sections/accordions/vertical.js":
/*!***********************************************************************!*\
  !*** ./resources/scripts/plugins/acf/sections/accordions/vertical.js ***!
  \***********************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "tabAccordionVertical": function() { return /* binding */ tabAccordionVertical; }
/* harmony export */ });
function tabAccordionVertical() {
  $('.b-accordion-vertical .b-accordion--tab').click(function () {
    if (!$(this).hasClass('is-active')) {
      var tab_nr = $(this).data('nr');
      $('.b-accordion-vertical .b-accordion--tab').removeClass('is-active');
      $(this).addClass('is-active');
      $('.b-accordion-vertical .b-accordion--content').slideUp().removeClass('is-active');
      $('.b-accordion-vertical .b-accordion--content[data-nr="' + tab_nr + '"]').slideDown().addClass('is-active');
    } else {
      $('.b-accordion-vertical .b-accordion--tab').removeClass('is-active');
      $('.b-accordion-vertical .b-accordion--content').slideUp().removeClass('is-active');
    }
  });
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
/*!**********************************************!*\
  !*** ./resources/scripts/plugins/acf/acf.js ***!
  \**********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _sections_accordions_vertical_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./sections/accordions/vertical.js */ "./resources/scripts/plugins/acf/sections/accordions/vertical.js");
/* harmony import */ var _sections_accordions_horizontal_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./sections/accordions/horizontal.js */ "./resources/scripts/plugins/acf/sections/accordions/horizontal.js");


jQuery(document).ready(function () {
  (0,_sections_accordions_vertical_js__WEBPACK_IMPORTED_MODULE_0__.tabAccordionVertical)();
  (0,_sections_accordions_horizontal_js__WEBPACK_IMPORTED_MODULE_1__.tabAccordionHorizontal)();
});
}();
/******/ })()
;