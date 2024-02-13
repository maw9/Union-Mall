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

$get_sizes = "SELECT * FROM $size_table;";

try {
    $stmt = $pdo->query($get_sizes);
    $sizes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../../style/create_update_form.css">

</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="form-container">
                    <h3>Create Product</h3>
                    <form method="post">
                        <div class="mb-3 mt-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter product name" required>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price"
                                placeholder="Enter product price" required>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Enter product stock" required>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="category" class="form-label">Category</label>
                            <select name="category_id" id="category" class="form-control">
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="size" class="form-label">Size</label>
                            <select name="size_id" id="size" class="form-control">
                                <?php foreach ($sizes as $size): ?>
                                <option value="<?= $size['id'] ?>"><?= $size['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"
                                placeholder="Enter product description" required></textarea>
                        </div>
                        <button class="btn btn-primary px-4" name="create">Create</button>
                    </form>
                </div>
                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success mt-3" role="alert">
                    New category has successfully created!
                </div>
                <?php endif; ?>
                <a href="ViewCategories.php" class="btn btn-outline-primary mt-4">Go Back</a>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>