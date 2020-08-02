<?php

/**
 * Subject class
 */
class Subject
{

    //-------------- START OF ACTIVE RECORD CODE---------------------
    static protected $db;

    static public function set_db(mysqli $db)
    {
        self::$db = $db;
    }

    static public function result_into_object(mysqli_result $result): array
    {
        //results into objects
        $object_array = [];
        while ($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();
        return $object_array;
    }

    static public function find_all(): array
    {

        $sql = 'SELECT * FROM ' . return_table_name(get_called_class()) . "  ";
        $sql .= "ORDER BY ";
        if (get_called_class() === 'Page') {
            $sql .= 'subject_id ASC, ';
        }
        $sql .= 'position ASC';
        $result =  self::$db->query($sql);
        confirm_result_set($result);
        return static::result_into_object($result);
    }

    static public function find_by_id(int $id)
    {
        $sql = 'SELECT * FROM ' . return_table_name(get_called_class()) . "  ";

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

    static public function rows_count(): int
    {
        $sql = 'SELECT * FROM ' . return_table_name(get_called_class()) . "  ";
        $sql .= 'ORDER BY position ASC';
        $result =  self::$db->query($sql);
        confirm_result_set($result);
        return $result->num_rows;
    }

    static public function delete(int $id): bool
    {

        $sql = 'DELETE FROM ' . return_table_name(get_called_class()) . "  ";
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

    public function create_a_subject(): bool
    {

        $sql = "INSERT INTO subjects ";
        $sql .= "(menu_name, position, visible) ";
        $sql .= "VALUES ( ?, ?, ?)";

        if ($stmt = self::$db->prepare($sql)) {
            $stmt->bind_param('sii', $this->menu_name, $this->position, $this->visible);
            $stmt->execute();
            if ($stmt->affected_rows === 0) exit('No rows updated');
            $this->id = self::$db->insert_id;
            return true;
        } else {
            echo self::$db->error;
            self::$db->close();
        }
    }

    public function update_a_subject(): bool
    {
        $sql = "UPDATE subjects SET ";
        $sql .= "menu_name= ?, ";
        $sql .= "position= ?, ";
        $sql .= "visible= ? ";
        $sql .= "WHERE id= ? ";
        $sql .= "LIMIT 1";

        if ($stmt = self::$db->prepare($sql)) {
            $stmt->bind_param('siii', $this->menu_name, $this->position, $this->visible, $this->id);
            $stmt->execute();
            if ($stmt->affected_rows === 0) exit('No rows updated');
            return true;
        } else {
            echo self::$db->error;
            self::$db->close();
        }
    }

    public function merge_attributes(array $args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    static protected function instantiate($record): self
    {
        $object = new static;
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
    public function __construct(array $args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->menu_name = $args['menu_name'] ?? '';
        $this->position = $args['position'] ?? '';
        $this->visible = $args['visible'] ?? '';
    }
}