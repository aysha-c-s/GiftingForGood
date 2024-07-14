<?php

@include 'conf.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $email = $_POST['email'];

   $address = $_POST['address'];
   $phn = $_POST['number'];
   $phn2 = $_POST['number2'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];

   $select = " SELECT * FROM users WHERE email = '$email' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO users(username,password,address,phone,optional_num,email) VALUES('$name','$pass','$address','$phn','$phn2','$email')";
         $res = $conn->query($insert);
         if ($res == TRUE) {
            header('location:login_form.php');
         }
         }
         $conn->close();
      }
   };

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>register form</title>
   <link rel="stylesheet" href="style2.css">
</head>
<body style="background: url(background.jpg);background-repeat:no-repeat;background-size:100%">  
  
<div class="form-container">

   <form action="" method="post">
   <h1>REGISTER</h1>
   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
   ?>
      <input type="text" name="name" required placeholder="enter your username">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="text" name="address" required placeholder="enter your address">
      <input type="text" name="number" required placeholder="enter your phone number">
      <input type="text" name="number2" placeholder="enter your phone number(optional)">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login</a></p>

   </form>

</div>

</body>
</html>
 