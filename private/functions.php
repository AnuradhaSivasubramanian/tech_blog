<?php

function url_for($script_path)
{
    // add the leading '/' if not present
    if ($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

function u($string = "")
{
    return urlencode($string);
}

function raw_u($string = "")
{
    return rawurlencode($string);
}

function h($string = "")
{
    return htmlspecialchars($string);
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

function redirect_to($location)
{
    header("Location: $location");
    exit;
}

function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function is_option_selected($selected, $option)
{
    return $selected == $option ? 'selected' : '';
}

function is_checkbox_checked($value)
{
    return $value == '1' ? ' checked' : '';
}

function confirm_db_connection()
{
    if (mysqli_connect_errno()) {
        $msg = 'DB connection failed ';
        $msg .= mysqli_connect_error();
        $msg .= "(" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

function confirm_result_set($results_set)
{
    if (!$results_set) {
        exit('Database query failed');
    }
}

function return_subject_name($id)
{
    $subject = find_a_subject($id);
    return $subject['menu_name'];
}