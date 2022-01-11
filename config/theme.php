<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Theme Directory
    |--------------------------------------------------------------------------
    |
    | This is the absolute path to your theme directory.
    |
    | Example:
    |   /srv/www/example.com/current/web/app/themes/sage
    |
    */

    'dir' => get_theme_file_path(),

    /*
    |--------------------------------------------------------------------------
    | Theme Directory URI
    |--------------------------------------------------------------------------
    |
    | This is the web server URI to your theme directory.
    |
    | Example:
    |   https://example.com/app/themes/sage
    |
    */

    'uri' => get_theme_file_uri(),

    /*
    |--------------------------------------------------------------------------
    | Theme Version
    |--------------------------------------------------------------------------
    |
    |
    */

    'version' => !empty(env('THEME_VERSION')) ? env('THEME_VERSION') : '1.0',
];
