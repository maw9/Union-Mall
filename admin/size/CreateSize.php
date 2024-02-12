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

if (isset($_POST['create'])) {
    $size_name = $_POST['size_name'];
    $category_id = $_POST['category_id'];

    $add_new_size = "INSERT INTO $size_table (id, category_id, name) VALUES (0, '$category_id', '$size_name');";

    try {
        $pdo->exec($add_new_size);
        header("Location: CreateSize.php?success=true");
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
    <title>Create Size</title>
    <link rel="stylesheet" href="../../style/create_update_form.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="form-container">
                    <h3>Create Size</h3>
                    <form method="post">
                        <div class="mb-3 mt-4">
                            <label for="size_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="size_name" name="size_name"
                                placeholder="Enter size name" required>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="category" class="form-label">Related Category</label>
                            <select name="category_id" id="category" class="form-control">
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-primary px-4" name="create">Create</button>
                    </form>
                </div>
                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success mt-3" role="alert">
                    New size has successfully created!
                </div>
                <?php endif; ?>
                <a href="ViewSizes.php" class="btn btn-outline-primary mt-4">Go Back</a>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>