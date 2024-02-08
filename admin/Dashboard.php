<?php
require_once('../style/Head.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/dashboard.css">
</head>

<body>
    <div class="container-fluid px-4">
        <div class="row dashboard py-3">
            <div class="col-2 p-0">
                <div class="side-nav">
                    <h3>Union Mall</h3>
                    <div class="divider mb-3"></div>
                    <div class="nav-item">
                        <a href="Dashboard.php"><i class="fa-solid fa-chart-line"></i>Dashboard</a>
                    </div>
                    <div class="nav-item">
                        <a href="product/ViewProducts.php"><i class="fa-solid fa-shirt"></i></i>Products</a>
                    </div>
                    <div class="nav-item">
                        <a href="category/ViewCategories.php"><i class="fa-solid fa-icons"></i>Categories</a>
                    </div>
                    <div class="nav-item">
                        <a href="size/ViewSizes.php"><i class="fa-solid fa-maximize"></i>Sizes</a>
                    </div>
                    <div class="nav-item">
                        <a href="tag/ViewTags.php"><i class="fa-solid fa-tags"></i>Tags</a>
                    </div>
                    <div class="nav-item">
                        <a href="user/ViewUsers.php"><i class="fa-solid fa-users"></i>Users</a>
                    </div>
                    <div class="nav-item">
                        <a href=""><i class="fa-solid fa-list-check"></i>Orders</a>
                    </div>
                    <div class="nav-item">
                        <a href=""><i class="fa-solid fa-bell"></i>Notifications</a>
                    </div>
                    <div class="divider mt-3"></div>
                    <div id="account-section">
                        <h4>Account</h4>
                        <div class="nav-item">
                            <a href=""><i class="fa-solid fa-user"></i>Profile</a>
                        </div>
                        <div class="nav-item">
                            <a href=""><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 ps-3">
                <div class="container">
                    <h2>Dashboard</h2>
                    <div class="row mt-4">
                        <div class="col-3">
                            <div class="card-container">
                                <div class="total-card">
                                    <div>
                                        <div class="label">
                                            Total Products
                                        </div>
                                        <div class="count">
                                            100
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon">
                                    <i class="fa-solid fa-shirt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card-container">
                                <div class="total-card">
                                    <div>
                                        <div class="label">
                                            Total Categories
                                        </div>
                                        <div class="count">
                                            200
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon">
                                    <i class="fa-solid fa-icons"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card-container">
                                <div class="total-card">
                                    <div>
                                        <div class="label">
                                            Total Sizes
                                        </div>
                                        <div class="count">
                                            25
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon">
                                    <i class="fa-solid fa-maximize"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card-container">
                                <div class="total-card">
                                    <div>
                                        <div class="label">
                                            Total Tags
                                        </div>
                                        <div class="count">
                                            60
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon">
                                    <i class="fa-solid fa-tags"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="card-container">
                                <div class="total-card">
                                    <div>
                                        <div class="label">
                                            Total Users
                                        </div>
                                        <div class="count">
                                            60
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-container">
                                <div class="total-card">
                                    <div>
                                        <div class="label">
                                            Total Orders
                                        </div>
                                        <div class="count">
                                            60
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-container">
                                <div class="total-card">
                                    <div>
                                        <div class="label">
                                            Total Notifications
                                        </div>
                                        <div class="count">
                                            60
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon">
                                    <i class="fa-solid fa-bell"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>