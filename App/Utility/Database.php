<?php

namespace App\Utility;

use PDO;
use PDOException;
use App\Config;

/**
 * Database:
 *
 * @author Janis Laurins
 *
 * PHP VERSION 7.4.3
 *  @since 1.0.0
 */
class Database 
{

    /** @var Database */
    private static $_database = null;

    /** @var PDO */
    private $_PDO = null;

    /** @var PDOStatement */
    private $_query = null;

    /** @var boolean */
    private $_error = false;

    /** @var array */
    private $_results = [];

    /** @var integer */
    private $_count = 0;

    /**
     * Construct:
     * @access private
     * @since 1.0.0
     */
    private function __construct() {
        $host = Config::DB_HOST;
        $dbname = Config::DB_NAME;
        $username = Config::DB_USER;
        $password = Config::DB_PASS;
        try {
            $this->_PDO = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);
            $this->_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Get Instance:
     * @access public
     * @return Database
     * @since 1.0.0
     */
    public static function getInstance() {
        if (!isset(self::$_database)) {
            self::$_database = new Database();
            //                 new __construct
        }
        return(self::$_database);
    }

    /**
     * Query:
     * @access public
     * @param string $sql
     * @param array $params [optional]
     * @param boolean $use_fetchall [optinal] // false for update, insert, delete
     * @return Database
     * @since 1.0.0
     */
    public function query($sql, array $params = [], $use_fetchall=true) {
        $this->_count = 0;
        $this->_error = false;
        $this->_results = [];
        if (($this->_query = $this->_PDO->prepare($sql))) {
            foreach ($params as $key => $value) {
                $this->_query->bindValue($key, $value);
            }
            if ($this->_query->execute()) {
                if($use_fetchall === true){
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_ASSOC);
                    $this->_count = $this->_query->rowCount();
                }
            } else {
                $this->_error = true;
            }
        }
        // returns PDO object
        return $this;
    }    

    /**
    * Action:
    * @access public
    * @param string $action
    * @param string $table
    * @param string $field [optional]
    * @param string $operator [optional]
    * @param string $value [optional]
    * @param boolean $use_fetchall [optinal]
    * @return Database|boolean
    * @since 1.0.0
    */
   public function action($action, $table, $field="", $operator="", $value="", $use_fetchall) {
       if ($field !== "" && $operator !== "" && $value !== "") {
            $params = [":value" => $value];
            if (!$this->query("$action FROM `$table` WHERE `$field` $operator :value", $params, $use_fetchall)->error()) {
                return $this;
            }
       } else {
           if (!$this->query("$action FROM `$table`")->error()) {
               return $this;
           }
       }
       return false;
   }

    /**
     * Delete:
     * @access public
     * @param string $table
     * @param string $field [optional]
     * @param string $operator [optional]
     * @param string $value [optional]
     * @param boolean $use_fetchall must be false
     * @return Database|boolean
     * @since 1.0.0
     */
    public function delete($table, $field="", $operator="", $value="", $use_fetchall) {
        return($this->action('DELETE', $table, $field, $operator, $value, $use_fetchall));
    }

    /**
     * Select:
     * @access public
     * @param string $table
     * @param string $field [optional]
     * @param string $operator [optional]
     * @param string $value [optional]
     * @return Database|boolean
     * @since 1.0.0
     */
    public function select($table, $field="", $operator="", $value="", $use_fetchall) {
        return($this->action('SELECT *', $table, $field, $operator, $value, $use_fetchall));
    }

    /**
     * Insert:
     * @access public
     * @param string $table
     * @param array $fields
     * @return string|boolean
     * @since 1.0.0
     */
    public function insert($table, array $fields) {
        if (count($fields)) {
            $params = [];
            foreach ($fields as $key => $value) {
                $params[":$key"] = $value;
            }
            $columns = implode("`, `", array_keys($fields));
            $values = implode(", ", array_keys($params));
            if (!$this->query("INSERT INTO `$table` (`$columns`) VALUES($values)", $params, false)->error()) {
                return($this->_PDO->lastInsertId());
            }
        }
        return false;
    }

   /**
     * Update:
     * @access public
     * @param string $table
     * @param string $id
     * @param array $fields
     * @return boolean
     * @since 1.0.0
     */
    public function update($table, $id, array $fields) {
        if (count($fields)) {
            $i = 1;
            $set = "";
            $params = [];
            foreach ($fields as $key => $value) {
                $params[":$key"] = $value;
                $set .= "`$key` = :$key";
                if ($i < count($fields)) {
                    $set .= ", ";
                    //for last comma
                }
                $i++;
            }
            if (!$this->query("UPDATE `$table` SET $set WHERE `id` = $id", $params, false)->error()) {
                return true;
            }
        }
        // else 0?
        return false;
    }



    /**
     * Results:
     * returns results array
     * @access public
     * @param integer $key [optional]
     * @return array
     * @since 1.0.0
     */
    public function results($key = null) {
        return(isset($key) ? $this->_results[$key] : $this->_results);
    }

    /**
     * Error:
     * @access public
     * @return boolean
     * @since 1.0.0
     */
    public function error() {
        return($this->_error);
    }

    /**
     * First:
     * @access public
     * @return array
     * @since 1.0.0
     */
    public function first() {
        return($this->results(0));
    }

    /**
     * Count:
     * @access public
     * @return integer
     * @since 1.0.0
     */
    public function count() {
        return($this->_count);
    }



}









/** SAMPLE PDO OBJECT */

#object(App\Utility\Database)#5 (5) 
// { ["_PDO":"App\Utility\Database":private]=> object(PDO)#6 (0) 
//     { } ["_query":"App\Utility\Database":private]=> object(PDOStatement)#7 (1) 
//         { ["queryString"]=> string(56) "SELECT id, title, content FROM posts ORDER BY created_at" }
//           ["_error":"App\Utility\Database":private]=> bool(false)
//           ["_results":"App\Utility\Database":private]=> array(3) 
//         { [0]=> object(stdClass)#8 (3) { ["id"]=> string(1) "1" ["title"]=> string(10) "First post" ["content"]=> string(34) "This is a really interesting post." } 
//           [1]=> object(stdClass)#9 (3) { ["id"]=> string(1) "2" ["title"]=> string(11) "Second post" ["content"]=> string(27) "This is a fascinating post!" } 
//           [2]=> object(stdClass)#10 (3) { ["id"]=> string(1) "3" ["title"]=> string(10) "Third post" ["content"]=> string(32) "This is a very informative post." } }
//         ["_count":"App\Utility\Database":private]=> int(3) }



//object(App\Utility\Database)#5 (5) 
// {["_PDO":"App\Utility\Database":private]=> object(PDO)#6 (0) { }
//  ["_query":"App\Utility\Database":private]=> object(PDOStatement)#7 (1) 
//  { ["queryString"]=> string(92) "INSERT INTO `posts` (`title`, `content`, `created_at`) VALUES(:title, :content, :created_at)" }
//  ["_error":"App\Utility\Database":private]=> bool(false)
//  ["_results":"App\Utility\Database":private]=> array(0) { }
//  ["_count":"App\Utility\Database":private]=> int(0) } 