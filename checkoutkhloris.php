<?php
session_start();
include 'php/config.php';

// Ensure user is logged in
if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['ID']; // Logged-in user's ID

// Ensure POST data is set and sanitize it
$delivery_method = isset($_POST['deliveryMethod']) ? $_POST['deliveryMethod'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$delivery_date = isset($_POST['date']) ? $_POST['date'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone_num = isset($_POST['phone_num']) ? $_POST['phone_num'] : '';
$order_summary = isset($_POST['orderSummary']) ? json_decode($_POST['orderSummary'], true) : []; // Decode JSON data into PHP array

// Prepare a log entry for debugging (optional)
$log_entry = "[" . date("Y-m-d H:i:s") . "] Received POST data: " . print_r($_POST, true) . "\n";
file_put_contents('checkout_log.txt', $log_entry, FILE_APPEND);

try {
    $con->begin_transaction(); // Begin transaction

    // Check if the order summary is not empty
    if (empty($order_summary)) {
        throw new Exception("Order summary is empty.");
    }

    foreach ($order_summary as $item) {
        if (empty($item['name']) || empty($item['quantity']) || empty($item['price'])) {
            throw new Exception("Invalid item data.");
        }

        $product_name = $item['name'];
        $quantity = $item['quantity'];
        $total_price = $item['price'] * $quantity;

        // Query to get product_id from product name
        $stmt = $con->prepare("SELECT product_id FROM products WHERE name = ?");
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $product = $result->fetch_assoc();
            $product_id = $product['product_id'];

            // Insert order into the database
            $stmt_order = $con->prepare("
                INSERT INTO orders (user_id, product_id, delivery_option, qnty, address, delivery_date, total)
                VALUES (?, ?, ?,?, ?, ?, ?)
            ");
            $stmt_order->bind_param("iissssd", $user_id, $product_id, $delivery_method, $quantity,$address, $delivery_date, $total_price);
            $stmt_order->execute();

            // Update product quantity in stock (qnty is the correct column name here)
            $stmt_update = $con->prepare("UPDATE products SET stock = stock - ? WHERE product_id = ?");
            $stmt_update->bind_param("ii", $quantity, $product_id);
            $stmt_update->execute();
        } else {
            throw new Exception("Product not found: $product_name");
        }
    }

    $con->commit(); // Commit transaction
    echo "Order placed successfully!";
} catch (Exception $e) {
    $con->rollback(); // Rollback transaction on error
    echo "Error processing your order: " . $e->getMessage();

    // Log the error message
    $log_error_entry = "[" . date("Y-m-d H:i:s") . "] Error: " . $e->getMessage() . "\n";
    file_put_contents('checkout_log.txt', $log_error_entry, FILE_APPEND);
}
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khloris</title>
    <link rel="stylesheet" href="newcheckout.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
  </head>
  <body>
    <!-- <header>
      <input type="checkbox" name="" id="toggler" />
      <label for="toggler" class="fas fa-bars"></label>
      <a href="#" class="logo">Khloris<span>.</span></a>
      <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#Customization">Customization</a>
        <a href="flowerpage.html">Flowers</a>
        <a href="#Occassions">Occassions</a>
      </nav>
      <div class="icons">
        <a href="" class="fas fa-shopping-cart"></a>
        <a href="logout.php" class="fa-solid fa-right-from-bracket" onclick="return confirmLogout()"></a>
      </div>
    </header> -->
    <?php include 'newheader.php'; ?>


    <section class="checkout-section">
        <div class="checkout-container">
            <h1 class="titlecheckout">Checkout</h1>
            <form id="checkout-details" action="" method="POST">
  <div class="checkout-left">
    <div class="delivery-options">
      <h2 class="header-delivery">Delivery Option</h2>
      <label class="option">
        <input type="radio" name="deliveryMethod" value="delivery" required>
        <span><i class="fa-solid fa-truck"></i> Delivery</span>
      </label>
      <label class="option">
        <input type="radio" name="deliveryMethod" value="pickup" required>
        <span><i class="fa-solid fa-box"></i> Pickup</span>
      </label>
    </div>

    <div class="delivery-address">
      <h2 class="header-address">Delivery Address</h2>
      <label>
        <input type="text" name="address" id="address" placeholder="Enter Your Address.." required>
      </label>
    </div>

    <div class="delivery-date">
      <h2 class="header-date">Delivery Date</h2>
      <label>
        <input type="date" name="date" id="date" required>
      </label>
    </div>

    <div class="contacts">
      <h2 class="header-contacts">Contacts</h2>
      <label>
        <input type="email" name="email" id="email" placeholder="Enter Your Email.." required>
      </label>
      <label>
        <input type="text" name="phone_num" id="phone-num" placeholder="Phone number.." required>
      </label>
    </div>
  </div>

  <div class="checkout-right">
    <div class="order-summary" id="order-summary">
          <input type="hidden" name="orderSummary" value='' />
      <div class="header-os">
        <h3 class="header-order-summary">Order Summary</h3>
      </div>
      <div class="orders" id="orders_">
        <!-- Add dynamic order details here -->
      </div>
      <div class="totals" id="totals"></div>
      <div class="bttn-co">
        <button type="submit" id="checkoutBtn">Checkout Now</button>
      </div>
    </div>
  </div>
</form>

                </div>
        </div>
    </section>
    
      <footer class="footer">
        <div class="ftrcontainer">
          <div class="ftrrow">
            <div class="footer-col">
              <h4 class="logofooter">Khloris<span>.</span></h4>
              <ul class="ftrul">
                <p>Follow us in Social Media!</p>
                <div class="social-links">
                  <a href="#" class="fa-brands fa-square-facebook"></a>
                  <a href="#" class="fa-brands fa-square-instagram"></a>
                </div>
              </ul>
            </div>
  
            <div class="footer-col">
              <h4>Information</h4>
              <ul class="ftrul">
                <p>Flower Shop in Pandi,Bulacan <br />Delivery only in Pandi</p>
                <li><a href="#">Privacy policy</a></li>
                <li><a href="#">Payment Instruction</a></li>
                <li><a href="#">Terms and conditions</a></li>
              </ul>
            </div>
  
            <div class="footer-col">
              <h4>Contact us</h4>
              <ul class="ftrul">
                <p><span>Address:</span>Pandi, Bulacan</p>
                <p><span>Mobile:</span>(+63) 0903-2301484/09299750331</p>
                <p><span>Telephone:</span>(632) 8881-4173</p>
                <p><span>Email:</span>admin@khlorisflowershop.com</p>
              </ul>
            </div>
  
            <div class="footer-col">
              <h4>Contact Services</h4>
              <ul class="ftrul">
                <li><a href="#">Contact us</a></li>
                <li><a href="#">My account</a></li>
                <li><a href="#">Order History</a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    

      <script>
    document.addEventListener("DOMContentLoaded", function() {
        const orderSummary = JSON.parse(localStorage.getItem("orderSummary")) || [];
        console.log(orderSummary);
        const summaryContainer = document.getElementById("orders_");
        const orderSummaryInput = document.querySelector("input[name='orderSummary']");
        
        let totalPrice = 0;

        // Clear any previous order items
        summaryContainer.innerHTML = '';  

        orderSummary.forEach(item => {
            const itemElement = document.createElement("div");
            itemElement.classList.add("order-item");

            // Ensure price and quantity are treated as numbers
            const itemPrice = parseFloat(item.price); // Convert price to number
            const itemQuantity = parseInt(item.quantity, 10); // Convert quantity to integer

            const itemTotal = itemPrice * itemQuantity; // Calculate total for each item
            totalPrice += itemTotal;

            itemElement.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="order-img">
                <p id="name-product">${item.name}</p>
                <p> x${itemQuantity}</p>
                <p> P ${(itemPrice * itemQuantity).toFixed(2)}</p>
                <p> P ${itemTotal.toFixed(2)}</p>
            `;

            summaryContainer.appendChild(itemElement);
        });

        const totalElement = document.getElementById("totals");
        totalElement.classList.add("total-price");
        totalElement.innerHTML = `<h3>Total: P ${totalPrice.toFixed(2)}</h3>`;

        // Update the hidden input field with the JSON string of the order summary
        orderSummaryInput.value = JSON.stringify(orderSummary);
    });

    // Enable checkout button based on form inputs
    function enableCheckoutButton() {
        const emailField = document.getElementById('email');
        const phoneField = document.getElementById('phone-num');
        const checkoutBtn = document.getElementById('checkoutBtn');
        const deliveryMethods = document.querySelectorAll('input[name="deliveryMethod"]:checked').length;

        if (emailField.value !== "" && phoneField.value !== "" && deliveryMethods > 0) {
            checkoutBtn.disabled = false; // Enable the button
            checkoutBtn.style.opacity = "1"; // Restore full opacity
            checkoutBtn.style.cursor = "pointer"; // Change the cursor back to pointer
        } else {
            checkoutBtn.disabled = true; // Keep it disabled if conditions are not met
            checkoutBtn.style.opacity = "0.6"; // Keep it grayed out
            checkoutBtn.style.cursor = "not-allowed"; // Keep the 'not-allowed' cursor
        }
    }

    document.getElementById('email').addEventListener('input', enableCheckoutButton);
    document.getElementById('phone-num').addEventListener('input', enableCheckoutButton);

    document.querySelectorAll('input[name="deliveryMethod"]').forEach((radio) => {
        radio.addEventListener('change', enableCheckoutButton);
    });

    document.getElementById("checkoutBtn").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent form submission for now
        alert("Order successfully placed! Thank you for shopping with us.");
        document.getElementById("checkout-details").submit();
    });
</script>

  </body>
</html>
