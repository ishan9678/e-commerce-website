<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="wrapper" style="background-color: #f1f1f1">
        <div class="inner">
            <div class="image-holder">
                <img src="../admin//images/hmgoepprod (5).jpeg" alt="">
            </div>

            <form class="signup-form" method="post" novalidate>
                <h3>SIGN UP</h3>
                <div class="form-group">
                    <input type="text" name="fname" placeholder="First Name" class="form-control">
                    <input type="text" name="lname" placeholder="Last Name" class="form-control">
                </div>

                <div class="form-wrapper">
                    <input type="text" name="email" placeholder="Email Address" class="form-control">
                    <i class="zmdi zmdi-email"></i>
                </div>
                <div class="form-wrapper">
                    <input type="tel" name="phone" placeholder="Phone Number" class="form-control">
                    <i class="zmdi zmdi-phone"></i>
                </div>
                <div class="form-wrapper">
                    <input type="password" name="pass" placeholder="Password" class="form-control">
                    <i class="zmdi zmdi-lock"></i>
                </div>
                <div class="form-wrapper">
                    <input type="password" name="cpass" placeholder="Confirm Password" class="form-control">
                    <i class="zmdi zmdi-lock"></i>
                </div>
                <button>Register
                    <i class="zmdi zmdi-arrow-right"></i>
                </button>
                <p class="account">Aready have an account? <a href="login.php">Log in</a></p>
            </form>

        </div>
    </div>

</body>

</html>

<?php

// validaton

if (empty($_POST['fname'] or $_POST['lname'])) {
    die('Name is required');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die('Valid email is required');
}

if (strlen($_POST['phone']) !== 10) {
    die('Invalid phone number');
}

if (strlen($_POST['pass']) < 8) {
    die('Password must atlest be 8 characters');
}

if (!preg_match("/[a-z]/i", $_POST['pass'])) {
    die("Password must atleast contain 1 letter");
}

if (!preg_match("/[0-9]/", $_POST['pass'])) {
    die("Password must contain atleast one number");
}

if ($_POST['pass'] !== $_POST['cpass']) {
    die('Passwords should match');
}

$password_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);

include '../admin/connect.php';

$sql = "INSERT INTO users (fname,lname,email,number,password_hash)
        VALUES (?,?,?,?,?)";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$number = $_POST['phone'];


try {
    $stmt = $conn->prepare($sql);
    $stmt->execute([$fname, $lname, $email, $number, $password_hash]);
    header("Location: login.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>