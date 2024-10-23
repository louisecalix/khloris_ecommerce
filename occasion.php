<?php

// session_start();
include 'php/config.php';


// if(isset($_SESSION['ID'])){
//   $user_id = $_SESSION['ID'];
// }else{
//   $user_id = '';

// }


session_start();

include '../php/config.php';

if (!isset($_SESSION['ID'])) {
    header("Location: occasion.php");
    exit();
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['ID'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $image_url = $_POST['image_url'];

    $total = $product_price * $quantity;

    // SQL query: Insert into cart, or if there's a duplicate entry, update the quantity.
    $sql = "INSERT INTO cart(user_id, product_id, product_name, product_price, quantity, image_url, total) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE quantity = quantity + ?";

    // Prepare the statement
    if ($stmt = $con->prepare($sql)) {
        
        // Bind parameters including the one for the `ON DUPLICATE KEY UPDATE` clause
        $stmt->bind_param("isssisis", $user_id, $product_id, $product_name, $product_price, $quantity, $image_url, $total, $quantity);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: occasion.php");
            exit();
            
        } else {
            echo "Error! Could not add to cart: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }
}

$con->close();














?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khloris</title>
    <link rel="stylesheet" href="ui khloris/floweroccasion.css" />
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
                            echo'     <form action="" method="POST">';       
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
              echo'     <form action="" method="POST">';       
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
echo'     <form action="" method="POST">';       
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
    

    <?php include 'footer.php'; ?>

    <script>
        function confirmLogout() {
          return confirm("Are you sure you want to log out?");
          }

         


    </script>

  </body>
</html>