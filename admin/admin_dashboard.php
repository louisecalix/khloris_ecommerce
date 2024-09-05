<?php
session_start();

include('../php/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

        </div>
    </div>


    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }
    </script>

</body>
</html>
