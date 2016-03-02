<?php

session_start();

if (!isset($_POST['login']) || (!isset($_POST['pass']))) {
    header('Location: signin.php');
    exit();
}


$connection = mysqli_connect('localhost','root','Q!1qW@2wE#3e','testowa');




if($connection === false) {
    echo "fail db_connect";
    $error = db_error();
    echo $error;

} else {
    echo "success db_connect";

    $rezultat = $connection->query("SELECT * FROM test");

    //$login = db_quote($_POST['login']);
    //$pass = $_POST['pass'];

    //$rows = db_select("SELECT * FROM testowa");

    var_dump($rezultat);
    //var_dump($login);
    //var_dump($pass);


    $error = db_error();
    echo $error;
}
echo "skipped db_connect()";
?>