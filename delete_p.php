<?php

session_start();

if (!isset($_POST['deleteItem'])) {
    header('Location: panel.php');
    exit();
} else {
    require_once "dbconnect.php";

    $id_del = intval($_POST['deleteItem']);

    if (!db_connect()) {
        $error = db_error();
    } else {
        $id = $_POST['deleteItem'];
        if (db_query("DELETE FROM products WHERE id='$id_del' LIMIT 1") && db_query("DELETE FROM pricelist WHERE id_prod='$id_del' LIMIT 1")) {
            header('Location:panel.php');
        }
    }
}
?>