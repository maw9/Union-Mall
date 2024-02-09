<?php
include_once("../database/Connect.php");
include_once("../style/Head.php");
include_once("../database/TableNames.php");

$fetch_total_products = "SELECT SUM(quantity) as total FROM $product_table";
try {
    $stmt = $pdo->query($fetch_total_products);
    $total_products = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$fetch_total_categories = "SELECT COUNT(*) as total FROM $category_table";
try {
    $stmt = $pdo->query($fetch_total_categories);
    $total_categories = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$fetch_total_sizes = "SELECT COUNT(*) as total FROM $size_table";
try {
    $stmt = $pdo->query($fetch_total_sizes);
    $total_sizes = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$fetch_total_tags = "SELECT COUNT(*) as total FROM $tag_table";
try {
    $stmt = $pdo->query($fetch_total_tags);
    $total_tags = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$fetch_total_users = "SELECT COUNT(*) as total FROM $user_table";
try {
    $stmt = $pdo->query($fetch_total_users);
    $total_users = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$fetch_total_orders = "SELECT COUNT(*) as total FROM $order_table";
try {
    $stmt = $pdo->query($fetch_total_orders);
    $total_orders = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$fetch_total_feedbacks = "SELECT COUNT(*) as total FROM $feedback_table";
try {
    $stmt = $pdo->query($fetch_total_feedbacks);
    $total_feedbacks = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/dashboard.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                        <a href="order/ViewOrders.php"><i class="fa-solid fa-list-check"></i>Orders</a>
                    </div>
                    <div class="nav-item">
                        <a href="notification/ViewFeedbacks.php"><i class="fa-solid fa-bell"></i>Notifications</a>
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
                                            Total Stocks
                                        </div>
                                        <div class="count">
                                            <?= $total_products['total'] ?>
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
                                            <?= $total_categories['total'] ?>
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
                                            <?= $total_sizes['total'] ?>
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
                                            <?= $total_tags['total'] ?>
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
                                            <?= $total_users['total'] ?>
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
                                            <?= $total_orders['total'] ?>
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
                                            <?= $total_feedbacks['total'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon">
                                    <i class="fa-solid fa-bell"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <!--Div that will hold the pie chart-->
                            <div id="chart_div" class="chart-card"></div>
                        </div>
                        <div class="col-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        const request = new Request(`FetchProductsCountByCategorySession.php`);
        fetch(request)
            .then((response) => response.json())
            .then((result) => {
                console.log(result);

                // Create the data table.
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Categories');
                data.addColumn('number', 'Total Products');

                let chart_data = [];
                for (let i = 0; i < result.categories.length; i++) {
                    chart_data[i] = [result.categories[i], Number(result.total_products_per_cat[i])];
                }

                console.log(chart_data);

                data.addRows(chart_data);

                // Set chart options
                var options = {
                    'title': 'Total Product Stocks Per Category',
                    'is3D': true,
                };

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            });
    }
    </script>
</body>

</html>