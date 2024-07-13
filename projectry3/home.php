<?php
@include 'conf.php';
session_start();
if (isset($_SESSION['uid'])) {
  $uid = $_SESSION['uid'];
  $sql = "SELECT * FROM users WHERE uid='$uid'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['username'];
    $address = $row['address'];
    $email = $row['email'];
    $phn = $row['phone'];
    $ophn = $row['optional_num'];
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toggle Box</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <style>
    .link {
      color: inherit;

      i {
        margin-right: 2%;
        width: 12%;
        background-color: var(--secondary);
        color: var(--white);
        line-height: 250%;
        text-align: center;
        border-radius: 50%;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="d-flex justify-content-end mt-3 position-relative">
      <input type="checkbox" id="toggleCheckbox" class="d-none">
      <label for="toggleCheckbox" id="toggleButton" class="btn btn-danger rounded-circle">
        <i class="fas fa-user"></i>
      </label>
      <div id="toggleBox" class="position-absolute">
        <div class="content">
          <div class="data">
            <p><b>Full Name</b><span><?php echo $name; ?></span></p>
            <p><b>Email</b><span><?php echo $email; ?></span></p>
            <p><b>Phone</b><span><?php echo $phn; ?></span></p>
            <p><b>Optional Phone</b><span><?php echo $ophn ?></span></p>
            <p><i class="fas fa-edit"></i><b>Address</b><span><?php echo $address ?></span></p>
            <p onclick="location.href='profile.php'"><a href="profile.php" class="link"><i class="fas fa-edit"></i><b>Edit</b></a></p>
            <p onclick="location.href='logout.php'"><a href="logout.php" class="link"><i class="fas fa-sign-out-alt"></i><b>Logout</b></a></p>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>