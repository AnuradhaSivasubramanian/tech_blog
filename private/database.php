<?php

require_once('db_credentials.php');

function db_connect(): mysqli
{

    $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connection($connection);
    return $connection;
}




function db_disconnect(mysqli $connection)
{
    if (isset($connection)) {
        $connection->close();
    }
}