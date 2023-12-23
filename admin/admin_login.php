<?php

include 'connect.php';

session_start();

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $pass = sha1($_POST['pass']);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);

   if ($select_admin->rowCount() > 0) {
      $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
      $_SESSION['admin_id'] = $fetch_admin_id['id'];
      header('location:dashboard.php');
   } else {
      $message[] = 'incorrect username or password!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="login_css.css">

</head>

<body>


   <div class="wrapper" style="background-color: #f1f1f1">
      <div class="inner">

         <form action="" class="login-form" method="POST">

            <h3 style="margin-bottom: 40px;">Admin login</h3>
            <div class="form-wrapper">
               <input type="text" name="name" placeholder="Username" class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
            </div>

            <div class="form-wrapper">
               <input type="password" name="pass" placeholder="Password" class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
            </div>

            <button type="submit" name="submit">Log in
            </button>
         </form>

      </div>
   </div>

</body>

</html>