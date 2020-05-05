<?php

namespace App\Controllers;

use \Core\View;
use App\Utility\Session;
use App\Utility\Redirect;

/**
 * Home controller
 *
 * PHP version 7.4.3
 */
class Home extends \Core\Controller
{

    /**
     * Constructor:
     * @access public
     * @since 1.0.0
     */
    public function __construct($route_params)
    {
        Session::init();
        $this->route_params = $route_params;
    }

    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        //echo "(before) ";
        //return false;
        //echo phpversion();
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
        if(Session::exists('user_id')){
            Redirect::to('posts/index');
        }
        View::renderTemplate('Home/index.html', [

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

    /**
     * Show the test page
     * delete this
     * @return void
     */
    public function testAction()
    {
        $key = "yes";
        $value = "";
        if ($key != "" && empty($value)) {
            echo "if";
        } elseif (!empty($value)) {
            echo "elseif";
        }
    }

    
}
