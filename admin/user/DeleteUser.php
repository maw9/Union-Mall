<?php
include_once("../../database/Connect.php");
include_once("../../database/TableNames.php");

$user_id = $_GET['id'];

$delete_user = "DELETE FROM $user_table WHERE id=$user_id";

try {
    $pdo->exec($delete_user);
    header("Location: ViewUsers.php");
} catch (PDOException $pde) {
    echo $pde->getMessage();
}