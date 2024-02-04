<?php
require_once("../style/Head.php");
require_once("../database/TableNames.php");
require_once("../database/Connect.php");
require_once("../utils/RegisterSuccessDialog.php");

session_start();

function moveChosenImage()
{
    if (isset($_FILES['profile_url']) && $_FILES['profile_url']['size'] > 0) {
        $fileName = $_FILES['profile_url']['name'];
        $isMoved = move_uploaded_file($_FILES['profile_url']['tmp_name'], "../images/" . $fileName);
        return $isMoved ? $fileName : "";
    }
}

if (isset($_POST["update"])) {
    $user_id = $_SESSION['user']['id'];
    $username = $_POST["username"];
    $address = $_POST["address"];
    $profile_url = "images/" . moveChosenImage();

    $update_user_query = "UPDATE $user_table SET name='$username', address='$address', profile_url='$profile_url' WHERE id='$user_id'";

    try {
        $pdo->exec($update_user_query);
        $_SESSION['user']['name'] = $username;
        $_SESSION['user']['address'] = $address;
        $_SESSION['user']['profile_url'] = $profile_url;
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
    <title>Register</title>
    <link rel="stylesheet" href="../style/register.css">
</head>

<body>
    <h1 class="mall-name">Edit Profile</h1>
    <div class="d-flex justify-content-center">
        <div class=" register-container">
            <form method="post" enctype="multipart/form-data">
                <div class="d-flex">
                    <div class="profile">
                        <img id="profile_pic" src="<?= empty($_SESSION['user']['profile_url']) ? "../images/avatar.png" : "../" . $_SESSION['user']['profile_url'] ?>" class="mb-2 mt-3">
                        <br>

                        <input type="file" id="img_picker" name="profile_url" style="display: none;" />
                        <input type="button" class="px-3 py-1" value="Browse" onclick="document.getElementById('img_picker').click();" />
                    </div>
                    <div>
                        <div class="d-flex">
                            <div class="name-email-address">
                                <label for="username">Name</label><br />
                                <input type="text" id="username" name="username" placeholder="Enter your name" value="<?= $_SESSION['user']['name'] ?>" required />
                                <br />
                            </div>
                        </div>
                        <label for="address" class="mt-3">Address</label><br />
                        <textarea name="address" id="address" placeholder="Enter your address" required><?= $_SESSION['user']['address'] ?></textarea>
                        <input class="mt-4" type="submit" name="update" value="UPDATE">
                    </div>
                </div>
            </form>
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