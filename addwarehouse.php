<?php

session_start();

if (!isset($_POST['login']) || (!isset($_POST['pass']))) {
    header('Location: index.php');
    exit();
}
?>