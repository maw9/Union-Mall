<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

if (isset($_POST['create'])) {
    $cat_name = $_POST['cat_name'];

    $add_new_category = "INSERT INTO $category_table (id, name) VALUES (0, '$cat_name');";

    try {
        $pdo->exec($add_new_category);
        header("Location: CreateCategory.php?success=true");
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
    <link rel="stylesheet" href="../../style/create_update_form.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="form-container">
                    <h3>Create Category</h3>
                    <form method="post">
                        <div class="mb-3 mt-4">
                            <label for="cat_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="cat_name" name="cat_name"
                                placeholder="Enter category name" required>
                        </div>
                        <button class="btn btn-primary px-4" name="create">Create</button>
                    </form>
                </div>
                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success mt-3" role="alert">
                    New category has successfully created!
                </div>
                <?php endif; ?>
                <a href="ViewCategories.php" class="btn btn-outline-primary mt-4">Go Back</a>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>