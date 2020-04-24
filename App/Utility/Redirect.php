<?php

namespace App\Utility;

/**
 * Redirect:
 *
 * @since 1.0.0
 */
class Redirect {

    /**
     * To: Redirects to a specific path.
     * @access public
     * @param string $location [optional]
     * @return void
     * @since 1.0.0
     */
    public static function to($location = "") {
        header('location:' . URLROOT. '/' . $location);
    }

}













