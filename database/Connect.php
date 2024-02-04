<?php
require_once('Connection.php');
$host = "localhost";
$dbname = "mysql";
$username = "root";
$password = "";
$db_to_use = "union_mall_db";

$connect = new Connection($host, $dbname, $username, $password);
$pdo = $connect->getConnection();

try {
    $create_db = "CREATE DATABASE IF NOT EXISTS $db_to_use;";
    $pdo->exec($create_db);

    $connect_db = "USE $db_to_use;";
    $pdo->exec($connect_db);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}