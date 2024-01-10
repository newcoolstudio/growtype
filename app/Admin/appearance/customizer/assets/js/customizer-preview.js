$ = jQuery;

$(document).ready(function ($) {

    wp.customize('blogname', (value) => {
        value.bind(to => $('.brand').text(to));
    });

    // Change the font-size of the h1
    wp.customize('sample_slider_control', function (control) {
        control.bind(function (controlValue) {
            $('h1').css('font-size', controlValue + 'px');
        });
    });

    wp.customize("header_logo", function (value) {
        value.bind(function (newval) {
            growtypeCustomizerUpdateImage(newval, 'header_logo');
        });
    });

    wp.customize("header_logo_scroll", function (value) {
        value.bind(function (newval) {
            growtypeCustomizerUpdateImage(newval, 'header_logo_scroll');
        });
    });

    wp.customize("header_logo_home", function (value) {
        value.bind(function (newval) {
            growtypeCustomizerUpdateImage(newval, 'header_logo_home');
        });
    });

    wp.customize("mobile_burger_logo", function (value) {
        value.bind(function (newval) {
            growtypeCustomizerUpdateImage(newval, 'mobile_burger_logo');
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
            $(".site-header.is-fixed, .site-header.is-fixed a").css({
                'color': newval
            });
            $(".site-header.is-fixed .hamburger-inner").css({
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
            growtypeCustomizerUpdateImage(newval, 'footer_logo');
        });
    });

    wp.customize("footer_copyright", function (value) {
        value.bind(function (newval) {
            $("#footer_copyright").html(newval);
        });
    });

    wp.customize("footer_extra_content", function (value) {
        value.bind(function (newval) {
            var convertedString = replaceBreaksWithParagraphs(newval);
            convertedString = convertedString.replace(/<[^/>][^>]*><\/[^>]+>/, "");
            $(".footer-extra-content").html(convertedString);
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
     * Font sizes
     */
    wp.customize("typography_font_size_h1", function (value) {
        value.bind(function (newval) {
            $("h1").css('font-size', newval + 'px');
        });
    });

    wp.customize("typography_font_size_h2", function (value) {
        value.bind(function (newval) {
            $("h2").css('font-size', newval + 'px');
        });
    });

    wp.customize("typography_font_size_h3", function (value) {
        value.bind(function (newval) {
            $("h3").css('font-size', newval + 'px');
        });
    });

    wp.customize("typography_font_size_h4", function (value) {
        value.bind(function (newval) {
            $("h4").css('font-size', newval + 'px');
        });
    });

    wp.customize("typography_font_size_h5", function (value) {
        value.bind(function (newval) {
            $("h5").css('font-size', newval + 'px');
        });
    });

    wp.customize("typography_font_size_body", function (value) {
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
function growtypeCustomizerUpdateImage(id, target_id) {
    jQuery.ajax({
        url: growtype_customizer_preview_ajax.url,
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
