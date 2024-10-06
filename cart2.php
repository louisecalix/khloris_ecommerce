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
        $price_query = "SELECT price, stock FROM products WHERE product_id='$product_id'";
        $product_result = mysqli_query($con, $price_query);

        if ($product_result && mysqli_num_rows($product_result) > 0) {
            $row = mysqli_fetch_assoc($product_result);
            $product_price = $row['price'];
            $available_stock = $row['stock'];
            
            if ($new_quantity <= $available_stock) {
                $new_total = $new_quantity * $product_price;
                
                $update_sql = "UPDATE cart SET quantity='$new_quantity', total='$new_total' WHERE product_id='$product_id' AND user_id='{$_SESSION['ID']}'";
                if (mysqli_query($con, $update_sql)) {
                } else {
                    echo "Error updating cart: " . mysqli_error($con);
                }
            } else {
                echo "Quantity exceeds the available stock.";
            }
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Invalid quantity.";
    }
    header("Location: cart.php");
    exit();
}



if (isset($_GET['product_id'])) {
    $id = $_GET['product_id'];
    $delete_sql = "DELETE FROM cart WHERE product_id='$id' AND user_id='{$_SESSION['ID']}'";
    if (mysqli_query($con, $delete_sql)) {
    } else {
        echo "Error deleting item: " . mysqli_error($con);
    }
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['ID'];
$sql = "SELECT * FROM cart WHERE user_id='$user_id'";
$result = mysqli_query($con, $sql);

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
        <table>
            <tr>
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
                        <img height="200" width="200" src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Product Image">
                    </td>
                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                    <td>P<?php echo number_format($row['product_price'], 2); ?></td>
                    <td>
                        <form action="" method="POST">
                            <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" min="1">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">
                            <button type="submit" name="update_quantity">Update</button>
                        </form>
                    </td>
                    <td>P<?php echo number_format($item_total, 2); ?></td>
                    <td>
                        <a href="cart.php?product_id=<?php echo htmlspecialchars($row['product_id']); ?>" 
                        onclick="return confirm('Are you sure you want to remove this item?');">Remove</a>
                    </td>
                </tr>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>Your cart is empty.</td></tr>";
                }
            ?>
        </table>

        <div class="total-cost">
            <h2>Total Cost: ₱<?php echo number_format($total_cost, 2); ?></h2>
            <form>
                <input type="submit" value="Checkout">
            </form>
        </div>
        
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>


<!-- ------------------------------------CHECKOUT------------------------------------- -->

<?php
session_start();
include('php/config.php');

// Ensure user is logged in
if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['ID'];
    $total_cost = $_POST['total_cost'];

    // Begin transaction
    mysqli_begin_transaction($con);

    try {
        // Fetch cart items
        $cart_query = "SELECT product_id, quantity FROM cart WHERE user_id='$user_id'";
        $cart_result = mysqli_query($con, $cart_query);

        if ($cart_result && mysqli_num_rows($cart_result) > 0) {
            while ($row = mysqli_fetch_assoc($cart_result)) {
                $product_id = $row['product_id'];
                $quantity = $row['quantity'];

                // Fetch product stock
                $product_query = "SELECT stock FROM products WHERE product_id='$product_id'";
                $product_result = mysqli_query($con, $product_query);

                if ($product_result && mysqli_num_rows($product_result) > 0) {
                    $product_row = mysqli_fetch_assoc($product_result);
                    $available_stock = $product_row['stock'];

                    if ($quantity <= $available_stock) {
                        // Deduct stock
                        $update_stock_sql = "UPDATE products SET stock=stock-'$quantity' WHERE product_id='$product_id'";
                        mysqli_query($con, $update_stock_sql);

                        // Record the order (you may need to implement your own order table)
                        // Example:
                        // $order_sql = "INSERT INTO orders (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
                        // mysqli_query($con, $order_sql);
                    } else {
                        throw new Exception("Insufficient stock for product ID $product_id");
                    }
                } else {
                    throw new Exception("Product not found for ID $product_id");
                }
            }

            // Empty the cart
            $empty_cart_sql = "DELETE FROM cart WHERE user_id='$user_id'";
            mysqli_query($con, $empty_cart_sql);

            // Commit transaction
            mysqli_commit($con);

            header('Location: order_confirmation.php'); // Redirect to order confirmation page
            exit();
        } else {
            throw new Exception("No items in the cart.");
        }
    } catch (Exception $e) {
        mysqli_rollback($con);
        echo "Error processing order: " . $e->getMessage();
    }
} else {
    // Redirect to cart page if the form is not submitted
    header('Location: cart.php');
    exit();
}
?>


<!-- HTML form for checkout -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <form action="" method="POST">
        <!-- Include any additional information needed for checkout, like shipping details -->
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
