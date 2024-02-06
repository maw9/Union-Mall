<?php
require_once("../style/Head.php");
require_once('Nav.php');
require_once("../database/TableNames.php");
require_once("../database/Connect.php");

if (isset($_POST['send-message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $insert_feedback_query = "INSERT INTO $feedback_table (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    try {
        $pdo->exec($insert_feedback_query);
        header("Location: Index.php");
    } catch (PDOException $pde) {
        echo $pde->get_message();
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../style/contact_us.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <h1 class="title">Contact Us</h1>
                <div class="container-fluid mt-5">
                    <div class="row contact-form">
                        <div class="col-7 p-5">
                            <form method="post">
                                <h3>Get in touch</h3>
                                <div class="mb-3 mt-4">
                                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="message" placeholder="Message" rows="5" required></textarea>
                                </div>
                                <button name="send-message" class="btn btn-dark">Send Message</button>
                            </form>
                        </div>
                        <div class="col-5 contact-us  p-5 bg-dark">
                            <div class="contact-info">
                                <div class="logo">
                                    <img src="../icons/unity_mall_logo.png" alt="logo" />
                                    <h1>Unity Mall</h1>
                                </div>
                                <div class="address">
                                    <img src="../icons/location.png" alt="location" />
                                    <p>52 Street, NewYork City, Rose Town, 07 River House</p>
                                </div>
                                <div class="telephone">
                                    <img src="../icons/phone.png" alt="phone" />
                                    <p>+145 475 7890</p>
                                </div>
                                <div class="mail">
                                    <img src="../icons/mail.png" alt="mail" />
                                    <p>kaungmawaung@gmail.com</p>
                                </div>
                                <div class="social-media-section">
                                    <div class="facebook">
                                        <img src="../icons/facebook-app-symbol.png" alt="" />
                                    </div>
                                    <div class="twitter">
                                        <img src="../icons/twitter.png" alt="" />
                                    </div>
                                    <div class="youtube mt-1">
                                        <img src="../icons/youtube.png" alt="" />
                                    </div>
                                    <div class="instagram">
                                        <img src="../icons/instagram.png" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
</html>