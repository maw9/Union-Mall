<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$fetch_orders = "SELECT $order_table.id, $order_table.created_at, $order_table.total_amount,
    $delivery_table.address, $delivery_table.date_to_deliver, $user_table.id as customer_id, $user_table.name
    FROM $order_table RIGHT JOIN $delivery_table ON $order_table.id = $delivery_table.order_id
    LEFT JOIN $user_table ON $user_table.id = $order_table.user_id;";

try {
    $stmt = $pdo->query($fetch_orders);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

if (isset($_POST['edit'])) {
    $id = $_POST['cat_id'];
    $name = $_POST['cat_name'];
    header("Location: UpdateCategory.php?cat_id=$id&cat_name=$name");
}

if (isset($_POST['delete'])) {
    $id = $_POST['cat_id'];
    header("Location: DeleteCategory.php?cat_id=$id");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
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
                        <a href="../product/ViewProducts.php"><i class="fa-solid fa-shirt"></i></i>Products</a>
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
                        <a href="ViewOrders.php"><i class="fa-solid fa-list-check"></i>Orders</a>
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
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Created At</th>
                                        <th>Total Amount</th>
                                        <th>Delivery Address</th>
                                        <th>Delivery Date</th>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th>Enabled Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($orders as $each) : ?>
                                    <tr>
                                        <td><?= $each['id'] ?></td>
                                        <td><?= $each['created_at'] ?></td>
                                        <td><?= $each['total_amount'] ?></td>
                                        <td><?= $each['address'] ?></td>
                                        <td><?= $each['date_to_deliver'] ?></td>
                                        <td><?= $each['customer_id'] ?></td>
                                        <td><?= $each['name'] ?></td>
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