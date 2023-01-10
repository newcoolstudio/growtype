<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Assets Path URI
    |--------------------------------------------------------------------------
    |
    | The asset manifest contains relative paths to your assets. This URI will
    | be prepended when using Sage's asset management system. Change this if
    | you are using a CDN.
    |
    */

    'env' => !empty(env('WP_ENV')) ? env('WP_ENV') : 'development',
];
