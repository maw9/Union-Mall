<?php
require_once("../style/Head.php");
$discounts = [5, 10, 15, 30];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Offers</title>
    <link rel="stylesheet" href="../style/discount_coupons.css">
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-3"></div>
            <div class="col">
                <h1>Special Offers</h1>
            </div>
            <div class="col-3"></div>
        </div>
        <?php foreach ($discounts as $each) : ?>
        <div class="row">
            <div class="col-3"></div>
            <div class="col">
                <a href="PlaceOrder.php?discount=<?= $each ?>">
                    <div class="coupon">
                        <div class="icon">
                            <i class="fa-solid fa-certificate"></i>
                            <div><?= $each ?>%</div>
                        </div>
                        <div class="divider"></div>
                        <div class="discount">
                            <h4>Offer for customer.</h4>
                            <h2>All Products<br><span><?= $each ?>%</span> Discount.</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3"></div>
        </div>
        <?php endforeach; ?>
    </div>
</body>

</html>