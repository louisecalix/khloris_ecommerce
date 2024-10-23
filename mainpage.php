<?php 

include 'php/config.php';

session_start();

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
  <link rel="stylesheet" href="ui khloris/home.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
  />
</head>
<body>

  <?php include 'header.php'; ?>


  <main>
    <section class="home" id="home">
      <div class="content">
        <img
          class="logoimg"
          src="https://res.cloudinary.com/dogrgo15f/image/upload/v1724128500/images/kk90fhhfsltwy7eqgtfg.png"
          alt="logochloris"
        />
        <h3><span>Khloris</span> Flower Shop</h3>
        <p>
          Creating memories with every each petals. Try our <br />long lasting
          flowers for every occasion <br />anywhere and anytime.
        </p>
        <a href="#" class="btnshopnow">Shop now</a>
      </div>
    </section>

    <section class="prdctsrecommend" id="prdctsrecommend">
      <h1 class="recommend">recommended <span>for you</span></h1>
      <div class="box-container">
      <?php

$sql= "SELECT * FROM products WHERE type_id = 5";

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

$con ->close();

?>

      </section>

    <?php include 'footer.php'; ?>

  </main>


</body>
</html>