/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*********************************************************!*\
  !*** ./resources/scripts/plugins/buddypress/general.js ***!
  \*********************************************************/


(function ($) {
  var body = $('body'),
      profileNav = $('.nav-container .profile-nav'),
      subNav = $('.bp-navs:not(.single-screen-navs) > ul'); // Initiate flex menu on profile nav

  if (profileNav.length) {
    profileNav.flexMenu({
      showOnHover: false,
      cutoff: 0,
      popupClass: "dropdown-menu-right",
      linkText: '<span class="nav-link-text">' + growtype_params.text_more + '<text>',
      showCount: true,
      hOverflow: true
    });
  } // Flex menu for bp navs


  if (subNav.has("li").length) {
    subNav.flexMenu({
      showOnHover: false,
      cutoff: 0,
      popupClass: "dropdown-menu-right",
      linkText: '<i class="uil-ellipsis-h"></i>',
      hOverflow: true,
      shouldApply: function shouldApply() {
        if (subNav.closest('#buddypress').hasClass('bp-dir-vert-nav')) {
          if (window.innerWidth > 991.98) {
            return false;
          } else {
            return true;
          }
        } else {
          return true;
        }
      }
    });
  } // Move bp template notices


  if ($('#item-header .bp-feedback').length) {
    $('#item-header .bp-feedback').prependTo('.profile-col-main').css({
      'margin-top': '0'
    });
  } // Truncate about group text


  if (body.hasClass('groups')) {
    $('.about-group').shorten({
      showChars: 75,
      moreText: growtype_params.text_read_more,
      lessText: growtype_params.text_read_close
    });
  } // Load activity on scroll


  if (body.hasClass('activity') || body.hasClass('group-home')) {
    // Check the window scroll event.
    $(window).scroll(function () {
      // Find the visible "load more" button.
      // since BP does not remove the "load more" button, we need to find the last one that is visible.
      var load_more_btn = $('li.load-more'); // If there is no visible "load more" button, we've reached the last page of the activity stream.
      // If data attribute is set, we already triggered request for ths specific button.

      if (!load_more_btn.get(0) || load_more_btn.data('bpaa-autoloaded')) {
        return;
      } // Find the offset of the button.


      var pos = load_more_btn.offset();
      var offset = pos.top - 50; // 50 px before we reach the button.
      // If the window height+scrollTop is greater than the top offset of the "load more" button,
      // we have scrolled to the button's position. Let us load more activity.

      if ($(window).scrollTop() + $(window).height() > offset) {
        load_more_btn.data('bpaa-autoloaded', 1);
        load_more_btn.find('a')[0].click();
      }
    });
  }
  /**
   * rtmedia
   */


  if ($('#rtmedia-action-update').length > 0) {
    $('.rtmedia-add-media-button').append('<span class="btn">' + growtype_params.text_attach_media + '</span>');
  }
})(jQuery);
/******/ })()
;