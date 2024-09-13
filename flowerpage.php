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
    <link rel="stylesheet" href="css/flowerpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="product container" id="sunflower">
            <h1 class="flower-text">Sunflowers</h1>
            <div class="box-container">
                <?php while($row = mysqli_fetch_assoc($resultSunflower)) { ?>
                    <div class="flower-container">
                        <div class="flower-img">
                            <img src="<?php echo $row['image_url'] ?>" alt="sunflower">
                        </div>
                        <div class="icons">
                            <form action="" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                <input type="hidden" name="product_quantity" value="<?php echo $row['stock']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $row['image_url']; ?>">
                                <button type="submit" name="add_to_cart" class="cart-btn">Add To Cart</button>
                            </form>
                        </div>
                        <div class="flower-info">
                            <h3>
                                <a href="product_details.php?id=<?php echo $row['product_id']; ?>">
                                    <?php echo $row['name']; ?>
                                </a>
                            </h3>
                            <div class="flower-price">P<?php echo $row['price']; ?></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>


        </section>

        <section class="product container" id="rose">
            <h1 class="flower-text">Roses</h1>
            <div class="box-container">
                <?php while($row = mysqli_fetch_assoc($resultRose)) { ?>
                <div class="flower-container">
                    <div class="flower-img">
                        <img src="<?php echo $row['image_url'] ?>" alt="rose">
                    </div>
                    <div class="icons">
                            <form action="" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                <input type="hidden" name="product_quantity" value="<?php echo $row['stock']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $row['image_url']; ?>">
                                <button type="submit" name="add_to_cart" class="cart-btn">Add To Cart</button>
                            </form>
                    </div>
                    <div class="flower-info">
                        <h3>
                            <a href="product_details.php?id=<?php echo $row['product_id']; ?>">
                                    <?php echo $row['name']; ?>
                            </a>
                        </h3>
                        <div class="flower-price">P<?php echo $row['price'] ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>

        <section class="product container" id="lily">
            <h1 class="flower-text">Lilies</h1>
            <div class="box-container">
                <?php while($row = mysqli_fetch_assoc($resultLily)) { ?>
                <div class="flower-container">
                    <div class="flower-img">
                        <img src="<?php echo $row['image_url'] ?>" alt="lily">
                    </div>
                    <div class="icons">
                            <form action="" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                <input type="hidden" name="product_quantity" value="<?php echo $row['stock']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $row['image_url']; ?>">
                                <button type="submit" name="add_to_cart" class="cart-btn">Add To Cart</button>
                            </form> 
                    </div>
                    <div class="flower-info">
                        <h3>
                            <a href="product_details.php?id=<?php echo $row['product_id']; ?>">
                                    <?php echo $row['name']; ?>
                            </a>
                        </h3>
                        <div class="flower-price">P<?php echo $row['price'] ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>

        <section class="product container" id="tulip">
            <h1 class="flower-text">Tulips</h1>
            <div class="box-container">
                <?php while($row = mysqli_fetch_assoc($resultTulip)) { ?>
                <div class="flower-container">
                    <div class="flower-img">
                        <img src="<?php echo $row['image_url'] ?>" alt="tulip">
                    </div>
                    <div class="icons">
                            <form action="" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                <input type="hidden" name="product_quantity" value="<?php echo $row['stock']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $row['image_url']; ?>">
                                <button type="submit" name="add_to_cart" class="cart-btn">Add To Cart</button>
                            </form>                         
                            <!-- <a href="" class="cart-btn">add to cart</a> -->
                    </div>
                    <div class="flower-info">
                        <h3>
                            <a href="product_details.php?id=<?php echo $row['product_id']; ?>">
                                    <?php echo $row['name']; ?>
                            </a>
                        </h3>
                        <div class="flower-price">₱<?php echo $row['price'] ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
    </main>
    
    <?php include 'footer.php'; ?>
</body>
</html>
