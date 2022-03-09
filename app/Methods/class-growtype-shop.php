<?php

/**
 * Growtype shop methods
 * Requires:
 */
class Growtype_Shop
{
    /**
     * @return bool
     */
    public static function selling_type_single(): bool
    {
        return get_theme_mod('shop_selling_type_select') === 'shop_selling_type_single';
    }
}
