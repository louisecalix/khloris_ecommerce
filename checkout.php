<?php
session_start();
include('php/config.php');

if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_POST['proceedcheckout']) && !isset($_POST['place_order'])) {
    header('Location: cart.php');
    exit();
}

$user_id = $_SESSION['ID'];

if (isset($_POST['place_order'])) {
    $selected_items = $_POST['selected_items'] ?? [];
    $quantities = $_POST['quantities'] ?? [];
    $address = $_POST['address'] ?? '';
    $phone_num = $_POST['phone_num'] ?? '';
    $delivery_option = $_POST['delivery_option'] ?? '';

    if (empty($selected_items)) {
        echo "Error: No items selected for checkout.";
        exit();
    }

    $order_successful = true;

    foreach ($selected_items as $product_id) {
        $quantity = $quantities[$product_id] ?? 0;

        if ($quantity > 0) {
            $insert_order_sql = "INSERT INTO orders (user_id, product_id, address, phone_num, delivery_option, qnty, total, order_status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')";

            if ($stmt = mysqli_prepare($con, $insert_order_sql)) {
                $price_query = "SELECT price FROM products WHERE product_id=?";
                if ($price_stmt = mysqli_prepare($con, $price_query)) {
                    mysqli_stmt_bind_param($price_stmt, 'i', $product_id);
                    mysqli_stmt_execute($price_stmt);
                    mysqli_stmt_bind_result($price_stmt, $product_price);
                    mysqli_stmt_fetch($price_stmt);
                    mysqli_stmt_close($price_stmt);

                    $total_price = $product_price * $quantity;

                    mysqli_stmt_bind_param($stmt, 'siissid', $user_id, $product_id, $address, $phone_num, $delivery_option, $quantity, $total_price);
                    
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error processing order for product ID $product_id: " . mysqli_stmt_error($stmt);
                        $order_successful = false;
                    } else {
                        $delete_cart_sql = "DELETE FROM cart WHERE product_id=? AND user_id=?";
                        if ($delete_stmt = mysqli_prepare($con, $delete_cart_sql)) {
                            mysqli_stmt_bind_param($delete_stmt, 'ii', $product_id, $user_id);
                            mysqli_stmt_execute($delete_stmt);
                            mysqli_stmt_close($delete_stmt);
                        }
                    }
                }
                mysqli_stmt_close($stmt);
            }
        }
    }

    if ($order_successful) {
        echo json_encode(['success' => true, 'message' => 'Order placed successfully']);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'There was an error processing your order. Please try again.']);
        exit();
    }
}

$selected_items = $_POST['selected_items'] ?? [];
$quantities = $_POST['quantities'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            border-radius: 5px;
        }
        .modal-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Checkout</h1>
    <form id="checkoutForm">
        <label for="delivery_option">Delivery Option:</label>
        <select id="delivery_option" name="delivery_option" required>
            <option value="delivery">Delivery</option>
            <option value="pickup">Pickup</option>
        </select>
        <br><br>

        <label for="address">Delivery Address:</label>
        <input type="text" id="address" name="address" required>
        <br><br>

        <label for="phone_num">Phone Number:</label>
        <input type="text" id="phone_num" name="phone_num" required>
        <br><br>

        <h2>Order Summary</h2>
        <?php
        $total_cost = 0;
        foreach ($selected_items as $product_id) {
            $quantity = $quantities[$product_id];
            $product_query = "SELECT name, price FROM products WHERE product_id = ?";
            if ($stmt = mysqli_prepare($con, $product_query)) {
                mysqli_stmt_bind_param($stmt, 'i', $product_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $product = mysqli_fetch_assoc($result);
                $item_total = $product['price'] * $quantity;
                $total_cost += $item_total;
                echo "<p>{$product['name']} - Quantity: $quantity - Price: ₱" . number_format($item_total, 2) . "</p>";
                echo "<input type='hidden' name='selected_items[]' value='$product_id'>";
                echo "<input type='hidden' name='quantities[$product_id]' value='$quantity'>";
                mysqli_stmt_close($stmt);
            }
        }
        echo "<h3>Total Cost: ₱" . number_format($total_cost, 2) . "</h3>";
        ?>

        <button type="button" id="placeOrderBtn">Place Order</button>
    </form>

    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <h3>Confirm Order</h3>
            <p>Please review and confirm your order:</p>
            <ul>
                <?php
                foreach ($selected_items as $product_id) {
                    $quantity = $quantities[$product_id];
                    echo "<li>Product ID $product_id - Quantity: $quantity</li>";
                }
                ?>
            </ul>
            <p>Total: ₱<?php echo number_format($total_cost, 2); ?></p>
            <div class="modal-footer">
                <button id="cancelBtn">Cancel</button>
                <button id="confirmOrderBtn">Confirm</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var modal = $("#confirmModal");
            var placeOrderBtn = $("#placeOrderBtn");
            var cancelBtn = $("#cancelBtn");
            var confirmOrderBtn = $("#confirmOrderBtn");

            // Show modal on "Place Order" click
            placeOrderBtn.click(function() {
                modal.css("display", "block");
            });

            // Hide modal on "Cancel" click
            cancelBtn.click(function() {
                modal.css("display", "none");
            });

            // Submit form on "Confirm" click
            confirmOrderBtn.click(function() {
                $.ajax({
                    url: 'checkout.php',
                    type: 'POST',
                    data: $('#checkoutForm').serialize() + '&place_order=1',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.href = 'mainpage.php';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
                modal.css("display", "none");
            });
        });
    </script>
</body>
</html>