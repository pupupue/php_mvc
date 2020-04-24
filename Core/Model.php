<?php 

namespace Core;

use PDO;
use App\Config;
use App\Utility;
/**
 * Base model
 * 
 * php v 7.4.3
 */
class Model
{

    /** 
     * @var db An instance of the database class.
     */
    protected $db = null;
     
    /**
     * Construct:
     * Get the PDO database connection
     * @access public
     * @since 1.0.0
     */
    public function __construct() {
        $this->db = Utility\Database::getInstance();
    }

    /**
     * Create:
     * @access public
     * @param string $table 
     * @param array $fields 
     * @since 1.0.0
     */
    public function create($table, array $fields = [])
    {
        return $this->db->insert($table, $fields);
    }

    /**
     * Update:
     * @access public
     * @param string $table 
     * @param string $id 
     * @param array $fields 
     * @since 1.0.0
     */
    public function update($table, $id, array $fields = [])
    {
        return $this->db->update($table, $id, $fields);
    }

    /**
    * Delete:
    * @access public
    * @param string $table
    * @param string $field [optional]f
    * @param string $operator [optional]
    * @param string $value [optional]
    * @return Database|boolean
    * @since 1.0.0
    */
    public function delete($table, $field="", $operator="", $value="") {
        return($this->db->action('DELETE', $table, $field, $operator, $value, false));
    }

    /**
    * Get:
    * @access public
    * @param string $table
    * @param string $field [optional]
    * @param string $operator [optional]
    * @param string $value [optional]
    * @return Database|boolean
    * @since 1.0.0
    */
    public function get($table, $field="", $operator="", $value="") {
        return($this->db->select($table, $field, $operator, $value));
    }



}







