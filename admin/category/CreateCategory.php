<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

if (isset($_POST['create'])) {
    $cat_name = $_POST['category_name'];

    $add_new_cat = "INSERT INTO $category_table (id, name) VALUES (0, '$cat_name');";

    try {
        $pdo->exec($add_new_cat);
        echo "New category added!" . "<br>";
    } catch (PDOException $pde) {
        echo $pde->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
</head>

<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 bg-warning">
                <h3 class="mt-3">Create Category</h3>
                <form method="post">
                    <div class="mb-3 mt-4">
                        <label for="category_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name"
                            placeholder="Enter category name" required>
                    </div>
                    <button class="btn btn-primary" name="create">Create</button>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>