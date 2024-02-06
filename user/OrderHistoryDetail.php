<?php
require_once("../style/Head.php");
require_once("../database/TableNames.php");
require_once("../database/Connect.php");

$order_id = $_GET['order_id'];

$include_items_query = "SELECT $order_product_table.*, $product_table.name, $product_table.price, $product_table.image_url 
    FROM $order_product_table LEFT JOIN 
    $product_table ON $order_product_table.product_id = $product_table.id WHERE $order_product_table.order_id=$order_id;";

try {
    $stmt = $pdo->query($include_items_query);
    $include_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$delivery_query = "SELECT * from $delivery_table WHERE order_id=$order_id";
try {
    $stmt = $pdo->query($delivery_query);
    $delivery_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$payment_query = "SELECT * from $payment_table WHERE order_id=$order_id";
try {
    $stmt = $pdo->query($payment_query);
    $payment_info = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

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
                <h3 class="mt-5"><i class="fa-solid fa-bag-shopping me-3"></i>Purchased Items</h3>
                <div class="container include-items mt-4">
                    <?php foreach ($include_items as $item) : ?>
                        <div class="row ordered-item mb-3">
                            <div class="col-3">
                                <img src="../<?= $item['image_url'] ?>">
                            </div>
                            <div class="col-6">
                                <?= $item['quantity'] ?>x <?= $item['name'] ?>
                            </div>
                            <div class="col-3"><?= $item['quantity'] * $item['price'] ?> MMK</div>
                        </div>
                    <?php endforeach ?>
                </div>

                <h3 class="mt-5"><i class="fa-solid fa-truck me-3"></i>Delivery Information</h3>
                <div class="address-info-container mt-4">
                    <i class="fa-regular fa-calendar-days delivery"></i>
                    <span class="delivery info-label ms-2">Deliver on</span>
                    <span class="delivery info-value ms-1"><?= $delivery_info['date_to_deliver'] ?></span>
                    <br>

                    <i class="fa-solid fa-location-dot mt-3 delivery"></i>
                    <span class="delivery info-label ms-2">Address</span>
                    <span class="delivery info-value ms-1"><?= $delivery_info['address'] ?></span>
                </div>

                <h3 class="mt-5"><i class="fa-regular fa-credit-card me-3"></i>Payment Information</h3>
                <div class="payment-info-container mt-4 mb-5">
                    <i class="fa-solid fa-user payment"></i>
                    <span class="payment info-label ms-2">Card Holder</span>
                    <span class="payment info-value ms-1"><?= $payment_info['card_holder'] ?></span>
                    <br>

                    <i class="fa-solid fa-xmarks-lines mt-3 payment"></i>
                    <span class="payment info-label ms-2">Card Number</span>
                    <span class="payment info-value ms-1"><?= $payment_info['card_number'] ?></span>
                    <br>

                    <i class="fa-regular fa-calendar-xmark mt-3 payment"></i>
                    <span class="payment info-label ms-2">Expire MM/YY</span>
                    <span class="payment info-value ms-1"><?= $payment_info['exp_month'] ?>/<?= $payment_info['exp_year'] ?></span>
                    <br>

                    <i class="fa-solid fa-credit-card mt-3 payment"></i>
                    <span class="payment info-label ms-2">CVV</span>
                    <span class="payment info-value ms-1"><?= $payment_info['cvv'] ?></span>
                </div>

            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>

</html>