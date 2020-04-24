<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.4.3
 */
class Home extends \Core\Controller
{

    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        //echo "(before) ";
        //return false;
        echo phpversion();
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
        //echo " (after)";
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        /*
        View::render('Home/index.php', [
            'name'    => 'Dave',
            'colours' => ['red', 'green', 'blue']
        ]);
        */
        View::renderTemplate('Home/index.html', [
            'name'    => 'Janis L',
            'colours' => ['red', 'green', 'blue']
        ]);
    }

    /**
     * Show the about page
     *
     * @return void
     */
    public function aboutAction()
    {

        View::renderTemplate('Home/about.html', [
            //
        ]);
    }
}
