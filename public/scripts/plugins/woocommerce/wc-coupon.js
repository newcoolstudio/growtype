/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/wc-coupon.js ***!
  \************************************************************/
(function ($) {
  "use strict";

  function applyCoupon() {
    $('.e-discount-trigger').click(function () {
      $(this).fadeOut(function () {
        $('.b-coupon').fadeIn();
      });
    });
  }

  applyCoupon();
  $("body").on('applied_coupon', function (event, coupon) {
    setTimeout(function () {
      applyCoupon();
    }, 1000);
  });
  $("body").on('updated_cart_totals', function () {
    applyCoupon();
  });
})(jQuery);
/******/ })()
;