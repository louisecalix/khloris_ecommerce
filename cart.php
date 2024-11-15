<?php
session_start();
include('php/config.php');

if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['quantity'];

    if (is_numeric($new_quantity) && $new_quantity > 0) {
        $price_query = "SELECT price FROM products WHERE product_id=?";
        $stmt = mysqli_prepare($con, $price_query);
        mysqli_stmt_bind_param($stmt, 'i', $product_id);
        mysqli_stmt_execute($stmt);
        $product_result = mysqli_stmt_get_result($stmt);

        if ($product_result && mysqli_num_rows($product_result) > 0) {
            $row = mysqli_fetch_assoc($product_result);
            $product_price = $row['price'];

            $new_total = $new_quantity * $product_price;

            $update_cart_sql = "UPDATE cart SET quantity=?, total=? WHERE product_id=? AND user_id=?";
            $update_stmt = mysqli_prepare($con, $update_cart_sql);
            mysqli_stmt_bind_param($update_stmt, 'idii', $new_quantity, $new_total, $product_id, $_SESSION['ID']);
            
            if (!mysqli_stmt_execute($update_stmt)) {
                echo "Error updating cart: " . mysqli_stmt_error($update_stmt);
            }
            mysqli_stmt_close($update_stmt);
        } else {
            echo "Product not found.";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Invalid quantity.";
    }
    header("Location: cart.php");
    exit();
}





if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $delete_sql = "DELETE FROM cart WHERE product_id=? AND user_id=?";
    $delete_stmt = mysqli_prepare($con, $delete_sql);
    mysqli_stmt_bind_param($delete_stmt, 'ii', $product_id, $_SESSION['ID']);
    
    if (!mysqli_stmt_execute($delete_stmt)) {
        echo "Error deleting item: " . mysqli_stmt_error($delete_stmt);
    }
    mysqli_stmt_close($delete_stmt);
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['ID'];
$sql = "SELECT c.*, p.name AS product_name, p.price AS product_price, p.image_url 
        FROM cart c 
        JOIN products p ON c.product_id = p.product_id 
        WHERE c.user_id=?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Error fetching cart items: " . mysqli_error($con));
}

$total_cost = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="info" style="margin-top: 80px;">
        <h1>My Cart</h1>
        <form action="checkout.php" method="POST" id="checkoutForm">
            <table>
                <tr>
                    <th>Select</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>

                <?php 
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_total = $row['product_price'] * $row['quantity'];
                        $total_cost += $item_total;
                ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_items[]" value="<?php echo htmlspecialchars($row['product_id']); ?>">
                            <input type="hidden" name="quantities[<?php echo htmlspecialchars($row['product_id']); ?>]" value="<?php echo htmlspecialchars($row['quantity']); ?>">
                        </td>
                        <td>
                            <img height="200" width="200" src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Product Image">
                        </td>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td>₱<?php echo number_format($row['product_price'], 2); ?></td>
                        <td>
                            <form action="cart.php" method="POST" class="update-form">
                                <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" min="1">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">
                                <input type="hidden" name="update_quantity" value="1">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>₱<?php echo number_format($item_total, 2); ?></td>
                        <td>
                            <a href="cart.php?product_id=<?php echo htmlspecialchars($row['product_id']); ?>" 
                               onclick="return confirm('Are you sure you want to remove this item?');">Remove</a>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7'>Your cart is empty.</td></tr>";
                }
                ?>
            </table>

            <div class="total-cost">
                <h2>Total Cost: ₱<?php echo number_format($total_cost, 2); ?></h2>
                <input type="submit" value="Proceed to Checkout" name="proceedcheckout" id="checkoutButton">
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>

    <script>
    document.getElementById('checkoutButton').addEventListener('click', function(e) {
        var checkboxes = document.querySelectorAll('input[name="selected_items[]"]:checked');
        if (checkboxes.length === 0) {
            e.preventDefault();
            alert('Please select at least one item to proceed to checkout.');
        }
    });
    </script>
</body>
</html>