<?php
require_once('../style/Head.php');
require_once('../database/Connect.php');
require_once('../database/TableNames.php');

session_start();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    unset($_SESSION['cart']);
    header('Location: Index.php');
}

if (isset($_GET['login'])) {
    header('Location: ../auth/Login.php');
}

if (isset($_GET['edit'])) {
    header('Location: EditProfile.php');
}

if (isset($_GET['home'])) {
    header('Location: Index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../style/profile.css">
</head>

<body>
    <form method="get">
        <div class="profile-nav">
            <button id="back-to-home" name="home" class="btn btn-outline-light">HOME</button>
            <button id="logout" name="logout" class="btn btn-outline-danger" style="display: <?= isset($_SESSION['user']) ? "block" : "none" ?>">Logout</button>
            <h1>Profile</h1>
        </div>
        <div class="main">
            <div class="profile-container">
                <img src="<?= isset($user['profile_url']) ? "../" . $user['profile_url'] : "../images/avatar.png" ?>">
                <?php if (isset($user)) : ?>
                    <div class="user-info">
                        <label>Name</label>
                        </br>
                        <span><?= $user['name'] ?></span>
                        </br>
                        </br>
                        <label>Email</label>
                        </br>
                        <span><?= $user['email'] ?></span>
                        </br>
                        </br>
                        <label>Address</label>
                        </br>
                        <span><?= $user['address'] ?></span>
                        </br>
                        </br>
                        </br>
                        <button name="edit"><i class="fa-solid fa-pen me-3"></i>EDIT PROFILE</button>
                    </div>
                <?php endif; ?>

                <?php if (!isset($user)) : ?>
                    <div class="guest-info">
                        <h2>You are currently using as a guest. </h2>
                        <br>
                        <h3>Register an account for<br>better features & experiences.</h3>
                        </br>
                        <button name="login"><i class="fa-solid fa-pen me-3"></i>LOGIN</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </form>
</body>

</html>