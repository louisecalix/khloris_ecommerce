<?php
    session_start();
    include('../php/config.php');

    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $categoriesQuery = "SELECT * FROM categories";
    $categoriesResult = mysqli_query($con, $categoriesQuery);

    $typesQuery = "SELECT * FROM types";
    $typesResult = mysqli_query($con, $typesQuery);

    if(isset($_POST['update_product'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category_id = $_POST['category_id'];
        $type_id = $_POST['type_id'];
        $image_url = $_POST['image_url'];

        if (!empty($image_url)) {
            $update_sql = "UPDATE products SET 
                name = '$name',
                description = '$description', 
                price =  '$price', 
                quantity = '$quantity', 
                category_id = '$category_id',
                type_id = '$type_id', 
                image_url = '$image_url' 
                WHERE id='$id'";
        } else {
            $update_sql = "UPDATE products SET 
                name = '$name',
                description = '$description', 
                price =  '$price', 
                quantity = '$quantity', 
                category_id = '$category_id',
                type_id = '$type_id' 
                WHERE id='$id'";
        }

        $data = mysqli_query($con, $update_sql);

        if($data){
            header("Location: view_products.php");
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        IMG {
            height: 150px;
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="sidebar-container">
        <div class="sidebar">
            <h2>Khloris Admin Dashboard</h2>
            <ul>
                <li><a href="../admin/admin_dashboard.php">Dashboard</a></li>
                <li><a href="../admin/add_products.php">Add Products</a></li>
                <li><a href="../admin/view_products.php">View Products</a></li>
            </ul>
        </div>

        <div class="header">
            <div class="admin-header">
                <a href="../admin/admin_logout.php" onclick="return confirmLogout()">Logout</a>
            </div>

            <div class="info">
                <h1>UPDATE PRODUCT</h1>

                <?php
                // if (isset($_SESSION['success_message'])) {
                //     echo "<p style='color: green;'>" . $_SESSION['success_message'] . "</p>";
                //     unset($_SESSION['success_message']); 
                // }
                ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <h2>Update Product</h2>
                    <input type="text" value="<?php echo $row['name'] ?>" name="name" placeholder="Product Name" required><br>
                    <textarea name="description" placeholder="Description"><?php echo $row['description'] ?></textarea><br>
                    <input type="number" name="price" value="<?php echo $row['price'] ?>" step="0.01" placeholder="Price" required><br>
                    <input type="number" name="quantity" value="<?php echo $row['quantity'] ?>" placeholder="Quantity" required><br>
                    
                    <div>
                        <img src="<?php echo $row['image_url'] ?>" alt="Product Image">
                    </div>
                    <!-- <input type="file" name="image_url" placeholder="Image URL"><br> -->
                    <input type="text" name="image_url" placeholder="Image URL"><br>


                    <select id="category_id" name="category_id" required>
                        <option value="">Select Category</option>
                        <option value="1" <?php if ($row['category_id'] == 1) echo 'selected'; ?>>Flower</option>
                        <option value="2" <?php if ($row['category_id'] == 2) echo 'selected'; ?>>Occasion</option>
                    </select><br>

                    <select id="type_id" name="type_id" required>
                        <option value="">Select Type</option>
                    </select><br>

                    <button type="submit" name="update_product">Update Product</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }

        const options = {
            '1': [
                { value: '1', text: 'Rose' },
                { value: '2', text: 'Sunflower' },
                { value: '3', text: 'Lily' },
                { value: '4', text: 'Tulip' }
            ],
            '2': [
                { value: '5', text: 'Birthday' },
                { value: '6', text: 'Valentine' },
                { value: '7', text: 'Funeral' },
            ]
        };

        const categoryDropdown = document.getElementById('category_id');
        const typeDropdown = document.getElementById('type_id');

        function updateTypeDropdown() {
            typeDropdown.innerHTML = '<option value="">Select Type</option>';

            const selectedCategory = categoryDropdown.value;
            const categoryOptions = options[selectedCategory] || [];

            categoryOptions.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.value;
                opt.textContent = option.text;
                typeDropdown.appendChild(opt);
            });

            typeDropdown.value = "<?php echo $row['type_id']; ?>";
        }

        categoryDropdown.addEventListener('change', updateTypeDropdown);

        updateTypeDropdown();
    </script>
</body>
</html>
