<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$fetch_categories = "SELECT * FROM $category_table";

try {
    $stmt = $pdo->query($fetch_categories);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Categories</title>
</head>

<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($categories as $each) : ?>
                            <tr>
                                <td><?= $each['id'] ?></td>
                                <td><?= $each['name'] ?></td>
                                <td>
                                    <form method="post">
                                        <input type="text" hidden name="cat_id" value="<?= $each['id'] ?>">
                                        <input type="text" hidden name="cat_name" value="<?= $each['name'] ?>">
                                        <button class="btn btn-primary btn-sm" name="edit"><i class="fa-regular fa-pen-to-square"></i></button>
                                        <button class="btn btn-danger btn-sm" name="delete"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>