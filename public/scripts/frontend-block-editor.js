/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./web/app/themes/growtype/resources/scripts/editor/gutenberg/frontend/blocks/custom/video-cover.js":
/*!**********************************************************************************************************!*\
  !*** ./web/app/themes/growtype/resources/scripts/editor/gutenberg/frontend/blocks/custom/video-cover.js ***!
  \**********************************************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"videoCover\": function() { return /* binding */ videoCover; }\n/* harmony export */ });\nfunction videoCover() {\n  $('.video-cover .wp-block-cover').click(function () {\n    var $this = $(this);\n    setTimeout(function () {\n      $this.fadeOut();\n    }, 500);\n    $this.closest('.video-cover').find('iframe')[0].src += \"&autoplay=1\";\n  });\n}\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi93ZWIvYXBwL3RoZW1lcy9ncm93dHlwZS9yZXNvdXJjZXMvc2NyaXB0cy9lZGl0b3IvZ3V0ZW5iZXJnL2Zyb250ZW5kL2Jsb2Nrcy9jdXN0b20vdmlkZW8tY292ZXIuanMuanMiLCJtYXBwaW5ncyI6Ijs7OztBQUFBLFNBQVNBLFVBQVQsR0FBc0I7QUFDbEJDLEVBQUFBLENBQUMsQ0FBQyw4QkFBRCxDQUFELENBQWtDQyxLQUFsQyxDQUF3QyxZQUFZO0FBQ2hELFFBQUlDLEtBQUssR0FBR0YsQ0FBQyxDQUFDLElBQUQsQ0FBYjtBQUNBRyxJQUFBQSxVQUFVLENBQUMsWUFBWTtBQUNuQkQsTUFBQUEsS0FBSyxDQUFDRSxPQUFOO0FBQ0gsS0FGUyxFQUVQLEdBRk8sQ0FBVjtBQUdBRixJQUFBQSxLQUFLLENBQUNHLE9BQU4sQ0FBYyxjQUFkLEVBQThCQyxJQUE5QixDQUFtQyxRQUFuQyxFQUE2QyxDQUE3QyxFQUFnREMsR0FBaEQsSUFBdUQsYUFBdkQ7QUFDSCxHQU5EO0FBT0giLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9zYWdlLy4vd2ViL2FwcC90aGVtZXMvZ3Jvd3R5cGUvcmVzb3VyY2VzL3NjcmlwdHMvZWRpdG9yL2d1dGVuYmVyZy9mcm9udGVuZC9ibG9ja3MvY3VzdG9tL3ZpZGVvLWNvdmVyLmpzPzhhZmEiXSwic291cmNlc0NvbnRlbnQiOlsiZnVuY3Rpb24gdmlkZW9Db3ZlcigpIHtcbiAgICAkKCcudmlkZW8tY292ZXIgLndwLWJsb2NrLWNvdmVyJykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAgICAgICB2YXIgJHRoaXMgPSAkKHRoaXMpO1xuICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICR0aGlzLmZhZGVPdXQoKTtcbiAgICAgICAgfSwgNTAwKVxuICAgICAgICAkdGhpcy5jbG9zZXN0KCcudmlkZW8tY292ZXInKS5maW5kKCdpZnJhbWUnKVswXS5zcmMgKz0gXCImYXV0b3BsYXk9MVwiO1xuICAgIH0pXG59XG5cbmV4cG9ydCB7dmlkZW9Db3Zlcn07XG4iXSwibmFtZXMiOlsidmlkZW9Db3ZlciIsIiQiLCJjbGljayIsIiR0aGlzIiwic2V0VGltZW91dCIsImZhZGVPdXQiLCJjbG9zZXN0IiwiZmluZCIsInNyYyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./web/app/themes/growtype/resources/scripts/editor/gutenberg/frontend/blocks/custom/video-cover.js\n");

/***/ }),

