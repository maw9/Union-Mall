<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

// $get_products_query = "SELECT $product_table.*, $category_table.name as 'category', $size_table.name as 'size' FROM $product_table 
//     LEFT JOIN $category_table ON $product_table.category_id = $category_table.id
//     LEFT JOIN $size_table ON $product_table.size_id = $size_table.id;";

$get_products_query = "SELECT $product_table.*, $category_table.name as 'category', $size_table.name as 'size', $tag_table.name as tag FROM $product_table 
    LEFT JOIN $category_table ON $product_table.category_id = $category_table.id
    LEFT JOIN $size_table ON $product_table.size_id = $size_table.id
    RIGHT JOIN $product_tag_table ON $product_table.id = $product_tag_table.product_id
    LEFT JOIN $tag_table ON $product_tag_table.tag_id = $tag_table.id;";

try {
    $stmt = $pdo->query($get_products_query);
    $raw_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $products = [];
    $current_id = -1;
    $index = -1;
    foreach ($raw_products as $each_raw) {
        if ($current_id != $each_raw['id']) {
            $index += 1;
            $current_id = $each_raw['id'];
            array_push($products, [
                'id' => $each_raw['id'],
                'name' => $each_raw['name'],
                'price' => $each_raw['price'],
                'quantity' => $each_raw['quantity'],
                'description' => $each_raw['description'],
                'image_url' => $each_raw['image_url'],
                'category' => $each_raw['category'],
                'size' => $each_raw['size'],
                'tags' => [$each_raw['tag']]
            ]);
        } else {
            array_push($products[$index]['tags'], $each_raw['tag']);
        }
    }
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
    <link rel="stylesheet" href="../../style/view_products.css">
    <link rel="stylesheet" href="../../style/dashboard.css">
</head>

<body>
    <div class="container-fluid px-4">
        <div class="row dashboard py-3">
            <div class="col-2 p-0">
                <div class="side-nav">
                    <h3>Union Mall</h3>
                    <div class="divider mb-3"></div>
                    <div class="nav-item">
                        <a href="../Dashboard.php"><i class="fa-solid fa-chart-line"></i>Dashboard</a>
                    </div>
                    <div class="nav-item">
                        <a href="ViewProducts.php"><i class="fa-solid fa-shirt"></i></i>Products</a>
                    </div>
                    <div class="nav-item">
                        <a href="../category/ViewCategories.php"><i class="fa-solid fa-icons"></i>Categories</a>
                    </div>
                    <div class="nav-item">
                        <a href="../size/ViewSizes.php"><i class="fa-solid fa-maximize"></i>Sizes</a>
                    </div>
                    <div class="nav-item">
                        <a href="../tag/ViewTags.php"><i class="fa-solid fa-tags"></i>Tags</a>
                    </div>
                    <div class="nav-item">
                        <a href="../user/ViewUsers.php"><i class="fa-solid fa-users"></i>Users</a>
                    </div>
                    <div class="nav-item">
                        <a href="../order/ViewOrders.php"><i class="fa-solid fa-list-check"></i>Orders</a>
                    </div>
                    <div class="nav-item">
                        <a href="../notification/ViewFeedbacks.php"><i class="fa-solid fa-bell"></i>Notifications</a>
                    </div>
                    <div class="divider mt-3"></div>
                    <div id="account-section">
                        <h4>Account</h4>
                        <div class="nav-item">
                            <a href="../profile/Profile.php"><i class="fa-solid fa-user"></i>Profile</a>
                        </div>
                        <div class="nav-item">
                            <a href="../LogoutAdmin.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 ps-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <a href="CreateProduct.php" class="btn btn-primary mb-3">Create New Product</a>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Description</th>
                                        <th>Tags</th>
                                        <th>Enabled Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($products as $each) : ?>
                                    <tr>
                                        <td><?= $each['id'] ?></td>
                                        <td><img src="../../<?= $each['image_url'] ?>"></td>
                                        <td><?= $each['name'] ?></td>
                                        <td><?= $each['category'] ?></td>
                                        <td><?= $each['size'] ?></td>
                                        <td><?= $each['quantity'] ?></td>
                                        <td><?= $each['description'] ?></td>
                                        <td>
                                            <span><?= implode(", ", $each['tags']); ?></span>
                                        </td>
                                        <td>
                                            <form method="post">
                                                <input type="text" hidden name="id" value="<?= $each['id'] ?>">
                                                <button class="btn btn-primary btn-sm" name="edit"><i
                                                        class="fa-regular fa-pen-to-square"></i></button>
                                                <button class="btn btn-danger btn-sm" name="delete"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>