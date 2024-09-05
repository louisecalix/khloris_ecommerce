<?php
include('../php/config.php');

$username = 'admin'; 
$password = 'admin123'; 

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $con->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    echo "Admin user '{$username}' inserted successfully.";
} else {
    echo "Error inserting user: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
