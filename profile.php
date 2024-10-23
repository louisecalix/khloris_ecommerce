<?php
  session_start();
  include 'php/config.php';

  $user_id = $_SESSION['ID'];

  $query = "SELECT name, username, email, password FROM users WHERE id = ?";
  
  $stmt = $con->prepare($query);
  
  if ($stmt === false) {
      die("SQL error: " . $con->error);
  }

  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();  
  } else {
      echo "User not found";
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
            <p><i class="fas fa-user"></i><span><?php echo htmlspecialchars($user['name']); ?></span></p>
            <p><i class="fas fa-phone"></i><span><?php echo htmlspecialchars($user['username']); ?></span></p>
            <p><i class="fas fa-envelope"></i><span><?php echo htmlspecialchars($user['email']); ?></span></p>
            <a href="update_profile.php" class="btn">Update Info</a>
            <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php echo htmlspecialchars($user['password']); ?></span></p>
            <a href="update_address.php" class="btn">Update Address</a>
        </div>
    </section>
</body>
</html>
