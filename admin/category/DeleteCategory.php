<?php
include_once("../../database/Connect.php");
include_once("../../database/TableNames.php");

$cat_id = $_GET['cat_id'];
echo $cat_id;

$delete_category = "DELETE FROM $category_table WHERE id=$cat_id";

try {
    $pdo->exec($delete_category);
    header("Location: ViewCategories.php");
} catch (PDOException $pde) {
    echo $pde->getMessage();
}
