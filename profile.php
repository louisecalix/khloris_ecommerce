<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/homepage.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
  />
</head>
<body>
    <?php include 'header.php' ?>

    <section class="user-details" style="margin-top: 80px;">
        <div class="user">
            <p><i class="fas fa-user"></i><span>aaaaa bbbb</span></p>
            <p><i class="fas fa-phone"></i><span>aaaaa bbbb</span></p>
            <p><i class="fas fa-envelope"></i><span>aaaaa bbbb</span></p>
            <a href="update_profile.php" class="btn"> update info </a>
            <p class="address"><i class="fas fa-map-market-alt"></i><span>aaaaa bbbb</span></p>
            <a href="update_address.php" class="btn"> update address </a>

        </div>
    </section>


    
</body>
</html>
=======
<?php
  session_start();
  include('php/config.php');


  if (isset($_SESSION['ID'])) {
      $userId = $_SESSION['ID'];

      $query = "SELECT id, name, username, email FROM users WHERE id = ?";
      $stmt = $con->prepare($query);
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $stmt->bind_result($id, $name, $username, $email);
      $stmt->fetch();
      $stmt->close();
  } else {
      header("Location: login.php");
      exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/homepage.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="user-details" style="margin-top: 80px;">
        <div class="user">
            <p><i class="fas fa-user"></i><span><?php echo htmlspecialchars($name); ?></span></p>
            <p><i class="fas fa-id-badge"></i><span>ID: <?php echo htmlspecialchars($id); ?></span></p>
            <p><i class="fas fa-user-circle"></i><span>Username: <?php echo htmlspecialchars($username); ?></span></p>
            <p><i class="fas fa-envelope"></i><span>Email: <?php echo htmlspecialchars($email); ?></span></p>
        </div>
    </section>
</body>
</html>
>>>>>>> 0193adb2998e4492fb1292cf70bd5332470e1b51
