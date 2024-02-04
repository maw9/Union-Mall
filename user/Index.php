<?php
session_start();
require_once('../style/Head.php');
require_once('Nav.php');
require_once('../database/Connect.php');
require_once('../database/TableNames.php');

$popular_shrits_query = "SELECT * FROM $product_table WHERE category_id='1' LIMIT 4";
try {
    $popular_shrits_stmt = $pdo->query($popular_shrits_query);
    $popular_shrits = $popular_shrits_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage() . "<br>";
}

$popular_pants_query = "SELECT * FROM $product_table WHERE category_id='2' LIMIT 4";
try {
    $popular_pants_stmt = $pdo->query($popular_pants_query);
    $popular_pants = $popular_pants_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage() . "<br>";
}

$popular_watches_query = "SELECT * FROM $product_table WHERE category_id='3' LIMIT 4";
try {
    $popular_watches_stmt = $pdo->query($popular_watches_query);
    $popular_watches = $popular_watches_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage() . "<br>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="../style/index.css">
</head>

<body>
    <div class="container-fluid hero">
        <div class="row">
            <div class="col hero-text-container">
                <div class="hero-text">
                    <h2>SAVE UP TO 50% IN OUR WINTER SALE</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipiscing eli mattis sit
                        phasellus mollis sit aliquam sit nullam neque ultrices.
                    </p>
                    <a href="#" class="explore-products">EXPLORE PRODUCTS</a>
                    <a href="#" class="about-us">ABOUT US</a>
                </div>
            </div>
            <div class="col hero-image-container"></div>
        </div>
    </div>

    <div class="home-product-section popular-shirts-section">
        <h3>POPULAR SHIRTS</h3>
        <div class="container">
            <div class="row row-cols-4">
                <?php foreach ($popular_shrits as $each_shirt) : ?>
                    <div class="col-3">
                        <div class="product-card mx-1">
                            <div class="image-and-price">
                                <img src="<?= "../" . $each_shirt['image_url'] ?>" />
                                <span><?= $each_shirt['price'] . " MMK" ?></span>
                            </div>
                            <h4><?= $each_shirt['name'] ?></h4>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button class="view-all-btn">ALL SHRITS</button>
    </div>

    <div class="section-horizontal-divider"></div>

    <div class="home-product-section popular-pants-section">
        <h3>POPULAR PANTS</h3>
        <div class="container">
            <div class="row row-cols-4">
                <?php foreach ($popular_pants as $each_pants) : ?>
                    <div class="col-3">
                        <div class="product-card mx-1">
                            <div class="image-and-price">
                                <img src="<?= "../" . $each_pants['image_url'] ?>" />
                                <span><?= $each_shirt['price'] . " MMK" ?></span>
                            </div>
                            <h4><?= $each_pants['name'] ?></h4>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button class="view-all-btn">ALL PANTS</button>
    </div>

    <div class="section-horizontal-divider"></div>

    <div class="home-product-section popular-watches-and-accessories-section">
        <h3>POPULAR WATCHES & ACCESSORIES</h3>
        <div class="container">
            <div class="row row-cols-4">
                <?php foreach ($popular_watches as $each_watch) : ?>
                    <div class="col-3">
                        <div class="product-card mx-1">
                            <div class="image-and-price">
                                <img src="<?= "../" . $each_watch['image_url'] ?>" />
                                <span><?= $each_watch['price'] . " MMK" ?></span>
                            </div>
                            <h4><?= $each_watch['name'] ?></h4>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button class="view-all-btn">ALL Watches</button>
    </div>

    <div class="section-horizontal-divider"></div>

    <footer>
        <div class="footer-section">
            <div class="contact-info">
                <div class="logo">
                    <img src="../icons/unity_mall_logo.png" alt="logo" />
                    <h1>Unity Mall</h1>
                </div>
                <div class="address">
                    <img src="../icons/location.png" alt="location" />
                    <p>52 Street, NewYork City, Rose Town, 07 River House</p>
                </div>
                <div class="telephone">
                    <img src="../icons/phone.png" alt="phone" />
                    <p>+145 475 7890</p>
                </div>
                <div class="mail">
                    <img src="../icons/mail.png" alt="mail" />
                    <p>kaungmawaung@gmail.com</p>
                </div>
                <div class="social-media-section">
                    <div class="facebook">
                        <img src="../icons/facebook-app-symbol.png" alt="" />
                    </div>
                    <div class="twitter">
                        <img src="../icons/twitter.png" alt="" />
                    </div>
                    <div class="youtube">
                        <img src="../icons/youtube.png" alt="" />
                    </div>
                    <div class="instagram">
                        <img src="../icons/instagram.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="information-section">
                <h4>Information<h4>
                        <div class="divider"></div>
                        <a href="#">About Us</a>
                        <a href="#">Latest Post</a>
                        <a href="#">Selling Tips</a>
                        <a href="#">Advertising</a>
                        <a href="#">Contact Us</a>
            </div>
            <div class="my-account-section">
                <h4>My Account<h4>
                        <div class="divider"></div>
                        <a href="#">My Account</a>
                        <a href="#">Login/Register</a>
                        <a href="#">Cart</a>
                        <a href="#">Wishlist</a>
                        <a href="#">Order History</a>
            </div>
            <div class="help-support-section">
                <h4>Help & Support<h4>
                        <div class="divider"></div>
                        <a href="#">How To Shop</a>
                        <a href="#">Payment</a>
                        <a href="#">Returns</a>
                        <a href="#">Delivery</a>
                        <a href="#">Privacy & Cookie Policy</a>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; Copyright Metro 2023. Designed and Developed by Fun Tech</p>
        </div>
    </footer>
</body>

</html>