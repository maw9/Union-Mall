<?php
session_start();

require_once('../style/Head.php');
require_once('Nav.php');
require_once('../database/Connect.php');
require_once('../database/TableNames.php');


$checked_category_ids = [];
if (isset($_GET['category_ids'])) {
    $checked_category_ids = $_GET['category_ids'];
}
$checked_category_ids_string = implode(",", $checked_category_ids);

$checked_size_ids = [];
if (isset($_GET['size_ids'])) {
    $checked_size_ids = $_GET['size_ids'];
}
$checked_size_ids_string = implode(",", $checked_size_ids);

$checked_tag_ids = [];
if (isset($_GET['tag_ids'])) {
    $checked_tag_ids = $_GET['tag_ids'];
}
$checked_tag_ids_string = implode(",", $checked_tag_ids);

$category_query = "SELECT * FROM $category_table";
try {
    $categories_stmt = $pdo->query($category_query);
    $categories = $categories_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage() . "<br>";
}

$size_query = empty($checked_category_ids) ? "SELECT * FROM $size_table"  : "SELECT * FROM $size_table WHERE category_id IN ($checked_category_ids_string)";
try {
    $sizes_stmt = $pdo->query($size_query);
    $sizes = $sizes_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage() . "<br>";
}

$tag_query = "SELECT * FROM $tag_table";
try {
    $tags_stmt = $pdo->query($tag_query);
    $tags = $tags_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage() . "<br>";
}

function get_products_query($table, $cat_ids_string, $size_ids_string)
{
    $result = "";
    if (empty($cat_ids_string) && empty($size_ids_string)) {
        $result = "SELECT * FROM $table";
    }

    if (!empty($cat_ids_string) && empty($size_ids_string)) {
        $result = "SELECT * FROM $table WHERE category_id IN ($cat_ids_string)";
    }

    if (empty($cat_ids_string) && !empty($size_ids_string)) {
        $result = "SELECT * FROM $table WHERE size_id IN ($size_ids_string)";
    }

    if (!empty($cat_ids_string) && !empty($size_ids_string)) {
        $result = "SELECT * FROM $table WHERE category_id IN ($cat_ids_string) AND size_id IN ($size_ids_string)";
    }

    return $result;
}

$product_query = get_products_query($product_table, $checked_category_ids_string, $checked_size_ids_string);
try {
    $products_stmt = $pdo->query($product_query);
    $products = $products_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage() . "<br>";
}

if (!empty($checked_tag_ids_string)) {
    $product_ids_by_tags_query = "SELECT DISTINCT product_id FROM $product_tag_table WHERE tag_id IN ($checked_tag_ids_string)";
    try {
        $product_ids_by_tags_stmt = $pdo->query($product_ids_by_tags_query);
        $product_ids_by_tags = array_map(function ($each) {
            return $each['product_id'];
        }, $product_ids_by_tags_stmt->fetchAll(PDO::FETCH_ASSOC));


        $temp = [];
        foreach ($products as $each_product) {
            if (in_array($each_product['id'], $product_ids_by_tags)) {
                array_push($temp, $each_product);
            }
        }
        $products = $temp;
    } catch (PDOException $pde) {
        echo $pde->getMessage() . "<br>";
    }
}

