<?php
include_once("../database/Connect.php");
include_once("../database/TableNames.php");

$fetch_total_categories = "SELECT * FROM $category_table";
try {
    $stmt = $pdo->query($fetch_total_categories);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$category_names = [];
$total_products_per_cat = [];
foreach ($categories as $each_cat) {
    array_push($category_names, $each_cat['name']);
    $id = $each_cat['id'];
    $fetch_product_count_by_cat = "SELECT COUNT(*) as total FROM $product_table WHERE $product_table.category_id = $id";

    try {
        $stmt = $pdo->query($fetch_product_count_by_cat);
        $total_products_by_cat = $stmt->fetch(PDO::FETCH_ASSOC);
        array_push($total_products_per_cat, $total_products_by_cat['total']);
    } catch (PDOException $pde) {
        echo $pde->getMessage();
    }
}

echo json_encode([
    "categories" => $category_names,
    "total_products_per_cat" => $total_products_per_cat
]);
