<?php
    session_start();
    include('../php/config.php');

    $category_filter = "";
    if (isset($_GET['category'])) {
        $category_id = intval($_GET['category']); 
        $category_filter = "WHERE p.category_id = $category_id";
    }

    $sql = "SELECT p.*, c.name AS category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            $category_filter";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Error executing query: " . mysqli_error($con));
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); 

        // Delete from cart
        $delete_incart = "DELETE FROM cart WHERE product_id='$id'";
        if (!mysqli_query($con, $delete_incart)) {
            die("Error deleting from cart: " . mysqli_error($con));
        }

        // Delete from products
        $delete_sql = "DELETE FROM products WHERE product_id='$id'";
        if (!mysqli_query($con, $delete_sql)) {
            die("Error deleting product: " . mysqli_error($con));
        }

        header("location:view_products.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="view_products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background-color: transparent;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            min-width: 160px;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <header>
        <input type="checkbox" name="" id="toggler" />
        <label for="toggler" class="fas fa-bars"></label>
        <a href="../admin/admin_dashboard.php" class="logo">Khloris<span>.</span></a>
        <nav class="navbar">
            <a href="../admin/admin_dashboard.php">Home</a>
            <a href="../admin/add_products.php">Add Products</a>
            <div class="dropdown">
                <button class="dropbtn">View Products</button>
                <div class="dropdown-content">
                    <a href="../admin/view_products.php">All Products</a>
                    <a href="../admin/view_products.php?category=1">Flowers</a>
                    <a href="../admin/view_products.php?category=2">Occasions</a>
                    <a href="../admin/view_products.php?category=3">Customize</a>
                </div>
            </div>
            <a href="../admin/order.php">Orders</a>
            <a href="../admin/total_users.php">Users</a>
        </nav>
        <div class="icons">
            <a href="admin_logout.php" class="fa-solid fa-right-from-bracket" onclick="return confirmLogout()"></a>
        </div>
    </header>

    <div class="info">
        <h1><?php echo isset($category_id) ? "Filtered Products" : "All Products"; ?></h1>

        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Category</th>
                <th>Type</th>
                <th>Update</th>
                <th>Remove</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td><img src="<?php echo $row['image_url']; ?>" alt="Product Image"></td>
                <td><?php echo $row['category_name']; ?></td>
                <td><?php echo $row['type_id']; ?></td>
                <td>
                    <a href="../admin/update_product.php?id=<?php echo $row['product_id']; ?>" class="update-btn">Update</a>
                </td>
                <td>
                    <a href="view_products.php?id=<?php echo $row['product_id']; ?>" class="delete-btn"
                        onclick="return confirm('Are you sure you want to remove this product?')">Remove</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <script>
    function confirmLogout() {
        return confirm("Are you sure you want to log out?");
    }
    </script>
</body>

</html>
