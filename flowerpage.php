<?php
    include 'php/config.php';

    $sqlRose = "SELECT * FROM products WHERE type_id = 1"; // roses
    $resultRose = mysqli_query($con, $sqlRose);

    $sqlSunflower = "SELECT * FROM products WHERE type_id = 2"; // sunflowers
    $resultSunflower = mysqli_query($con, $sqlSunflower);

    $sqlLily = "SELECT * FROM products WHERE type_id = 3"; // lilies
    $resultLily = mysqli_query($con, $sqlLily);

    $sqlTulip = "SELECT * FROM products WHERE type_id = 4"; // tulips
    $resultTulip = mysqli_query($con, $sqlTulip);
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
                        <a href="" class="cart-btn">add to cart</a>
                    </div>
                    <div class="flower-info">
                        <h3><?php echo $row['name'] ?></h3>
                        <div class="flower-price">P<?php echo $row['price'] ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
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
                        <a href="" class="cart-btn">add to cart</a>
                    </div>
                    <div class="flower-info">
                        <h3><?php echo $row['name'] ?></h3>
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
                        <a href="" class="cart-btn">add to cart</a>
                    </div>
                    <div class="flower-info">
                        <h3><?php echo $row['name'] ?></h3>
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
                        <a href="" class="cart-btn">add to cart</a>
                    </div>
                    <div class="flower-info">
                        <h3><?php echo $row['name'] ?></h3>
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
