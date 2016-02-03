<?php

session_start();

if (!isset($_POST['login']) || (!isset($_POST['pass']))) {
    header('Location: signin.php');
    exit();
}

require_once "dbconnect.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno != 0) {
    echo "Error " . $connection->connect_errno;
} else {
    $user = $_POST['login'];
    $pass = $_POST['pass'];

    $user = htmlentities($user, ENT_QUOTES, "UTF-8");
    $pass = htmlentities($pass, ENT_QUOTES, "UTF-8");


    if ($result = @$connection->query(
        sprintf("SELECT * FROM users WHERE username='%s' AND pass='%s'",
            mysqli_real_escape_string($connection, $user),
            mysqli_real_escape_string($connection, $pass)))
    ) {

        $how_much = $result->num_rows;
        if ($how_much > 0) {
            $_SESSION['logged'] = true;
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['u_group'] = $row['u_group'];

            unset($_SESSION['error']);
            $result->close();
            header('Location: dashboard.php');


        } else {

            $_SESSION['error'] = '<span style="color: red">Login or password are incorrect!</span>';
            header('Location: signin.php');

        }
    }
    $connection->close();
}
?>