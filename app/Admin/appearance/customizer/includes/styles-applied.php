<?php

/**
 * Styles applied
 */
add_action('wp_head', 'growtype_customizer_general_css');
function growtype_customizer_general_css()
{
    ?>
    <style>
        :root {
            --theme-color: <?php echo growtype_theme_color() ?>;
            --btn-primary-background-color: <?php echo growtype_primary_button_background_color() ?>;
            --btn-primary-background-color-active: <?php echo growtype_primary_button_background_color_active() ?>;
            --btn-primary-color: <?php echo growtype_primary_button_text_color() ?>;
            --btn-primary-color-active: <?php echo growtype_primary_button_text_color_active() ?>;
            --btn-primary-border-color: <?php echo growtype_primary_button_border_color() ?>;
            --btn-primary-border-color-active: <?php echo growtype_primary_button_border_color_active() ?>;
            --btn-primary-border-radius: <?php echo growtype_primary_button_border_radius() ?>;

            --btn-secondary-background-color: <?php echo growtype_secondary_button_background_color() ?>;
            --btn-secondary-background-color-active: <?php echo growtype_primary_button_background_color() ?>;
            --btn-secondary-color: <?php echo growtype_secondary_button_text_color() ?>;
            --btn-secondary-color-active: <?php echo growtype_primary_button_text_color() ?>;
            --btn-secondary-border-color: <?php echo growtype_secondary_button_border_color() ?>;
            --btn-secondary-border-color-active: <?php echo growtype_primary_button_background_color() ?>;
            --btn-secondary-border-radius: <?php echo growtype_primary_button_border_radius() ?>;

            --link-color: <?php echo growtype_theme_color() ?>;
            --link-color-active: <?php echo growtype_theme_color() ?>;

            --footer-text-color: <?php echo growtype_get_footer_text_color() ?>;

            --body-text-font-size: <?php echo growtype_typography_font_size_body() ?>;
        }

        <?php if(!empty(get_theme_mod('main_color'))){ ?>
        aside.widget-area > .widget .widget-title:after,
        .woocommerce-order-details .woocommerce-order-detail,
        .woocommerce-account .b-info-header,
        .woocommerce nav.woocommerce-pagination ul li span.current {
            background-color: <?php echo get_theme_mod('main_color'); ?>;
        }

        .spinner-border {
            border-color: <?php echo get_theme_mod('main_color'); ?>;
            border-right-color: transparent !important;
        }

        aside.widget-area > .widget .widget-title:after {
            background: <?php echo get_theme_mod('main_color'); ?>;
        }

        <?php } ?>

        <?php if(!empty(growtype_header_background_color())){ ?>
        body:not(.home) .site-header, body:not(.home) #header-menu .sub-menu {
            background-color: <?php echo growtype_header_background_color(); ?>;
        }

        <?php } ?>

        <?php if(!empty(growtype_header_home_background_color())){ ?>
        body.home .site-header, body.home #header-menu .sub-menu {
            background: <?php echo growtype_header_home_background_color() ?>
        }

        <?php } ?>

        <?php if(!empty(growtype_get_footer_bg_color())){ ?>
        .site-footer {
            background-color: <?php echo growtype_get_footer_bg_color() ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_navbar_background_color'))){ ?>
        .site-header .b-navbar {
            background-color: <?php echo get_theme_mod('header_navbar_background_color'); ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_navbar_elements_color'))){ ?>
        .b-navbar, .b-navbar a {
            color: <?php echo get_theme_mod('header_navbar_elements_color'); ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_promo_background_color'))){ ?>
        .site-header .b-promo {
            background-color: <?php echo get_theme_mod('header_promo_background_color'); ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_promo_elements_color'))){ ?>
        .site-header .b-promo, .site-header .b-promo a {
            color: <?php echo get_theme_mod('header_promo_elements_color'); ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_text_color_scroll'))){ ?>
        .site-header.is-fixed .header-inner li a {
            color: <?php echo get_theme_mod('header_text_color_scroll') ?>;
        }

        <?php } ?>

        <?php if(!empty(growtype_header_scroll_background_color())){ ?>
        .site-header.is-fixed, .home .site-header.is-fixed, .site-header.is-fixed #header-menu .sub-menu {
            background: <?php echo growtype_header_scroll_background_color(); ?>;
        }

        <?php } ?>

        .main-navigation-mobile:before,
        .main-navigation-mobile-type-3 .main-navigation-mobile-inner {
            background: <?php echo get_theme_mod('mobile_menu_bg_color','black') ?>;
        }

        <?php if(!empty(get_theme_mod('header_text_color'))){ ?>
        .header-inner, .header-inner a, .account-details {
            color: <?php echo get_theme_mod('header_text_color') ?>;
        }

        <?php } ?>

        .hamburger-inner {
            background: <?php echo growtype_mobile_menu_burger_color()['pasive'] ?>;
        }

        <?php if(!empty(get_theme_mod('header_text_color_home'))){ ?>
        .home .header-inner, .home .header-inner a {
            color: <?php echo get_theme_mod('header_text_color_home') ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('mobile_menu_text_color'))){ ?>
        .site-header .main-navigation-mobile .menu li a,
        .main-navigation-mobile-type-2 .menu-item-has-children:before,
        .site-header.is-fixed .menu-mobile-container .menu li a,
        .main-navigation-mobile .menu-extra li a,
        .main-navigation-mobile-type-2 .menu li a,
        .main-navigation-mobile-type-3 .menu li a,
        .menu-mobile-container .menu li a {
            color: <?php echo get_theme_mod('mobile_menu_text_color') ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('mobile_menu_burger_active_color'))){ ?>
        .hamburger.is-active .hamburger-inner {
            background: <?php echo get_theme_mod('mobile_menu_burger_active_color') ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_logo_size_desktop'))){ ?>
        .header-logo-wrapper {
            max-width: <?php echo get_theme_mod('header_logo_size_desktop') ?>px;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_logo_position_vertical_desktop'))){ ?>
        .header-logo-wrapper {
            top: <?php echo get_theme_mod('header_logo_position_vertical_desktop') ?>px;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_logo_size_mobile'))){ ?>
        @media only screen and (max-width: 768px) {
            .header-logo-wrapper {
                max-width: <?php echo get_theme_mod('header_logo_size_mobile') ?>px;
            }
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_logo_position_vertical_mobile'))){ ?>
        @media only screen and (max-width: 768px) {
            .header-logo-wrapper {
                top: <?php echo get_theme_mod('header_logo_position_vertical_mobile') ?>px;
            }
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('body_background_color'))){ ?>
        body {
            background: <?php echo get_theme_mod('body_background_color')?>;
        }

        .panel-area .panel-inner {
            background: <?php echo get_theme_mod('body_background_color')?>;
        }

        .panel-area .btn-panel-close {
            background: <?php echo get_theme_mod('body_background_color')?>;
        }

        <?php }?>

        <?php if(!empty(get_theme_mod('body_text_color'))){ ?>
        body {
            color: <?php echo get_theme_mod('body_text_color')?>;
        }

        .panel-area .panel-nav ul li a span {
            color: <?php echo get_theme_mod('body_text_color')?>;
        }

        <?php }?>

        <?php if(!empty(growtype_get_font_details('primary_font'))){ ?>
        body {
            font-family: "<?php echo growtype_get_font_details('primary_font')->font?>", sans-serif;
            font-weight: <?php echo growtype_get_primary_font_regular_weight() ?>;
        }

        <?php }?>

        <?php if(get_theme_mod('wc_catalog_orderby_disable')){ ?>
        .woocommerce-ordering {
            display: none !important;
        }

        <?php } ?>

        <?php if(get_theme_mod('checkout_button_style_select') === 'button_style_2') { ?>
        .woocommerce-checkout .woocommerce button.button.alt,
        .b-shoppingcart .buttons .btn-primary {
            background: none;
            color: black;
            border-radius: 2px;
            text-transform: uppercase;
            border: 1px solid black;
        }

        <?php } ?>

        <?php if(get_theme_mod('addtocart_button_style_select') === 'button_style_2') { ?>
        .woocommerce div.product form.cart .button, .woocommerce ul.products li.product .button {
            background: none;
            color: black;
            border-radius: 2px;
            text-transform: uppercase;
            border: 1px solid black;
        }

        <?php } ?>

        <?php if(get_theme_mod('woocommerce_checkout_order_review_table', true) === false) { ?>
        .woocommerce-checkout-review-order table.shop_table {
            display: none;
        }

        <?php } ?>

        <?php if(get_theme_mod('typography_font_size_h1')) { ?>
        h1 {
            font-size: <?php echo get_theme_mod('typography_font_size_h1')?>px;
        }

        <?php } ?>

        <?php if(get_theme_mod('typography_font_size_h1_mobile')) { ?>
        @media only screen and (max-width: 768px) {
            h1 {
                font-size: <?php echo get_theme_mod('typography_font_size_h1_mobile')?>px;
            }
        }

        <?php } ?>

        <?php if(get_theme_mod('typography_font_size_h2')) { ?>
        h2 {
            font-size: <?php echo get_theme_mod('typography_font_size_h2')?>px;
        }

        <?php } ?>

        <?php if(get_theme_mod('typography_font_size_h2_mobile')) { ?>
        @media only screen and (max-width: 768px) {
            h2 {
                font-size: <?php echo get_theme_mod('typography_font_size_h2_mobile')?>px;
            }
        }

        <?php } ?>

        <?php if(get_theme_mod('typography_font_size_h3')) { ?>
        h3 {
            font-size: <?php echo get_theme_mod('typography_font_size_h3')?>px;
            line-height: 130%;
        }

        <?php } ?>

        <?php if(get_theme_mod('typography_font_size_h3_mobile')) { ?>
        @media only screen and (max-width: 768px) {
            h3 {
                font-size: <?php echo get_theme_mod('typography_font_size_h3_mobile')?>px;
            }
        }

        <?php } ?>

        <?php if(get_theme_mod('typography_font_size_h4')) { ?>
        h4 {
            font-size: <?php echo get_theme_mod('typography_font_size_h4')?>px;
        }

        <?php } ?>

        <?php if(get_theme_mod('typography_font_size_h4_mobile')) { ?>
        @media only screen and (max-width: 768px) {
            h4 {
                font-size: <?php echo get_theme_mod('typography_font_size_h4_mobile')?>px;
            }
        }

        <?php } ?>

        <?php if(get_theme_mod('typography_font_size_h5')) { ?>
        h5 {
            font-size: <?php echo get_theme_mod('typography_font_size_h5')?>px;
        }

        <?php } ?>

        <?php if(get_theme_mod('typography_font_size_h5_mobile')) { ?>
        @media only screen and (max-width: 768px) {
            h5 {
                font-size: <?php echo get_theme_mod('typography_font_size_h5_mobile')?>px;
            }
        }

        <?php } ?>

        <?php if(!get_theme_mod('woocommerce_checkout_optional_label')) { ?>
        .woocommerce form .form-row .optional {
            display: none;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('add_to_cart_button_background_color'))) { ?>
        .woocommerce ul.products li.product .button,
        .woocommerce ul.products li.product .button:hover,
        .woocommerce div.product form.cart .button,
        .woocommerce div.product form.cart .button:hover,
        .wc-block-grid__product-add-to-cart.wp-block-button .wp-block-button__link,
        .wc-block-grid__product-add-to-cart.wp-block-button .wp-block-button__link:hover,
        .woocommerce div.product form.cart .button:not(.btn),
        .woocommerce div.product form.cart .button:not(.btn):hover {
            background: <?php echo get_theme_mod('add_to_cart_button_background_color')?> !important;
            border: 1px solid <?php echo get_theme_mod('add_to_cart_button_background_color')?> !important;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('add_to_cart_button_text_color'))) { ?>
        .woocommerce ul.products li.product .button,
        .woocommerce ul.products li.product .button:hover,
        .woocommerce-checkout .woocommerce button.button.alt,
        .woocommerce-checkout .woocommerce button.button.alt:hover,
        .woocommerce div.product form.cart .button,
        .woocommerce div.product form.cart .button:hover,
        .wc-block-grid__product-add-to-cart.wp-block-button .wp-block-button__link,
        .wc-block-grid__product-add-to-cart.wp-block-button .wp-block-button__link:hover,
        .woocommerce div.product form.cart .button:not(.btn),
        .woocommerce div.product form.cart .button:not(.btn):hover {
            color: <?php echo get_theme_mod('add_to_cart_button_text_color')?> !important;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('checkout_button_background_color'))) { ?>
        .b-shoppingcart .buttons .btn-primary,
        .b-shoppingcart .buttons .btn-primary:hover,
        .woocommerce-checkout .woocommerce button.button.alt,
        .woocommerce-checkout .woocommerce button.button.alt:hover,
        .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt,
        .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt:hover {
            background: <?php echo get_theme_mod('checkout_button_background_color')?> !important;
            border: 1px solid <?php echo get_theme_mod('checkout_button_background_color')?> !important;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('checkout_button_text_color'))) { ?>
        .b-shoppingcart .buttons .btn-primary,
        .b-shoppingcart .buttons .btn-primary:hover,
        .woocommerce-checkout .woocommerce button.button.alt,
        .woocommerce-checkout .woocommerce button.button.alt:hover,
        .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt,
        .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt:hover {
            color: <?php echo get_theme_mod('checkout_button_text_color')?> !important;
        }

        <?php } ?>

        <?php  if(get_theme_mod('sidebar_primary_position','right') === 'right'){ ?>
        #sidebar-primary {
            float: right;
            border-width: 0px 0px 0px 1px;
        }

        <?php } ?>

        <?php if(!empty(growtype_get_footer_text_color())){ ?>
        .site-footer li a + .sub-menu {
            border-color: <?php echo growtype_get_footer_text_color(); ?>;
        }

        <?php } ?>

        <?php if(get_theme_mod('primary_button_style_select') === 'button_style_2') { ?>
        .btn-primary,
        #sb_instagram .sbi_follow_btn a,
        .woocommerce-Reviews #respond input#submit {
            background: none;
            border-radius: 2px;
            color: black;
            border: 2px solid black;
            font-weight: bold;
        }

        <?php } ?>

        <?php if(get_theme_mod('secondary_button_style_select') === 'button_style_2') { ?>
        .btn-secondary {
            border: 1px solid #000;
            border-radius: 2px;
            text-transform: initial;
        }

        <?php } ?>

        <?php if(get_theme_mod('button_text_transform')){ ?>
        .btn-primary,
        .btn-secondary,
        input[type=submit],
        .wp-block-button__link {
            text-transform: <?php echo get_theme_mod('button_text_transform'); ?>;
        }

        <?php } ?>

    </style>
    <?php
}
