<?php

namespace App\Controllers\Admin;

/**
 * User admin controller
 * [reuse users to make admin]
 * PHP version 7.4.3
 */
class Users extends \Core\Controller
{

    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        // Make sure an admin user is logged in for example
        // return false;
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {

    }
}
