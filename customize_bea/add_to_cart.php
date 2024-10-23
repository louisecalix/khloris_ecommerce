<?php

session_start();

include '../php/config.php';

if (!isset($_SESSION['ID'])) {
    header("Location: https://www.google.com");
    exit();
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['ID'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $image_url = $_POST['image_url'];

    $total = $product_price * $quantity;

    // SQL query: Insert into cart, or if there's a duplicate entry, update the quantity.
    $sql = "INSERT INTO cart(user_id, product_id, product_name, product_price, quantity, image_url, total) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE quantity = quantity + ?";

    // Prepare the statement
    if ($stmt = $con->prepare($sql)) {
        
        // Bind parameters including the one for the `ON DUPLICATE KEY UPDATE` clause
        $stmt->bind_param("isssisis", $user_id, $product_id, $product_name, $product_price, $quantity, $image_url, $total, $quantity);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: https://www.google.com");
            exit();
            
        } else {
            echo "Error! Could not add to cart: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }
}

$con->close();









