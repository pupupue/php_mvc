<?php 

namespace App\Models;

use PDO;

/**
 * Post model
 * 
 * PHP version 7.4.3
 */
class Post extends \Core\Model
{
    protected static $db_table = "posts";
    /**
     * Get All:
     * Get all the posts as an assoc arr
     * @access public
     * 
     * @return array
     * @since 1.0.0
     */
    public function getAll()
    {
        try {
            $sql = "SELECT id, title, content FROM ".static::$db_table." ORDER BY id DESC";
            $PDO = $this->db->query($sql);//,[':$id'=>1]
            $results = $PDO->results();
            return $results;
        } catch(PDOException $e) {
            throw new \Exception("Couldnt retrieve posts.");
        }
    }

    /**
    * Delete By ID:
    * @access public
    * @param string $value
    * @return Database|boolean
    * @since 1.0.0
    */
    public function deleteById($id) {
        return($this->delete(static::$db_table, "id", "=", $id));
    }

    /**
    * Update By ID:
    * @access public
    * @param string $fields 
    * @return Database|boolean
    * @since 1.0.0
    */
    public function updateById($id, $fields) {
        return($this->db->update(static::$db_table, $id, $fields));
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

    /**
    * Create new Post:
    * @access public
    * @param array $fields
    * @return Database|boolean
    * @since 1.0.0
    */
    public function createNewPost($fields) {
        return($this->create(static::$db_table, $fields));
    }






}























