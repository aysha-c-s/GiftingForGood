<?php

@include 'conf.php';
session_start();
// if(isset($_POST['submit'])){

//    $name = $_POST['name'];
//    $pass = $_POST['password'];

//    if($name == 'Admin'&& $pass=='root'){
//       header('location:admin_page.php');
//    }else{
//       $select = " SELECT * FROM users WHERE (email = '$name' && password = '$pass') or (username = '$name' && password = '$pass')  ";
//       $result = mysqli_query($conn, $select);

//       if(mysqli_num_rows($result) > 0){
//          $row = mysqli_fetch_array($result);
//          $_SESSION['uid'] = $row['uid'];
//          header('location:home.php');
//    }else{
//       $error[] = 'incorrect email or password!';
//    }
// }
// };

if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $pass = $_POST['password'];
   if ($name == 'Admin' && $pass == 'root') {
      header('location:AdminPage.php');
   } else {
      $sql = "SELECT * FROM users WHERE username = ? && password = ? ";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $name, $pass);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         $_SESSION['uid'] = $row['uid'];
         header('location:UserHome.php');
      } else {
         $sql = "SELECT * FROM users WHERE email = ? && password = ? ";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("ss", $name, $pass);
         $stmt->execute();
         $result = $stmt->get_result();
         if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['uid'] = $row['uid'];
            header('location:UserHome.php');
         } else {
            $error[] = 'incorrect email or password!';
         }
      }
      $conn->close();
   }
};
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <title>login form</title>
   <link rel="stylesheet" href="login.css">
</head>

<body style="background: url(background.jpg);background-repeat:no-repeat;background-size:100%">
   <div class="form-container">
      <form action="" method="post">
         <h1>LOGIN</h1>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            }
            ;
         }
         ;
         ?>
         <input type="text" name="name" required placeholder="enter your username or email">
         <input type="password" name="password" required placeholder="enter your password">
         <input type="submit" name="submit" value="Login Now" class="form-btn">
         <p>don't have an account? <a href="register_form.php">register</a></p>
      </form>
   </div>

</body>

</html>