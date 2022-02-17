<?php

/**
 *
 */
class Growtype_User_Account
{
    /**
     * Check if account page
     */
    public static function is_account_page()
    {
        global $wp;

        if (isset($_SERVER['REQUEST_URI'])) {
            $url_parts = explode('/', $_SERVER['REQUEST_URI']);
            if (!empty($url_parts)) {
                return in_array('my-account', explode('/', $_SERVER['REQUEST_URI']));
            }
        }

        return false;
    }

    /**
     * Check if account page
     */
    public static function is_dashboard_page()
    {
        global $wp;

        if (isset($_SERVER['REQUEST_URI'])) {
            $url_parts = explode('/', $_SERVER['REQUEST_URI']);
            if (!empty($url_parts)) {
                $url_parts = array_filter($url_parts, function ($value) {
                    return !empty($value);
                });

                return !empty($url_parts) && end($url_parts) === 'my-account';
            }
        }

        return false;
    }
}
