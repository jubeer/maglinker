<?php

session_start();

if (!isset($_POST['login']) || (!isset($_POST['pass']))) {
    header('Location: signin.php');
    exit();
}

require_once "dbconnect.php";

if (db_connect()) {

    $login = db_quote($_POST['login']);
    $pass = $_POST['pass'];

    $rows = db_select("SELECT * FROM users WHERE username=$login");

    var_dump($rows);

    if ($rows == false) {
        $error = db_error();
        $_SESSION['error'] = '<span style="color: red">Login or password are incorrect!</span>';
        header('Location: signin.php');
    } else if (password_verify($pass, $rows[0]['pass'])) {

        $_SESSION['logged'] = true;
        $_SESSION['id'] = $rows[0]['id'];
        $_SESSION['username'] = $rows[0]['username'];
        $_SESSION['u_group'] = $rows[0]['u_group'];

        if ($_SESSION['u_group'] == 0) {
            $_SESSION['admin'] = true;
        }
        unset($_SESSION['error']);
        header('Location: dashboard.php');

    } else {

        $_SESSION['error'] = '<span style="color: red">Login or password are incorrect!</span>';
        header('Location: signin.php');
    }
}
?>