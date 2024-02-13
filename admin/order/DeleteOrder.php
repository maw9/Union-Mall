<?php
include_once("../../database/Connect.php");
include_once("../../database/TableNames.php");

$id = $_GET['id'];

$delete_order = "DELETE FROM $order_table WHERE id=$id";

try {
    $pdo->exec($delete_order);
    header("Location: ViewOrders.php");
} catch (PDOException $pde) {
    echo $pde->getMessage();
}