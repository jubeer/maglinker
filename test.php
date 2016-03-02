<?php

session_start();

if (!isset($_POST['login']) || (!isset($_POST['pass']))) {
    header('Location: signin.php');
    exit();
}

require_once "dbconnect.php";

if (db_connect()) {
    echo "success db_connect";
    $error = db_error();
    echo $error;
} else {
    echo "fail db_connect";
    $error = db_error();
    echo $error;
}
 echo "skipped db_connect()";
?>