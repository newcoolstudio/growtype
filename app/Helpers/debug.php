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

if (!function_exists('growtype_log')) {
    /**
     * Log data to a custom file in web/app/logs
     *
     * @param mixed $data Data to log
     * @param string $filename Filename to log to
     */
    function growtype_log($data, $filename = 'general')
    {
        $logs_dir = defined('WP_CONTENT_DIR') ? WP_CONTENT_DIR . '/logs' : dirname(__DIR__, 4) . '/logs';

        if (!is_dir($logs_dir)) {
            mkdir($logs_dir, 0755, true);
        }

        // Add date to filename
        $date = date('Y-m-d');
        $file_info = pathinfo($filename);
        $filename = ($file_info['filename'] ?? 'debug') . '-' . $date . '.' . ($file_info['extension'] ?? 'log');

        $log_file = $logs_dir . '/' . $filename;
        $timestamp = date('Y-m-d H:i:s');
        $formatted_data = is_array($data) || is_object($data) ? var_export($data, true) : $data;

        $log_entry = "[$timestamp] $formatted_data" . PHP_EOL . "------------------------------------------------------------" . PHP_EOL;

        file_put_contents($log_file, $log_entry, FILE_APPEND);
    }
}

