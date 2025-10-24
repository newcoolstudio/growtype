<?php

use function App\config;

/**
 * Growtype header
 * Requires:
 */
class Growtype_Cache
{
    protected static $group = 'growtype_cache';

    /**
     * Get cached data
     *
     * @param string $name
     * @return mixed
     */
    public static function get($name)
    {
        if (config('cache.clear_on_load')) {
            self::delete($name);
        }

        return wp_cache_get($name, self::$group);
    }

    /**
     * Get cached data
     *
     * @param string $name
     * @return mixed
     */
    public static function get_transient($name)
    {
        if (config('cache.clear_transient_cache_on_load')) {
            self::delete($name);
        }

        return get_transient($name);
    }

    /**
     * Set cache data
     *
     * @param string $name
     * @param mixed $data
     * @param int|null $time Expiration in seconds (optional, only for reference)
     * @return bool
     */
    public static function set($name, $data)
    {
        $name = substr($name, 0, 150);

        if (!empty($name) && !empty($data)) {
            return wp_cache_set($name, $data, self::$group);
        }

        return false;
    }

    /**
     * @param $name
     * @param $data
     * @param $time
     * @return bool|void
     */
    public static function set_transient($name, $data, $time = null)
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
     * Delete cached data
     *
     * @param string $name
     * @return bool
     */
    public static function delete($name)
    {
        return wp_cache_delete($name, self::$group);
    }

    /**
     * @param $name
     * @return bool
     */
    public static function delete_transient($name)
    {
        return delete_transient($name);
    }
}
