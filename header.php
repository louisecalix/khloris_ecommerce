<?php

include 'php/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['ID']); 

$total_count_cart_items = 0;

if ($isLoggedIn) {
    $user_id = $_SESSION['ID'];

    if (isset($con)) {

    $count_cart_items = $con->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $count_cart_items->bind_param("i", $user_id); 
    $count_cart_items->execute();
    $result = $count_cart_items->get_result(); 
    $total_count_cart_items = $result->num_rows; 
    }
}
?>

<header>
    <input type="checkbox" name="" id="toggler" />
    <label for="toggler" class="fas fa-bars"></label>
    <a href="mainpage.php" class="logo">Khloris<span>.</span></a>

    <nav class="navbar">
        <a href="mainpage.php">Home</a>
        <a href="#Customization">Customization</a>
        <a href="flowerpage.php">Flowers</a>
        <a href="occasion.php">Occasions</a>
    </nav>

    <div class="icons">
        <?php if ($isLoggedIn): ?>
            <a href="cart.php" class="fas fa-shopping-cart" title="Cart">
                <span>(<?php echo $total_count_cart_items; ?>)</span>
            </a>
            <a href="profile.php" class="fas fa-user-circle" title="Profile"></a>
            <a href="logout.php" class="fa-solid fa-right-from-bracket" onclick="return confirmLogout()" title="Logout"></a>

        <?php else: ?>
            <a href="login.php" class="fas fa-sign-in-alt" title="Login"></a>
            <a href="register.php" class="fas fa-user-plus" title="Register"></a>
        <?php endif; ?>
    </div>
</header>

<script>
    function confirmLogout() {
        return confirm("Are you sure you want to log out?");
    }
</script>
