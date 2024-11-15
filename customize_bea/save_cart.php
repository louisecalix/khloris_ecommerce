<?php
session_start();
include '../php/config.php';

if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['ID'];
    $cart_data = json_decode(file_get_contents('php://input'), true); // Get JSON data from AJAX

    // Loop through the cart data and update or insert items
    foreach ($cart_data as $item) {
        $product_id = $item['product_id'];
        $product_name = $item['product_name'];
        $product_price = $item['product_price'];
        $quantity = $item['quantity'];
        $total = $product_price * $quantity;
        $image_url = $item['image_url'];

        // Prepare to update or insert
        $sql = "INSERT INTO cart (user_id, product_id, product_name, product_price, quantity, image_url, total)
                VALUES (?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE quantity = ?, total = ?";
        
        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("issssisi", $user_id, $product_id, $product_name, $product_price, $quantity, $image_url, $total, $quantity, $total);
            $stmt->execute();
            $stmt->close();
        }
    }

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

