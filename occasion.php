<<<<<<< HEAD
<?php

session_start();
include '../php/config.php';





?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khloris</title>
    <link rel="stylesheet" href="ui khloris/occasion.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

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

    <section class="prdctsoccassion" id="prdctsoccassion">
      <div class="bg-imagebirthday"></div>
        <div class="filter-blur-bday"><h2 class="bday-header">Happy Birthday <span>Flowers</span></h2></div>
      </div>
      <h3 class="bday-h3">A <span>Flower</span> Gift For A Birthday Celebrant</h3>
      <p class="bday-p">May your birthday be as beautiful and bright as a garden in full bloom, filled with the <br> fragrance of love, the colors of joy, and the warmth of friendship. Happy Birthday!</p>
      <div class="box-container">
      <?php

        $sql= "SELECT * FROM products WHERE type_id=5";

        $result= $con -> query($sql);

        if ($result -> num_rows > 0){

            while ($row = $result -> fetch_assoc()) {

        echo '<div class="flwrbox">';
        echo'   <div class="flwrimg">';
        echo '      <img src="'. $row["image_url"].'" alt="'.$row["name"].'"/>';
        echo '      <div class="icons">';
              echo'     <form action="customize_bea/add_to_cart.php" method="POST">';       
              echo '    <input type="hidden" name="product_id" value="' . $row["product_id"] . '">';         
              // echo '    <input type="hidden" name="product_name" value="' . $row["name"] . '">';   
              echo '    <input type="hidden" name="product_price" value="' . $row["price"] . '">'; 
              echo '    <input type="hidden" name="quantity" value="' . $row["stock"] . '">';  
              echo '    <input type="hidden" name="image_url" value="' . $row["image_url"] . '">';       
              echo '    <button type="submit" class="btn">Add to cart</button>';
              echo '</form>';               
        echo'       </div>';
        echo '  </div>';
        echo'   <div class="imgcontent">';
        echo'      <h3>'. $row["name"] .'</h3>';
        echo'        <div class="price">P'. $row["price"] . '</div>';
        echo'    </div>';
        echo' </div>';


            }
        }else {
            echo "No products found";

        }


        // $con->close();

        // ?>

       
    </section>

    <!-- anniv -->
    <section class="prdctsoccassion-anniv" id="prdctsoccassion-anniv">
      <div class="bg-image-anniv"></div>
        <div class="filter-blur-anniv"><h2 class="anniv-header">Anniversary <span>Flowers</span></h2></div>
      </div>
      <h3 class="anniv-h3">The Perfect <span>Flower</span> Bouquet for Anniversary</h3>
      <p class="anniv-p">May the blossoms of your love continue to flourish, filling your lives with beauty, joy, and <br> cherished memories. Wishing you a wonderful anniversary filled with blooming <br>happines.</p>
      <div class="box-container">
      <?php

$sql= "SELECT name, price, image_url FROM products WHERE type_id=6";

$result= $con -> query($sql);

if ($result -> num_rows > 0){

    while ($row = $result -> fetch_assoc()) {
    



echo '<div class="flwrbox">';
echo'   <div class="flwrimg">';
echo '      <img src="'. $row["image_url"].'" alt="'.$row["name"].'"/>';
echo '      <div class="icons">';
echo'           <a href="#" class="cart-btn">add to cart</a>';
echo'       </div>';
echo '  </div>';
echo'   <div class="imgcontent">';
echo'      <h3>'. $row["name"] .'</h3>';
echo'        <div class="price">P'. $row["price"] . '</div>';
echo'    </div>';
echo' </div>';


    }
}else {
    echo "No products found";

}


// $con->close();

