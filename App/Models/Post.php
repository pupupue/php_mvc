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
            $sql = "SELECT id, title, content FROM ".static::$db_table." ORDER BY created_at";
            $PDO = $this->db->query($sql);//,[':$id'=>1]
            $results = $PDO->results();
            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
    * Delete By ID:
    * @access public
    * @param string $value
    * @return Database|boolean
    * @since 1.0.0
    */
    public function deleteById($value) {
        return($this->db->action('DELETE', static::$db_table, "id", "=", $value, false));
    }

    /**
    * Update By ID:
    * @access public
    * @param string $fields 
    * @return Database|boolean
    * @since 1.0.0
    */
    public function updateById($id, $fields) {
        return($this->db->update(static::$db_table, "id", $fields));
    }

    /**
    * Get By ID:
    * @access public
    * @param string $id 
    * @return Database|boolean
    * @since 1.0.0
    */
    public function getById($id) {
        return($this->db->select(static::$db_table, "id", "=", $id));
    }






}























