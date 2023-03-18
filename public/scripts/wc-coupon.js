/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "../../packages/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js":
/*!*****************************************************************************************!*\
  !*** ../../packages/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js ***!
  \*****************************************************************************************/
/***/ (function() {

eval("(function ($) {\n  \"use strict\";\n\n  function applyCoupon() {\n    $('.e-discount-trigger').click(function () {\n      $(this).fadeOut(function () {\n        $('.b-coupon').fadeIn();\n      });\n    });\n  }\n\n  applyCoupon();\n  $(\"body\").on('applied_coupon', function (event, coupon) {\n    setTimeout(function () {\n      applyCoupon();\n    }, 1000);\n  });\n  $(\"body\").on('updated_cart_totals', function () {\n    applyCoupon();\n  });\n})(jQuery);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9zYWdlLy4uLy4uL3BhY2thZ2VzL3RoZW1lcy9ncm93dHlwZS9yZXNvdXJjZXMvc2NyaXB0cy9wbHVnaW5zL3dvb2NvbW1lcmNlL3djLWNvdXBvbi5qcz9iYmY2Il0sIm5hbWVzIjpbIiQiLCJhcHBseUNvdXBvbiIsImNsaWNrIiwiZmFkZU91dCIsImZhZGVJbiIsIm9uIiwiZXZlbnQiLCJjb3Vwb24iLCJzZXRUaW1lb3V0IiwialF1ZXJ5Il0sIm1hcHBpbmdzIjoiQUFBQSxDQUFDLFVBQVNBLENBQVQsRUFBWTtBQUNUOztBQUNBLFdBQVNDLFdBQVQsR0FBdUI7QUFDbkJELElBQUFBLENBQUMsQ0FBQyxxQkFBRCxDQUFELENBQXlCRSxLQUF6QixDQUErQixZQUFZO0FBQ3ZDRixNQUFBQSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFHLE9BQVIsQ0FBZ0IsWUFBWTtBQUN4QkgsUUFBQUEsQ0FBQyxDQUFDLFdBQUQsQ0FBRCxDQUFlSSxNQUFmO0FBQ0gsT0FGRDtBQUdILEtBSkQ7QUFLSDs7QUFFREgsRUFBQUEsV0FBVztBQUVYRCxFQUFBQSxDQUFDLENBQUMsTUFBRCxDQUFELENBQVVLLEVBQVYsQ0FBYSxnQkFBYixFQUErQixVQUFVQyxLQUFWLEVBQWlCQyxNQUFqQixFQUF5QjtBQUNwREMsSUFBQUEsVUFBVSxDQUFDLFlBQVk7QUFDbkJQLE1BQUFBLFdBQVc7QUFDZCxLQUZTLEVBRVAsSUFGTyxDQUFWO0FBR0gsR0FKRDtBQU1BRCxFQUFBQSxDQUFDLENBQUMsTUFBRCxDQUFELENBQVVLLEVBQVYsQ0FBYSxxQkFBYixFQUFvQyxZQUFZO0FBQzVDSixJQUFBQSxXQUFXO0FBQ2QsR0FGRDtBQUdILENBckJELEVBcUJHUSxNQXJCSCIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigkKSB7XG4gICAgXCJ1c2Ugc3RyaWN0XCI7XG4gICAgZnVuY3Rpb24gYXBwbHlDb3Vwb24oKSB7XG4gICAgICAgICQoJy5lLWRpc2NvdW50LXRyaWdnZXInKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAkKHRoaXMpLmZhZGVPdXQoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICQoJy5iLWNvdXBvbicpLmZhZGVJbigpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIGFwcGx5Q291cG9uKCk7XG5cbiAgICAkKFwiYm9keVwiKS5vbignYXBwbGllZF9jb3Vwb24nLCBmdW5jdGlvbiAoZXZlbnQsIGNvdXBvbikge1xuICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGFwcGx5Q291cG9uKCk7XG4gICAgICAgIH0sIDEwMDApXG4gICAgfSk7XG5cbiAgICAkKFwiYm9keVwiKS5vbigndXBkYXRlZF9jYXJ0X3RvdGFscycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgYXBwbHlDb3Vwb24oKTtcbiAgICB9KTtcbn0pKGpRdWVyeSk7XG4iXSwiZmlsZSI6Ii4uLy4uL3BhY2thZ2VzL3RoZW1lcy9ncm93dHlwZS9yZXNvdXJjZXMvc2NyaXB0cy9wbHVnaW5zL3dvb2NvbW1lcmNlL3djLWNvdXBvbi5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///../../packages/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["../../packages/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js"]();
/******/ 	
/******/ })()
;