<?php
require_once("../style/Head.php");

session_start();
$cart_items = [];
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $each) {
        array_push($cart_items, $each);
    }
}

$subtotal = array_reduce(array_map(fn ($value): int => $value['qty'] * $value['price'], $cart_items), function ($first, $second) {
    return $first + $second;
});

$discount = 0;
if (isset($_GET['discount'])) {
    $discount = $_GET['discount'];
}

// $total = $subtotal - $discount;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../style/cart.css">
</head>

<body>
    <div class="container">
        <div class="row cart-headers py-4">
            <div class="col-2">
                <h4>Your Cart</h4>
            </div>
            <div class="col-4 name-header">Name</div>
            <div class="col-1">Size</div>
            <div class="col-2">Quantity</div>
            <div class="col-1">Remove</div>
            <div class="col-2">Price</div>
        </div>

        <?php foreach ($cart_items as $each) : ?>
        <div id="cart-item-<?= $each['id'] ?>" class="row cart-item d-flex align-items-center mt-3 pb-3">
            <div class="col-2">
                <div class="item-img">
                    <img src="../<?= $each['img_url'] ?>">
                </div>
            </div>
            <div class="col-4">
                <div class="item-name">
                    <?= $each['name'] ?>
                </div>
            </div>
            <div class="col-1">
                <div class="item-size">
                    <?= $each['size'] ?>
                </div>
            </div>
            <div class="col-2">
                <div class="item-qty-control">
                    <button class="minus" onClick="on_remove_from_cart(<?= $each['id'] ?>, <?= $each['price'] ?>)"><i
                            class="fa-solid fa-minus"></i></button>
                    <div id="qty-product-<?= $each['id'] ?>"><?= $each['qty'] ?></div>
                    <button class="plus" id="plus-btn-<?= $each['id'] ?>"
                        onClick="on_add_to_cart(<?= $each['id'] ?>, <?= $each['price']; ?>)"><i
                            class="fa-solid fa-plus"></i></button>
                </div>
            </div>
            <div class="col-1 d-flex justify-content-center">
                <div class="remove-btn" onClick="on_remove_btn_click(<?= $each['id'] ?>)">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
            <div class="col-2">
                <span id="item-price-<?= $each['id'] ?>" class="item-price"><?= $each['price'] ?> MMK</span>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="row cart-footer subtotal py-4">
            <div class="col-2"></div>
            <div class="col-4"></div>
            <div class="col-1"></div>
            <div class="col-1"></div>
            <div class="col-2">Subtotal</div>
            <div id="sub-total" class="col-2"><?= $subtotal ?> MMK</div>
        </div>

        <div class="row py-4">
            <div class="col-2"></div>
            <div class="col-4"></div>
            <div class="col-1"></div>
            <div class="col-1"></div>
            <div class="col-2"></div>
            <div class="col-2">
                <a href="PlaceOrder.php" class="btn btn-dark py-3 px-5">Checkout</a>
            </div>
        </div>
    </div>

    <script>
    function on_add_to_cart(item_id, per_price) {
        const request = new Request(`AddToCartSession.php?product_id=${item_id}`)
        fetch(request)
            .then((response) => response.json())
            .then((result) => {
                const plus_btn = document.querySelector(`#plus-btn-${item_id}`);
                plus_btn.disabled = !result.is_enable_to_add_more;

                const specific_product_qty = document.querySelector(`#qty-product-${item_id}`);
                specific_product_qty.textContent = result.product_qty;

                const specific_product_total = document.querySelector(`#item-price-${item_id}`);
                specific_product_total.textContent = (result.product_qty * per_price) + " MMK";

                const sub_total = document.getElementById(`sub-total`);
                sub_total.textContent = result.subtotal + " MMK";
            });
    }

    function on_remove_from_cart(item_id, per_price) {
        const request = new Request(`RemoveFromCartSession.php?product_id=${item_id}`)
        fetch(request)
            .then((response) => response.json())
            .then((result) => {
                if (result.product_qty == 0) {
                    const cart_item = document.getElementById(`cart-item-${item_id}`);
                    if (cart_item) {
                        cart_item.remove();
                    }
                } else {
                    const plus_btn = document.querySelector(`#plus-btn-${item_id}`);
                    plus_btn.disabled = !result.is_enable_to_add_more;

                    const specific_product_qty = document.querySelector(`#qty-product-${item_id}`);
                    specific_product_qty.textContent = result.product_qty;

                    const specific_product_total = document.querySelector(`#item-price-${item_id}`);
                    specific_product_total.textContent = (result.product_qty * per_price) + " MMK";
                }
                const sub_total = document.getElementById(`sub-total`);
                sub_total.textContent = (result.subtotal ?? 0) + " MMK";
            });
    }

    function on_remove_btn_click(item_id) {
        const request = new Request(`RemoveEntireItemFromCartSession.php?product_id=${item_id}`)
        fetch(request)
            .then((response) => response.json())
            .then((result) => {
                const cart_item = document.getElementById(`cart-item-${item_id}`);
                if (cart_item) {
                    cart_item.remove();
                }
                const sub_total = document.getElementById(`sub-total`);
                sub_total.textContent = (result.subtotal ?? 0) + " MMK";
            });
    }
    </script>
</body>

</html>