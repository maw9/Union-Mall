<?php
include_once("../../database/Connect.php");
include_once("../../style/Head.php");
include_once("../../database/TableNames.php");

$get_categories = "SELECT * FROM $category_table;";

try {
    $stmt = $pdo->query($get_categories);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$get_sizes = "SELECT * FROM $size_table;";

try {
    $stmt = $pdo->query($get_sizes);
    $sizes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

$get_tags = "SELECT * FROM $tag_table;";

try {
    $stmt = $pdo->query($get_tags);
    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $pde) {
    echo $pde->getMessage();
}

function moveChosenImage()
{
    if (isset($_FILES['product_img']) && $_FILES['product_img']['size'] > 0) {
        $fileName = $_FILES['product_img']['name'];
        $isMoved = move_uploaded_file($_FILES['product_img']['tmp_name'], "../../images/" . $fileName);
        return $isMoved ? $fileName : "";
    }
}

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $cat_id = $_POST['category_id'];
    $size_id = $_POST['size_id'];
    $description = $_POST['description'];
    $image_url = ($_FILES['product_img']['size'] > 0)  ? "images/" . moveChosenImage() : "";
    $tags = $_POST['tags'];

    $insert_product = "INSERT INTO $product_table (id, category_id, size_id, name, price, quantity, description, image_url)
     VALUES (0, '$cat_id', '$size_id', '$name', '$price', '$quantity', '$description', '$image_url');";

    try {
        $result = $pdo->exec($insert_product);
        if ($result) {
            $product_id = $pdo->lastInsertId();
        }
    } catch (PDOException $pde) {
        echo $pde->getMessage();
    }

    foreach ($tags as $tag) {
        try {
            $insert_product_tag = "INSERT INTO $product_tag_table (product_id, tag_id) VALUES ($product_id, $tag)";
            $pdo->exec($insert_product_tag);
        } catch (PDOException $pde) {
            echo $pde->getMessage();
        }
    }

    header("Location: CreateProduct.php?success=true");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="../../style/create_update_form.css">

</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="form-container">
                    <h3>Create Product</h3>
                    <form method="post" class="mt-4" enctype="multipart/form-data">
                        <div class="mb-3">
                            <img id="product_pic" style="width: 90px; height: 90px; object-fit: cover;"
                                class="bg-primary mb-3">
                            <br>
                            <input type="file" id="product_img" name="product_img">
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter product name" required>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price"
                                placeholder="Enter product price" required>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Enter product stock" required>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="category" class="form-label">Category</label>
                            <select name="category_id" id="category" class="form-control">
                                <?php foreach ($categories as $cat) : ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="size" class="form-label">Size</label>
                            <select name="size_id" id="size" class="form-control">
                                <?php foreach ($sizes as $size) : ?>
                                <option value="<?= $size['id'] ?>"><?= $size['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="checkbox-container">
                            <?php foreach ($tags as $tag) : ?>
                            <div class="checkbox-item">
                                <input type="checkbox" id="tag-<?= $tag['id'] ?>" name="tags[]"
                                    value="<?= $tag['id'] ?>">
                                <label for="tag-<?= $tag['id'] ?>"><?= $tag['name'] ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"
                                placeholder="Enter product description" required></textarea>
                        </div>
                        <button class="btn btn-primary px-4" name="create">Create</button>
                    </form>
                </div>
                <?php if (isset($_GET['success'])) : ?>
                <div class="alert alert-success mt-3" role="alert">
                    New product has successfully created!
                </div>
                <?php endif; ?>
                <a href="ViewProducts.php" class="btn btn-outline-primary my-4">Go Back</a>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const image = document.getElementById('product_pic');
        const imageInput = document.getElementById('product_img');

        imageInput.addEventListener("change", () => {
            if (imageInput.files[0]) {
                const fr = new FileReader();
                fr.readAsDataURL(imageInput.files[0]);

                fr.onload = (eve) => {
                    image.src = eve.target.result;
                }
            }
        })

    })
    </script>
</body>

</html>