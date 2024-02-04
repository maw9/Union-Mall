<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$fetch_categories = "SELECT $product_table.*, $category_table.name as 'category_name' 
FROM $product_table LEFT JOIN 
    $category_table ON $product_table.category_id = $category_table.id;";

try {
    $stmt = $pdo->query($fetch_categories);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

if (isset($_POST['delete'])) {
    $product_id = $_POST['id'];
    header("Location: DeleteProduct.php?id=$product_id");
}

if (isset($_POST['edit'])) {
    $product_id = $_POST['id'];
    header("Location: UpdateProduct.php?id=$product_id");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Description</th>
                            <th>Enabled Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($products as $each) : ?>
                            <tr>
                                <td><?= $each['id'] ?></td>
                                <td><?= $each['name'] ?></td>
                                <td><?= $each['category_name'] ?></td>
                                <td><?= $each['price'] ?></td>
                                <td><?= $each['quantity'] ?></td>
                                <td><?= $each['description'] ?></td>
                                <td>
                                    <form method="post">
                                        <input type="text" hidden name="id" value="<?= $each['id'] ?>">
                                        <button class="btn btn-primary btn-sm" name="edit"><i class="fa-regular fa-pen-to-square"></i></button>
                                        <button class="btn btn-danger btn-sm" name="delete"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</body>

</html>