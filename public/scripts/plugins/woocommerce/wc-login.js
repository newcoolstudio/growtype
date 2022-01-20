/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/wc-login.js ***!
  \***********************************************************/
(function ($) {
  if (window.location.hash.length > 0) {
    if (window.location.hash === $('.u-column1 .e-register').attr('href')) {
      $('.u-column1').hide();
      $('.u-column2').fadeIn();
    }
  }

  $('.e-switchform').click(function () {
    if ($(this).closest('.u-column1').length > 0) {
      $(this).closest('.u-column1').fadeOut(function () {
        $('.u-column2').fadeIn();
      });
    } else {
      $(this).closest('.u-column2').fadeOut(function () {
        $('.u-column1').fadeIn();
      });
    }
  });
})(jQuery);
/******/ })()
;