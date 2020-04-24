<?php

namespace App\Models;

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

    // /**
    //  * Constructor:
    //  * @access public
    //  * @since 1.0.0
    //  */
    // public function __construct()
    // {
    //     $this->db = new Database; //if its how you conn to db
    // }

    /**
     * Find user by Email:
     * @access public
     * @param string $email 
     * @return true:false if found
     * @since 1.0.0
     * //////
     * can be rewritten better with code from core/model
     * //////
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
            throw new \Exception("");
        }
        return $userID;
    }



    //might be usefull in practice have to rewrite
    /////////////////////////////////////
    /**
     * Get Instance: Returns an instance of the User model if the specified user
     * exists in the database. 
     * @access public
     * @param string $user
     * @return User|null
     * @since 1.0.0
     */
    public static function getInstance($user) {
        $User = new User();
        if ($User->findUser($user)->exists()) {
            return $User;
        }
        return null;
    }

    /**
     * Find User: Retrieves and stores a specified user record from the database
     * into a class property. Returns true if the record was found, or false if
     * not.
     * @access public
     * @param string $user
     * @return boolean
     * @since 1.0.0
     */
    public function findUser($user) {
        $field = filter_var($user, FILTER_VALIDATE_EMAIL) ? "email" : (is_numeric($user) ? "id" : "username");
        return($this->find(static::$db_table, [$field, "=", $user]));
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
            throw new Exception(Utility\Text::get("USER_UPDATE_EXCEPTION"));
        }
    }

}
