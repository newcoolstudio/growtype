/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/scripts/plugins/chosen/select-cart.js":
/*!*********************************************************!*\
  !*** ./resources/scripts/plugins/chosen/select-cart.js ***!
  \*********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "selectCart": function() { return /* binding */ selectCart; }
/* harmony export */ });
function selectCart() {
  (function ($) {
    window.cartSelect = $('.cart select');
    window.selectCartArgs = {
      disable_search_threshold: 20
    };

    if (window.cartSelect.length > 0) {
      window.cartSelect.chosen(window.selectCartArgs);
    }
  })(jQuery);
}



/***/ }),

/***/ "./resources/scripts/plugins/woocommerce/components/input-quantity.js":
/*!****************************************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/components/input-quantity.js ***!
  \****************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "inputQuantity": function() { return /* binding */ inputQuantity; }
/* harmony export */ });
function inputQuantity() {
  function changeInputQuantityWithArrows() {
    $('.quantity .btn').click(function () {
      var currentQuantityInput = $(this).closest('.quantity').find('input[type="number"]');
      var currentQuantity = currentQuantityInput.val().length > 0 ? currentQuantityInput.val() : 0;
      var currentQuantityInputMax = currentQuantityInput.attr('max');
      var currentQuantityInputMin = currentQuantityInput.attr('min');

      if ($(this).hasClass('btn-down')) {
        if (currentQuantityInputMin.length > 0 && currentQuantity <= currentQuantityInputMin) {
          return false;
        }

        if (currentQuantity > 0) {
          currentQuantity = parseInt(currentQuantity) - 1;
        }
      } else if ($(this).hasClass('btn-up')) {
        if (currentQuantityInputMax.length > 0 && currentQuantity >= currentQuantityInputMax) {
          return false;
        }

        currentQuantity = parseInt(currentQuantity) + 1;
      }

      currentQuantityInput.val(currentQuantity);
      currentQuantityInput.change();
    });
  }

  changeInputQuantityWithArrows();
  $(document.body).on('updated_cart_totals', function () {
    changeInputQuantityWithArrows();
  });
}



/***/ }),

/***/ "./resources/scripts/plugins/woocommerce/components/radio-variation.js":
/*!*****************************************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/components/radio-variation.js ***!
  \*****************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "radioVariation": function() { return /* binding */ radioVariation; }
/* harmony export */ });
function radioVariation() {
  jQuery(document).ready(function ($) {
    if ($('body').hasClass('single-product')) {
      var update_price = function update_price(variation) {
        if (variation['price_html'].length > 0) {
          $('.product .summary .price').replaceWith(variation['price_html']);
          $('.product .summary .price').show();
        }
      };

      var find_matching_variations = function find_matching_variations(product_variations, attribute_name, value) {
        var matching = [];
        product_variations.map(function (variation) {
          if (variation.attributes[attribute_name] === value) {
            matching.push(variation);
          }
        });
        return matching;
      };

      var set_featured_image = function set_featured_image(variation) {
        var thumbnailExists = false;

        if ($('.flex-control-nav li img').length > 0) {
          $('.flex-control-nav li img').each(function (index, element) {
            if ($(element).attr('src') === variation['image']['gallery_thumbnail_src']) {
              thumbnailExists = true;
              $(element).trigger('click');
              return false;
            }
          });
        }
      };

      var find_matching_attributes = function find_matching_attributes(product_variations, main_attribute) {
        $('.variation-child input[type="radio"]').prop('checked', false).closest('.option').removeClass('is-active');

        if (window.cartSelect !== undefined && window.cartSelect.length > 0) {
          $('.variations_form button[type="submit"]').attr('disabled', true);
          $('.variations-single select option').prop("disabled", true);
          product_variations.map(function (variation) {
            window.cartSelect.map(function (index, select) {
              $('#' + $(select).attr('id') + ' option[value="' + variation.attributes['attribute_' + $(select).attr('id')] + '"]').prop("disabled", false);
            });
          });
          $('.variations-single select').val('').trigger("chosen:updated");
        }
      };

      /**
       * Check if enabled
       */
      if ($('.single-product').find('.options[data-type="radio"]').length === 0) {
        return false;
      }

      var variation_form = $('.variations_form.cart');
      var product_id = variation_form.data('product_id');
      window.product_variations = window['product_variations_' + product_id + ''];

      if (typeof window.product_variations === 'undefined' || window.product_variations === false) {
        return false;
      }
      /**
       * If more then one selection group
       */


      if ($('.cart .variations .variations-single').length > 1) {
        $('.variations_form button[type="submit"]').attr('disabled', true);
      } else {
        setTimeout(function () {
          $('.variations_form button[type="submit"]').removeClass('disabled').removeClass('wc-variation-selection-needed').attr('disabled', false);
        }, 100);
      }

      window.selected_variations = find_matching_variations(window.product_variations, $('.variations .variations-single:first input[type="radio"]:checked').attr('name'), $('.variations .variations-single:first input[type="radio"]:checked').data('category'));
      var price_html = window.selected_variations.length > 0 ? window.selected_variations[0]['price_html'] : '';
      /**
       * Set firs variation as active
       */

      $('.variations .options .option:first').addClass('is-active');
      find_matching_attributes(window.selected_variations, $('.variations .variations-single:first input[type="radio"]:checked'));

      if (window.selected_variations.length > 0 && screen.width > 1024) {
        setTimeout(function () {
          set_featured_image(window.selected_variations[0]);
        }, 100);
      }

      if (price_html.length > 0) {
        update_price(window.selected_variations[0]);
      }

      variation_form.find('.variation_id').val($('.variations input[type="radio"]:checked').val());
      $('.product .summary .price').show();
      $('.variations input[type="radio"]').change(function () {
        console.log('change');
        window.selected_variations = find_matching_variations(window.product_variations, $(this).attr('name'), $(this).data('category'));
        $(this).closest('.options').find('.option').removeClass('is-active');
        $(this).closest('.option').addClass('is-active');
        $(this).closest('.variations-single').find('.label .e-name').html($(this).data('term-name'));

        if (window.selected_variations.length === 0) {
          return false;
        }

        set_featured_image(window.selected_variations[0]);

        if (window.selected_variations[0]['price_html'].length > 0) {
          update_price(window.selected_variations[0]);
        }

        $('.product .summary .price').show();

        if ($('.variations').attr('data-variations-amount') > '1' && $(this).closest('.variations-single').hasClass('variation-parent')) {
          find_matching_attributes(window.selected_variations, $('.variations .variations-single:first input[type="radio"]:checked'));
        }

        variation_form.find('.variation_id').val($(this).val());
      });
    }
  });
}



