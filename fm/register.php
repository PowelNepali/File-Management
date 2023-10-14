<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = $_POST['password'];
   $cpassword = $_POST['cpassword'];
   $user_type = $_POST['user_type'];

   $select = "SELECT * FROM user_form WHERE email = '$email'";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'User already exists!';
   } else {
      if(strlen($password) !== 8){
         $error[] = 'Password must be exactly 8 characters long!';
      } else if($password != $cpassword){
         $error[] = 'Password not matched!';
      } else {
         $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
         
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$hashedPassword','$user_type')";
         mysqli_query($conn, $insert);
         header('location: login.php');
      }
   }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

   <style>
     body {
       background-image: url('image/flower.jpg'); /* Specify the path to your background image */
       background-size: cover;
       background-position: center;
       margin: 0;
       padding: 0;
       font-family: 'Poppins', sans-serif;
       min-height: 100vh;
       display: flex;
       align-items: center;
       justify-content: center;
     }

     .form-container {
       background-color: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background to make text more readable */
       border: 2px solid #333;
       padding: 20px;
       border-radius: 10px;
       box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
       width: 100%;
       max-width: 400px;
       text-align: center;
     }

     h3 {
       margin: 0 0 20px;
       font-size: 30px;
       color: #333;
     }

     .error-msg {
       color: #ff0000;
     }

     input[type="text"],
     input[type="email"],
     input[type="password"],
     input[type="submit"],
     select {
       width: 100%;
       padding: 10px;
       margin-bottom: 15px;
       border: 1px solid #ccc;
       border-radius: 5px;
     }

     .form-btn {
       background-color: #333;
       color: #fff;
       border: none;
       cursor: pointer;
     }

     .form-btn:hover {
       background-color: #555;
     }
   </style>
</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Enter your name">
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter 8-character password">
      <input type="password" name="cpassword" required placeholder="Confirm your password">
      <select name="user_type">
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="teacher">Teacher</option> 
      </select>
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="login.php">Login Now</a></p>
   </form>
</div>

</body>
</html>
