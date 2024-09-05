<?php
session_start();
include('../php/config.php');

if (isset($_POST['add_product'])) {
    $title = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    $image_url = $_POST['image_url'];
    
    $category_id = $_POST['category_id'];
    $type_id = $_POST['type_id'];

    $stmt = $con->prepare("INSERT INTO products(name, description, price, quantity, image_url, category_id, type_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdisii", $title, $description, $price, $quantity, $image_url, $category_id, $type_id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Product added successfully!";
        header('Location: add_products.php'); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>
<body>
<div class="sidebar-container">
        <div class="sidebar">
            <h2>Khloris Admin Dashboard</h2>
            <ul>
                <li>
                    <a href="../admin/admin_dashboard.php">Dashboard</a>
                </li>
                <li>
                    <a href="../admin/add_products.php">Add Products</a>
                </li>
                <li>
                    <a href="../admin/view_products.php">View Products</a>
                </li>
            </ul>
        </div>

        <div class="header">
            <div class="admin-header">
                <a href="../admin/admin_logout.php" onclick="return confirmLogout()">Logout</a>
            </div>

            <div class="info">
                <form action="add_products.php" method="POST" enctype="multipart/form-data">
                    <h2>Add New Product</h2>
                    <input type="text" name="name" placeholder="Product Name" required><br>
                    <textarea name="description" placeholder="Description"></textarea><br>
                    <input type="number" name="price" step="0.01" placeholder="Price" required><br>
                    <input type="number" name="quantity" placeholder="Quantity" required><br>

                    <!-- <input type="file" name="image_url" placeholder="Image URL"><br> -->
                    <input type="text" name="image_url" placeholder="Image URL"><br>

                    <select id="category_id" name="category_id" required>
                        <option value="">Select Category</option>
                        <option value="1">Flower</option>
                        <option value="2">Occasion</option>
                    </select><br>

                    <select id="type_id" name="type_id" required>
                        <option value="">Select Type</option>
                    </select><br>

                    <button type="submit" name="add_product">Add Product</button>
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
        }

        categoryDropdown.addEventListener('change', updateTypeDropdown);

        <?php if (isset($_SESSION['success_message'])): ?>
            alert("<?php echo $_SESSION['success_message']; ?>");
            <?php unset($_SESSION['success_message']);  ?>
        <?php endif; ?>
    </script>
</body>
</html>
