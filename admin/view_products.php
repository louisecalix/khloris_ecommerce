<?php
    session_start();
    include('../php/config.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delete_sql = "DELETE FROM products WHERE id='$id'";

        $data = mysqli_query($con, $delete_sql);

        if($data){
            header("location:view_products.php");
        }
    }

    $sql = "SELECT * FROM products";
    $result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        TABLE {
            border-radius: 10px;
            border: 2px solid pink;
            margin-left: 25%;

        }
        TH {
            background-color: pink;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        TD {
            padding: 10px;
            margin: 10px;
            text-align: center;
        }
        IMG {
            height: 100px; 
            width: 100px; 
        }

        .delete-btn {
            background-color: red;
            padding: 6px;
            border-radius: 8px;
            color: white;
        }

        .delete-btn:hover {
            background-color: darkred;
        }

        .update-btn {
            background-color: green;
            padding: 6px;
            border-radius: 8px;
            color: white;
        }

        .update-btn:hover {
            background-color: darkgreen;
        }
    </style>

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

                <h1>All Products</h1>
                
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Update</th>
                        <th>Remove</th>


                    </tr>

                <?php
                    while($row=mysqli_fetch_assoc($result))
                {
                ?>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                        <td><?php echo $row['quantity'] ?></td>
                        <td>
                            <img src="<?php echo $row['image_url'] ?>">
                        </td>
                        <td><?php echo $row['category_id'] ?></td>
                        <td><?php echo $row['type_id'] ?></td>
                        <td>
                            <a href="../admin/update_product.php?id=<?php echo $row['id'] ?>" class="update-btn">Update</a>
                        </td>

                        <td>
                            <a href="view_products.php?id=<?php echo $row['id'] ?>" 
                            class="delete-btn" onclick="return confirm('Are you sure you want to remove this product?')">Remove</a>
                        </td>

                    </tr>

                <?php
                }
                ?>
                </table>
            </div>

        </div>
    </div>
 
    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }
    </script>
</body>
</html>
