<?php
require_once('../style/Head.php');
require_once('../database/Connect.php');
require_once('../database/TableNames.php');

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}

$get_products_query = "SELECT product.* FROM product
LEFT JOIN category ON product.category_id = category.id
LEFT JOIN size ON product.size_id = size.id
RIGHT JOIN product_tag ON product.id = product_tag.product_id
LEFT JOIN tag ON product_tag.tag_id = tag.id WHERE product.name LIKE '%$keyword%' OR size.name LIKE '%$keyword%' OR category.name LIKE '%$keyword%' OR tag.name LIKE '%$keyword%';";

try {
    $stmt = $pdo->query($get_products_query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $products = removeDuplicates($results, 'name');
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

function removeDuplicates($array, $attribute) {
    $uniqueValues = array();
    $result = array();
    foreach ($array as $item) {
        $value = $item[$attribute];
        if (!in_array($value, $uniqueValues)) {
            $uniqueValues[] = $value;
            $result[] = $item;
        }
    }
    return $result;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/products.css">
    <link rel="stylesheet" href="../style/search_results.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 id="search-title">Search</h1>
                <div class="search-box me-4">
                    <img src="../icons/ic_search.png" />
                    <form method="get">
                        <input type="text" name="keyword" placeholder="SEARCH FOR PRODUCTS" />
                    </form>
                </div>
                <h3 id="search-result-label">Search results for "<?= $keyword ?>"</h3>
                <div class="d-flex position-absolute top-50 start-50">
                    <h4 style="display: <?= (sizeof($products) < 1) ? 'block' : 'none' ?>">No Result</h4>
                </div>
                <div class="container mt-5">
                    <div class="row row-cols-3">
                        <?php foreach ($products as $each_product) : ?>
                        <div class="col-4">
                            <div class="product-card px-3 pb-4">
                                <div onClick="on_product_click(<?= $each_product['id'] ?>)">
                                    <div class="image-and-price">
                                        <img src="<?= "../" . $each_product['image_url'] ?>" />
                                        <span><?= $each_product['price'] . " MMK" ?></span>
                                    </div>
                                    <h4><?= $each_product['name'] ?></h4>
                                </div>

                                <div class="cart-action-container">
                                    <div id="qty-controls-<?= $each_product['id'] ?>" class="qty-controls"
                                        style="display: <?= (isset($_SESSION['cart'][$each_product['id']]) && ($_SESSION['cart'][$each_product['id']]['qty'] > 0)) ? "block" : "none" ?>">
                                        <button class="minus-btn"
                                            onClick="on_remove_from_cart(<?= $each_product['id'] ?>)"><i
                                                class="fa-solid fa-minus"></i></i></button>
                                        <span id="qty-product-<?= $each_product['id'] ?>"
                                            class="mx-4"><?= $_SESSION['cart'][$each_product['id']]['qty'] ?></span>
                                        <button id="plus-btn-<?= $each_product['id'] ?>" class="plus-btn"
                                            onClick="on_add_to_cart(<?= $each_product['id'] ?>)"><i
                                                class="fa-solid fa-plus"></i></button>
                                    </div>

                                    <button onClick="on_add_to_cart(<?= $each_product['id'] ?>)" class="add-to-cart-btn"
                                        id="add-to-cart-<?= $each_product['id'] ?>"
                                        <?php if ($each_product['quantity'] <= 0) : echo "disabled";
                                                                                                                                                                            endif ?>
                                        style="display: <?= (!isset($_SESSION['cart'][$each_product['id']]) || ($_SESSION['cart'][$each_product['id']]['qty'] < 1)) ? "block" : "none" ?>">
                                        Add to Cart
                                    </button>

                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>