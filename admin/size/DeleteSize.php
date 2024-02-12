<?php
include_once("../../database/Connect.php");
include_once("../../database/TableNames.php");

$size_id = $_GET['size_id'];

$delete_size = "DELETE FROM $size_table WHERE id=$size_id";

try {
    $pdo->exec($delete_size);
    header("Location: ViewSizes.php");
} catch (PDOException $pde) {
    echo $pde->getMessage();
}