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
    echo "Product Tag Join table has been created!"  . "<br>";

    $pdo->exec($create_user_table);
    echo "User table has been created!";
} catch (PDOException $pde) {
    echo $pde->getMessage();
}
