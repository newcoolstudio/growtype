<?php

/**
 * Styles applied
 */
add_action('wp_head', 'growtype_customizer_general_css');
function growtype_customizer_general_css()
{
    ?>
    <style>
        <?php if(!empty(get_theme_mod('header_background_color'))){ ?>
        .site-header {
            background-color: <?php echo get_theme_mod('header_background_color'); ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('footer_background_color'))){ ?>
        .site-footer {
            background-color: <?php echo !empty(get_theme_mod('footer_background_color')) ? get_theme_mod('footer_background_color') : '#F5F6F7' ?>;
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

        <?php if(!empty(get_theme_mod('header_text_color_scroll'))){ ?>
        .site-header.is-scroll .header-inner a {
            color: <?php echo get_theme_mod('header_text_color_scroll') ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('mobile_menu_burger_color'))){ ?>
        .site-header.is-scroll .hamburger-inner, .is-pasive .hamburger-inner {
            background: <?php echo get_theme_mod('mobile_menu_burger_color'); ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_scroll_background_color'))){ ?>
        .site-header.is-scroll, .home .site-header.is-scroll {
            background: <?php echo !empty(get_theme_mod('header_scroll_background_color')) ? get_theme_mod('header_scroll_background_color') : ''; ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('mobile_menu_bg_color'))){ ?>
        .main-navigation-mobile-content {
            background: <?php echo get_theme_mod('mobile_menu_bg_color') ?>
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_text_color'))){ ?>
        .header-inner, .header-inner a {
            color: <?php echo get_theme_mod('header_text_color') ?>
        }

        .hamburger-inner {
            background: <?php echo !empty(get_theme_mod('header_text_color')) ? get_theme_mod('header_text_color') : 'black' ?>
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_home_background_color'))){ ?>
        .home .site-header {
            background: <?php echo !empty(get_theme_mod('header_home_background_color')) ? get_theme_mod('header_home_background_color') : 'none' ?>
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_text_color_home'))){ ?>
        .home .header-inner, .home .header-inner a {
            color: <?php echo get_theme_mod('header_text_color_home') ?>
        }

        .home .hamburger-inner {
            background: <?php echo !empty(get_theme_mod('header_text_color_home')) ? get_theme_mod('header_text_color_home') : 'black' ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('mobile_menu_text_color'))){ ?>
        .hamburger.is-active .hamburger-inner {
            background: <?php echo !empty(get_theme_mod('mobile_menu_text_color')) ? get_theme_mod('mobile_menu_text_color') : 'white'; ?>;
        }

        .site-header .main-navigation-mobile .menu li a,
        .main-navigation-mobile-type-2 .menu-item-has-children:before,
        .site-header.is-scroll .menu-mobile-container .menu li a {
            color: <?php echo get_theme_mod('mobile_menu_text_color') ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_logo_size_desktop'))){ ?>
        .header-logo-wrapper {
            max-width: <?php echo!empty(get_theme_mod('header_logo_size_desktop')) ? get_theme_mod('header_logo_size_desktop') : '180'?>px;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_logo_position_vertical_desktop'))){ ?>
        .header-logo-wrapper {
            top: <?php echo!empty(get_theme_mod('header_logo_position_vertical_desktop')) ? get_theme_mod('header_logo_position_vertical_desktop') : '0'?>px;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_logo_size_mobile'))){ ?>
        @media only screen and (max-width: 769px) {
            .header-logo-wrapper {
                max-width: <?php echo!empty(get_theme_mod('header_logo_size_mobile')) ? get_theme_mod('header_logo_size_mobile') : '200'?>px;
            }
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('header_logo_position_vertical_mobile'))){ ?>
        @media only screen and (max-width: 769px) {
            .header-logo-wrapper {
                top: <?php echo!empty(get_theme_mod('header_logo_position_vertical_mobile')) ? get_theme_mod('header_logo_position_vertical_mobile') : '0'?>px;
            }
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('body_background_color'))){ ?>
        body {
            background: <?php echo get_theme_mod('body_background_color')?>;
        }

        <?php }?>

        <?php if(!empty(get_theme_mod('body_text_color'))){ ?>
        body {
            color: <?php echo get_theme_mod('body_text_color')?>;
        }

        <?php }?>

        <?php if(!empty(get_fonts_details()['primaryFontDetails'])){ ?>
        body {
            font-family: "<?php echo get_fonts_details()['primaryFontDetails']->font?>", sans-serif;
            font-weight: <?php echo urlencode(get_fonts_details()['primaryFontDetails']->regularweight)?>;
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

        <?php if(!empty(get_theme_mod('primary_button_main_color'))) { ?>
        #sb_instagram .sbi_follow_btn a, .btn-primary, .wp-block-button__link, .woocommerce-cart .woocommerce button.button, .woocommerce-Reviews #respond input#submit {
            background: <?php echo get_theme_mod('primary_button_main_color')?>;
            color: #fff;
            border: 1px solid<?php echo get_theme_mod('primary_button_main_color')?>;
        }

        <?php } ?>

        <?php if(get_theme_mod('woocommerce_checkout_order_review_table') === false) { ?>
        .woocommerce-checkout-review-order table.shop_table {
            display: none;
        }

        <?php } ?>

        <?php if(get_theme_mod('fonts_font_size_h1')) { ?>
        h1 {
            font-size: <?php echo get_theme_mod('fonts_font_size_h1')?>px;
        }

        <?php } ?>

        <?php if(get_theme_mod('fonts_font_size_h2')) { ?>
        h2 {
            font-size: <?php echo get_theme_mod('fonts_font_size_h2')?>px;
        }

        <?php } ?>

        <?php if(get_theme_mod('fonts_font_size_h3')) { ?>
        h3 {
            font-size: <?php echo get_theme_mod('fonts_font_size_h3')?>px;
            line-height: 130%;
        }

        <?php } ?>

        <?php if(get_theme_mod('fonts_font_size_h4')) { ?>
        h4 {
            font-size: <?php echo get_theme_mod('fonts_font_size_h4')?>px;
        }

        <?php } ?>

        <?php if(get_theme_mod('fonts_font_size_h5')) { ?>
        h5 {
            font-size: <?php echo get_theme_mod('fonts_font_size_h5')?>px;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('fonts_font_size_p')) && get_theme_mod('fonts_font_size_p')) { ?>
        p {
            font-size: <?php echo get_theme_mod('fonts_font_size_p')?>px;
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
        .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt,
        .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt:hover,
        .woocommerce div.product form.cart .button,
        .woocommerce div.product form.cart .button:hover,
        .wc-block-grid__product-add-to-cart.wp-block-button .wp-block-button__link,
        .wc-block-grid__product-add-to-cart.wp-block-button .wp-block-button__link:hover,
        .woocommerce div.product form.cart .button:not(.btn),
        .woocommerce div.product form.cart .button:not(.btn):hover {
            background: <?php echo get_theme_mod('add_to_cart_button_background_color')?>;
            border: 1px solid<?php echo get_theme_mod('add_to_cart_button_background_color')?>;
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
            color: <?php echo get_theme_mod('add_to_cart_button_text_color')?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('checkout_button_background_color'))) { ?>
        .b-shoppingcart .buttons .btn-primary,
        .b-shoppingcart .buttons .btn-primary:hover,
        .woocommerce-checkout .woocommerce button.button.alt,
        .woocommerce-checkout .woocommerce button.button.alt:hover,
        .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt,
        .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt:hover {
            background: <?php echo get_theme_mod('checkout_button_background_color')?>;
            border: 1px solid<?php echo get_theme_mod('checkout_button_background_color')?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('checkout_button_text_color'))) { ?>
        .b-shoppingcart .buttons .btn-primary,
        .b-shoppingcart .buttons .btn-primary:hover,
        .woocommerce-checkout .woocommerce button.button.alt,
        .woocommerce-checkout .woocommerce button.button.alt:hover,
        .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt,
        .woocommerce-cart .wc-proceed-to-checkout .checkout-button.button.alt:hover {
            color: <?php echo get_theme_mod('checkout_button_text_color')?>;
        }

        <?php } ?>

        <?php  if(get_theme_mod('sidebar_primary_position') === 'right'){ ?>
        #sidebar-primary {
            float: right;
            border-width: 0px 0px 0px 1px;
        }

        <?php } ?>

        <?php if(get_theme_mod('sidebar_shop_position') === 'right'){ ?>
        #sidebar-shop {
            float: right;
            border-width: 0px 0px 0px 1px;
        }

        <?php } ?>

        <?php if(get_theme_mod('footer_background_color')){ ?>
        .site-footer {
            background: <?php echo get_theme_mod('footer_background_color'); ?>;
        }

        <?php } ?>

        <?php if(get_theme_mod('footer_text_color')){ ?>
        .site-footer, .site-footer a, .site-footer a .dashicons {
            color: <?php echo get_theme_mod('footer_text_color'); ?>;
        }

        <?php } ?>

        <?php if(get_theme_mod('panel_is_sticky')){ ?>
        .panel-area {
            position: sticky;
        }

        <?php } ?>
    </style>
    <?php
}

/**
 *
 */
add_action('wp_head', 'growtype_customizer_buttons_css');
function growtype_customizer_buttons_css()
{
    ?>
    <style>
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

        <?php if(get_theme_mod('secondary_button_border_color')){ ?>
        .btn-secondary {
            border-color: <?php echo get_theme_mod('secondary_button_border_color'); ?>;
        }

        <?php } ?>

        <?php if(get_theme_mod('button_text_transform')){ ?>
        .btn-primary,
        .btn-secondary,
        input[type=submit] {
            text-transform: <?php echo get_theme_mod('button_text_transform'); ?>;
        }

        <?php } ?>

        <?php if(get_theme_mod('button_border_radius')){ ?>
        .btn-primary,
        .btn-secondary,
        input[type=submit],
        .wp-block-button__link {
            border-radius: <?php echo get_theme_mod('button_border_radius'); ?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('secondary_button_background_color'))) { ?>
        .btn-secondary,
        .btn-secondary:hover {
            background: <?php echo get_theme_mod('secondary_button_background_color')?>;
            border: 1px solid<?php echo get_theme_mod('secondary_button_background_color')?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('secondary_button_text_color'))) { ?>
        .btn-secondary,
        .btn-secondary a,
        .btn-secondary:hover {
            color: <?php echo get_theme_mod('secondary_button_text_color')?>;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('primary_button_background_color'))) { ?>
        .btn-primary,
        .btn-primary:hover,
        input[type=submit],
        input[type=submit]:hover,
        .wp-block-button__link,
        .wp-block-button__link:hover {
            background: <?php echo get_theme_mod('primary_button_background_color')?> !important;
            border: 1px solid <?php echo get_theme_mod('primary_button_background_color')?> !important;
        }

        <?php } ?>

        <?php if(!empty(get_theme_mod('primary_button_text_color'))) { ?>
        .btn-primary,
        .btn-primary:hover,
        input[type=submit],
        input[type=submit]:hover,
        .wp-block-button__link,
        .wp-block-button__link:hover,
        .btn-link {
            color: <?php echo get_theme_mod('primary_button_text_color')?>;
        }

        <?php } ?>
    </style>
    <?php
}
