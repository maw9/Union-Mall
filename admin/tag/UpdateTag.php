<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$tag_id = $_GET['tag_id'];
$tag_name = $_GET['tag_name'];

if (isset($_POST['update'])) {
    $modified_tag_name = $_POST['tag_name'];

    $update_tag = "UPDATE $tag_table SET name='$modified_tag_name' WHERE id=$tag_id;";

    try {
        $pdo->exec($update_tag);
        header("Location: UpdateTag.php?success=true&tag_id=$tag_id&tag_name=$modified_tag_name");
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
    <title>Update Tag</title>
    <link rel="stylesheet" href="../../style/create_update_form.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">

                <div class="form-container">
                    <h3>Update Tag</h3>
                    <form method="post">
                        <div class="mb-3 mt-4">
                            <label for="tag_name" class="form-label">Name</label>
                            <input type="text" value="<?= $tag_name ?>" class="form-control" id="tag-name"
                                name="tag_name" placeholder="Enter tag name" required>
                        </div>
                        <button class="btn btn-primary" disabled=true id="update" name="update">Update</button>
                    </form>
                </div>
                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success mt-3" role="alert">
                    Tag has successfully updated!
                </div>
                <?php endif; ?>
                <a href="ViewTags.php" class="btn btn-outline-primary mt-4">Go Back</a>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const input = document.getElementById('tag-name')
        const button = document.getElementById('update')

        input.addEventListener('input', () => {
            button.disabled = input.value == "<?= $tag_name ?>"
        })
    })
    </script>
</body>

</html>