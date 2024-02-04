<?php
require_once('../database/Connect.php');
require_once('../database/TableNames.php');

$fetch_categories = "SELECT $product_table.*, $size_table.name as 'size' 
FROM $product_table LEFT JOIN 
    $size_table ON $product_table.size_id = $size_table.id;";

try {
    $stmt = $pdo->query($fetch_categories);
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($product as $each) {
        print_r($each);
        echo "<br>";
    }
} catch (PDOException $pde) {
    echo $pde->getMessage();
}
