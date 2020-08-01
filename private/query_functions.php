<?php

function find_all_subjects()
{
    global $db;

    $sql = 'SELECT * FROM subjects ';
    $sql .= 'ORDER BY position ASC';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_all_subject_names()
{
    global $db;
    $sql = 'SELECT id, menu_name FROM subjects ';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_all_pages()
{
    global $db;

    $sql = 'SELECT * FROM pages ';
    $sql .= 'ORDER BY subject_id ASC, position ASC';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_a_subject($id)
{
    global $db;

    $sql = 'SELECT * FROM subjects ';
    $sql .= "WHERE id = ?";

    //prepared statment
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
}

//prepared statement
function insert_subject($subject)
{
    global $db;

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES ( ?, ?, ?)";

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, 'sii', $subject['menu_name'], $subject['position'], $subject['visible']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
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

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, 'siii', $subject['menu_name'], $subject['position'], $subject['visible'], $subject['id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
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
    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
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
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    confirm_result_set($result);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
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

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, 'siisi', $page['menu_name'], $page['position'], $page['visible'], $page['content'], $page['id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
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

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, 'isiis', $page['subject_id'], $page['menu_name'], $page['position'], $page['visible'],  $page['content']);
        mysqli_stmt_execute($stmt);
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

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}