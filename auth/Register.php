<?php
require_once("../style/Head.php");
require_once("../database/TableNames.php");
require_once("../database/Connect.php");
require_once("../utils/RegisterSuccessDialog.php");

$is_email_error_visible = false;
$is_password_length_error_visible = false;
$is_passwords_match_error_visible = false;

function moveChosenImage()
{
    if (isset($_FILES['profile_url']) && $_FILES['profile_url']['size'] > 0) {
        $fileName = $_FILES['profile_url']['name'];
        $isMoved = move_uploaded_file($_FILES['profile_url']['tmp_name'], "../images/" . $fileName);
        return $isMoved ? $fileName : "";
    }
}

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $is_admin = 0;
    $profile_url = "images/" . moveChosenImage();

    if (checkEmailExist($pdo, $email, $user_table)) {
        $is_email_error_visible = true;
    } else if (strlen($password) < 8) {
        $is_password_length_error_visible = true;
    } else if ($password != $confirm_password) {
        $is_passwords_match_error_visible = true;
    } else {
        $save_user_query = "INSERT INTO $user_table (name, email, address, password, is_admin, profile_url) VALUES (:name, :email, :address, :password, :is_admin, :profile_url)";

        try {
            $stmt = $pdo->prepare($save_user_query);
            $stmt->bindParam(':name', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':password', $password);
            $stmt->bindValue(':is_admin', $is_admin);
            $stmt->bindParam(':profile_url', $profile_url);
            $stmt->execute();

            echo "<script>document.getElementById('success_register').click()</script>";
        } catch (PDOException $pde) {
            echo ($pde->getMessage());
        }
    }
}

function checkEmailExist($pdo, $email, $user_table)
{
    $get_user_by_email = "SELECT * FROM $user_table WHERE email=:email";

    try {
        $stmt = $pdo->prepare($get_user_by_email);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return !empty($user);
    } catch (PDOException $pde) {
        echo $pde->getMessage();
    }
    return false;
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
    <h1 class="mall-name">Union Mall</h1>
    <div class="d-flex justify-content-center">
        <div class=" register-container">
            <form method="post" enctype="multipart/form-data">
                <div class="d-flex">
                    <div class="profile">
                        <img id="profile_pic" class="mb-2 mt-3">
                        <br>

                        <input type="file" id="img_picker" name="profile_url" style="display: none;" />
                        <input type="button" class="px-3 py-1" value="Browse" onclick="document.getElementById('img_picker').click();" />
                    </div>
                    <div>
                        <div class="d-flex">
                            <div class="name-email-address">
                                <label for="username">Name</label><br />
                                <input type="text" id="username" name="username" placeholder="Enter your name" required />
                                <br />

                                <label for="email" class="mt-3">E-mail</label><br />
                                <input type="email" id="email" name="email" placeholder="Enter your email" required />
                                <br />
                            </div>
                            <div class="passwords ms-5">
                                <label for="password">Password</label><br />
                                <input type="password" id="password" name="password" placeholder="Enter your password" required />
                                <br />

                                <label for="confirm-password" class="mt-3">Confirm Password</label><br />
                                <input type="password" id="confirm-password" name="confirm_password" placeholder="Enter the same password" required />
                                <br />
                            </div>
                        </div>
                        <label for="address" class="mt-3">Address</label><br />
                        <textarea name="address" id="address" placeholder="Enter your address" required></textarea>
                        <input class="mt-4" type="submit" name="register" value="REGISTER">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="alert alert-danger email-error-alert" role="alert" style="display: <?= $is_email_error_visible ? "visible" : "none" ?>;">
        E-mail is already registered!
    </div>
    <div class="alert alert-danger password-error-alert" role="alert" style="display: <?= $is_password_length_error_visible ? "visible" : "none" ?>;">
        Password must be length 8 and above!
    </div>
    <div class="alert alert-danger password-error-alert" role="alert" style="display: <?= $is_passwords_match_error_visible ? "visible" : "none" ?>;">
        Passwords do not match!
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