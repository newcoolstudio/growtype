<?php

/**
 *
 */
class Growtype_Search
{
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