if (isset($_POST['add-to-cart'])) {
    $id = $_POST['item-id'];
    $source_dir = "Products.php";
    header('Location: AddToCartSession.php?product_id=' . $id . "&source_dir=" . $source_dir);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products</title>
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/products.css">
</head>

<body>
    <div class="container-fluid products-section">
        <div class="row">
            <div class="col-2">
                <div class="filter_section mb-3">

                    <div class="categories">
                        <h3>Categories</h3>
                        <?php foreach ($categories as $each_cat) : ?>
                        <div class="form-check">
                            <input class="form-check-input category_checkbox" type="checkbox"
                                value="<?= $each_cat['id'] ?>" id="<?= "cat_" . $each_cat['id'] ?>"
                                <?= in_array($each_cat['id'], $checked_category_ids) ? "checked" : "" ?> />
                            <label class="form-check-label" for="<?= "cat_" . $each_cat['id'] ?>">
                                <?= $each_cat['name'] ?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="sizes mt-4">
                        <h3>Sizes</h3>
                        <?php foreach ($sizes as $each_size) : ?>
                        <div class="form-check">
                            <input class="form-check-input size_checkbox" type="checkbox"
                                value="<?= $each_size['id'] ?>" id="<?= "size_" . $each_size['id'] ?>"
                                <?= in_array($each_size['id'], $checked_size_ids) ? "checked" : "" ?> />
                            <label class="form-check-label" for="<?= "size_" . $each_size['id'] ?>">
                                <?= $each_size['name'] ?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="tags mt-4">
                        <h3>Tags</h3>
                        <?php foreach ($tags as $each_tag) : ?>
                        <div class="form-check">
                            <input class="form-check-input tag_checkbox" type="checkbox" value="<?= $each_tag['id'] ?>"
                                id="<?= "tag_" . $each_tag['id'] ?>"
                                <?= in_array($each_tag['id'], $checked_tag_ids) ? "checked" : "" ?> />
                            <label class="form-check-label" for="<?= "tag_" . $each_tag['id'] ?>">
                                <?= $each_tag['name'] ?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
            <div class="col-10">
                <div class="d-flex position-absolute top-50 start-50">
                    <h4 style="display: <?= (sizeof($products) < 1) ? 'block' : 'none' ?>">No Result</h4>
                </div>
                <div class="container">
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
    <script>
    var cat_ids_query_param_list = [];
    var size_ids_query_param_list = [];
    var tag_ids_query_param_list = [];

    const categoryCheckboxes = Array.from(document.querySelectorAll('.category_checkbox'));
    const sizeCheckboxes = Array.from(document.querySelectorAll('.size_checkbox'));
    const tagCheckboxes = Array.from(document.querySelectorAll('.tag_checkbox'));
    const checkboxes = categoryCheckboxes.concat(sizeCheckboxes, tagCheckboxes);

    checkboxes.forEach((each) => {
        each.addEventListener("change", () => {
            var count = 0;
            cat_ids_query_param_list = getCheckedIds(categoryCheckboxes).map(
                (eachCat) => "category_ids[" + count++ + "]=" + eachCat
            );

            count = 0;
            size_ids_query_param_list = getCheckedIds(sizeCheckboxes).map(
                (eachSize) => "size_ids[" + count++ + "]=" + eachSize
            );

            count = 0;
            tag_ids_query_param_list = getCheckedIds(tagCheckboxes).map(
                (eachTag) => "tag_ids[" + count++ + "]=" + eachTag
            );
            window.location.href = 'Products.php?' + cat_ids_query_param_list.join('&') + "&" +
                size_ids_query_param_list.join('&') + "&" + tag_ids_query_param_list.join('&');
        });
    });

    function getCheckedIds(checkboxes) {
        var checkedIds = [];
        checkboxes.forEach((each) => {
            if (each.checked) {
                checkedIds.push(each.value);
            }
        });
        return checkedIds;
    }

    function on_add_to_cart(item_id) {
        const request = new Request(`AddToCartSession.php?product_id=${item_id}`)
        fetch(request)
            .then((response) => response.json())
            .then((result) => {
                const cart_item_qty = document.querySelector(".badge");
                cart_item_qty.textContent = result.cart_total_qty;

                const add_to_cart_btn = document.querySelector(`#add-to-cart-${item_id}`);
                add_to_cart_btn.style.display = 'none';

                const qty_controls = document.querySelector(`#qty-controls-${item_id}`);
                qty_controls.style.display = 'block';

                const plus_btn = document.querySelector(`#plus-btn-${item_id}`);
                plus_btn.disabled = !result.is_enable_to_add_more;

                const badge_circle = document.querySelector(".badge");
                badge_circle.style.display = 'block';

                const specific_product_qty = document.querySelector(`#qty-product-${item_id}`);
                specific_product_qty.textContent = result.product_qty;
            });
    }

    function on_remove_from_cart(item_id) {
        const request = new Request(`RemoveFromCartSession.php?product_id=${item_id}`)
        fetch(request)
            .then((response) => response.json())
            .then((result) => {
                const cart_item_qty = document.querySelector(".badge");
                cart_item_qty.textContent = result.cart_total_qty;

                if (result.product_qty == 0) {
                    const add_to_cart_btn = document.querySelector(`#add-to-cart-${item_id}`);
                    add_to_cart_btn.style.display = 'block';

                    const qty_controls = document.querySelector(`#qty-controls-${item_id}`);
                    qty_controls.style.display = 'none';

                    const badge_circle = document.querySelector(".badge");
                    badge_circle.style.display = 'none';
                }

                const plus_btn = document.querySelector(`#plus-btn-${item_id}`);
                plus_btn.disabled = !result.is_enable_to_add_more;

                const specific_product_qty = document.querySelector(`#qty-product-${item_id}`);
                specific_product_qty.textContent = result.product_qty;
            });
    }

    function on_product_click(product_id) {
        window.location.href = `ProductDetail.php?product_id=${product_id}`;
    }
    </script>
</body>

</html>