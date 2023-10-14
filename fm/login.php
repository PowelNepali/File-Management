<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (strlen($password) >= 8) {
        $select = "SELECT * FROM user_form WHERE email = '$email'";

        $result = mysqli_query($conn, $select);

        if ($result) {
            $row = mysqli_fetch_array($result);

            if ($row) {
                if (password_verify($password, $row['password'])) {
                    if ($row['user_type'] == 'admin') {
                        $_SESSION['admin_name'] = $row['name'];
                        header('location: admin.php');
                    } elseif ($row['user_type'] == 'user') {
                        $_SESSION['user_name'] = $row['name'];
                        $_SESSION['id'] = $row['id'];
                        header('location: downloads.php');
                    } elseif ($row['user_type'] == 'teacher') {
                        $_SESSION['teacher_name'] = $row['name'];
                        header('location: teacher_page.php');
                    }
                } else {
                    $error[] = 'Incorrect email or password!';
                }
            } else {
                $error[] = 'User not found!';
            }
        } else {
            $error[] = 'Database query error!';
        }
    } else {
        $error[] = 'Password must be at least 8 characters long!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login form</title>

   <link rel="stylesheet" href="css/style.css">
   <style>
  body {
  margin: 0;
  padding: 0;
  background-image: url('image/leaf.jpg'); /* Specify the path to your background image */
  background-size: cover;
  background-position: center;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
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
  font-size: 36px;
}

.error-msg {
  color: #ff0000;
}

input[type="email"],
input[type="password"],
input[type="submit"] {
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
      <h3>Login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password (at least 8 characters)">
    
      <input type="submit" name="submit" value="Login now" class="form-btn">
      <p>Don't have an account? <a href="register.php">Register now</a></p>
   </form>
</div>

</body>
</html>
