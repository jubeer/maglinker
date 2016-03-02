<?php

function db_connect()
{
    static $connection;

    if (!isset($connection)) {

        $config = parse_ini_file('config.ini');
        $connection = mysqli_connect('localhost', $config['db_user'], $config['db_password'], $config['db_name']);
    }

    if ($connection === false) {
        error_log(mysqli_connect_error() . "\n", 3, "mysql_error.log");
        return mysqli_connect_error();
    }

    return $connection;
}

function db_query($query)
{
    $connection = db_connect();

    $result = mysqli_query($connection, $query);

    return $result;
}

function db_error()
{
    $connection = db_connect();

    return mysqli_error($connection);
}

function db_select($query)
{
    $rows = array();
    $result = db_query($query);

    if ($result === false) {
        return false;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function db_quote($value)
{
    $connection = db_connect();
    return "'" . mysqli_real_escape_string($connection, $value) . "'";
}

?>