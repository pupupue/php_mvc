<?php

/**
 * Front controller
 *
 * PHP version 7.4.3
 */

/**
 * Composer autoloader
 * custom 
 * and
 * Twig
 * and
 * ect.
 */
require '../vendor/autoload.php';

/**
 * Error and Exception handling 
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']); //static
$router->add('about', ['controller' => 'Home', 'action' => 'about']); //static
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
    
$router->dispatch($_SERVER['QUERY_STRING']);

















// manual way
/**
 * Autoloader
 */
// spl_autoload_register(function ($class) {
//     $root = dirname(__DIR__);   // get the parent directory
//     $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
//     if (is_readable($file)) {
//         require $root . '/' . str_replace('\\', '/', $class) . '.php';
//     }
// });