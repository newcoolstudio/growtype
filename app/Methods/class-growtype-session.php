<?php

class Growtype_Session
{
    /**
     * Release PHP session lock to allow concurrent requests.
     * Useful for long-running processes like AI generation or video processing.
     * 
     * @return bool True if session was released, false if it wasn't active.
     */
    public static function release()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
            return true;
        }

        return false;
    }
}
