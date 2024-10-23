<<<<<<< HEAD
<?php
    session_start();
    include('../php/config.php');

    if (isset($_GET['order_id'])) {
        $id = $_GET['order_id'];

        $check_sql = "SELECT status FROM orders_user WHERE order_id='$id'";
        $check_result = mysqli_query($con, $check_sql);
        $order = mysqli_fetch_assoc($check_result);

        if ($order && $order['status'] === 'Pending') {
            $delete_sql = "DELETE FROM orders_user WHERE order_id='$id'";
            $data = mysqli_query($con, $delete_sql);

            if ($data) {
                header("Location: order.php");
                exit(); 
            } else {
                echo "Error: Cant cancel the order.";
            }
        }
    }


    $sql = "SELECT * FROM orders_user";
    $result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
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
        <h1>Order Information</h1>

        <table>
            <tr>
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
                <td><?php echo $row['order_id']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['qty']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <?php if ($row['status'] === 'Pending') { ?>
                        <a href="order.php?order_id=<?php echo $row['order_id']; ?>" class="delete-btn"
                           onclick="return confirm('Are you sure you want to cancel this order?')">Cancel</a>
                    <?php } else { ?>
                        Done
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>
</body>
</html>
=======
<?php
    session_start();
    include('../php/config.php');

    if (isset($_GET['order_id'])) {
        $id = $_GET['order_id'];

        $check_sql = "SELECT status FROM orders_user WHERE order_id='$id'";
        $check_result = mysqli_query($con, $check_sql);
        $order = mysqli_fetch_assoc($check_result);

        if ($order && $order['status'] === 'Pending') {
            $delete_sql = "DELETE FROM orders_user WHERE order_id='$id'";
            $data = mysqli_query($con, $delete_sql);

            if ($data) {
                header("Location: order.php");
                exit(); 
            } else {
                echo "Error: Cant cancel the order.";
            }
        }
    }


    $sql = "SELECT * FROM orders_user";
    $result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
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
        </nav>
        <div class="icons">
            <a href="admin_logout.php" class="fa-solid fa-right-from-bracket" onclick="return confirmLogout()"></a>
        </div>
    </header>

    <div class="order-info">
        <h1>Order Information</h1>

        <table>
            <tr>
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
                <td><?php echo $row['order_id']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['qty']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <?php if ($row['status'] === 'Pending') { ?>
                        <a href="order.php?order_id=<?php echo $row['order_id']; ?>" class="delete-btn"
                           onclick="return confirm('Are you sure you want to cancel this order?')">Cancel</a>
                    <?php } else { ?>
                        Done
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>
</body>
</html>
>>>>>>> bc007b6 (ede)
