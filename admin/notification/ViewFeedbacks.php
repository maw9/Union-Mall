<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$fetch_feedbacks = "SELECT * FROM $feedback_table";

try {
    $stmt = $pdo->query($fetch_feedbacks);
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Notifications</title>
    <link rel="stylesheet" href="../../style/dashboard.css">
    <link rel="stylesheet" href="../../style/view_users.css">
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
                        <a href="../order/ViewOrders.php"><i class="fa-solid fa-list-check"></i>Orders</a>
                    </div>
                    <div class="nav-item">
                        <a href="ViewFeedbacks.php"><i class="fa-solid fa-bell"></i>Notifications</a>
                    </div>
                    <div class="divider mt-3"></div>
                    <div id="account-section">
                        <h4>Account</h4>
                        <div class="nav-item">
                            <a href="../profile/Profile.php"><i class="fa-solid fa-user"></i>Profile</a>
                        </div>
                        <div class="nav-item">
                            <a href=""><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Enabled Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($feedbacks as $each) : ?>
                                    <tr>
                                        <td><?= $each['id'] ?></td>
                                        <td><?= $each['name'] ?></td>
                                        <td><?= $each['email'] ?></td>
                                        <td><?= $each['subject'] ?></td>
                                        <td><?= $each['message'] ?></td>
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