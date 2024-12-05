<?php

/**
 * Add classes to body
 */
add_filter('body_class', 'growtype_extend_body_classes');
function growtype_extend_body_classes($classes)
{
    $classes[] = Growtype_Header::has_navbar() ? 'has-navbar' : null;
    $classes[] = 'header-' . growtype_get_header_type();
    $classes[] = 'footer-' . growtype_get_footer_type();
    $classes[] = growtype_header_has_extra_space() === true ? 'has-extraspace-header' : null;
    $classes[] = growtype_display_panel() ? 'has-panel' : null;
    $classes[] = growtype_display_sidebar_primary() ? 'has-sidebar-primary' : null;
    $classes[] = function_exists('growtype_post_is_front_post') && growtype_post_is_front_post() ? 'is-front-post' : null;
    $classes[] = growtype_header_is_absolute() ? 'has-absolute-header' : null;
    $classes[] = Growtype_Header::is_fixed() ? 'has-fixed-header' : 'has-static-header';
    $classes[] = get_theme_mod('burger_always_visible') ? 'has-always-visible-burger' : null;
    $classes[] = Growtype_Header::has_promo() ? 'has-promo-header' : null;
    $classes[] = get_theme_mod('header_hide_on_scroll_down') === true ? 'header-hide-onscroll' : null;

    if (growtype_is_home_page()) {
        $classes[] = 'is-home-page';
    }

    if (is_multisite()) {
        $classes[] = Growtype_Site::is_multisite_main_site() ? 'is-main-site' : 'is-child-site';
    }

    return $classes;
}

/**
 * Footer inner content
 */
add_action('growtype_footer_inner_content', 'growtype_footer_inner_content_callback');
function growtype_footer_inner_content_callback()
{
    $footer_html = App\template('partials.sections.footer.content');

    echo apply_filters('growtype_footer_inner_content_html', $footer_html);
}

/**
 * Header inner content
 */
add_action('growtype_header_inner_content', 'growtype_header_inner_content_callback');
function growtype_header_inner_content_callback()
{
    $header_html = App\template('partials.sections.header.content');

    echo apply_filters('growtype_header_inner_content_html', $header_html);
}

/**
 * Add navbar html
 */
add_action('growtype_navbar_html', 'growtype_navbar_html_callback');
function growtype_navbar_html_callback()
{
    $header_navbar_text = apply_filters('the_content', get_theme_mod('header_navbar_text'));

    if (Growtype_Header::has_navbar()) { ?>
        <div class="b-navbar">
            <div class="container">
                <div class="e-text"><?php echo $header_navbar_text ?></div>
            </div>
        </div>
    <?php }
}

add_action('growtype_footer_before_open', function () {
    $menu_mobile_is_active = apply_filters('growtype_menu_mobile_bottom_active', has_nav_menu('mobile-bottom'));

    if ($menu_mobile_is_active) { ?>
        <div class="menu-mobile-bottom-wrapper">
            <?php
            do_action('growtype_menu_mobile_bottom_after_open');

            wp_nav_menu(array (
                'theme_location' => 'mobile-bottom',
                'menu_id' => 'menu-mobile-bottom',
                'menu_class' => 'menu nav',
                'walker' => new Growtype_Nav_Walker()
            ));

            do_action('growtype_menu_mobile_bottom_before_close');
            ?>
        </div>
    <?php }
});
