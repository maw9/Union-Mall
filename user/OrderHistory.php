<?php
session_start();
require_once("../style/Head.php");
require_once('Nav.php');
require_once("../database/TableNames.php");
require_once("../database/Connect.php");
session_start();

$order_histories = [];
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
    $order_histories_query = "SELECT * FROM $order_table WHERE user_id=$user_id";

    try {
        $stmt = $pdo->query($order_histories_query);
        $order_histories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $pde) {
        $pde->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="../style/order_history.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <h1 class="order-history-title mb-4">Orders History</h1>
                <div class="container-fluid">
                    <?php if (sizeof($order_histories) == 0) : ?>
                    <div class="empty-order">
                        There is no order made.
                    </div>
                    <?php endif; ?>
                    <?php foreach ($order_histories as $each) : ?>
                    <div class="row order-item mb-4"
                        onClick="window.location.href = 'OrderHistoryDetail.php?order_id=<?= $each['id'] ?>';">
                        <div class="col-1">
                            <i class="fa-solid fa-dolly"></i>
                        </div>
                        <div class="col-3">
                            Order ID: <?= $each['id'] ?>
                        </div>
                        <div class="col-4">
                            Total: <?= $each['total_amount'] ?> MMK
                        </div>
                        <div class="col-2">
                            <?= $each['created_at'] ?>
                        </div>
                        <div class="col-2 ps-4" style="color: <?php if ($each['status'] == "pending") {
                                                                        echo "rgb(223, 172, 85)";
                                                                    } else if ($each['status'] == "accept") {
                                                                        echo "rgb(127, 183, 98)";
                                                                    } else {
                                                                        echo "rgb(189, 84, 80)";
                                                                    }  ?>">
                            <?= $each['status'] ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>

</html>