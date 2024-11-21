<?php
    session_start();
    include('../php/config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['order_status'])) {
        $order_id = intval($_POST['order_id']);
        $order_status = mysqli_real_escape_string($con, $_POST['order_status']); 

        $update_sql = "UPDATE orders SET order_status = '$order_status' WHERE order_id = $order_id";
        if (!mysqli_query($con, $update_sql)) {
            echo "Error updating order: " . mysqli_error($con);
        } else {
            header("Location: order.php"); 
            exit();
        }
    }

    // $sql = "SELECT * FROM orders";
    // $result = mysqli_query($con, $sql);

    $sql = "SELECT o.order_id, o.user_id, o.product_id, o.qnty, o.total, o.order_status, p.image_url, p.name 
    FROM orders o
    JOIN products p ON o.product_id = p.product_id";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Error fetching orders: " . mysqli_error($con));
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="order.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <header>
        <input type="checkbox" name="" id="toggler" />
        <label for="toggler" class="fas fa-bars"></label>
        <a href="../admin/admin_dashboard.php" class="logo">Khloris<span>.</span></a>
        <nav class="navbar">
            <a href="../admin/admin_dashboard.php">Home</a>
            <a href="../admin/add_products.php">Add Products</a>
            <a href="../admin/view_products.php">View Products</a>
            <a href="../admin/order.php">Orders</a>
            <a href="../admin/total_users.php">Users</a>
        </nav>
        <div class="icons">
            <a href="admin_logout.php" class="fa-solid fa-right-from-bracket" onclick="return confirmLogout()"></a>
        </div>
    </header>

    <div class="order-info">
        <h1><span>Order</span> Information</h1>

        <table>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>
                    <img src="<?php echo $row['image_url']; ?>" alt="Product Image" style="width: 100px; height: auto;">
                </td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['order_id']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['qnty']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['order_status']; ?></td>
                <td>
                    <form method="POST" action="order.php">
                        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                        <select name="order_status" onchange="this.form.submit()">
                            <option value="Pending" <?php echo $row['order_status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Received" <?php echo $row['order_status'] === 'Received' ? 'selected' : ''; ?>>Received</option>
                            <option value="Processing" <?php echo $row['order_status'] === 'Processing' ? 'selected' : ''; ?>>Processing</option>
                            <option value="Ready" <?php echo $row['order_status'] === 'Ready' ? 'selected' : ''; ?>>Ready</option>
                        </select>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <script>
    function confirmLogout() {
        return confirm("Are you sure you want to log out?");
    }
    </script>
</body>
</html>