/***/ }),

/***/ "./resources/scripts/plugins/woocommerce/components/select-variation.js":
/*!******************************************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/components/select-variation.js ***!
  \******************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "selectVariation": function() { return /* binding */ selectVariation; }
/* harmony export */ });
function selectVariation() {
  jQuery(document).ready(function ($) {
    if ($('body').hasClass('single-product')) {
      /**
       * Update frontend product price
       */
      var update_price = function update_price(variation) {
        if (variation['price_html'].length > 0) {
          $('.product .summary .price').replaceWith(variation['price_html']);
          $('.product .summary .price').show();
        }
      };
      /**
       * Update frontend product description
       */


      var update_description = function update_description(variation) {
        if (variation['variation_description'].length > 0) {
          $('.variations-single-description .variations-single-description-content').html(variation['variation_description']).closest('.variations-single-description').fadeIn();
        } else {
          $('.variations-single-description .variations-single-description-content').html('').closest('.variations-single-description').fadeOut();
        }
      };

      var set_featured_image = function set_featured_image(variation) {
        var thumbnailExists = false;

        if ($('.flex-control-nav img').length > 0) {
          $('.flex-control-nav img').each(function (index, element) {
            if ($(element).attr('src') === variation['image']['gallery_thumbnail_src']) {
              thumbnailExists = true;
              $(element).trigger('click');
            }
          });
        }
      };

      var find_matching_variation = function find_matching_variation(product_variations, element_id, value) {
        var matching = [];

        for (var i = 0; i < product_variations.length; i++) {
          var variation = product_variations[i];

          if (variation['attributes']['attribute_' + element_id] == value) {
            matching.push(variation);
          }
        }

        return matching;
      };

      /**
       * Check if enabled
       */
      if ($('.single-product').find('.options[data-type="radio"]').length === 1) {
        return false;
      }

      var variation_form = $('.variations_form.cart');
      var product_id = variation_form.data('product_id');
      window.product_variations = window['product_variations_' + product_id + ''];

      if (typeof window.product_variations === 'undefined' || window.product_variations === false) {
        return false;
      }

      var first_select = $('.variations .options select').first();
      $('.variations .variations-single:first .options select option').map(function (index, element) {
        if ($(element).val().length === 0) {
          $(element).prop("disabled", true);
        }
      });

      if (window.cartSelect !== undefined) {
        window.cartSelect.change(function (e) {
          $('.variations_form button[type="submit"]').attr('disabled', true);

          if ($('.variation-parent input[type="radio"]:checked').length > 0) {
            window.selected_variation_final = find_matching_variation(window.selected_variations, $(e.target).attr('id'), $(e.target).find(':selected').val());
          } else {
            window.selected_variations = find_matching_variation(window.product_variations, $(e.target).attr('id'), $(e.target).find(':selected').val());
          }

          if (window.selected_variations.length <= 0) {
            return false;
          }

          var all_previous_selected = true;

          if (typeof window.selected_variations !== 'undefined') {
            window.cartSelect.each(function (index, element) {
              if ($(e.target).attr('id') === first_select.attr('id')) {
                window.variation = [];
                Object.keys(window.selected_variations[0].attributes).map(function (item) {
                  if (item !== 'attribute_' + first_select.attr('id')) {
                    window.cartSelect.each(function (index, parent) {
                      if (item === 'attribute_' + $(parent).attr('id')) {
                        $('#' + $(parent).attr('id') + ' option').prop("disabled", true);
                        $(parent).val('').chosen(window.selectArgs);
                        window.selected_variations.map(function (child) {
                          window.variation.push(child);
                          $('#' + $(parent).attr('id') + ' option[value=' + child.attributes[item] + ']').prop("disabled", false);
                        });
                      }
                    });
                  }
                });
              }

              if ($(element).val() === null) {
                $('.variations-single[data-type="' + $(element).attr('id') + '"]').find('.chosen-container').addClass('is-shaking');
                setTimeout(function () {
                  $('.variations-single').find('.chosen-container').removeClass('is-shaking');
                }, 800);
                $(element).val('').trigger("chosen:updated");
                all_previous_selected = false;
                return false;
              }
            });
          }

          if (all_previous_selected) {
            if ($(e.target).find(':selected').val().length === 0) {
              $('.variations-single label[for="' + $(e.target).attr('id') + '"] .e-name').text('');
            } else {
              $('.variations-single label[for="' + $(e.target).attr('id') + '"] .e-name').text($(e.target).find(':selected').val());
            }

            var all_selected = true;
            window.cartSelect.each(function (index, element) {
              if ($(element).find(':selected').val().length === 0) {
                all_selected = false;
                return false;
              }
            });

            if (all_selected) {
              if ($('.variation-parent input[type="radio"]:checked').length === 0) {
                window.selected_variation_final = window.selected_variations;
              }

              if (typeof window.variation !== 'undefined' && window.variation.length > 0) {
                window.selected_variation_final = window.variation;
              }
              /**
               * Update final product details
               */


              if (typeof window.selected_variation_final !== 'undefined' && window.selected_variation_final.length !== 0) {
                window.selected_variation_final.map(function (parent) {
                  if (parent.attributes['attribute_' + $(e.target).attr('id')] === $(e.target).val()) {
                    variation_form.find('.variation_id').val(parent['variation_id']);
                    update_price(parent);
                    set_featured_image(parent); // update_description(parent);
                  }
                });
                $('.variations_form button[type="submit"]').removeClass('disabled').removeClass('wc-variation-selection-needed').attr('disabled', false);
              }
            }
          }
        });
      }
    }
  });
}



