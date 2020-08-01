<?php

function find_all_subjects()
{
    global $db;

    $sql = 'SELECT * FROM subjects ';
    $sql .= 'ORDER BY position ASC';
    $result = $db->query($sql);
    confirm_result_set($result);
    return $result;
}

function find_all_subject_names()
{
    global $db;
    $sql = 'SELECT id, menu_name FROM subjects ';
    $result = $db->query($sql);
    confirm_result_set($result);
    return $result;
}

function find_all_pages()
{
    global $db;

    $sql = 'SELECT * FROM pages ';
    $sql .= 'ORDER BY subject_id ASC, position ASC';
    $result = $db->query($sql);
    confirm_result_set($result);
    return $result;
}

function find_a_subject($id)
{
    global $db;

    $sql = 'SELECT * FROM subjects ';
    $sql .= "WHERE id = ?";

    //prepared statment
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    confirm_result_set($result);
    $subject = $result->fetch_assoc();
    $result->free();
    return $subject;
}

//prepared statement
function insert_subject($subject)
{
    global $db;

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES ( ?, ?, ?)";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param('sii', $subject['menu_name'], $subject['position'], $subject['visible']);
        $stmt->execute();
        $result = $stmt->get_result();
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//prepared statement
function update_subject($subject)
{
    global $db;

    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name= ?, ";
    $sql .= "position= ?, ";
    $sql .= "visible= ? ";
    $sql .= "WHERE id= ? ";
    $sql .= "LIMIT 1";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param('siii', $subject['menu_name'], $subject['position'], $subject['visible'], $subject['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_subject($id)
{

    global $db;
    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id= ? ";
    $sql .= "LIMIT 1";

    //prepared statement
    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}



// Queries for the pages table

function find_a_page($id)
{
    global $db;

    $sql = 'SELECT * FROM pages ';
    $sql .= "WHERE id = ?";

    //prepared statment
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    confirm_result_set($result);
    $page = $result->fetch_assoc();
    $result->free();
    return $page;
}

function update_page($page)
{
    global $db;
    $sql = "UPDATE pages SET ";
    $sql .= "menu_name= ?, ";
    $sql .= "position= ?, ";
    $sql .= "visible= ?, ";
    $sql .= "content= ? ";
    $sql .= "WHERE id= ? ";
    $sql .= "LIMIT 1";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param('siisi', $page['menu_name'], $page['position'], $page['visible'], $page['content'], $page['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//prepared statment
function insert_page($page)
{
    global $db;
    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id, menu_name, position, visible, content) ";
    $sql .= "VALUES ( ?, ?, ?,?,?)";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param('isiis', $page['subject_id'], $page['menu_name'], $page['position'], $page['visible'],  $page['content']);
        $stmt->execute();
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//prepared statement
function delete_page($id)
{

    global $db;
    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id= ? ";
    $sql .= "LIMIT 1";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}