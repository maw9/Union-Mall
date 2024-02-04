<?php
session_start();
require_once('../database/Connect.php');
require_once('../database/TableNames.php');

$product_id = $_GET['product_id'];

$get_product_query = "SELECT * FROM $product_table WHERE id=$product_id";

try {
    $stmt = $pdo->query($get_product_query);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

if ($_SESSION['cart'][$product_id] > 0) {
    $_SESSION['cart'][$product_id]['qty']--;
}

$cart_item_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $each) :
        $cart_item_count += $each['qty'];
    endforeach;
}

$specific_product_qty = $_SESSION['cart'][$product_id]['qty'];

$is_enable_to_add_more = ($product['quantity'] > 0) && ($_SESSION['cart'][$product_id]['qty'] < $product['quantity']);

if ($specific_product_qty == 0) {
    unset($_SESSION['cart'][$product_id]);
}

$subtotal = array_reduce(array_map(fn ($value): int => $value['qty'] * $value['price'], $_SESSION['cart']), function ($first, $second) {
    return $first + $second;
});

echo json_encode([
    "cart_total_qty" => $cart_item_count,
    "product_qty" => $specific_product_qty,
    "is_enable_to_add_more" => $is_enable_to_add_more,
    "subtotal" => $subtotal
]);
