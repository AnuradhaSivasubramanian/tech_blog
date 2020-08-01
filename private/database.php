<?php

require_once('db_credentials.php');

function db_connect()
{

    $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connection($connection);
    return $connection;
}




function db_disconnect($connection)
{
    if (isset($connection)) {
        $connection->close();
    }
}