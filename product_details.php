<?php
    session_start();
    include('php/config.php');

    $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found.";
        exit;
    }
    

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
                $addToCart = "INSERT INTO cart (user_id, product_id, product_name, product_price, quantity, image_url) 
                              VALUES ('$user_id', '$product_id', '$product_name', '$product_price', 1, '$product_image_url')";
                if (!mysqli_query($con, $addToCart)) {
                    echo "Error adding to cart: " . mysqli_error($con);
                }
            }
    
            $success_message = "Product added to cart!";
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?> - Product Details</title>
    <link rel="stylesheet" href="css/homepage.css"> 
    <link rel="stylesheet" href="css/product_details.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
    <?php include 'header.php'; ?>

    <section class="product-details container" style="margin-top: 100px;">
        <h1><?php echo $product['name']; ?></h1>
        <div class="product-img">
            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
        </div>
        <div class="product-info">
            <p>Price: P<?php echo $product['price']; ?></p>
            <p>Description: <?php echo $product['description']; ?></p>
            <p> Quantity: <?php echo $product['quantity']; ?> </p>
        </div>
        <form action="" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
            <input type="hidden" name="product_quantity" value="<?php echo $row['quantity']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $row['image_url']; ?>">
            <button type="submit" name="add_to_cart" class="cart-btn">Adddd To Cart</button>
        </form>
    </section>
</body>
</html>
