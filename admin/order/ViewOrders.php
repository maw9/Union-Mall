<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$fetch_orders = "SELECT $order_table.id, $order_table.created_at, $order_table.total_amount, $order_table.status,
    $delivery_table.address, $delivery_table.date_to_deliver, $user_table.id as customer_id, $user_table.name
    FROM $order_table RIGHT JOIN $delivery_table ON $order_table.id = $delivery_table.order_id
    LEFT JOIN $user_table ON $user_table.id = $order_table.user_id;";

try {
    $stmt = $pdo->query($fetch_orders);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

if (isset($_POST['accept'])) {
    $id = $_POST['id'];
    $update_status_to_accept = "UPDATE $order_table SET status='accepted' WHERE id=$id";
    try {
        $pdo->exec($update_status_to_accept);
        header("Location: ViewOrders.php");
    } catch (PDOException $pde) {
        echo $pde->getMessage();
    }
}

if (isset($_POST['reject'])) {
    $id = $_POST['id'];
    $update_status_to_reject = "UPDATE $order_table SET status='rejected' WHERE id=$id";
    try {
        $pdo->exec($update_status_to_reject);
        $fetch_ordered_stocks = "SELECT * FROM $order_product_table WHERE order_id=$id";
        $stmt = $pdo->query($fetch_ordered_stocks);
        $ordered_stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($ordered_stocks as $each) {
            $product_id = $each['product_id'];
            $fetch_stock_qty = "SELECT quantity FROM $product_table WHERE id=$product_id";
            $stock_stmt = $pdo->query($fetch_stock_qty);
            $stock_qty = $stock_stmt->fetch(PDO::FETCH_ASSOC);
            $updated_qty = $stock_qty['quantity'] + $each['quantity'];
            $restock_query = "UPDATE $product_table SET quantity=$updated_qty WHERE id=$product_id";
            $pdo->exec($restock_query);
        }
        header("Location: ViewOrders.php");
    } catch (PDOException $pde) {
        echo $pde->getMessage();
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    header("Location: DeleteOrder.php?id=$id");
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
                                        <th>Status</th>
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
                                        <td><?= ucfirst($each['status']) ?></td>
                                        <td>
                                            <form method="post">
                                                <input type="text" hidden name="id" value="<?= $each['id'] ?>">
                                                <?php if ($each['status'] == "pending") : ?>
                                                <button class="btn btn-success btn-sm" name="accept"><i
                                                        class="fa-solid fa-check"></i></button>
                                                <button class="btn btn-danger btn-sm" name="reject"><i
                                                        class="fa-solid fa-xmark"></i></button>
                                                <?php endif; ?>
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