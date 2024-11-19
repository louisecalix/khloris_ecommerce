

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khloris</title>
    <link rel="stylesheet" href="myorder.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>
<?php include 'header.php'; ?>
    <section class="myorder-section">
        <div class="myorder-container">
        <?php
// session_start();
include 'php/config.php';

// Ensure user is logged in
if (!isset($_SESSION['ID'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$user_id = $_SESSION['ID']; // Use session ID instead of GET ID

// Debugging: Output the contents of $_GET (optional, remove in production)
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

// Prepare the SQL query with a placeholder for the user ID
$sql = "SELECT o.*, p.name AS product_name, p.image_url FROM orders o 
        JOIN products p ON o.product_id = p.product_id 
        WHERE o.user_id = ?";
// Prepare the statement
if ($stmt = $con->prepare($sql)) {
    // Bind the parameter to the prepared statement
    $stmt->bind_param("i", $user_id); // Use session ID
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();

    // Check if there are any results
    if ($result->num_rows > 0) {
        echo '<h1 class="myorder-title">My Orders</h1>';
        echo '<table>';
        echo '    <tr>';
        echo '        <th>Order ID</th>';
        echo '        <th>Image</th>';
        echo '        <th>Name</th>';
        echo '        <th>Delivery Option</th>';
        echo '        <th>Status</th>';
        echo '        <th>Total Price</th>';
        echo '        <th>Ordered At</th>';
        echo '        <th>Delivery Date</th>';
        echo '        <th>Action</th>';
        echo '    </tr>';

        // Fetch and display each row from the result
        while ($row = $result->fetch_assoc()) {
            // Assuming you want to get product details, join the product name here
            echo '<tr>';
            echo '    <td>' . $row["order_id"] . '</td>';
         
            echo '    <td>' . $row["image_url"] . '</td>';
            echo '    <td>' . $row["product_name"] . '</td>';  
            echo '    <td>' . $row["delivery_option"] . '</td>';
            echo '    <td>' . $row["order_status"] . '</td>';
            echo '    <td>' . $row["total"] . '</td>';
            echo '    <td>' . $row["created_at"] . '</td>';
            echo '    <td>' . $row["delivery_date"] . '</td>';
            echo '    <td><form method="POST" action="cancel_order.php"><input type="hidden" name="order_id" value="' . $row["order_id"] . '"><button type="submit" class="cancel-btn">Cancel</button></form></td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "No orders found for this user.";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "Error: Could not prepare the SQL statement.";
}

// Close the database connection
$con->close();
?>
        </div>
    </section>
</body>
</html>
