<?php
include_once("../../database/Connect.php");
include_once("../../database/TableNames.php");

$product_id = $_GET['id'];

$delete_product_tag = "DELETE FROM $product_tag_table WHERE product_id=$product_id";
try {
    $pdo->exec($delete_product_tag);
} catch (PDOException $pde) {
    echo ($pde->getMessage());
}

$delete_product = "DELETE FROM $product_table WHERE id=$product_id";

try {
    $pdo->exec($delete_product);
    header("Location: ViewProducts.php");
} catch (PDOException $pde) {
    echo $pde->getMessage();
}