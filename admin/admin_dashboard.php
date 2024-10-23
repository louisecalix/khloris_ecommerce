<<<<<<< HEAD
<?php
    session_start();
    include('../php/config.php');

    $sql = "SELECT COUNT(*) AS total_users FROM users";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalUsers = $row['total_users'];
    } else {
        $totalUsers = 0; 
    }


    // $sql = "SELECT COUNT(*) AS total_orders FROM orders_user";
    // $result = mysqli_query($con, $sql);
    // if ($result) {
    //     $row = mysqli_fetch_assoc($result);
    //     $totalOrders = $row['total_oders'];
    // } else {
    //     $totalOrders = 0;
    // }    


    $sql = "SELECT COUNT(*) AS total_products FROM products";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalProducts = $row['total_products'];
    } else {
        $totalProducts = 0;
    }    
    
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
            <a href="../admin/order.php">Orders</a>
            <a href="../admin/total_users.php">Users</a>

        </nav>
        <div class="icons">
            <a href="admin_logout.php" class="fa-solid fa-right-from-bracket" onclick="return confirmLogout()"></a>
        </div>
    </header>
    <section class="home" id="home">
        <h1 class="dashboard"><span>Khloris</span> Dashboard</h1>
        <div class="box-container">

            <div class="box">
                <p class="totals"><?php echo $totalUsers; ?></p>
                <a href="../admin/total_users.php" class="link">Total user</a>
            </div>

            <div class="box">
                <p class="totals">0</p>
                <a href="../admin/order.php" class="link">Order Place</a>
            </div>

            <div class="box">
                <p class="totals"><?php echo $totalProducts; ?></p>
                <a href="../admin/view_products.php" class="link">Products</a>
            </div>
        </div>
    </section>

    <script>
    function confirmLogout() {
        return confirm("Are you sure you want to log out?");
    }
    </script>
</body>

=======
<?php
    session_start();
    include('../php/config.php');

    $sql = "SELECT COUNT(*) AS total_users FROM users";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalUsers = $row['total_users'];
    } else {
        $totalUsers = 0; 
    }


    // $sql = "SELECT COUNT(*) AS total_orders FROM orders_user";
    // $result = mysqli_query($con, $sql);
    // if ($result) {
    //     $row = mysqli_fetch_assoc($result);
    //     $totalOrders = $row['total_oders'];
    // } else {
    //     $totalOrders = 0;
    // }    


    $sql = "SELECT COUNT(*) AS total_products FROM products";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalProducts = $row['total_products'];
    } else {
        $totalProducts = 0;
    }    
    
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
            <a href="../admin/order.php">Orders</a>
        </nav>
        <div class="icons">
            <a href="admin_logout.php" class="fa-solid fa-right-from-bracket" onclick="return confirmLogout()"></a>
        </div>
    </header>
    <section class="home" id="home">
        <h1 class="dashboard"><span>Khloris</span> Dashboard</h1>
        <div class="box-container">

            <div class="box">
                <p class="totals"><?php echo $totalUsers; ?></p>
                <a href="../admin/total_users.php" class="link">Total user</a>
            </div>

            <div class="box">
                <p class="totals">0</p>
                <a href="../admin/order.php" class="link">Order Place</a>
            </div>

            <div class="box">
                <p class="totals"><?php echo $totalProducts; ?></p>
                <a href="../admin/view_products.php" class="link">Products</a>
            </div>
        </div>
    </section>

    <script>
    function confirmLogout() {
        return confirm("Are you sure you want to log out?");
    }
    </script>
</body>

>>>>>>> bc007b6 (ede)
</html>