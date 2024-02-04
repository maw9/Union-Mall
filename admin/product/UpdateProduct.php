<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$product_id = $_GET['id'];

$get_categories = "SELECT * FROM $category_table;";
$get_product_by_id = "SELECT * FROM $product_table WHERE id='$product_id'";

try {
    $stmt = $pdo->query($get_categories);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $product_stmt = $pdo->query($get_product_by_id);
    $product = $product_stmt->fetch();

    foreach ($categories as $each) {
        if ($each['id'] == $product['category_id']) {
            $selected_category = $each['name'];
        }
    }
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

if (isset($_POST['update'])) {
    $id = $product['id'];
    $name = $_POST['product_name'];
    $cat_id = $_POST['cat_id'];
    $price = $_POST['product_price'];
    $quantity = $_POST['stock_quantity'];
    $description = $_POST['description'];

    $update_product = "UPDATE $product_table SET name='$name', category_id='$cat_id', price='$price', quantity='$quantity', description='$description' WHERE id='$id'";

    try {
        $pdo->exec($update_product);
        header("Location: ViewProducts.php");
    } catch (PDOException $pde) {
        echo $pde->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>

<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 bg-warning">
                <h3 class="mt-3">Update Product</h3>
                <form method="post">
                    <div class="mb-3 mt-4">
                        <label for="product_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required value="<?= $product['name'] ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="cat_id" id="category" aria-label="Default select example">
                            <?php foreach ($categories as $each) : ?>
                                <option <?= $each['name'] == $selected_category ? "selected" : "" ?> value="<?= $each['id'] ?>"><?= $each['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="product_price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Enter price" required value="<?= $product['price'] ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="stock_quantity" class="form-label">Quantity</label>
                        <input type="number" min="1" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Enter stock quantity" required value="<?= $product['quantity'] ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"><?= $product['description'] ?></textarea>
                    </div>
                    <button class="btn btn-primary" name="update">Update</button>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>