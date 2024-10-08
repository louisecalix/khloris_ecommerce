<?php
session_start();
include '../php/config.php';

if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['ID'];
    $product_id = $_POST['product_id'];
    // $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $image_url = $_POST['image_url'];
    $total = $product_price * $quantity;


    $sql = "INSERT INTO cart (user_id, product_id, product_price, quantity, image_url, total) 
    VALUES (?, ?, ?, ?, ?, ?) 
    ON DUPLICATE KEY UPDATE 
        quantity = quantity + VALUES(quantity), 
        total = product_price * quantity";

    

    // Check if the statement was prepared correctly
    if ($stmt = $con->prepare($sql)) {
        // Debugging output
        echo "Preparing statement successful.<br>";

     
        if ($stmt->bind_param("iidsds", $user_id, $product_id, $product_price, $quantity, $image_url, $total)) {
            // Debugging output
            echo "Parameters bound successfully.<br>";}
        
        
        if ($stmt->execute()) {
            header("Location: mainpage.php");
            exit();
        } else {
            echo "Preparing statement successful.<br>";
            echo "Error executing statement: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }
}

// Close the database connection
$con->close();

