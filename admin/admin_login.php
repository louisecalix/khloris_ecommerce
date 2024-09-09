<?php
session_start(); 

include('../php/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $con->prepare("SELECT id, username, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $db_username, $db_password);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_username'] = $db_username;
            header("Location: admin_dashboard.php"); 
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No account found with that username.";
    }

    $stmt->close();
}

$con->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="login_admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <title>Admin Login</title>
</head>

<body>
    <header>
        <input type="checkbox" name="" id="toggler" />
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Khloris<span>.</span></a>
    </header>
    <div class="container">
        <div class="logo-section">
            <img src="https://res.cloudinary.com/dogrgo15f/image/upload/v1724128500/images/kk90fhhfsltwy7eqgtfg.png"
                alt="Shop Logo" class="shop-logo" />
        </div>
        <h2 class="shop-name"><span>Khloris</span><br />Flower Shop</h2>
        <div class="box form-box">
            <h1>Login Admin</h1>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form action="admin_login.php" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username.." autocomplete="off"
                        required />
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password.." autocomplete="off"
                        required />
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>