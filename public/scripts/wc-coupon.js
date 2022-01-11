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

/***/ "../growtype/web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js":
/*!**********************************************************************************************!*\
  !*** ../growtype/web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js ***!
  \**********************************************************************************************/
/***/ (function() {

eval("(function ($) {\n  \"use strict\";\n\n  function applyCoupon() {\n    $('.e-discount-trigger').click(function () {\n      $(this).fadeOut(function () {\n        $('.b-coupon').fadeIn();\n      });\n    });\n  }\n\n  applyCoupon();\n  $(\"body\").on('applied_coupon', function (event, coupon) {\n    setTimeout(function () {\n      applyCoupon();\n    }, 1000);\n  });\n  $(\"body\").on('updated_cart_totals', function () {\n    applyCoupon();\n  });\n})(jQuery);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9zYWdlLy4uL2dyb3d0eXBlL3dlYi9hcHAvdGhlbWVzL2dyb3d0eXBlL3Jlc291cmNlcy9zY3JpcHRzL3BsdWdpbnMvd29vY29tbWVyY2Uvd2MtY291cG9uLmpzPzRmODciXSwibmFtZXMiOlsiJCIsImFwcGx5Q291cG9uIiwiY2xpY2siLCJmYWRlT3V0IiwiZmFkZUluIiwib24iLCJldmVudCIsImNvdXBvbiIsInNldFRpbWVvdXQiLCJqUXVlcnkiXSwibWFwcGluZ3MiOiJBQUFBLENBQUMsVUFBU0EsQ0FBVCxFQUFZO0FBQ1Q7O0FBQ0EsV0FBU0MsV0FBVCxHQUF1QjtBQUNuQkQsSUFBQUEsQ0FBQyxDQUFDLHFCQUFELENBQUQsQ0FBeUJFLEtBQXpCLENBQStCLFlBQVk7QUFDdkNGLE1BQUFBLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUUcsT0FBUixDQUFnQixZQUFZO0FBQ3hCSCxRQUFBQSxDQUFDLENBQUMsV0FBRCxDQUFELENBQWVJLE1BQWY7QUFDSCxPQUZEO0FBR0gsS0FKRDtBQUtIOztBQUVESCxFQUFBQSxXQUFXO0FBRVhELEVBQUFBLENBQUMsQ0FBQyxNQUFELENBQUQsQ0FBVUssRUFBVixDQUFhLGdCQUFiLEVBQStCLFVBQVVDLEtBQVYsRUFBaUJDLE1BQWpCLEVBQXlCO0FBQ3BEQyxJQUFBQSxVQUFVLENBQUMsWUFBWTtBQUNuQlAsTUFBQUEsV0FBVztBQUNkLEtBRlMsRUFFUCxJQUZPLENBQVY7QUFHSCxHQUpEO0FBTUFELEVBQUFBLENBQUMsQ0FBQyxNQUFELENBQUQsQ0FBVUssRUFBVixDQUFhLHFCQUFiLEVBQW9DLFlBQVk7QUFDNUNKLElBQUFBLFdBQVc7QUFDZCxHQUZEO0FBR0gsQ0FyQkQsRUFxQkdRLE1BckJIIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCQpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcbiAgICBmdW5jdGlvbiBhcHBseUNvdXBvbigpIHtcbiAgICAgICAgJCgnLmUtZGlzY291bnQtdHJpZ2dlcicpLmNsaWNrKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICQodGhpcykuZmFkZU91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgJCgnLmItY291cG9uJykuZmFkZUluKCk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgYXBwbHlDb3Vwb24oKTtcblxuICAgICQoXCJib2R5XCIpLm9uKCdhcHBsaWVkX2NvdXBvbicsIGZ1bmN0aW9uIChldmVudCwgY291cG9uKSB7XG4gICAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgYXBwbHlDb3Vwb24oKTtcbiAgICAgICAgfSwgMTAwMClcbiAgICB9KTtcblxuICAgICQoXCJib2R5XCIpLm9uKCd1cGRhdGVkX2NhcnRfdG90YWxzJywgZnVuY3Rpb24gKCkge1xuICAgICAgICBhcHBseUNvdXBvbigpO1xuICAgIH0pO1xufSkoalF1ZXJ5KTtcbiJdLCJmaWxlIjoiLi4vZ3Jvd3R5cGUvd2ViL2FwcC90aGVtZXMvZ3Jvd3R5cGUvcmVzb3VyY2VzL3NjcmlwdHMvcGx1Z2lucy93b29jb21tZXJjZS93Yy1jb3Vwb24uanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///../growtype/web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["../growtype/web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js"]();
/******/ 	
/******/ })()
;