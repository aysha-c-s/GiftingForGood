<?php

@include 'conf.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $pass = $_POST['password'];

   if($name == 'Admin'&& $pass=='root'){
      header('location:admin_page.php');
   }else{
      $select = " SELECT * FROM users WHERE (email = '$name' && password = '$pass') or (username = '$name' && password = '$pass')  ";
      $result = mysqli_query($conn, $select);

      if(mysqli_num_rows($result) > 0){
         $row = mysqli_fetch_array($result);
         header('location:user_page.php');
   }else{
      $error[] = 'incorrect email or password!';
   }
}
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>login form</title>
   <link rel="stylesheet" href="style2.css">
</head>
<body style="background: url(background.jpg);background-repeat:no-repeat;background-size:100%">  
<div class="form-container">
   <form action="" method="post">
   <h1>LOGIN</h1>
   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your username or email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="Login Now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register</a></p>

   </form>

</div>

</body>
</html>