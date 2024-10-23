<?php
    session_start();
    include('../php/config.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $con->prepare($sql);

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if (!$product) {
            echo "Product not found!";
            exit();
        }
    }

    if (isset($_POST['update_product'])) {
        $title = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $image_url = $_POST['image_url'];

        $update_sql = "UPDATE products SET name=?, description=?, price=?, stock=?, image_url=? WHERE product_id=?";
        $stmt = $con->prepare($update_sql);

        $stmt->bind_param("ssdisi", $title, $description, $price, $quantity, $image_url, $id);

        if ($stmt->execute()) {
            header("Location: view_products.php");
            exit();
        } else {
            echo "Error updating product: " . $stmt->error;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="add_products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
    <header>
        <input type="checkbox" name="" id="toggler" />
        <label for="toggler" class="fas fa-bars"></label>
        <a href="../admin/admin_dashboard.php" class="logo">Khloris<span>.</span></a>
        <nav class="navbar">
            <a href="../admin/admin_dashboard.php">Home</a>
            <a href="../admin/add_products.php">Add Products</a>
            <a href="../admin/view_products.php">View Products</a>
            <a href="../admin/order.php">Orders</a>
            <a href="../admin/total_users.php">Users</a>
        </nav>
        <div class="icons">
            <a href="admin_logout.php" class="fa-solid fa-right-from-bracket" onclick="return confirmLogout()"></a>
        </div>
    </header>

    <div class="add_productscontainer">
        <div class="product-box">
            <form action="update_product.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                <h2>Update Product</h2>
                <input type="text" name="name" value="<?php echo $product['name']; ?>" placeholder="Product Name" required><br>
                <textarea name="description" placeholder="Description"><?php echo $product['description']; ?></textarea><br>
                <input type="number" name="price" value="<?php echo $product['price']; ?>" step="0.01" placeholder="Price" required><br>
                <input type="number" name="quantity" value="<?php echo $product['stock']; ?>" placeholder="Quantity" required><br>
                <input type="text" name="image_url" value="<?php echo $product['image_url']; ?>" placeholder="Image URL"><br>
                
                <button type="submit" name="update_product">Update Product</button>
            </form>
        </div>
    </div>

</body>
</html>
