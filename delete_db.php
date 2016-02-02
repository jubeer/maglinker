<?php

session_start();


    require_once "dbconnect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    $connection = new mysqli($host, $db_user, $db_password, $db_name);

    if ($connection->connect_errno != 0) {
        echo "Error: " . $connection->connect_errno;
    } else {

        if ($connection->query("DELETE FROM warehouses WHERE id_user='1'")) {
            header('Location:addwarehouse.php');
        }
    }
    $connection->close();


?>