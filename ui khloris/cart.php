<?php

session_start();
include('../php/config.php');

if(!isset($_SESSION['ID'])){
    header('Location: login.php');
    exit();
}


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khloris</title>
    <link rel="stylesheet" href="cart.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
  </head>
  <body>
    <!-- <header> -->
      <!-- <input type="checkbox" name="" id="toggler" />
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
    <?php include '../header.php'; ?>

    <section class="cart-section">
        <div class="cart-container">
            <h3>My <span>Cart</span></h3>
            <?php 

$sql = "SELECT * FROM cart";
$result = $con -> query($sql);

if ($result -> num_rows > 0) {
    while ($row = $result -> fetch_assoc()) {
      
        
        echo '<div class="cart-orders-item" data-name="' . $row['product_name'] . '" data-price="' . $row['product_price'] . '" data-image="' . $row['image_url'] . '" data-id="' . $row['product_id'] . '">';
        echo '    <input type="checkbox" class="item-checkbox" id="item' . $row['product_id'] . '" data-price="' . $row['product_price'] . '" />';
        echo '    <img src="' . $row['image_url'] . '" alt="' . $row['product_name'] . '" />';
        echo '    <label for="item' . $row['product_id'] . '">' . $row['product_name'] . '</label>';
        echo '    <div class="quantity-controls">';
        echo '        <button class="minus-btn">-</button>';
        echo '        <input type="number" class="quantity" value="' . $row['quantity'] . '" min="1" />';
        echo '        <button class="plus-btn">+</button>';
        echo '    </div>';
        echo '    <div class="price-container">';
        echo '        <span class="original-price">P ' . number_format($row['product_price'], 2) . '</span>';
        echo '        <span class="updated-price">P ' . number_format($row['product_price'] * $row['quantity'], 2) . '</span>'; // Update total price
        echo '    </div>';
        echo '    <span class="remove-btn" data-product-id="' . $row['product_id'] . '">';
        echo '        <i class="fa-solid fa-trash-can"></i>';
        echo '    </span>';
        echo '</div>';
    }
} else {
    echo "No items in the cart.";
}
?>

        <div class="total-container">
          <span class="total">Total: <span id="total">P 0.00</span></span>
          <p>Note: Shipping is currently available only within Pandi,Bulacan area. We are working to expand our delivery services soon.</p>
          <button class="checkout-btn" id="checkoutBtn">Checkout</button>
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
        function confirmLogout() {
          return confirm("Are you sure you want to log out?");
          }
    </script>
    <script>
      const checkboxes = document.querySelectorAll(".item-checkbox");
      const totalElement = document.getElementById("total");
      const quantityInputs = document.querySelectorAll(".quantity");
      const minusButtons = document.querySelectorAll(".minus-btn");
      const plusButtons = document.querySelectorAll(".plus-btn");
      const removeButtons = document.querySelectorAll(".remove-btn");
      const updatedPrices = document.querySelectorAll(".updated-price");

      function updateTotal() {
        let total = 0;
        checkboxes.forEach((checkbox, index) => {
          if (checkbox.checked) {
            const price = parseFloat(checkbox.getAttribute("data-price"));
            const quantity = parseInt(quantityInputs[index].value);
            total += price * quantity;
          }
        });
        totalElement.textContent = `P${total.toFixed(2)}`;
      }

      function updateItemPrice(index) {
        const price = parseFloat(checkboxes[index].getAttribute("data-price"));
        const quantity = parseInt(quantityInputs[index].value);
        const updatedPrice = price * quantity;
        updatedPrices[index].textContent = `P${updatedPrice.toFixed(2)}`;
      }

      
      checkboxes.forEach((checkbox, index) => {
        checkbox.addEventListener("change", updateTotal);
      });

      quantityInputs.forEach((input, index) => {
        input.addEventListener("input", () => {
          updateItemPrice(index);
          updateTotal();
        });
      });


      minusButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
          const quantityInput = quantityInputs[index];
          if (quantityInput.value > 1) {
            quantityInput.value--;
            updateItemPrice(index);
            updateTotal();
          }
        });
      });

      plusButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
          const quantityInput = quantityInputs[index];
          quantityInput.value++;
          updateItemPrice(index);
          updateTotal();
        });
      });

      
      window.addEventListener("load", updateTotal); // Ensure total is calculated at page load

      document.getElementById("checkoutBtn").addEventListener("click", function() {
  const cartItems = document.querySelectorAll(".cart-orders-item");
  let orderSummary = [];

  cartItems.forEach(item => {
    if (item.querySelector(".item-checkbox").checked) {
      const name = item.getAttribute("data-name");  // Get product name
      const price = item.getAttribute("data-price"); // Get product price
      const image = item.getAttribute("data-image"); // Get product image URL
      const quantity = item.querySelector(".quantity").value;
      orderSummary.push({ name, price, image, quantity });
    }
  });

  // Store the order data in local storage to pass to the checkout page
  localStorage.setItem("orderSummary", JSON.stringify(orderSummary));
  window.location.href = "checkout.html"; // Redirect to checkout page
});

  </script>
 <script>
    // Function to save cart to the server
function saveCart() {
    $.ajax({
        url: 'customize_bea/save_cart.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(Object.values(cart)), // Send cart data as JSON
        success: function(response) {
            console.log('Cart saved:', response);
        },
        error: function(xhr, status, error) {
            console.error('Error saving cart:', error);
        }
    });
}

// Function to add/update item in the cart
function updateItem(productId, productName, productPrice, quantity, imageUrl) {
    if (quantity <= 0) {
        delete cart[productId]; // Remove item if quantity is 0
    } else {
        cart[productId] = { 
            product_id: productId, 
            product_name: productName, 
            product_price: productPrice, 
            quantity: quantity, 
            image_url: imageUrl 
        };
    }
    saveCart(); // Automatically save the cart
}

// Example of handling quantity change
$(document).ready(function() {
    // Update quantity and total when changed
    $('.quantity').change(function() {
        const productId = $(this).closest('.cart-orders-item').data('id'); // Assuming data-id is set in the item div
        const productName = $(this).closest('.cart-orders-item').data('name');
        const productPrice = $(this).closest('.cart-orders-item').data('price');
        const quantity = parseInt($(this).val());
        const imageUrl = $(this).closest('.cart-orders-item').data('image');
        
        updateItem(productId, productName, productPrice, quantity, imageUrl);
    });

    // Example of removing an item
    $('.remove-btn').click(function() {
        const productId = $(this).data('product-id'); // Get product ID
        updateItem(productId, '', 0, 0, ''); // Set quantity to 0 to remove
    });
});

 </script>



  </body>
</html>
