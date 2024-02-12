<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$cat_id = $_GET['cat_id'];
$cat_name = $_GET['cat_name'];

if (isset($_POST['update'])) {
    $modified_cat_name = $_POST['cat_name'];

    $update_category = "UPDATE $category_table SET name='$modified_cat_name' WHERE id=$cat_id;";

    try {
        $pdo->exec($update_category);
        header("Location: UpdateCategory.php?success=true&cat_id=$cat_id&cat_name=$modified_cat_name");
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
    <title>Update Category</title>
    <link rel="stylesheet" href="../../style/create_update_form.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">

                <div class="form-container">
                    <h3>Update Category</h3>
                    <form method="post">
                        <div class="mb-3 mt-4">
                            <label for="cat_name" class="form-label">Name</label>
                            <input type="text" value="<?= $cat_name ?>" class="form-control" id="cat_name"
                                name="cat_name" placeholder="Enter category name" required>
                        </div>
                        <button class="btn btn-primary" disabled=true id="update" name="update">Update</button>
                    </form>
                </div>
                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success mt-3" role="alert">
                    Category has successfully updated!
                </div>
                <?php endif; ?>
                <a href="ViewCategories.php" class="btn btn-outline-primary mt-4">Go Back</a>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const input = document.getElementById('cat_name')
        const button = document.getElementById('update')

        input.addEventListener('input', () => {
            button.disabled = input.value == "<?= $cat_name ?>"
        })
    })
    </script>
</body>

</html>