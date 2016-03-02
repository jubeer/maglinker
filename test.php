<?php

session_start();

if (!isset($_POST['login']) || (!isset($_POST['pass']))) {
    header('Location: signin.php');
    exit();
}

require_once "dbconnect.php";

if (db_connect()) {
    echo "success db_connect";

    //$login = db_quote($_POST['login']);
    //$pass = $_POST['pass'];

    $rows = db_select("SELECT * FROM testowa");

    var_dump($rows);
    //var_dump($login);
    //var_dump($pass);


    $error = db_error();
    echo $error;
} else {
    echo "fail db_connect";
    $error = db_error();
    echo $error;
}
 echo "skipped db_connect()";
?>