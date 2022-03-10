<?php

/**
 *
 */
class Growtype_Search
{
    /**
     * @return string
     */
    public static function permalink()
    {
        if (class_exists('woocommerce')) {
            if (is_search() && !is_shop()) {
                return home_url('/');
            }

            return get_permalink(wc_get_page_id('shop'));
        }

        return get_permalink();
    }

    /**
     * @return bool
     */
    public static function enabled()
    {
        $search_enabled = get_theme_mod('search_enabled');
        $search_enabled_pages = get_theme_mod('search_enabled_pages');

        if ($search_enabled && !empty($search_enabled_pages)) {
            $search_enabled = false;

            if (page_is_among_enabled_pages($search_enabled_pages)) {
                $search_enabled = true;
            }
        }

        return $search_enabled;
    }
}