/***/ }),

/***/ "./resources/scripts/plugins/woocommerce/sections/sliders/product.js":
/*!***************************************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/sections/sliders/product.js ***!
  \***************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "productSlider": function() { return /* binding */ productSlider; }
/* harmony export */ });
function productSlider() {
  (function ($) {
    if (screen.width < 1024) {
      return false;
    }

    var woocommerceProductGallery = $('.woocommerce-product-gallery');
    woocommerceProductGallery.find('.flex-control-nav img').attr('width', woocommerceProductGallery.attr('data-thumbnail-width'));
    woocommerceProductGallery.find('.flex-control-nav img').attr('height', woocommerceProductGallery.attr('data-thumbnail-height'));

    if (woocommerceProductGallery.hasClass('woocommerce-product-gallery-adaptive-height-enabled') && woocommerceProductGallery.hasClass('woocommerce-product-gallery-type-2')) {
      setTimeout(function () {
        var viewportDimentions = $('.woocommerce-product-gallery .flex-viewport');
        var viewportHeight = viewportDimentions.height();
        var navHeight = $('.woocommerce-product-gallery .flex-control-nav img').length * $('.woocommerce-product-gallery').attr('data-thumbnail-height');

        if (navHeight > viewportHeight) {
          var heightSteps = 'woocommerce-product-gallery-height-small';

          if (viewportHeight > 400) {
            heightSteps = 'woocommerce-product-gallery-height-medium';
          } else if (viewportHeight > 600) {
            heightSteps = 'woocommerce-product-gallery-height-large';
          }

          $('.woocommerce-product-gallery').addClass(heightSteps).find('.flex-control-nav').slick({
            infinite: false,
            autoplay: false,
            slidesToShow: 3,
            centerMode: false,
            arrows: true,
            slidesToScroll: 1,
            dots: false,
            vertical: true,
            responsive: [{
              breakpoint: 500,
              settings: {
                slidesToShow: 4
              }
            }]
          });
        }

        $('.woocommerce-product-gallery__wrapper').resize();
      }, 100);
    } else {
      setTimeout(function () {
        if ($('.woocommerce-product-gallery').hasClass('woocommerce-product-gallery-type-2')) {
          if ($('.woocommerce .flex-control-nav li').length > 5) {
            $(".woocommerce .flex-control-nav").slick({
              infinite: false,
              autoplay: false,
              slidesToShow: 4,
              centerMode: false,
              arrows: true,
              slidesToScroll: 1,
              dots: false,
              vertical: true,
              responsive: [{
                breakpoint: 500,
                settings: {
                  slidesToShow: 4
                }
              }]
            });
          }
        } else {
          if ($('.woocommerce .flex-control-nav li').length > 4) {
            $(".woocommerce .flex-control-nav").slick({
              infinite: false,
              autoplay: false,
              slidesToShow: 4,
              centerMode: false,
              arrows: true,
              slidesToScroll: 1,
              dots: false,
              responsive: [{
                breakpoint: 500,
                settings: {
                  slidesToShow: 4
                }
              }]
            });
          }
        }

        $('.woocommerce-product-gallery__wrapper').resize();
      }, 100);
    }
  })(jQuery);
}



