<?php
include_once("../../database/Connect.php");
include_once("../../database/TableNames.php");

$product_id = $_GET['id'];

$delete_category = "DELETE FROM $product_table WHERE id=$product_id";

try {
    $pdo->exec($delete_category);
    header("Location: ViewProducts.php");
} catch (PDOException $pde) {
    echo $pde->getMessage();
}
