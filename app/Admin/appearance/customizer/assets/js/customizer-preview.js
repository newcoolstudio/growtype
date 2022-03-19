$ = jQuery;

$(document).ready(function ($) {

    wp.customize('blogname', (value) => {
        value.bind(to => $('.brand').text(to));
    });

    // Append the search icon list item to the main nav
    wp.customize('search_menu_icon', function (control) {
        control.bind(function (controlValue) {
            if (controlValue == true) {
                // If the switch is on, add the search icon
                $('.nav-menu').append('<li class="menu-item menu-item-search"><a href="#" class="nav-search"><i class="fa fa-search"></i></a></li>');
            } else {
                // If the switch is off, remove the search icon
                $('li.menu-item-search').remove();
            }
        });
    });

    // Change the font-size of the h1
    wp.customize('sample_slider_control', function (control) {
        control.bind(function (controlValue) {
            $('h1').css('font-size', controlValue + 'px');
        });
    });

    wp.customize("header_logo", function (value) {
        value.bind(function (newval) {
            update_image(newval, 'header_logo');
        });
    });

    wp.customize("header_logo_scroll", function (value) {
        value.bind(function (newval) {
            update_image(newval, 'header_logo_scroll');
        });
    });

    wp.customize("header_logo_home", function (value) {
        value.bind(function (newval) {
            update_image(newval, 'header_logo_home');
        });
    });

    wp.customize("mobile_burger_logo", function (value) {
        value.bind(function (newval) {
            update_image(newval, 'mobile_burger_logo');
        });
    });

    /**
     * Header text color
     */
    wp.customize("header_text_color", function (value) {
        value.bind(function (newval) {
            $(".header-inner, .header-inner a").css({
                'color': newval
            });
        });
    });

    wp.customize("header_text_color_scroll", function (value) {
        value.bind(function (newval) {
            $(".site-header.is-scroll, .site-header.is-scroll a").css({
                'color': newval
            });
            $(".site-header.is-scroll .hamburger-inner").css({
                'background': newval
            });
        });
    });

    wp.customize("header_home_background_color", function (value) {
        value.bind(function (newval) {
            $(".site-header").css({
                'background': newval
            });
        });
    });

    wp.customize("header_text_color_home", function (value) {
        value.bind(function (newval) {
            $(".header-inner, .header-inner a").css({
                'color': newval
            });
            $(".home .header-inner .hamburger-inner").css({
                'background': newval
            });
        });
    });

    wp.customize("mobile_menu_text_color", function (value) {
        value.bind(function (newval) {
            $(".site-header .menu-mobile-container .menu li a").css({
                'color': newval
            });
            $(".site-header .hamburger.is-active .hamburger-inner").css({
                'background': newval
            });
        });
    });

    wp.customize("header_navbar_text", function (value) {
        value.bind(function (newval) {
            $("#header_navbar_text").html(newval);
        });
    });

    wp.customize("header_background_color", function (value) {
        value.bind(function (newval) {
            $('body:not(.home) header').css({
                'background-color': newval
            });
        });
    });

    wp.customize("header_navbar_background_color", function (value) {
        value.bind(function (newval) {
            $('.site-header .b-navbar').css({
                'background-color': newval
            });
        });
    });

    wp.customize("header_navbar_elements_color", function (value) {
        value.bind(function (newval) {
            $('.site-header .b-navbar, .site-header .b-navbar a').css({
                'color': newval
            });
        });
    });

    wp.customize("header_promo_background_color", function (value) {
        value.bind(function (newval) {
            $('.site-header .b-promo').css({
                'background-color': newval
            });
        });
    });

    wp.customize("header_promo_elements_color", function (value) {
        value.bind(function (newval) {
            $('.site-header .b-promo, .site-header .b-promo a').css({
                'color': newval
            });
        });
    });

    /**
     * Footer
     */

    wp.customize("footer_logo", function (value) {
        value.bind(function (newval) {
            update_image(newval, 'footer_logo');
        });
    });

    wp.customize("footer_copyright", function (value) {
        value.bind(function (newval) {
            $("#footer_copyright").html(newval);
        });
    });

    wp.customize("footer_textarea", function (value) {
        value.bind(function (newval) {
            var convertedString = replaceBreaksWithParagraphs(newval);
            convertedString = convertedString.replace(/<[^/>][^>]*><\/[^>]+>/, "");
            $("#footer_textarea").html(convertedString);
        });
    });

    function replaceBreaksWithParagraphs(input) {
        input = filterEmpty(input.split('\n')).join('</p><p>');
        return '<p>' + input + '</p>';
    }

    function filterEmpty(arr) {
        var new_arr = [];
        for (var i = arr.length - 1; i >= 0; i--) {
            if (arr[i] != "")
                new_arr.push(arr.pop());
            else
                arr.pop();
        }
        return new_arr.reverse();
    }

    /**
     * Footer colors
     */

    wp.customize("footer_background_color", function (value) {
        value.bind(function (newval) {
            $('.site-footer').css({
                'background-color': newval
            });
        });
    });

    wp.customize("footer_text_color", function (value) {
        value.bind(function (newval) {
            $('.site-footer, .site-footer a').css({
                'color': newval
            });
        });
    });

    /**
     * Buttons colors
     */
    wp.customize("primary_button_background_color", function (value) {
        value.bind(function (newval) {
            $('#sb_instagram .sbi_follow_btn a, .btn-primary, .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt, .woocommerce-cart .woocommerce button.button, .woocommerce-checkout .woocommerce button.button.alt, .woocommerce-Reviews #respond input#submit').css({
                'background-color': newval,
                'border-color': newval,
            });
        });
    });

    wp.customize("primary_button_text_color", function (value) {
        value.bind(function (newval) {
            $('#sb_instagram .sbi_follow_btn a, .btn-primary, .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt, .woocommerce-cart .woocommerce button.button, .woocommerce-checkout .woocommerce button.button.alt, .woocommerce-Reviews #respond input#submit').css({
                'color': newval,
            });
        });
    });

    wp.customize("add_to_cart_button_background_color", function (value) {
        value.bind(function (newval) {
            $('.woocommerce-checkout .woocommerce button.button.alt, .woocommerce div.product form.cart .button, .b-shoppingcart .buttons .btn-primary').css({
                'background-color': newval,
                'border-color': newval,
            });
        });
    });

    wp.customize("add_to_cart_button_text_color", function (value) {
        value.bind(function (newval) {
            $('.woocommerce-checkout .woocommerce button.button.alt, .woocommerce div.product form.cart .button, .b-shoppingcart .buttons .btn-primary').css({
                'color': newval,
            });
        });
    });

    /**
     * Theme colors
     */
    wp.customize("bg_color_scheme", function (value) {
        value.bind(function (newval) {
            var colors = colorScheme[newval].general;
            wp.customize("body_background_color").set(colors['body_background_color']);
            wp.customize("body_text_color").set(colors['body_text_color']);
            wp.customize("header_background_color").set(colors['header_background_color']);
            wp.customize("header_text_color").set(colors['header_text_color']);
            wp.customize("header_text_color_scroll").set(colors['header_text_color_scroll']);
            wp.customize("header_text_color_home").set(colors['header_text_color_home']);
            wp.customize("header_home_background_color").set(colors['header_home_background_color']);
            wp.customize("header_text_color").set(colors['header_text_color']);
            wp.customize("footer_background_color").set(colors['footer_background_color']);
            wp.customize("footer_text_color").set(colors['footer_text_color']);
            wp.customize("header_navbar_background_color").set(colors['header_navbar_background_color']);
            wp.customize("header_navbar_elements_color").set(colors['header_navbar_elements_color']);
            wp.customize("header_promo_background_color").set(colors['header_promo_background_color']);
            wp.customize("header_promo_elements_color").set(colors['header_promo_elements_color']);
            wp.customize("mobile_menu_text_color").set(colors['mobile_menu_text_color']);
        });
    });

    wp.customize("body_background_color", function (value) {
        value.bind(function (newval) {
            $('body').css({
                'background-color': newval
            });
        });
    });

    wp.customize("body_text_color", function (value) {
        value.bind(function (newval) {
            $('body').css({
                'color': newval
            });
        });
    });

    /**
     * Product page payment details
     */
    wp.customize("woocommerce_product_page_payment_details", function (value) {
        value.bind(function (newval) {
            $(".single-product .b-paymentdetails").html(newval);
        });
    });

    /**
     * Success page extra content
     */
    wp.customize("woocommerce_thankyou_page_intro_content", function (value) {
        value.bind(function (newval) {
            $(".woocommerce-order .b-intro-content").html(newval);
        });
    });

    /**
     * Success page extra content
     */
    wp.customize("woocommerce_thankyou_page_intro_content_disabled_account", function (value) {
        value.bind(function (newval) {
            $(".woocommerce-order .b-intro-content").html(newval);
        });
    });

    /**
     * Product single
     */
    wp.customize("woocommerce_product_page_sidebar_content", function (value) {
        value.bind(function (newval) {
            $(".sidebar-product .sidebar-inner").html(newval);
        });
    });

    /**
     * Wc email
     */
    wp.customize("wc_email_customer_invoice_successful_main_content", function (value) {
        value.bind(function (newval) {
            var convertedString = replaceBreaksWithParagraphs(newval);
            convertedString = convertedString.replace(/<[^/>][^>]*><\/[^>]+>/, "");
            $("#body_content_inner .b-intro").html(convertedString);
        });
    });

    wp.customize("wc_email_customer_processing_order_main_content", function (value) {
        value.bind(function (newval) {
            var convertedString = replaceBreaksWithParagraphs(newval);
            convertedString = convertedString.replace(/<[^/>][^>]*><\/[^>]+>/, "");
            $("#body_content_inner .b-intro").html(convertedString);
        });
    });

    wp.customize("wc_email_customer_completed_order_main_content", function (value) {
        value.bind(function (newval) {
            var convertedString = replaceBreaksWithParagraphs(newval);
            convertedString = convertedString.replace(/<[^/>][^>]*><\/[^>]+>/, "");
            $("#body_content_inner .b-intro").html(convertedString);
        });
    });

    /**
     * Checkout intro
     */
    wp.customize("woocommerce_checkout_intro_text", function (value) {
        value.bind(function (newval) {
            var convertedString = replaceBreaksWithParagraphs(newval);
            convertedString = convertedString.replace(/<[^/>][^>]*><\/[^>]+>/, "");
            $(".woocommerce-checkout-intro").html(newval);
        });
    });

    /**
     * Product preview cta label
     */
    wp.customize("woocommerce_product_preview_cta_label", function (value) {
        value.bind(function (newval) {
            var convertedString = replaceBreaksWithParagraphs(newval);
            convertedString = convertedString.replace(/<[^/>][^>]*><\/[^>]+>/, "");
            $(".products .product .button").text(newval);
        });
    });

    /**
     * Font sizes
     */
    wp.customize("fonts_font_size_h1", function (value) {
        value.bind(function (newval) {
            $("h1").css('font-size', newval + 'px');
        });
    });

    wp.customize("fonts_font_size_h2", function (value) {
        value.bind(function (newval) {
            $("h2").css('font-size', newval + 'px');
        });
    });

    wp.customize("fonts_font_size_h3", function (value) {
        value.bind(function (newval) {
            $("h3").css('font-size', newval + 'px');
        });
    });

    wp.customize("fonts_font_size_h4", function (value) {
        value.bind(function (newval) {
            $("h4").css('font-size', newval + 'px');
        });
    });

    wp.customize("fonts_font_size_h5", function (value) {
        value.bind(function (newval) {
            $("h5").css('font-size', newval + 'px');
        });
    });

    wp.customize("fonts_font_size_p", function (value) {
        value.bind(function (newval) {
            $("p").css('font-size', newval + 'px');
        });
    });
});

/**
 *
 * @param id
 * @param target_id
 */
function update_image(id, target_id) {
    jQuery.ajax({
        url: ajax_object.ajaxurl,
        type: 'post',
        data: {
            action: 'update-logo-customizer',
            attachment_id: id,
            target_id: target_id
        },
        success: function (response) {
            if (response.length > 0) {
                jQuery("#" + target_id).html(response);
            }
        }
    });
}
