<<<<<<< HEAD
<?php
    session_start();
    include('../php/config.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delete_sql = "DELETE FROM users WHERE id='$id'";

        $data = mysqli_query($con, $delete_sql);

        if($data){
            header("location:admin_dashboard.php");
        }
    }

    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="users_acc.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />


</head>
<body>
    <!-- <header>
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
    </header> -->
    <header>
      <input type="checkbox" name="" id="toggler" />
      <label for="toggler" class="fas fa-bars"></label>
      <a href="../admin/admin_dashboard.php" class="logo"
        >Khloris<span>.</span></a
      >
      <nav class="navbar">
        <a href="../admin/admin_dashboard.php">Home</a>
        <a href="../admin/add_products.php">Add Products</a>
        <a href="../admin/view_products.php">View Products</a>
        <a href="../admin/orders.php">Orders</a>
        <a href="#Orders">Users</a>
      </nav>
      <div class="icons">
        <a
          href="admin_logout.php"
          class="fa-solid fa-right-from-bracket"
          onclick="return confirmLogout()"
        ></a>
      </div>
    </header>

    <div class="user-info">
        <h1>Users <span>Accounts</span></h1>

        <table>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <!-- <th>Username</th> -->
                <th>Email</th>
                <th>Remove</th>
            </tr>
            <?php
                    while($row=mysqli_fetch_assoc($result))
                {
                ?>
            
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="total_users.php?id=<?php echo $row['ID'] ?>" class="delete-btn"
                        onclick="return confirm('Are you sure you want to remove this user?')">Remove</a>
                </td>

            </tr>
            <?php
                }
                ?>
        </table>
    </div>
    

</body>
=======
<?php
    session_start();
    include('../php/config.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delete_sql = "DELETE FROM users WHERE id='$id'";

        $data = mysqli_query($con, $delete_sql);

        if($data){
            header("location:admin_dashboard.php");
        }
    }

    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
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

    <div class="user-info">
        <h1>Users</h1>

        <table>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Remove</th>
            </tr>
            <?php
                    while($row=mysqli_fetch_assoc($result))
                {
                ?>
            
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="total_users.php?id=<?php echo $row['ID'] ?>" class="delete-btn"
                        onclick="return confirm('Are you sure you want to remove this user?')">Remove</a>
                </td>

            </tr>
            <?php
                }
                ?>
        </table>
    </div>
    

</body>
>>>>>>> bc007b6 (ede)
</html>