// ?>

    </section>

    <!-- funeral -->

    <section class="prdctsoccassion-funeral" id="prdctsoccassion-funeral">
      <div class="bg-image-funeral"></div>
        <div class="filter-blur-funeral"><h2 class="funeral-header">Funeral <span>Flowers</span></h2></div>
      </div>
      <h3 class="funeral-h3">Send Sympathy <span>Flower</span></h3>
      <p class="funeral-p">May these flowers bring solace to you in this time of sorrow. Though words can hardly <br> ease your pain, may their beauty remind you of the love and cherished memories that will <br>always remain in your heart.</p>
      <div class="box-container">
      <?php

$sql= "SELECT name, price, image_url FROM products WHERE type_id=7";

$result= $con -> query($sql);

if ($result -> num_rows > 0){

    while ($row = $result -> fetch_assoc()) {
    



echo '<div class="flwrbox">';
echo'   <div class="flwrimg">';
echo '      <img src="'. $row["image_url"].'" alt="'.$row["name"].'"/>';
echo '      <div class="icons">';
echo'           <a href="#" class="cart-btn">add to cart</a>';
echo'       </div>';
echo '  </div>';
echo'   <div class="imgcontent">';
echo'      <h3>'. $row["name"] .'</h3>';
echo'        <div class="price">P'. $row["price"] . '</div>';
echo'    </div>';
echo' </div>';


    }
}else {
    echo "No products found";

}


$con->close();

?>


    </section>

    <!-- footer -->
    

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
              <li><a href="#">Payment Instruction</a</li>
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

  </body>
=======
<?php

session_start();
include 'php/config.php';


if(isset($_SESSION['ID'])){
  $user_id = $_SESSION['ID'];
}else{
  $user_id = '';
}




?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khloris</title>
    <link rel="stylesheet" href="ui khloris/occasion.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      />
      <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

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

    <section class="prdctsoccassion" id="prdctsoccassion">
      <div class="bg-imagebirthday"></div>
        <div class="filter-blur-bday"><h2 class="bday-header">Happy Birthday <span>Flowers</span></h2></div>
      </div>
      <h3 class="bday-h3">A <span>Flower</span> Gift For A Birthday Celebrant</h3>
      <p class="bday-p">May your birthday be as beautiful and bright as a garden in full bloom, filled with the <br> fragrance of love, the colors of joy, and the warmth of friendship. Happy Birthday!</p>
      <div class="box-container">
      <?php

        $sql= "SELECT * FROM products WHERE type_id=5";

        $result= $con -> query($sql);

        if ($result -> num_rows > 0){

            while ($row = $result -> fetch_assoc()) {

        echo '<div class="flwrbox">';
        echo'   <div class="flwrimg">';
        echo '      <img src="'. $row["image_url"].'" alt="'.$row["name"].'"/>';
        echo '      <div class="icons">';
              echo'     <form action="customize_bea/add_to_cart.php" method="POST">';       
              echo '    <input type="hidden" name="product_id" value="' . $row["product_id"] . '">';         
              echo '    <input type="hidden" name="product_name" value="' . $row["name"] . '">';   
              echo '    <input type="hidden" name="product_price" value="' . $row["price"] . '">'; 
              echo '    <input type="hidden" name="quantity" value="1">';  
              echo '    <input type="hidden" name="image_url" value="' . $row["image_url"] . '">';       
              echo '    <div class="btn-div"><button type="submit" class="button">Add to cart</button></div>';
              echo '</form>';               
        echo'       </div>';
        echo '  </div>';
        echo'   <div class="imgcontent">';
        echo'      <h3>'. $row["name"] .'</h3>';
        echo'        <div class="price">P'. $row["price"] . '</div>';
        echo'    </div>';
        echo' </div>';


            }
        }else {
            echo "No products found";

        }


        // $con->close();

        // ?>

       
    </section>

    <!-- anniv -->
    <section class="prdctsoccassion-anniv" id="prdctsoccassion-anniv">
      <div class="bg-image-anniv"></div>
        <div class="filter-blur-anniv"><h2 class="anniv-header">Anniversary <span>Flowers</span></h2></div>
      </div>
      <h3 class="anniv-h3">The Perfect <span>Flower</span> Bouquet for Anniversary</h3>
      <p class="anniv-p">May the blossoms of your love continue to flourish, filling your lives with beauty, joy, and <br> cherished memories. Wishing you a wonderful anniversary filled with blooming <br>happines.</p>
      <div class="box-container">
      <?php

