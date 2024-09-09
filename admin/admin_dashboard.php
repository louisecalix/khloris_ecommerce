<?php
session_start();

include('../php/config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khloris Dashboard</title>
    <link rel="stylesheet" href="admin_homepage.css" />
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
            <a href="#Orders">Orders</a>
        </nav>
        <div class="icons">
            <a href="admin_logout.php" class="fa-solid fa-right-from-bracket" onclick="return confirmLogout()"></a>
        </div>
    </header>
    <section class="home" id="home">
        <h1 class="dashboard"><span>Khloris</span> Dashboard</h1>
        <div class="box-container">
            <div class="box">
                <p class="totals">0</p>
                <a href="#" class="link">Total user</a>
            </div>
            <div class="box">
                <p class="totals">0</p>
                <a href="#" class="link">Order Place</a>
            </div>
            <div class="box">
                <p class="totals">0</p>
                <a href="#" class="link">Products Added</a>
            </div>
        </div>
    </section>

    <script>
    function confirmLogout() {
        return confirm("Are you sure you want to log out?");
    }
    </script>
</body>

</html>