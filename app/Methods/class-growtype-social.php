<?php

/**
 * Growtype social methods
 * Requires:
 */
class Growtype_Social
{

    /**
     * @return bool
     */
    public static function icons_enabled()
    {
        $icons_enabled = false;

        if (
            get_theme_mod('header_navbar_social_facebook') ||
            get_theme_mod('header_navbar_social_instagram') ||
            get_theme_mod('header_navbar_social_pinterest') ||
            get_theme_mod('header_navbar_social_twitter') ||
            get_theme_mod('header_navbar_social_linkedin')
        ) {
            $icons_enabled = true;
        }

        return $icons_enabled;
    }
}
