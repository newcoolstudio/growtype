<?php

/**
 * Growtype header
 * Requires:
 */
class Growtype_Header
{
    public function __construct()
    {
        add_action('growtype_header_inner_after_open', array ($this, 'growtype_header_inner_after_open_extend'), 10);
        add_action('growtype_header_inner_before_close', array ($this, 'growtype_header_inner_before_close_extend'), 10);
    }

    function growtype_header_inner_after_open_extend()
    {
        if (get_theme_mod('header_mobile_menu_position') === 'left' && !get_theme_mod('mobile_menu_disabled')) {
            echo App\template('partials.components.hamburger');
        }
    }

    function growtype_header_inner_before_close_extend()
    {
        if (!get_theme_mod('mobile_menu_disabled') && (empty(get_theme_mod('header_mobile_menu_position')) || get_theme_mod('header_mobile_menu_position') === 'right')) {
            echo App\template('partials.components.hamburger');
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
            $fixed_header = page_is_among_enabled_pages($fixed_header_pages);
        }

        return $fixed_header === true ? true : false;
    }

    /**
     * @return bool
     */
    public static function has_promo(): bool
    {
        $promo_enabled = !empty(get_theme_mod('header_promo_enabled')) ? get_theme_mod('header_promo_enabled') : false;

        return $promo_enabled;
    }

    /**
     * @return bool
     */
    public static function promo_content(): string
    {
        return apply_filters('the_content', get_theme_mod('header_promo_content'));
    }
}

new Growtype_Header();
