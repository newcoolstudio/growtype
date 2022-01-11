<?php

/**
 * Determine whether to show gdpr
 * @return bool
 */
function display_gdpr()
{
    static $display;

    $display = get_theme_mod('theme_general_gdpr_switch');

    return $display;
}
