<?php
include_once("../../database/Connect.php");
include_once("../../database/TableNames.php");

$id = $_GET['id'];

try {
    $fetch_ordered_stocks = "SELECT * FROM $order_product_table WHERE order_id=$id";
    $stmt = $pdo->query($fetch_ordered_stocks);
    $ordered_stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($ordered_stocks as $each) {
        $product_id = $each['product_id'];
        $fetch_stock_qty = "SELECT quantity FROM $product_table WHERE id=$product_id";
        $stock_stmt = $pdo->query($fetch_stock_qty);
        $stock_qty = $stock_stmt->fetch(PDO::FETCH_ASSOC);
        $updated_qty = $stock_qty['quantity'] + $each['quantity'];
        $restock_query = "UPDATE $product_table SET quantity=$updated_qty WHERE id=$product_id";
        $pdo->exec($restock_query);
    }

    $delete_order_products = "DELETE FROM $order_product_table WHERE order_id=$id";
    $pdo->exec($delete_order_products);
    $delete_delivery = "DELETE FROM $delivery_table WHERE order_id=$id";
    $pdo->exec($delete_delivery);
    $delete_payment = "DELETE FROM $payment_table WHERE order_id=$id";
    $pdo->exec($delete_payment);
    $delete_order = "DELETE FROM $order_table WHERE id=$id";
    $pdo->exec($delete_order);

    header("Location: ViewOrders.php");
} catch (PDOException $pde) {
    echo $pde->getMessage();
}