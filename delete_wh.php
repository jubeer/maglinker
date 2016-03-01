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
        if (db_query("DELETE FROM warehouses WHERE id='$id_del' LIMIT 1") && db_query("DELETE FROM pricelist WHERE id_wh='$id_del'") && db_query("DELETE FROM products WHERE id_warehouse='$id_del'")) {
            header('Location:panel.php');
        }
    }
}
?>