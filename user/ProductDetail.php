<?php
session_start();
require_once("../style/Head.php");
require_once("../database/TableNames.php");
require_once("../database/Connect.php");

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
}

$get_product_query = "SELECT product.*, category.name as 'category', size.name as 'size' FROM product 
    LEFT JOIN category ON product.category_id = category.id
    LEFT JOIN size ON product.size_id = size.id
    WHERE product.id=$product_id;";

try {
    $stmt = $pdo->query($get_product_query);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$get_tags_by_product_query = "SELECT * FROM product_tag LEFT JOIN tag ON product_tag.tag_id = tag.id WHERE product_tag.product_id=$product_id;";
try {
    $stmt = $pdo->query($get_tags_by_product_query);
    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="../style/product_detail.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <h1 class="mt-3 ms-2">Product Detail</h1>
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-6">
                            <div id="product-image">
                                <img src="../<?= $product['image_url'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 id="product-name"><?= $product['name'] ?></h3>
                            <p id="product-desc" class="mt-3"><?= $product['description'] ?></p>
                            <div id="product-price" class="mt-4"><i class=" fa-solid fa-tag me-2">
                                </i><?= $product['price'] ?> MMK
                            </div>
                            <div id="product-size" class="mt-4"><?= $product['size'] ?></div>
                            <div id="product-category" class="ms-2"><?= $product['category'] ?></div>
                            <div class="tags-container">
                                <?php foreach ($tags as $each) : ?>
                                <div class="product-tag me-2"><?= $each['name'] ?></div>
                                <?php endforeach; ?>
                            </div>
                            <div class="cart-action-container">
                                <div id="qty-controls-<?= $product['id'] ?>" class="qty-controls"
                                    style="display: <?= (isset($_SESSION['cart'][$product['id']]) && ($_SESSION['cart'][$product['id']]['qty'] > 0)) ? "block" : "none" ?>">
                                    <button class="minus-btn" onClick="on_remove_from_cart(<?= $product['id'] ?>)"><i
                                            class="fa-solid fa-minus"></i></i></button>
                                    <span id="qty-product-<?= $product['id'] ?>"
                                        class="mx-4"><?= $_SESSION['cart'][$product['id']]['qty'] ?></span>
                                    <button id="plus-btn-<?= $product['id'] ?>" class="plus-btn"
                                        onClick="on_add_to_cart(<?= $product['id'] ?>)"><i
                                            class="fa-solid fa-plus"></i></button>
                                </div>

                                <button onClick="on_add_to_cart(<?= $product['id'] ?>)" class="add-to-cart-btn"
                                    id="add-to-cart-<?= $product['id'] ?>"
                                    <?php if ($product['quantity'] <= 0) : echo "disabled";
                                                                                                                                                                            endif ?>
                                    style="display: <?= (!isset($_SESSION['cart'][$product['id']]) || ($_SESSION['cart'][$product['id']]['qty'] < 1)) ? "block" : "none" ?>">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>

    <script>
    function on_add_to_cart(item_id) {
        const request = new Request(`AddToCartSession.php?product_id=${item_id}`)
        fetch(request)
            .then((response) => response.json())
            .then((result) => {
                const add_to_cart_btn = document.querySelector(`#add-to-cart-${item_id}`);
                add_to_cart_btn.style.display = 'none';

                const qty_controls = document.querySelector(`#qty-controls-${item_id}`);
                qty_controls.style.display = 'block';

                const plus_btn = document.querySelector(`#plus-btn-${item_id}`);
                plus_btn.disabled = !result.is_enable_to_add_more;

                const specific_product_qty = document.querySelector(`#qty-product-${item_id}`);
                specific_product_qty.textContent = result.product_qty;
            });
    }

    function on_remove_from_cart(item_id) {
        const request = new Request(`RemoveFromCartSession.php?product_id=${item_id}`)
        fetch(request)
            .then((response) => response.json())
            .then((result) => {
                if (result.product_qty == 0) {
                    const add_to_cart_btn = document.querySelector(`#add-to-cart-${item_id}`);
                    add_to_cart_btn.style.display = 'block';

                    const qty_controls = document.querySelector(`#qty-controls-${item_id}`);
                    qty_controls.style.display = 'none';
                }

                const plus_btn = document.querySelector(`#plus-btn-${item_id}`);
                plus_btn.disabled = !result.is_enable_to_add_more;

                const specific_product_qty = document.querySelector(`#qty-product-${item_id}`);
                specific_product_qty.textContent = result.product_qty;
            });
    }
    </script>
</body>

</html>