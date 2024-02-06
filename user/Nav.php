<?php
require_once('../style/Head.php');

$username = "";

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $username = $user['name'];
} else {
    $username = "Guest";
}

$cart_items_qty = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $each) {
        $cart_items_qty += $each['qty'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/nav.css">
</head>

<body>
    <div class="nav-bar">
        <ul>
            <li><a href="Index.php">Home</a></li>
            <li><a href="AboutUs.php">About</a></li>
            <li><a href="Products.php">Products</a></li>
            <li><a href="OrderHistory.php">Orders</a></li>
            <li><a href="ContactUs.php">Contact</a></li>
        </ul>
        <h1>Union Mall</h1>
        <div class="search-cart-container">
            <form>
                <div class="search-box me-4">
                    <img src="../icons/ic_search.png" />
                    <input type="text" placeholder="SEARCH FOR PRODUCTS" />
                </div>
            </form>
            <a href="Cart.php">
                <div class="cart-with-badge">
                    <img class="cart" src="../icons/ic_shopping_bag.png" />
                    <div class="badge" style="display: <?= ($cart_items_qty > 0) ? "block" : "none" ?>">
                        <?= $cart_items_qty ?></div>
                </div>
            </a>
            <a href="Profile.php" class="ms-4">
                <div class="profile" data-bs-toggle="tooltip" data-bs-title="<?= $username ?>">
                    <i class="fa-regular fa-user" style="display: <?= !isset($user) ? "visible" : "none" ?>"></i>
                    <img src="<?= "../" . $user['profile_url'] ?>" style="display: <?= isset($user) ? "visible" : "none" ?>">
                </div>
            </a>
        </div>
    </div>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>