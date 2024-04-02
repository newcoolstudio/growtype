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
            self::delete($name);
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

        $name = substr($name, 0, 150);

        if (!empty($name) && !empty($data) && !empty($time)) {
            return set_transient($name, $data, $time);
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public static function delete($name)
    {
        return delete_transient($name);
    }
}
