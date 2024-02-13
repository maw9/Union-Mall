<?php
include_once("Connect.php");
include_once("TableNames.php");

$create_product_table = "CREATE TABLE IF NOT EXISTS $product_table(
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    size_id INT,
    name VARCHAR (100) UNIQUE,
    price FLOAT,
    quantity INT,
    description TEXT,
    image_url VARCHAR (100) UNIQUE,
    FOREIGN KEY (category_id) REFERENCES $category_table(id),
    FOREIGN KEY (size_id) REFERENCES $size_table(id)
);";

$create_category_table = "CREATE TABLE IF NOT EXISTS $category_table(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (30) UNIQUE
);";

$create_size_table = "CREATE TABLE IF NOT EXISTS $size_table(
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    name VARCHAR (30) UNIQUE,
    FOREIGN KEY (category_id) REFERENCES $category_table(id)
);";

$create_tag_table = "CREATE TABLE IF NOT EXISTS $tag_table(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (50) UNIQUE
);";

$create_product_tag_table = "CREATE TABLE IF NOT EXISTS $product_tag_table(
    product_id INT,
    tag_id INT,
    FOREIGN KEY (product_id) REFERENCES $product_table(id),
    FOREIGN KEY (tag_id) REFERENCES $tag_table(id)
);";

$create_user_table = "CREATE TABLE IF NOT EXISTS $user_table(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (60),
    email VARCHAR(100) UNIQUE,
    address TEXT,
    password VARCHAR(100),
    is_admin BOOLEAN,
    profile_url VARCHAR(100)
);";

$create_order_table = "CREATE TABLE IF NOT EXISTS sale_order (
    id INT PRIMARY KEY AUTO_INCREMENT,
    created_at DATE,
    user_id INT,
    total_amount FLOAT,
    status VARCHAR(20),
    FOREIGN KEY (user_id) REFERENCES $user_table(id)
);";

$create_order_product_table = "CREATE TABLE IF NOT EXISTS $order_product_table(
    order_id INT,
    product_id INT,
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES $order_table(id),
    FOREIGN KEY (product_id) REFERENCES $product_table(id)
);";

$create_delivery_table = "CREATE TABLE IF NOT EXISTS $delivery_table(
    id INT PRIMARY KEY AUTO_INCREMENT,
    date_to_deliver DATE,
    address TEXT,
    order_id INT,
    FOREIGN KEY (order_id) REFERENCES $order_table(id)
);";

$create_payment_table = "CREATE TABLE IF NOT EXISTS $payment_table(
    id INT PRIMARY KEY AUTO_INCREMENT,
    card_holder VARCHAR (60),
    card_number VARCHAR (12),
    exp_month VARCHAR (2),
    exp_year VARCHAR (2),
    cvv VARCHAR (3),
    order_id INT,
    FOREIGN KEY (order_id) REFERENCES $order_table(id)
);";

$create_feedback_table = "CREATE TABLE IF NOT EXISTS $feedback_table(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (60),
    email VARCHAR (60),
    subject VARCHAR (100),
    message TEXT
);";



try {
    $pdo->exec($create_category_table);
    echo "Category table has been created!" . "<br>";

    $pdo->exec($create_size_table);
    echo "Size table has been created!" . "<br>";

    $pdo->exec($create_product_table);
    echo "Product table has been created!" . "<br>";

    $pdo->exec($create_tag_table);
    echo "Tag table has been created!" . "<br>";

    $pdo->exec($create_product_tag_table);
    echo "Product Tag Join table has been created!" . "<br>";

    $pdo->exec($create_user_table);
    echo "User table has been created!" . "<br>";

    $pdo->exec($create_order_table);
    echo "Order table has been created!" . "<br>";

    $pdo->exec($create_order_product_table);
    echo "Order Product Join table has been created!" . "<br>";

    $pdo->exec($create_delivery_table);
    echo "Delivery table has been created!" . "<br>";

    $pdo->exec($create_payment_table);
    echo "Payment table has been created!" . "<br>";

    $pdo->exec($create_feedback_table);
    echo "Feedback table has been created!" . "<br>";
} catch (PDOException $pde) {
    echo $pde->getMessage();
}