/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/scripts/plugins/slick-carousel/sliders/cpt.js":
/*!*****************************************************************!*\
  !*** ./resources/scripts/plugins/slick-carousel/sliders/cpt.js ***!
  \*****************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "cptSlider": function() { return /* binding */ cptSlider; }
/* harmony export */ });
function cptSlider() {
  (function ($) {
    $(".is-slider-cpt").slick({
      infinite: true,
      slidesToShow: 2,
      centerMode: false,
      arrows: true,
      // speed: 8000,
      // autoplaySpeed: 0,
      // cssEase: 'linear',
      slidesToScroll: 1,
      // variableWidth: true,
      dots: false,
      autoplay: false,
      responsive: [{
        breakpoint: 768,
        settings: {
          slidesToShow: 1
        }
      }, {
        breakpoint: 408,
        settings: {
          slidesToShow: 1,
          arrows: false,
          dots: true
        }
      }]
    });
  })(jQuery);
}



/***/ }),

/***/ "./resources/scripts/plugins/slick-carousel/sliders/member.js":
/*!********************************************************************!*\
  !*** ./resources/scripts/plugins/slick-carousel/sliders/member.js ***!
  \********************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "memberSlider": function() { return /* binding */ memberSlider; }
/* harmony export */ });
function memberSlider() {
  (function ($) {
    if (window.slickMemberArgs === undefined) {
      var slidesToShow = Number($(".is-slider-member").attr('data-slides-to-show'));
      window.slickMemberArgs = {
        infinite: false,
        slidesToShow: slidesToShow,
        // centerMode: true,
        arrows: true,
        // speed: 8000,
        // autoplaySpeed: 0,
        // cssEase: 'linear',
        slidesToScroll: 1,
        // variableWidth: true,
        dots: false,
        autoplay: false,
        responsive: [{
          breakpoint: 500,
          settings: {
            slidesToShow: 2
          }
        }]
      };
    }

    $(".is-slider-member").slick(window.slickMemberArgs);
  })(jQuery);
}



/***/ }),

/***/ "./resources/scripts/plugins/slick-carousel/sliders/photo.js":
/*!*******************************************************************!*\
  !*** ./resources/scripts/plugins/slick-carousel/sliders/photo.js ***!
  \*******************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "photoSlider": function() { return /* binding */ photoSlider; }
/* harmony export */ });
function photoSlider() {
  (function ($) {
    $('.photoslider').each(function () {
      var slider_settings = {
        infinite: true,
        slidesToShow: 1,
        centerMode: false,
        slidesToScroll: 1,
        accessibility: false,
        arrows: false
      };

      if ($(this).hasClass('has-buttons')) {
        slider_settings.dots = true;
      }

      if ($(this).hasClass('has-arrows')) {
        slider_settings.arrows = true;
      }

      if ($(this).hasClass('photoslider-automatic')) {
        slider_settings.autoplay = true;
        slider_settings.speed = 1000;
        slider_settings.autoplaySpeed = 2000;
      }

      if ($(this).hasClass('photoslider-logos')) {
        slider_settings.slidesToShow = 5;
        slider_settings.dots = false;
        slider_settings.responsive = [{
          breakpoint: 500,
          settings: {
            slidesToShow: 2
          }
        }];
      }

      if ($(this).find('.photoslider-slide').length > 1) {
        $(this).find('.photoslider-inner').slick(slider_settings);
      } else {
        $(this).find('.photoslider-inner').addClass('slick-initialized');
      }
    });
  })(jQuery);
}



/***/ }),

/***/ "./resources/scripts/plugins/slick-carousel/sliders/projects.js":
/*!**********************************************************************!*\
  !*** ./resources/scripts/plugins/slick-carousel/sliders/projects.js ***!
  \**********************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "projectsSlider": function() { return /* binding */ projectsSlider; }
/* harmony export */ });
function projectsSlider() {
  (function ($) {
    $(".is-slider-projects").slick({
      infinite: true,
      slidesToShow: 4,
      centerMode: false,
      arrows: false,
      // speed: 8000,
      // autoplaySpeed: 0,
      // cssEase: 'linear',
      slidesToScroll: 4,
      // variableWidth: true,
      dots: false,
      autoplay: false,
      responsive: [{
        breakpoint: 500,
        settings: {
          slidesToShow: 2
        }
      }]
    });
  })(jQuery);
}



/***/ }),

/***/ "./resources/scripts/plugins/slick-carousel/sliders/testimonials.js":
/*!**************************************************************************!*\
  !*** ./resources/scripts/plugins/slick-carousel/sliders/testimonials.js ***!
  \**************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "testimonialsSlider": function() { return /* binding */ testimonialsSlider; }
/* harmony export */ });
function testimonialsSlider() {
  (function ($) {
    var testimonialSlider = $(".s-testimonials--inner");
    testimonialSlider.slick({
      infinite: true,
      slidesToShow: parseInt(testimonialSlider.closest('.s-testimonials').attr('data-amount')),
      centerMode: false,
      arrows: testimonialSlider.closest('.s-testimonials').attr('data-arrows') ? true : false,
      // speed: 8000,
      // autoplaySpeed: 0,
      // cssEase: 'linear',
      slidesToScroll: 1,
      // variableWidth: true,
      dots: false,
      autoplay: false,
      responsive: [{
        breakpoint: 950,
        settings: {
          slidesToShow: 2
        }
      }, {
        breakpoint: 700,
        settings: {
          slidesToShow: 1
        }
      }]
    });
  })(jQuery);
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
/*!****************************************************************!*\
  !*** ./resources/scripts/plugins/slick-carousel/slick-main.js ***!
  \****************************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _sliders_testimonials_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./sliders/testimonials.js */ "./resources/scripts/plugins/slick-carousel/sliders/testimonials.js");
/* harmony import */ var _sliders_photo_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./sliders/photo.js */ "./resources/scripts/plugins/slick-carousel/sliders/photo.js");
/* harmony import */ var _sliders_projects_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./sliders/projects.js */ "./resources/scripts/plugins/slick-carousel/sliders/projects.js");
/* harmony import */ var _sliders_member_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./sliders/member.js */ "./resources/scripts/plugins/slick-carousel/sliders/member.js");
/* harmony import */ var _sliders_cpt_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./sliders/cpt.js */ "./resources/scripts/plugins/slick-carousel/sliders/cpt.js");





jQuery(document).ready(function () {
  (0,_sliders_testimonials_js__WEBPACK_IMPORTED_MODULE_0__.testimonialsSlider)();
  (0,_sliders_photo_js__WEBPACK_IMPORTED_MODULE_1__.photoSlider)();
  (0,_sliders_projects_js__WEBPACK_IMPORTED_MODULE_2__.projectsSlider)();
  (0,_sliders_member_js__WEBPACK_IMPORTED_MODULE_3__.memberSlider)();
  (0,_sliders_cpt_js__WEBPACK_IMPORTED_MODULE_4__.cptSlider)();
});
}();
/******/ })()
;