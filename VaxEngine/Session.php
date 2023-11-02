<?php

/**
 * Confessionally session class.
 *
 */
class Session {

    /**
     * Start session.
     */
    public static function startSession() {
        session_name("VaxKid");
        session_start();
    }

    /**
     * Destroy session.
     */
    public static function destroySession() {

        session_destroy();
    }

    /**
     * Set session data.
     * @param mixed $key Key that will be used to store value.
     * @param mixed $value Value that will be stored.
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * Unset session data with provided key.
     * @param $key
     */
    public static function destroy($key) {
        if ( isset($_SESSION[$key]) ) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Get data from $_SESSION variable.
     * @param mixed $key Key used to get data from session.
     * @param mixed $default This will be returned if there is no record inside
     * session for given key.
     * @return mixed Session value for given key.
     */
    public static function get($key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

}
