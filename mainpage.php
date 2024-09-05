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
  <link rel="stylesheet" href="css/homepage.css" />
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
        <div class="flwrbox">
          <div class="flwrimg">
            <img
              src="https://res.cloudinary.com/dogrgo15f/image/upload/v1724141398/images/mx6b6fqvvvhxzgs7hbsn.webp"
              alt="flower1"
            />
            <div class="icons">
              <a href="#" class="cart-btn">add to cart</a>
            </div>
          </div>
          <div class="imgcontent">
            <h3>Tullips Bouquet</h3>
            <div class="price">P 12,000</div>
          </div>
        </div>

        <div class="flwrbox">
          <div class="flwrimg">
            <img
              src="https://res.cloudinary.com/dogrgo15f/image/upload/v1724141484/images/n0su07ftcuczkhfo9ktj.webp"
              alt="flower2"
            />
            <div class="icons">
              <a href="#" class="cart-btn">add to cart</a>
            </div>
          </div>
          <div class="imgcontent">
            <h3>Tullips Bouquet</h3>
            <div class="price">P 12,000</div>
          </div>
        </div>

        <div class="flwrbox">
          <div class="flwrimg">
            <img
              src="https://res.cloudinary.com/dogrgo15f/image/upload/v1724141659/images/bteuqihfewwmxctzzhnd.webp"
              alt="flower3"
            />
            <div class="icons">
              <a href="#" class="cart-btn">add to cart</a>
            </div>
          </div>
          <div class="imgcontent">
            <h3>Rose Bouquet</h3>
            <div class="price">P 12,000</div>
          </div>
        </div>

        <div class="flwrbox">
          <div class="flwrimg">
            <img
              src="https://res.cloudinary.com/dogrgo15f/image/upload/v1724141726/images/w0t2rwnzempsx6nsgme8.webp"
              alt="flower4"
            />
            <div class="icons">
              <a href="#" class="cart-btn">add to cart</a>
            </div>
          </div>
          <div class="imgcontent">
            <h3>Rose Bouquet</h3>
            <div class="price">P 12,000</div>
          </div>
        </div>

        <div class="flwrbox">
          <div class="flwrimg">
            <img
              src="https://res.cloudinary.com/dogrgo15f/image/upload/v1724141848/images/wqiijxxltvzrogkypqh7.jpg"
              alt="flower5"
            />
            <div class="icons">
              <a href="#" class="cart-btn">add to cart</a>
            </div>
          </div>
          <div class="imgcontent">
            <h3>Sunflower Bouquet</h3>
            <div class="price">P 12,000</div>
          </div>
        </div>

        <div class="flwrbox">
          <div class="flwrimg">
            <img
              src="https://res.cloudinary.com/dogrgo15f/image/upload/v1724141993/images/prku8kdqwsi4lmcubkfu.jpg"
              alt="flower6"
            />
            <div class="icons">
              <a href="#" class="cart-btn">add to cart</a>
            </div>
          </div>
          <div class="imgcontent">
            <h3>Rose Bouquet</h3>
            <div class="price">P 12,000</div>
          </div>
        </div>
      </div>
    </section>

    <?php include 'footer.php'; ?>

  </main>


</body>
</html>
