<?php

function url_for(string $script_path): string
{
    // add the leading '/' if not present
    if ($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

function error_404()
{
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
}

function error_500()
{
    header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
    exit();
}

function redirect_to(string $location)
{
    header("Location: $location");
    exit;
}

function is_post_request(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function is_get_request(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}


/**
 * is_checkbox_checked() returns the string value for the input checkbox attribute 'checked'
 *
 * @param integer $value
 * @return string
 */
function is_checkbox_checked(int $value): string
{
    return $value === 1 ? ' checked' : '';
}

/**
 * confirm_db_connection() checks if the database connection throws an error
 *
 * @param mysqli $connection
 * @return void
 */
function confirm_db_connection(mysqli $connection)
{
    if ($connection->connect_errno) {
        $msg = "Database connection failed: ";
        $msg .= $connection->connect_error;
        $msg .= " (" . $connection->connect_errno . ")";
        exit($msg);
    }
}

/**
 * confirm_result_set() checks if the result set is empty or has data
 *
 * @param mysqli_result $results_set
 * @return void
 */
function confirm_result_set(mysqli_result $results_set)
{
    if (!$results_set) {
        exit('Database query failed');
    }
}

/**
 * return_subject_name() returns the subject name for the given id
 *
 * @param integer $id
 * @return string
 */
function return_subject_name(int $id): string
{
    $subject = Subject::find_by_id($id);
    return $subject->menu_name;
}

/**
 * return_table_name() returns the table name based on the class name of the instance
 *
 * @param string $classname
 * @return string
 */
function return_table_name(string $classname): string
{
    if ($classname == 'Subject') {
        return 'subjects';
    }
    if ($classname == 'Page') {
        return 'pages';
    }
}