<?php

/**
 * Growtype header
 * Requires:
 */
class Growtype_Header
{
    public function __construct()
    {
        add_action('growtype_header_inner_after_open', array ($this, 'growtype_header_inner_after_open_extend'), 20);
        add_action('growtype_header_inner_before_close', array ($this, 'growtype_header_inner_profile_menu'), 20);
        add_action('growtype_header_inner_before_close', array ($this, 'growtype_header_inner_hamburger'), 20);
    }

    function growtype_header_inner_after_open_extend()
    {
        if (get_theme_mod('header_mobile_menu_position') === 'left' && !get_theme_mod('mobile_menu_disabled')) {
            echo App\template('partials.components.hamburger');
        }

        if (growtype_display_panel()) {
            echo '<div class="btn-panel-open"><svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><g fill="currentColor" fill-rule="evenodd"><path d="M14 17h4V7h-4v10zM12 6.007C12 5.45 12.453 5 12.997 5h6.006c.55 0 .997.45.997 1.007v11.986c0 .556-.453 1.007-.997 1.007h-6.006c-.55 0-.997-.45-.997-1.007V6.007z" fill-rule="nonzero"></path><rect x="4" y="5" width="6" height="2" rx="1"></rect><rect x="4" y="9" width="6" height="2" rx="1"></rect><rect x="4" y="13" width="6" height="2" rx="1"></rect><rect x="4" y="17" width="6" height="2" rx="1"></rect></g></svg></div>';
        }
    }

    function growtype_header_inner_hamburger()
    {
        $hamburger_visible = !get_theme_mod('mobile_menu_disabled') && (empty(get_theme_mod('header_mobile_menu_position')) || get_theme_mod('header_mobile_menu_position') === 'right');
        $hamburger_visible = apply_filters('growtype_header_inner_hamburger_visible', $hamburger_visible);

        if ($hamburger_visible) {
            echo App\template('partials.components.hamburger');
        }
    }

    function growtype_header_inner_profile_menu()
    {
        if (Growtype_User::profile_menu_is_enabled()) {
            echo App\template('partials.components.menu.user-profile');
        }
    }

    /**
     * @return bool
     */
    public static function is_fixed(): bool
    {
        $fixed_header = !empty(get_theme_mod('header_is_fixed_switch')) ? get_theme_mod('header_is_fixed_switch') : false;
        $fixed_header_pages = get_theme_mod('header_fixed_dropdown_control');

        if ($fixed_header && !empty($fixed_header_pages)) {
            $fixed_header = growtype_page_is_among_enabled_pages($fixed_header_pages);
        }

        return $fixed_header === true ? true : false;
    }

    /**
     * @return bool
     */
    public static function has_promo(): bool
    {
        $enabled = !empty(get_theme_mod('header_promo_enabled')) ? get_theme_mod('header_promo_enabled') : false;

        return $enabled;
    }

    /**
     * @return bool
     */
    public static function has_navbar(): bool
    {
        $enabled = !empty(get_theme_mod('header_navbar_switch')) ? get_theme_mod('header_navbar_switch') : false;
        $enabled_pages = get_theme_mod('header_navbar_enabled_pages');

        if ($enabled && !empty($enabled_pages)) {
            $enabled = growtype_page_is_among_enabled_pages($enabled_pages);
        }

        return $enabled;
    }

    /**
     * @return bool
     */
    public static function promo_content(): string
    {
        return apply_filters('the_content', get_theme_mod('header_promo_content'));
    }

    /**
     * @return bool
     */
    public static function extra_content(): string
    {
        $extra_content = apply_filters('the_content', get_theme_mod('header_extra_content'));

        return apply_filters('growtype_header_extra_content', $extra_content);
    }
}

new Growtype_Header();
