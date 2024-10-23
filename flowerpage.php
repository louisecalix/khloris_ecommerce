<?php
    session_start(); 
    include 'php/config.php';

    $sqlRose = "SELECT * FROM products WHERE type_id = 1"; // roses
    $resultRose = mysqli_query($con, $sqlRose);

    $sqlSunflower = "SELECT * FROM products WHERE type_id = 2"; // sunflowers
    $resultSunflower = mysqli_query($con, $sqlSunflower);

    $sqlLily = "SELECT * FROM products WHERE type_id = 3"; // lilies
    $resultLily = mysqli_query($con, $sqlLily);

    $sqlTulip = "SELECT * FROM products WHERE type_id = 4"; // tulips
    $resultTulip = mysqli_query($con, $sqlTulip);

    if (isset($_POST['add_to_cart'])) {
        if (isset($_SESSION['ID'])) {
            $user_id = $_SESSION['ID'];
    
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_quantity = $_POST['product_quantity'];
            $product_image_url = $_POST['product_image'];
    
            $checkCart = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $result = mysqli_query($con, $checkCart);
    
            if (mysqli_num_rows($result) > 0) {
                $updateCart = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id'";
                if (!mysqli_query($con, $updateCart)) {
                    echo "Error updating cart: " . mysqli_error($con);
                }
            } else {
                $addToCart = "INSERT INTO cart (user_id, product_id, product_name, product_price, quantity, image_url, total) 
                              VALUES ('$user_id', '$product_id', '$product_name', '$product_price', 1, '$product_image_url', '$product_price')";
                if (!mysqli_query($con, $addToCart)) {
                    echo "Error adding to cart: " . mysqli_error($con);
                }
            }
    
            $success_message = "Product added to cart!";
        } else {
            header('Location: login.php');
            exit();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flowers</title>
    <link rel="stylesheet" href="ui khloris/flower.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
    <section class="product_container" id="sunflower">
    <div class="bg-sunflower"></div>
        <div class="filter-blur-sunflower"><h2 class="sunflower-header"><span>Sunflowers</span></h2></div>
      </div>
      <h3 class="sf-h3"><span>Sunflower Radiance</span> Bouquet</h3>
      <p class="sf-p">Like a sunflower turning toward the sun,<br> may this bouquet bring warmth, happiness, and a touch of nature's beauty to brighten your day.</p>
    <div class="box-container">
        <?php while($row = mysqli_fetch_assoc($resultSunflower)) { ?>
            <div class="flwrbox">
                <div class="flwrimg">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="sunflower">
                    <div class="icons">
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>">
                            <input type="hidden" name="product_quantity" value="<?php echo htmlspecialchars($row['stock']); ?>">
                            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($row['image_url']); ?>">
                            <div class="btn-div">
                                <button type="submit" name="add_to_cart" class="button">Add To Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flower-info">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <div class="flower-price">P<?php echo htmlspecialchars($row['price']); ?></div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>


<section class="product_container" id="rose">
<div class="bg-rose"></div>
        <div class="filter-blur-rose"><h2 class="rose-header"><span>Roses</span></h2></div>
      </div>
      <h3 class="r-h3"><span>Rose Elegance</span> Bouquet</h3>
      <p class="r-p">Like the timeless beauty of a rose,<br> may this bouquet bring elegance, love, and a touch of nature's grace to brighten your day.</p>
    <div class="box-container">
        <?php while($row = mysqli_fetch_assoc($resultRose)) { ?>
            <div class="flwrbox">
                <div class="flwrimg">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="rose">
                    <div class="icons">
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>">
                            <input type="hidden" name="product_quantity" value="<?php echo htmlspecialchars($row['stock']); ?>">
                            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($row['image_url']); ?>">
                            <div class="btn-div">
                                <button type="submit" name="add_to_cart" class="button">Add To Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flower-info">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <div class="flower-price">P<?php echo htmlspecialchars($row['price']); ?></div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<section class="product_container" id="lily">
    <div class="bg-lily"></div>
        <div class="filter-blur-lily"><h2 class="lily-header"><span>Lilies</span></h2></div>
      </div>
      <h3 class="ll-h3"><span>Lilies</span> Charm Bouquet</h3>
      <p class="ll-p">Like the pure beauty of a lily, may this bouquet bring<br> serenity, grace, and a touch of nature's tranquility to brighten your day.</p>
    <div class="box-container">
        <?php while($row = mysqli_fetch_assoc($resultLily)) { ?>
            <div class="flwrbox">
                <div class="flwrimg">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="lily">
                    <div class="icons">
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>">
                            <input type="hidden" name="product_quantity" value="<?php echo htmlspecialchars($row['stock']); ?>">
                            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($row['image_url']); ?>">
                            <div class="btn-div">
                                <button type="submit" name="add_to_cart" class="button">Add To Cart</button>
                            </div>
                        </form>
                    </div>
                </div>

                
                <div class="flower-info">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <div class="flower-price">P<?php echo htmlspecialchars($row['price']); ?></div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<section class="product_container" id="tulip">
<div class="bg-tulip"></div>
        <div class="filter-blur-tulip"><h2 class="tulip-header"><span>Tulips</span></h2></div>
      </div>
      <h3 class="t-h3"><span>Tulip</span> Delight Bouquet</h3>
      <p class="t-p">Like the vibrant colors of tulips, may this bouquet<br> bring joy, renewal, and a touch of spring's beauty to brighten your day.</p>
    <div class="box-container">
        <?php while($row = mysqli_fetch_assoc($resultTulip)) { ?>
            <div class="flwrbox">
                <div class="flwrimg">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="tulip">
                    <div class="icons">
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>">
                            <input type="hidden" name="product_quantity" value="<?php echo htmlspecialchars($row['stock']); ?>">
                            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($row['image_url']); ?>">
                            <div class="btn-div">
                                <button type="submit" name="add_to_cart" class="button">Add To Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flower-info">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <div class="flower-price">P<?php echo htmlspecialchars($row['price']); ?></div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
    </main>
    
    <?php include 'footer.php'; ?>
</body>
</html>
