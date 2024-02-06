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
        $pde->get_message();
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
            <div class="col-3"></div>
            <div class="col-6">
                <h1 class="order-history-title mb-4">Orders History</h1>
                <div class="container">
                    <?php if (sizeof($order_histories) == 0): ?>
                        <div class="empty-order">
                            There is no order made.
                        </div>
                    <?php endif; ?>
                    <?php foreach($order_histories as $each): ?>
                        <div class="row order-item mb-4" onClick="window.location.href = 'OrderHistoryDetail.php?order_id=<?= $each['id'] ?>';">
                            <div class="col-1">
                                <i class="fa-solid fa-dolly"></i>
                            </div>
                            <div class="col-4 ps-5">
                                Order ID: <?= $each['id'] ?>
                            </div>
                            <div class="col-4">
                                Total: <?= $each['total_amount'] ?> MMK
                            </div>
                            <div class="col-3">
                                <?= $each['created_at'] ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
</html>