<?php

namespace App\Utility;

/**
 * Session:
 *
 * @since 1.0.0
 */
class Session {


    /**
     * Init: Start the session.
     * @access public
     * @return void
     * @since 1.0.0
     */
    public static function init() {
        // If no session exist, start the session.
        if (session_id() == "") {
            session_start();
        }
    }

    /**
     * Put: Sets a value to a key in session
     * @access public
     * @param string $key
     * @param string $value
     * @return string
     * @since 1.0.0
     */
    public static function put($key, $value) {
        return($_SESSION[$key] = $value);
    }
    
    /**
     * Delete: Deletes the value of a specific key of the session.
     * @access public
     * @param string $key
     * @return boolean
     * @since 1.0.0
     */
    public static function delete($key) {
        if (self::exists($key)) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }

    /**
     * Exists: Checks if a specific key of a session exists.
     * @access public
     * @param string $key
     * @return boolean
     * @since 1.0.0
     */
    public static function exists($key) {
        return(isset($_SESSION[$key]));
    }

    /**
     * Get: Returns the value of a specific key of the session if it exists.
     * @access public
     * @param string $key
     * @return string|nothing
     * @since 1.0.0
     */
    public static function get($key) {
        if (self::exists($key)) {
            return($_SESSION[$key]);
        }
    }

    /**
     * Destroy: Deletes the session.
     * @access public
     * @return void
     * @since 1.0.0
     */
    public static function destroy() {
        session_destroy();
    }


}
