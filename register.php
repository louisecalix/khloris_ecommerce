<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <title>Register</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="logo-section">
            <img src="https://res.cloudinary.com/dogrgo15f/image/upload/v1724128500/images/kk90fhhfsltwy7eqgtfg.png"
                alt="Shop Logo" class="shop-logo">

        </div>
        <h2 class="shop-name"><span>Khloris</span><br>Flower Shop</h2>
        <div class="box form-box">

            <?php 
         
         include("php/config.php");
         if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];


         $verify_query = mysqli_query($con,"SELECT email FROM users WHERE email='$email'");

         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                      <p>This email is already taken</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         else{

            mysqli_query($con,"INSERT INTO users(name,username,email,Password) VALUES('$name','$username','$email','$password')") or die("Erroe Occured");

            echo "<div class='message'>
                      <p>Account Created Successfully</p>
                  </div> <br>";
            echo "<a href='login.php'><button class='btn'>Login Now</button>";
         

         }

         }else{
         
        ?>

            <h1>Sign Up</h1>
            <form action="" method="post">
                <div class="field input">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name.." autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username.." autocomplete="off"
                        required>
                </div>

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

                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already have an account? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>

</html>