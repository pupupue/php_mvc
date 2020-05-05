<?php

namespace App\Controllers;

use App\Utility\Redirect;
use App\Utility\Flash;
use App\Utility\Session;
use \Core\View;
use App\Models\User;
/**
 * Users controller
 *
 * PHP version 7.4.3
 */
class Users extends \Core\Controller
{

    /**
     * Constructor:
     * @access public
     * @since 1.0.0
     */
    public function __construct($route_params)
    {
        $this->userModel = new User;
        $this->route_params = $route_params;
        Session::init();
    }

    /**
     * Register:
     * Loads register page
     * And
     * Handles form submition
     * @access public
     * @since 1.0.0
     */

    public function registerAction()
    {

        // IF post request
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
        //sanitize 
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //init data
        $data = [
            'email' => trim($_POST['email']),
            'forename' => trim($_POST['forename']),
            'surname' => trim($_POST['surname']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
        ];
        $errors=[
            'email_err' => '',
            'forename_err' => '',
            'surname_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
        ];

        //validate email
        if(empty($data['email'])){
            $errors['email_err'] = 'Please enter email';
        } else {
            // check is email perhaps
            // check have email
            if($this->userModel->findUserByEmail($data['email'])){
                $errors['email_err'] = 'Email is already taken';
            }
        }
        //validate name
        if(empty($data['forename'])){
            $errors['forename_err'] = 'Please enter name';
        }
        //validate surname
        if(empty($data['surname'])){
            $errors['surname_err'] = 'Please enter surname';
        }    
        //validate password
        if(empty($data['password'])){
            $errors['password_err'] = 'Please enter password';
        } elseif(strlen($data['password']) < 8){
            $errors['password_err'] ='Password must be atleast 8 characters';
        }
        //validate password again
        if(empty($data['confirm_password'])){
            $errors['confirm_password_err'] = 'Please enter password';
        } else {
            if($data['password'] != $data['confirm_password']){
                $errors['confirm_password_err'] = 'Passwords dont match';
            }
        }

        //make sure errors are empty
        if(empty($errors['email_err']) && empty($errors['forename_err']) && empty($errors['surname_err']) && empty($errors['password_err']) && empty($errors['confirm_password_err']) ){
            // Here we are validated
            try {
            // Hash password // med safety
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            //dont need confirm password field in database
            unset($data['confirm_password']);
            // Register User
        
            $this->userModel->createUser($data);
            Flash::success('User registered successfully!');
            Redirect::to("users/login");
            
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        } else {
            //load view 

            View::renderTemplate('Users/register.html', [
                'var' => 'register form',
                'data' => $data,
                'errors' => $errors
            ]);
        }

  
        } else {
            // Default case
            $data = [
                'email' => '',
                'forename' => '',
                'surname' => '',
                'password' => '',
                'confirm_password' => '',
            ];
            $errors=[
                'email_err' => '',
                'forename_err' => '',
                'surname_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];
            $feedback = [// reset case by default
                'success' => Flash::success(),
                'danger' => Flash::danger(),
                'info' => Flash::info(),
                'warning' => Flash::warning()
            ];

            View::renderTemplate('Users/register.html', [
                'var' => 'register form',
                'data' => $data,
                'errors' => $errors,
                'feedback' => $feedback
            ]);

        }
    }

    /**
     * Login:
     * Loads login page
     * And
     * Handles form submition
     * @access public
     * @since 1.0.0
     */

    public function loginAction()
    {
        //check already logged in
        if(Session::exists('user_id')){
            Redirect::to('posts/index');
        }

        //checking post
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //sanitize Post data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //init data
        $data = [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password'])
        ];
        $errors=[
            'email_err' => '',
            'password_err' => ''
        ];

        // validate email
        if(empty($data['email'])){
            $errors['email_err'] = 'Please enter email';
        }
        // validate password
        if(empty($data['password'])){
            $errors['password_err'] = 'Please enter password';
        } elseif(strlen($data['password']) < 8){
            $errors['password_err'] = 'Password must be atleast 8 characters';
        }

        if($this->userModel->findUserByEmail($data['email'])){
            //user found

        } else {
            // email error
            $errors['email_error'] = 'Please check your login';
        }

 
        if(empty($errors['email_err']) && empty($errors['password_err']) ){
            // Validated
            // check and login user
            $userLoggedIn = $this->userModel->login($data['email'], $data['password']);

            if($userLoggedIn){
                // create session

                if($this->userModel->createUsersSession($userLoggedIn)){
                    Redirect::to("posts/index");
                }

            } else {
                $errors['password_err'] = 'Please check your password';
                //load view 
                View::renderTemplate('Users/login.html', [
                'var' => 'login form',
                'data' => $data,
                'errors' => $errors
                ]);

            }

        }


        } else {
            //first load
            //init data
            
            $data = [
                'email' => '',
                'password' => ''

            ];
            $errors=[
                'email_err' => '',
                'password_err' => ''
            ];
            $feedback = [
                'success' => Flash::success(),
                'danger' => Flash::danger(),
                'info' => Flash::info(),
                'warning' => Flash::warning()
            ];

            View::renderTemplate('Users/login.html', [
                'var' => 'login form',
                'data' => $data,
                'errors' => $errors,
                'feedback' => $feedback
            ]);

        }
    }


    /**
     * Logout
     * @access public
     * @since 1.0.0
     * @return void
     */
    public function logoutAction()
    {

        Session::delete('user_id');
        Session::delete('user_email');
        Session::delete('user_name');
        Session::delete('user_surname');
        Session::destroy();
        Redirect::to("users/login");
    }

    /**
     * Show the add new page
     * @access public
     * @since 1.0.0
     * @return void
     */
    public function addNewAction()
    {
 

    }
    
    /**
     * Show the edit page
     * @access public
     * @since 1.0.0
     * @return void
     */
    public function editAction()
    {

    }
}

// echo 'Hello from the edit action in the Posts controller!';
// echo '<p>Route parameters: <pre>' .
//      htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';




