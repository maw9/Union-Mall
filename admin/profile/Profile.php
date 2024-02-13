<?php
session_start();
include_once("../../style/Head.php");

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

if (isset($_GET['edit'])) {
    header('Location: EditProfile.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../../style/dashboard.css">
    <link rel="stylesheet" href="../../style/admin_profile.css">
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
                        <a href="../notification/ViewFeedbacks.php"><i class="fa-solid fa-bell"></i>Notifications</a>
                    </div>
                    <div class="divider mt-3"></div>
                    <div id="account-section">
                        <h4>Account</h4>
                        <div class="nav-item">
                            <a href="Profile.php"><i class="fa-solid fa-user"></i>Profile</a>
                        </div>
                        <div class="nav-item">
                            <a href="../LogoutAdmin.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 ps-3 d-flex justify-content-center align-items-center">
                <div class="profile-container">
                    <img
                        src="<?= !empty($user['profile_url']) ? "../../" . $user['profile_url'] : "../../images/avatar.png" ?>">
                    <div class="user-info">
                        <label>Name</label>
                        </br>
                        <span><?= $user['name'] ?></span>
                        </br>
                        </br>
                        <label>Email</label>
                        </br>
                        <span><?= $user['email'] ?></span>
                        </br>
                        </br>
                        <label>Address</label>
                        </br>
                        <span><?= $user['address'] ?></span>
                        </br>
                        </br>
                        </br>
                        <form>
                            <button name="edit"><i class="fa-solid fa-pen me-3"></i>EDIT PROFILE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>