/***/ }),

/***/ "./resources/scripts/plugins/woocommerce/sections/sliders/products.js":
/*!****************************************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/sections/sliders/products.js ***!
  \****************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "productsSlider": function() { return /* binding */ productsSlider; }
/* harmony export */ });
function productsSlider() {
  if ($('.is-slider-product .product').length > 1) {
    $(".is-slider-product").slick({
      infinite: true,
      autoplay: false,
      slidesToShow: 4,
      centerMode: false,
      arrows: true,
      speed: 1000,
      autoplaySpeed: 1000,
      slidesToScroll: 1,
      dots: false,
      responsive: [{
        breakpoint: 500,
        settings: {
          slidesToShow: 1
        }
      }]
    });
  }
}



/***/ }),

/***/ "./resources/scripts/plugins/woocommerce/sidebar/sidebar-products.js":
/*!***************************************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/sidebar/sidebar-products.js ***!
  \***************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "sidebarProducts": function() { return /* binding */ sidebarProducts; }
/* harmony export */ });
function sidebarProducts() {
  if ($('.cat-item').hasClass('current-cat')) {
    $('.sidebar .widget .product-categories').fadeIn();
    $('.sidebar .widget .children').fadeIn();
  }

  $('.widget').click(function () {
    if ($(this).find('.current-cat').length === 0) {
      $(this).find('ul').toggle();
    }
  });
  $('.widget .cat-item, .widget ul').click(function (event) {
    event.stopPropagation();
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
/*!**********************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/wc-main.js ***!
  \**********************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _sections_sliders_product_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./sections/sliders/product.js */ "./resources/scripts/plugins/woocommerce/sections/sliders/product.js");
/* harmony import */ var _sections_sliders_products__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./sections/sliders/products */ "./resources/scripts/plugins/woocommerce/sections/sliders/products.js");
/* harmony import */ var _components_input_quantity__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/input-quantity */ "./resources/scripts/plugins/woocommerce/components/input-quantity.js");
/* harmony import */ var _components_radio_variation__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/radio-variation */ "./resources/scripts/plugins/woocommerce/components/radio-variation.js");
/* harmony import */ var _components_select_variation__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/select-variation */ "./resources/scripts/plugins/woocommerce/components/select-variation.js");
/* harmony import */ var _plugins_chosen_select_cart_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./../../plugins/chosen/select-cart.js */ "./resources/scripts/plugins/chosen/select-cart.js");
/* harmony import */ var _sidebar_sidebar_products__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./sidebar/sidebar-products */ "./resources/scripts/plugins/woocommerce/sidebar/sidebar-products.js");







jQuery(document).ready(function () {
  (0,_sections_sliders_product_js__WEBPACK_IMPORTED_MODULE_0__.productSlider)();
  (0,_sections_sliders_products__WEBPACK_IMPORTED_MODULE_1__.productsSlider)();
  (0,_components_input_quantity__WEBPACK_IMPORTED_MODULE_2__.inputQuantity)();
  (0,_components_radio_variation__WEBPACK_IMPORTED_MODULE_3__.radioVariation)();
  (0,_components_select_variation__WEBPACK_IMPORTED_MODULE_4__.selectVariation)();
  (0,_plugins_chosen_select_cart_js__WEBPACK_IMPORTED_MODULE_5__.selectCart)(); // sidebarProducts();
});
}();
/******/ })()
;