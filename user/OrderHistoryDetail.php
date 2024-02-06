<?php
require_once("../style/Head.php");

$order_id = $_GET['order_id'];

$include_items_query = "SELECT $order_product_table.*, $product_table.name, $product_table.price, $product_table.image_url as 'product_name', 'product_price', 'product_img_url' 
    FROM $order_product_table LEFT JOIN 
    $product_table ON $order_product_table.product_id = $product_table.id WHERE $order_product_table.order_id=$order_id;";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail</title>
    <link rel="stylesheet" href="../style/order_history_detail.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <h1 class="mt-4">Order History Details</h1>
                <h3 class="mt-5">Included Items</h3>
                <div class="container cart-items">
                <?php foreach ($cart_items as $item) : ?>
                    <div class="row mb-3">
                        <div class="col-9">
                            <?= $item['qty'] ?>x <?= $item['name'] ?>
                        </div>
                        <div class="col-3"><?= $item['qty'] * $item['price'] ?> MMK</div>
                    </div>
                <?php endforeach ?>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
</html>