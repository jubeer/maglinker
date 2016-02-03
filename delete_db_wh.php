<?php

session_start();

if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
} else {
    require_once "dbconnect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    $id_user = $_SESSION['id'];
    if ($connection->connect_errno != 0) {
        echo "Error: " . $connection->connect_errno;
    } else {

        if ($connection->query("DELETE FROM warehouses WHERE id_user='$id_user'")) {
            header('Location:addwarehouse.php');
        }
    }
    $connection->close();
}

?>