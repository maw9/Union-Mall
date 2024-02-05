<?php
require_once("../style/Head.php");
require_once("../database/TableNames.php");
require_once("../database/Connect.php");
session_start();

$cart_items = [];
if (isset($_SESSION['cart'])) {
    $cart_items = $_SESSION['cart'];
}

$subtotal = array_reduce(array_map(fn ($value): int => $value['qty'] * $value['price'], $cart_items), function ($first, $second) {
    return $first + $second;
});

$discount_percent = 0;
if (isset($_GET['discount'])) {
    $discount_percent = $_GET['discount'];
}
$discount = $subtotal * ($discount_percent / 100);
$tax = $subtotal * 0.03;

if (isset($_POST['place-order'])) {
    $user_id = $_SESSION['user']['id'];
    $created_at = date('Y-m-d');
    $total_amount =  $subtotal + $tax - $discount;

    $insert_order_query = "INSERT INTO $order_table (created_at, user_id, total_amount) VALUES ('$created_at', '$user_id', '$total_amount')";

    try {
        $result = $pdo->exec($insert_order_query);
        if ($result) {
            $order_id = $pdo->lastInsertId();
        }
    } catch (PDOException $pde) {
        echo $pde->get_message();
    }


    $product_inputs = [];
    foreach ($_SESSION['cart'] as $each_item) {
        array_push($product_inputs, "('$order_id', '{$each_item['id']}', '{$each_item['qty']}')");
    }
    $values = implode(',', $product_inputs);
    $insert_order_product_query = "INSERT INTO $order_product_table (order_id, product_id, quantity) VALUES " . $values;
    
    try {
        $result = $pdo->exec($insert_order_product_query);
    } catch (PDOException $pde) {
        echo $pde->get_message();
    }

    $delivery_date = $_POST['delivery-date'];
    $delivery_address = $_POST['delivery-address'];
    $insert_delivery_query = "INSERT INTO $delivery_table (date_to_deliver, address, order_id) VALUES ('$delivery_date', '$delivery_address', '$order_id')";

    try {
        $result = $pdo->exec($insert_delivery_query);
    } catch (PDOException $pde) {
        echo $pde->get_message();
    }

    $card_holder = $_POST['card-holder'];
    $card_number = $_POST['card-number'];
    $exp_month = $_POST['expiration-month'];
    $exp_year = $_POST['expiration-year'];
    $cvv = $_POST['cvv'];
    $insert_payment_query = "INSERT INTO $payment_table (card_holder, card_number, exp_month, exp_year, cvv, order_id) VALUES ('$card_holder', '$card_number', '$exp_month', '$exp_year', '$cvv', '$order_id')";

    try {
        $result = $pdo->exec($insert_payment_query);
    } catch (PDOException $pde) {
        echo $pde->get_message();
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="../style/place_order.css">
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 order-summary">
                <h1>Order Summary</h1>
                <div class="first-container mt-5">
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
                    <div class="container calculation">
                        <div class="row subtotal mt-3">
                            <div class="col-7"></div>
                            <div class="col-2">Subtotal</div>
                            <div id="sub-total" class="col-3"><?= $subtotal ?> MMK</div>
                        </div>
                        <div class="row tax mt-3">
                            <div class="col-7"></div>
                            <div class="col-2">Tax (3%)</div>
                            <div id="sub-total" class="col-3"><?= $tax ?> MMK</div>
                        </div>
                        <div class="row discount mt-3 pb-3">
                            <div class="col-7"><a class="ms-3" href="DiscountCoupons.php">Use Offers to get
                                    discounts</a>
                            </div>
                            <div class="col-2">Discount</div>
                            <div id="sub-total" class="col-3"><?= $discount ?> MMK</div>
                        </div>
                        <div class="row total mt-3">
                            <div class="col-7"></div>
                            <div class="col-2">Total</div>
                            <div id="sub-total" class="col-3"><?= $subtotal + $tax - $discount ?> MMK</div>
                        </div>
                    </div>
                </div>

                <form class="mt-5" method="post">
                    <div class="delivery-container">
                        <h2>Delivery</h2>
                        <div class="mb-3 mt-4">
                            <label for="delivery-date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="delivery-date" name="delivery-date" required>
                            <div class="form-text">We provide free shipping for our beloved customers.</div>
                        </div>
                        <div class="mb-3">
                            <label for="delivery-address" class="form-label">Address</label>
                            <textarea name="delivery-address" id="delivery-address" class="form-control" rows="3"
                                placeholder="Enter delivery address" required></textarea>
                        </div>
                    </div>

                    <div class="payment-container mt-5">
                        <h2>Payment</h2>
                        <h5 class="mt-4">We accept</h5>
                        <img class="accept-payments" src="../icons/payments.png">
                        <div class="mb-3 mt-4">
                            <label for="card-holder" class="form-label">Card Holder Name</label>
                            <input type="text" class="form-control" id="card-holder" name="card-holder"
                                placeholder="Enter card holder name" required>
                        </div>
                        <div class="mb-3">
                            <label for="card-number" class="form-label">Card Number</label>
                            <input type="number" class="form-control" id="card-number" name="card-number"
                                placeholder="Enter your card number" required>
                        </div>
                        <div class="mb-3">
                            <label for="expiration-month" class="form-label">Expiration</label>
                            <br>
                            <input type="text" id="expiration-month" name="expiration-month" placeholder="MM" minlength=2 maxlength=2 required>
                            <span>/</span>
                            <input type="text" id="expiration-year" name="expiration-year" placeholder="YY" minlength=2 maxlength=2 required>
                        </div>

                        <div class="mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <br>
                            <input type="text" id="cvv" name="cvv" placeholder="123" minlength=3 maxlength=3 required>
                        </div>
                    </div>

                    <button name="place-order" class="btn btn-dark px-5 py-3 my-5">Place Order</button>
                </form>

            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>

</html>