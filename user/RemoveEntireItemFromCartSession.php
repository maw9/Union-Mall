<?php
session_start();

$product_id = $_GET['product_id'];
unset($_SESSION['cart'][$product_id]);

$subtotal = array_reduce(array_map(fn ($value): int => $value['qty'] * $value['price'], $_SESSION['cart']), function ($first, $second) {
    return $first + $second;
});

echo json_encode([
    "subtotal" => $subtotal
]);
