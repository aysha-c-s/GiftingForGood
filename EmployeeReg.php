<?php
@include 'conf.php';

$showModal = false;

if (isset($_POST['register'])) {
    $area = $_POST['area'];
    $name = $_POST['Username'];
    $detail = $_POST['detail'];
    $email = $_POST['Email'];
    $phn = $_POST['phn'];
    $ophn = $_POST['ophn'];
    $query = "INSERT INTO employees(name,Area,Detail_Address,phone,optional_num,email) VALUES ('$name','$area', '$detail', '$phn', '$ophn', '$email')";
    $res = $conn->query($query);
    if ($res == TRUE) {
        $showModal = true;
    } else {
        echo '<script>alert("Registration failed. Please try again.");</script>';
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="EmployeeReg.css">
</head>

<body style="background: url(background.jpg);background-repeat:no-repeat;background-size:100%">
    <div class="box">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Register as an Employee</h2>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>
            <br><select class="form-control" name="area" id="area" required style="background-color:#E1B8BF">
                <option selected class="selected" style="background-color:black;color:white;">Choose Your Area</option>
                <option value="Dhanmondi">Dhanmondi</option>
                <option value="Gulshan">Gulshan</option>
                <option value="Banani">Banani</option>
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
                <input type="text" name="ophn" required>
                <span>Optional Phone number</span>
                <i></i>
            </div>
            <input type="submit" value="Register" name="register">
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registration Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Your information has been submitted successfully! Our admin will contact you in a while.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="window.location.href='landing.html'">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <?php if ($showModal) : ?>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('successModal'));
        myModal.show();
    </script>
    <?php endif; ?>
</body>

</html>
