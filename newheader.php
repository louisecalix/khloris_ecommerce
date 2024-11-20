<?php

include 'php/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['ID']); 

$total_count_cart_items = 0;

if ($isLoggedIn) {
    $user_id = $_SESSION['ID'];

    // Count cart items
    if (isset($con)) {
        $count_cart_items = $con->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $count_cart_items->bind_param("i", $user_id); 
        $count_cart_items->execute();
        $result = $count_cart_items->get_result(); 
        $total_count_cart_items = $result->num_rows; 
    }

    // Fetch user details for the dropdown
    $query = "SELECT name, username, email FROM users WHERE id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($name, $username, $email);
        
        if ($stmt->fetch()) {
            $stmt->close();
        } else {
            echo "Error: User not found.";
        }
    } else {
        echo "Error: Query failed.";
    }
}
?>

<header>
    <input type="checkbox" name="" id="toggler" />
    <label for="toggler" class="fas fa-bars"></label>
    <a href="mainpage.php" class="logo">Khloris<span>.</span></a>

    <nav class="navbar">
        <a href="myorder.php">Home</a>
        <a href="customizepage.php">Customization</a>

        <!-- Dropdown for Flowers -->
        <div class="dropdown">
            <a href="flowerpage.php">Flowers</a>
            <div class="dropdown-content">
                <a href="flowerpage.php#sunflowers">Sunflowers</a>
                <a href="flowerpage.php#roses">Roses</a>
                <a href="flowerpage.php#lilies">Lilies</a>
            </div>
        </div>

        <!-- Dropdown for Occasions -->
        <div class="dropdown">
            <a href="occasion.php">Occasions</a>
            <div class="dropdown-content">
                <a href="occasion.php#prdctsoccassion">Birthday</a>
                <a href="occasion.php#prdctsoccassion-anniv">Anniversary</a>
                <a href="occasion.php#prdctsoccassion-funeral">Funeral</a>
            </div>
        </div>
    </nav>

    <div class="icons">
        <?php if ($isLoggedIn): ?>
            <a href="user_cart.php" class="fas fa-shopping-cart" title="Cart">
                <span>(<?php echo $total_count_cart_items; ?>)</span>
            </a>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <a href="javascript:void(0);" class="fas fa-user-circle" title="Profile"></a>
                <div class="dropdown-content">
                    <div class="headeruser"></div>
                    <!-- <p><i class="fas fa-id-card"></i> User ID: <?php echo $user_id; ?></p> -->
                    <!-- <p><i class="fas fa-user"></i> Name: <?php echo htmlspecialchars($name); ?></p> -->
                    <p><i class="fas fa-user-circle"></i> Username: <?php echo htmlspecialchars($username); ?></p>
                    <!-- <p><i class="fas fa-envelope"></i> Email: <?php echo htmlspecialchars($email); ?></p> -->
                    <div class="button-myorder"><a href="myorder.php">My order</a></div>
                    <a href="logout.php" onclick="return confirmLogout()" title="Logout">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <a href="login.php" class="fas fa-sign-in-alt" title="Login"></a>
            <a href="register.php" class="fas fa-user-plus" title="Register"></a>
        <?php endif; ?>
    </div>
</header>

<style>
    .headeruser {
        background: url(https://res.cloudinary.com/dogrgo15f/image/upload/v1732096676/lndmqf3onkoosjzewmkm.jpg);
        height:10rem;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        
    }

    .button-myorder a{
        color: black;
        padding: 8px 12px;
        text-decoration: none;
        display: block;
        border-top: solid 1px black;
        margin-bottom:2rem
    }
    .button-myorder a:hover{
        background-color: #eb7f76;
        color: black
    }


    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 300px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
        padding: 10px;
        border-radius: 8px;
        right: 0;
        font-size: 16px;
    }

    .dropdown-content p,
    .dropdown-content a {
        color: #cc655b;
        font-size:2.0rem;
        padding: 8px 12px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #cc655b;
        color: black
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content p {
        margin: 5px 5px;
    }

    .dropdown-content a {
        margin: 0;
    }

    .navbar {
        display: flex;
        align-items: center;
        gap: 20px; /* Space between nav items */
    }
</style>

<script>
    function confirmLogout() {
        return confirm("Are you sure you want to log out?");
    }
</script>
