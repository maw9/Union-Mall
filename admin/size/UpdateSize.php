<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$size_id = $_GET['size_id'];
$size_name = $_GET['size_name'];
$cat_id = $_GET['cat_id'];

$fetch_categories = "SELECT * FROM $category_table";

try {
    $stmt = $pdo->query($fetch_categories);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

if (isset($_POST['update'])) {
    $modified_size_name = $_POST['size_name'];
    $modified_cat_id = $_POST['category_id'];

    $update_tag = "UPDATE $size_table SET name='$modified_size_name', category_id=$modified_cat_id WHERE id=$size_id;";

    try {
        $pdo->exec($update_tag);
        header("Location: UpdateSize.php?success=true&size_id=$size_id&size_name=$modified_size_name&cat_id=$modified_cat_id");
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
    <title>Update Size</title>
    <link rel="stylesheet" href="../../style/create_update_form.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">

                <div class="form-container">
                    <h3>Update Size</h3>
                    <form method="post">
                        <div class="mb-3 mt-4">
                            <label for="size_name" class="form-label">Name</label>
                            <input type="text" value="<?= $size_name ?>" class="form-control" id="size_name"
                                name="size_name" placeholder="Enter size name" required>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="category" class="form-label">Related Category</label>
                            <select name="category_id" id="category" class="form-control">
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $cat_id) ? "selected" : "" ?>>
                                    <?= $cat['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-primary" disabled=true id="update" name="update">Update</button>
                    </form>
                </div>
                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success mt-3" role="alert">
                    Size has successfully updated!
                </div>
                <?php endif; ?>
                <a href="ViewSizes.php" class="btn btn-outline-primary mt-4">Go Back</a>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const input = document.getElementById('size_name')
        const button = document.getElementById('update')
        const selector = document.getElementById('category')

        input.addEventListener('input', () => {
            button.disabled = (input.value == "<?= $size_name ?>") && (selector.value ==
                "<?= $cat_id ?>")
        })

        selector.addEventListener('change', function(event) {
            // Code to execute when the select option changes
            var selectedOption = event.target.value;
            button.disabled = (input.value == "<?= $size_name ?>") && (selectedOption ==
                "<?= $cat_id ?>")
        });
    })
    </script>
</body>

</html>