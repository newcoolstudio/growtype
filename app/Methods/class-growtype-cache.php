<?php

use function App\config;

/**
 * Growtype header
 * Requires:
 */
class Growtype_Cache
{
    /**
     * @param $name
     * @return mixed
     */
    public static function get($name)
    {
        if (config('cache.clear_transient_cache_on_load')) {
            delete_transient($name);
        }

        return get_transient($name);
    }

    /**
     * @param $name
     * @return mixed
     */
    public static function set($name, $data, $time = null)
    {
        if (empty($time)) {
            $time = config('cache.default_expiration_time');
        }

        set_transient($name, $data, $time);
    }
}
