<?php

@include 'conf.php';

if (isset($_POST['register'])) {
    $area = $_POST['area'];
    $name = $_POST['Username'];
    $detail = $_POST['detail'];
    $email = $_POST['Email'];
    $phn = $_POST['phn'];
    $ophn = $_POST['ophn'];
    $query = "INSERT INTO employees(Area,Detail_Address,phone,optional_num,email)VALUES('$area','$detail','$phn','$ophn','$email')";
    $res = $conn->query($query);
    if ($res == TRUE) {
        header('location:upload.php');
    }
    $conn->close();
}
;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="ecss.css">
</head>

<body style="background: url(background.jpg);background-repeat:no-repeat;background-size:100%">

    <div class="box">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Register</h2>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
                ;
            }
            ;
            ?>
            <br><select class="form-control" name="area" id="area" required
                style="background-color:#222;color:#8f8f8f;">
                <option selected class="selected" style="background-color:black;color:white;">Choose Your Area</option>
                <option value="Dhanmondi">Dhanmondi</option>
                <option value="Dhanmondi">Dhanmondi</option>
                <option value="Gulshan">Gulshan</option>
                <option value="Bonani">Bonani</option>
            </select>
            <div class="inputBox">
                <input type="text" name="Username" required>
                <span>Username</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="text" name="detail" required>
                <span>Detail address</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="email" name="Email" required>
                <span>Email</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="text" name="phn" required>
                <span>Phone number</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="text" name="ophn">
                <span>Optional Phone number</span>
                <i></i>
            </div>
            <input type="submit" value="Register" name="register">
        </form>
    </div>
</body>

</html>