<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

if (isset($_POST['create'])) {
    $tag_name = $_POST['tag_name'];

    $add_new_tag = "INSERT INTO $tag_table (id, name) VALUES (0, '$tag_name');";

    try {
        $pdo->exec($add_new_tag);
        header("Location: CreateTag.php?success=true");
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
    <title>Create Tag</title>
    <link rel="stylesheet" href="../../style/create_update_form.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="form-container">
                    <h3>Create Tag</h3>
                    <form method="post">
                        <div class="mb-3 mt-4">
                            <label for="tag_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="tag_name" name="tag_name"
                                placeholder="Enter tag name" required>
                        </div>
                        <button class="btn btn-primary px-4" name="create">Create</button>
                    </form>
                </div>
                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success mt-3" role="alert">
                    A simple success alert—check it out!
                </div>
                <?php endif; ?>
                <a href="ViewTags.php" class="btn btn-outline-primary mt-4">Go Back</a>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>