<?php

require_once('db_credentials.php');

/**
 * db_connect() connects $db to the database
 *
 * @return mysqli
 */
function db_connect(): mysqli
{

    $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connection($connection);
    return $connection;
}



/**
 * db_disconnect() closes  the database connection.
 *
 * @param mysqli $connection
 * 
 */
function db_disconnect(mysqli $connection)
{
    if (isset($connection)) {
        $connection->close();
    }
}