$sql= "SELECT * FROM products WHERE type_id=6";

$result= $con -> query($sql);

if ($result -> num_rows > 0){

    while ($row = $result -> fetch_assoc()) {
    



echo '<div class="flwrbox">';
echo'   <div class="flwrimg">';
echo '      <img src="'. $row["image_url"].'" alt="'.$row["name"].'"/>';
echo '      <div class="icons">';
              echo'     <form action="customize_bea/add_to_cart.php" method="POST">';       
              echo '    <input type="hidden" name="product_id" value="' . $row["product_id"] . '">';         
              echo '    <input type="hidden" name="product_name" value="' . $row["name"] . '">';   
              echo '    <input type="hidden" name="product_price" value="' . $row["price"] . '">'; 
              echo '    <input type="hidden" name="quantity" value="1">';  
              echo '    <input type="hidden" name="image_url" value="' . $row["image_url"] . '">';       
              echo '    <div class="btn-div"><button type="submit" class="button">Add to cart</button></div>';
              echo '</form>';   
echo'       </div>';
echo '  </div>';
echo'   <div class="imgcontent">';
echo'      <h3>'. $row["name"] .'</h3>';
echo'        <div class="price">P'. $row["price"] . '</div>';
echo'    </div>';
echo' </div>';


    }
}else {
    echo "No products found";

}


// $con->close();

// ?>

    </section>

    <!-- funeral -->

    <section class="prdctsoccassion-funeral" id="prdctsoccassion-funeral">
      <div class="bg-image-funeral"></div>
        <div class="filter-blur-funeral"><h2 class="funeral-header">Funeral <span>Flowers</span></h2></div>
      </div>
      <h3 class="funeral-h3">Send Sympathy <span>Flower</span></h3>
      <p class="funeral-p">May these flowers bring solace to you in this time of sorrow. Though words can hardly <br> ease your pain, may their beauty remind you of the love and cherished memories that will <br>always remain in your heart.</p>
      <div class="box-container">
      <?php

$sql= "SELECT * FROM products WHERE type_id=7";

$result= $con -> query($sql);

if ($result -> num_rows > 0){

    while ($row = $result -> fetch_assoc()) {
    



echo '<div class="flwrbox">';
echo'   <div class="flwrimg">';
echo '      <img src="'. $row["image_url"].'" alt="'.$row["name"].'"/>';
echo '      <div class="icons">';
echo'     <form action="customize_bea/add_to_cart.php" method="POST">';       
echo '    <input type="hidden" name="product_id" value="' . $row["product_id"] . '">';         
echo '    <input type="hidden" name="product_name" value="' . $row["name"] . '">';   
echo '    <input type="hidden" name="product_price" value="' . $row["price"] . '">'; 
echo '    <input type="hidden" name="quantity" value="1">';  
echo '    <input type="hidden" name="image_url" value="' . $row["image_url"] . '">';       
echo '   <div class="btn-div"><button type="submit" class="button">Add to cart</button></div>';
echo '</form>';  
echo'       </div>';
echo '  </div>';
echo'   <div class="imgcontent">';
echo'      <h3>'. $row["name"] .'</h3>';
echo'        <div class="price">P'. $row["price"] . '</div>';
echo'    </div>';
echo' </div>';


    }
}else {
    echo "No products found";

}


$con->close();

?>


    </section>

    <!-- footer -->
    

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
              <li><a href="#">Payment Instruction</a</li>
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

  </body>
>>>>>>> 57fdffd (button in occassion is done yey)
</html>