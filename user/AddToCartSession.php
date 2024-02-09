<?php
session_start();
require_once('../database/Connect.php');
require_once('../database/TableNames.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$product_id = $_GET['product_id'];
$get_product_query = "SELECT $product_table.*, $size_table.name as 'size' FROM $product_table LEFT JOIN $size_table ON $product_table.size_id = $size_table.id WHERE $product_table.id=$product_id;";

try {
    $stmt = $pdo->query($get_product_query);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

if (isset($_SESSION['cart'][$product_id])) {
    if ($product['quantity'] > 0 && $_SESSION['cart'][$product_id]['qty'] < $product['quantity']) {
        $_SESSION['cart'][$product_id]['qty']++;
    }
} else {
    if ($product['quantity'] > 0) {
        $_SESSION['cart'][$product_id] = [
            "id" => $product_id,
            "qty" => 1,
            "name" => $product['name'],
            "price" => $product['price'],
            "size" => $product['size'],
            "img_url" => $product['image_url'],
            "stock" => $product['quantity']
        ];
    }
}

$cart_item_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $each) :
        $cart_item_count += $each['qty'];
    endforeach;
}

$specific_product_qty = $_SESSION['cart'][$product_id]['qty'];

$is_enable_to_add_more = ($product['quantity'] > 0) && ($_SESSION['cart'][$product_id]['qty'] < $product['quantity']);

$subtotal = array_reduce(array_map(fn ($value): int => $value['qty'] * $value['price'], $_SESSION['cart']), function ($first, $second) {
    return $first + $second;
});

echo json_encode([
    "cart_total_qty" => $cart_item_count,
    "product_qty" => $specific_product_qty,
    "is_enable_to_add_more" => $is_enable_to_add_more,
    "subtotal" => $subtotal
]);
