

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
// Ensure the session is active




if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['ID'];

// Check if a cancel request has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']); // Sanitize input

    $cancel_sql = "DELETE FROM orders WHERE product_id = ? AND user_id = ?";
    if ($cancel_stmt = $con->prepare($cancel_sql)) {
        $cancel_stmt->bind_param("ii", $product_id, $user_id);
        if ($cancel_stmt->execute()) {
            echo "<p> </p>";
        } else {
            echo "<p class='error'>Failed to cancel the order. Please try again.</p>";
        }
        $cancel_stmt->close();
    } else {
        echo "<p class='error'>Error preparing cancel statement.</p>";
    }
}

// Fetch orders for the logged-in user
$sql = "SELECT o.*, p.name AS product_name, p.image_url, p.product_id 
        FROM orders o 
        JOIN products p ON o.product_id = p.product_id 
        WHERE o.user_id = ?";

if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display orders
    if ($result->num_rows > 0) {
        echo '<h1><span>Order</span> Information</h1>';
        echo '<hr class="custom-hr">';
        echo '<div class="choices"><ul class="header-list"><li>All Orders</li></ul></div>';
        echo '<hr class="custom-hr">';
        echo '<table>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td><img src="' . htmlspecialchars($row["image_url"]) . '" alt="Product Image" style="width: 100px; height: auto;"></td>';
            echo '<td>' . htmlspecialchars($row["product_name"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["total"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["created_at"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["delivery_date"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["order_status"]) . '</td>';
            echo '<td>
                    <form method="POST" action="">
                        <input type="hidden" name="product_id" value="' . intval($row["product_id"]) . '">
                        <button type="submit" class="cancel-btn">Cancel</button>
                    </form>
                  </td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "<p>No orders found for this user.</p>";
    }

    $stmt->close();
} else {
    echo "<p>Error preparing SQL statement.</p>";
}

// Close the database connection
$con->close();
?>

        </div>
    </section>
</body>
</html>
