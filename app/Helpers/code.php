<?php

if(!function_exists('d')){
    function d($data, $die = true)
    {
        highlight_string("<?php\n" . var_export($data, true) . ";\n?>");
        if ($die) {
            die();
        }
    }
}

if(!function_exists('ddd')){
    function ddd($arr)
    {
        return '<pre>' . var_export($arr, false) . '</pre>';
    }
}
