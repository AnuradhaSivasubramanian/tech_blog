<?php

/**
 * Subject class
 */
class Page extends Subject
{







    public function create_a_page()
    {

        $sql = "INSERT INTO pages ";
        $sql .= "(subject_id, menu_name, position, visible, content) ";
        $sql .= "VALUES ( ?, ?, ?,?,?)";

        if ($stmt = self::$db->prepare($sql)) {
            $stmt->bind_param('isiis', $this->subject_id, $this->menu_name, $this->position, $this->visible, $this->content);
            $stmt->execute();
            if ($stmt->affected_rows === 0) exit('No rows updated');
            $this->id = self::$db->insert_id;
            return true;
        } else {
            echo self::$db->error;
            self::$db->close();
        }
    }

    public function update_a_page()
    {
        $sql = "UPDATE pages SET ";
        $sql .= "subject_id= ?, ";
        $sql .= "menu_name= ?, ";
        $sql .= "position= ?, ";
        $sql .= "visible= ?, ";
        $sql .= "content= ? ";
        $sql .= "WHERE id= ? ";
        $sql .= "LIMIT 1";

        if ($stmt = self::$db->prepare($sql)) {
            $stmt->bind_param('isiisi', $this->subject_id, $this->menu_name, $this->position, $this->visible, $this->content, $this->id);
            $stmt->execute();
            if ($stmt->affected_rows === 0) exit('No rows updated');
            return true;
        } else {
            echo self::$db->error;
            self::$db->close();
        }
    }


    //------------ END OF ACTIVE RECORD CODE-------------------------

    public $subject_id;
    public $content;


    /**
     * contructor method - Populates default values to the instance of Subject class
     *
     * @param array $args
     */
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->subject_id = $args['subject_id'] ?? '';
        $this->menu_name = $args['menu_name'] ?? '';
        $this->position = $args['position'] ?? '';
        $this->visible = $args['visible'] ?? '';
        $this->content = $args['content'] ?? '';
    }
}