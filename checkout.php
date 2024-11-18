<?php
session_start(); // Start session at the beginning
include 'php/config.php'; // Include the config file for database connection

// Logging function - Move it to the top
function writeLog($message) {
    $logFile = 'logs.txt';
    $currentTime = date("Y-m-d H:i:s");
    if (is_writable($logFile)) {
        file_put_contents($logFile, "[$currentTime] $message\n", FILE_APPEND);
    } else {
        echo "Cannot write to log file. Please check file permissions.";
    }
}

// Check if the user is logged in
if (isset($_SESSION['ID'])) {
    $user_id = $_SESSION['ID']; // Get user ID from session
} else {
    die("User is not logged in."); // Stop execution if the user is not logged in
}

// Logging test to ensure log file is writable
$file = 'logs.txt';
if (file_put_contents($file, "Test log entry\n", FILE_APPEND)) {
    writeLog("Log written successfully!");
} else {
    writeLog("Failed to write to log.");
}

// Log received POST data
writeLog("Received POST data: " . print_r($_POST, true));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $address = $_POST['address']; // Get address from form
    $phoneNum = $_POST['phone_num']; // Get phone number from form
    $deliveryOption = $_POST['deliveryMethod']; // Get delivery option from form
    $deliveryDate = $_POST['date']; // Get delivery date from form
    $orderSummary = json_decode($_POST['orderSummary'], true); // Parse JSON order summary

    // Validate the parsed JSON data
    if (!$orderSummary || !is_array($orderSummary)) {
        writeLog("Order summary is empty or invalid JSON.");
        die("Order summary is invalid.");
    }

    $connection = $con; // Database connection

    // Check database connection
    if ($connection->connect_error) {
        writeLog("Connection failed: " . $connection->connect_error);
        die("Database connection failed: " . $connection->connect_error);
    }

    try {
        mysqli_begin_transaction($connection); // Start transaction
        writeLog("Transaction started.");

        foreach ($orderSummary as $item) {
            // Ensure product_id, quantity, and price exist in each order item
            if (!isset($item['product_id'], $item['quantity'], $item['price'])) {
                throw new Exception("Invalid order item structure.");
            }

            $productId = $item['product_id']; // Product ID
            $quantity = $item['quantity']; // Quantity
            $totalPrice = $item['price'] * $quantity; // Calculate total price for the item

            // Log order details before inserting
            writeLog("Inserting order for user ID: $user_id, product ID: $productId, quantity: $quantity, total price: $totalPrice");

            // Insert order details into the orders table
            $query = "INSERT INTO orders (user_id, product_id, address, phone_num, delivery_option, qnty, total, delivery_date) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($connection, $query);

            if (!$stmt) {
                writeLog("Failed to prepare insert query: " . mysqli_error($connection));
                throw new Exception("Failed to prepare insert query.");
            }

            mysqli_stmt_bind_param($stmt, 'iisssids', $user_id, $productId, $address, $phoneNum, $deliveryOption, $quantity, $totalPrice, $deliveryDate);

            if (!mysqli_stmt_execute($stmt)) {
                writeLog("Error executing insert query: " . mysqli_stmt_error($stmt));
                throw new Exception("Error inserting order data.");
            }

            writeLog("Order inserted for product ID $productId.");

            // Update product quantity in the products table
            $updateQuery = "UPDATE products SET qnty = qnty - ? WHERE id = ?";
            $updateStmt = mysqli_prepare($connection, $updateQuery);

            if (!$updateStmt) {
                writeLog("Failed to prepare update query: " . mysqli_error($connection));
                throw new Exception("Failed to prepare update query.");
            }

            mysqli_stmt_bind_param($updateStmt, 'ii', $quantity, $productId);

            if (!mysqli_stmt_execute($updateStmt)) {
                writeLog("Error executing update query: " . mysqli_stmt_error($updateStmt));
                throw new Exception("Error updating product quantity.");
            }

            writeLog("Product quantity updated for product ID $productId.");
        }

        mysqli_commit($connection); // Commit transaction
        writeLog("Transaction committed successfully.");

        // Redirect with success message
        echo "<script>
                alert('Order successfully placed');
                window.location.href = 'thank_you.php';
              </script>";
    } catch (Exception $e) {
        mysqli_rollback($connection); // Rollback transaction
        writeLog("Transaction rolled back. Error: " . $e->getMessage());
        echo "Error placing order. Please try again later.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khloris</title>
    <link rel="stylesheet" href="checkout_.css" />
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
    <?php include 'header.php'; ?>


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
