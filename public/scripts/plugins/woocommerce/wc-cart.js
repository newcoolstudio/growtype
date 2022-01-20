/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************************!*\
  !*** ./resources/scripts/plugins/woocommerce/wc-cart.js ***!
  \**********************************************************/
(function ($) {
  "use strict";

  var initialCartContentLoad = true;
  var loadingAnimation = "<span class='addToCart-loader'><div></div><div></div></span>";

  function loadCartContent() {
    $('.b-shoppingcart .b-shoppingcart-content').html('');
    $('.b-shoppingcart-inner').append(loadingAnimation);
    $.ajax({
      url: ajax_object.ajaxurl,
      type: "post",
      data: {
        action: 'load_cart_ajax'
      }
    }).done(function (data) {
      $('.e-cart').attr('data-amount', data.cart_contents_count);
      $('.b-shoppingcart .addToCart-loader').remove();
      $('.b-shoppingcart').find('.e-loader').remove();
      $('.b-shoppingcart .b-shoppingcart-inner .b-shoppingcart-main').remove();
      $('.b-shoppingcart .b-shoppingcart-inner').append(data['fragments']['shopping_cart_content']);
      $('.b-shoppingcart .shoppingcart-products-item').each(function (index, element) {
        initiateChangeProductQuantity($(element).data('cart_item_key'));
        initiateCartItemRemove($(element).data('cart_item_key'));
      });
    });
  }

  function loadCartDetails() {
    $.ajax({
      url: ajax_object.ajaxurl,
      type: "post",
      data: {
        action: 'get_cart_details_ajax'
      }
    }).done(function (data) {
      $('.e-cart').attr('data-amount', data.products_amount);

      if (data.products_amount > 0) {
        $('.e-cart').removeClass('is-empty');
      } else {
        $('.e-cart').addClass('is-empty');
      }
    });
  }

  $(document).ready(function () {
    loadCartDetails();
  });

  function initiateChangeProductQuantity(cart_item_key) {
    var productQuantityChanged = false;
    $('.b-shoppingcart .shoppingcart-products-item[data-cart_item_key="' + cart_item_key + '"] .arrow').click(function () {
      if (!productQuantityChanged) {
        productQuantityChanged = true;
        changeProductQuantity($(this));
        setTimeout(function () {
          productQuantityChanged = false;
        }, 1500);
      }
    });
  }

  function changeProductQuantity(element, action) {
    var current_amount = element.closest('.product-changeQuantity').find('.amount');
    var current_amount_val = parseInt(current_amount.text());
    var initial_amount_val = current_amount_val;
    var product_id = element.closest('.product-changeQuantity').data('product_id');
    var product_sku = element.closest('.product-changeQuantity').data('product_sku');
    var variation_id = element.closest('.product-changeQuantity').data('variation_id');
    var cart_item_key = element.closest('.shoppingcart-products-item').data('cart_item_key');

    if (element.hasClass('arrow-left')) {
      if (current_amount_val == '1') {
        return false;
      } else {
        $('input[name="cart[' + cart_item_key + '][qty]"]').closest('.quantity').find('.btn-down').click();
        current_amount_val = parseInt(current_amount_val) - 1;
      }
    }

    if (element.hasClass('arrow-right')) {
      $('input[name="cart[' + cart_item_key + '][qty]"]').closest('.quantity').find('.btn-up').click();
      current_amount_val = parseInt(current_amount_val) + 1;
    }

    current_amount.text(current_amount_val);

    if (action !== 'ajax-no') {
      $.ajax({
        url: ajax_object.ajaxurl,
        type: "post",
        data: {
          quantity: current_amount_val,
          action: 'update_cart_ajax',
          status: 'change_quantity',
          product_sku: product_sku,
          product_id: product_id,
          variation_id: variation_id,
          cart_item_key: cart_item_key
        },
        beforeSend: function beforeSend() {
          $('.e-cart').addClass('is-loading');
        },
        success: function success(data) {
          if (data == 0 || data.error) {
            if (parseInt(current_amount.text()) > initial_amount_val) {
              current_amount.text(initial_amount_val);
            }

            Swal.fire({
              icon: 'info',
              text: data.message
            });
            return false;
          }

          if (data.quantity == 0) {
            return false;
          }

          $('.e-cart').attr('data-amount', data.cart_contents_count);
          $('.b-shoppingcart .e-subtotal_price').html(data.cart_subtotal);
          $('.b-shoppingcart .shoppingcart-products-item[data-cart_item_key=' + data.cart_item_key + ']').replaceWith(data['fragments']['shopping_cart_single_item']);
          initiateChangeProductQuantity(data.cart_item_key);
          initiateCartItemRemove(data.cart_item_key);
        },
        error: function error(xhr) {},
        complete: function complete() {}
      });
    }
  }

  function addToCart(cart) {
    if (cart.find('button[type="submit"]').hasClass('disabled')) {
      return false;
    }

    cart.find('button[type="submit"]').append('<div class="spinner-border" role="status"></div>');
    var productIsGrouped = cart.hasClass('grouped_form');
    var serializedCartData = cart.serialize();
    serializedCartData = serializedCartData.replace("add-to-cart", "product_id");
    /**
     * Change default bid value
     */

    serializedCartData = serializedCartData.replace("bid_value", "bid_value_currency");
    var productData = serializedCartData + '&action=add_to_cart_ajax&status=add_to_cart';

    if (!productIsGrouped) {
      if (cart.find('button[type="submit"]').attr('value') !== undefined) {
        productData = productData + '&product_id=' + cart.find('button[type="submit"]').attr('value');
      }

      if (cart.find('button[type="submit"]').attr('product_sku') !== undefined) {
        productData = productData + '&product_sku=' + cart.find('button[type="submit"]').attr('product_sku');
      }
      /**
       * Set bid value
       */


      if (cart.find('button[type="submit"]').hasClass('bid_button')) {
        var bidValue = Number(cart.find('input[name="bid_value"]').val().replace(/[^0-9\.-]+/g, ""));

        if (!isNaN(bidValue)) {
          productData = productData + '&bid_value=' + bidValue;
        } else {
          alert('Something went wrong. Please contact our support.');
          return false;
        }
        /**
         * Submit bid without ajax
         */


        cart.submit();
        return false;
      }
    }
    /**
     * Post data to backend
     */


    $.ajax({
      url: ajax_object.ajaxurl,
      type: "post",
      data: productData,
      beforeSend: function beforeSend() {
        $('.e-cart').addClass('is-loading');
        cart.find('button[type="submit"]').removeClass("is-added").addClass("is-loading");
      },
      success: function success(data) {
        loadCartContent();
        $('.e-cart').addClass('is-scaling');
        setTimeout(function () {
          $('.e-cart').removeClass('is-scaling');
        }, 4500);
        setTimeout(function () {
          $("html, body").animate({
            scrollTop: 0
          }, 400);
        }, 500);
        cart.find('button[type="submit"]').removeClass("is-loading");
        cart.find('button[type="submit"]').find('.spinner-border').remove();
        setTimeout(function () {
          $('.e-cart').removeClass('is-loading');
        }, 1500);

        if (data == 0 || data.error) {
          if (data.message) {
            Swal.fire({
              icon: 'info',
              text: data.message
            });
          }

          if (data.product_url) {
            window.location = data.product_url;
          }

          return false;
        }

        if (data.quantity == 0) {
          Swal.fire({
            position: 'center',
            icon: false,
            title: 'Oops...',
            text: data.message,
            showConfirmButton: false,
            timer: 2500
          });
          return false;
        }

        if ($('.b-shoppingcart .shoppingcart-products').length > 0) {
          if ($('.b-shoppingcart .shoppingcart-products-item[data-cart_item_key="' + data.cart_item_key + '"]').length > 0) {
            $('.b-shoppingcart .shoppingcart-products-item[data-cart_item_key="' + data.cart_item_key + '"]').replaceWith(data['fragments']['shopping_cart_single_item']);
          } else {
            $('.b-shoppingcart .shoppingcart-products').append(data['fragments']['shopping_cart_single_item']);
          }
        } else {
          loadCartContent();
        }

        $('.b-shoppingcart .e-subtotal_price').html(data.cart_subtotal);
        $('.e-cart').attr('data-amount', data.cart_contents_count);
        var btn_text = cart.find('button[type="submit"]').text();
        cart.find('button[type="submit"]').removeClass("is-loading").addClass("is-added").text(data.response_text);
        setTimeout(function () {
          cart.find('button[type="submit"]').text(btn_text);
        }, 1000);
        initiateChangeProductQuantity(data.cart_item_key);
        initiateCartItemRemove(data.cart_item_key);
      },
      error: function error(xhr) {
        // if error occured
        cart.find('button[type="submit"]').removeClass("is-loading").addClass("is-added");
      },
      complete: function complete() {}
    });
  }

  function initiateCartItemRemove(cart_item_key) {
    $('.b-shoppingcart .shoppingcart-products-item[data-cart_item_key="' + cart_item_key + '"] .e-remove').click(function (e) {
      e.preventDefault();
      removeItemFromCart(cart_item_key);
    });
  }

  function removeItemFromCart(cart_item_key) {
    $.ajax({
      url: ajax_object.ajaxurl,
      type: "post",
      data: {
        action: 'update_cart_ajax',
        status: 'remove_from_cart',
        cart_item_key: cart_item_key
      },
      beforeSend: function beforeSend() {
        $('.b-shoppingcart .shoppingcart-products-item[data-cart_item_key=' + cart_item_key + ']').fadeOut();
      },
      success: function success(data) {
        $('input[name="cart[' + cart_item_key + '][qty]"]').closest('.cart_item').find('.remove').click();
        $('.b-shoppingcart .shoppingcart-products-item[data-cart_item_key=' + data.cart_item_key + ']').remove();
        $('.b-shoppingcart .e-subtotal_price').html(data.cart_subtotal);
        $('.e-cart').attr('data-amount', data.cart_contents_count);

        if (data.cart_contents_count === 0) {
          loadCartContent();
        }
      },
      error: function error(xhr) {// if error occured
      },
      complete: function complete() {}
    });
  }
  /**
   * Disable buy button if empty selects
   */


  if ($('.variations_form select').length > 0) {
    $('.variations_form select').each(function (index, element) {
      if ($(element).val().length === 0) {
        $('.variations_form button[type="submit"]').attr('disabled', true);
      }
    });
  }

  $('.e-cart').click(function (e) {
    e.preventDefault();
    e.stopPropagation();

    if ($('.b-shoppingcart').hasClass('is-active')) {
      $('.b-shoppingcart').removeClass('is-active').addClass('is-pasive');
      $('body', 'html').removeClass('stopscroll');
      $('.b-shoppingcart-overlay').fadeOut();
    } else {
      $('.b-shoppingcart').addClass('is-active').removeClass('is-pasive');
      $('body', 'html').addClass('stopscroll');
      $('.b-shoppingcart-overlay').fadeIn();

      if (initialCartContentLoad) {
        initialCartContentLoad = false;
        loadCartContent();
      }
    }
  });
  /**
   * CLOSE CART SUMMARY WINDOW
   */

  $('.b-shoppingcart, .b-shoppingcart .e-btn--close').click(function () {
    $('.b-shoppingcart').removeClass('is-active').addClass('is-pasive');
    $('body', 'html').removeClass('stopscroll');
    $('.b-shoppingcart-overlay').fadeOut();
  });
  $('.b-shoppingcart .b-shoppingcart-inner').click(function (e) {
    e.stopPropagation();
  });
  /**
   * Add to cart
   */

  $('.ajaxcart-enabled .product .cart button[type="submit"]').click(function (e) {
    e.preventDefault();
    addToCart($(this).closest('.cart'));
  });
  /**
   * Other event
   */

  $("body").on('updated_cart_totals', function () {
    loadCartContent();
  });
  $("body").on('removed_from_cart', function () {
    loadCartContent();
  });
  $("body").on('wc_cart_emptied', function () {
    loadCartContent();
  });
})(jQuery);
/******/ })()
;