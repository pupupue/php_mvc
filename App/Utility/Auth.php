<?php

namespace App\Utility;

/**
 * Auth:
 *
 * @since 1.0.0
 */
class Auth {

    /**
     * Check Authenticated: Checks to see if the user is authenticated,
     * destroying the session and redirecting to a specific location if the user
     * session doesn't exist.
     * @access public
     * @param string $redirect
     * @since 1.0.2
     */
    //checks if session[user is not empty]
    public static function checkAuthenticated($redirect = "login") {
        Session::init();
        if (!Session::exists(Config::get("SESSION_USER"))) {
            Session::destroy();
            Redirect::to(APP_URL . $redirect);
        }
    }

    /**
     * Check Unauthenticated: Checks to see if the user is unauthenticated,
     * redirecting to a specific location if the user session exist.
     * @access public
     * @param string $redirect
     * @since 1.0.2
     */
    public static function checkUnauthenticated($redirect = "") {
        Session::init();
        if (Session::exists(Config::get("SESSION_USER"))) {
            Redirect::to(APP_URL . $redirect);
        }
    }

}
