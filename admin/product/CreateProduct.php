<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$get_categories = "SELECT * FROM $category_table;";

try {
    $stmt = $pdo->query($get_categories);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

if (isset($_POST['create'])) {
    $name = $_POST['product_name'];
    $cat_id = $_POST['cat_id'];
    $price = $_POST['product_price'];
    $quantity = $_POST['stock_quantity'];
    $description = $_POST['description'];

    $insert_product = "INSERT INTO $product_table (id, category_id, name, price, quantity, description)
     VALUES (0, '$cat_id', '$name', '$price', '$quantity', '$description');";

    try {
        $pdo->exec($insert_product);
        echo "Product has been successfully added!";
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
                <h3 class="mt-3">Create Product</h3>
                <form method="post">
                    <div class="mb-3 mt-4">
                        <label for="product_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="cat_id" id="category" aria-label="Default select example">
                            <?php foreach ($categories as $each) : ?>
                                <option value="<?= $each['id'] ?>"><?= $each['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="product_price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Enter price" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="stock_quantity" class="form-label">Quantity</label>
                        <input type="number" min="1" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Enter stock quantity" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"></textarea>
                    </div>
                    <button class="btn btn-primary" name="create">Create</button>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>