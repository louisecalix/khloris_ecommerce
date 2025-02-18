<?php 
session_start();
include "php/config.php"; // Move this here to avoid output before header

// Check if form is submitted
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Perform database query
    $result = mysqli_query($con, "SELECT * FROM users WHERE email='$email'") or die("Select Error");
    $row = mysqli_fetch_assoc($result);

    if (is_array($row) && !empty($row)) {
        if (password_verify($password, $row['password'])){
        // Set session variables
            $_SESSION['valid'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['ID'] = $row['ID'];

            // Redirect to main page (header should be here)
            header("Location: mainpage.php");
            exit();
    } else {
        // Show error message if login fails
        echo "<div class='message'>
                <p>Wrong Username or Password</p>
              </div> <br>";
        echo "<a href='login.php'><button class='btn'>Back</button></a>";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <title>Login</title>
</head>

<body>
    
      <!-- <header>
      <input type="checkbox" name="" id="toggler" />
      <label for="toggler" class="fas fa-bars"></label>
      <a href="#" class="logo">Khloris<span>.</span></a>
      <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#Customization">Customization</a>
        <a href="flowerpage.html">Flowers</a>
        <a href="#Occassions">Occassions</a>
      </nav>
    <div class="icons">
        <a href="" class="fas fa-shopping-cart"></a>
        <a href="logout.php" class="fa-solid fa-right-from-bracket" onclick="return confirmLogout()"></a>
      </div>
    </header> -->
    <?php include 'header.php'; ?>




    <div class="container">
        <div class="logo-section">
            <img src="https://res.cloudinary.com/dogrgo15f/image/upload/v1724128500/images/kk90fhhfsltwy7eqgtfg.png"
                alt="Shop Logo" class="shop-logo">
        </div>
        <h2 class="shop-name"><span>Khloris</span><br>Flower Shop</h2>
        <div class="box form-box">

            <?php if (!isset($_POST['submit'])) { ?>

            <h1>Login</h1>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Email.." autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password.." autocomplete="off"
                        required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up here</a>
                </div>
            </form>

            <?php } ?>
        </div>
    </div>
</body>

</html>
