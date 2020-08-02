<?php

/**
 * Subject class
 */
class Subject
{

    //-------------- START OF ACTIVE RECORD CODE---------------------
    static protected $db;

    static public function set_db($db)
    {
        self::$db = $db;
    }

    static public function result_into_object($result)
    {
        //results into objects
        $object_array = [];
        while ($record = $result->fetch_assoc()) {
            $object_array[] = self::instantiate($record);
        }

        $result->free();
        return $object_array;
    }

    static public function find_all()
    {
        $sql = 'SELECT * FROM subjects ';
        $sql .= 'ORDER BY position ASC';
        $result =  self::$db->query($sql);
        confirm_result_set($result);
        return self::result_into_object($result);
    }

    static public function find_by_id($id)
    {

        $sql = 'SELECT * FROM subjects ';
        $sql .= "WHERE id = ?";

        //prepared statment
        $stmt = self::$db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        confirm_result_set($result);

        $object_array = self::result_into_object($result);
        if (!empty($object_array)) {
            return array_shift($object_array);
        } else return false;
    }

    static public function delete_a_subject($id)
    {

        $sql = "DELETE FROM subjects ";
        $sql .= "WHERE id= ? ";
        $sql .= "LIMIT 1";

        //prepared statement
        if ($stmt = self::$db->prepare($sql)) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return true;
        } else {
            echo self::$db->error;
            self::$db->close();
            exit;
        }
    }

    static protected function instantiate($record)
    {
        $object = new self;
        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }
    //------------ END OF ACTIVE RECORD CODE-------------------------

    public $id;
    public $menu_name;
    public $position;
    public $visible;


    /**
     * contructor method - Populates default values to the instance of Subject class
     *
     * @param array $args
     */
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->menu_name = $args['menu_name'] ?? '';
        $this->position = $args['position'] ?? '';
        $this->visible = $args['visible'] ?? '';
    }
}