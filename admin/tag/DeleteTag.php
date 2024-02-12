<?php
include_once("../../database/Connect.php");
include_once("../../database/TableNames.php");

$tag_id = $_GET['tag_id'];

$delete_tag = "DELETE FROM $tag_table WHERE id=$tag_id";

try {
    $pdo->exec($delete_tag);
    header("Location: ViewTags.php");
} catch (PDOException $pde) {
    echo $pde->getMessage();
}