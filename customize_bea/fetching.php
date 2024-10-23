<?php
$servername = "localhost";
$username = "beicoleene";
$password = "030419061313bei";
$dbname = "flowershop";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
header('Access-Control-Allow-Origin: *'); // Allow all origins
header('Content-Type: application/json');


$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
  
    echo json_encode($products);
} else {
    echo json_encode([]);
}


$conn->close();

