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

/***/ "./web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js":
/*!************************************************************************************!*\
  !*** ./web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js ***!
  \************************************************************************************/
/***/ (function() {

eval("(function ($) {\n  \"use strict\";\n\n  function applyCoupon() {\n    $('.e-discount-trigger').click(function () {\n      $(this).fadeOut(function () {\n        $('.b-coupon').fadeIn();\n      });\n    });\n  }\n\n  applyCoupon();\n  $(\"body\").on('applied_coupon', function (event, coupon) {\n    setTimeout(function () {\n      applyCoupon();\n    }, 1000);\n  });\n  $(\"body\").on('updated_cart_totals', function () {\n    applyCoupon();\n  });\n})(jQuery);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9zYWdlLy4vd2ViL2FwcC90aGVtZXMvZ3Jvd3R5cGUvcmVzb3VyY2VzL3NjcmlwdHMvcGx1Z2lucy93b29jb21tZXJjZS93Yy1jb3Vwb24uanM/OWUwNSJdLCJuYW1lcyI6WyIkIiwiYXBwbHlDb3Vwb24iLCJjbGljayIsImZhZGVPdXQiLCJmYWRlSW4iLCJvbiIsImV2ZW50IiwiY291cG9uIiwic2V0VGltZW91dCIsImpRdWVyeSJdLCJtYXBwaW5ncyI6IkFBQUEsQ0FBQyxVQUFTQSxDQUFULEVBQVk7QUFDVDs7QUFDQSxXQUFTQyxXQUFULEdBQXVCO0FBQ25CRCxJQUFBQSxDQUFDLENBQUMscUJBQUQsQ0FBRCxDQUF5QkUsS0FBekIsQ0FBK0IsWUFBWTtBQUN2Q0YsTUFBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRRyxPQUFSLENBQWdCLFlBQVk7QUFDeEJILFFBQUFBLENBQUMsQ0FBQyxXQUFELENBQUQsQ0FBZUksTUFBZjtBQUNILE9BRkQ7QUFHSCxLQUpEO0FBS0g7O0FBRURILEVBQUFBLFdBQVc7QUFFWEQsRUFBQUEsQ0FBQyxDQUFDLE1BQUQsQ0FBRCxDQUFVSyxFQUFWLENBQWEsZ0JBQWIsRUFBK0IsVUFBVUMsS0FBVixFQUFpQkMsTUFBakIsRUFBeUI7QUFDcERDLElBQUFBLFVBQVUsQ0FBQyxZQUFZO0FBQ25CUCxNQUFBQSxXQUFXO0FBQ2QsS0FGUyxFQUVQLElBRk8sQ0FBVjtBQUdILEdBSkQ7QUFNQUQsRUFBQUEsQ0FBQyxDQUFDLE1BQUQsQ0FBRCxDQUFVSyxFQUFWLENBQWEscUJBQWIsRUFBb0MsWUFBWTtBQUM1Q0osSUFBQUEsV0FBVztBQUNkLEdBRkQ7QUFHSCxDQXJCRCxFQXFCR1EsTUFyQkgiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oJCkge1xuICAgIFwidXNlIHN0cmljdFwiO1xuICAgIGZ1bmN0aW9uIGFwcGx5Q291cG9uKCkge1xuICAgICAgICAkKCcuZS1kaXNjb3VudC10cmlnZ2VyJykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJCh0aGlzKS5mYWRlT3V0KGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAkKCcuYi1jb3Vwb24nKS5mYWRlSW4oKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBhcHBseUNvdXBvbigpO1xuXG4gICAgJChcImJvZHlcIikub24oJ2FwcGxpZWRfY291cG9uJywgZnVuY3Rpb24gKGV2ZW50LCBjb3Vwb24pIHtcbiAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBhcHBseUNvdXBvbigpO1xuICAgICAgICB9LCAxMDAwKVxuICAgIH0pO1xuXG4gICAgJChcImJvZHlcIikub24oJ3VwZGF0ZWRfY2FydF90b3RhbHMnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGFwcGx5Q291cG9uKCk7XG4gICAgfSk7XG59KShqUXVlcnkpO1xuIl0sImZpbGUiOiIuL3dlYi9hcHAvdGhlbWVzL2dyb3d0eXBlL3Jlc291cmNlcy9zY3JpcHRzL3BsdWdpbnMvd29vY29tbWVyY2Uvd2MtY291cG9uLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-coupon.js"]();
/******/ 	
/******/ })()
;