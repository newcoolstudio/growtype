<?php

if (!function_exists('d')) {
    function d($data)
    {
        highlight_string("<?php\n" . var_export($data, true) . ";\n?>");
        die();
    }
}

if (!function_exists('ddd')) {
    function ddd($arr)
    {
        return '<pre>' . var_export($arr, false) . '</pre>';
    }
}

if (!function_exists('is_debug')) {
    function is_debug()
    {
        return isset($_GET['debug']) && $_GET['debug'] === 'true';
    }
}
