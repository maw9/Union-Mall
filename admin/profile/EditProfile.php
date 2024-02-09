<?php
session_start();
include_once("../../style/Head.php");
require_once("../../utils/RegisterSuccessDialog.php");
include_once("../../database/Connect.php");
include_once("../../database/TableNames.php");

function moveChosenImage()
{
    if (isset($_FILES['profile_url']) && $_FILES['profile_url']['size'] > 0) {
        $fileName = $_FILES['profile_url']['name'];
        $isMoved = move_uploaded_file($_FILES['profile_url']['tmp_name'], "../../images/" . $fileName);
        return $isMoved ? $fileName : "";
    }
}

if (isset($_POST["update"])) {
    $user_id = $_SESSION['user']['id'];
    $username = $_POST["username"];
    $address = $_POST["address"];
    $profile_url = ($_FILES['profile_url']['size'] > 0)  ? "images/" . moveChosenImage() : "";

    if (empty($profile_url)) {
        $update_user_query = "UPDATE $user_table SET name='$username', address='$address' WHERE id='$user_id'";
    } else {
        $update_user_query = "UPDATE $user_table SET name='$username', address='$address', profile_url='$profile_url' WHERE id='$user_id'";
    }


    try {
        $pdo->exec($update_user_query);
        $_SESSION['user']['name'] = $username;
        $_SESSION['user']['address'] = $address;
        if (!empty($profile_url)) {
            $_SESSION['user']['profile_url'] = $profile_url;
        }
        header('Location: Profile.php');
    } catch (PDOException $pde) {
        echo ($pde->getMessage());
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../../style/dashboard.css">
    <link rel="stylesheet" href="../../style/edit_profile.css">
</head>

<body>
    <div class="container-fluid px-4">
        <div class="row dashboard py-3">
            <div class="col-2 p-0">
                <div class="side-nav">
                    <h3>Union Mall</h3>
                    <div class="divider mb-3"></div>
                    <div class="nav-item">
                        <a href="../Dashboard.php"><i class="fa-solid fa-chart-line"></i>Dashboard</a>
                    </div>
                    <div class="nav-item">
                        <a href="../product/ViewProducts.php"><i class="fa-solid fa-shirt"></i></i>Products</a>
                    </div>
                    <div class="nav-item">
                        <a href="../category/ViewCategories.php"><i class="fa-solid fa-icons"></i>Categories</a>
                    </div>
                    <div class="nav-item">
                        <a href="../size/ViewSizes.php"><i class="fa-solid fa-maximize"></i>Sizes</a>
                    </div>
                    <div class="nav-item">
                        <a href="../tag/ViewTags.php"><i class="fa-solid fa-tags"></i>Tags</a>
                    </div>
                    <div class="nav-item">
                        <a href="../user/ViewUsers.php"><i class="fa-solid fa-users"></i>Users</a>
                    </div>
                    <div class="nav-item">
                        <a href="../order/ViewOrders.php"><i class="fa-solid fa-list-check"></i>Orders</a>
                    </div>
                    <div class="nav-item">
                        <a href="../notification/ViewFeedbacks.php"><i class="fa-solid fa-bell"></i>Notifications</a>
                    </div>
                    <div class="divider mt-3"></div>
                    <div id="account-section">
                        <h4>Account</h4>
                        <div class="nav-item">
                            <a href="Profile.php"><i class="fa-solid fa-user"></i>Profile</a>
                        </div>
                        <div class="nav-item">
                            <a href=""><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 ps-3">
                <h1 class="mall-name">Edit Profile</h1>
                <div class="d-flex justify-content-center">
                    <div class=" register-container">
                        <form method="post" enctype="multipart/form-data">
                            <div class="d-flex">
                                <div class="profile">
                                    <img id="profile_pic"
                                        src="<?= empty($_SESSION['user']['profile_url']) ? "../../images/avatar.png" : "../../" . $_SESSION['user']['profile_url'] ?>"
                                        class="mb-2 mt-3">
                                    <br>

                                    <input type="file" id="img_picker" name="profile_url" style="display: none;" />
                                    <input type="button" class="px-3 py-1" value="Browse"
                                        onclick="document.getElementById('img_picker').click();" />
                                </div>
                                <div>
                                    <div class="d-flex">
                                        <div class="name-email-address">
                                            <label for="username">Name</label><br />
                                            <input type="text" id="username" name="username"
                                                placeholder="Enter your name" value="<?= $_SESSION['user']['name'] ?>"
                                                required />
                                            <br />
                                        </div>
                                    </div>
                                    <label for="address" class="mt-3">Address</label><br />
                                    <textarea name="address" id="address" placeholder="Enter your address"
                                        required><?= $_SESSION['user']['address'] ?></textarea>
                                    <input class="mt-4" type="submit" name="update" value="UPDATE">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const image = document.getElementById('profile_pic');
        const imageInput = document.getElementById('img_picker');

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