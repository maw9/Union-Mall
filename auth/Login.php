<?php
require_once("../style/Head.php");
require_once("../database/TableNames.php");
require_once("../database/Connect.php");

$is_email_error_visible = false;
$is_password_error_visible = false;

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $get_user_by_email = "SELECT * FROM $user_table WHERE email=:email";

    try {
        $stmt = $pdo->prepare($get_user_by_email);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($user)) {
            $is_email_error_visible = true;
        } else {
            if ($user['password'] != $password) {
                $is_password_error_visible = true;
            } else {
                $is_email_error_visible = false;
                $is_password_error_visible = false;
                saveUserSession($user);
                header('Location: ../user/');
            }
        }
    } catch (PDOException $pde) {
        echo $pde->getMessage();
    }
}

function saveUserSession($user)
{
    session_start();
    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'address' => $user['address'],
        'password' => $user['password'],
        'is_admin' => $user['is_admin'],
        'profile_url' => $user['profile_url']
    ];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/login.css">
</head>

<body>
    <h1>Union Mall</h1>
    <div class="login-container">
        <form method="post">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required />
            <br />

            <label for="password" class="mt-3">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required />
            <br />
            <br />
            <input type="submit" name="login" value="LOGIN">
        </form>
        <br />
        <span>Don't have an account?</span>
        <a href="Register.php">Create one</a>
    </div>
    <div class="alert alert-danger email-error-alert" role="alert" style="display: <?= $is_email_error_visible ? "visible" : "none" ?>;">
        E-mail is not registered!
    </div>
    <div class="alert alert-danger password-error-alert" role="alert" style="display: <?= $is_password_error_visible ? "visible" : "none" ?>;">
        Password is incorrect!
    </div>
</body>

</html>