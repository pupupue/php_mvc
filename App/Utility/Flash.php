<?php

namespace App\Utility;

/**
 * Flash:
 *
 * @since 1.0.0
 */
class Flash {

    /**
     * Session: Sets a session message or returns the value of a specific key of
     * the session.
     * @access public
     * @param string $key
     * @param string $value [optional]
     * @return string|null returns session message string or nothing
     * @since 1.0.1
     */
    public static function session($key, $value = "") {
        if (Session::exists($key) && empty($value)) {
            //called like flash::danger();
            $session = Session::get($key);
            Session::delete($key);
            return $session;
        } elseif (!empty($value)) {
            //called like flash::danger('you have to login');
            return(Session::put($key, $value)); // set key value
        }
        return null;
    }

    /**
     * Danger: Sets a message or returns the value of the $_SESSION['danger'] key of
     * the session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.0
     */
    public static function danger($value = "") {
        return(self::session("danger", $value));
    }

    /**
     * Info: Sets a message or returns the value of the $_SESSION['info'] key of the
     * session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.0
     */
    public static function info($value = "") {
        return(self::session("info", $value));
    }

    /**
     * Success: Sets a message or returns the value of the $_SESSION['success'] key of
     * the session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.0
     */
    public static function success($value = "") {
        return(self::session("success", $value));
    }

    /**
     * Warning: Sets a message or returns the value of the $_SESSION['warning'] key of
     * the session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.0
     */
    public static function warning($value = "") {
        return(self::session("warning", $value));
    }

}
