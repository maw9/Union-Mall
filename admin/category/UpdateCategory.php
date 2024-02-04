<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$cat_id = $_GET['cat_id'];
$cat_name = $_GET['cat_name'];

if (isset($_POST['update'])) {
    $modified_cat_name = $_POST['category_name'];

    $update_cat = "UPDATE $category_table SET name='$modified_cat_name' WHERE id=$cat_id;";

    try {
        $pdo->exec($update_cat);
        header("Location: ViewCategories.php");
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
</head>

<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 bg-warning">
                <h3 class="mt-3">Update Category</h3>
                <form method="post">
                    <div class="mb-3 mt-4">
                        <label for="category_name" class="form-label">Name</label>
                        <input type="text" value="<?= $cat_name ?>" class="form-control" id="category_name" name="category_name" placeholder="Enter category name" required>
                    </div>
                    <button class="btn btn-primary" disabled=true id="update" name="update">Update</button>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const input = document.getElementById('category_name')
            const button = document.getElementById('update')

            input.addEventListener('input', () => {
                button.disabled = input.value == "<?= $cat_name ?>"
            })
        })
    </script>
</body>

</html>