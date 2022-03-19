<?php

/**
 * Growtype header
 * Requires:
 */
class Growtype_Header
{
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
