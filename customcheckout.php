<?php
session_start();
include 'php/config.php';

// Ensure user is logged in
if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $userId = $_SESSION['ID'];
    $deliveryMethod = $_POST['deliveryMethod'];
    $address = $_POST['address'];
    $deliveryDate = $_POST['date'];
    $email = $_POST['email'];
    $phoneNum = $_POST['phone_num'];
    $orderSummary = json_decode($_POST['orderSummary'], true);

    // Validate data
    if (empty($deliveryMethod) || empty($address) || empty($deliveryDate) || empty($email) || empty($phoneNum) || empty($orderSummary)) {
        $error = "Please fill in all required fields.";
    } else {
       // Start transaction

        try {
            // Insert into 'checkout' table
            $stmt = $con->prepare("
                INSERT INTO orders (user_id, delivery_method, address, delivery_date, phone_num, total)
                VALUES (?, ?, ?, ?, ?, ?)
            ");

            $totalPrice = array_reduce($orderSummary, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            $stmt->bind_param(
                "issssd",
                $userId,
                $deliveryMethod,
                $address,
                $deliveryDate,
                $phoneNum,
                $totalPrice
            );
            $stmt->execute();
            $orderId = $con->insert_id; // Get the last inserted ID

            // Insert each order item into 'order_items' table
            $orderItemStmt = $conn->prepare("
                INSERT INTO orders( qnty)
                VALUES (  ?)
            ");

            foreach ($orderSummary as $item) {
                $orderItemStmt->bind_param(
                    "isid",
                    $orderId,
                    $item['name'],
                    $item['quantity'],
                    $item['price']
                );
                $orderItemStmt->execute();

                // Update product stock
                $updateProductStmt = $con->prepare("
                    UPDATE products SET qty = qty - ? WHERE name = ?
                ");
                $updateProductStmt->bind_param(
                    "is",
                    $item['quantity'],
                    $item['name']
                );
                $updateProductStmt->execute();
            }

            $con->commit(); // Commit transaction

            // Redirect or display success message
            header("Location: confirmation.php?order_id=" . $orderId);
            exit();
        } catch (Exception $e) {
            $con->rollback(); // Rollback transaction
            $error = "There was an error processing your order: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khloris</title>
    <link rel="stylesheet" href="customizeca.css" />
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
        <a href="#home">Home</a>s
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
      <form action = "" method="POST">
      <div class="bttn-co">
        <button type="submit" id="checkoutBtn">Checkout Now</button>
      </div>
      </form>
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
    document.addEventListener("DOMContentLoaded", function () {
        // Example predefined data for order summary
        const orderSummary = [
            { name: "Sunflower", price: 100, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1726073109/flowers/ms3vruapnyhspj8hbejv.png" },
            { name: "Red Rose", price: 100, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1723270009/flowers/lbxdapwfesoogo1tbi8s.png" },
            { name: "Blue Hydrangea", price: 150, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1725826067/flowers/h4v3aali5jdaw1qlhokj.png" },
            
            { name: "Red Anemone", price: 150, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1725826753/flowers/voikv1769whr33lkm645.png" },
            { name: "Iris", price: 70, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1725824294/flowers/j52tsqq0xfvt1z4kgzwe.png" },
            { name: "Sunflower", price: 100, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1726073109/flowers/ms3vruapnyhspj8hbejv.png" },
            { name: "Red Rose", price: 100, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1723270009/flowers/lbxdapwfesoogo1tbi8s.png" },
            { name: "Blue Hydrangea", price: 150, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1725826067/flowers/h4v3aali5jdaw1qlhokj.png" },
            
            { name: "Red Anemone", price: 150, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1725826753/flowers/voikv1769whr33lkm645.png" },
            { name: "Iris", price: 70, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1725824294/flowers/j52tsqq0xfvt1z4kgzwe.png" },

            { name: "Deep Blue Wrapper", price: 15, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1727610826/flowers/h0ztnmomgqhj5pajrv2s.png" },
            { name: "Barbie Ribbon", price: 10, quantity: 1, image: "https://res.cloudinary.com/dsfcl09md/image/upload/v1727610785/flowers/hfdlkhtyokgaurwoxexb.png" }
        ];

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
                <p>x${itemQuantity}</p>
                <p>P ${(itemPrice * itemQuantity).toFixed(2)}</p>
                <p>P ${itemTotal.toFixed(2)}</p>
            `;

            summaryContainer.appendChild(itemElement);
        });

        const totalElement = document.getElementById("totals");
        totalElement.classList.add("total-price");
        totalElement.innerHTML = `<h3>Total: P ${totalPrice.toFixed(2)}</h3>`;

        // Update the hidden input field with the JSON string of the order summary
        orderSummaryInput.value = JSON.stringify(orderSummary);
    });
</script>


  </body>
</html>
