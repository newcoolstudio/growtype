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

/***/ "./web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-login.js":
/*!***********************************************************************************!*\
  !*** ./web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-login.js ***!
  \***********************************************************************************/
/***/ (function() {

eval("(function ($) {\n  if (window.location.hash.length > 0) {\n    if (window.location.hash === $('.u-column1 .e-register').attr('href')) {\n      $('.u-column1').hide();\n      $('.u-column2').fadeIn();\n    }\n  }\n\n  $('.e-switchform').click(function () {\n    if ($(this).closest('.u-column1').length > 0) {\n      $(this).closest('.u-column1').fadeOut(function () {\n        $('.u-column2').fadeIn();\n      });\n    } else {\n      $(this).closest('.u-column2').fadeOut(function () {\n        $('.u-column1').fadeIn();\n      });\n    }\n  });\n})(jQuery);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9zYWdlLy4vd2ViL2FwcC90aGVtZXMvZ3Jvd3R5cGUvcmVzb3VyY2VzL3NjcmlwdHMvcGx1Z2lucy93b29jb21tZXJjZS93Yy1sb2dpbi5qcz8yNjAyIl0sIm5hbWVzIjpbIiQiLCJ3aW5kb3ciLCJsb2NhdGlvbiIsImhhc2giLCJsZW5ndGgiLCJhdHRyIiwiaGlkZSIsImZhZGVJbiIsImNsaWNrIiwiY2xvc2VzdCIsImZhZGVPdXQiLCJqUXVlcnkiXSwibWFwcGluZ3MiOiJBQUFBLENBQUMsVUFBVUEsQ0FBVixFQUFhO0FBRVYsTUFBSUMsTUFBTSxDQUFDQyxRQUFQLENBQWdCQyxJQUFoQixDQUFxQkMsTUFBckIsR0FBOEIsQ0FBbEMsRUFBcUM7QUFDakMsUUFBSUgsTUFBTSxDQUFDQyxRQUFQLENBQWdCQyxJQUFoQixLQUF5QkgsQ0FBQyxDQUFDLHdCQUFELENBQUQsQ0FBNEJLLElBQTVCLENBQWlDLE1BQWpDLENBQTdCLEVBQXVFO0FBQ25FTCxNQUFBQSxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCTSxJQUFoQjtBQUNBTixNQUFBQSxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCTyxNQUFoQjtBQUNIO0FBQ0o7O0FBRURQLEVBQUFBLENBQUMsQ0FBQyxlQUFELENBQUQsQ0FBbUJRLEtBQW5CLENBQXlCLFlBQVk7QUFDakMsUUFBSVIsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRUyxPQUFSLENBQWdCLFlBQWhCLEVBQThCTCxNQUE5QixHQUF1QyxDQUEzQyxFQUE4QztBQUMxQ0osTUFBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRUyxPQUFSLENBQWdCLFlBQWhCLEVBQThCQyxPQUE5QixDQUFzQyxZQUFZO0FBQzlDVixRQUFBQSxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCTyxNQUFoQjtBQUNILE9BRkQ7QUFHSCxLQUpELE1BSU87QUFDSFAsTUFBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRUyxPQUFSLENBQWdCLFlBQWhCLEVBQThCQyxPQUE5QixDQUFzQyxZQUFZO0FBQzlDVixRQUFBQSxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCTyxNQUFoQjtBQUNILE9BRkQ7QUFHSDtBQUNKLEdBVkQ7QUFZSCxDQXJCRCxFQXFCR0ksTUFyQkgiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24gKCQpIHtcblxuICAgIGlmICh3aW5kb3cubG9jYXRpb24uaGFzaC5sZW5ndGggPiAwKSB7XG4gICAgICAgIGlmICh3aW5kb3cubG9jYXRpb24uaGFzaCA9PT0gJCgnLnUtY29sdW1uMSAuZS1yZWdpc3RlcicpLmF0dHIoJ2hyZWYnKSkge1xuICAgICAgICAgICAgJCgnLnUtY29sdW1uMScpLmhpZGUoKTtcbiAgICAgICAgICAgICQoJy51LWNvbHVtbjInKS5mYWRlSW4oKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgICQoJy5lLXN3aXRjaGZvcm0nKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgICAgIGlmICgkKHRoaXMpLmNsb3Nlc3QoJy51LWNvbHVtbjEnKS5sZW5ndGggPiAwKSB7XG4gICAgICAgICAgICAkKHRoaXMpLmNsb3Nlc3QoJy51LWNvbHVtbjEnKS5mYWRlT3V0KGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAkKCcudS1jb2x1bW4yJykuZmFkZUluKCk7XG4gICAgICAgICAgICB9KVxuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgJCh0aGlzKS5jbG9zZXN0KCcudS1jb2x1bW4yJykuZmFkZU91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgJCgnLnUtY29sdW1uMScpLmZhZGVJbigpO1xuICAgICAgICAgICAgfSlcbiAgICAgICAgfVxuICAgIH0pO1xuXG59KShqUXVlcnkpO1xuIl0sImZpbGUiOiIuL3dlYi9hcHAvdGhlbWVzL2dyb3d0eXBlL3Jlc291cmNlcy9zY3JpcHRzL3BsdWdpbnMvd29vY29tbWVyY2Uvd2MtbG9naW4uanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-login.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./web/app/themes/growtype/resources/scripts/plugins/woocommerce/wc-login.js"]();
/******/ 	
/******/ })()
;