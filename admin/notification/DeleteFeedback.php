<?php
include_once("../../database/Connect.php");
include_once("../../database/TableNames.php");

$feedback_id = $_GET['id'];

$delete_feedback = "DELETE FROM $feedback_table WHERE id=$feedback_id";

try {
    $pdo->exec($delete_feedback);
    header("Location: ViewFeedbacks.php");
} catch (PDOException $pde) {
    echo $pde->getMessage();
}