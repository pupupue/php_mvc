<?php

namespace App\Models;
use App\Utility\Session;
/**
 * User Model:
 *
 * @author Janis Laurins 
 * 
 * PHP version 7.4.3
 * @since 1.0.0
 */

class User extends \Core\Model {

    protected static $db_table = "users";

    /**
     * Find user by Email:
     * @access public
     * @param string $email 
     * @return true:false if found
     * @since 1.0.0
     * 
     * //can be rewritten better with code from core/model
     * 
     */
    public function findUserByEmail($email){
        $sql = 'SELECT * FROM users WHERE email = :email';
        $row = $this->db->query($sql,[':email'=>$email]);
        //check if found
        if($this->db->count() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Create User: Inserts a new user into the database, returns unique
     * user if successful, otherwise returns false.
     * @access public
     * @param array $fields
     * @return string|boolean
     * @since 1.0.0
     * @throws Exception
     */
    public function createUser(array $fields) {
        if (!$userID = $this->create(static::$db_table, $fields)) {
            throw new \Exception("failed to make user");
        }
        return $userID;
    }

    /**
     * Login: Validates the login from form by email and password
     * returns users_data array if validates ? false
     * @access public
     * @param string email
     * @param string password
     * @return mixed|boolean
     * @since 1.0.0
     */
    public function login($email, $password){
        $user = $this->get(static::$db_table, 'email', "=", $email);
        $user_data = $user->results();
        $user_data = $user_data[0];//->first()
        $db_password = $user_data['password'];
        if(password_verify($password, $db_password)){
            return $user_data;
        }
        return false;
    }

    /**
     * Is logged in: 
     * @access public
     * @return boolean
     * @since 1.0.0
     */
    public function isLoggedIn(){
        if(Session::exists('user_id')){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Update User: Updates a specified user record in the database.
     * @access public
     * @param array $fields
     * @param integer $userID [optional]
     * @return void
     * @since 1.0.0
     * @throws Exception
     */
    public function updateUser(array $fields, $userID = null) {
        if (!$this->update(static::$db_table, $fields, $userID)) {
            throw new Exception("User failed to update");
        }
    }

    /**
     * Create User Session:
     * @access public
     * @param array $fields
     * @param integer $userID [optional]
     * @return boolean
     * @since 1.0.0
     * @throws Exception
     */
    public function createUsersSession($user) {
        try{
            Session::put('user_id', $user['id']);
            Session::put('user_email', $user['email']);
            Session::put('user_name', $user['forename']);
            Session::put('user_surname', $user['surname']);
            return true;
        } catch (exception $e) {
            throw new Exception("Session writing failed");
            return false;
        }
        
    }

    /**
    * Get By ID:
    * @access public
    * @param string $id 
    * @return Database|boolean
    * @since 1.0.0
    */
    public function getById($id) {
        return($this->get(static::$db_table, "id", "=", $id));
    }

}
