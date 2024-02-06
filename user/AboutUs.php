<?php
session_start();
require_once("../style/Head.php");
require_once('Nav.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../style/about_us.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <img id="hero-img" src="../images/shopping-mall.jpg">
                <h1 id="about-title">ABOUT UNION MALL</h1>
                <p id="about-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius harum error reiciendis facilis commodi veritatis debitis sed alias soluta quaerat, ullam repellat possimus tempora a vitae animi. Delectus, asperiores molestiae. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius harum error reiciendis facilis commodi veritatis debitis sed alias soluta quaerat, ullam repellat possimus tempora a vitae animi. Delectus, asperiores molestiae.</p>
            </div>
            <div class="col-2"></div>            
        </div>
        <div class="row">
            <div class="status">
                <div class="attribute">
                    <div>
                        <div class="attr-value">2010</div>
                        <div class="attr-label">YEAR FOUNDED</div>
                    </div>
                </div>
                <div class="attribute">
                    <div>
                        <div class="attr-value">82</div>
                        <div class="attr-label">COLLECTIONS</div>
                    </div>
                </div>
                <div class="attribute">
                    <div>
                        <div class="attr-value">50K</div>
                        <div class="attr-label">HAPPY CUSTOMERS</div>
                    </div>
                </div>
                <div class="attribute">
                    <div>
                        <div class="attr-value">248</div>
                        <div class="attr-label">PRODUCTS</div>
                    </div>
                </div>
                <div class="attribute">
                    <div>
                        <div class="attr-value">35</div>
                        <div class="attr-label">TEAM MEMBERS</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>