/***/ "./web/app/themes/growtype/resources/scripts/editor/gutenberg/frontend/main.js":
/*!*************************************************************************************!*\
  !*** ./web/app/themes/growtype/resources/scripts/editor/gutenberg/frontend/main.js ***!
  \*************************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": function() { return /* binding */ editorFrontend; }\n/* harmony export */ });\n/* harmony import */ var _blocks_custom_video_cover__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./blocks/custom/video-cover */ \"./web/app/themes/growtype/resources/scripts/editor/gutenberg/frontend/blocks/custom/video-cover.js\");\n\nfunction editorFrontend() {\n  (0,_blocks_custom_video_cover__WEBPACK_IMPORTED_MODULE_0__.videoCover)();\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi93ZWIvYXBwL3RoZW1lcy9ncm93dHlwZS9yZXNvdXJjZXMvc2NyaXB0cy9lZGl0b3IvZ3V0ZW5iZXJnL2Zyb250ZW5kL21haW4uanMuanMiLCJtYXBwaW5ncyI6Ijs7Ozs7QUFBQTtBQUVlLFNBQVNDLGNBQVQsR0FBMEI7QUFDckNELEVBQUFBLHNFQUFVO0FBQ2IiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9zYWdlLy4vd2ViL2FwcC90aGVtZXMvZ3Jvd3R5cGUvcmVzb3VyY2VzL3NjcmlwdHMvZWRpdG9yL2d1dGVuYmVyZy9mcm9udGVuZC9tYWluLmpzPzc4MzciXSwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IHt2aWRlb0NvdmVyfSBmcm9tIFwiLi9ibG9ja3MvY3VzdG9tL3ZpZGVvLWNvdmVyXCI7XG5cbmV4cG9ydCBkZWZhdWx0IGZ1bmN0aW9uIGVkaXRvckZyb250ZW5kKCkge1xuICAgIHZpZGVvQ292ZXIoKTtcbn1cbiJdLCJuYW1lcyI6WyJ2aWRlb0NvdmVyIiwiZWRpdG9yRnJvbnRlbmQiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./web/app/themes/growtype/resources/scripts/editor/gutenberg/frontend/main.js\n");

/***/ }),

/***/ "./web/app/themes/growtype/resources/scripts/frontend-block-editor.js":
/*!****************************************************************************!*\
  !*** ./web/app/themes/growtype/resources/scripts/frontend-block-editor.js ***!
  \****************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _editor_gutenberg_frontend_main__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./editor/gutenberg/frontend/main */ \"./web/app/themes/growtype/resources/scripts/editor/gutenberg/frontend/main.js\");\n\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  init: function init() {\n    (0,_editor_gutenberg_frontend_main__WEBPACK_IMPORTED_MODULE_0__.default)();\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi93ZWIvYXBwL3RoZW1lcy9ncm93dHlwZS9yZXNvdXJjZXMvc2NyaXB0cy9mcm9udGVuZC1ibG9jay1lZGl0b3IuanMuanMiLCJtYXBwaW5ncyI6Ijs7QUFBQTtBQUlBLCtEQUFlO0FBQ1hFLEVBQUFBLElBRFcsa0JBQ0o7QUFDSEYsSUFBQUEsd0VBQWM7QUFDakI7QUFIVSxDQUFmIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vc2FnZS8uL3dlYi9hcHAvdGhlbWVzL2dyb3d0eXBlL3Jlc291cmNlcy9zY3JpcHRzL2Zyb250ZW5kLWJsb2NrLWVkaXRvci5qcz9hODI2Il0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCBlZGl0b3JGcm9udGVuZCwge1xuICAgIHZpZGVvQ292ZXIsXG59IGZyb20gXCIuL2VkaXRvci9ndXRlbmJlcmcvZnJvbnRlbmQvbWFpblwiXG5cbmV4cG9ydCBkZWZhdWx0IHtcbiAgICBpbml0KCkge1xuICAgICAgICBlZGl0b3JGcm9udGVuZCgpO1xuICAgIH1cbn07XG4iXSwibmFtZXMiOlsiZWRpdG9yRnJvbnRlbmQiLCJ2aWRlb0NvdmVyIiwiaW5pdCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./web/app/themes/growtype/resources/scripts/frontend-block-editor.js\n");

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
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./web/app/themes/growtype/resources/scripts/frontend-block-editor.js");
/******/ 	
/******/ })()
;